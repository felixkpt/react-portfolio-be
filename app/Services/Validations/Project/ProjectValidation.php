<?php

namespace App\Services\Validations\Project;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectValidation implements ProjectValidationInterface
{

    public function store(Request $request): mixed
    {

        $validatedData = request()->validate([
            'title' => 'required|unique:projects,title,' . request()->id,
            'company_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'required',
            'achievements' => 'required',
            'project_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'skills' => 'required',
            'priority_number' => 'nullable|numeric',
        ]);

        $validatedData['slug'] = Str::slug($validatedData['title']);

        return $validatedData;
    }
}
