<form role="form" action="{{ route('account.create') }}" method="post" id="add-form">
  {{ csrf_field() }}
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          Employee
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              {{ select('employee', '', App\Models\Hris\Employee::employees()) }}
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="level">Level</label>
                <select class="select2 form-control" id="level" name="level" style="width: 100%;">
                  @for($i=2;$i<5;$i++)
                  <option value="{{ $i }}">{{ level($i) }}</option>
                  @endfor
                </select>
              </div>
            </div>
            <div class="col-sm-12">
              {!! inp_text('username', 'Username', 'required min="6"') !!}
            </div>
            <div class="col-sm-12">
              {!! inp_pass() !!}
            </div>
            <div class="col-sm-12">
              {!! inp_pass_conf() !!}
            </div>
            <div class="col-sm-12">
              {{ save_button() }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          Authority
        </div>
        <div class="panel-body">      
          @include('hris.accounts.check')
          <hr>
          <div class="row">
              {{-- <div class="col-sm-6 col-md-3">
                {!! cb(1, 'home', 'Home') !!}
              </div> --}}
              <div class="col-sm-6 col-md-3">
                {!! cb(1, 'department', 'Departments') !!}
              </div>
              <div class="col-sm-6 col-md-3">
                {!! cb(1, 'sub_department', 'Sub Departments') !!}
              </div>
              <div class="col-sm-6 col-md-3">
                {!! cb(1, 'position', 'Positions') !!}
              </div>
              <div class="col-sm-6 col-md-3">
                {!! cb(1, 'employee_menu', 'Employees') !!}
              </div>
              <div class="col-sm-6 col-md-3">
                {!! cb(1, 'salary_rule', 'Salary Rules') !!}
              </div>{{-- 
              <div class="col-sm-6 col-md-3">
                {!! cb(1, 'calendar', 'Calendars') !!}
              </div> --}}
              <div class="col-sm-6 col-md-3">
                {!! cb(1, 'special_day', 'Special Day') !!}
              </div>
              <div class="col-sm-6 col-md-3">
                {!! cb(1, 'attendance', 'Manage Attendance') !!}
              </div>
              <div class="col-sm-6 col-md-3">
                {!! cb(1, 'over_time', 'Over Time') !!}
              </div>
              <div class="col-sm-6 col-md-3">
                {!! cb(1, 'official_travel', 'Official Travel') !!}
              </div>
              <div class="col-sm-6 col-md-3">
                {!! cb(1, 'mutation', 'Mutations') !!}
              </div>
              <div class="col-sm-6 col-md-3">
                {!! cb(1, 'payroll', 'Payroll') !!}
              </div>
              <div class="col-sm-6 col-md-3">
                {!! cb(1, 'account', 'Accounts') !!}
              </div>
              <div class="col-sm-6 col-md-3">
                {!! cb(1, 'leave_period', 'Leave Period') !!}
              </div>
              <div class="col-sm-6 col-md-3">
                {!! cb(1, 'announcement', 'Announcements') !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  <script type="text/javascript">
    $('#add-form').find('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    var myModal = $('#myModal');
    function checkSubDep(el, val=null)
    {
      var dept = el;
      var dept_id;
      if(val!=null){
        dept = $(el);
        dept_id = val;
      }else
      dept_id = el.val();
      var sub_dept = dept.parents('.panel').find('#sub_department');
      $.ajax({
        url : '{{ route('employee.check_sub_department') }}',
        type : 'POST',
        data : {
          _token : '{{ csrf_token() }}',
          id : dept_id
        },
        success : function(r){
          sub_dept.html(r);
          checkEmp(sub_dept);
        }
      });
    }
    function checkEmp(el, val=null)
    {
      var sub_dept = el;
      if(val!=null)
        sub_dept = $(el);
      else
        val = sub_dept.val();
      var emp = sub_dept.parents('.panel').find('#employee');
      $.ajax({
        url : '{{ route('employee.check') }}',
        type : 'POST',
        data : {
          _token : '{{ csrf_token() }}',
          id : val,
          account : true
        },
        success : function(r){
         emp.html(r);
       }
     });
    }
    checkSubDep($('#add-form').find('#department'));
    $('#add-form').find('.select2').select2();
  </script>