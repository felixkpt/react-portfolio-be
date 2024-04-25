<?php

namespace App\Services\Validations\GetInTouch;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GetInTouchValidation implements GetInTouchValidationInterface
{

    public function store(Request $request): mixed
    {

        $validatedData = request()->validate([
            'type' => 'required|unique:get_in_touches,type,' . request()->id,
            'link' => 'required',
            'priority_number' => 'nullable|numeric',
        ]);

        return $validatedData;
    }
}
