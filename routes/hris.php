<?php 

Route::prefix('over-time')->group(function(){
	Route::get('/excel', 'OverTimeController@excel');
});