<table class="table table-bordered table-striped">
	<thead>
		<th>#</th>
		<th>Position</th>
	</thead>
	<tbody>
		<?php $no = 1; ?>
		@foreach($position as $p)
			<tr>
				<td>{{ $no }}</td>
				<td>{{ $p->name }}</td>
			</tr>
			<?php $no++ ?>
		@endforeach
	</tbody>
</table>
<table class="table table-bordered table-striped">
	<thead>
		<th>#</th>
		<th>Employee</th>
	</thead>
	<tbody>
		<?php $no = 1; ?>
		@for($i=0; $i<count($employee); $i++)
			@foreach($employee[$i] as $e)
				<tr>
					<td>{{ $no }}</td>
					<td>{{ $e->name }}</td>
				</tr>
				<?php $no++ ?>
			@endforeach
		@endfor
	</tbody>
</table>