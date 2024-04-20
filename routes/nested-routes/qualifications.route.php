<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Qualifications\QualificationsController;
use Illuminate\Support\Facades\Route;

$controller = QualificationsController::class;

Route::get('/', [$controller, 'index'])->name('Qualifications')->everyone(true);
Route::any('/create-or-update', [$controller, 'store'])->name('Modify Qualifications')->hidden();
