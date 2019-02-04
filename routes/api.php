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

// chat unit
Route::prefix('chat')->name('chat.')->namespace('Chat')->middleware('auth:api')->group(function () {
  Route::get('info', 'General@info')->name('info');
  Route::prefix('conversations')->name('conversations.')->group(function () {
    Route::post('/createGroup', 'Conversations@createGroup')->name('createGroup');
    Route::post('/createPrivate', 'Conversations@createPrivate')->name('createPrivate');
    Route::post('/createChannel', 'Conversations@createChannel')->name('createChannel');
    Route::post('/edit', 'Conversations@edit')->name('edit');
    Route::post('/remove', 'Conversations@remove')->name('remove');
    Route::get('/list', 'Conversations@list')->name('list');
  });
  Route::prefix('messages')->name('messages.')->group(function(){
    Route::get('/updates', 'Messages@getUpdates')->name('updates');
    Route::prefix('create')->name('create.')->group(function(){
      Route::post('/text', 'Messages@createText')->name('text');
      Route::post('/pic', 'Messages@createPic')->name('pic');
      Route::post('/voice', 'Messages@createVoice')->name('voice');
      Route::post('/video', 'Messages@createVideo')->name('video');
      Route::post('/file', 'Messages@createFile')->name('file');
      Route::post('/action', 'Messages@createAction')->name('action');
    });
    Route::prefix('edit')->name('edit.')->group(function(){
      Route::post('/text', 'Messages@editText')->name('text');
      Route::post('/pic', 'Messages@editPic')->name('pic');
      Route::post('/voice', 'Messages@editVoice')->name('voice');
      Route::post('/video', 'Messages@editVideo')->name('video');
      Route::post('/file', 'Messages@editFile')->name('file');
      Route::post('/action', 'Messages@editAction')->name('action');
    });
    Route::post('/remove', 'Messages@remove')->name('remove');
  });
  Route::prefix('members')->name('members.')->group(function(){
    Route::post('/conversation', 'Members@conversation')->name('conversation');
    Route::post('/count', 'Members@count')->name('count');
    Route::post('/add', 'Members@add')->name('add');
    Route::post('/kick', 'Members@kick')->name('kick');
    Route::post('/modify', 'Members@modify')->name('modify');
  });
});