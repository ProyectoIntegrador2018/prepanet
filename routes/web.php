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
    Route::post('/', 'CampusesController@postCampus');
    Route::get('/{campus}', 'CampusesController@getCampus')->name('campus');
    Route::post('/{campus}', 'CampusesController@postEditCampus')->name('update-campus');
    Route::post('/delete/{campus}', 'CampusesController@postDeleteCampus');
});

// Route::group(['prefix' => 'tutores',  'middleware' => 'auth'], function () {
//     Route::get('/', 'SuperAdministratorsController@index')->name('tutores');
//     Route::post('/', 'SuperAdministratorsController@postSuperAdministrator');
//     Route::get('/{superAdministrator}', 'SuperAdministratorsController@getSuperAdministrator')->name('super-administrator');
//     Route::post('/{superAdministrator}', 'SuperAdministratorsController@postEditSuperAdministrator')->name('update-super-administrator');
//     Route::post('/delete/{superAdministrator}', 'SuperAdministratorsController@postDeleteSuperAdministrator');
// });

Route::group(['prefix' => 'super-administrators',  'middleware' => 'auth'], function () {
    Route::get('/', 'SuperAdministratorsController@index')->name('super-administrators');
    Route::post('/', 'SuperAdministratorsController@postSuperAdministrator');
    Route::get('/{superAdministrator}', 'SuperAdministratorsController@getSuperAdministrator')->name('super-administrator');
    Route::post('/{superAdministrator}', 'SuperAdministratorsController@updateSuperAdministrator')->name('update-super-administrator');
    Route::post('/delete/{superAdministrator}', 'SuperAdministratorsController@deleteSuperAdministrator');
});

Route::group(['prefix' => 'gerentes',  'middleware' => 'auth'], function () {
    Route::get('/', 'GerentesController@index')->name('gerentes');
    Route::post('/', 'GerentesController@postGerente');
    Route::get('/{gerente}', 'GerentesController@getGerente')->name('gerente');
    Route::post('/{gerente}', 'GerentesController@updateGerente')->name('update-gerente');
    Route::post('/delete/{gerente}', 'GerentesController@deleteGerente');
});
