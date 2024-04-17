<?php

use App\Http\Controllers\Auth\AuthController;
use Felixkpt\Nestedroutes\RoutesHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the NesetedRouteServiceProvider within a group which
| is assigned the "web" middleware group. Enjoy building your Admin!
|
*/

$nested_routes_folder = config('nestedroutes.folder');
// Prefix all generated routes
$prefix = 'api';
// Middlewares to be passed before accessing any route
$middleWares = [];
$middleWares[] = 'api';
$middleWares[] = 'nested_routes_auth';
$middleWares[] = 'auth:sanctum';

Route::middleware(array_filter(array_merge($middleWares, [])))
    ->prefix($prefix)
    ->group(function () use ($nested_routes_folder) {

        $routes_path = base_path('routes/' . $nested_routes_folder);

        if (file_exists($routes_path)) {
            $route_files = collect(File::allFiles($routes_path))->filter(fn ($file) => !Str::is($file->getFileName(), 'driver.php') && Str::endsWith($file->getFileName(), '.route.php'));

            foreach ($route_files as $file) {

                $res = (new RoutesHelper(''))->handle($file);

                $prefix = $res['prefix'];
                $file_path = $res['file_path'];

                Route::prefix($prefix)->group(function () use ($file_path) {
                    require $file_path;
                });
            }
        }
    });


Route::prefix('api/auth')->group(function () {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('password', [AuthController::class, 'passwordResetLink']);

    Route::get('password/{token}', [AuthController::class, 'getEmail'])->name('getEmail');
    Route::post('password-set', [AuthController::class, 'passwordSet'])->name('password.set');

    Route::middleware(['auth:sanctum'])->group(function () {

        Route::get('/user', function (Request $request) {
            $user = $request->user();
            $roles = $user->getRoleNames();
            $user->roles = $roles;
            $user->fileAccessToken = generateTemporaryToken(60);
            return ['results' => $user];
        });

        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('abilities', [AuthController::class, 'abilities']);
    });
});
