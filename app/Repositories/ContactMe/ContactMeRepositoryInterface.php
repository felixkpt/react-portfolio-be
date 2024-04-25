<?php

namespace  App\Repositories\ContactMe;

use App\Repositories\CommonRepoActionsInterface;
use Illuminate\Http\Request;

interface ContactMeRepositoryInterface extends CommonRepoActionsInterface
{

    public function index();

    public function store(Request $request, $data);
}
