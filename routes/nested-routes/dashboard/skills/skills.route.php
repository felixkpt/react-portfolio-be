<?php

use App\Http\Controllers\Dashboard\Skills\SkillsController;
use Illuminate\Support\Facades\Route;

$controller = SkillsController::class;

Route::get('/', [$controller, 'index'])->name('Skills');
Route::post('/', [$controller, 'store'])->name('Create Skill')->hidden();
Route::patch('/update-statuses', [$controller, 'updateStatuses'])->hidden(); // Update statuses of multiple records (hidden)

// view single 
Route::get('/view/{id}', [$controller, 'show'])->hidden();
Route::put('/view/{id}', [$controller, 'update'])->hidden();
Route::patch('/view/{id}/update-status', [$controller, 'updateStatus'])->hidden();
Route::delete('/view/{id}', [$controller, 'destroy'])->hidden();
