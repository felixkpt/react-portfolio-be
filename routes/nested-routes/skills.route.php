<?php

use App\Http\Controllers\Dashboard\Skills\SkillsController;
use Illuminate\Support\Facades\Route;

$controller = SkillsController::class;

Route::get('/', [$controller, 'index'])->name('Skills')->everyone(true)->public(true)->position(8);
