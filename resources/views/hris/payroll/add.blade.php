<form role="form" id="add-form" action="{{ route('payroll.create') }}" method="post">
  {{ csrf_field() }}
  <div class="row">
    <div class="col-sm-6 col-md-4">
      <div class="panel">
        <div class="heading">
          <span class="title">Choose department to salary</span>
        </div>
        <div class="content padding10">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="department">Department</label>
                <select onchange="checkSubDep(this, this.value)" class="select2 form-control" id="department" style="width: 100%;">
                  @foreach(Department::all() as $d)
                  <option value="{{ $d->id }}">{{ $d->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="sub_department">Sub Department</label>
                <select class="select2 form-control" id="sub_department" name="sub_department" style="width: 100%;"></select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-3 col-md-3">
      <div class="col-md-12">
        <div class="form-group">
          <label for="month">Choose Month</label>
          <select class="select2 form-control" id="month" name="month" style="width: 100%;">
            @for($i=1;$i<=12;$i++)
            <option value="{{ $i }}">{{ english_month_name($i) }}</option>
            @endfor
          </select>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label for="year">Choose Year</label>
          <select class="select2 form-control" id="year" name="year" style="width: 100%;">
            @for($i=2017;$i<=date('Y');$i++)
            <option value="{{ $i }}">{{ $i }}</option>
            @endfor
          </select>
        </div>
      </div>
      <div class="col-md-12">
        {!! save_btn() !!}
      </div>
    </div>
  </div>
</form>
<script type="text/javascript">
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
      }
    });
  }
  checkSubDep($('#add-form').find('#department'), $('#add-form').find('#department').val());
  $('#add-form').find('.select2').select2();
</script>