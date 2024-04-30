<?php

namespace App\Services\Validations\SkillCategory;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SkillCategoryValidation implements SkillCategoryValidationInterface
{

    public function store(Request $request): mixed
    {

        $validatedData = request()->validate([
            'name' => 'required|unique:skill_categories,name,' . request()->id,
            'priority' => 'nullable|numeric',
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        return $validatedData;
    }
}
