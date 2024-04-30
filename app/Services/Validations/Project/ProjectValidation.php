<?php

namespace App\Services\Validations\Project;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectValidation implements ProjectValidationInterface
{

    public function store(Request $request): mixed
    {

        if ($request->project_url && !Str::startsWith($request->project_url, ['http://', 'https://'])) {
            $request->merge(['project_url' => 'https://' . $request->project_url]);
        }
        if ($request->github_url && !Str::startsWith($request->github_url, ['http://', 'https://'])) {
            $request->merge(['github_url' => 'https://' . $request->github_url]);
        }

        $validatedData = request()->validate([
            'title' => 'required|unique:projects,title,' . request()->id,
            'company_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'required',
            'achievements' => 'required',
            'project_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'skill_ids' => 'required|array',
            'priority' => 'nullable|numeric',
        ]);

        $validatedData['slug'] = Str::slug($validatedData['title']);
        $validatedData['project_url'] = Str::lower($validatedData['project_url']);
        $validatedData['github_url'] = Str::lower($validatedData['github_url']);

        return $validatedData;
    }
}
