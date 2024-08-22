<?php

namespace App\Repositories\Company;

use App\Models\Company;
use App\Repositories\CommonRepoActions;
use App\Repositories\SearchRepo\SearchRepo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CompanyRepository implements CompanyRepositoryInterface
{

    use CommonRepoActions;

    function __construct(protected Company $model) {}

    public function index($id = null)
    {
        request()->merge(['companies' => true]);

        $company = $this->model::query()->with(['skills'])->when(showActiveRecords(), fn($q) => $q->where('status_id', activeStatusId()));

        if ($this->applyFiltersOnly) return $company;

        $uri = '/dashboard/companies/';
        $results = SearchRepo::of($company, ['name', 'url', 'start_date', 'end_date'])
            ->setModelUri($uri)
            ->addColumn('Created_at', 'Created_at')
            ->addColumn('Created_by', 'getUser')
            ->addColumn('Period', fn($q) => Carbon::parse($q->start_date)->format('M Y') . ($q->end_date ? ' - ' . Carbon::parse($q->end_date)->format('M Y') : ''))
            ->addFillable('roles', ['input' => 'textarea'], 'start_date')
            ->addFillable('achievements', ['input' => 'textarea',], 'skills')
            ->addFillable('skill_ids', ['input' => 'select', 'multiples' => true], 'start_date')
            ->orderBy('start_date', 'desc');

        $results = $id ? $results->first() : $results->paginate();

        return response(['results' => $results]);
    }

    public function store(Request $request, $data)
    {
        $res = $this->autoSave($data);

        if (request()->skill_ids) {

            // Detach all existing skills
            $res->skills()->detach();

            // Attach the new skills
            $res->skills()->attach(request()->skill_ids);
        }
        
        $action = 'created';
        if ($request->id)
            $action = 'updated';
        return response(['type' => 'success', 'message' => 'Company ' . $action . ' successfully', 'results' => $res]);
    }
}
