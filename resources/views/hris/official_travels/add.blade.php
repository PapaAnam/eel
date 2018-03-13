<form role="form" action="{{ route('official_travel.create') }}" id="add-form" method="post">
  <div class="row">
    {{ csrf_field() }}
    <div class="col-sm-6 col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          New Official Travel
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              {{ input_text('sppd', 'SPPD Number', '', 'required') }}
            </div>
            <div class="col-sm-12">
              {{ select('employee', 'Officer', App\Models\Hris\Employee::employees()) }}
            </div>
            <div class="col-sm-12">
              {{ select('assignor', 'Assignor', App\Models\Hris\Employee::employees()) }}
            </div>
            <div class="col-md-12">
              {{ input_text('depart_from', '', '', 'required') }}
            </div>
            <div class="col-md-12">
              {{ input_date('start_date', '', '', 'required') }}
            </div>
            <div class="col-md-12">
              {!! inp_time('start_time') !!}
            </div>
            <div class="col-md-12">
              {{ input_date('end_date', '', '', 'required') }}
            </div>
            <div class="col-md-12">
              {!! inp_time('end_time') !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          Area
        </div>
        <div class="panel-body">
          <div class="row">
            @for($i=1;$i<=6;$i++)
            <div class="col-sm-12">
              {!! inp_text('area_'.$i) !!}
            </div>
            @endfor
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          Cost And Other
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              {!! inp_text('advanced_cost', 'Advanced Cost ($)') !!}
            </div>
            <div class="col-md-12">
              {!! inp_text('lodging_cost', 'Lodging/Hotel Cost ($)') !!}
            </div>
            <div class="col-md-12">
              {!! inp_text('eat_cost', 'Eat Cost ($)', 'readonly') !!}
            </div>
            <div class="col-md-12">
              {!! inp_text('fuel_cost', 'Fuel Cost ($)') !!}
            </div>
            <div class="col-md-12">
              {!! inp_text('other_cost', 'Other Cost ($)') !!}
            </div>
            <div class="col-md-12">
              {{ save_button('update') }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<script type="text/javascript">
  $('.date-mask').inputmask();
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
  checkEatCost($('#add-form').find('#employee').val());
  $("[data-mask]").inputmask();
</script>