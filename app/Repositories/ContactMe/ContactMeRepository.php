<?php

namespace App\Repositories\ContactMe;

use App\Models\ContactMe;
use App\Models\Message;
use App\Models\Project;
use App\Repositories\CommonRepoActions;
use App\Repositories\SearchRepo\SearchRepo;
use Illuminate\Http\Request;

class ContactMeRepository implements ContactMeRepositoryInterface
{

    use CommonRepoActions;
    protected $model;

    function __construct()
    {
        $this->model = new ContactMe();
    }

    public function index($id = null)
    {
        $projects = $this->model::query()->when(showActiveRecords(), fn ($q) => $q->where('status_id', activeStatusId()))
            ->with(['company', 'skills']);

        if ($this->applyFiltersOnly) return $projects;

        $uri = '/dashboard/about/';

        $results = SearchRepo::of($projects, ['slogan', 'content'])
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
        $this->model = new Message();

        $res = $this->autoSave($data);

        return response(['type' => 'success', 'message' => 'Your message was sent', 'results' => $res]);
    }
}
