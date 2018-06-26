<?php 

Route::view('/', 'App.hris');
Route::view('/home', 'App.hris');

# DEPARTMENTS MODUL
Route::group(['prefix' => 'departments'], function(){
	Route::view('/', 'App.hris');
	Route::get('/data/{id?}', 'DepartmentController@getData');
	Route::post('/store', 'DepartmentController@store');
	Route::put('/update/{id}', 'DepartmentController@update');
	Route::delete('/delete/{id}', 'DepartmentController@delete');
	Route::get('/print', 'DepartmentController@toPrint');
	Route::get('/pdf', 'DepartmentController@pdf');
	Route::get('/excel', 'DepartmentController@excel');
});

# POSITIONS MODUL
Route::view('/jobs', 'App.hris');
Route::group(['prefix' => 'positions'], function(){
	Route::view('/', 'App.hris');
	Route::get('/data/{id?}', 'PositionController@getData');
	Route::post('/store', 'PositionController@store');
	Route::put('/update/{id}', 'PositionController@update');
	Route::delete('/delete/{id}', 'PositionController@delete');
	Route::get('/print', 'PositionController@to_print');
	Route::get('/pdf', 'PositionController@pdf');
	Route::get('/excel', 'PositionController@excel');
});

# EMPLOYEES MODUL
Route::group(['prefix' => 'employees'], function(){
	Route::view('/', 'App.hris');
	Route::view('/new', 'App.hris');
	Route::view('/edit/{id}', 'App.hris');
	Route::view('/detail/{id}', 'App.hris');
	Route::get('/data/{id?}', 'EmployeeController@getData');
	Route::post('/store', 'EmployeeController@store');
	Route::put('/update/{id}', 'EmployeeController@update');
	Route::delete('/delete/{id}', 'EmployeeController@delete');
	Route::get('/print', 'EmployeeController@toPrint');
	Route::get('/pdf', 'EmployeeController@pdf');
	Route::get('/excel', 'EmployeeController@excel');
	Route::get('/{id}/certidao_baptismo/download', 'EmployeeController@certidao_baptismo_download');
	Route::get('/{id}/cartao_rdtl/download', 'EmployeeController@cartao_rdtl_download');
	Route::get('/{id}/elektoral/download', 'EmployeeController@elektoral_download');
	Route::get('/identity/print/{id}', 'EmployeeController@identity_to_print');
	Route::get('/identity/pdf/{id}', 'EmployeeController@identity_pdf');
	Route::get('/identity/excel/{id}', 'EmployeeController@identity_excel');
	Route::put('/non-activate/{id}', 'EmployeeController@nonActivate');
	Route::get('/non-active/data', 'EmployeeController@nonActiveData');
	Route::put('/activate/{id}', 'EmployeeController@activate');
});

# ACCOUNTS MODUL
Route::group(['prefix' => 'accounts'], function(){
	Route::view('/', 'App.hris');
	Route::get('/data/{id?}', 'AccountController@getData');
	Route::post('/store', 'AccountController@store');
	Route::put('/update/{id}', 'AccountController@update');
	Route::delete('/delete/{id}', 'AccountController@delete');
	Route::get('/print', 'AccountController@toPrint');
	Route::get('/pdf', 'AccountController@pdf');
	Route::get('/excel', 'AccountController@excel');
});

# SPECIAL DAY
Route::group(['prefix' => 'special-day'], function(){
	Route::view('/', 'App.hris');
	Route::get('/calendars', 'CalendarController@index')->name('calendars');
	Route::get('/data', 'CalendarController@getData');
	Route::get('/event-list', 'CalendarController@getEventList');
	Route::put('/update/{id}', 'CalendarController@update');
	Route::post('/store', 'CalendarController@store');
	Route::delete('/{id}', 'CalendarController@remove');
});

#SALARY RULES
Route::group(['prefix' => 'salary-rules'], function(){
	Route::view('/', 'App.hris');
	Route::get('/data/{employee}', 'SalaryRuleController@getData');
	Route::post('/store', 'SalaryRuleController@store');
	Route::get('/print', 'SalaryRuleController@toPrint');
	Route::get('/pdf', 'SalaryRuleController@pdf');
	Route::get('/excel', 'SalaryRuleController@excel');
});

