<?php

namespace App\Http\Controllers\About;

use App\Http\Controllers\CommonControllerMethods;
use App\Http\Controllers\Controller;
use App\Repositories\About\AboutRepositoryInterface;
use App\Services\Validations\About\AboutValidationInterface;
use Illuminate\Http\Request;

class AboutController extends Controller
{

    use CommonControllerMethods;

    function __construct(
        protected AboutRepositoryInterface $repo,
        protected AboutValidationInterface $validationInterface,
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

    public function show($id)
    {
        return $this->repo->show($id);
    }

}
