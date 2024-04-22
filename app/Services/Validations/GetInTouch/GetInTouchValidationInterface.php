<?php

namespace App\Services\Validations\GetInTouch;

use Illuminate\Http\Request;

interface GetInTouchValidationInterface
{
    public function store(Request $request): mixed;
    
}
