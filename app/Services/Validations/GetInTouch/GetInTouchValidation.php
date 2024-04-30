<?php

namespace App\Services\Validations\GetInTouch;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GetInTouchValidation implements GetInTouchValidationInterface
{

    public function store(Request $request): mixed
    {

        $validatedData = request()->validate([
            'name' => 'required|unique:get_in_touches,name,' . request()->id,
            'link' => 'required',
            'priority' => 'nullable|numeric',
        ]);

        return $validatedData;
    }
}
