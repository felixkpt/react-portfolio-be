<?php

namespace App\Repositories\WorkExperience;

use App\Models\WorkExperience;
use App\Repositories\CommonRepoActions;
use App\Repositories\SearchRepo\SearchRepo;
use Illuminate\Http\Request;

class WorkExperienceRepository implements WorkExperienceRepositoryInterface
{

    use CommonRepoActions;

    function __construct(protected WorkExperience $model)
    {
    }

    public function index($id = null)
    {
        $company = $this->model::query()->when(showActiveRecords(), fn ($q) => $q->where('status_id', activeStatusId()));

        if ($this->applyFiltersOnly) return $company;

        $uri = '/dashboard/company/';
        $results = SearchRepo::of($company, ['slogan', 'content'])
            ->addColumn('Created_at', 'Created_at')
            ->addColumn('Created_by', 'getUser')
            ->addColumn('Status', 'getStatus')
            ->addActionColumn('action', $uri, ['view' => 'native'])
            ->htmls(['Status']);

        $results = $id ? $results->first() : $results->paginate();

        return response(['results' => $results]);
    }

    public function store(Request $request, $data)
    {
        $res = $this->autoSave($data);

        $action = 'created';
        if ($request->id)
            $action = 'updated';
        return response(['type' => 'success', 'message' => 'WorkExperience ' . $action . ' successfully', 'results' => $res]);
    }
}