# OFFICIAL TRAVEL
Route::group(['prefix' => 'official-travel'], function(){
	Route::view('/', 'App.hris');
	Route::get('/data/{id?}', 'OfficialTravelController@getData');
	Route::post('/store', 'OfficialTravelController@store');
	Route::put('/update/{id}', 'OfficialTravelController@update');
	Route::delete('/delete/{id}', 'OfficialTravelController@delete');
	Route::get('/print', 'OfficialTravelController@toPrint');
	Route::get('/pdf', 'OfficialTravelController@pdf');
	Route::get('/excel', 'OfficialTravelController@excel');
});

# OVER TIME
Route::prefix('over-time')->group(function(){
	Route::view('/', 'App.hris');
	Route::get('/excel', 'OverTimeController@excel');
	Route::get('/regular', 'OverTimeController@regular');
	Route::get('/holiday', 'OverTimeController@holiday');
});

# SALARIES
Route::prefix('salaries')->group(function(){
	Route::view('/', 'App.hris');
	Route::get('/multiple-slip', 'PayrollSlipController@multipleSlip');
	Route::get('/multiple-slip-pdf', 'PayrollSlipController@multipleSlipPDF');
});

# SETTING
Route::prefix('setting')->group(function(){
	Route::view('/', 'App.hris');
	Route::get('/seguranca', 'SettingController@seguranca');
});

# MUTATION MODUL
Route::group(['prefix' => 'mutations'], function() {
	Route::view('/', 'App.hris');
	$c = 'MutationController@';
	$r = 'mutation';
	Route::get('/', $c.'index');
	Route::post('/store', $c.'store');
	Route::delete('/{id}', $c.'remove');
	Route::get('/excel', $c.'excel');
	export_route($c, $r);
	Route::get('/letter/{id}', $c.'letterprint')->name($r.'.letter.print');
	Route::get('/letter/pdf/{id}', $c.'letterpdf');
	Route::post('refresh_mutation_id', $c.'refresh_mutation_id')->name($r.'.refresh_mutation_id');
	Route::post('check_position_department', $c.'check_position_department')->name($r.'.check_position_department');
});

Route::group(['prefix' => 'user'], function() {
	Route::view('/', 'App.hris');
	$c = 'UserController@';
	Route::get('/active', $c.'active');
});

# ATTENDANCES MODUL
Route::group(['prefix' => 'attendances'], function(){
	Route::view('/', 'App.hris');
	Route::get('/filter', 'AttendanceController@filter');
	Route::get('/example', 'AttendanceController@example');
	Route::get('/filter-employee/print', 'AttendanceController@printByEmployee');
	Route::get('/filter-employee/excel', 'AttendanceController@excelByEmployee');
	Route::get('/data/filter-employee', 'AttendanceController@filter');
	Route::get('/data/{id?}/{date?}', 'AttendanceController@getData');
	Route::get('/x100c-machine', 'X100CController@get');
	Route::post('/x100c-machine/synchronize', 'X100CController@synchronize');
	Route::view('/by-employee', 'App.hris');
	Route::namespace('Attendances')->group(function(){
		Route::view('/zt1300', 'App.hris');
		Route::get('/zt1300-machine', 'Zt1300Controller@get');
		Route::post('/zt1300-machine/synchronize', 'Zt1300Controller@synchronize');
	});
	Route::post('/store', 'AttendanceController@store');
	Route::put('/update/{id}', 'AttendanceController@update');
	Route::delete('/delete/{id}', 'AttendanceController@delete');
	Route::get('/print', 'AttendanceController@toPrint');
	Route::get('/pdf', 'AttendanceController@pdf');
	Route::get('/excel', 'AttendanceController@excel');
});

# PAYROLL
Route::prefix('payroll')->group(function(){
	Route::view('/', 'App.hris');
	Route::view('/new', 'App.hris');
	Route::get('/all-slip', 'PayrollSlipController@all');
	Route::get('/slip/excel/{id}', 'PayrollSlipController@excelExport');
	Route::get('/slip/print/{id}', 'PayrollSlipController@print');
	Route::get('/global-report', 'PayrollController@globalReport');
	Route::get('/slip/by-group/pdf/{id}', 'PayrollSlipController@byGroupPdf');
	Route::get('/slip/by-group/{id}', 'PayrollSlipController@byGroup');
});

# SALARY GROUP
Route::prefix('salary-group')->group(function(){
	Route::view('/', 'App.hris');
	Route::view('/new', 'App.hris');
	Route::get('/all-slip', 'PayrollSlipController@all');
	Route::get('/slip/excel/{id}', 'PayrollSlipController@excelExport');
});

# LEAVE PERIOD
Route::prefix('leave-period')->group(function(){
	Route::view('/', 'App.hris');
});