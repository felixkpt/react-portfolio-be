<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\AuthenticationLog;
use App\Models\Role;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\Validations\User\UserValidationInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function __construct(
        private UserRepositoryInterface $userRepositoryInterface,
        private UserValidationInterface $userValidationInterface,
    ) {
    }

    /**
     * Create User
     * @param Request $request
     * @return User 
     */
    public function register(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make(
                $request->all(),
                [
                    'name' => 'required|min:3',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|confirmed|min:6',
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);


            $role = Role::find(config('nestedroutes.guestRoleId'));
            $user->assignRole($role);
            $user->default_role_id = $role->id;
            $user->save();

            $user->token = $user->createToken("API TOKEN")->plainTextToken;

            return response([
                'status' => true,
                'message' => 'User Created Successfully',
                'results' => $user

            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Login The User
     *
     * This method handles user login requests. It validates the incoming request data,
     * attempts to authenticate the user, logs the authentication attempt (whether successful or not),
     * and returns an appropriate response.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {
            // Validate the request data
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',  // Email is required and must be a valid email address
                    'password' => 'required'      // Password is required
                ]
            );

            // If validation fails, log the attempt as unsuccessful and return a validation error response
            if ($validateUser->fails()) {
                $this->logAuthenticationAttempt($request, false);
                return response()->json([
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401); // Return a 401 Unauthorized response with validation errors
            }


            // Attempt to authenticate the user with the provided credentials
            if (!Auth::attempt($request->only(['email', 'password']))) {
                
                // Retrieve the user by email if it exists
                $userByMail = User::where('email', $request->email)->first();
                if ($userByMail) {
                    $this->logAuthenticationAttempt($request, false, $userByMail); // Log the unsuccessful attempt
                }

                return response()->json([
                    'message' => 'Email & Password do not match our records.',
                    'errors' => [
                        'email' => ['Email & Password do not match our records.']
                    ]
                ], 401); // Return a 401 Unauthorized response with an error message
            }

            // Authentication successful, retrieve the authenticated user
            $user = auth()->user();
            $user = User::find(auth()->id())->first();
            $this->logAuthenticationAttempt($request, true, $user); // Log the successful attempt

            // Generate an API token for the authenticated user
            $user->token = $user->createToken("API TOKEN")->plainTextToken;

            // Return a successful response with the user data and token
            return response()->json([
                'message' => 'User Logged In Successfully',
                'results' => $user,
            ], 200); // Return a 200 OK response with the user details
        } catch (\Throwable $th) {
            // Catch any exceptions and return a 500 Internal Server Error response
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Helper function to log authentication attempts
     *
     * @param Request $request
     * @param bool $success Indicates whether the authentication attempt was successful
     * @param User|null $user The authenticated user, if the attempt was successful
     * @return void
     */
    protected function logAuthenticationAttempt(Request $request, bool $success, User $user = null)
    {
        AuthenticationLog::create([
            'authenticatable_type' => User::class, // The type of the authenticatable model (User)
            'authenticatable_id' => $user ? $user->id : null, // The ID of the authenticatable model, if available
            'ip_address' => $request->ip(), // The IP address from which the request was made
            'user_agent' => $request->header('User-Agent'), // The user agent string from the request
            'login_at' => now(), // The timestamp of the login attempt
            'login_successful' => $success, // Indicates whether the login attempt was successful
        ]);
    }


    public function passwordResetLink(Request $request)
    {

        $validateUser = Validator::make(
            $request->all(),
            [
                'email' => 'required|email|exists:users',
            ]
        );

        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('emails.forgetPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return response(['message' => 'We have e-mailed your password reset link!']);
    }

    public function getEmail(Request $request)
    {
        $password_reset = DB::table('password_resets')
            ->where([
                'token' => $request->token
            ])
            ->first();

        if (!$password_reset)
            return response(['message' => 'Invalid token!'], 422);

        return response(['results' => $password_reset], 200);
    }

    public function passwordSet(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $password_reset = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$password_reset)
            return response(['message' => 'Invalid token!'], 422);


        $user = User::where('email', $request->email)->first();
        $user->update(['password' => Hash::make($request->password)]);

        $user = User::where('email', $request->email)->first();
        $user->token = $user->createToken("API TOKEN")->plainTextToken;

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return response(['message' => 'Your password has been changed!', 'results' => $user], 200);
    }

    function profileShow()
    {
    }

    public function profileUpdate(Request $request)
    {
        return $this->userRepositoryInterface->profileUpdate($request);
    }

    public function updatePassword()
    {
        return $this->userRepositoryInterface->updateSelfPassword();
    }

    public function loginLogs()
    {
        return $this->userRepositoryInterface->loginLogs();
    }

    /**
     * Logout the User
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        try {
            $user = $request->user();

            if ($user) {

                $user->currentAccessToken()->delete();

                // Check for any previous sessions that were not logged out properly
                $existingLog = AuthenticationLog::where('authenticatable_type', User::class)
                    ->where('authenticatable_id', $user->id)
                    ->whereNull('logout_at')
                    ->orderBy('id', 'desc')
                    ->first();
                if ($existingLog) {
                    // Update the logout_at field for existing log record
                    $existingLog->update(['logout_at' => now()]);
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'Logged Out Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
