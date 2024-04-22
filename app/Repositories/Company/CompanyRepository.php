<?php

namespace App\Repositories\Company;

use App\Models\Company;
use App\Repositories\CommonRepoActions;
use App\Repositories\SearchRepo;
use Illuminate\Http\Request;

class CompanyRepository implements CompanyRepositoryInterface
{

    use CommonRepoActions;

    function __construct(protected Company $model)
    {
    }

    public function index($id = null)
    {
        sleep(2);
        $company = $this->model::query()->where('user_id', auth()->id());

        if ($this->applyFiltersOnly) return $company;

        $uri = '/admin/company/';
        $results = SearchRepo::of($company, ['slogan', 'content'])
            ->addColumn('Created_at', 'Created_at')
            ->addColumn('Created_by', 'getUser')
            ->addColumn('Status', 'getStatus')
            ->addActionColumn('action', $uri, 'native')
            ->htmls(['Status']);

        $results = $results->first();

        return response(['results' => $results]);
    }

    public function store(Request $request, $data)
    {
        $res = $this->autoSave($data);

        $action = 'created';
        if ($request->id)
            $action = 'updated';
        return response(['type' => 'success', 'message' => 'Company ' . $action . ' successfully', 'results' => $res]);
    }
}
