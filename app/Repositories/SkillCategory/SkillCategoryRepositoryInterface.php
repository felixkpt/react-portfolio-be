<?php

namespace  App\Repositories\SkillCategory;

use App\Repositories\CommonRepoActionsInterface;
use Illuminate\Http\Request;

interface SkillCategoryRepositoryInterface extends CommonRepoActionsInterface
{

    public function index();

    public function store(Request $request, $data);
}
