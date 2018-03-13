<table>
	<tr>
		<td width="40%">
			<img class="pull-left" width="100px" height="40px" src="@if($lisun){{ asset('images/company/lisun.jpg') }}@else{{ local_file('images\company\lisun.jpg') }}@endif">
		</td>
		<td>
			<h3>Employees Use Leave Periods</h3>
		</td>
	</tr>
</table>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="10px">#</th>
			<th>Department</th>
			<th>Position</th>
			<th>Employee</th>
			<th>Special Permit</th>
			<th>Holiday</th>
			<th>Father Leave</th>
			<th>Sick</th>
			<th>Pregnancy</th>
			<th>Year</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; ?>
		@foreach ($data as $d)
		<tr>
			<td>{{ $no++ }}</td>
			<td>{{ $d->d_name.'/'.$d->sd_name }}</td>
			<td>{{ $d->p_name }}</td>
			<td>{{ $d->e_name }}</td>
			<td>{{ $d->special_permit }}</td>
			<td>{{ $d->holiday }}</td>
			<td>{{ $d->father_leave }}</td>
			<td>{{ $d->sick }}</td>
			<td>{{ $d->pregnancy }}</td>
			<td>{{ $d->year }}</td>
		</tr>
		@endforeach
	</tbody>
</table>