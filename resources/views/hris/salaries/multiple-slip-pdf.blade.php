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
</style>
@foreach ($salaries as $s)
<div style="width: 45%; padding-right: 20px; display: inline-block; margin-bottom: 20px; margin-right: 10px;">
	<div style="display: block; height: 100px;"></div>
	<strong>Lisun Salary Slip</strong>
	<br>
	<hr>
	<table style="margin-bottom: 5px;">
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
	<table style="margin-bottom: 5px;">
		<tbody>
			<tr>
				<td width="230px">Basic Salary</td>
				<td align="right">{{ $s->sr->basic_salary }}</td>
			</tr>
			<tr>
				<td>Allowance</td>
				<td align="right">{{ $s->sr->allowance }}</td>
			</tr>
			<tr>
				<td>Total Work Day</td>
				<td align="right">{{ $total_hari_kerja[$loop->index] }}</td>
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
			<tr>
				<td>ETC</td>
				<td align="right">{{ $s->sr->etc }}</td>
			</tr>
			<tr>
				<td>Ritation</td>
				<td align="right">{{ $s->sr->ritation }}</td>
			</tr>
			<tr style="padding-bottom: 20px">
				<td>Sub Total</td>
				<td align="right">{{ $s->gross_salary }}</td>
			</tr>
			<tr>
				<td width="230px">Potongan</td>
			</tr>
			<tr>
				<td width="230px">Pajak (Seguranca Social 4%)</td>
				<td align="right">{{ $seguranca_social[$loop->index] }}</td>
			</tr>
			<tr>
				<td>Kas Bon</td>
				<td align="right">{{ $s->sr->cash_receipt }}</td>
			</tr>
			<tr>
				<td>Sub Total</td>
				<td align="right">{{ $seguranca_social[$loop->index]+$s->sr->cash_receipt }}</td>
			</tr>
			<tr>
				<td>Total Yang Diterima</td>
				<td align="right">{{ $s->clear_salary }}</td>
			</tr>
			<tr style="padding-bottom: 20px;">
				<td width="230px">{{ 'Dili '.date('F, Y-d') }}</td>
			</tr>
			<tr>
				<td width="230px" style="padding-bottom: 40px;">
					HRD Lisun
				</td>
				<td align="right">Penerima</td>
			</tr>
			<tr>
				<td style="padding-bottom: 40px;">{{ Auth::user()->username }}</td>
				<td align="right">{{ $s->emp->name }}</td>
			</tr>
		</tbody>
	</table>
</div>
@endforeach
<script>
	window.print();
</script>