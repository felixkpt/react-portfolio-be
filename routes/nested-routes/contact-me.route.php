<?php

use App\Http\Controllers\ContactMe\ContactMeController;
use Illuminate\Support\Facades\Route;

$controller = ContactMeController::class;

Route::get('/', [$controller, 'index'])->name('Contact Me')->public(true);
Route::post('/', [$controller, 'store'])->name('Create message')->hidden()->public(true);

// view single 
Route::get('/view/{id}', [$controller, 'show'])->hidden();
Route::put('/view/{id}', [$controller, 'update'])->hidden();
Route::patch('/view/{id}/update-status', [$controller, 'updateStatus'])->hidden();
Route::delete('/view/{id}', [$controller, 'destroy'])->hidden();
