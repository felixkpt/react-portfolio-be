<?php

namespace App\Repositories\GetInTouch;

use App\Models\GetInTouch;
use App\Repositories\CommonRepoActions;
use App\Repositories\SearchRepo\SearchRepo;
use Illuminate\Http\Request;

class GetInTouchRepository implements GetInTouchRepositoryInterface
{

    use CommonRepoActions;

    function __construct(protected GetInTouch $model)
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
        return response(['type' => 'success', 'message' => 'GetInTouch ' . $action . ' successfully', 'results' => $res]);
    }
}
