<?php

use App\Http\Controllers\Skills\SkillsController;
use Illuminate\Support\Facades\Route;

$controller = SkillsController::class;

Route::get('/', [$controller, 'index'])->name('Skills')->everyone(true);
Route::any('/create-or-update', [$controller, 'store'])->name('Modify Skills')->hidden();
