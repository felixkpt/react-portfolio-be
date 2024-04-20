<?php

use App\Http\Controllers\Contacts\ContactsController;
use Illuminate\Support\Facades\Route;

$controller = ContactsController::class;

Route::get('/', [$controller, 'index'])->name('Contacts')->everyone(true);
Route::any('/create-or-update', [$controller, 'store'])->name('Modify Contacts')->hidden();
