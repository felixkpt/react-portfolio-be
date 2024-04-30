<?php

namespace  App\Repositories\About;

use App\Repositories\CommonRepoActionsInterface;
use Illuminate\Http\Request;

interface AboutRepositoryInterface extends CommonRepoActionsInterface
{

    public function index();

    public function store(Request $request, $data);

    public function show($id);
}
