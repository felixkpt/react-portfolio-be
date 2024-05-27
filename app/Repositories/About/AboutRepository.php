<?php

namespace App\Repositories\About;

use App\Models\About;
use App\Repositories\CommonRepoActions;
use App\Repositories\SearchRepo\SearchRepo;
use Illuminate\Http\Request;

class AboutRepository implements AboutRepositoryInterface
{

    use CommonRepoActions;

    function __construct(protected About $model)
    {
    }

    public function index($id = null)
    {
        $about = $this->model::query();

        if ($this->applyFiltersOnly) return $about;

        $uri = '/dashboard/about/';
        $create_uri = $uri . 'create-or-update/{id?}';

        $results = SearchRepo::of($about, ['slogan', 'content'])
            ->addColumn('Created_at', 'Created_at')
            ->addColumn('Created_by', 'getUser')
            ->addColumn('Status', 'getStatus')
            ->addActionColumn('action', $uri, ['view' => 'native', 'method' => 'any', 'create_uri' => $create_uri])
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
        return response(['type' => 'success', 'message' => 'About ' . $action . ' successfully', 'results' => $res]);
    }

    public function show($id)
    {
        return $this->index($id);
    }
}
