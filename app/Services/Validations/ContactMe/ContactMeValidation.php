<?php

namespace App\Services\Validations\ContactMe;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContactMeValidation implements ContactMeValidationInterface
{

    public function store(Request $request): mixed
    {

        $validatedData = request()->validate([
            'title' => 'required|unique:projects,title,' . request()->id . ',_id',
            'company_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'project_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'skills' => 'required',
        ]);

        $validatedData['slug'] = Str::slug($validatedData['title']);

        return $validatedData;
    }
}
