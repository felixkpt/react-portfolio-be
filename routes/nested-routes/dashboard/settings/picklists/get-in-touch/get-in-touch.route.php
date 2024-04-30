<?php

use App\Http\Controllers\Dashboard\Settings\Picklists\GetInTouch\GetInTouchController;
use Illuminate\Support\Facades\Route;

$controller = GetInTouchController::class;
Route::get('/', [$controller, 'index'])->name('List get in touch')->public();
Route::post('/', [$controller, 'store'])->hidden();
Route::patch('/update-statuses', [$controller, 'updateStatuses'])->hidden(); // Update statuses of multiple records (hidden)
