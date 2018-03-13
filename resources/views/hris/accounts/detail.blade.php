<div class="panel panel-default">
	<div class="panel-heading">Menu Authority</div>
	<div class="panel-body">
		<table class="table table-bordered table-striped">
			<tr>
				<td><strong>Department</strong></td>
				<td>{{ accessed($data->department) }}</td>
				<td><strong>Sub Department</strong></td>
				<td>{{ accessed($data->sub_department) }}</td>
			</tr>
			<tr>
				<td><strong>Positions</strong></td>
				<td>{{ accessed($data->position) }}</td>
				<td><strong>Employees</strong></td>
				<td>{{ accessed($data->employee) }}</td>
			</tr>
			<tr>
				<td><strong>Salary Rule</strong></td>
				<td>{{ accessed($data->salary_rule) }}</td>
				<td><strong>Special Day</strong></td>
				<td>{{ accessed($data->special_day) }}</td>
			</tr>
			<tr>
				<td><strong>Manage Attendance</strong></td>
				<td>{{ accessed($data->attendance) }}</td>
				<td><strong>Over Time</strong></td>
				<td>{{ accessed($data->over_time) }}</td>
			</tr>
			<tr>
				<td><strong>Oficial Travel</strong></td>
				<td>{{ accessed($data->official_travel) }}</td>
				<td><strong>Mutations</strong></td>
				<td>{{ accessed($data->mutation) }}</td>
			</tr>
			<tr>
				<td><strong>Payroll</strong></td>
				<td>{{ accessed($data->payroll) }}</td>
				<td><strong>Accounts</strong></td>
				<td>{{ accessed($data->account) }}</td>
			</tr>
			<tr>
				<td><strong>Leave Period</strong></td>
				<td>{{ accessed($data->leave_period) }}</td>
				<td><strong>Announcements</strong></td>
				<td>{{ accessed($data->announcement) }}</td>
			</tr>
		</table>
	</div>
</div>