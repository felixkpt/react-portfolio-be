<?php

use App\Http\Controllers\Dashboard\Qualifications\QualificationsController;
use Illuminate\Support\Facades\Route;

$controller = QualificationsController::class;

Route::get('/', [$controller, 'index'])->name('Qualifications')->everyone(true)->public(true)->position(10);
