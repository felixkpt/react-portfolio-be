<?php

namespace App\Repositories\Qualification;

use App\Models\Qualification;
use App\Repositories\CommonRepoActions;
use App\Repositories\SearchRepo;
use Illuminate\Http\Request;

class QualificationRepository implements QualificationRepositoryInterface
{

    use CommonRepoActions;

    function __construct(protected Qualification $model)
    {
    }

    public function index($id = null)
    {
        sleep(2);
        $about = $this->model::query();

        if ($this->applyFiltersOnly) return $about;

        $uri = '/admin/about/';
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
        return response(['type' => 'success', 'message' => 'Qualification ' . $action . ' successfully', 'results' => $res]);
    }
}
