<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


#employees
Route::get('/api/v1/employees/{id?}', 'Employees@index');
Route::post('/api/v1/employees', 'Employees@store');
Route::post('/api/v1/employees/login', 'Employees@login');
// Route::post('/api/v1/employees/login', [
//     'as' => 'profile', 'uses' => 'EmployeesController@login'
// ]);
Route::post('/api/v1/employees/{id}', 'Employees@update');
Route::post('/api/v1/employees/delete/{id}', 'Employees@destroy');


#diagnosis
Route::get('/api/v1/diagnosis/{id?}', 'Diagnosises@index');
Route::post('/api/v1/diagnosis', 'Diagnosises@store');
Route::post('/api/v1/diagnosis/{id}', 'Diagnosises@update');
Route::post('/api/v1/diagnosis/delete/{id}', 'Diagnosises@destroy');


#patients
Route::get('/api/v1/patients/{id?}', 'Patients@index');
Route::post('/api/v1/patients', 'Patients@store');
Route::post('/api/v1/patients/{id}', 'Patients@update');
Route::post('/api/v1/patients/delete/{id}', 'Patients@destroy');


#medicines
Route::get('/api/v1/medicine/{id?}', 'Medicines@index');
Route::post('/api/v1/medicine', 'Medicines@store');
Route::post('/api/v1/medicine/{id}', 'Medicines@update');
Route::post('/api/v1/medicine/delete.{id}', 'Medicines@destroy');


#status
Route::get('/api/v1/status/{id?}', 'Statuses@index');
Route::post('/api/v1/status', 'Statuses@store');
Route::post('/api/v1/status/{id}', 'Statuses@update');
Route::post('/api/v1/status/delete.{id}', 'Statuses@destroy');



Route::auth();

Route::get('/home', 'HomeController@index');
