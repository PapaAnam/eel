<?php 

Route::group(['namespace' => 'Auth'], function(){
	Route::get('/login', 'LoginController@showLoginForm')->name('warehouse.login');
	Route::post('/login', 'LoginController@login')->name('warehouse.login.submit');
});

Route::get('/', 'WarehouseController@index')->name('warehouse');
Route::get('/barang', 'BarangController@index')->name('warehouse.barang');