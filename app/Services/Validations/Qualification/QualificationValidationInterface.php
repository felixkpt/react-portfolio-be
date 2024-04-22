<?php

namespace App\Services\Validations\Qualification;

use Illuminate\Http\Request;

interface QualificationValidationInterface
{
    public function store(Request $request): mixed;
    
}
