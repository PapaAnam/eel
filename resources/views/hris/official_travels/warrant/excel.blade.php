@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/warrant.css') }}">
@endpush
@extends('layouts.export.template')
@section('content')
<style>
	.text-center{
		text-align: center;
	}
	.text-left{
		text-align: left;
	}
	.text-right{
		text-align: right;
	}
</style>
<table id="example1" class="table table-bordered">
	<tbody>
		<tr>
			<td colspan="5" class="text-center">
				<h3>SURAT PERINTAH PERJALANAN DINAS</h3>
				(Diberikan Untuk Setiap Karyawan Kantor Pusat Dili yang Bertugas ke Distrik)
			</td>
		</tr>
		<tr>
			<td width="17%" class="text-right">Nama Petugas</td>
			<td width="32%">{{ $data->e_name }}</td>
			<td width="2%" style="background-color: black !important"></td>
			<td width="17%" class="text-right">Jabatan</td>
			<td width="32%">{{ $data->p_name }}</td>
		</tr>
		<tr>
			<td class="text-right">Tanggal</td>
			<td>{{ english_date($data->created_at) }}</td>
			<td style="background-color: black !important"></td>
			<td class="text-right">Nomor SPPD</td>
			<td>{{ $data->sppd }}</td>
		</tr>
		<tr>
			<td class="text-right">Tugas Ke Area</td>
			<td>1. {{ $data->area_1 }}</td>
			<td style="background-color: black !important"></td>
			<td class="text-right">Lama Tugas</td>
			<td></td>
		</tr>
		<tr>
			<td style="background-color: black !important"></td>
			<td>2. {{ $data->area_2 }}</td>
			<td style="background-color: black !important"></td>
			<td class="text-right">Dari Tanggal</td>
			<td>{{ english_date($data->start_date) }}</td>
		</tr>
		<tr>
			<td style="background-color: black !important"></td>
			<td>3. {{ $data->area_3 }}</td>
			<td style="background-color: black !important"></td>
			<td class="text-right">Sampai Tanggal</td>
			<td>{{ english_date($data->end_date) }}</td>
		</tr>
		<tr>
			<td style="background-color: black !important"></td>
			<td>4. {{ $data->area_4 }}</td>
			<td style="background-color: black !important"></td>
			<td class="text-right">Uang Muka / BS</td>
			<td>USD. {{ $data->advanced_cost }}</td>
		</tr>
		<tr>
			<td style="background-color: black !important"></td>
			<td>5. {{ $data->area_5 }}</td>
			<td style="background-color: black !important"></td>
			<td class="text-right"></td>
			<td></td>
		</tr>
		<tr>
			<td style="background-color: black !important" colspan="5"></td>
		</tr>
		<tr>
			<td class="text-right">Pemberi Tugas</td>
			<td>{{ $as_name }}</td>
			<td style="background-color: black !important"></td>
			<td class="text-center" colspan="2">Catatan Pemberi Tugas</td>
		</tr>
		<tr>
			<td class="text-right">Jabatan</td>
			<td>{{ $pas_name }}</td>
			<td style="background-color: black !important"></td>
			<td rowspan="2" colspan="2">{{ $data->assignor_note }}</td>
		</tr>
		<tr>
			<td class="text-center">Tanda Tangan <br>Pemberi Tugas</td>
			<td></td>
			<td style="background-color: black !important"></td>
		</tr>
		<tr>
			<td style="background-color: black !important" colspan="5"></td>
		</tr>
		<tr>
			<td colspan="5" class="text-center">
				<h3>LAPORAN PERTANGGUNG JAWABAN KEUANGAN</h3>
				(Setelah Kembali Dari Tugas)
			</td>
		</tr>
		<tr>
			<td class="text-right">Penginapan/Hotel</td>
			<td>USD. {{ $data->lodging_cost }}</td>
			<td style="background-color: black !important"></td>
			<td class="text-center" colspan="2">Catatan Petugas :</td>
		</tr>
		<tr>
			<td class="text-right">Makan P/S/M</td>
			<td>USD. {{ $data->eat_cost }}</td>
			<td style="background-color: black !important"></td>
			<td rowspan="8" colspan="2">{{ $data->officer_note }}</td>
		</tr>
		<tr>
			<td class="text-right">Bahan Bakar</td>
			<td>USD. {{ $data->fuel_cost }}</td>
			<td style="background-color: black !important"></td>
		</tr>
		<tr>
			<td class="text-right"></td>
			<td>USD. </td>
			<td style="background-color: black !important"></td>
		</tr>
		<tr>
			<td class="text-right">Lain-lain</td>
			<td>USD. {{ $data->other_cost }}</td>
			<td style="background-color: black !important"></td>
		</tr>
		<tr>
			<td class="text-right">TOTAL</td>
			<td>USD. {{ $data->eat_cost+$data->fuel_cost+$data->other_cost }}</td>
			<td style="background-color: black !important"></td>
		</tr>
		<tr>
			<td class="text-right">Nama Petugas</td>
			<td>{{ $data->e_name }}</td>
			<td style="background-color: black !important"></td>
		</tr>
		<tr>
			<td class="text-right">Tanggal</td>
			<td>{{ english_date($data->report_at) }}</td>
			<td style="background-color: black !important"></td>
		</tr>
		<tr>
			<td class="text-center">Tanda Tangan <br>Petugas</td>
			<td></td>
			<td style="background-color: black !important"></td>
		</tr> 
	</tbody>
</table>
@endsection