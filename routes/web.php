<?php
Auth::routes();

#ENTERPRISE EDITION
Route::get('/home', 'HomeController@index')->name('home');
Route::view('/aa', 'aa');
Route::get('/', 'HomeController@index');
Route::get('/satuan', function(){
	dd(\App\Models\Altius\DetailDraftSO::all());
	// return \App\Models\Altius\Satuan::take(2)->get();
});