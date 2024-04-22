<?php

namespace App\Services\Validations\Project;

use Illuminate\Http\Request;

interface ProjectValidationInterface
{
    public function store(Request $request): mixed;
    
}
