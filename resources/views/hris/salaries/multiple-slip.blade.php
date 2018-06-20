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
	@if($s->sg)
	<table style="margin-bottom: 5px;">
		<tbody>
			@if($s->sg->basic_salary == 1)
			<tr>
				<td width="250px">Basic Salary</td>
				<td align="right">$</td>
				<td width="50px" align="right">{{ $s->sr->basic_salary }}</td>
			</tr>
			@endif
			@if($s->sg->basic_salary == 1)
			<tr>
				<td>Allowance</td>
				<td align="right">$</td>
				<td align="right">{{ $s->sr->allowance }}</td>
			</tr>
			@endif
			{{-- <tr>
				<td>Total Work Day ({{ $total_hari_kerja[$loop->index] }} days)</td>
				<td align="right"></td>
			</tr>
			@endif --}}
			@if($s->sg->ot_regular == 1)
			<tr>
				<td>Over Time Regular {{-- ({{ $s->ot_regular_in_hours }}) --}}</td>
				<td align="right">$</td>
				<td align="right">{{ $s->ot_regular }}</td>
			</tr>
			@endif
			@if($s->sg->ot_holiday == 1)
			<tr>
				<td>Over Time Holiday {{-- ({{ $s->ot_holiday_in_hours }}) --}}</td>
				<td align="right">$</td>
				<td align="right">{{ $s->ot_holiday }}</td>
			</tr>
			@endif
			@if($s->sg->incentive == 1)
			<tr>
				<td>Incentive {{-- Sales --}}</td>
				<td align="right">$</td>
				<td align="right">{{ $s->sr->incentive }}</td>
			</tr>
			@endif
			@if($s->sg->food_allowance == 1)
			<tr>
				<td>Food Allowance</td>
				<td align="right">$</td>
				<td align="right">{{ $s->sr->eat_cost }}</td>
			</tr>
			@endif
			@if($s->sg->rent_motorcycle == 1)
			<tr>
				<td>Rent Motorcycle</td>
				<td align="right">$</td>
				<td align="right">{{ $s->sr->rent_motorcycle }}</td>
			</tr>
			@endif
			{{-- <tr>
				<td>ETC</td>
				<td align="right">{{ $s->sr->etc }}</td>
			</tr> --}}
			@if($s->sg->retention == 1)
			<tr>
				<td>Retention</td>
				<td align="right">$</td>
				<td align="right">{{ $s->sr->ritation }}</td>
			</tr>
			@endif
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
				<td width="180px"><u>Deduction</u></td>
			</tr>
			@if($s->sg->seguranca_social == 1)
			<tr>
				<td>Seguranca Social (4%)</td>
				<td align="right">$</td>
				<td width="50px" align="right">{{ $s->seguranca }}</td>
			</tr>
			@endif
			@if($s->sg->cash_withdrawal == 1)
			<tr>
				<td>Cash Withdrawal</td>
				<td align="right">$</td>
				<td align="right">{{ $s->sr->cash_receipt }}</td>
			</tr>
			@endif
			@if($s->sg->absent == 1)
			<tr>
				<td>Absent ({{ $s->absent }} days)</td>
				<td align="right">$</td>
				<td align="right">{{ $s->absent_punishment }}</td>
			</tr>
			@endif
			@if($s->sg->tax_insurance == 1)
			<tr>
				<td>Tax Insurance</td>
				<td align="right">$</td>
				<td align="right">{{ $s->tax_insurance }}</td>
			</tr>
			@endif
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
	@else
	<b style="color: red;">Not set salary group</b>
	@endif
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