<?php

use App\Http\Controllers\Admin\Settings\Picklists\GetInTouch\GetInTouchController;
use Illuminate\Support\Facades\Route;

$controller = GetInTouchController::class;
Route::get('/', [$controller, 'index'])->name('List get in touch');
Route::post('/', [$controller, 'store'])->hidden();
