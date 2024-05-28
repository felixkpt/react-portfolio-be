<?php

namespace  App\Repositories\Project\ProjectSlide;

use App\Repositories\CommonRepoActionsInterface;
use Illuminate\Http\Request;

interface ProjectSlideRepositoryInterface extends CommonRepoActionsInterface
{

    public function index();

    public function store(Request $request, $data);

    public function show($id);
}
