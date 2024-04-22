<?php

namespace App\Services\Validations\Skill;

use Illuminate\Http\Request;

interface SkillValidationInterface
{
    public function store(Request $request): mixed;
    
}
