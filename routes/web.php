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

Route::middleware(['auth'])->namespace('Panel')->prefix('panel')->name('panel.')->group(function () {
  Route::resources([
    'units' => 'Units',
    'report_templates' => 'ReportTemplates',
    'field_templates' => 'FieldTemplates',
    'experiments' => 'Experiments',
    'addresses' => 'Addresses',
    'activity-times' => 'ActivityTimes',
    'off-times' => 'OffTimes',
    'bids' => 'Bids',
    'bank-accounts' => 'BankAccounts',
  ]);
  Route::prefix('report-fields')->name('report_fields.')->group(function(){
    Route::get('remove/{report_field}', 'ReportTemplates@removeField')->name('remove');
  });
  Route::get('/activity-times/create/visit', 'ActivityTimes@createVisit')->name('activity-times.create_visit');
  Route::prefix('units')->name('units.')->group(function () {
    Route::get('/create/clinic', 'Units@createClinic')->name('create.clinic');
  });
  Route::prefix('prints')->name('prints.')->namespace('Prints')->group(function () {
    Route::prefix('units')->name('units.')->group(function () {
      Route::get('/', 'Units@units')->name('index');
      Route::get('/members/{unit}', 'Units@unitMembers')->name('members');
      Route::get('/sub-units/{unit}', 'Units@subUnits')->name('sub_units');
      Route::get('/info/{unit}', 'Units@unitInfo')->name('info');
      Route::get('/experiments/{unit}', 'Units@experiments')->name('experiments');
    });
    Route::prefix('users')->name('users.')->group(function () {
      Route::get('/', 'Users@users')->name('index');
      Route::get('/info/{user}', 'Users@userInfo')->name('info');
      Route::get('/experiments', 'Users@experiments')->name('experiments');
      Route::get('/patients/{user}', 'Users@patients')->name('patients');
      Route::get('/visitors/{user}', 'Users@visitors')->name('visitors');
      Route::get('/units/{user}', 'Users@units')->name('units');
    });
    Route::prefix('experiments')->name('experiments.')->group(function () {
      Route::get('/{experiment}', 'Experiments@show')->name('show');
      Route::get('/', 'Experiments@index')->name('index');
    });
    Route::prefix('unit-users')->name('unit_users.')->group(function () {
      Route::get('/', 'UnitUsers@index')->name('index');
    });
    Route::prefix('permissions')->name('permissions.')->group(function () {
      Route::get('/', 'Permissions@index')->name('index');
    });
  });
  Route::prefix('permissions')->name('permissions.')->group(function () {
    Route::get('/create', 'Permissions@create')->name('create');
    Route::post('/check', 'Permissions@check')->name('check');
    Route::post('/send/{user}', 'Permissions@send')->name('send');

    Route::get('/show/{permission}', 'Permissions@show')->name('show');

    Route::post('/edit/{permission}', 'Permissions@inlineUpdate')->name('inline_update');

    Route::get('/', 'Permissions@index')->name('index');
    Route::get('/destroy/{permissions}', 'Permissions@destroy')->name('destroy');
  });
  Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', 'Users@index')->name('index');
    Route::get('/{user}', 'Users@show')->name('show');
    Route::get('/{user}/edit', 'Users@edit')->name('edit');
    Route::get('/{user}/delete', 'Users@destroy')->name('destroy');

    Route::prefix('create')->name('create.')->group(function () {
      Route::get('/admin', 'Users@createAdmin')->name('admin');
      Route::get('/manager', 'Users@createManager')->name('manager');
      Route::get('/secretary', 'Users@createSecretary')->name('secretary');
      Route::get('/doctor', 'Users@createDoctor')->name('doctor');
      Route::get('/nurse', 'Users@createNurse')->name('nurse');
      Route::get('/patient', 'Users@createPatient')->name('patient');
    });
    Route::prefix('store')->name('store.')->group(function () {
      Route::post('/admin', 'Users@storeAdmin')->name('admin');
      Route::post('/manager', 'Users@storeManager')->name('manager');
      Route::post('/secretary', 'Users@storeSecretary')->name('secretary');
      Route::post('/doctor', 'Users@storeDoctor')->name('doctor');
      Route::post('/nurse', 'Users@storeNurse')->name('nurse');
      Route::post('/patient', 'Users@storePatient')->name('patient');
    });
    Route::prefix('update/{user}')->name('update.')->group(function () {
      Route::post('/admin', 'Users@updateAdmin')->name('admin');
      Route::post('/manager', 'Users@updateManager')->name('manager');
      Route::post('/secretary', 'Users@updateSecretary')->name('secretary');
      Route::post('/doctor', 'Users@updateDoctor')->name('doctor');
      Route::post('/nurse', 'Users@updateNurse')->name('nurse');
      Route::post('/patient', 'Users@updatePatient')->name('patient');
    });
  });
  Route::prefix('unit-users')->name('unit_users.')->group(function () {
    Route::get('/create-manager', 'UnitUsers@createManager')->name('create.manager');
    Route::get('/create-member', 'UnitUsers@createMember')->name('create.member');
    Route::get('/create-secretary', 'UnitUsers@createSecretary')->name('create.secretary');
    Route::post('/store', 'UnitUsers@store')->name('store');

    Route::get('/send/{unit}', 'UnitUsers@send')->name('send');
    Route::get('/show/{unit_user}', 'UnitUsers@show')->name('show');

    Route::get('/update-inline/{unit_user}/{action}', 'UnitUsers@inlineUpdate')->name('inline_update');

    Route::get('/', 'UnitUsers@index')->name('index');
    Route::get('/destroy/{unit_users}', 'UnitUsers@destroy')->name('destroy');
  });
  Route::prefix('search')->name('search.')->group(function () {
    Route::get('/patients', 'Search@patients')->name('patients');
    Route::get('/units', 'Search@units')->name('units');
    Route::get('/members', 'Search@members')->name('members');
    Route::get('/secretaries', 'Search@secretaries')->name('secretaries');
    Route::get('/managers', 'Search@managers')->name('managers');
    Route::get('/joiners', 'Search@joiners')->name('joiners');
    Route::get('/unit-users', 'Search@unitUsers')->name('unit_users');
    Route::get('/users', 'Search@users')->name('users');
    Route::prefix('fields')->name('fields.')->group(function () {
      Route::get('/doctor', 'Search@doctorFields')->name('doctor');
      Route::get('/nurse', 'Search@nurseFields')->name('nurse');
    });
    Route::get('/field-templates', 'Search@fieldTemplates')->name('field_templates');
  });
  Route::prefix('demands')->name('demands.')->group(function () {
    Route::prefix('create')->name('create.')->group(function () {
      Route::get('/free', 'Demands@createFree')->name('free');
      Route::get('/unit-user/{unit}/{user}', 'Demands@createUnitUser')->name('unit_user');
      Route::get('/unit/{unit}', 'Demands@createUnit')->name('unit');
      Route::get('/visit/{activity_time}/{day}', 'Demands@createVisit')->name('visit');
    });
    Route::prefix('store')->name('store.')->group(function () {
      Route::post('/free', 'Demands@storeFree')->name('free');
      Route::post('/unit-user', 'Demands@storeUnitUser')->name('unit_user');
      Route::post('/unit', 'Demands@storeUnit')->name('unit');
      Route::post('/visit/{activity_time}/{day}', 'Demands@storeVisit')->name('visit');
    });
    Route::get('/{demand}', 'Demands@show')->name('show');
    Route::get('/', 'Demands@index')->name('index');
    Route::get('/{demand}/edit', 'Demands@edit')->name('edit');
    Route::post('/{demand}/update', 'Demands@update')->name('update');
  });
  Route::prefix('bids')->name('bids.')->group(function () {
    Route::get('/inline-update/{bid}', 'Bids@inlineUpdate')->name('inline_update');
  });
  Route::prefix('payments')->name('payments.')->group(function () {
    Route::get('/bids-deposit', 'Payments@bidDepositVerify')->name('bids.deposit.verify');
    Route::get('/bids-remain/{finish}', 'Payments@bidRemainVerify')->name('bids.remain.verify');
    Route::get('/factures', 'Payments@factures')->name('factures.verify');
  });
  Route::prefix('transactions')->name('transactions.')->group(function () {
    Route::get('/', 'Transactions@index')->name('index');
    Route::get('/{transaction}', 'Transactions@show')->name('show');
    Route::get('/destroy/{transaction}', 'Transactions@destroy')->name('destroy');
    Route::prefix('create')->name('create.')->group(function () {
      Route::get('/free', 'Transactions@createFree')->name('free');
      Route::get('/withdraw', 'Transactions@createWithdraw')->name('withdraw');
    });
    Route::prefix('factures')->name('factures.')->group(function () {
      Route::get('/index', 'Transactions@facturesIndex')->name('index');
      Route::get('/live/{unit}', 'Transactions@facturesLive')->name('live');
      Route::get('/pay/{unit}', 'Transactions@facturesPay')->name('pay');
    });
    Route::prefix('store')->name('store.')->group(function () {
      Route::post('/free', 'Transactions@storeFree')->name('free');
      Route::post('/withdraw', 'Transactions@storeWithdraw')->name('withdraw');
    });
    Route::prefix('edit')->name('edit.')->group(function () {
      Route::get('/free/{transaction}', 'Transactions@editFree')->name('free');
      Route::get('/withdraw/{transaction}', 'Transactions@editWithdraw')->name('withdraw');
    });
    Route::prefix('update')->name('update.')->group(function () {
      Route::put('/free/{transaction}', 'Transactions@updateFree')->name('free');
      Route::put('/withdraw/{transaction}', 'Transactions@updateWithdraw')->name('withdraw');
    });
    Route::prefix('pay-off')->name('pay_off.')->group(function () {
      Route::get('/list', 'Transactions@payList')->name('index');
      Route::get('/paid/{unit_user}', 'Transactions@paid')->name('paid');
    });
  });
  Route::get('/profile', 'Profile@edit')->name('profile');
  Route::prefix('profile')->name('profile.')->group(function () {
    Route::post('/admin', 'Profile@updateAdmin')->name('admin');
    Route::post('/manager', 'Profile@updateManager')->name('manager');
    Route::post('/doctor', 'Profile@updateDoctor')->name('doctor');
    Route::post('/nurse', 'Profile@updateNurse')->name('nurse');
    Route::post('/patient', 'Profile@updatePatient')->name('patient');
    Route::post('/secretary', 'Profile@updateSecretary')->name('secretary');
  });
});

