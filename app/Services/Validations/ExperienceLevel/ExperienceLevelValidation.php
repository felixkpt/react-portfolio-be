<?php

namespace App\Services\Validations\ExperienceLevel;

use Illuminate\Http\Request;

class ExperienceLevelValidation implements ExperienceLevelValidationInterface
{

    public function store(Request $request): mixed
    {

        $validatedData = request()->validate([
            'name' => 'required|unique:experience_levels,name,' . request()->id,
            'priority' => 'nullable|numeric',
        ]);

        return $validatedData;
    }
}
