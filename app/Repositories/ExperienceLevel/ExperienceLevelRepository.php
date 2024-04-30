<?php

namespace App\Repositories\ExperienceLevel;

use App\Models\ExperienceLevel;
use App\Repositories\CommonRepoActions;
use App\Repositories\SearchRepo;
use Illuminate\Http\Request;

class ExperienceLevelRepository implements ExperienceLevelRepositoryInterface
{

    use CommonRepoActions;

    function __construct(protected ExperienceLevel $model)
    {
    }

    public function index($id = null)
    {
        $experiencelevel = $this->model::query()->when(showActiveRecords(), fn($q) => $q->where('status_id', activeStatusId()));

        if ($this->applyFiltersOnly) return $experiencelevel;

        $uri = '/dashboard/settings/picklists/experience-levels/';
        $results = SearchRepo::of($experiencelevel, ['name'])
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
        return response(['type' => 'success', 'message' => 'ExperienceLevel ' . $action . ' successfully', 'results' => $res]);
    }
}
