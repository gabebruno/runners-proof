<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\RunnerController;

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
Route::get('races', [RaceController::class, 'index'])->name('races.index');
Route::post('races/subscribe', [RaceController::class, 'subscribe'])->name('races.subscribe');

Route::post('runners', [RunnerController::class, 'store'])->name('runners.store');
Route::get('runners', [RunnerController::class, 'index'])->name('runners.index');

Route::get('classifications', [RunnerController::class, 'index'])->name('classifications.index');
Route::post('classifications', [RunnerController::class, 'store'])->name('classifications.store');
