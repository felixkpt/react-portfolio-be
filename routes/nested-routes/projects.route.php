<?php

use App\Http\Controllers\Projects\ProjectsController;
use Illuminate\Support\Facades\Route;

$controller = ProjectsController::class;

Route::get('/', [$controller, 'index'])->name('Projects')->everyone(true);
Route::any('/create-or-update', [$controller, 'store'])->name('Modify Projects')->hidden();
