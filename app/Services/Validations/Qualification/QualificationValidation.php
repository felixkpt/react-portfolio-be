<?php

namespace App\Services\Validations\Qualification;

use App\Models\Qualification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class QualificationValidation implements QualificationValidationInterface
{

    public function store(Request $request): mixed
    {

        $validatedData = request()->validate([
            'institution' => 'required|unique:qualifications,institution,' . request()->id,
            'course' => 'required',
            'qualification' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'priority_number' => 'nullable|numeric',
        ]);

        $validatedData['start_date'] = Carbon::parse($validatedData['start_date'])->format('Y-m-d');
        $validatedData['end_date'] = Carbon::parse($validatedData['end_date'])->format('Y-m-d');

        return $validatedData;
    }
}
