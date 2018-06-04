<?php 

# OVER TIME
Route::prefix('over-time')->group(function(){
	Route::get('/excel', 'OverTimeController@excel');
	Route::get('/regular', 'OverTimeController@regular');
	Route::get('/holiday', 'OverTimeController@holiday');
});

# SALARIES
Route::prefix('salaries')->group(function(){
	Route::get('/multiple-slip', 'PayrollSlipController@multipleSlip');
	Route::get('/multiple-slip-pdf', 'PayrollSlipController@multipleSlipPDF');
});

# SETTING
Route::prefix('setting')->group(function(){
	Route::get('/seguranca', 'SettingController@seguranca');
});

# MUTATION MODUL
Route::group(['prefix' => 'mutations'], function() {
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
	$c = 'UserController@';
	Route::get('/active', $c.'active');
});

# ATTENDANCES MODUL
Route::group(['prefix' => 'attendances'], function(){
	Route::get('/filter', 'AttendanceController@filter');
	Route::get('/example', 'AttendanceController@example');
	Route::get('/filter-employee/print', 'AttendanceController@printByEmployee');
	Route::get('/filter-employee/excel', 'AttendanceController@excelByEmployee');
	Route::get('/data/filter-employee', 'AttendanceController@filter');
	Route::get('/data/{id?}/{date?}', 'AttendanceController@getData');
	Route::get('/x100c-machine', 'X100CController@get');
	Route::post('/x100c-machine/synchronize', 'X100CController@synchronize');
	Route::namespace('Attendances')->group(function(){
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