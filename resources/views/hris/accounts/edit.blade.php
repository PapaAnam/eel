<form role="form" action="{{ route('account.update') }}" method="post" id="edit-form">
  {{ csrf_field() }}
  {{ method_field('PUT') }}
  {{ id_field($data->u_id) }}
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          Edit Account
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-12">
              {!! ed_inp_txt($data->e_name.' ('.$data->p_name.')', 'emp', 'Employee', 'readonly') !!}
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="level">Level</label>
                <select class="select2 form-control" id="level" name="level" style="width: 100%;">
                  @for($i=2;$i<5;$i++)
                  <option @if($i==$data->level) selected @endif value="{{ $i }}">{{ level($i) }}</option>
                  @endfor
                </select>
              </div>
            </div>
            <div class="col-sm-12">
              {!! ed_inp_txt($data->username, 'username', 'Username', 'required min="6"') !!}
              {!! old_fl($data->username, 'username') !!}
            </div>
            <div class="col-sm-12">
              {!! inp_pass() !!}
            </div>
            <div class="col-sm-12">
              {!! inp_pass_conf() !!}
            </div>
            <div class="col-md-12 col-sm-12">
              <div class="alert alert-info">
                <h4><span class="fa fa-info-circle"></span> Info!</h4>
                Keep blank password field if you do not to change.
              </div>
            </div>
            <div class="col-md-12">
              {{ save_button('update').' '.save_close_button('update') }}
            </div>
          </div>    
        </div>
      </div>
    </div>
    <div class="col-md-8 col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          Authority
        </div>
        <div class="panel-body">      
          @include('hris.accounts.check')
          <hr>
          <div class="row">
            {{-- <div class="col-sm-6 col-md-3">
              {!! ed_cb($data->home, 1, 'home', 'Home') !!}
            </div> --}}
            <div class="col-sm-6 col-md-3">
              {!! ed_cb($data->department, 1, 'department', 'Departments') !!}
            </div>
            <div class="col-sm-6 col-md-3">
              {!! ed_cb($data->sub_department, 1, 'sub_department', 'Sub Departments') !!}
            </div>
            <div class="col-sm-6 col-md-3">
              {!! ed_cb($data->position, 1, 'position', 'Positions') !!}
            </div>
            <div class="col-sm-6 col-md-3">
              {!! ed_cb($data->employee, 1, 'employee', 'Employees') !!}
            </div>
            <div class="col-sm-6 col-md-3">
              {!! ed_cb($data->salary_rule, 1, 'salary_rule', 'Salary Rules') !!}
            </div>
            <div class="col-sm-6 col-md-3">
              {!! ed_cb($data->special_day, 1, 'special_day', 'Special Day') !!}
            </div>
            <div class="col-sm-6 col-md-3">
              {!! ed_cb($data->attendance, 1, 'attendance', 'Manage Attendance') !!}
            </div>
            <div class="col-sm-6 col-md-3">
              {!! ed_cb($data->over_time, 1, 'over_time', 'Over Time') !!}
            </div>
            <div class="col-sm-6 col-md-3">
              {!! ed_cb($data->official_travel, 1, 'official_travel', 'Official Travel') !!}
            </div>
            <div class="col-sm-6 col-md-3">
              {!! ed_cb($data->mutation, 1, 'mutation', 'Mutations') !!}
            </div>
            <div class="col-sm-6 col-md-3">
              {!! ed_cb($data->payroll, 1, 'payroll', 'Payroll') !!}
            </div>
            <div class="col-sm-6 col-md-3">
              {!! ed_cb($data->account, 1, 'account', 'Accounts') !!}
            </div>
            <div class="col-sm-6 col-md-3">
              {!! ed_cb($data->leave_period, 1, 'leave_period', 'Leave Period') !!}
            </div>
            <div class="col-sm-6 col-md-3">
              {!! ed_cb($data->announcement, 1, 'announcement', 'Announcements') !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<script type="text/javascript">
  $('#edit-form').find('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass: 'iradio_minimal-blue'
  });
  $('#edit-form').find('.select2').select2();
  $('#edit-form').find('#check-all').on('ifChecked', function(event){
    $('.check-menu').iCheck('check');
  });
  $('#edit-form').find('#check-all').on('ifUnchecked', function(event){
    $('#edit-form').find('.check-menu').iCheck('uncheck');
  });
</script>