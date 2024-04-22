<?php

namespace App\Services\Validations\About;

use Illuminate\Http\Request;

interface AboutValidationInterface
{
    public function store(Request $request): mixed;
    
}
