<?php

use Illuminate\Http\Request;

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

Route::namespace('Api')->prefix('auth')->group(function (){
    Route::post('/login', 'Auth@login')->name('login');
    Route::prefix('register')->name('register.')->group(function (){
        Route::post('patient', 'Auth@registerPatient')->name('register');
    });
});
Route::middleware('auth:api')->namespace('Api')->group(function(){
});
// system apis
Route::name('api.panel.')->group(function(){
    Route::post('/units', 'Api\Panel@units')->name('units');
});
