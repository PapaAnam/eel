@extends('layouts.export.template')
@section('content')
<table>
	<tr>
		<td width="40%">
			<img class="pull-left" width="100px" height="40px" src="{{ asset('images/company/lisun.jpg') }}">
		</td>
		<td>
			<h3>Over Time</h3>
		</td>
	</tr>
</table>
<table id="example1" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="10px">#</th>
			<th>Employee</th>
			<th>Department</th>
			<th>Sub Department</th>
			<th>Position</th>
			<th>Date</th>
			<th>Pay ($)</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; ?>
		@foreach($data as $d)
		<tr>
			<td>{{ $no }}</td>
			<td>{{ $d->e_name }}</td>
			<td>{{ $d->d_name }}</td>
			<td>{{ $d->sd_name }}</td>
			<td>{{ $d->p_name }}</td>
			<td>{{ english_datetime($d->created_at) }}</td>
			<td>{{ $d->pay }}</td>
		</tr>
		<?php $no++ ?>
		@endforeach
	</tbody>
</table>
@endsection