<?php

Route::get('/drivers', 'ApiController@drivers');
Route::get('/all-drivers', 'ApiController@allDrivers');

	# SALES ORDER
Route::group(['prefix' => 'sales-order'], function(){
	Route::get('/result', 'SalesOrderController@apiResult');
	Route::get('/{driver}', 'SalesOrderController@api');
	Route::post('/process', 'SalesOrderController@process');
	Route::put('/update-status/{id}', 'SalesOrderController@updateStatus');
});

	# SALES
Route::get('/sales', 'SalesController@api');