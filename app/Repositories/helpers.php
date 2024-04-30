<?php

use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;

if (!function_exists('currentUser')) {

    function currentUser()
    {
        $user = request()->user();

        if (!$user) {
            // Fetch the associated token Model
            $token = PersonalAccessToken::findToken(request()->bearerToken() ?? request()->token);

            // Get the assigned user
            $user = $token ? User::find($token->tokenable)->first() : null;
        }

        return $user;
    }
}

if (!function_exists('defaultColumns')) {

    function defaultColumns($model)
    {

        if (Schema::hasColumn($model->getTable(), 'user_id') && !$model->user_id)
            $model->user_id = auth()->id() ?? 0;

        if (Schema::hasColumn($model->getTable(), 'status_id') && !$model->status_id)
            $model->status_id = activeStatusId();

        if (Schema::hasColumn($model->getTable(), 'uuid') && !$model->uuid)
            $model->uuid = Str::uuid();


        return true;
    }
}

if (!function_exists('wasCreated')) {

    function wasCreated($model)
    {
        return !$model->wasRecentlyCreated && $model->wasChanged() ? true : false;
    }
}

if (!function_exists('respond')) {

    function respond($content, $status = 200, $type = 'json', $view = '', $headers = [])
    {

        if ($type == 'json' || request()->wantsJson())
            $res = response()->json($content, $status);
        elseif ($type == 'array')
            return $content;
        else if ($type == 'view')
            $res = view($view, $content);
        else
            $res = response($content, $status);

        return $res->withHeaders($headers);
    }
}

if (!function_exists('Created_at')) {
    function created_at($q)
    {
        return $q->created_at->diffForHumans();
    }
}

if (!function_exists('Created_by')) {
    function Created_by($q)
    {
        return getUser($q);
    }
}

if (!function_exists('getStatus')) {
    function getStatus($q)
    {
        $status = $q->status()->first();
        if ($status) {
            return '<div class="d-flex align-items-center"><iconify-icon icon="' . $status->icon . '" class="' . $status->class . ' me-1"></iconify-icon>' . Str::ucfirst(Str::replace('_', ' ', $status->name)) . '</div>';
        } else return null;
    }
}

if (!function_exists('getUser')) {
    function getUser($q)
    {
        $username = $q->user->name ?? 'System';
        return $username;
    }
}

if (!function_exists('actionLinks')) {
    function actionLinks($q, $uri, $view = 'modal', $edit = 'modal', $hide = null)
    {

        $a = '<li><a class="dropdown-item autotable-' . ($view === 'modal' ? 'modal-view' : 'navigate') . '" data-id="' . $q->id . '" href="' . $uri . 'view/' . $q->id . '">View</a></li>';
        $b = '<li><a class="dropdown-item autotable-' . ($edit === 'modal' ? 'modal-edit' : 'edit') . '" data-id="' . $q->id . '" href="' . $uri . 'view/' . $q->id . '/edit">Edit</a></li>';
        $c = (!preg_match('#update-status#', $hide) ? '<li><a class="dropdown-item autotable-update-status" data-id="' . $q->id . '" href="' . $uri . 'view/' . $q->id . '/update-status">Status update</a></li>' : '');

        $str = $a . $b . $c;

        return '
        <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="icon icon-list2 font-20"></i>
        </button>
        <ul class="dropdown-menu">
        ' . $str . '
        </ul>
        </div>
        ';
    }
}

if (!function_exists('activeStatusId')) {
    function activeStatusId()
    {
        return Status::where('name', 'active')->first()->id ?? 0;
    }
}

if (!function_exists('showActiveRecords')) {
    function showActiveRecords()
    {
        return request()->status == 1 || request()->status == null;
    }
}

if (!function_exists('inActiveStatusId')) {
    function inActiveStatusId()
    {
        return Status::where('name', 'in_active')->first()->id ?? 0;
    }
}

if (!function_exists('getUriFromUrl')) {
    function getUriFromUrl($url)
    {
        // Parse the URL to get its components
        $parsedUrl = parse_url($url);

        // Extract the path from the parsed URL
        $path = isset($parsedUrl['path']) ? $parsedUrl['path'] : '';

        return $path;
    }
}

if (!function_exists('is_connected')) {
    function is_connected()
    {
        try {
            fopen("http://www.google.com:80/", "r");
            return true;
        } catch (Exception $e) {
            Log::critical('Internet connectivity issue: ' . $e->getMessage());
            return false;
        }
    }
}
