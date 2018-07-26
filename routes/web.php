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
Route::middleware(['auth', 'IsAdmin'])->namespace('Panel')->prefix('admin')->name('panel.')->group(function(){
    Route::resources([
        'users'             => 'Users',

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
        Route::prefix('create')->name('create.')->group(function(){
            Route::get('/admin', 'Users@createAdmin')->name('admin');
            Route::get('/manager', 'Users@createManager')->name('manager');
            Route::get('/doctor', 'Users@createDoctor')->name('doctor');
            Route::get('/nurse', 'Users@createNurse')->name('nurse');
            Route::get('/patient', 'Users@createPatient')->name('patient');
        });
    });
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
