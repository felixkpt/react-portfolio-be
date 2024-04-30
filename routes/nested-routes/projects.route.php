<?php

use App\Http\Controllers\Dashboard\Projects\ProjectsController;
use Illuminate\Support\Facades\Route;

$controller = ProjectsController::class;

Route::get('/', [$controller, 'index'])->name('Projects')->everyone(true)->public(true)->position(6);

// view single 
Route::get('/view/{id}', [$controller, 'show'])->hidden()->public(true)->position(7);
