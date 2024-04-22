<?php

namespace App\Services\Validations\Skill;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SkillValidation implements SkillValidationInterface
{

    public function store(Request $request): mixed
    {

        // about should be only one record per user
        $about = Skill::where('user_id', auth()->id())->first();
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
