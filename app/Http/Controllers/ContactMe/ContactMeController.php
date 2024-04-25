<?php

namespace App\Http\Controllers\ContactMe;

use App\Http\Controllers\CommonControllerMethods;
use App\Http\Controllers\Controller;
use App\Repositories\ContactMe\ContactMeRepositoryInterface;
use App\Services\Validations\ContactMe\ContactMeValidationInterface;
use Illuminate\Http\Request;

class ContactMeController extends Controller
{

    use CommonControllerMethods;

    function __construct(
        protected ContactMeRepositoryInterface $repo,
        protected ContactMeValidationInterface $validationInterface,
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
