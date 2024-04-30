<?php

namespace App\Http\Controllers\Dashboard\Settings\Picklists\GetInTouch;

use App\Http\Controllers\CommonControllerMethods;
use App\Http\Controllers\Controller;
use App\Repositories\GetInTouch\GetInTouchRepositoryInterface;
use App\Services\Validations\GetInTouch\GetInTouchValidationInterface;
use Illuminate\Http\Request;

class GetInTouchController extends Controller
{

    use CommonControllerMethods;

    function __construct(
        protected GetInTouchRepositoryInterface $repo,
        protected GetInTouchValidationInterface $validationInterface,
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