// auth routes
// Auth::routes();
Route::middleware('guest')->group(function () {
  Route::get('/login', 'AuthController@login')->name('login');
  Route::get('/send-token', 'AuthController@sendToken')->name('send');
  Route::get('/token', 'AuthController@token')->name('token');
  Route::post('/check', 'AuthController@check')->name('check');
});

Route::post('/logout', 'AuthController@logout')->name('logout');
Route::middleware('auth')->group(function () {
  Route::get('/home', 'HomeController@home')->name('home');
});

Route::prefix('/fields')->name('fields.')->group(function(){
  Route::get('/', 'GeneralController@indexFields')->name('index');
  Route::get('/result', 'GeneralController@resultFields')->name('result');
});

Route::get('/', 'HomeController@index')->name('welcome');
Route::get('/terms', 'HomeController@terms')->name('terms');

Route::get('/about', function () {return view('about');})->name('about');
Route::get('/tour', function () {return view('tour');})->name('tour');
Route::get('/search', 'HomeController@search')->name('search');

Route::get('/user/{username}', 'GeneralController@showUser')->name('show.user');
Route::get('/unit/{key}', 'GeneralController@showUnit')->name('show.unit');
Route::get('/field/{key}', 'GeneralController@showField')->name('show.field');
Route::get('/report/{key}', 'GeneralController@showReport')->name('show.report');

if (env('APP_DEBUG', false)) {
  Route::get('/session/all', 'GeneralController@sessionAll')->name('session.all');
}

// bot payment
Route::get('pay/s', function () {
  return view('payment.successful');
});
Route::get('pay/f', function () {
  return view('payment.fail');
});

// temp online chat
Route::prefix('chat')->name('chat.')->namespace('Chat')->middleware('auth')->group(function(){
  Route::get('info', 'General@info')->name('info');
  Route::get('/new-message', 'General@newMessage')->name('new_message');
  Route::get('/chatroom', function() {
    return view('chat.room');
  });
});