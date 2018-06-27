<?php

Route::get('/my-app-name', 'MyAppController@appName');
Route::get('/hris-name', 'MyAppController@hrisName');
Route::get('/setting/animation-icon', 'SettingController@animationIcon');
Route::namespace('Hris')->group(function(){
	Route::get('/departments/{id?}', 'DepartmentController@api');

	Route::prefix('attendances')->group(function(){
		Route::get('/', 'AttendanceController@index');
		Route::get('/{id}', 'AttendanceController@api');
		Route::post('/store', 'AttendanceController@store');
		Route::post('/store-multi', 'AttendanceController@storeMulti');
		Route::post('/store-excel', 'AttendanceController@storeExcel');
		Route::put('/{id}', 'AttendanceController@update');
	});

	Route::get('/employees/{id?}', 'EmployeeController@api');

	Route::prefix('payroll')->group(function(){
		Route::get('/', 'PayrollController@index');
		Route::post('/pay-all-employee', 'PayrollController@payAll');
	});

	Route::prefix('salary-group')->group(function(){
		Route::get('/', 'SalaryGroupController@index');
		Route::post('/', 'SalaryGroupController@store');
		Route::put('/{id}', 'SalaryGroupController@update');
		Route::delete('/{id}', 'SalaryGroupController@delete');
	});

	Route::prefix('salary-rules')->group(function(){
		Route::get('/', 'SalaryRuleController@index');
		Route::post('/', 'SalaryRuleController@store');
	});

	Route::prefix('leave-period')->group(function(){
		Route::get('/', 'LeavePeriodRuleController@index');
		Route::get('/id', 'LeavePeriodRuleController@show');
		Route::put('/', 'LeavePeriodRuleController@store');
		Route::get('/left', 'LeavePeriodLeftController@index');
	});
});