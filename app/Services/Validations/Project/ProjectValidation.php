<?php

namespace App\Services\Validations\Project;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectValidation implements ProjectValidationInterface
{

    public function store(Request $request): mixed
    {

        // about should be only one record per user
        $about = Project::where('user_id', auth()->id())->first();
        if ($about && (!request()->id || request()->id != $about->id)) {
            abort(422, 'You already have about page.');
        }

        $validatedData = request()->validate([
            'current_title' => 'nullable|string',
            'name' => 'required|unique:about,name,' . request()->id,
            'slogan' => 'nullable',
            'content' => 'required|string',
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        return $validatedData;
    }
}
