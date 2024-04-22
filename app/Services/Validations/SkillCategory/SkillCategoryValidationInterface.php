<?php

namespace App\Services\Validations\SkillCategory;

use Illuminate\Http\Request;

interface SkillCategoryValidationInterface
{
    public function store(Request $request): mixed;
    
}
