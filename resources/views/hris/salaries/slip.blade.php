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
		<tr>
			<td>Job Title</td>
			<td>: {{ $s->emp->pos->name }}</td>
		</tr>
		<tr>
			<td>Period</td>
			<td>: {{ english_month_name($s->month).' '.$s->year }}</td>
		</tr>
	</tbody>
</table>
@if($s->sg)
<table style="margin-bottom: 5px;">
	<tbody>
		<tr>
			<td>Component Salary (A)</td>
		</tr>
		@if($s->sg->basic_salary == 1)
		<tr>
			<td width="250px">Basic Salary</td>
			<td align="right">$</td>
			<td width="50px" align="right">{{ $s->sr ? $s->sr->basic_salary : 'Not Set' }}</td>
		</tr>
		@endif
		@if($s->sg->basic_salary == 1)
		<tr>
			<td>Allowance</td>
			<td align="right">$</td>
			<td align="right">{{ $s->sr ? $s->sr->allowance : 'Not Set' }}</td>
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
			<td align="right">{{ $s->sr ? $s->sr->incentive : 'Not Set' }}</td>
		</tr>
		@endif
		@if($s->sg->food_allowance == 1)
		<tr>
			<td>Food Allowance</td>
			<td align="right">$</td>
			<td align="right">{{ $s->sr ? $s->sr->eat_cost : 'Not Set' }}</td>
		</tr>
		@endif
		@if($s->sg->rent_motorcycle == 1)
		<tr>
			<td>Rent Motorcycle</td>
			<td align="right">$</td>
			<td align="right">{{ $s->sr ? $s->sr->rent_motorcycle : 'Not Set' }}</td>
		</tr>
		@endif
		@if($s->sg->etc == 1)
		<tr>
			<td>ETC</td>
			<td align="right">$</td>
			<td align="right">{{ $s->sr ? $s->sr->etc : 'Not Set' }}</td>
		</tr>
		@endif
		@if($s->sg->retention == 1)
		<tr>
			<td>Retention</td>
			<td align="right">$</td>
			<td align="right">{{ $s->sr ? $s->sr->ritation : 'Not Set' }}</td>
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
<table style="width: 90%;">
	<tbody>
		<tr>
			<td width="116px"><u>Deduction (B)</u></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		@if($s->sg->tax_insurance == 1)
		<tr>
			<td width="116px">Income Tax (10%)</td>
			<td align="right">$</td>
			<td align="right">{{ $s->tax_insurance }}</td>
			<td></td>
		</tr>
		@endif
		@if($s->sg->seguranca_social == 1)
		<tr>
			<td width="116px">Seguranca Social (4%)</td>
			<td align="right">$</td>
			<td width="50px" align="right">{{ $s->seguranca }}</td>
			<td></td>
		</tr>
		@endif
		@if($s->sg->cash_withdrawal == 1)
		<tr>
			<td width="116px">Cash Withdrawal</td>
			<td align="right">$</td>
			<td align="right">{{ $s->sr ? $s->sr->cash_receipt : 'Not Set' }}</td>
			<td></td>
		</tr>
		@endif
		@if($s->sg->absent == 1)
		<tr>
			<td width="116px">Absent ({{ $s->absent }} days)</td>
			<td align="right">$</td>
			<td align="right">{{ $s->absent_punishment }}</td>
			<td></td>
		</tr>
		@endif
		<tr>
			<td width="116px"></td>
			<td></td>
			<td><hr></td>
			<td>+</td>
		</tr>
		<tr>
			<td width="116px">Sub Total Deduction</td>
			<td align="right">$</td>
			<td align="right">{{ $s->total_potongan }}</td>
			<td></td>
		</tr>
	</tbody>
</table>
<table style="margin-bottom: 5px;">
	<tbody>
		<tr>
			<td width="250px">Total Received (A-B)</td>
			<td align="right">$</td>
			<td width="50px" align="right">{{ $s->clear_salary }}</td>
			<td>&nbsp;&nbsp;</td>
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