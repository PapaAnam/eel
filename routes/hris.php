<?php 

Route::prefix('over-time')->group(function(){
	Route::get('/excel', 'OverTimeController@excel');
});

Route::prefix('salaries')->group(function(){
	Route::get('/multiple-slip', 'PayrollSlipController@multipleSlip');
	Route::get('/multiple-slip-pdf', 'PayrollSlipController@multipleSlipPDF');
});