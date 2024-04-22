<?php

namespace App\Services\Validations\Qualification;

use App\Models\Qualification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QualificationValidation implements QualificationValidationInterface
{

    public function store(Request $request): mixed
    {

        // about should be only one record per user
        $about = Qualification::where('user_id', auth()->id())->first();
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
