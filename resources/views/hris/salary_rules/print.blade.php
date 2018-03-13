@extends('layouts.export.template')
@section('content')
<table>
	<tr>
		<td width="40%">
			<img class="pull-left" width="100px" height="40px" src="{{ asset('images/company/lisun.jpg') }}">
		</td>
		<td>
			<h3>Salary Rules</h3>
		</td>
	</tr>
</table>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="10px">#</th>
			<th>Employee</th>
			<th>Dept/Pos</th>
			<th>Basic Salary</th>
			<th>Allowance</th>
			<th>Incentive</th>
			<th>Eat Cost</th>
			<th>Active</th>
			<th>Last Updated</th>
		</tr>
	</thead>
	<tbody>
		@foreach($kk as $d)
		<tr>
			<td>{{ ++$index }}</td>
			<td>{{ '('.$d->nin.') '.$d->name }}</td>
			<td>{{ $d->dep->name.'/'.$d->pos->name }}</td>
			<td align="right">
				{!! $d->sr ? number_format($d->sr->basic_salary, 2, ',', '.') : '<font color="red">Not Set Yet</font>' !!}
			</td>
			<td align="right">
				{!! $d->sr ? number_format($d->sr->allowance, 2, ',', '.') : '<font color="red">Not Set Yet</font>' !!}
			</td>
			<td align="right">
				{!! $d->sr ? number_format($d->sr->incentive, 2, ',', '.') : '<font color="red">Not Set Yet</font>' !!}
			</td>
			<td align="right">
				{!! $d->sr ? number_format($d->sr->eat_cost, 2, ',', '.') : '<font color="red">Not Set Yet</font>' !!}
			</td>
			<td align="right">
				{!! $d->sr ? (($d->sr->status == 0) ? 'N' : 'Y') : '<font color="red">Not Set Yet</font>' !!}
			</td>
			<td align="right">
				{!! $d->sr ? $d->sr->created_at : '<font color="red">Not Set Yet</font>' !!}
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection