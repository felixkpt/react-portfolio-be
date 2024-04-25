<?php

namespace App\Services\Validations\Company;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CompanyValidation implements CompanyValidationInterface
{

    public function store(Request $request): mixed
    {

        $validatedData = request()->validate([
            'name' => 'required|unique:companies,name,' . request()->id . ',id',
            'url' => 'required|url|unique:companies,url,' . request()->id . ',id',
            'image' => 'required|file',
            'priority_number' => 'required|numeric',
            'roles' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        $validatedData['start_date'] = Carbon::parse($validatedData['start_date'])->format('Y-m-d');
        if (request()->end_date)
            $validatedData['end_date'] = Carbon::parse($validatedData['end_date'])->format('Y-m-d');

        return $validatedData;
    }
}
