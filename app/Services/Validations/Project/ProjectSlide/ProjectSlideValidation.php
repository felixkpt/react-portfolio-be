<?php

namespace App\Services\Validations\Project\ProjectSlide;

use Illuminate\Http\Request;

class ProjectSlideValidation implements ProjectSlideValidationInterface
{

    public function store(Request $request): mixed
    {

        $validatedData = request()->validate([
            'project_id' => 'required|exists:projects,id',
            'caption' => 'required|string',
            'description' => 'nullable|string|max:200',
            'priority' => 'nullable|numeric',
        ]);

        return $validatedData;
    }
}
