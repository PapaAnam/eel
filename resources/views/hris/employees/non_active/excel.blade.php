<h3 class="text-center">Non Active Employees</h3>
<table id="example1" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="10px">#</th>
			<th>NIN</th>
			<th>Name</th>
			<th>Department</th>
			<th>Sub Department</th>
			<th>Position</th>
			<th>Non Active At</th>
			<th>Reason</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; ?>
		@foreach($data as $d)
		<tr>
			<td>{{ $no }}</td>
			<td>{{ $d->nin }}</td>
			<td>{{ $d->name }}</td>
			<td>{{ $d->d_name }}</td>
			<td>{{ $d->sd_name }}</td>
			<td>{{ $d->p_name }}</td>
			<td>{{ english_date($d->non_active_at) }}</td>
			<td>{{ non_active($d->non_active) }}</td>
		</tr>
		<?php $no++ ?>
		@endforeach
	</tbody>
</table>