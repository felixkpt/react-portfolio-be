<?php

namespace App\Http\Controllers\Dashboard\Settings\Picklists\ExperienceLevels;

use App\Http\Controllers\CommonControllerMethods;
use App\Http\Controllers\Controller;

use App\Repositories\ExperienceLevel\ExperienceLevelRepositoryInterface;
use App\Services\Validations\ExperienceLevel\ExperienceLevelValidationInterface;
use Illuminate\Http\Request;

class ExperienceLevelsController extends Controller
{

    use CommonControllerMethods;

    function __construct(
        protected ExperienceLevelRepositoryInterface $repo,
        protected ExperienceLevelValidationInterface $validationInterface,
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
