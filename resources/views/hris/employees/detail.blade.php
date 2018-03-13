<div class="row">
	<div class="col-sm-5">
		<div class="panel panel-default">
			<div class="panel-heading">Biography</div>
			<div class="panel-body">
				<table class="table table-bordered table-striped">
					<tr>
						<td><strong>NIN</strong></td>
						<td>{{ $data->nin }}</td>
					</tr>
					<tr>
						<td><strong>Name</strong></td>
						<td>{{ $data->name }}</td>
					</tr>
					<tr>
						<td><strong>Gender</strong></td>
						<td>{{ $data->gender }}</td>
					</tr>
					<tr>
						<td><strong>Born In</strong></td>
						<td>{{ $data->born_in }}</td>
					</tr>
					<tr>
						<td><strong>Birthdate</strong></td>
						<td>{{ english_date($data->birthdate) }}</td>
					</tr>
					<tr>
						<td><strong>Handphone</strong></td>
						<td>{{ $data->handphone }}</td>
					</tr>
					<tr>
						<td><strong>Marital Status</strong></td>
						<td>{{ maried($data->marital_status) }}</td>
					</tr>
					<tr>
						<td><strong>Present Address</strong></td>
						<td>{{ $data->present_address }}</td>
					</tr>
					@if($data->non_active!=null)
					<tr class="fg-red">
						<td><strong>Non Active At</strong></td>
						<td>{{ english_date($data->non_active_at) }}</td>
					</tr>
					<tr class="fg-red">
						<td><strong>Reason</strong></td>
						<td>{{ non_active($data->non_active) }}</td>
					</tr>
					@endif
				</table>
			</div>
		</div>
	</div>
	<div class="col-sm-5">
		<div class="panel panel-default">
			<div class="panel-heading">Placement</div>
			<div class="panel-body">
				<table class="table table-bordered table-striped">
					<tbody>
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
							<td>{{ $data->p_name }}</td>
						</tr>
						<tr>
							<td><strong>From</strong></td>
							<td>{{ $data->e_from }}</td>
						</tr>
						<tr>
							<td><strong>Type</strong></td>
							<td>{{ employee_type($data->type) }}</td>
						</tr>
						<tr>
							<td><strong>BRI Account</strong></td>
							<td>{{ $data->bri_account }}</td>
						</tr>
						<tr>
							<td><strong>Joining At</strong></td>
							<td>{{ english_date($data->joining_date) }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-sm-2">
		<div class="panel panel-default">
			<div class="panel-heading">Photo</div>
			<div class="panel-body">
				<div class="image-container rounded bordered">
					<div class="frame"><img id="img-photo" src="{{ asset('storage/'.$data->photo) }}"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<div class="panel panel-default">
			<div class="panel-heading">Family Background</div>
			<div class="panel-body">
				<table class="table table-bordered table-striped">
					<tr>
						<td><strong>Father</strong></td>
						<td>{{ $data->father }}</td>
					</tr>
					<tr>
						<td><strong>Mother</strong></td>
						<td>{{ $data->mother }}</td>
					</tr>
					<tr>
						<td><strong>Husband</strong></td>
						<td>{{ $data->husband }}</td>
					</tr>
					<tr>
						<td><strong>Wife</strong></td>
						<td>{{ $data->wife }}</td>
					</tr>
					<tr>
						<td><strong>Son</strong></td>
						<td>{{ $data->son }}</td>
					</tr>
					<tr>
						<td><strong>Wife</strong></td>
						<td>{{ $data->daughter }}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="panel panel-default">
			<div class="panel-heading">Educational History</div>
			<div class="panel-body">
				<table class="table table-bordered table-striped">
					<tr>
						<td><strong>Elementary School</strong></td>
						<td>@if($data->elementary=='')-@else{{ $data->elementary }}@endif</td>
						<td><strong>Graduation Year</strong></td>
						<td>@if($data->el_year=='')-@else{{ $data->el_year }}@endif</td>
					</tr>
					<tr>
						<td><strong>Junior High School</strong></td>
						<td>@if($data->junior=='')-@else{{ $data->junior }}@endif</td>
						<td><strong>Graduation Year</strong></td>
						<td>@if($data->jun_year=='')-@else{{ $data->jun_year }}@endif</td>
					</tr>
					<tr>
						<td><strong>Senior High School</strong></td>
						<td>@if($data->senior=='')-@else{{ $data->senior }}@endif</td>
						<td><strong>Graduation Year</strong></td>
						<td>@if($data->sen_year=='')-@else{{ $data->sen_year }}@endif</td>
					</tr>
					<tr>
						<td><strong>University</strong></td>
						<td>@if($data->university=='')-@else{{ $data->university }}@endif</td>
						<td><strong>Graduation Year</strong></td>
						<td>@if($data->u_year=='')-@else{{ $data->u_year }}@endif</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="panel panel-default">
			<div class="panel-heading">Important Files</div>
			<div class="panel-body">
				<table class="table table-bordered table-striped">
					<tr>
						<td><strong>Elektoral</strong></td>
						<td><a target="_blank" href="{{ route('employee.elektoral_download', [$data->id]) }}"> Download </a></td>
					</tr>
					<tr>
						<td><strong>Cartao RDTL</strong></td>
						<td><a target="_blank" href="{{ route('employee.cartao_rdtl_download', [$data->id]) }}"> Download </a></td>
					</tr>
					<tr>
						<td><strong>Certidao Baptismo</strong></td>
						<td><a target="_blank" href="{{ route('employee.certidao_baptismo_download', [$data->id]) }}"> Download </a></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
