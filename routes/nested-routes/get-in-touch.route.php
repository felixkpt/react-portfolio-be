<?php

use App\Http\Controllers\GetInTouch\GetInTouchController;
use Illuminate\Support\Facades\Route;

$controller = GetInTouchController::class;

Route::get('/', [$controller, 'index'])->name('Get in touch')->everyone(true)->public(true);
Route::post('/', [$controller, 'store'])->name('Create get in touch')->hidden();

// view single 
Route::get('/view/{id}', [$controller, 'show'])->hidden();
Route::put('/view/{id}', [$controller, 'update'])->hidden();
Route::patch('/view/{id}/update-status', [$controller, 'updateStatus'])->hidden();
Route::delete('/view/{id}', [$controller, 'destroy'])->hidden();
