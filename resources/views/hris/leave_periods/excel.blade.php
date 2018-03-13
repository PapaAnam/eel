<table>
	<tr>
		<td width="40%">
			<img class="pull-left" width="100px" height="40px" src="@if($lisun){{ asset('images/company/lisun.jpg') }}@else{{ local_file('images\company\lisun.jpg') }}@endif">
		</td>
		<td>
			<h3>Leave Periods</h3>
		</td>
	</tr>
</table>
<table class="table table-bordered table-striped">
	<tbody class="tbody-leave-period">
		<tr>
			<td><strong>Employee Type</strong></td>
			<td><strong>Local Employee</strong></td>
			<td><strong>International Employee</strong></td>
		</tr>
		<tr>
			<td><strong>Special Permits</strong></td>
			<td>{{ $local->special_permit }}</td>
			<td>{{ $international->special_permit }}</td>
		</tr>
		<tr>
			<td><strong>Holiday</strong></td>
			<td>{{ $local->holiday }}</td>
			<td>{{ $international->holiday }}</td>
		</tr>
		<tr>
			<td><strong>Father Leave</strong></td>
			<td>{{ $local->father_leave }}</td>
			<td>{{ $international->father_leave }}</td>
		</tr>
		<tr>
			<td><strong>Sick</strong></td>
			<td>{{ $local->sick }}</td>
			<td>{{ $international->sick }}</td>
		</tr>
		<tr>
			<td><strong>Pregnancy</strong></td>
			<td>{{ $local->pregnancy }}</td>
			<td>{{ $international->pregnancy }}</td>
		</tr>
	</tbody>
</table>