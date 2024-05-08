<?php

use App\Http\Controllers\Resume\ResumeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('resume')->group(function () {
    Route::get('/', [ResumeController::class, 'index']);
    Route::post('/download', [ResumeController::class, 'download']);
});
