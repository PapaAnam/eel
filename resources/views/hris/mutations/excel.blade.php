<table>
	<tr>
		<td width="40%">
			<img class="pull-left" width="100px" height="40px" src="@if($lisun){{ asset('images/company/lisun.jpg') }}@else{{ local_file('images\company\lisun.jpg') }}@endif">
		</td>
		<td>
			<h3>Mutations</h3>
		</td>
	</tr>
</table>
<table id="example1" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="10px">#</th>
			<th>Employee</th>
			<th>Old/New Department</th>
			<th>Old/New Sub Department</th>
			<th>Old/New Position</th>
			<th>Reason</th>
			<th>Created At</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; ?>
		@foreach($data as $d)
		<tr>
			<td>{{ $no }}</td>
			<td>{{ $d->e_name }}</td>
			<td>{{ $data2[$no-1]->d_name.'/'.$d->d_name }}</td>
			<td>{{ $data2[$no-1]->sd_name.'/'.$d->sd_name }}</td>
			<td>{{ $data2[$no-1]->p_name.'/'.$d->p_name }}</td>
			<td>{{ $d->reason }}</td>
			<td>{{ english_datetime($d->created_at) }}</td>
		</tr>
		<?php $no++ ?>
		@endforeach
	</tbody>
</table>