<?php

Route::get('/my-app-name', 'MyAppController@appName');
Route::get('/hris-name', 'MyAppController@hrisName');
Route::namespace('Hris')->group(function(){
	Route::get('/attendances/{id}', 'AttendanceController@api');
	Route::post('/attendances/store', 'AttendanceController@store');
	Route::put('/attendances/{id}', 'AttendanceController@update');

	Route::get('/employees/{id?}', 'EmployeeController@api');
});