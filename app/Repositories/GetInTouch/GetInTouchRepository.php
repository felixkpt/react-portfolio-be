<?php

namespace App\Repositories\GetInTouch;

use App\Models\GetInTouch;
use App\Repositories\CommonRepoActions;
use App\Repositories\SearchRepo;
use Illuminate\Http\Request;

class GetInTouchRepository implements GetInTouchRepositoryInterface
{

    use CommonRepoActions;

    function __construct(protected GetInTouch $model)
    {
    }

    public function index($id = null)
    {
        sleep(2);
        $about = $this->model::query()->where('user_id', auth()->id());

        if ($this->applyFiltersOnly) return $about;

        $uri = '/admin/about/';
        $results = SearchRepo::of($about, ['slogan', 'content'])
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
        return response(['type' => 'success', 'message' => 'GetInTouch ' . $action . ' successfully', 'results' => $res]);
    }
}