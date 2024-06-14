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

        if ($request->website && !Str::startsWith($request->website, ['http://', 'https://'])) {
            $request->merge(['website' => 'https://' . $request->website]);
        }

        $validatedData = request()->validate([
            'name' => 'required|unique:companies,name,' . request()->id . ',id',
            'website' => 'required|url|unique:companies,website,' . request()->id . ',id',
            'position' => 'required|string',
            'roles' => 'required|string',
            'priority' => 'nullable|numeric',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
        ]);


        if (!$request->id) {
            request()->validate([
                'image' => 'required|image',
            ]);
        }

        $validatedData['slug'] = Str::slug($validatedData['name']);

        $validatedData['start_date'] = Carbon::parse($validatedData['start_date'])->format('Y-m-d');
        if (request()->end_date)
            $validatedData['end_date'] = Carbon::parse($validatedData['end_date'])->format('Y-m-d');

        $validatedData['website'] = Str::lower($validatedData['website']);

        return $validatedData;
    }
}
