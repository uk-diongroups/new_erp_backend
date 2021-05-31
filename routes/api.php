<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('App\Http\Controllers\HR')->group(function () {
    Route::post('store/evaluation', 'MonthlyEvaluationController@store');
    Route::post('update/evaluation', 'MonthlyEvaluationController@update');
    Route::delete('delete/evaluation/{data}', 'MonthlyEvaluationController@destroy');
});

// Route::post('store/evaluation', 'App\Http\Controllers\HR\MonthlyEvaluationController@store');
// Route::post('update/evaluation', 'App\Http\Controllers\HR\MonthlyEvaluationController@update');
// Route::delete('delete/evaluation/{data}', 'App\Http\Controllers\HR\MonthlyEvaluationController@destroy');