<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Qualifications\QualificationsController;
use Illuminate\Support\Facades\Route;

$controller = QualificationsController::class;

Route::get('/', [$controller, 'index'])->name('Qualifications')->everyone(true)->public(true);
Route::post('/', [$controller, 'store'])->name('Create Qualification')->hidden();

// view single 
Route::get('/view/{id}', [$controller, 'show'])->hidden();
Route::put('/view/{id}', [$controller, 'update'])->hidden();
Route::patch('/view/{id}/update-status', [$controller, 'updateStatus'])->hidden();
Route::delete('/view/{id}', [$controller, 'destroy'])->hidden();
