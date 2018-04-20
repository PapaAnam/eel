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