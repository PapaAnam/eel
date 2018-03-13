<?php 

Route::group(['prefix' => 'help-desk', 'namespace' => 'HelpDesk'], function() {
	Route::get('/', 'HomeController@index');

	//Pelanggan
	Route::group(['prefix' => 'pelanggan'], function() {
		Route::get('/', function(){
			return redirect('help-desk#/pelanggan');
		});
		Route::get('/data/{keyword?}', 'PelangganController@data');
	});
});