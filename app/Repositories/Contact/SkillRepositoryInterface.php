<?php

namespace  App\Repositories\Skill;

use App\Repositories\CommonRepoActionsInterface;
use Illuminate\Http\Request;

interface SkillRepositoryInterface extends CommonRepoActionsInterface
{

    public function index();

    public function store(Request $request, $data);
}
