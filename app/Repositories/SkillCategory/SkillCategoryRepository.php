<?php

namespace App\Repositories\SkillCategory;

use App\Models\SkillCategory;
use App\Repositories\CommonRepoActions;
use App\Repositories\SearchRepo;
use Illuminate\Http\Request;

class SkillCategoryRepository implements SkillCategoryRepositoryInterface
{

    use CommonRepoActions;

    function __construct(protected SkillCategory $model)
    {
    }

    public function index($id = null)
    {
        sleep(2);
        $skillcategories = $this->model::query();

        if ($this->applyFiltersOnly) return $skillcategories;

        $uri = '/admin/skill-categories/';
        $results = SearchRepo::of($skillcategories, ['name'])
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
        return response(['type' => 'success', 'message' => 'SkillCategory ' . $action . ' successfully', 'results' => $res]);
    }
}
