<?php

namespace App\Services\Validations\Project\ProjectSlide;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectSlideValidation implements ProjectSlideValidationInterface
{

    public function store(Request $request): mixed
    {

        $validatedData = request()->validate([
            'project_id' => 'required|exists:projects,id',
            'image' => 'required|file',
            'caption' => 'required|string',
            'priority' => 'nullable|numeric',
        ]);

        return $validatedData;
    }
}
