<?php

namespace  App\Repositories\WorkExperience;

use App\Repositories\CommonRepoActionsInterface;
use Illuminate\Http\Request;

interface WorkExperienceRepositoryInterface extends CommonRepoActionsInterface
{

    public function index();

    public function store(Request $request, $data);
}
