@extends('layouts.export.template')
@section('content')
<table>
	<tr>
		<td width="40%">
			<img class="pull-left" width="100px" height="40px" src="{{ asset('images/company/lisun.jpg') }}">
		</td>
		<td>
			<h3>Salary Rule For Employees</h3>
		</td>
	</tr>
</table>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>NIN</th>
			<th>Employee</th>
			<th>Department</th>
			<th>Position</th>
			<th>Basic Salary</th>
			<th>Eat Cost</th>
			<th>Allowance</th>
			<th>Incentive</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; ?>
		@foreach($data as $d)
		<tr>
			<td>{{ $d->nin }}</td>
			<td>{{ $d->e_name }}</td>
			<td>{{ $d->d_name.' / '.$d->sd_name }}</td>
			<td>{{ $d->p_name }}</td>
			<td>{{ $d->basic_salary }}</td>
			<td>{{ $d->eat_cost }}</td>
			<td>{{ $d->allowance }}</td>
			<td>{{ $d->incentive }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection