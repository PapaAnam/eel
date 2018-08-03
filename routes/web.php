<?php
Auth::routes();
Route::get('/cc',function(){
	return \App\Models\Hris\Attendance::where('created_at', '2018-05-07')->delete();
});

#ENTERPRISE EDITION
Route::get('/home', 'HomeController@index')->name('home');
Route::view('/aa', 'aa');
Route::get('/', 'HomeController@index');
Route::get('/satuan', function(){
	dd(\App\Models\Altius\DetailDraftSO::all());
	// return \App\Models\Altius\Satuan::take(2)->get();
});

Route::get('/fiska', function(){
	Excel::load('storage\app\dataset.xlsx', function($reader) {

		foreach($reader->all() as $row){
			$id_pekerjaan = 1;
			if(trim(strtolower($row->pekerjaan)) == 'pegawai')
				$id_pekerjaan = 1;
			elseif(trim(strtolower($row->pekerjaan)) == 'profesional')
				$id_pekerjaan = 2;
			elseif(trim(strtolower($row->pekerjaan)) == 'petani')
				$id_pekerjaan = 3;
			elseif(trim(strtolower($row->pekerjaan)) == 'wiraswasta')
				$id_pekerjaan = 4;
			$id_pendidikan = 1;
			if(trim(strtolower($row->pendidikan_terakhir)) == 'smu')
				$id_pendidikan = 1;
			elseif(trim(strtolower($row->pendidikan_terakhir)) == 'kejuruan')
				$id_pendidikan = 2;
			elseif(trim(strtolower($row->pendidikan_terakhir)) == 'universitas')
				$id_pendidikan = 3;
			$id_jenis_kelamin = 1;
			if(trim(strtolower($row->jenis_kelamin)) == 'laki-laki')
				$id_jenis_kelamin = 1;
			elseif(trim(strtolower($row->jenis_kelamin)) == 'perempuan')
				$id_jenis_kelamin = 2;
			$data[] = [
				'loyalitas'=>$row->loyalitas,
				'id_pendidikan'=>$id_pendidikan,
				'polis'=>$row->tambah_polis,
				'usia'=>$row->usia,
				'id_pekerjaan'=>$id_pekerjaan,
				'id_jenis_kelamin'=>$id_jenis_kelamin
			];
		}
		DB::table('dataset')->insert($data);

	});

});