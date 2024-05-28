<?php

namespace App\Repositories\SkillCategory;

use App\Models\SkillCategory;
use App\Repositories\CommonRepoActions;
use App\Repositories\SearchRepo\SearchRepo;
use Illuminate\Http\Request;

class SkillCategoryRepository implements SkillCategoryRepositoryInterface
{

    use CommonRepoActions;

    function __construct(protected SkillCategory $model)
    {
    }

    public function index($id = null)
    {
        $skillcategories = $this->model::query()->when(showActiveRecords(), fn($q) => $q->where('status_id', activeStatusId()))
        ->with(['skills']);

        if ($this->applyFiltersOnly) return $skillcategories;

        $uri = '/dashboard/settings/picklists/skill-categories/';
        $results = SearchRepo::of($skillcategories, ['name'])
            ->addColumn('Created_at', 'Created_at')
            ->addColumn('Created_by', 'getUser')
            ->addColumn('Status', 'getStatus')
            ->addActionColumn('action', $uri, ['view' => 'native'])
            ->htmls(['Status'])
            ->orderBy('priority');

        $results = $id ? $results->first() : $results->paginate();

        return response(['results' => $results]);
    }

    public function store(Request $request, $data)
    {

        $res = $this->autoSave($data);

        $action = 'created';
        if ($request->id)
            $action = 'updated';
        return response(['type' => 'success', 'message' => 'SkillCategory ' . $action . ' successfully', 'results' => $res]);
    }
}
