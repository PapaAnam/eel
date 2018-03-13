@extends('layouts.export.template')
@section('content')
<table>
	<tr>
		<td width="40%">
			<img class="pull-left" width="100px" height="40px" src="{{ asset('images/company/lisun.jpg') }}">
		</td>
		<td>
			<h3>Official Travel</h3>
		</td>
	</tr>
</table>
<table id="example1" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="10px">#</th>
			<th>SPPD</th>
			<th>Employee</th>
			<th>Dept/Pos</th>
			<th>Assignor</th>
			<th>Date</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; ?>
		@foreach($data as $d)
		<tr>
			<td>{{ $no }}</td>
			<td>{{ $d['sppd'] }}</td>
			<td>{{ '('.$d['nin'].') '.$d['emp'] }}</td>
			<td>{{ $d['department'].'/'.$d['position'] }}</td>
			<td>{{ '('.$d['assnin'].') '.$d['ass'] }}</td>
			<td>{{ substr($d['start_date'], 0, 10).' -> '.substr($d['end_date'], 0, 10) }}</td>
		</tr>
		<?php $no++ ?>
		@endforeach
	</tbody>
</table>
@endsection