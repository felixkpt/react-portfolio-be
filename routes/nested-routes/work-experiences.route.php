<?php

use App\Http\Controllers\WorkExperiences\WorkExperiencesController;
use Illuminate\Support\Facades\Route;

$controller = WorkExperiencesController::class;

Route::get('/', [$controller, 'index'])->name('Work Experiences')->everyone(true)->public(true)->position(3);
