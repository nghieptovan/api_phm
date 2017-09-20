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
Route::get('/api/v1/employee/{id?}', 'Employees@index');
Route::post('/api/v1/employee', 'Employees@store');
Route::post('/api/v1/employee/login', 'Employees@login');
Route::post('/api/v1/employee/{id}', 'Employees@update');
Route::post('/api/v1/employee/delete/{id}', 'Employees@destroy');


#diagnosis
Route::get('/api/v1/diagnosis/{id?}', 'Diagnosises@index');
Route::post('/api/v1/diagnosis', 'Diagnosises@store');
Route::post('/api/v1/diagnosis/{id}', 'Diagnosises@update');
Route::post('/api/v1/diagnosis/delete/{id}', 'Diagnosises@destroy');

#enclitic
Route::get('/api/v1/enclitic/{id?}', 'Enclitics@index');
Route::post('/api/v1/enclitic/getList', 'Enclitics@getList');
Route::post('/api/v1/enclitic/{id}', 'Enclitics@takeMedicine');
Route::post('/api/v1/enclitic', 'Enclitics@store');
// Route::post('/api/v1/enclitic/{id}', 'Enclitics@update');
Route::post('/api/v1/enclitic/delete/{id}', 'Enclitics@destroy');


#patients
Route::get('/api/v1/patient/{id?}', 'Patients@index');
Route::post('/api/v1/patient/searchPatient', 'Patients@searchPatient');
Route::post('/api/v1/patient', 'Patients@store');
Route::post('/api/v1/patient/search', 'Patients@store');
Route::post('/api/v1/patient/{id}', 'Patients@update');
Route::post('/api/v1/patient/delete/{id}', 'Patients@destroy');


#medicines
Route::get('/api/v1/medicine/{id?}', 'Medicines@index');
Route::post('/api/v1/medicine', 'Medicines@store');
Route::post('/api/v1/medicine/{id}', 'Medicines@update');
Route::post('/api/v1/medicine/delete/{id}', 'Medicines@destroy');

#Typemedicines
Route::get('/api/v1/typemedicine/{id?}', 'TypeMedicines@index');
Route::post('/api/v1/typemedicine', 'TypeMedicines@store');
Route::post('/api/v1/typemedicine/{id}', 'TypeMedicines@update');
Route::post('/api/v1/typemedicine/delete/{id}', 'TypeMedicines@destroy');

#Behaviourmedicines
Route::get('/api/v1/behaviourmedicine/{id?}', 'BehaviourMedicines@index');
Route::post('/api/v1/behaviourmedicine', 'BehaviourMedicines@store');
Route::post('/api/v1/behaviourmedicine/{id}', 'BehaviourMedicines@update');
Route::post('/api/v1/behaviourmedicine/delete/{id}', 'BehaviourMedicines@destroy');


#status
Route::get('/api/v1/status/{id?}', 'Statuses@index');
Route::post('/api/v1/status', 'Statuses@store');
Route::post('/api/v1/status/{id}', 'Statuses@update');
Route::post('/api/v1/status/delete/{id}', 'Statuses@destroy');

#prescription
Route::get('/api/v1/prescription/{id?}', 'Prescriptions@index');
Route::post('/api/v1/prescription', 'Prescriptions@store');
Route::post('/api/v1/prescription/{id}', 'Prescriptions@update');
Route::post('/api/v1/prescription/delete/{id}', 'Prescriptions@destroy');


#prescriptiondetail
Route::get('/api/v1/prescriptiondetail/{id?}', 'PrescriptionDetails@index');
Route::post('/api/v1/prescriptiondetail', 'Prescriptions@store');
Route::post('/api/v1/prescriptiondetail/{id}', 'Prescriptions@update');
Route::post('/api/v1/prescriptiondetail/delete/{id}', 'Prescriptions@destroy');
Route::auth();

#configuration
Route::get('/api/v1/config/{id?}', 'Configs@index');
Route::post('/api/v1/config', 'Configs@store');
Route::post('/api/v1/config/{id}', 'Configs@update');
Route::post('/api/v1/config/delete/{id}', 'Configs@destroy');






#Bill
Route::get('/api/v1/bill/{id?}', 'Bills@index');
Route::post('/api/v1/bill', 'Bills@store');
Route::post('/api/v1/bill/{id}', 'Bills@update');
Route::post('/api/v1/bill/delete/{id}', 'Bills@destroy');



Route::auth();

Route::get('/home', 'HomeController@index');
