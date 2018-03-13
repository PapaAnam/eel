<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_10" data-toggle="tab">Salary</a></li>
      <li><a href="#tab_20" data-toggle="tab">Absences</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab_10">
        <table class="table table-bordered table-striped">
			<tr>
				<td><strong>Employee</strong></td>
				<td>{{ $data->e_name }}</td>
			</tr>
			<tr>
				<td><strong>Department</strong></td>
				<td>{{ $data->d_name }}</td>
			</tr>
			<tr>
				<td><strong>Position</strong></td>
				<td>{{ ($data->p_name) }}</td>
			</tr>
			<tr>
				<td><strong>Salary At</strong></td>
				<td>{{ english_datetime($data->created_at) }}</td>
			</tr>
			<tr>
				<td><strong>Month</strong></td>
				<td>{{ english_month_name($data->month) }}</td>
			</tr>
			<tr>
				<td><strong>Year</strong></td>
				<td>{{ $data->year }}</td>
			</tr>
			<tr>
				<td><strong>Basic Salary ($)</strong></td>
				<td>{{ $data->basic_salary }}</td>
			</tr>
			<tr>
				<td><strong>Eat Cost ($)</strong></td>
				<td>{{ $data->eat_cost }}</td>
			</tr>
			<tr>
				<td><strong>Allowance ($)</strong></td>
				<td>{{ $data->allowance }}</td>
			</tr>
			<tr>
				<td><strong>Incentive ($)</strong></td>
				<td>{{ $data->incentive }}</td>
			</tr>
			<tr>
				<td><strong>Over Work ($)</strong></td>
				<td>{{ $over_work }}</td>
			</tr>
			<tr>
				<td><strong>Total ($)</strong></td>
				<td>{{ $data->basic_salary+$data->eat_cost+$data->allowance+$data->incentive+$over_work }}</td>
			</tr>
		</table>
      </div>
      <div class="tab-pane" id="tab_20">
        <table class="table table-bordered table-striped">
			<tr>
				<td><strong>Present</strong></td>
				<td>{{ $absences->present }}</td>
			</tr>
			<tr>
				<td><strong>Sick</strong></td>
				<td>{{ $absences->sick }}</td>
			</tr>
			<tr>
				<td><strong>Absent</strong></td>
				<td>{{ $absences->absent }}</td>
			</tr>
			<tr>
				<td><strong>Official Travel</strong></td>
				<td>{{ $absences->official_travel }}</td>
			</tr>
		</table>
      </div>
    </div>
</div>
