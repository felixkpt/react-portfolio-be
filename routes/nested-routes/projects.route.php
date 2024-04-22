<?php

use App\Http\Controllers\Projects\ProjectsController;
use Illuminate\Support\Facades\Route;

$controller = ProjectsController::class;

Route::get('/', [$controller, 'index'])->name('Projects')->everyone(true)->public(true);
Route::post('/', [$controller, 'store'])->name('Create Project')->hidden();

// view single 
Route::get('/view/{id}', [$controller, 'show'])->hidden();
Route::put('/view/{id}', [$controller, 'update'])->hidden();
Route::patch('/view/{id}/update-status', [$controller, 'updateStatus'])->hidden();
Route::delete('/view/{id}', [$controller, 'destroy'])->hidden();
