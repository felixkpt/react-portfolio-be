<?php

use App\Http\Controllers\Dashboard\Settings\Picklists\SkillCategories\SkillCategoriesController;
use Illuminate\Support\Facades\Route;

$controller = SkillCategoriesController::class;
Route::get('/', [$controller, 'index'])->name('List Skill categories')->public();
Route::post('/', [$controller, 'store'])->hidden();
Route::patch('/update-statuses', [$controller, 'updateStatuses'])->hidden(); // Update statuses of multiple records (hidden)
