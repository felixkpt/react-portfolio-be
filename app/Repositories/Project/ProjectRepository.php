<?php

namespace App\Repositories\Project;

use App\Models\Project;
use App\Repositories\CommonRepoActions;
use App\Repositories\SearchRepo\SearchRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProjectRepository implements ProjectRepositoryInterface
{

    use CommonRepoActions;

    function __construct(protected Project $model)
    {
    }

    public function index($id = null)
    {
        $projects = $this->model::query()->when(showActiveRecords(), fn ($q) => $q->where('status_id', activeStatusId()))
            ->when($id, fn ($q) => $q->where('id', $id))
            ->with(['company', 'skills', 'slides']);

        if ($this->applyFiltersOnly) return $projects;

        $uri = '/dashboard/projects/';

        $results = SearchRepo::of($projects, ['slogan', 'content'])
            ->addColumn('Created_at', 'Created_at')
            ->addColumn('Created_by', 'getUser')
            ->addColumn('description_trimmed', fn ($q) => Str::beforeLast(Str::limit($q->description, 600, '**'), '.') . '.')
            ->addColumn('description_trimmed2', fn ($q) => Str::beforeLast(Str::limit($q->description, 220, '**'), '.') . '.')
            ->addColumn('Status', 'getStatus')
            ->addActionColumn('action', $uri, ['view' => 'native'])
            ->addFillable('company_id', ['input' => 'select', 'type' => null], 'description')
            ->addFillable('skill_ids', ['input' => 'multiselect', 'type' => null], 'priority')
            ->addFillable('achievements', ['input' => 'textarea', 'type' => null, 'rows' => 5], 'image')
            ->htmls(['Status']);

        $results = $id ? $results->first() : $results->paginate();

        return response(['results' => $results]);
    }

    public function store(Request $request, $data)
    {
        $res = $this->autoSave($data);

        if (isset($data['skill_ids']))
            $res->skills()->sync($data['skill_ids']);

        $res = Project::with(['company', 'skills']);

        $action = 'created';
        if ($request->id)
            $action = 'updated';
        return response(['type' => 'success', 'message' => 'Project ' . $action . ' successfully', 'results' => $res]);
    }

    public function show($id)
    {
        return $this->index($id);
    }
}
