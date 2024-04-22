<?php

use App\Http\Controllers\Companies\CompaniesController;
use Illuminate\Support\Facades\Route;

$controller = CompaniesController::class;
Route::get('/{id}', [$controller, 'show'])->hidden();
Route::put('/{id}', [$controller, 'update'])->hidden();
Route::patch('/{id}/update-status', [$controller, 'updateStatus'])->hidden();
Route::delete('/{id}', [$controller, 'destroy'])->hidden();
