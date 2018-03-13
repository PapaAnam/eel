@stack('modal')
<div class="modal fade" role="dialog" id="profileModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="box box-widget widget-user-2">
							<div class="widget-user-header bg-blue">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<div class="widget-user-image">
									<img class="img-circle" src="{{ $profile->avatar }}" alt="User Avatar">
								</div>
								<h3 class="widget-user-username">{{ $profile->name }}</h3>
								<h5 class="widget-user-desc">{{ level(Auth::user()->level) }}</h5>
							</div>
							<div class="box-footer no-padding">
								<table class="table">
									<tbody>
										<tr>
											<td>Name</td>
											<td>{{ $profile->name }}</td>
										</tr>
										<tr>
											<td>Gender</td>
											<td>{{ $profile->gender }}</td>
										</tr>
										<tr>
											<td>City, Birthdate</td>
											<td>{{ $profile->born_in.', '.$profile->birthdate }}</td>
										</tr>
										@if(Auth::id()==1)
										<tr>
											<td>Address</td>
											<td>{{ $profile->address }}</td>
										</tr>
										@endif
										@if(Auth::id()!=1)
										<tr>
											<td>Department</td>
											<td>{{ $profile->user->d_name }}</td>
										</tr>
										<tr>
											<td>Sub Department</td>
											<td>{{ $profile->user->sd_name }}</td>
										</tr>
										<tr>
											<td>Position</td>
											<td>{{ $profile->user->p_name }}</td>
										</tr>
										@endif
										<tr>
											<td>Username</td>
											<td>{{ Auth::user()->username }}</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="pull-left btn-group">
								<button type="button" class="btn btn-warning dropdown-toggle btn-sm btn-flat" data-toggle="dropdown">
									Action
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									@if(Auth::id()==1)<li><a href="{{ route('profile.edit') }}">Edit</a></li>@endif
									<li><a class="pointer" onclick="avatar()">Change Avatar</a></li>
									<li><a class="pointer" onclick="pass()">Change Password</a></li>
									<li><a class="pointer" onclick="reset2()">Reset Password</a></li>
									<form id="reset2" action="{{ route('password.reset') }}" method="post">
										{{ csrf_field() }}
										<input type="hidden" name="_method" value="PUT">
									</form>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
</div>
</div>
<div class="modal fade" role="dialog" id="avatarModal">
	<div class="modal-dialog">
		<form action="{{ route('avatar.update') }}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
			<input type="hidden" name="_method" value="PUT">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">Change Avatar</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="avatar">Avatar</label>
								<input type="file" name="avatar" id="avatar" onchange="checkimage(this.value)" required>
							</div>
						</div>
					</div>
					<div class="alert alert-info alert-dismissible">
						<h4><i class="icon fa fa-info"></i> Please read!</h4>
						Max dimension of avatar 512x512 px. No more than 300kb. Allowed Extension are PNG and JPG.
					</div>
				</div>
				<div class="modal-footer">
					<div class="pull-left btn-group">
						{{ save_btn() }}
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal fade" role="dialog" id="passwordModal">
	<div class="modal-dialog">
		<form action="{{ route('password.update') }}" method="post">
			{{ csrf_field() }}
			<input type="hidden" name="_method" value="PUT">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">Change Password</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" min="6" name="password" id="password" placeholder="Insert password" required class="form-control">
					</div>
					<div class="form-group">
						<label for="password_confirmation">Password Confirmation</label>
						<input type="password" min="6" name="password_confirmation" id="password_confirmation" placeholder="Insert password confirmation" required class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<div class="pull-left btn-group">
						{{ save_btn() }}
					</div>
				</div>
			</div>
		</form>
	</div>
</div>