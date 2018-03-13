<table class="table table-bordered table-striped">
	<tr>
		<td colspan="2"><h4 class="text-center"><strong>Officer</strong></h4></td>
	</tr>
	<tr>
		<td><strong>Employee</strong></td>
		<td>{{ $data->e_name }}</td>
	</tr>
	<tr>
		<td><strong>Department</strong></td>
		<td>{{ $data->d_name }}</td>
	</tr>
	<tr>
		<td><strong>Sub Department</strong></td>
		<td>{{ $data->sd_name }}</td>
	</tr>
	<tr>
		<td><strong>Position</strong></td>
		<td>{{ ($data->p_name) }}</td>
	</tr>
	<tr>
		<td colspan="2"><h4 class="text-center"><strong>Assignor</strong></h4></td>
	</tr>
	<tr>
		<td><strong>Employee</strong></td>
		<td>{{ $data->e_name }}</td>
	</tr>
	<tr>
		<td><strong>Department</strong></td>
		<td>{{ $data->d_name }}</td>
	</tr>
	<tr>
		<td><strong>Sub Department</strong></td>
		<td>{{ $data->sd_name }}</td>
	</tr>
	<tr>
		<td><strong>Position</strong></td>
		<td>{{ ($data->p_name) }}</td>
	</tr>
	<tr>
		<td colspan="2"><h4 class="text-center"><strong>Area</strong></h4></td>
	</tr>
	@for($i=1;$i<=6;$i++)
		<tr>
			<td><strong>Area {{ $i }}</strong></td>
			<td><?php eval('echo $data->area_'.$i.';'); ?></td>
		</tr>
	@endfor
	<tr>
		<td colspan="2"><h4 class="text-center"><strong>Cost And Other</strong></h4></td>
	</tr>
	<tr>
		<td><strong>SPPD</strong></td>
		<td>{{ $data->sppd }}</td>
	</tr>
	<tr>
		<td><strong>Start Date</strong></td>
		<td>{{ english_datetime($data->start_date) }}</td>
	</tr>
	<tr>
		<td><strong>End Date</strong></td>
		<td>{{ english_datetime($data->end_date) }}</td>
	</tr>
	<tr>
		<td><strong>Depart From</strong></td>
		<td>{{ $data->depart_from }}</td>
	</tr>
	<tr>
		<td><strong>Advanced Cost ($)</strong></td>
		<td>{{ $data->advanced_cost }}</td>
	</tr>
	<tr>
		<td><strong>Lodging/Hotel Cost ($)</strong></td>
		<td>{{ $data->lodging_cost }}</td>
	</tr>
	<tr>
		<td><strong>Eat Cost ($)</strong></td>
		<td>{{ $data->eat_cost }}</td>
	</tr>
	<tr>
		<td><strong>Fuel Cost ($)</strong></td>
		<td>{{ $data->fuel_cost }}</td>
	</tr>
	<tr>
		<td><strong>Other Cost ($)</strong></td>
		<td>{{ $data->other_cost }}</td>
	</tr>
	<tr>
		<td><strong>Created At</strong></td>
		<td>{{ english_datetime($data->created_at) }}</td>
	</tr>
	<tr>
		<td><strong>Report At</strong></td>
		<td>{{ english_datetime($data->report_at) }}</td>
	</tr>
</table>