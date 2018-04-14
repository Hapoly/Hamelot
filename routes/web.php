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
Route::middleware(['auth', 'IsAdmin'])->namespace('Admin')->prefix('admin')->group(function(){
    Route::resources([
        'users'             => 'Users',

        'hospitals'         => 'Hospitals',
        'departments'       => 'Departments',
        'patients'          => 'Patients',
        'reports'           => 'Reports',

        'templates'         => 'Templates',
        'keys'              => 'Keys',

        'hospital_users'    => 'HospitalUsers',
        'department_users'  => 'DepartmentUsers',
    ]);
});
Route::middleware(['auth', 'IsManager'])->namespace('Manager')->prefix('manager')->group(function(){
    Route::resources([
        'hospitals'         => 'Hospitals',
        'departments'       => 'Departments',
        'patients'          => 'Patients',
        'reports'           => 'Reports',

        'templates'         => 'Templates',
        'keys'              => 'Keys',

        'hospital_users'    => 'HospitalUsers',
        'department_users'  => 'DepartmentUsers',
    ]);
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
