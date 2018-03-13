<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Employee</h3>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group {{ has_error($errors, 'department') }}">
          <label for="department">Department</label>
          <select onchange="checkSubDep(this.value)" class="select2 form-control" id="department" style="width: 100%;">
            @foreach(Department::all() as $d)
            <option value="{{ $d->id }}">{{ $d->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group {{ has_error($errors, 'sub_department') }}">
          <label for="sub_department">Sub Department</label>
          <select class="select2 form-control" id="sub_department" onchange="checkEmp(this.value)" style="width: 100%;"></select>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group {{ has_error($errors, 'employee') }}">
          <label for="employee">Employee</label>
          <select required class="select2 form-control" id="employee" name="employee" style="width: 100%;">
          </select>
        </div>
      </div>
    </div>
  </div>
</div>
@push('function')
function checkSubDep(dep)
{
  $.ajax({
    url : '{{ route('employee.check_sub_department') }}',
    type : 'POST',
    data : {
      _token : '{{ csrf_token() }}',
      id : dep
    },
    success : function(resp){
      var sd = $('#sub_department');
      sd.html(resp);
      checkEmp(sd.val());
    }
  });
}
function checkEmp(sd)
{
  $.ajax({
    url : '{{ route('account.check') }}',
    type : 'POST',
    data : {
      _token : '{{ csrf_token() }}',
      id : sd
    },
    success : function(resp){
      $('#employee').html(resp);
    }
  });
}
@endpush
@push('ready-function')
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  checkSubDep($('#department').val());
});
checkSubDep($('#department').val());
@endpush