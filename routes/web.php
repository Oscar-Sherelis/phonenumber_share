<?php

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
    // return view('layouts/welcome');
    return view('main');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/phonenumbers', 'PhonenumbersController@index')->name('phonenumbers');
Route::get('/phonenumbers/edit', 'PhonenumbersController@getPhone');
Route::post('/phonenumbers/delete', 'PhonenumbersController@deletePhonenumber');
Route::post('/phonenumbers/add', 'PhonenumbersController@addPhonenumber');
Route::post('/phonenumbers/edited', 'PhonenumbersController@editPhonenumber');
Route::post('/phonenumbers/share', 'PhonenumberShareController@shareNumber');
Route::post('/phonenumbers/share_add', 'PhonenumberShareController@addShared');
Route::post('/phonenumbers/share_reject', 'PhonenumberShareController@rejectShared');

// Route::get('/phonenumbers', 'PhonenumbersController@phonenumbers');