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
        sleep(2);
        $experiencelevel = $this->model::query()->where('user_id', auth()->id());

        if ($this->applyFiltersOnly) return $experiencelevel;

        $uri = '/admin/settings/picklists/experience-levels/';
        $results = SearchRepo::of($experiencelevel, ['slogan', 'content'])
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
        return response(['type' => 'success', 'message' => 'ExperienceLevel ' . $action . ' successfully', 'results' => $res]);
    }
}
