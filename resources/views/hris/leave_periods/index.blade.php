<div class="container bg-white padding10 no-margin">
  <div class="row">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#rules" data-toggle="tab">Rules</a></li>
      <li><a href="#employee" data-toggle="tab">Employee</a></li>
    </ul>
    <div class="tab-content" style="padding-top: 10px;">
      <div class="tab-pane active" id="rules">
        <div class="col-md-12">
          {{ export_btn('leave_period', 'pfe').refresh_btn('refresh_leave_periods()') }}
        </div>
        <div class="col-md-12">
          <table class="table bordered border striped">
            <tbody class="tbody-leave-period">
              @include('leave_periods.fresh_table')
            </tbody>
          </table>
        </div>
      </div>
      <div class="tab-pane" id="employee">
        <div class="col-md-6">
          {{ export_btn('leave_period.employee') }}
        </div>
        <div class="col-md-12">
          <table id="datatable" class="table bordered border striped">
            <thead>
              <th width="10px">#</th>
              <th>Department</th>
              <th>Position</th>
              <th>Employee</th>
              <th>Special Permit</th>
              <th>Holiday</th>
              <th>Father Leave</th>
              <th>Sick</th>
              <th>Pregnancy</th>
              <th>Year</th>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@include('layouts.form.remove', ['modul'=>'official_travel'])
<script type="text/javascript">
  var myModal = $('#myModal');
  function detail(id) 
  {
    myModal.find('.modal-title').html('Official Travel Detail');
    myModal.find('.modal-dialog').css('width', '50%');
    loadForm(id, '{{ route('official_travel.detail') }}');
  }
  function edit(id) {
    myModal.find('.modal-title').html('Leave Period Edit');
    loadForm(id, '{{ route('leave_period.edit') }}');
  }
  function refresh_leave_periods()
  {
    $.ajax({
      url : '{{ route('leave_period.refresh_table') }}',
      type : 'GET',
      cache : false,
      success : function(r)
      {
        $('.tbody-leave-period').html(r);
      }
    })
  }
</script>