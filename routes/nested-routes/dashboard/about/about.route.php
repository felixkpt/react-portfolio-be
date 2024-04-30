<?php

use App\Http\Controllers\About\AboutController;
use Illuminate\Support\Facades\Route;

$controller = AboutController::class;

Route::get('/', [$controller, 'index'])->name('About');
Route::any('/create-or-update/{id?}', [$controller, 'store'])->name('Create/update About')->hidden();
