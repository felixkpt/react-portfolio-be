<?php

use App\Http\Controllers\Dashboard\Projects\ProjectSlides\ProjectSlidesController;
use Illuminate\Support\Facades\Route;

$controller = ProjectSlidesController::class;

Route::get('/', [$controller, 'index'])->name('Project Slides');
Route::post('/', [$controller, 'store'])->name('Create Project Slids')->hidden();
Route::patch('/update-statuses', [$controller, 'updateStatuses'])->hidden(); // Update statuses of multiple records (hidden)

// view single 
Route::get('/view/{id}', [$controller, 'show'])->hidden();
Route::put('/view/{id}', [$controller, 'update'])->hidden();
Route::patch('/view/{id}/update-status', [$controller, 'updateStatus'])->hidden();
Route::delete('/view/{id}', [$controller, 'destroy'])->hidden();
