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
				<td width="400px">Basic Salary</td>
				<td align="right">{{ $s->sr->basic_salary }}</td>
			</tr>
			<tr>
				<td>Allowance</td>
				<td align="right">{{ $s->sr->allowance }}</td>
			</tr>
			<tr>
				<td>Total Work Day &nbsp;&nbsp;({{ $total_hari_kerja }} days)</td>
				<td align="right"></td>
			</tr>
			<tr>
				<td>Over Time Regular ({{ $s->ot_regular_in_hours }})</td>
				<td align="right">{{ $s->ot_regular }}</td>
			</tr>
			<tr>
				<td>Over Time Holiday ({{ $s->ot_holiday_in_hours }})</td>
				<td align="right">{{ $s->ot_holiday }}</td>
			</tr>
			<tr>
				<td>Incentive Sales</td>
				<td align="right">{{ $s->sr->incentive }}</td>
			</tr>
			<tr>
				<td>Eat Cost</td>
				<td align="right">{{ $s->sr->eat_cost }}</td>
			</tr>
			{{-- <tr>
				<td>ETC</td>
				<td align="right">{{ $s->sr->etc }}</td>
			</tr> --}}
			<tr>
				<td>Ritation</td>
				<td align="right">{{ $s->sr->ritation }}</td>
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
				<td align="right">{{ $s->seguranca }}</td>
			</tr>
			<tr>
				<td>Kas Bon</td>
				<td align="right">{{ $s->sr->cash_receipt }}</td>
			</tr>
			<tr>
				<td>Absent ({{ $s->absent }} days)</td>
				<td align="right">{{ $s->absent_punishment }}</td>
			</tr>
			<tr>
				<td>Sub Total</td>
				<td align="right">{{ $s->total_potongan }}</td>
			</tr>
			<tr>
				<td>Total Yang Diterima</td>
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