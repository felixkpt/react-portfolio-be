<?php

namespace App\Services\Validations\Skill;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SkillValidation implements SkillValidationInterface
{

    public function store(Request $request): mixed
    {

        $validatedData = request()->validate([
            'name' => 'required|unique:skills,name,' . request()->id,
            'start_date' => 'required|date',
            'experience_level_id' => 'required|exists:experience_levels,id',
            'skill_category_id' => 'required|exists:skill_categories,id',
            'priority' => 'nullable|numeric',
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        return $validatedData;
    }
}
