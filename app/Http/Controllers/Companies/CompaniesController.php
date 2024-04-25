<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\CommonControllerMethods;
use App\Http\Controllers\Controller;
use App\Repositories\Company\CompanyRepositoryInterface;
use App\Services\Validations\Company\CompanyValidationInterface;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{

    use CommonControllerMethods;

    function __construct(
        protected CompanyRepositoryInterface $repo,
        protected CompanyValidationInterface $validationInterface,
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
