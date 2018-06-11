<?php

Route::get('/my-app-name', 'MyAppController@appName');
Route::get('/hris-name', 'MyAppController@hrisName');
Route::get('/animation-icon', 'SettingController@animationIcon');
Route::namespace('Hris')->group(function(){
	Route::get('/departments/{id?}', 'DepartmentController@api');

	Route::prefix('attendances')->group(function(){
		Route::get('/{id}', 'AttendanceController@api');
		Route::post('/store', 'AttendanceController@store');
		Route::post('/store-multi', 'AttendanceController@storeMulti');
		Route::post('/store-excel', 'AttendanceController@storeExcel');
		Route::put('/{id}', 'AttendanceController@update');
	});

	Route::get('/employees/{id?}', 'EmployeeController@api');
});