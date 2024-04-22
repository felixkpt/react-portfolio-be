<?php

namespace  App\Repositories\Company;

use App\Repositories\CommonRepoActionsInterface;
use Illuminate\Http\Request;

interface CompanyRepositoryInterface extends CommonRepoActionsInterface
{

    public function index();

    public function store(Request $request, $data);
}
