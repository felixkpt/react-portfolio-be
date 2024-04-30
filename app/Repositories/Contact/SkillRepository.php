<?php

namespace App\Repositories\Skill;

use App\Models\Skill;
use App\Repositories\CommonRepoActions;
use App\Repositories\SearchRepo;
use Illuminate\Http\Request;

class SkillRepository implements SkillRepositoryInterface
{

    use CommonRepoActions;

    function __construct(protected Skill $model)
    {
    }

    public function index($id = null)
    {
        $about = $this->model::query()->when(showActiveRecords(), fn($q) => $q->where('status_id', activeStatusId()));

        if ($this->applyFiltersOnly) return $about;

        $uri = '/dashboard/about/';
        $results = SearchRepo::of($about, ['slogan', 'content'])
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
        return response(['type' => 'success', 'message' => 'Skill ' . $action . ' successfully', 'results' => $res]);
    }
}
