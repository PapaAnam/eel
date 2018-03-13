<table>
	<tr>
		<td width="40%">
			<img class="pull-left" width="100px" height="40px" src="@if($lisun){{ asset('images/company/lisun.jpg') }}@else{{ local_file('images\company\lisun.jpg') }}@endif">
		</td>
		<td>
			<h3>Departments</h3>
		</td>
	</tr>
</table>
<table id="example1" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="10px">#</th>
			<th>Name</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; ?>
		@foreach($data as $d)
		<tr>
			<td>{{ $no }}</td>
			<td>
				{{ $d->name }}
				@if(count($d->depts))
				<ul>
					@foreach($d->depts as $dd)
					<li>{{ $dd->name }}</li>
					@if(count($dd->depts))
					<ul>
						@foreach($dd->depts as $ddd)
						<li>{{ $ddd->name }}</li>
						@if(count($ddd->depts))
						<ul>
							@foreach($ddd->depts as $dddd)
							<li>{{ $dddd->name }}</li>
							@if(count($dddd->depts))
							<ul>
								@foreach($dddd->depts as $ddddd)
								<li>{{ $ddddd->name }}</li>
								@endforeach
							</ul>		
							@endif
							@endforeach
						</ul>
						@endif
						@endforeach
					</ul>
					@endif
					@endforeach
				</ul>
				@endif
			</td>
		</tr>
		<?php $no++ ?>
		@endforeach
	</tbody>
</table>