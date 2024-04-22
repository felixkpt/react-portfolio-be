<?php

namespace App\Services\Validations\WorkExperience;

use Illuminate\Http\Request;

interface WorkExperienceValidationInterface
{
    public function store(Request $request): mixed;
    
}
