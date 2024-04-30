<?php

namespace App\Http\Controllers\Dashboard\Projects;

use App\Http\Controllers\CommonControllerMethods;
use App\Http\Controllers\Controller;
use App\Repositories\Project\ProjectRepositoryInterface;
use App\Services\Validations\Project\ProjectValidationInterface;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{

    use CommonControllerMethods;

    function __construct(
        protected ProjectRepositoryInterface $repo,
        protected ProjectValidationInterface $validationInterface,
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
