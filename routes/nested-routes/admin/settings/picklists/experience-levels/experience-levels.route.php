<?php

use App\Http\Controllers\Admin\Settings\Picklists\ExperienceLevels\ExperienceLevelsController;
use Illuminate\Support\Facades\Route;

$controller = ExperienceLevelsController::class;
Route::get('/', [$controller, 'index'])->name('List ExperienceLevels');
Route::post('/', [$controller, 'store'])->hidden();
