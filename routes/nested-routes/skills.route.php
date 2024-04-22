<?php

use App\Http\Controllers\Skills\SkillsController;
use Illuminate\Support\Facades\Route;

$controller = SkillsController::class;

Route::get('/', [$controller, 'index'])->name('Skills')->everyone(true)->public(true);
Route::post('/', [$controller, 'store'])->name('Create Skill')->hidden();

// view single 
Route::get('/view/{id}', [$controller, 'show'])->hidden();
Route::put('/view/{id}', [$controller, 'update'])->hidden();
Route::patch('/view/{id}/update-status', [$controller, 'updateStatus'])->hidden();
Route::delete('/view/{id}', [$controller, 'destroy'])->hidden();
