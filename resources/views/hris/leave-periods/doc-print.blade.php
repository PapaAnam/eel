<!DOCTYPE html>
<html>
<head>
	<title>FORM CUTI / IZIN KARYAWAN - {{ config('app.hris_name') }}</title>
	<style>
	* {
		font-family: sans-serif;
		font-size: 10px;
	}
	h4 {
		text-align: center;
	}
	.tabel-atas {
		width: 100%;
	}
	.tabel-atas td {
		padding: 8px 5px;
	}
	.with-border {
		border-collapse: collapse;
	}
	.with-border td {
		border: 1px solid black;
	}
	.alasan {
		width: 100%;
	}
	.alasan td {
		padding: 5px;
	}
</style>
</head>
<body>
	<h4>
		FORM CUTI / IZIN KARYAWAN - {{ config('app.hris_name') }}						
	</h4>
	<table class="tabel-atas">
		<tbody>
			<tr>
				<td>Nama</td>
				<td>: {{$leave->employee->name}}</td>
				<td>Tanggal</td>
				<td>: {{substr($leave->created_at, 0, 10)}}</td>
			</tr>
			<tr>
				<td>Jabatan</td>
				<td>: {{$leave->employee->job->name}}</td>
				<td>Staff Pengganti</td>
				<td>: ................................</td>
			</tr>
			<tr>
				<td>Departemen</td>
				<td>: {{$leave->employee->departmentdetail->name}}</td>
				<td>Periode</td>
				<td>: {{substr($leave->start_date, 0, 4)}}</td>
			</tr>
		</tbody>
	</table>
	<table class="tabel-atas with-border">
		<tbody>
			<tr>
				<td align="center" rowspan="2">Jenis Cuti</td>
				<td align="center">Hak Cuti</td>
				<td align="center">Total</td>
				<td align="center" rowspan="2">Sisa Hari Cuti</td>
			</tr>
			<tr>
				<td align="center">(Hari)</td>
				<td align="center">Permintaan Cuti</td>
			</tr>
			@foreach ($rules as $rule)
			<tr>
				<td>{{ $rule->status->status_name }}</td>
				<td>{{ $rule->max }}</td>
				<td>{{ $rule->total }}</td>
				<td>{{ $rule->sisa }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<br>
	<br>
	<table class="alasan">
		<tbody>
			<tr>
				<td>Alasan Cuti</td>
				<td colspan="3">: {{$leave->reason}}</td>
			</tr>
			<tr>
				<td>Cuti Mulai Tanggal</td>
				<td>: {{$leave->start_date}}</td>
				<td>Sampai Tanggal</td>
				<td>: {{$leave->end_date}}</td>
			</tr>
			<tr>
				<td>Alamat & No Telp Cuti</td>
				<td>: </td>
			</tr>
		</tbody>
	</table>
	<br>
	<br>
	<br>
	<br>
	<table width="100%">
		<tbody>
			<tr>
				<td align="center">
					__________________
					<br>
					<br>
					Karyawan
				</td>
				<td align="center">
					__________________
					<br>
					<br>
					Personalia
				</td>
				<td align="center">
					__________________
					<br>
					<br>
					General Manager
				</td>
			</tr>
		</tbody>
	</table>	
	<script>
		window.print();
	</script>
</body>
</html>