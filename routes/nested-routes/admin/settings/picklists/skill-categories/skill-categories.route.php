<?php

use App\Http\Controllers\Admin\Settings\Picklists\SkillCategories\SkillCategoriesController;
use Illuminate\Support\Facades\Route;

$controller = SkillCategoriesController::class;
Route::get('/', [$controller, 'index'])->name('List ExperienceLevels');
Route::post('/', [$controller, 'store'])->hidden();
