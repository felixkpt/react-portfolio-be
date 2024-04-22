<?php

use App\Http\Controllers\WorkExperiences\WorkExperiencesController;
use Illuminate\Support\Facades\Route;

$controller = WorkExperiencesController::class;

Route::get('/', [$controller, 'index'])->name('Work Experiences')->everyone(true)->public(true);
Route::post('/', [$controller, 'store'])->name('Create Work Experience')->hidden();

// view single 
Route::get('/view/{id}', [$controller, 'show'])->hidden();
Route::put('/view/{id}', [$controller, 'update'])->hidden();
Route::patch('/view/{id}/update-status', [$controller, 'updateStatus'])->hidden();
Route::delete('/view/{id}', [$controller, 'destroy'])->hidden();
