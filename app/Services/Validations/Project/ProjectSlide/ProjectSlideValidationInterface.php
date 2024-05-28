<?php

namespace App\Services\Validations\Project\ProjectSlide;

use Illuminate\Http\Request;

interface ProjectSlideValidationInterface
{
    public function store(Request $request): mixed;
    
}
