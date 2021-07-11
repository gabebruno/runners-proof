<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\RunnerController;
use App\Http\Controllers\ResultController;
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

Route::post('runners', [RunnerController::class, 'store'])->name('runners.store');

Route::post('races', [RaceController::class, 'store'])->name('races.store');
Route::post('races/subscribe', [RaceController::class, 'subscribe'])->name('races.subscribe');

Route::put('results', [ClassificationController::class, 'registerResults'])->name('classifications.register');

// Route GET supports the folowing query parameters:
// byAge: accepts TRUE or FALSE, any other value will be FALSE for validations;
// perPage: to choose the number of results per page - INTEGER. Default is 25;
Route::get('results', [ResultController::class, 'getClassifications'])->name('classifications.get');

