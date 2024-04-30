<?php

namespace App\Services\Validations\ContactMe;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContactMeValidation implements ContactMeValidationInterface
{

    public function store(Request $request): mixed
    {

        $validatedData = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required|string|min:2|max:5000',
        ]);

        $unread = Message::where('email', $validatedData['email'])->first();
        if ($unread && $unread->status_id == activeStatusId()) {
            abort(422, 'Your prev message is unread');
        }

        $validatedData['ip'] = $request->ip();

        return $validatedData;
    }
}
