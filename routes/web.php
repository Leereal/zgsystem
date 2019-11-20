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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('branches', 'BranchController')->middleware('accesslevel:System Admin,Principal Officer, Chairman');

//Route::patch('/users/approve', 'SettingController@approveUser')->name('approve');
Route::get('/users/change/{id}', 'UserController@changeStatus')->name('changeStatus');

Route::resource('users', 'UserController')->middleware('accesslevel:System Admin,Principal Officer, Chairman');

Route::resource('banks', 'BankController');

Route::resource('categories', 'CategoryController');

Route::resource('files', 'FileController');

Route::resource('groups', 'GroupController');

Route::resource('mops', 'MOPController');

Route::resource('plans', 'PlanController');

Route::resource('tariffs', 'TariffController');

Route::get('/clients/dependents/{id}/profile', 'DependentController@profile');

Route::get('/clients/dependents/view/{id}', 'DependentController@view')->name('view');

Route::get('clients/dependents/{id}', ['middleware' => 'auth','as' => 'create','uses' => 'DependentController@create']);

Route::resource('clients/dependents', 'DependentController');

Route::resource('service_providers', 'ServiceProviderController');

Route::resource('clients', 'ClientController');

Route::resource('requests', 'RequestController');

//Route::view('/payments/receipt', 'payments.receipt', ['name' => 'libert']);
Route::get('/payments/reversed', 'PaymentController@reversed');

Route::get('/payments/view/{id}', 'PaymentController@view')->name('viewpayments');

Route::get('/payments/receipt/{rec_num}', 'PaymentController@receipt')->name('receipt');

Route::resource('payments', 'PaymentController');

Route::post('/claims/requestcheckclient/{id}', 'ClaimController@requestCheckClient')->name('requestCheckClient');

Route::post('/claims/requestcheckdependent/{id}', 'ClaimController@requestCheckDependent')->name('requestCheckDependent');

Route::get('/claims/viewclients', 'ClaimController@viewclients')->name('viewclients');

Route::get('claims/{id}', ['middleware' => 'auth','as' => 'create','uses' => 'ClaimController@create']);

Route::resource('claims', 'ClaimController');

//Route::get('/help', 'HomeController@help')->name('help');

//This route directs to locking of the system
Route::get('/lock', 'HomeController@lock')->name('lock');

Route::resource('test', 'TestController');

Route::get('/settings', 'SettingController@index')->name('settings');

Route::patch('/settings/update', 'SettingController@updateStatus')->name('updateStatus');

Route::get('/settings/backupdb', 'SettingController@backupDb')->name('backupdb');
Route::get('serviceprovider', 'SPController@index');

