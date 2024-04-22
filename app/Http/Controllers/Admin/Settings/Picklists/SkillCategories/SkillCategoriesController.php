<?php

namespace App\Http\Controllers\Admin\Settings\Picklists\SkillCategories;

use App\Http\Controllers\CommonControllerMethods;
use App\Http\Controllers\Controller;

use App\Repositories\SkillCategory\SkillCategoryRepositoryInterface;
use App\Services\Validations\SkillCategory\SkillCategoryValidationInterface;
use Illuminate\Http\Request;

class SkillCategoriesController extends Controller
{

    use CommonControllerMethods;

    function __construct(
        protected SkillCategoryRepositoryInterface $repo,
        protected SkillCategoryValidationInterface $validationInterface,
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
