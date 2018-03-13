<table class="table table-bordered table-striped">
	<tr>
		<td><strong>Mutation ID</strong></td>
		<td>{{ $data->mutation_id }}</td>
	</tr>
	<tr>
		<td><strong>Employee</strong></td>
		<td>{{ $data->e_name }}</td>
	</tr>
	<tr>
		<td><strong>New Department</strong></td>
		<td>{{ $data->d_name }}</td>
	</tr>
	<tr>
		<td><strong>New Sub Department</strong></td>
		<td>{{ $data->sd_name }}</td>
	</tr>
	<tr>
		<td><strong>New Position</strong></td>
		<td>{{ $data->p_name }}</td>
	</tr>
	<tr>
		<td><strong>Old Department</strong></td>
		<td>{{ $old_department }}</td>
	</tr>
	<tr>
		<td><strong>Old Sub Department</strong></td>
		<td>{{ $old_sub_department }}</td>
	</tr>
	<tr>
		<td><strong>Old Position</strong></td>
		<td>{{ $old_position }}</td>
	</tr>
	<tr>
		<td><strong>Leader Who Rule</strong></td>
		<td>{{ $manager.' ('.$manager_position.')' }}</td>
	</tr>
	<tr>
		<td><strong>Leader Department</strong></td>
		<td>{{ $manager_department.'/'.$manager_sub_department }}</td>
	</tr>
	<tr>
		<td><strong>Leader City</strong></td>
		<td>{{ $data->city }}</td>
	</tr>
	<tr>
		<td><strong>Reason</strong></td>
		<td>{{ $data->reason }}</td>
	</tr>
	<tr>
		<td><strong>Created At</strong></td>
		<td>{{ english_date($data->created_at) }}</td>
	</tr>
	<tr>
		<td><strong>Effect On</strong></td>
		<td>{{ english_date($data->effect_on) }}</td>
	</tr>
</table>