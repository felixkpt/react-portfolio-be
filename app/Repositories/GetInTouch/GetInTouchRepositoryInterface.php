<?php

namespace  App\Repositories\GetInTouch;

use App\Repositories\CommonRepoActionsInterface;
use Illuminate\Http\Request;

interface GetInTouchRepositoryInterface extends CommonRepoActionsInterface
{

    public function index();

    public function store(Request $request, $data);
}
