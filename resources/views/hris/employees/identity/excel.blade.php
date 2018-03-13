<style>
	.fg-red{
		color: red;
	}
</style>
<table>
	<tr>
		<td width="40%">
			<img class="pull-left" width="100px" height="40px" src="@if($lisun){{ asset('images/company/lisun.jpg') }}@else{{ local_file('images\company\lisun.jpg') }}@endif">
		</td>
		<td>
			<h3>Personal Data</h3>
		</td>
	</tr>
</table>
<table>
	<tr>
		<td width="75%">
			<table class="table table-bordered table-striped">
				<tbody>
					<tr>
						<td colspan="2" class="text-center"><strong>Biography</strong></td>
					</tr>
					<tr>
						<td width="30%">NIN</td>
						<td>{{ $data->nin }}</td>

					</tr>
					<tr>
						<td>Name</td>
						<td>{{ $data->name }}</td>
					</tr>
					<tr>
						<td>Gender</td>
						<td>{{ $data->gender }}</td>
					</tr>
					<tr>
						<td>Born In</td>
						<td>{{ $data->born_in }}</td>
					</tr>
					<tr>
						<td>Birthdate</td>
						<td>{{ english_date($data->birthdate) }}</td>
					</tr>
					<tr>
						<td>Handphone</td>
						<td>{{ $data->handphone }}</td>
					</tr>
					<tr>
						<td>Marital Status</td>
						<td>{{ maried($data->marital_status) }}</td>
					</tr>
					<tr>
						<td>Present Address</td>
						<td>{{ $data->present_address }}</td>
					</tr>
					<tr>
						<td colspan="2" class="text-center">
							<strong>Placement</strong>
						</td>
					</tr>
					<tr>
						<td>Department</td>
						<td>{{ $data->dep->name }}</td>
					</tr>
					{{-- <tr>
						<td>Sub Department</td>
						<td>{{ $data->sd_name }}</td>
					</tr> --}}
					<tr>
						<td>Position</td>
						<td>{{ $data->p_name }}</td>
					</tr>
					<tr>
						<td>From</td>
						<td>{{ $data->e_from }}</td>
					</tr>
					<tr>
						<td>Type</td>
						<td>{{ employee_type($data->type) }}</td>
					</tr>
					<tr>
						<td>BRI Account</td>
						<td>{{ $data->bri_account }}</td>
					</tr>
					<tr>
						<td>Joining At</td>
						<td>{{ english_date($data->joining_date) }}</td>
					</tr>
					<tr>
						<td colspan="2" class="text-center">
							<strong>Family Background</strong>
						</td>
					</tr>
					<tr>
						<td>Father</td>
						<td>{{ $data->father }}</td>
					</tr>
					<tr>
						<td>Mother</td>
						<td>{{ $data->mother }}</td>
					</tr>
					<tr>
						<td>Husband</td>
						<td>{{ $data->husband }}</td>
					</tr>
					<tr>
						<td>Wife</td>
						<td>{{ $data->wife }}</td>
					</tr>
					<tr>
						<td>Son</td>
						<td>{{ $data->son }}</td>
					</tr>
					<tr>
						<td>Daughter</td>
						<td>{{ $data->daughter }}</td>
					</tr>
					<tr>
						<td colspan="2" class="text-center">
							<strong>Educational History</strong>
						</td>
					</tr>
					<tr>
						<td>Elementary School</td>
						<td>@if($data->elementary=='')-@else{{ $data->elementary }}@endif</td>
					</tr>
					<tr>
						<td>Graduation Year</td>
						<td>@if($data->el_year=='')-@else{{ $data->el_year }}@endif</td>
					</tr>
					<tr>
						<td>Junior High School</td>
						<td>@if($data->junior=='')-@else{{ $data->junior }}@endif</td>
					</tr>
					<tr>
						<td>Graduation Year</td>
						<td>@if($data->jun_year=='')-@else{{ $data->jun_year }}@endif</td>
					</tr>
					<tr>
						<td>Senior High School</td>
						<td>@if($data->senior=='')-@else{{ $data->senior }}@endif</td>
					</tr>
					<tr>
						<td>Graduation Year</td>
						<td>@if($data->sen_year=='')-@else{{ $data->sen_year }}@endif</td>
					</tr>
					<tr>
						<td>University</td>
						<td>@if($data->university=='')-@else{{ $data->university }}@endif</td>
					</tr>
					<tr>
						<td>Graduation Year</td>
						<td>@if($data->u_year=='')-@else{{ $data->u_year }}@endif</td>
					</tr>
					<tr>
						<td colspan="2" class="text-center">
							<strong>Important Files</strong>
						</td>
					</tr>
					<tr>
						<td>Certidao Baptismo</td>
						<td>
							@if($data->certidao_baptismo!=null)
							Yes
							@else
							None
							@endif
						</td>
					</tr>
					<tr>
						<td>Cartao RDTL</td>
						<td>
							@if($data->cartao_rdtl!=null)
							Yes
							@else
							None
							@endif
						</td>
					</tr>
					<tr>
						<td>Elektoral</td>
						<td>
							@if($data->elektoral!=null)
							Yes
							@else
							None
							@endif
						</td>
					</tr>
					@if($data->non_active!=null)
					<tr class="fg-red">
						<td>Non Active At</td>
						<td>{{ english_date($data->non_active_at) }}</td>
					</tr>
					<tr class="fg-red">
						<td>Reason</td>
						<td>{{ non_active($data->non_active) }}</td>
					</tr>
					@endif
				</tbody>
			</table>
		</td>
		<td valign="top" ">
			@php
			$img = '';
			if($lisun){
				if(file_exists(local_file('storage/'.$data->photo)))
					$img = asset('storage/'.$data->photo);
				else 
					$img = asset('images/employee/default.jpg');
			}
			else{
				if(file_exists(local_file('storage/'.$data->photo)))
					$img = local_file('storage/'.$data->photo);
				else 
					$img = local_file('images/employee/default.jpg');
			}
			@endphp
			<img style="border: 1px solid black;" width="150px" height="200px" src="{{ $img }}">
		</td>
	</tr>
</table>