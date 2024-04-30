<?php

namespace App\Repositories;

use App\Services\Filerepo\Controllers\FilesController;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

trait CommonRepoActions
{
    protected $applyFiltersOnly;

    function autoSave($data)
    {
        $id = $data['id'] ?? request()->id;
        $data['id'] = $id;

        if (!$id) {
            $data['user_id'] = auth()->user()->id ?? 0;

            if (!isset($data['status_id'])) {
                $data['status_id'] = activeStatusId();
            }
        }

        $record = $this->model::updateOrCreate(['id' => $id], $data);

        $this->saveModelImage($record);

        return $record;
    }

    function saveModelImage($record)
    {
        if (request()->hasFile('image')) {

            try {
                $uploader = new FilesController();
                $image_data = $uploader->saveFiles($record, [request()->file('image')]);

                if (Schema::hasColumn($record->getTable(), 'image')) {
                    $path = $image_data[0]['path'] ?? null;
                    $record->image = $path;
                    $record->save();
                }
            } catch (Exception $e) {
                Log::critical('saveModelImage error: ' . $e->getMessage());
            }
        }
    }

    function updateStatus($id)
    {
        request()->validate(['status_id' => 'required']);

        $status_id = request()->status_id;
        $this->model::find($id)->update(['status_id' => $status_id]);
        return response(['message' => "Status updated successfully."]);
    }

    function updateStatuses(Request $request)
    {

        $this->applyFiltersOnly = true;

        $filteredModel = method_exists($this, 'index') ? $this->index() : $this->model;

        request()->validate(['status_id' => 'required']);

        $msg = 'No record was updated.';
        $builder = $filteredModel->where('status_id', '!=', request()->status_id);

        $arr = ['status_id' => request()->status_id];
        $ids = $request->ids;

        if ($ids) {
            if ($ids == 'all') {
                $builder->update($arr);
                $msg = 'All records statuses updated.';
            } else {
                $ids = json_decode($ids);

                $builder->whereIn('id', $ids)->update($arr);
                $msg = count($ids) . ' records statuses updated.';
            }
        }

        return response(['message' => $msg]);
    }

    function destroy($id)
    {
        $this->model::find($id)->delete();
        return response(['message' => "Record deleted successfully."]);
    }
}
