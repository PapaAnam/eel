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
@foreach ($salaries as $s)
<div class="mi">
	<div style="display: block;">
		<strong>Lisun Salary Slip</strong>
		<br>
		<hr>
	</div>
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
				<td width="250px">Basic Salary</td>
				<td align="right">$</td>
				<td width="50px" align="right">{{ $s->sr->basic_salary }}</td>
			</tr>
			<tr>
				<td>Allowance</td>
				<td align="right">$</td>
				<td align="right">{{ $s->sr->allowance }}</td>
			</tr>
			{{-- <tr>
				<td>Total Work Day ({{ $total_hari_kerja[$loop->index] }} days)</td>
				<td align="right"></td>
			</tr> --}}
			<tr>
				<td>Over Time Regular {{-- ({{ $s->ot_regular_in_hours }}) --}}</td>
				<td align="right">$</td>
				<td align="right">{{ $s->ot_regular }}</td>
			</tr>
			<tr>
				<td>Over Time Holiday {{-- ({{ $s->ot_holiday_in_hours }}) --}}</td>
				<td align="right">$</td>
				<td align="right">{{ $s->ot_holiday }}</td>
			</tr>
			<tr>
				<td>Incentive {{-- Sales --}}</td>
				<td align="right">$</td>
				<td align="right">{{ $s->sr->incentive }}</td>
			</tr>
			<tr>
				<td>Food Allowance</td>
				<td align="right">$</td>
				<td align="right">{{ $s->sr->eat_cost }}</td>
			</tr>
			{{-- <tr>
				<td>ETC</td>
				<td align="right">{{ $s->sr->etc }}</td>
			</tr> --}}
			<tr>
				<td>Retention</td>
				<td align="right">$</td>
				<td align="right">{{ $s->sr->ritation }}</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><hr></td>
				<td>+</td>
			</tr>
			<tr>
				<td>Sub Total</td>
				<td align="right">$</td>
				<td align="right">{{ $s->gross_salary }}</td>
			</tr>
		</tbody>
	</table>
	<table style="margin-bottom: 5px;">
		<tbody>
			<tr>
				<td width="250px"><u>Deduction</u></td>
			</tr>
			<tr>
				<td>Seguranca Social (4%)</td>
				<td align="right">$</td>
				<td width="50px" align="right">{{ $s->seguranca }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td>Cash Withdrawal</td>
				<td align="right">$</td>
				<td align="right">{{ $s->sr->cash_receipt }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td>Absent ({{ $s->absent }} days)</td>
				<td align="right">$</td>
				<td align="right">{{ $s->absent_punishment }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><hr></td>
				<td>+</td>
			</tr>
			<tr>
				<td>Sub Total Deduction</td>
				<td align="right">$</td>
				<td align="right">{{ $s->seguranca+$s->sr->cash_receipt }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td>Total Received</td>
				<td align="right">$</td>
				<td align="right">{{ $s->clear_salary }}</td>
			</tr>
		</tbody>
	</table>
	<table>
		<tbody>
			<tr>
				<td>{{ 'Dili '.date('F, Y-m-d') }}</td>
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
</div>
@endforeach
<script>
	window.print();
</script>