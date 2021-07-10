<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\RunnerController;
use App\Http\Controllers\ClassificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('races', [RaceController::class, 'store'])->name('races.store');
Route::post('races/subscribe', [RaceController::class, 'subscribe'])->name('races.subscribe');

Route::post('runners', [RunnerController::class, 'store'])->name('runners.store');

Route::get('classifications', [ClassificationController::class, 'get'])->name('classifications.get');
Route::post('classifications', [ClassificationController::class, 'store'])->name('classifications.store');
