<?php
Auth::routes();

#ENTERPRISE EDITION
Route::get('/home', 'HomeController@index')->name('home');
Route::view('/aa', 'aa');
Route::get('/', 'HomeController@index');