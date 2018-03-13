@extends('layouts.view')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>Settings</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="#">Settings</a></li>
      {{-- <li class="active">Edit</li> --}}
    </ol>
  </section>
  <section class="content">
    {{ success(session('success')) }}
    <div class="row">
      <div class="col-md-6">
        <form role="form" action="{{ $action }}" method="post">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Administrator Menu</h3>
              <button type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-check"></i></button>
              {{ method_field('PUT') }}
              {{ csrf_field() }}
            </div>
            <div class="box-body">
              @include('accounts.check')
              <div class="row">
                <div class="col-md-6">
                  {{ edit_checkbox('department', $data, 'Departmens')}}
                </div>
                <div class="col-md-6">
                  {{ edit_checkbox('position', $data, 'Positions')}}
                </div>
                <div class="col-md-6">
                  {{ edit_checkbox('employee', $data, 'Employees')}}
                </div>
                <div class="col-md-6">
                  {{ edit_checkbox('calendar', $data, 'Calendars')}}
                </div>
                <div class="col-md-6">
                  {{ edit_checkbox('absence', $data, 'Absences')}}
                </div>
                <div class="col-md-6">
                  {{ edit_checkbox('over_work', $data, 'Over Works')}}
                </div>
                <div class="col-md-6">
                  {{ edit_checkbox('official_travel', $data, 'Official Travel')}}
                </div>
                <div class="col-md-6">
                  {{ edit_checkbox('mutation', $data, 'Mutations')}}
                </div>
                <div class="col-md-6">
                  {{ edit_checkbox('payroll', $data, 'Payroll')}}
                </div>
                <div class="col-md-6">
                  {{ edit_checkbox('account', $data, 'Accounts')}}
                </div>
                {{-- <div class="col-md-6">
                  {{ edit_checkbox('disabled', $data, 'Disabled Data')}}
                </div> --}}
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-6">
        @include('settings.skin')
      </div>
    </div>
  </section>
</div>
@endsection
@include('layouts.push.icheck')
@push('style')
.a{
  display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4);
}
.b{
  display:block; width: 20%; float: left; height: 7px; height: 20px;
}
.c{
  display:block; width: 80%; float: left; height: 7px; height: 20px;
}
.dark{
  display:block; width: 20%; float: left; height: 50px; background: #222d32;
}
.t{
  display:block; width: 80%; float: left; height: 50px; background: #f4f5f7;
}
.light{
  display:block; width: 20%; float: left; height: 50px; background: #f9fafc;
}
@endpush