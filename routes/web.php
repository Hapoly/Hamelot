<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth', 'Permission'])->namespace('Panel')->prefix('panel')->name('panel.')->group(function(){
    Route::resources([
        'hospitals'         => 'Hospitals',
        'policlinics'       => 'Policlinics',
        'clinics'           => 'Clinics',
        'clinics'           => 'Clinics',
        'departments'       => 'Departments',
        'report_templates'  => 'ReportTemplates',
        'experiments'       => 'Experiments',
    ]);

    Route::prefix('print')->name('prints.')->group(function(){
        Route::get('/hospitals', 'Prints@hospitals')->name('hospitals');
    });
    Route::prefix('permissions')->name('permissions.')->group(function(){
        Route::get('/create', 'Permissions@create')->name('create');
        Route::post('/check', 'Permissions@check')->name('check');
        Route::post('/send/{user}', 'Permissions@send')->name('send');
        
        Route::get('/show/{permission}', 'Permissions@show')->name('show');

        Route::post('/edit/{permission}', 'Permissions@inlineUpdate')->name('inline_update');

        Route::get('/', 'Permissions@index')->name('index');
        Route::get('/destroy/{permissions}', 'Permissions@destroy')->name('destroy');
    });
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
    Route::prefix('unit-users')->name('unit_users.')->group(function(){
        Route::get('/create-policlinic-manager', 'UnitUsers@createPoloclinicManager')->name('create_policlinic_manager');
        Route::get('/create-policlinic-member', 'UnitUsers@createPoloclinicMember')->name('create_policlinic_member');
        Route::get('/create-department-member', 'UnitUsers@createDepartmentMember')->name('create_department_member');
        Route::get('/create-hospital-manager', 'UnitUsers@createHospitalManager')->name('create_hospital_manager');
        Route::post('/store', 'UnitUsers@store')->name('store');

        Route::get('/send-department/{user}/{department}', 'UnitUsers@sendDepartment')->name('send_department');
        Route::get('/send-policlinic/{user}/{policlinic}', 'UnitUsers@sendPoliclinic')->name('send_policlinic');
        Route::get('/', 'UnitUsers@index')->name('index');
        
        Route::get('/show/{unit_user}', 'UnitUsers@show')->name('show');

        Route::post('/update-inline/{unit_user}', 'UnitUsers@inlineUpdate')->name('inline_update');

        Route::get('/', 'UnitUsers@index')->name('index');
        Route::get('/destroy/{unit_users}', 'UnitUsers@destroy')->name('destroy');
    });
    Route::prefix('search')->name('search.')->group(function(){
        Route::get('/patients', 'Search@patients')->name('patients');
        Route::get('/patient-departments', 'Search@departmentsOfPatient')->name('patient-departments');
        Route::get('/members', 'Search@members')->name('members');
        Route::get('/managers', 'Search@managers')->name('managers');
    });
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
