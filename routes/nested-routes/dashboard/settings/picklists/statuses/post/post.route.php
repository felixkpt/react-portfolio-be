<?php

use App\Http\Controllers\Dashboard\Settings\Picklists\Statuses\PostStatusesController;
use Illuminate\Support\Facades\Route;

$controller = PostStatusesController::class;
Route::get('/', [$controller, 'index'])->name('List Post statuses');
Route::post('/', [$controller, 'store'])->name('Store Post status')->hidden();
