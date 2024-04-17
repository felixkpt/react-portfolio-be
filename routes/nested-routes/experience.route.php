<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

$controller = HomeController::class;

Route::get('/', [$controller, 'index'])->name('Experience')->everyone(true);
