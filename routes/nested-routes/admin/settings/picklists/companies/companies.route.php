<?php

use App\Http\Controllers\Companies\CompaniesController;
use Illuminate\Support\Facades\Route;

$controller = CompaniesController::class;
Route::get('/', [$controller, 'index'])->name('List Companies');
Route::post('/', [$controller, 'store'])->hidden();
