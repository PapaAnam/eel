<?php 

Route::view('/', 'App.marketing-idea');
Route::view('/home', 'App.marketing-idea');
Route::view('/maps', 'App.marketing-idea');
Route::view('/customer-outlet', 'App.marketing-idea');

# CATALOG MODUL
Route::group(['prefix' => 'catalog'], function(){
	Route::view('/', 'App.marketing-idea');
	Route::get('/data/{id?}', 'DepartmentController@getData');
	Route::post('/store', 'DepartmentController@store');
	Route::put('/update/{id}', 'DepartmentController@update');
	Route::delete('/delete/{id}', 'DepartmentController@delete');
	Route::get('/print', 'DepartmentController@toPrint');
	Route::get('/pdf', 'DepartmentController@pdf');
	Route::get('/excel', 'DepartmentController@excel');
});