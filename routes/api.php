<?php

Route::get('/my-app-name', 'MyAppController@appName');
Route::get('/hris-name', 'MyAppController@hrisName');
Route::get('/marketing-idea-name', 'MyAppController@marketingName');
Route::get('/setting/animation-icon', 'SettingController@animationIcon');
Route::get('/is-mix', function(){
	return config('app.mix') ? 1 : 0;
});
Route::namespace('Hris')->group(function(){
	Route::get('/departments/{id?}', 'DepartmentController@api');


	Route::prefix('attendances')->group(function(){
		Route::get('/', 'AttendanceController@index');
		Route::get('/work-total', 'AttendanceController@workTotal');
		Route::get('/standart-time', 'StandartWorkTimeController@index');
		Route::put('/max-work-time/update', 'StandartWorkTimeController@update');
		Route::get('/max-work-time', 'StandartWorkTimeController@maxTime');
		Route::get('/{id}', 'AttendanceController@api');
		Route::post('/store', 'AttendanceController@store');
		Route::post('/store-multi', 'AttendanceController@storeMulti');
		Route::post('/store-excel', 'AttendanceController@storeExcel');
		Route::put('/{id}', 'AttendanceController@update');
		Route::put('/enter/{id}/update', 'AttendanceController@updateEnter');
		Route::put('/out/{id}/update', 'AttendanceController@updateOut');
		Route::put('/status/{id}/update', 'AttendanceController@updateStatus');
	});

	Route::prefix('employees')->group(function(){
		Route::get('/non-active', 'EmployeeNonActiveController@index');
		Route::put('/non-activate/{id}', 'EmployeeController@nonActivate');
		Route::get('/{id?}', 'EmployeeController@api');
	});

	Route::prefix('over-time')->group(function(){
		Route::get('/regular-in-hours', 'OverTimeController@regularInHours');
		Route::put('/regular-in-hours/update', 'OverTimeController@updateRegularInHours');
		Route::get('/holiday-in-hours', 'OverTimeController@holidayInHours');
		Route::put('/holiday-in-hours/update', 'OverTimeController@updateHolidayInHours');
	});

	Route::prefix('payroll')->group(function(){
		Route::get('/', 'PayrollController@index');
		Route::post('/pay-all-employee', 'PayrollController@payAll');
		Route::post('/pay', 'PayrollController@pay');
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

	Route::prefix('cash-withdrawal')->group(function(){
		Route::get('/', 'CashWithdrawalController@index');
		Route::post('/', 'CashWithdrawalController@store');
	});
});

Route::namespace('MIdea')->group(function(){

	Route::prefix('categories')->group(function(){
		Route::get('/', 'CategoryController@index');
	});
	Route::prefix('products')->group(function(){
		Route::get('/', 'ProductController@index');
	});

	Route::prefix('marketing-idea/customer-outlet')->group(function(){
		Route::get('/', 'CustomerOutletController@index');
		Route::get('/{customer_outlet}', 'CustomerOutletController@show');
		Route::post('/store','CustomerOutletController@store');
		Route::put('/update/{customer_outlet}','CustomerOutletController@update');
	});

});