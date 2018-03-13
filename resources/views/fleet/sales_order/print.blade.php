@extends('layouts.export.template')
@section('content')
<table>
	<tr>
		<td>
			<img class="pull-left" width="100px" height="40px" src="{{ asset('images/company/lisun.jpg') }}">
		</td>
		<td>
			<h3>Sales Order</h3>
		</td>
	</tr>
</table>
Tanggal : {{ $tgl }}
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="10px">#</th>
			@foreach (collect($data[0])->keys() as $key)
			<th>{{ $key }}</th>
			@endforeach
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; ?>
		@foreach($data as $d)
		<tr>
			<td>{{ $no++ }}</td>
			@foreach ($d as $dd)
			<td>{{ $dd }}</td>
			@endforeach
		</tr>
		@endforeach
	</tbody>
</table>
@endsection