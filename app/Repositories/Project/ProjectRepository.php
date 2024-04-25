<?php

namespace App\Repositories\Project;

use App\Models\Project;
use App\Repositories\CommonRepoActions;
use App\Repositories\SearchRepo;
use Illuminate\Http\Request;

class ProjectRepository implements ProjectRepositoryInterface
{

    use CommonRepoActions;

    function __construct(protected Project $model)
    {
    }

    public function index($id = null)
    {
        sleep(2);
        $projects = $this->model::query()->with(['company', 'skills']);

        if ($this->applyFiltersOnly) return $projects;

        $uri = '/admin/about/';

        $results = SearchRepo::of($projects, ['slogan', 'content'])
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

        if (isset($data['skills']))
            $res->skills()->sync($data['skills']);

        $res = Project::with(['company', 'skills']);

        $action = 'created';
        if ($request->id)
            $action = 'updated';
        return response(['type' => 'success', 'message' => 'Project ' . $action . ' successfully', 'results' => $res]);
    }
}
