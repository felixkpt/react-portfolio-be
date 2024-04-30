<?php

namespace App\Repositories\Company;

use App\Models\Company;
use App\Repositories\CommonRepoActions;
use App\Repositories\SearchRepo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CompanyRepository implements CompanyRepositoryInterface
{

    use CommonRepoActions;

    function __construct(protected Company $model)
    {
    }

    public function index($id = null)
    {
        $company = $this->model::query()->when(showActiveRecords(), fn ($q) => $q->where('status_id', activeStatusId()));

        if ($this->applyFiltersOnly) return $company;

        $uri = '/dashboard/companies/';
        $results = SearchRepo::of($company, ['name', 'url', 'start_date', 'end_date'])
            ->addColumn('Created_at', 'Created_at')
            ->addColumn('Created_by', 'getUser')
            ->addColumn('Status', 'getStatus')
            ->addColumn('Period', fn ($q) => Carbon::parse($q->start_date)->format('M Y') . ($q->end_date ? ' - ' . Carbon::parse($q->end_date)->format('M Y') : ''))
            ->addActionColumn('action', $uri, ['view' => 'native'])
            ->addFillable('roles', 'start_date', ['input' => 'textarea'])
            ->htmls(['Status'])
            ->orderBy('start_date', 'desc');

        $results = $id ? $results->first() : $results->paginate();

        return response(['results' => $results]);
    }

    public function store(Request $request, $data)
    {
        $res = $this->autoSave($data);

        $action = 'created';
        if ($request->id)
            $action = 'updated';
        return response(['type' => 'success', 'message' => 'Company ' . $action . ' successfully', 'results' => $res]);
    }
}
