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
        'units'             => 'Units',
        'report_templates'  => 'ReportTemplates',
        'experiments'       => 'Experiments',
        'addresses'         => 'Addresses',
    ]);

    Route::prefix('prints')->name('prints.')->namespace('Prints')->group(function(){
        Route::prefix('units')->name('units.')->group(function(){
            Route::get('/', 'Units@units')->name('index');
            Route::get('/members/{unit}', 'Units@unitMembers')->name('members');
            Route::get('/sub-units/{unit}', 'Units@subUnits')->name('sub_units');
            Route::get('/info/{unit}', 'Units@unitInfo')->name('info');
            Route::get('/experiments/{unit}', 'Units@experiments')->name('experiments');
        });
        Route::prefix('users')->name('users.')->group(function(){
            Route::get('/', 'Users@users')->name('index');
            Route::get('/info/{user}', 'Users@userInfo')->name('info');
            Route::get('/experiments', 'Users@experiments')->name('experiments');
            Route::get('/patients/{user}', 'Users@patients')->name('patients');
            Route::get('/visitors/{user}', 'Users@visitors')->name('visitors');
            Route::get('/units/{user}', 'Users@units')->name('units');
        });
        Route::prefix('experiments')->name('experiments.')->group(function(){
            Route::get('/{experiment}', 'Experiments@show')->name('show');
            Route::get('/', 'Experiments@index')->name('index');
        });

        Route::prefix('unit-users')->name('unit_users.')->group(function(){
            Route::get('/', 'UnitUsers@index')->name('index');
        });
        Route::prefix('permissions')->name('permissions.')->group(function(){
            Route::get('/', 'Permissions@index')->name('index');
        });
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
        Route::get('/create-manager', 'UnitUsers@createManager')->name('create.manager');
        Route::get('/create-member', 'UnitUsers@createMember')->name('create.member');
        Route::post('/store', 'UnitUsers@store')->name('store');

        Route::get('/send/{unit}', 'UnitUsers@send')->name('send');
        Route::get('/show/{unit_user}', 'UnitUsers@show')->name('show');

        Route::get('/update-inline/{unit_user}/{action}', 'UnitUsers@inlineUpdate')->name('inline_update');
        
        Route::get('/', 'UnitUsers@index')->name('index');
        Route::get('/destroy/{unit_users}', 'UnitUsers@destroy')->name('destroy');
    });
    Route::prefix('search')->name('search.')->group(function(){
        Route::get('/patients', 'Search@patients')->name('patients');
        Route::get('/units', 'Search@units')->name('units');
        Route::get('/members', 'Search@members')->name('members');
        Route::get('/managers', 'Search@managers')->name('managers');
        Route::get('/joiners', 'Search@joiners')->name('joiners');
        Route::get('/unit-users', 'Search@unitUsers')->name('unit_users');
    });
    Route::prefix('demands')->name('demands.')->group(function(){
        Route::prefix('create')->name('create.')->group(function(){
            Route::get('/free', 'Demands@createFree')->name('free');
            Route::get('/unit', 'Demands@createUnit')->name('unit');
            Route::get('/user', 'Demands@createUser')->name('user');
        });
        Route::prefix('store')->name('store.')->group(function(){
            Route::post('/free', 'Demands@storeFree')->name('free');
            Route::post('/unit', 'Demands@storeUnit')->name('unit');
            Route::post('/user', 'Demands@storeUser')->name('user');
        });
        Route::get('/{demand}', 'Demands@show')->name('show');
        Route::get('/', 'Demands@index')->name('index');
    });
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about',function(){
    return view('about');
})->name('about');
Route::get('/tour',function(){
    return view('tour');
})->name('tour');