<?php

use App\Http\Controllers\About\AboutController;
use Illuminate\Support\Facades\Route;

$controller = AboutController::class;

Route::get('/', [$controller, 'index'])->name('About');
Route::post('/', [$controller, 'store'])->name('Create About')->hidden();
Route::patch('/update-statuses', [$controller, 'updateStatuses'])->hidden(); // Update statuses of multiple records (hidden)

// view single 
Route::get('/view/{id}', [$controller, 'show'])->hidden();
Route::put('/view/{id}', [$controller, 'update'])->hidden();
Route::patch('/view/{id}/update-status', [$controller, 'updateStatus'])->hidden();
Route::delete('/view/{id}', [$controller, 'destroy'])->hidden();
