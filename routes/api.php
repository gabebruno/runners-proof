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

Route::post('race', [RaceController::class, 'store'])->name('race.store');
Route::get('race', [RaceController::class, 'index'])->name('race.index');

Route::post('subscribe', [RaceController::class, 'subscribe'])->name('race.subscribe');

Route::post('runner', [RunnerController::class, 'store'])->name('runner.store');
Route::get('runner', [RunnerController::class, 'index'])->name('runner.index');
