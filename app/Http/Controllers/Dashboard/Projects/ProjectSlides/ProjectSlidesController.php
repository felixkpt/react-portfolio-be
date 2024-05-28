<?php

namespace App\Http\Controllers\Dashboard\Projects\ProjectSlides;

use App\Http\Controllers\CommonControllerMethods;
use App\Http\Controllers\Controller;
use App\Repositories\Project\ProjectSlide\ProjectSlideRepositoryInterface;
use App\Services\Validations\Project\ProjectSlide\ProjectSlideValidationInterface;
use Illuminate\Http\Request;

class ProjectSlidesController extends Controller
{

    use CommonControllerMethods;

    function __construct(
        protected ProjectSlideRepositoryInterface $repo,
        protected ProjectSlideValidationInterface $validationInterface,
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
