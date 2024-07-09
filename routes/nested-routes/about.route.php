<?php

use App\Http\Controllers\About\AboutController;
use Illuminate\Support\Facades\Route;

$controller = AboutController::class;

Route::get('/view/{id}', [$controller, 'show'])->name('About')->everyone(true)->public(true)->position(2);
