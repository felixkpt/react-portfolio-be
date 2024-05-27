<?php

namespace App\Repositories\PostStatus;

use App\Models\PostStatus;
use App\Repositories\CommonRepoActions;
use App\Repositories\SearchRepo\SearchRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostStatusRepository implements PostStatusRepositoryInterface
{
    use CommonRepoActions;

    private $checked_permissions = [];

    function __construct(protected PostStatus $model)
    {
    }

    public function index()
    {

        $statuses = $this->model::query()->when(showActiveRecords(), fn($q) => $q->where('status_id', activeStatusId()));

        if ($this->applyFiltersOnly) return $statuses;

        $uri = '/dashboard/settings/picklists/statuses/post/';
        $statuses = SearchRepo::of($statuses, ['id', 'name'])
            ->addColumn('Created_by', 'getUser')
            ->addColumn('Created_at', 'Created_at')
            ->addColumn('Icon', function ($q) {
                return '<div class="d-flex align-items-center"><iconify-icon icon="' . $q->icon . '" class="' . $q->class . ' me-1"></iconify-icon>' . Str::ucfirst(Str::replace('_', ' ', $q->name)) . '</div>';
            })
            ->addColumn('action', fn ($q) => call_user_func('actionLinks', $q, $uri, 'modal', 'modal', 'update-status'))
            ->htmls(['Icon'])
            ->paginate();

        return response(['results' => $statuses]);
    }

    public function store(Request $request, $data)
    {

        $res = $this->autoSave($data);

        $action = 'created';
        if ($request->id)
            $action = 'updated';

        return response(['type' => 'success', 'message' => 'PostStatus ' . $action . ' successfully', 'results' => $res]);
    }

    public function show($id)
    {
        $status = $this->model::findOrFail($id);
        return response(['results' => $status]);
    }
}
