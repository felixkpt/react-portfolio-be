<?php

namespace  App\Repositories\Project;

use App\Repositories\CommonRepoActionsInterface;
use Illuminate\Http\Request;

interface ProjectRepositoryInterface extends CommonRepoActionsInterface
{

    public function index();

    public function store(Request $request, $data);

    public function show($id);
}
