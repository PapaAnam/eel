<?php

Route::get('sales-order/{export_type}/{tgl}', 'SalesOrderController@export');
Route::view('/{sub_menu?}/{sub_sub_menu?}', 'App.fleet');