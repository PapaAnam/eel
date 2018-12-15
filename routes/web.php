<?php
Auth::routes();

#ENTERPRISE EDITION
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');

# HRIS LOGIN
Route::post('/hris/login', 'Hris\LoginController@login')->name('hris.login');