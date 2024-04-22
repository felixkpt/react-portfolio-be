<?php

namespace App\Http\Controllers\WorkExperiences;

use App\Http\Controllers\CommonControllerMethods;
use App\Http\Controllers\Controller;
use App\Repositories\WorkExperience\WorkExperienceRepositoryInterface;
use App\Services\Validations\WorkExperience\WorkExperienceValidationInterface;
use Illuminate\Http\Request;

class WorkExperiencesController extends Controller
{

    use CommonControllerMethods;

    function __construct(
        protected WorkExperienceRepositoryInterface $repo,
        protected WorkExperienceValidationInterface $validationInterface,
    ) {
    }

    function index()
    {
        return $this->repo->index();
    }

    function store(Request $request)
    {
        $data = $this->validationInterface->store($request);
        return $this->repo->store($request, $data);
    }
}
