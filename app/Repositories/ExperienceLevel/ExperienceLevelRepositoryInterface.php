<?php

namespace  App\Repositories\ExperienceLevel;

use App\Repositories\CommonRepoActionsInterface;
use Illuminate\Http\Request;

interface ExperienceLevelRepositoryInterface extends CommonRepoActionsInterface
{

    public function index();

    public function store(Request $request, $data);
}
