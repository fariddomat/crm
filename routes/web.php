<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});
Route::get('/home', function () {
    return redirect()->route('login');
});

// Clear cashe route
Route::get('/clear', function() {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');

    return "Cleared!";

 });

 Route::group(['prefix' => '/admin', 'middleware' => ['auth', ], 'as' => 'admin.'], function () {
    Route::get('/home', 'Admin\HomeController@index')->name('home');
    Route::get('/myProfile', 'Admin\HomeController@myProfile')->name('myProfile');
    Route::post('/updateProfile', 'Admin\HomeController@updateProfile')->name('updateProfile');
    Route::resource('users','Admin\UserController');
    Route::post('ban/{id}', 'Admin\UserController@ban')->name('users.ban');
    Route::post('unban/{id}', 'Admin\UserController@unban')->name('users.unban');
    Route::resource('profiles','Admin\ProfileController');
    Route::resource('tickets','Admin\TicketController');



 });

 Route::group(['prefix' => '/supervisor', 'middleware' => ['auth', ], 'as' => 'supervisor.'], function () {
    Route::get('/home', 'Supervisor\HomeController@index')->name('home');
    Route::get('/myProfile', 'Supervisor\HomeController@myProfile')->name('myProfile');
    Route::post('/updateProfile', 'Supervisor\HomeController@updateProfile')->name('updateProfile');
    Route::resource('profiles','Supervisor\ProfileController');
    Route::resource('users','Supervisor\UserController');
    Route::resource('tickets','Supervisor\TicketController');

 });


 Route::group(['prefix' => '/back_office', 'middleware' => ['auth', ], 'as' => 'back_office.'], function () {
    Route::get('/home', 'BackOffice\HomeController@index')->name('home');
    Route::get('/myProfile', 'BackOffice\HomeController@myProfile')->name('myProfile');
    Route::post('/updateProfile', 'BackOffice\HomeController@updateProfile')->name('updateProfile');



    Route::resource('tickets','BackOffice\TicketController');
    Route::resource('profiles','BackOffice\ProfileController');

 });

 Route::group(['prefix' => '/agent', 'middleware' => ['auth', ], 'as' => 'agent.'], function () {
    Route::get('/home', 'Agent\HomeController@index')->name('home');
    Route::get('/myProfile', 'Agent\HomeController@myProfile')->name('myProfile');
    Route::post('/updateProfile', 'Agent\HomeController@updateProfile')->name('updateProfile');

    Route::resource('tickets','Agent\TicketController');
    Route::post('/specList', 'Agent\TicketController@specList')->name('specList');

    Route::post('/tickets/profile', 'Agent\TicketController@profile')->name('tickets.profile');
    Route::post('/tickets/newTicket', 'Agent\TicketController@newTicket')->name('tickets.newTicket');
    Route::post('/tickets/newTicketOldUser', 'Agent\TicketController@newTicketOldUser')->name('tickets.newTicketOldUser');

    Route::resource('profiles','Agent\ProfileController');


 });

Auth::routes();

