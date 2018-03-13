<table>
	<tr>
		<td width="40%">
			<img class="pull-left" width="100px" height="40px" src="@if($lisun){{ asset('images/company/lisun.jpg') }}@else{{ local_file('images\company\lisun.jpg') }}@endif">
		</td>
		<td>
			<h3>Sub Departments</h3>
		</td>
	</tr>
</table>
<table id="example1" class="table table-bordered table-striped">
<thead>
<tr>
  <th width="10px">#</th>
  <th>Name</th>
  <th>Primary Department</th>
</tr>
</thead>
<tbody>
<?php $no = 1; ?>
@foreach($data as $d)
<tr>
  <td>{{ $no }}</td>
  <td>{{ $d->name }}</td>
  <td>{{ $d->d_name }}</td>
</tr>
<?php $no++ ?>
@endforeach
</table>