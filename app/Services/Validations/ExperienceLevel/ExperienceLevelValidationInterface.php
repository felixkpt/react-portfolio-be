<?php

namespace App\Services\Validations\ExperienceLevel;

use Illuminate\Http\Request;

interface ExperienceLevelValidationInterface
{
    public function store(Request $request): mixed;
    
}
