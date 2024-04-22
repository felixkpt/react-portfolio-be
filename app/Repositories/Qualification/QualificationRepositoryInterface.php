<?php

namespace  App\Repositories\Qualification;

use App\Repositories\CommonRepoActionsInterface;
use Illuminate\Http\Request;

interface QualificationRepositoryInterface extends CommonRepoActionsInterface
{

    public function index();

    public function store(Request $request, $data);
}
