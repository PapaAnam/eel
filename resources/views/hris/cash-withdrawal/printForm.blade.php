	<style>
	body {
		font-family: sans-serif;
	}
	* {
		font-size: 11px;
	}
	table {
		width: 100%;
	}
	td {
		padding: 1px 5px;
	}
	.mi {
		width: 45%; 
		display: inline-block; 
	}
	.mi:nth-child(4n-3){
		margin-bottom: 100px; 
	}
	.mi:nth-child(4n-2){
		margin-bottom: 100px; 
	}
	.mi:nth-child(odd){
		margin-right: 50px;
	}
</style>
<body>
	<center>
		<h2>FORMULIR PERMOHONAN KAS BON KARYAWAN </h2>
		<h3>LISUN DIVISI {{ config('app.group') }}</h3>
	</center>
	Yang Bertanda Tangan di bawah ini :
	<table>
		<tr>
			<td>NIK/NIN</td>
			<td>:</td>
			<td>{{ $d->applicant->nin }}</td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td>{{ $d->applicant->name }}</td>
		</tr>
		<tr>
			<td>Departement</td>
			<td>:</td>
			<td>{{ $d->applicant->dep->name }}</td>
		</tr>
		<tr>
			<td>Jabatan</td>
			<td>:</td>
			<td>{{ $d->applicant->pos->name }}</td>
		</tr>
	</table>
	Dengan ini mengajukan Kas Bon Sebesar : $ {{ $d->total }} {{-- (Seratus Dollar)  --}}
	<br>
	Untuk Keperluan : {{ $d->reason }}
	Jangka Waktu : {{ $d->range }} Bulan / ({{ $d->range }}x Cicilan), sejumlah : $ {{ $d->installment }} Tiap bulan. Cicilan di potong mulai pada bulan : {{ $d->month_start_name.' '.$d->year_start }}, sampai dengan {{ $d->month_end_name.' '.$d->year_end }}

	Demikian Permohonan Saya, Terimakasih 

	Dili, 29 Juni 2018
	Pemohon								ACCOUNTING / HRD
</body>
<script>
	window.print();
</script>