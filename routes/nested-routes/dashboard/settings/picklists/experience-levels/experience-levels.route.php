<?php

use App\Http\Controllers\Dashboard\Settings\Picklists\ExperienceLevels\ExperienceLevelsController;
use Illuminate\Support\Facades\Route;

$controller = ExperienceLevelsController::class;
Route::get('/', [$controller, 'index'])->name('List ExperienceLevels');
Route::post('/', [$controller, 'store'])->hidden();
Route::patch('/update-statuses', [$controller, 'updateStatuses'])->hidden(); // Update statuses of multiple records (hidden)
