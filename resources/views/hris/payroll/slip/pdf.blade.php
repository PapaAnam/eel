{{-- <!DOCTYPE html>
<html>
<head> --}}
	{{-- <title>Salary Slip</title> --}}
	<style>
	body {
		font-family: sans-serif;
	}
	table {
		width: 100%;
	}
	td {
		padding: 5px;
	}
</style>
{{-- </head>
<body> --}}
	<strong>Lisun Salary Slip</strong>
	<br>
	<hr>
	<table>
		<tbody>
			<tr>
				<td>Name</td>
				<td>: {{ $s->emp->name }}</td>
			</tr>
			<tr>
				<td>NIN</td>
				<td>: {{ $s->emp->nin }}</td>
			</tr>
		</tbody>
	</table>
	<br>
	<br>
	<table>
		<tbody>
			<tr>
				<td width="250px">Basic Salary</td>
				<td align="right">{{ $s->sr[0]->basic_salary }}</td>
			</tr>
			<tr>
				<td>Tunjangan Jabatan</td>
				<td align="right">{{ $s->sr[0]->allowance }}</td>
			</tr>
			<tr>
				<td>Total Hari Kerja</td>
				<td align="right">{{ $total_hari_kerja }}</td>
			</tr>
			<tr>
				<td>Total Over Time Biasa</td>
				<td align="right">{{ $total_over_time_money }}</td>
				<td align="right">{{ $total_over_time_hours }}</td>
			</tr>
			<tr>
				<td>Total Over Time Holiday</td>
				<td align="right">{{ $total_over_time_holiday_in_money }}</td>
				<td align="right">{{ $total_over_time_holiday_in_hours }}</td>
			</tr>
			<tr>
				<td>Incentive Sales</td>
				<td align="right">{{ $s->sr[0]->incentive }}</td>
			</tr>
			<tr>
				<td>Eat Cost</td>
				<td align="right">{{ $s->sr[0]->eat_cost }}</td>
			</tr>
			<tr>
				<td>ETC</td>
				<td align="right">{{ $s->sr[0]->etc }}</td>
			</tr>
			<tr>
				<td>Ritation</td>
				<td align="right">{{ $s->sr[0]->ritation }}</td>
			</tr>
			<tr>
				<td>Sub Total</td>
				<td align="right">{{ $s->gross_salary }}</td>
			</tr>
		</tbody>
	</table>
	<br>
	<table>
		<tbody>
			<tr>
				<td width="250px">Potongan</td>
			</tr>
			<tr>
				<td>Pajak (Seguranca Social 4%)</td>
				<td align="right">{{ $seguranca_social }}</td>
				<td></td>
			</tr>
			<tr>
				<td>Kas Bon</td>
				<td align="right">{{ $s->sr[0]->cash_receipt }}</td>
			</tr>
			<tr>
				<td>Sub Total</td>
				<td align="right">{{ $seguranca_social+$s->sr[0]->cash_receipt }}</td>
			</tr>
			<tr>
				<td>Total</td>
				<td align="right">{{ $s->clear_salary }}</td>
			</tr>
		</tbody>
	</table>
	<br>
	<br>
	<table>
		<tbody>
			<tr>
				<td>{{ 'Dili '.date('F, Y-d') }}</td>
			</tr>
			<tr>
				<td style="padding-bottom: 40px;">
					HRD Lisun
				</td>
				<td align="right">Penerima</td>
			</tr>
			<tr>
				<td>{{ Auth::user()->username }}</td>
				<td align="right">{{ $s->emp->name }}</td>
			</tr>
		</tbody>
	</table>
{{-- </body>
</html> --}}