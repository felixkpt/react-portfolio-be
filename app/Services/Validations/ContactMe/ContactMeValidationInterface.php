<?php

namespace App\Services\Validations\ContactMe;

use Illuminate\Http\Request;

interface ContactMeValidationInterface
{
    public function store(Request $request): mixed;
    
}
