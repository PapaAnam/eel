<?php
Auth::routes();

#ENTERPRISE EDITION
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');