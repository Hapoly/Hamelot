<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth'])->namespace('Panel')->prefix('panel')->name('panel.')->group(function(){
    Route::resources([
        'hospitals'         => 'Hospitals',
        'departments'       => 'Departments',
        'patients'          => 'Patients',
        'reports'           => 'Reports',
        'tests'              => 'Tests',
        'templates'         => 'Templates',
        'keys'              => 'Keys',

        'hospital_users'    => 'HospitalUsers',
        'department_users'  => 'DepartmentUsers',
    ]);
    Route::prefix('users')->name('users.')->group(function(){
        Route::get('/', 'Users@index')->name('index');
        Route::get('/{user}', 'Users@show')->name('show');
        Route::get('/{user}/edit', 'Users@edit')->name('edit');
        Route::get('/{user}/delete', 'Users@destroy')->name('destroy');

        Route::prefix('create')->name('create.')->group(function(){
            Route::get('/admin', 'Users@createAdmin')->name('admin');
            Route::get('/manager', 'Users@createManager')->name('manager');
            Route::get('/doctor', 'Users@createDoctor')->name('doctor');
            Route::get('/nurse', 'Users@createNurse')->name('nurse');
            Route::get('/patient', 'Users@createPatient')->name('patient');
        });
        Route::prefix('store')->name('store.')->group(function(){
            Route::post('/admin', 'Users@storeAdmin')->name('admin');
            Route::post('/manager', 'Users@storeManager')->name('manager');
            Route::post('/doctor', 'Users@storeDoctor')->name('doctor');
            Route::post('/nurse', 'Users@storeNurse')->name('nurse');
            Route::post('/patient', 'Users@storePatient')->name('patient');
        });
        Route::prefix('update/{user}')->name('update.')->group(function(){
            Route::post('/admin', 'Users@updateAdmin')->name('admin');
            Route::post('/manager', 'Users@updateManager')->name('manager');
            Route::post('/doctor', 'Users@updateDoctor')->name('doctor');
            Route::post('/nurse', 'Users@updateNurse')->name('nurse');
            Route::post('/patient', 'Users@updatePatient')->name('patient');
        });
    });
    Route::get('/test', function(){
        return view('test');
    })->name('test');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
