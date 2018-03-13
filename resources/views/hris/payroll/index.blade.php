<div class="container bg-white padding10 no-margin">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#data" data-toggle="tab">Data</a></li>
    <li><a href="#new" data-toggle="tab">New</a></li>
  </ul>
  <div class="tab-content" style="padding-top: 10px;">
    <div class="tab-pane active" id="data">
      <div class="row">
        <div class="col-md-12">
          {{ export_btn('payroll') }}
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table bordered border striped" id="datatable">
            <thead>
              <tr>
                <th width="10px">#</th>
                <th>Department</th>
                <th>Position</th>
                <th>Employee</th>
                <th>Salary At</th>
                <th>Month</th>
                <th>Year</th>
                <th width="100px">Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
    <div class="tab-pane" id="new">
      @include('payroll.add')
    </div>
  </div>
</div>
@include('layouts.form.remove', ['modul'=>'payroll'])
<script type="text/javascript">
  var myModal = $('#myModal');
  function addBreak(id, url) {
    myModal.find('.modal-title').html('Break');
    myModal.find('.modal-dialog').css('width', '50%');
    modalAuto();
    loadForm(id, '{{ route('attendance.break') }}');
    setTimeout(function(){
      myModal.find('#submit').addClass('form-control');
      
    }, 1000);
  }
  function addEndBreak(id, url) {
    myModal.find('.modal-title').html('End Break');
    myModal.find('.modal-dialog').css('width', '50%');
    modalAuto();
    loadForm(id, '{{ route('attendance.end_break') }}');
    setTimeout(function(){
      myModal.find('#submit').addClass('form-control');
      
    }, 1000);
  }
  function addOut(id, url) {
    myModal.find('.modal-title').html('Out');
    loadForm(id, '{{ route('attendance.out') }}');
    myModal.find('.modal-dialog').css('width', '50%');
    modalAuto();
    setTimeout(function(){
      myModal.find('#submit').addClass('form-control');
      
    }, 1000);
  }
</script>