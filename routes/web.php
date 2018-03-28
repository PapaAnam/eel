<?php
// use App\User;
Auth::routes();
// Route::get('add/user', function(){
// 	User::create(['username'=>'admin', 'password'=>bcrypt('admin'), 'level'=>1]);
// });
Route::view('/uji-coba', 'c');

#ENTERPRISE EDITION
Route::get('/home', 'HomeController@index')->name('home');
Route::view('/aa', 'aa');
// Route::get('/dd', function(){
// 	return '<img src="'.asset('0001/photo/payroll erd.png').'">';
	// $dbName = "D:\Documents\Database1.accdb";
	// $db = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=".$dbName."; Uid=; Pwd=;");
	// dd($db);
	// App\Mhs::create([
	// 	'PARANAME'	 => 'skajksjakjs',
	// 	'PARATYPE'	 => null,
	// 	'PARAVALUE' => '4348394',
	// ]);
	// dd(App\Mhs::where('PARANAME', 'CheckInColor')->get());
// });
Route::get('/', 'HomeController@index');
Route::get('/hris/dep', 'Hris\DepartmentController@dd');
Route::get('/hris/migrate', 'Hris\DepartmentController@m');
Route::get('/hris/migrate/employee', 'Hris\EmployeeController@m');

#HRIS
Route::group(['middleware' => 'auth', 'prefix'=>'hris'], function() {
	Route::get('/', 'Hris\HrisController@index')->name('hris');
	Route::post('/profile/detail', 'Hris\ProfileController@detail')->name('profile.detail');
	Route::get('/profile/edit', 'Hris\ProfileController@edit')->name('profile.edit');
	Route::put('/username/update', 'Hris\ProfileController@username_update')->name('username.update');
	Route::put('/profile/update', 'Hris\ProfileController@update')->name('profile.update');
	Route::put('/avatar/update', 'Hris\ProfileController@avatarupdate')->name('avatar.update');
	Route::put('/password/update', 'Hris\ProfileController@passwordupdate')->name('password.update');
	Route::put('/password/reset', 'Hris\ProfileController@reset')->name('password.reset');

	# DEPARTMENTS MODUL
	Route::group(['prefix' => 'departments', 'namespace' => 'Hris'], function(){
		// Route::get('/', 'DepartmentController@index')->name('departments');
		Route::get('/data/{id?}', 'DepartmentController@getData');
		Route::post('/store', 'DepartmentController@store');
		Route::put('/update/{id}', 'DepartmentController@update');
		Route::delete('/delete/{id}', 'DepartmentController@delete');
		Route::get('/print', 'DepartmentController@toPrint');
		Route::get('/pdf', 'DepartmentController@pdf');
		Route::get('/excel', 'DepartmentController@excel');
	});

	# SUB DEPARTMENTS MODUL
	Route::group(['prefix' => 'sub-departments', 'namespace' => 'Hris'], function(){
		Route::get('/', 'SubDepartmentController@index');
		Route::get('/data/{id?}/{param?}', 'SubDepartmentController@getData');
		Route::post('/store', 'SubDepartmentController@store');
		Route::put('/update/{id}', 'SubDepartmentController@update');
		Route::delete('/delete/{id}', 'SubDepartmentController@delete');
		Route::get('/print', 'SubDepartmentController@to_print');
		Route::get('/pdf', 'SubDepartmentController@pdf');
		Route::get('/excel', 'SubDepartmentController@excel');
	});

	# POSITIONS MODUL
	Route::group(['prefix' => 'positions', 'namespace' => 'Hris'], function(){
		Route::get('/', 'PositionController@index');
		Route::get('/data/{id?}', 'PositionController@getData');
		Route::post('/store', 'PositionController@store');
		Route::put('/update/{id}', 'PositionController@update');
		Route::delete('/delete/{id}', 'PositionController@delete');
		Route::get('/print', 'PositionController@to_print');
		Route::get('/pdf', 'PositionController@pdf');
		Route::get('/excel', 'PositionController@excel');
	});

	# EMPLOYEES MODUL
	Route::group(['prefix' => 'employees', 'namespace' => 'Hris'], function(){
		// Route::get('/', 'EmployeeController@index');
		Route::get('/data/{id?}', 'EmployeeController@getData');
		Route::post('/store', 'EmployeeController@store');
		Route::put('/update/{id}', 'EmployeeController@update');
		Route::delete('/delete/{id}', 'EmployeeController@delete');
		Route::get('/print', 'EmployeeController@toPrint');
		Route::get('/pdf', 'EmployeeController@pdf');
		Route::get('/excel', 'EmployeeController@excel');
		Route::get('/{id}/certidao_baptismo/download', 'EmployeeController@certidao_baptismo_download');
		Route::get('/{id}/cartao_rdtl/download', 'EmployeeController@cartao_rdtl_download');
		Route::get('/{id}/elektoral/download', 'EmployeeController@elektoral_download');
		Route::get('/identity/print/{id}', 'EmployeeController@identity_to_print');
		Route::get('/identity/pdf/{id}', 'EmployeeController@identity_pdf');
		Route::get('/identity/excel/{id}', 'EmployeeController@identity_excel');
		Route::put('/non-activate/{id}', 'EmployeeController@nonActivate');
		Route::get('/non-active/data', 'EmployeeController@nonActiveData');
		Route::put('/activate/{id}', 'EmployeeController@activate');
	});

	# ACCOUNTS MODUL
	Route::group(['prefix' => 'accounts', 'namespace' => 'Hris'], function(){
		// Route::get('/', 'AccountController@index');
		Route::get('/data/{id?}', 'AccountController@getData');
		Route::post('/store', 'AccountController@store');
		Route::put('/update/{id}', 'AccountController@update');
		Route::delete('/delete/{id}', 'AccountController@delete');
		Route::get('/print', 'AccountController@toPrint');
		Route::get('/pdf', 'AccountController@pdf');
		Route::get('/excel', 'AccountController@excel');
	});

	# ATTENDANCES MODUL
	Route::group(['prefix' => 'attendances', 'namespace' => 'Hris'], function(){
		// Route::get('/', 'AttendanceController@index');
		Route::get('/filter', 'AttendanceController@filter');
		Route::get('/example', 'AttendanceController@example');
		Route::get('/data/{id?}/{date?}', 'AttendanceController@getData');
		Route::get('/x100c', 'AttendanceController@x100c');
		Route::post('/store', 'AttendanceController@store');
		Route::put('/update/{id}', 'AttendanceController@update');
		Route::delete('/delete/{id}', 'AttendanceController@delete');
		Route::get('/print', 'AttendanceController@toPrint');
		Route::get('/pdf', 'AttendanceController@pdf');
		Route::get('/excel', 'AttendanceController@excel');
	});

	# SPECIAL DAY
	Route::group(['prefix' => 'special-day', 'namespace' => 'Hris'], function(){
		Route::get('/calendars', 'CalendarController@index')->name('calendars');
		Route::get('/data', 'CalendarController@getData');
		Route::get('/event-list', 'CalendarController@getEventList');
		Route::put('/update/{id}', 'CalendarController@update');
		Route::post('/store', 'CalendarController@store');
		Route::delete('/{id}', 'CalendarController@remove');
	});

	#SALARY RULES
	Route::group(['prefix' => 'salary-rules', 'namespace' => 'Hris'], function(){
		Route::get('/data/{employee}', 'SalaryRuleController@getData');
		Route::post('/store', 'SalaryRuleController@store');
		Route::get('/print', 'SalaryRuleController@toPrint');
		Route::get('/pdf', 'SalaryRuleController@pdf');
		Route::get('/excel', 'SalaryRuleController@excel');
	});

	# OFFICIAL TRAVEL
	Route::group(['prefix' => 'official-travel', 'namespace' => 'Hris'], function(){
		Route::get('/data/{id?}', 'OfficialTravelController@getData');
		Route::post('/store', 'OfficialTravelController@store');
		Route::put('/update/{id}', 'OfficialTravelController@update');
		Route::delete('/delete/{id}', 'OfficialTravelController@delete');
		Route::get('/print', 'OfficialTravelController@toPrint');
		Route::get('/pdf', 'OfficialTravelController@pdf');
		Route::get('/excel', 'OfficialTravelController@excel');
	});


	
		#Official Travel modul
	Route::get('/official_travel', 'Hris\OfficialTravelController@index')->name('official_travels');
	Route::group(['prefix' => 'official_travel'], function() {
		$c = 'Hris\OfficialTravelController@';
		$r = 'official_travel';
		Route::post('check_eat_cost', $c.'checkEatCost')->name($r.'.check_eat_cost');
		Route::post('create', $c.'create')->name($r.'.create');
		Route::post('edit', $c.'edit')->name($r.'.edit');
		Route::put('update', $c.'update')->name($r.'.update');
		Route::delete('remove', $c.'remove')->name($r.'.remove');
		Route::post('detail', $c.'detail')->name($r.'.detail');
		export_route($c, $r);
		$a = '{id}/warrant/';
		$b = $r.'.warrant.';
		Route::get($a.'print', $c.'warrantPrint')->name($b.'print');
		Route::get($a.'excel', $c.'warrantExcel')->name($b.'excel');
		Route::get($a.'pdf', $c.'warrantPdf')->name($b.'pdf');
		Route::post('dt', $c.'dt')->name($r.'.dt');
	});

		#Mutation modul
	Route::get('/mutations', 'Hris\MutationController@index')->name('mutations');
	Route::group(['prefix' => 'mutation'], function() {
		$c = 'Hris\MutationController@';
		$r = 'mutation';
		Route::post('create', $c.'create')->name($r.'.create');
		Route::post('edit', $c.'edit')->name($r.'.edit');
		Route::put('update', $c.'update')->name($r.'.update');
		Route::delete('remove', $c.'remove')->name($r.'.remove');
		Route::post('detail', $c.'detail')->name($r.'.detail');
		Route::post('dt', $c.'dt')->name($r.'.dt');
		export_route($c, $r);
		Route::get('{id}/letter/print', $c.'letterprint')->name($r.'.letter.print');
		Route::get('{id}/letter/excel', $c.'letterexcel')->name($r.'.letter.excel');
		Route::get('{id}/letter/pdf', $c.'letterpdf')->name($r.'.letter.pdf');
		Route::post('refresh_mutation_id', $c.'refresh_mutation_id')->name($r.'.refresh_mutation_id');
		Route::post('check_position_department', $c.'check_position_department')->name($r.'.check_position_department');
	});

		#Attendance modul
	// Route::get('/manage_attendances', 'Hris\AttendanceController@index')->name('attendances');
	// Route::group(['prefix' => 'manage_attendance'], function() {
	// 	$c = 'Hris\AttendanceController@';
	// 	$r = 'attendance';
	// 	Route::post('create', $c.'create')->name($r.'.create');
	// 	Route::post('create_multiply', $c.'create_multiply')->name($r.'.create_multiply');
	// 	Route::post('dt', $c.'dt')->name($r.'.dt');
	// 	Route::post('/filter_dt/{date}', $c.'filter_dt')->name($r.'.filter_dt');

	// 	Route::post('break', $c.'break')->name($r.'.break');
	// 	Route::put('break/update', $c.'breakUpdate')->name($r.'.break_update');

	// 	Route::post('end_break', $c.'endBreak')->name($r.'.end_break');
	// 	Route::put('end_break/update', $c.'endBreakUpdate')->name($r.'.end_break_update');

	// 	Route::post('out', $c.'out')->name($r.'.out');
	// 	Route::put('out/update', $c.'outUpdate')->name($r.'.out_update');

	// 	Route::delete('remove', $c.'remove')->name($r.'.remove');
	// 	Route::post('detail', $c.'detail')->name($r.'.detail');
	// 	Route::post('upload_attendance', $c.'upload_attendance')->name($r.'.upload_attendance');

	// 	Route::post('create_by_excel', $c.'create_by_excel')->name($r.'.create_by_excel');			
	// 	export_route($c, $r);
	// });

		#Over Time modul
	Route::get('/over_times', 'Hris\OverTimeController@index')->name('overtimes');
	Route::group(['prefix' => 'overtime'], function() {
		$c = 'Hris\OverTimeController@';
		$r = 'overtime';
		Route::post('dt', $c.'dt')->name($r.'.dt');
		Route::post('pay_edit', $c.'payEdit')->name($r.'.pay_edit');
		Route::put('pay', $c.'pay')->name($r.'.pay');
		export_route($c, $r);
	});

		#Payroll modul
	Route::group(['prefix' => 'payroll'], function() {
		$c = 'Hris\PayrollController@';
		$r = 'payroll';
		Route::get('/filter', $c.'filter');
		Route::namespace('Hris')->group(function(){
			Route::get('/slip/{id}', 'PayrollSlipController@excelExport');
		});
		Route::post('/pay-all-employee', $c.'payAll');
		Route::post('dt', $c.'dt')->name($r.'.dt');
		Route::post('create', $c.'create')->name($r.'.create');
		Route::get('{id}/edit', $c.'edit')->name($r.'.edit');
		Route::delete('remove', $c.'remove')->name($r.'.remove');
		Route::post('detail', $c.'detail')->name($r.'.detail');
		export_route($c, $r);
	});

		#Leave Period
	simple_route('LeavePeriod', 'leave_period', 'cudeta');
	Route::get('leave_period/refresh_table', 'LeavePeriodController@refresh_table')->name('leave_period.refresh_table');
	Route::get('leave_period/employee/print', 'LeavePeriodController@employee_print')->name('leave_period.employee.print');
	Route::get('leave_period/employee/pdf', 'LeavePeriodController@employee_pdf')->name('leave_period.employee.pdf');
	Route::get('leave_period/employee/excel', 'LeavePeriodController@employee_excel')->name('leave_period.employee.excel');

		#Announcement modul
	Route::get('/announcements', 'Hris\AnnouncementController@index')->name('announcements');
	Route::group(['prefix' => 'announcement'], function() {
		$c = 'Hris\AnnouncementController@';
		$r = 'announcement';
		Route::get('', $c.'index')->name($r);
		Route::post('dt', $c.'dt')->name($r.'.dt');
		Route::post('create', $c.'create')->name($r.'.create');
		Route::get('{id}/edit', $c.'edit')->name($r.'.edit');
		Route::delete('remove', $c.'remove')->name($r.'.remove');
		Route::put('update', $c.'update')->name($r.'.update');
		Route::post('dt', $c.'dt')->name($r.'.dt');
	});

		// if(Auth::user()->level==1){
			#Setting modul
	$r = 'setting';
	$c = 'Hris\OtherController';
	Route::get('/'.$r.'s', $c.'@setting')->name($r.'s');
	Route::put('/'.$r.'/update', $c.'@update')->name($r.'.update');
	Route::put('/'.$r.'/update_theme', $c.'@update_theme')->name($r.'.update_theme');
		// }

	Route::view('/{sub?}/{sub_sub?}/{sub_sub_sub?}/{sub_sub_sub_sub?}/{sub_sub_sub_sub_sub?}/{sub_sub_sub_sub_sub_sub?}', 'App.hris');
});

