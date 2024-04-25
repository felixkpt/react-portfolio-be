<?php

namespace App\Http\Controllers\Skills;

use App\Http\Controllers\CommonControllerMethods;
use App\Http\Controllers\Controller;
use App\Repositories\Skill\SkillRepositoryInterface;
use App\Services\Validations\Skill\SkillValidationInterface;
use Illuminate\Http\Request;

class SkillsController extends Controller
{

    use CommonControllerMethods;

    function __construct(
        protected SkillRepositoryInterface $repo,
        protected SkillValidationInterface $validationInterface,
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
