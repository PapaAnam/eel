<form role="form" action="{{ route('mutation.create') }}" method="post" id="add-form">
  {{ csrf_field() }}
  <div class="row">
    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">Employee To Mutation</div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              @php
              $E = App\Models\Hris\Employee::orderBy('nin', 'asc')->get();
              $em = [];
              foreach ($E as $e) {
                $em = array_add($em, $e->id, '('.$e->nin.') '.$e->name);
              }
              @endphp
              {{ select('employee', '', $em, 'onchange="check_position_department(this)"') }}
            </div>
            <div class="employee-position-department">
              
            </div>
            <div class="col-md-12">
              {{ select('manager', 'The Leader Who Rule', $em) }}
            </div>
            <div class="col-md-12">
              {{ input_text('city', 'Leader City', '', 'required') }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          Mutation To
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="department">Department</label>
                <select onchange="checkSubDep(this, this.value)" class="select2 form-control" id="department1" name="department" required style="width: 100%;">
                  @foreach(App\Models\Hris\Department::all() as $d)
                  <option value="{{ $d->id }}">{{ $d->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="sub_department1">Sub Department</label>
                <select class="select2 form-control" id="sub_department" name="sub_department" required style="width: 100%;">

                </select>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="position">Mutation To Position</label>
                <select class="select2 form-control" id="position" name="position" required style="width: 100%;">
                  @foreach(App\Models\Hris\Position::all() as $p)
                  <option value="{{ $p->id }}">{{ $p->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">Mutation Data</div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              {!! ed_inp_txt(date('myhmdims'), 'mutation_id', 'Mutation ID', 'readonly') !!}
            </div>
            <div class="col-md-12">
              <a href="#" onclick="refresh_mutation_id(this)" class="button primary">
                Refresh Mutation ID
              </a>
            </div>
            <div class="col-md-12">
              {!! inp_textarea('reason') !!}
            </div>
            <div class="col-md-12">
              {{ input_date('effect_on') }}
            </div>
            <div class="col-sm-12">
              {{ save_button() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<script type="text/javascript">
  function refresh_mutation_id(el)
  {
    $.ajax({
      url : '{{ route('mutation.refresh_mutation_id') }}',
      cache : false,
      type : 'POST',
      data : 
      {
        _token : '{{ csrf_token() }}'
      },
      success : function(r)
      {
        $(el).parent().parent().find('#mutation_id').val(r);
      }
    })
  }
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
  checkSubDep($('#add-form').find('#department1'));
  $('#add-form').find('.select2').select2();
  $('.date-mask').inputmask();

  function check_position_department(el){
    var id = $(el).val();
    $.ajax({
      url : '{{ route('mutation.check_position_department') }}',
      type : 'POST',
      data : {
        id : id,
        _token : csrf_token
      },
      beforeSend : function(){
        $(el).parents('form').find('.employee-position-department').html('please wait...');
      },
      success : function(response){
        $(el).parents('form').find('.employee-position-department').html(response);
      }
    })
  }

  check_position_department($('#add-form').find('#employee')[0]);
</script>