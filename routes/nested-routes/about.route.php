<?php

use App\Http\Controllers\About\AboutController;
use Illuminate\Support\Facades\Route;

$controller = AboutController::class;

Route::get('/', [$controller, 'index'])->name('About')->everyone(true);
Route::any('/create-or-update', [$controller, 'store'])->name('Modify  About')->hidden();
