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
Route::middleware('sessions')->get('/session/all', function(Request $request){
    return $request->session()->all();
});
Route::middleware('sessions')->get('/session/clear', function(Request $request){
    $request->session()->flush();
    return $request->session()->all();
});
Route::namespace('Api')->middleware('sessions')->group(function (){
    Route::prefix('auth')->group(function(){
        Route::post('/send-token', 'Authorizaition@sendToken')->name('token.send');
        Route::post('/verify-token', 'Authorizaition@verifyToken')->name('token.verify');
    });
    Route::middleware('auth:api')->group(function(){
        Route::post('/auth/logout', 'Authorizaition@logout')->name('logout');
        Route::get('/profile', 'Profile@get')->name('profile.get');
        Route::post('/profile', 'Profile@edit')->name('profile.edit');
    });
});