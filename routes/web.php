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

Route::group(['prefix' => 'tetras',  'middleware' => 'auth'], function () {
    Route::get('/', 'TetrasController@index')->name('tetras');
    Route::post('/', 'TetrasController@postTetra');
    Route::get('/{tetra}', 'TetrasController@getTetra')->name('tetra');
    Route::post('/{tetra}', 'TetrasController@updateTetra')->name('update-tetra');
    Route::post('/delete/{tetra}', 'TetrasController@deleteTetra');
});

Route::group(['prefix' => 'tutores',  'middleware' => 'auth'], function () {
    Route::get('/', 'TutoresController@index')->name('tutores');
    Route::post('/', 'TutoresController@postTutor');
    Route::get('/{tutor}', 'TutoresController@getTutor')->name('tutor');
    Route::post('/{tutor}', 'TutoresController@updateTutor')->name('update-tutor');
    Route::post('/delete/{tutor}', 'TutoresController@deleteTutor');
});

Route::group(['prefix' => 'alumnos',  'middleware' => 'auth'], function () {
    Route::get('/', 'AlumnosController@index')->name('alumnos');
    Route::post('/', 'AlumnosController@postAlumno');
    Route::get('/{alumno}', 'AlumnosController@getAlumno')->name('alumno');
    Route::post('/{alumno}', 'AlumnosController@updateAlumno')->name('update-alumno');
    Route::post('/delete/{alumno}', 'AlumnosController@deleteAlumno');
});

Route::group(['prefix' => 'reportes',  'middleware' => 'auth'], function () {
    Route::get('/alumnos/campus', 'ExcelController@indexAlumno')->name('campus-alumnos');
    Route::get('/tutores/campus', 'ExcelController@indexTutor')->name('campus-tutores');
    Route::post('/alumnos', 'ExcelController@postAlumnos')->name('reportes-alumnos');
    Route::post('/tutores', 'ExcelController@postTutores')->name('reportes-tutores');
    Route::post('/alumnos/excel', 'ExcelController@postAlumnosExcel')->name('excel-alumnos');
    Route::post('/tutores/excel', 'ExcelController@postTutoresExcel')->name('excel-tutores');
});
