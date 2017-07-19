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
Route::post('/api/v1/employees/{id}', 'Employees@update');
Route::delete('/api/v1/employees/{id}', 'Employees@destroy');
#diagnosis
Route::get('/api/v1/diagnosis/{id?}', 'Diagnosis@index');
Route::post('/api/v1/diagnosis', 'Diagnosis@store');
Route::post('/api/v1/diagnosis/{id}', 'Diagnosis@update');
Route::delete('/api/v1/diagnosis/{id}', 'Diagnosis@destroy');


Route::auth();

Route::get('/home', 'HomeController@index');
