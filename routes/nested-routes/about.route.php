<?php

use App\Http\Controllers\About\AboutController;
use Illuminate\Support\Facades\Route;

$controller = AboutController::class;

Route::get('/', [$controller, 'index'])->name('About')->everyone(true);
Route::any('/update-or-create', [$controller, 'store'])->name('Update about');
