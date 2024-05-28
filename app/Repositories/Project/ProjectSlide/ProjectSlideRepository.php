<?php

namespace App\Repositories\Project\ProjectSlide;

use App\Models\ProjectSlide;
use App\Repositories\CommonRepoActions;
use App\Repositories\SearchRepo\SearchRepo;
use Illuminate\Http\Request;

class ProjectSlideRepository implements ProjectSlideRepositoryInterface
{

    use CommonRepoActions;

    function __construct(protected ProjectSlide $model)
    {
    }

    public function index($id = null)
    {
        $project_slides = $this->model::query()->when(showActiveRecords(), fn ($q) => $q->where('status_id', activeStatusId()))
            ->when($id, fn ($q) => $q->where('id', $id))
            ->with(['project']);

        if ($this->applyFiltersOnly) return $project_slides;

        $uri = '/dashboard/projects/project-slides/';

        $results = SearchRepo::of($project_slides, ['slogan', 'content'])
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

        if (isset($data['skill_ids']))
            $res->skills()->sync($data['skill_ids']);

        $res = ProjectSlide::with(['company', 'skills']);

        $action = 'created';
        if ($request->id)
            $action = 'updated';
        return response(['type' => 'success', 'message' => 'ProjectSlide ' . $action . ' successfully', 'results' => $res]);
    }

    public function show($id)
    {
        return $this->index($id);
    }
}
