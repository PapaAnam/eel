<script>
  function uploadAttendance(event){
    event.preventDefault()
    el = document.getElementById('file_attendance_excel')
    that = $(el);
    var form = that.parents('form');
    var file = that[0].files[0];
    if(file==null){
      alert('File must filled')
      return;
    }
    if(file.type!='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' && file.type!='application/vnd.ms-excel'){
      alert('File type must .xls or .xlsx');
      that.val('');
      return;
    }
    $('#jj').fadeOut()
    $('#ll').fadeIn()
    $('#lll').text('Please Wait. Uploading File')
    var data = new FormData();
    data.append('attendance_excel', file);
    data.append('_token', csrf_token);
    $.ajax({
      url: '{{ route('attendance.upload_attendance') }}',
      type: 'POST',
      data: data,
      cache: false,
      processData: false,
      contentType: false,
      success: function(response, xhr){
        $('#lll').text('Please Wait. Processing data')
        successMsg(response.success);
        that.parent().parent().find('#attendance_excel').val(response.file_name);
        console.log(form.serialize())
        $.ajax({
          url : form.attr('action'),
          type : 'POST',
          data : form.serialize(),
          success : function(res){
            successMsg(res);
            $('#jj').fadeIn()
            $('#ll').fadeOut()
          },
          error : function(res){
            if(res.status == 500)
              errorMsg("There is error in server")
            else
              errorMsg(res.message)
            $('#jj').fadeIn()
            $('#ll').fadeOut()
          }
        })
      },
      statusCode : {
        422 : function(xhr){
          errorMsg(xhr.responseJSON.attendance_excel);
          $('#jj').fadeIn()
          $('#ll').fadeOut()
        }
      }
    });
  }
</script>
<div class="row" id="ll" style="display: none;">
  <div class="col-md-12">
    <h1 id="lll">Please Wait. Uploading File</h1>
  </div>
</div>
<div class="row" id="jj">
  <div class="col-sm-6 col-md-4">
    <form id="add-enter-form" role="form" action="{{ route('attendance.create') }}" method="post">
      {{ csrf_field() }}
      <div class="panel panel-default">
        <div class="panel-heading">
          Employee To Attendance (One By One)
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              {{ select('employee', '', App\Models\Hris\Employee::employees()) }}
            </div>
            <div class="col-md-12">
              <div class="input-control text" data-role="datepicker">
                <input type="text">
                <button class="button"><span class="mif-calendar"></span></button>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="select2 form-control" style="width: 100%;">
                  @php
                  $status = [1,2,3,5,6,7,8];
                  @endphp
                  @foreach($status as $i)
                  <option value="{{ $i }}">{{ absence_status($i) }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-12">
              {{ input_date('created_at', 'Attendance Date', date('Y-md-'), 'required') }}
            </div>
            <div class="col-sm-12">
              {{ input_time('enter', '', '08:30:00', 'required') }}
            </div>
            <div class="col-sm-12">
              {{ save_button() }}
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
  <div class="col-sm-6 col-md-4">
    <form id="add-enter-multiply-form" role="form" action="{{ route('attendance.create_multiply') }}" method="post">
      {{ csrf_field() }}
      <div class="panel panel-default">
        <div class="panel-heading">
          Employee To Attendance (Multiply)
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              @php
              $departments = App\Models\Hris\Department::departments();
              $departments = ['all'=>'All']+$departments;;
              @endphp
              {{ select('department', '', $departments, 'onchange="callSubDepartment(this)"') }}
            </div>
            <div class="col-md-12 sub_department">
              {{ select('sub_department', '', []) }}
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="time">Time</label>
                <select name="time" id="time" class="select2 form-control" style="width: 100%;">
                  <option value="enter">Enter</option>
                  <option value="break">Break</option>
                  <option value="end_break">End Break</option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              {{ input_date('created_at', 'Attendance Date', date('Y-md-'), 'required') }}
            </div>
            <div class="col-sm-12">
              {{ input_time('time_oclock', 'Hour', '08:30:00', 'required') }}
            </div>
            <div class="col-sm-12">
              {{ save_button() }}
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
  <div class="col-sm-6 col-md-4">
    <form id="add-enter-multiply-form" role="form" action="{{ route('attendance.create_by_excel') }}" method="post">
      {{ csrf_field() }}
      <div class="panel panel-default">
        <div class="panel-heading">
          Employee To Attendance (Load From Excel File)
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              {{ input_file('attendance_excel', '', '', 'required"') }}
            </div>
            <div class="col-md-12">
              <div class="alert alert-info">
                <h4><i class="icon fa fa-info-circle"></i> Please Read :)</h4>
                File extension must .xls or .xlsx<br>
                <a target="_blank" href="{{ asset('storage/attendances/example/attendance_format_example.xlsx') }}">Download</a> this example for rule of attendance file 
              </div>
            </div>
            <div class="col-sm-12">
              <a onclick="uploadAttendance(event)" class="button save-button loading-pulse lighten primary">Save</a>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
  $('#add-enter-form, #add-enter-multiply-form').find('.select2').select2();
  $("[data-mask]").inputmask();

  function callSubDepartment(el) {
    var dept = $(el).val();
    $.ajax({
      url : '{{ route('sd.select_by_department') }}',
      type : 'POST',
      data : {
        dept : dept,
        _token : csrf_token
      },
      beforeSend : function(){
        $('#add-enter-multiply-form').find('.sub_department').html('Please Wait');
      },
      success : function(response){
        $('#add-enter-multiply-form').find('.sub_department').html(response).find('.select2').select2();
      }
    });
  }

  $('#add-enter-multiply-form').find('#department').trigger('change');
</script>