Route::group(['prefix' => 'warehouse', 'namespace' => 'Warehouse'], function(){

	Route::group(['namespace' => 'Auth'], function(){
		Route::get('/login', 'LoginController@showLoginForm')->name('warehouse.login');
		Route::post('/login', 'LoginController@login')->name('warehouse.login.submit');
	});

	// Route::group(['middleware' => ['auth:warehouse']], function(){
	Route::get('/', 'WarehouseController@index')->name('warehouse');
	Route::get('/barang', 'BarangController@index')->name('warehouse.barang');
	// });
});

require_once('tambahan/help-desk.php');


# FLEET MANAGEMENT

Route::group(['prefix' => 'api', 'namespace' => 'Fleet'], function(){
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
});

Route::group(['prefix' => 'fleet-management', 'namespace' => 'Fleet'], function(){
	Route::get('sales-order/{export_type}/{tgl}', 'SalesOrderController@export');
	Route::view('/{sub_menu?}/{sub_sub_menu?}', 'App.fleet');
});

// Route::get('/api/lisun-table-list', function(){
// 	return collect(DB::connection('sqlsrv')
// 		->select('SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE=\'BASE TABLE\''))->pluck('TABLE_NAME');
// });

// Route::get('/departments', function(){
// 	return App\Models\Hris\Department::distinct()->get()->pluck('name');
// });
// Route::get('/positions', function(){
// 	return App\Models\Hris\Position::distinct()->get()->pluck('name');
// });
// Route::get('/nama', function(){
// 	$faker = Faker\Factory::create('id_ID');
// 	$nama = [];
// 	foreach (range(1, 300) as $i) {
// 		$gender = $faker->randomElement(['male', 'female']);
// 		$nama[] = [
// 			'nip_karyawan' => $faker->unique()->nik,
// 			'nama_karyawan' => $faker->name($gender),
// 			'jk_karyawan' => $gender === 'male' ? 'Laki-laki' : 'Perempuan',
// 			'jenis_karyawan' => $faker->randomElement(['Tetap', 'Sementara']),
// 			'pendidikan_karyawan' => $faker->randomElement(['D3', 'D4', 'S1']).' '.$faker->randomElement([]), 
// 			'kota_lhr_karyawan' => $faker->city,
// 			'tgl_lhr_karyawan' => $faker->dateTimeBetween('-30 years', '-20 years')->format('Y-m-d'),
// 			'agama_karyawan' => $faker->randomElement(['Islam','Kristen','Katholik','Hindu','Buddha']),
// 			'status_karyawan' => $faker->randomElement(['Nikah', 'Belum Nikah']),
// 			'alamat_karyawan' => $faker->address,
// 			'tgl_masuk_karyawan' => $faker->dateTimeBetween('-1 years')->format('Y-m-d'),
// 			'id_divisi' => $faker->randomElement(range(1, 62)),
// 			'id_jabatan' => $faker->randomElement(range(1, 35)),
// 		];
// 	}
// 	return $nama;
// });