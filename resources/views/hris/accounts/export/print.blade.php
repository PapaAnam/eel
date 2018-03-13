@extends('layouts.export.template')
@section('content')
<table>
	<tr>
		<td width="40%">
			<img class="pull-left" width="100px" height="40px" src="{{ asset('images/company/lisun.jpg') }}">
		</td>
		<td>
			<h3>Accounts</h3>
		</td>
	</tr>
</table>
<table id="example1" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="10px">#</th>
			<th>Username</th>
			<th>Level</th>
			<th>Employee</th>
			<th>Department</th>
			<th>Position</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; ?>
		@foreach($data as $d)
		<tr>
			<td>{{ $no++ }}</td>
			<td>{{ $d->username }}</td>
			<td>{{ level($d->level) }}</td>
			<td>{{ $d->e_name }}</td>
			<td>{{ $d->d_name.'/'.$d->sd_name }}</td>
			<td>{{ $d->p_name }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection