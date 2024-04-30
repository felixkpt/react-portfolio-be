<?php

namespace App\Http\Controllers\Dashboard\Qualifications;

use App\Http\Controllers\CommonControllerMethods;
use App\Http\Controllers\Controller;
use App\Repositories\Qualification\QualificationRepositoryInterface;
use App\Services\Validations\Qualification\QualificationValidationInterface;
use Illuminate\Http\Request;

class QualificationsController extends Controller
{

    use CommonControllerMethods;

    function __construct(
        protected QualificationRepositoryInterface $repo,
        protected QualificationValidationInterface $validationInterface,
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
