<?php
// use App\User;
Auth::routes();
# RESET PASSWORD 
Route::get('/hris/reset-password', 'Hris\ResetPasswordController');
// Route::get('add/user', function(){
// 	User::create(['username'=>'admin', 'password'=>bcrypt('admin'), 'level'=>1]);
// });
// Route::view('/uji-coba', 'c');

#ENTERPRISE EDITION
Route::get('/home', 'HomeController@index')->name('home');
Route::view('/aa', 'aa');
Route::get('/', 'HomeController@index');
// Route::get('/hris/dep', 'Hris\DepartmentController@dd');
// Route::get('/hris/migrate', 'Hris\DepartmentController@m');
// Route::get('/hris/migrate/employee', 'Hris\EmployeeController@m');

#HRIS
Route::group(['middleware' => 'auth', 'prefix'=>'hris'], function() {
	// Route::get('/', 'Hris\HrisController@index')->name('hris');
	// Route::post('/profile/detail', 'Hris\ProfileController@detail')->name('profile.detail');
	// Route::get('/profile/edit', 'Hris\ProfileController@edit')->name('profile.edit');
	// Route::put('/username/update', 'Hris\ProfileController@username_update')->name('username.update');
	// Route::put('/profile/update', 'Hris\ProfileController@update')->name('profile.update');
	// Route::put('/avatar/update', 'Hris\ProfileController@avatarupdate')->name('avatar.update');
	// Route::put('/password/update', 'Hris\ProfileController@passwordupdate')->name('password.update');
	// Route::put('/password/reset', 'Hris\ProfileController@reset')->name('password.reset');


	
		#Official Travel modul
	// Route::get('/official_travel', 'Hris\OfficialTravelController@index')->name('official_travels');
	// Route::group(['prefix' => 'official_travel'], function() {
	// 	$c = 'Hris\OfficialTravelController@';
	// 	$r = 'official_travel';
	// 	Route::post('check_eat_cost', $c.'checkEatCost')->name($r.'.check_eat_cost');
	// 	Route::post('create', $c.'create')->name($r.'.create');
	// 	Route::post('edit', $c.'edit')->name($r.'.edit');
	// 	Route::put('update', $c.'update')->name($r.'.update');
	// 	Route::delete('remove', $c.'remove')->name($r.'.remove');
	// 	Route::post('detail', $c.'detail')->name($r.'.detail');
	// 	export_route($c, $r);
	// 	$a = '{id}/warrant/';
	// 	$b = $r.'.warrant.';
	// 	Route::get($a.'print', $c.'warrantPrint')->name($b.'print');
	// 	Route::get($a.'excel', $c.'warrantExcel')->name($b.'excel');
	// 	Route::get($a.'pdf', $c.'warrantPdf')->name($b.'pdf');
	// 	Route::post('dt', $c.'dt')->name($r.'.dt');
	// });

	// 	#Payroll modul
	// Route::group(['prefix' => 'payroll'], function() {
	// 	$c = 'Hris\PayrollController@';
	// 	$r = 'payroll';
	// 	Route::get('/filter', $c.'filter');
	// 	Route::namespace('Hris')->group(function(){
	// 		Route::get('/slip/excel/{id}', 'PayrollSlipController@excelExport');
	// 		Route::get('/slip/pdf/{id}', 'PayrollSlipController@pdfExport');
	// 	});
	// 	Route::post('/pay-all-employee', $c.'payAll');
	// 	Route::post('dt', $c.'dt')->name($r.'.dt');
	// 	Route::post('create', $c.'create')->name($r.'.create');
	// 	Route::get('{id}/edit', $c.'edit')->name($r.'.edit');
	// 	Route::delete('remove', $c.'remove')->name($r.'.remove');
	// 	Route::post('detail', $c.'detail')->name($r.'.detail');
	// 	export_route($c, $r);
	// });

		#Leave Period
	// simple_route('LeavePeriod', 'leave_period', 'cudeta');
	// Route::get('leave_period/refresh_table', 'LeavePeriodController@refresh_table')->name('leave_period.refresh_table');
	// Route::get('leave_period/employee/print', 'LeavePeriodController@employee_print')->name('leave_period.employee.print');
	// Route::get('leave_period/employee/pdf', 'LeavePeriodController@employee_pdf')->name('leave_period.employee.pdf');
	// Route::get('leave_period/employee/excel', 'LeavePeriodController@employee_excel')->name('leave_period.employee.excel');

	// 	#Announcement modul
	// Route::get('/announcements', 'Hris\AnnouncementController@index')->name('announcements');
	// Route::group(['prefix' => 'announcement'], function() {
	// 	$c = 'Hris\AnnouncementController@';
	// 	$r = 'announcement';
	// 	Route::get('', $c.'index')->name($r);
	// 	Route::post('dt', $c.'dt')->name($r.'.dt');
	// 	Route::post('create', $c.'create')->name($r.'.create');
	// 	Route::get('{id}/edit', $c.'edit')->name($r.'.edit');
	// 	Route::delete('remove', $c.'remove')->name($r.'.remove');
	// 	Route::put('update', $c.'update')->name($r.'.update');
	// 	Route::post('dt', $c.'dt')->name($r.'.dt');
	// });

		// if(Auth::user()->level==1){
			#Setting modul
	// $r = 'setting';
	// $c = 'Hris\OtherController';
	// Route::get('/'.$r.'s', $c.'@setting')->name($r.'s');
	// Route::put('/'.$r.'/update', $c.'@update')->name($r.'.update');
	// Route::put('/'.$r.'/update_theme', $c.'@update_theme')->name($r.'.update_theme');
		// }

	// Route::view('/{sub?}/{sub_sub?}/{sub_sub_sub?}/{sub_sub_sub_sub?}/{sub_sub_sub_sub_sub?}/{sub_sub_sub_sub_sub_sub?}', 'App.hris');
});
