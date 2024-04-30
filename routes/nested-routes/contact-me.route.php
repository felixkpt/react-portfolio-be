<?php

use App\Http\Controllers\ContactMe\ContactMeController;
use Illuminate\Support\Facades\Route;

$controller = ContactMeController::class;

Route::get('/', [$controller, 'index'])->name('Contact Me')->public(true)->position(999);
Route::post('/', [$controller, 'store'])->name('Create message')->hidden()->public(true)->position(999);