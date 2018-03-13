@extends('layouts.export.template')
@section('content')
<table>
	<tr>
		<td width="40%">
			<img class="pull-left" width="100px" height="40px" src="{{ asset('images/company/lisun.jpg') }}">
		</td>
		<td>
			<h3>Attendance</h3>
		</td>
	</tr>
</table>
<table id="example1" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="10px">#</th>
			<th>Employee</th>
			<th>Date</th>
			<th>Status</th>
			<th>Enter At</th>
			<th>Break</th>
			<th>End Break</th>
			<th>Out At</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; ?>
		@foreach($data as $d)
		<tr>
			<td>{{ $no }}</td>
			<td>{{ $d->e_name }}</td>
			<td>{{ english_date($d->created_at) }}</td>
			<td>{{ absence_status($d->status) }}</td>
			<td>{{ $d->enter }}</td>
			<td>{{ $d->break }}</td>
			<td>{{ $d->end_break }}</td>
			<td>{{ $d->out }}</td>
		</tr>
		<?php $no++ ?>
		@endforeach
	</tbody>
</table>
@endsection