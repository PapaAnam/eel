<div class="row">
	<div class="col-xs-3">
		<img src="{{ $img }}" width="100px" height="50px">
	</div>
	<div class="col-xs-6">
		LISUN DISTRIBUTOR & WHOLESALER <br>
		RUA AIMUTIN – DILI, PHONE +670
	</div>
</div>
<hr>
<div class="row margin-bottom">
	<div class="col-xs-8">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<td>SURAT MUTASI PEGAWAI BARU / LAMA<br>
						HRD – LISUN
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-xs-4">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<td>
						LSN/01/2017<br>
						{{ english_date($data->created_at) }}
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="row margin-bottom">
	<div class="col-xs-12">
		Kepada, <br>
		{{ $m->name.' - '.$m->position }}<br>
		{{ $m->department.' - '.$m->sub_department }} <br>
		{{ $data->city }}<br><br>
		Dengan Hormat,<br> 
		<p>Melalui Surat Mutasi ini bahwa nama yang tertera di bawah ini :</p>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<td width="40%">NIN</td>
					<td>{{ $data->nin }}</td>
				</tr>
				<tr>
					<td>Nama</td>
					<td>{{ $data->e_name }}</td>
				</tr>
				<tr>
					<td>Departemen, Sub Departemen</td>
					<td>{{ $old->department.', '.$old->sub_department }}</td>
				</tr>
				<tr>
					<td>Jabatan</td>
					<td>{{ $old->position }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 margin-bottom">
		<p>Di Mutasi Ke :</p>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<td width="40%">Departemen, Sub Departemen</td>
					<td>{{ $data->d_name.', '.$data->sd_name }}</td>
				</tr>
				<tr>
					<td>Jabatan</td>
					<td>{{ $data->p_name }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="row margin-bottom">
	<div class="col-xs-12">
		Surat Mutasi Karyawan ini berlaku mulai : {{ english_date($data->effect_on) }}<br>
		Demikian Surat Mutasi Karyawan ini di buat dan Atas Perhatiannya Kami Ucapkan Terima Kasih
	</div>
</div>
<div class="row">
	<div class="col-xs-12 text-center">
		<br>Karyawan<br><br><br>
		------------------------------------
	</div>
</div>
<div class="row">
	<div class="col-xs-6 text-left col-md-5" >
		Di Buat Oleh<br><br><br>							
		HRD Manager								
	</div>
	{{-- <div class="col-xs-" ></div> --}}
	<div class=" col-md-5 col-xs-6 text-right">
		Mengetahui<br><br><br>
		General Manager
	</div>
</div> 