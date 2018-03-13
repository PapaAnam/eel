<table>
	<tr>
		<td width="40%">
			<img class="pull-left" width="100px" height="40px" src="@if($lisun){{ asset('images/company/lisun.jpg') }}@else{{ local_file('images\company\lisun.jpg') }}@endif">
		</td>
		<td>
			<h3>Employees</h3>
		</td>
	</tr>
</table>
<table id="example1" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="10px">#</th>
			<th>NIN</th>
			<th>Name</th>
			<th>Department</th>
			<th>Position</th>
			<th>Type</th>
			<th>Joining Date</th>
			<th>Phone Number</th>
			<th>Gender</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; ?>
		@foreach($data as $d)
		<tr>
			<td>{{ $no++ }}</td>
			<td align="right">{{ $d->nin }}</td>
			<td>{{ $d->name }}</td>
			<td>{{ $d->dep->name }}</td>
			<td>{{ $d->pos->name }}</td>
			<td>{{ employee_type($d->type) }}</td>
			<td align="right">{{ english_date($d->joining_date) }}</td>
			<td align="right">{{ $d->handphone }}</td>
			<td>{{ $d->gender }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
<table>
	<tr>
		<td width="50%">
			Number of active employees
		</td>
		<td>
			{{ App\Models\Hris\Employee::active_employee_count() }}
		</td>
	</tr>
	<tr>
		<td>
			Number of active female employees
		</td>
		<td>
			{{ App\Models\Hris\Employee::active_female_employee_count() }}
		</td>
	</tr>
	<tr>
		<td>
			Number of active male employees
		</td>
		<td>
			{{ App\Models\Hris\Employee::active_male_employee_count() }}
		</td>
	</tr>
	<tr>
		<td>
			Number of employees in the accounting department
		</td>
		<td>
			{{ App\Models\Hris\Employee::accounting_employee_count() }}
		</td>
	</tr>
	<tr>
		<td>
			Number of employees in the warehouse unilever department
		</td>
		<td>
			{{ App\Models\Hris\Employee::unilever_employee_count() }}
		</td>
	</tr>
	<tr>
		<td>
			Number of permanent employees
		</td>
		<td>
			{{ App\Models\Hris\Employee::permanent_employee_count() }}
		</td>
	</tr>
</table>
@push('ready-function')

@endpush