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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'campuses',  'middleware' => 'auth'], function () {
    Route::get('/', 'CampusesController@index')->name('campuses');
    Route::get('/{campus}', 'CampusesController@getCampus')->name('campus');
    Route::get('/create', 'CampusesController@getCreateCarrier')->name('create-campus');
    Route::post('/create', 'CampusesController@postCreateCarrier')->name('store-campus');
});

