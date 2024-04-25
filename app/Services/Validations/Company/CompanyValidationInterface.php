<?php

namespace App\Services\Validations\Company;

use Illuminate\Http\Request;

interface CompanyValidationInterface
{
    public function store(Request $request): mixed;
}
