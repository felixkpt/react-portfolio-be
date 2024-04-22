<?php

namespace App\Services\Validations\About;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AboutValidation implements AboutValidationInterface
{

    public function store(Request $request): mixed
    {

        // about should be only one record per user
        $about = About::where('user_id', auth()->id())->first();
        if ($about && (!request()->id || request()->id != $about->id)) {
            abort(422, 'You already have about page.');
        }

        $validatedData = request()->validate([
            'current_title' => 'nullable|string',
            'name' => 'required|unique:about,name,' . request()->id,
            'slogan' => 'nullable',
            'content' => 'required|string',
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        return $validatedData;
    }
}
