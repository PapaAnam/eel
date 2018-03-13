<form role="form" action="{{ route('official_travel.update') }}" id="edit-form" method="post">
  {{ csrf_field() }}
  {{ id_field($data->id) }}
  {{ method_field('PUT') }}
  <div class="row">
    <div class="col-sm-6 col-md-4">
      <div class="panel alert">
        <div class="heading">
          <span class="title">Officer</span>
        </div>
        <div class="content padding10">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                {!! ed_inp_txt($data->e_name.' ('.$data->p_name.')', 'emp', 'Employee', 'readonly') !!}
                {{ in_hid($data->employee, 'employee') }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-4">
      <div class="panel alert">
        <div class="heading">
          <span class="title">Assignor</span>
        </div>
        <div class="content padding10">
          <div class="row">
            <div class="col-sm-12">
              {!! ed_inp_txt($as_name.' ('.$pas_name.')', 'ass', 'Employee', 'readonly') !!}
              {{ in_hid($data->assignor, 'assignor') }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-4">
      <div class="panel alert">
        <div class="heading">
          <span class="title">Area</span>
        </div>
        <div class="content padding10">
          <div class="row">
            <?php $areas = ['area_1', 'area_2', 'area_3', 'area_4', 'area_5', 'area_6']; $i=1; ?>
            @foreach($areas as $ar)
            <div class="col-sm-12">
              {!! ed_inp_txt($data->$ar, 'area_'.$i++) !!}
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-12">
      <div class="panel alert">
        <div class="heading">
          <span class="title">Cost And Other</span>
        </div>
        <div class="content padding10">
          <div class="row">
            <div class="col-md-6">
              {!! ed_inp_txt($data->sppd, 'sppd', 'SPPD Number') !!}
            </div>
            <div class="col-md-6">
              {!! ed_inp_txt($data->depart_from, 'depart_from') !!}
            </div>
            <div class="col-md-3">
              {!! ed_inp_date(get_date_only($data->start_date), 'start_date') !!}
            </div>
            <div class="col-md-3">
              {!! ed_inp_time(get_time($data->start_date), 'start_time') !!}
            </div>
            <div class="col-md-3">
              {!! ed_inp_date(get_date_only($data->end_date), 'end_date') !!}
            </div>
            <div class="col-md-3">
              {!! ed_inp_time(get_time($data->end_date), 'end_time') !!}
            </div>
            <div class="col-md-4">
              {!! ed_inp_txt($data->advanced_cost, 'advanced_cost', 'Advanced Cost ($)') !!}
            </div>
            <div class="col-md-4">
              {!! ed_inp_txt($data->lodging_cost, 'lodging_cost', 'Lodging/Hotel Cost ($)') !!}
            </div>
            <div class="col-md-4">
              {!! ed_inp_txt($data->eat_cost, 'eat_cost', 'Eat Cost ($)', 'readonly') !!}
            </div>
            <div class="col-md-4">
              {!! ed_inp_txt($data->fuel_cost, 'fuel_cost', 'Fuel Cost ($)') !!}
            </div>
            <div class="col-md-4">
              {!! ed_inp_txt($data->other_cost, 'other_cost', 'Other Cost ($)') !!}
            </div>
            <div class="col-md-12">
              {!! save_btn() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
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
    console.log(sub_dept);
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
        id : val
      },
      success : function(r){
       emp.html(r);
     }
   });
  }
  checkSubDep($('#add-form').find('#department'));
  checkSubDep($('#add-form').find('#department1'));
  $('#add-form').find('.select2').select2();
  function checkEatCost(id)
  {
    $.ajax({
      type : 'POST',
      url : '{{ route('official_travel.check_eat_cost') }}',
      data : {
        _token : '{{ csrf_token() }}',
        id : id
      },
      success : function(r)
      {
        $('#eat_cost').val(r);
      }
    });
  }
  checkEatCost($('#add-form').find('#department').val());
  $("[data-mask]").inputmask();
</script>