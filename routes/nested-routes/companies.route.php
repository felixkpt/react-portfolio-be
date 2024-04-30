<?php

use App\Http\Controllers\Dashboard\Companies\CompaniesController;
use Illuminate\Support\Facades\Route;

$controller = CompaniesController::class;

Route::get('/', [$controller, 'index'])->name('Companies')->everyone(true)->hidden()->position(9);
