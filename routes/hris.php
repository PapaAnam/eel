<?php 

Route::prefix('over-time')->group(function(){
	Route::get('/excel', 'OverTimeController@excel');
	Route::get('/regular', 'OverTimeController@regular');
	Route::get('/holiday', 'OverTimeController@holiday');
});

Route::prefix('salaries')->group(function(){
	Route::get('/multiple-slip', 'PayrollSlipController@multipleSlip');
	Route::get('/multiple-slip-pdf', 'PayrollSlipController@multipleSlipPDF');
});

Route::prefix('setting')->group(function(){
	Route::get('/seguranca', 'SettingController@seguranca');
});

#Mutation modul
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