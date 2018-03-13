<div class="row">
  <div class="col-md-12">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_1" data-toggle="tab">Data</a></li>
      <li><a href="#tab_2" data-toggle="tab">New</a></li>
      <li><a href="#from_machine" data-toggle="tab">From Machine</a></li>
    </ul>
    <div class="tab-content" style="padding-top: 10px;">
      <div class="tab-pane active" id="tab_1">
        <div class="row">
          <div class="col-md-12">
            {{ export_btn('attendance') }}<br>
            <div class="form-group row">
              <div class="form-row align-items-center">
                <div class="col-sm-3">
                  <input type="text" id="dfgh" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask class="form-control date-mask col-md-4" placeholder="Date" value="{{ date('Y-m-d') }}">
                </div>
                <div class="col-auto">
                  <button type="submit" class="btn btn-primary" onclick="filterAttendance(document.getElementById('dfgh').value)">filter</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <table class="table bordered border striped" id="datatable">
              <thead>
                <tr>
                  <th width="10px">#</th>
                  <th>Employee</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Enter At</th>
                  <th>Break</th>
                  <th>End Break</th>
                  <th>Out At</th>
                  <th width="200px">Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="tab_2">
        @include('hris.attendances.add')
      </div>
      <div class="tab-pane" id="from_machine">
        @include('hris.attendances.from_machine')
      </div>
    </div>
  </div>
</div>
@include('layouts.form.remove', ['modul'=>'attendance'])
<script type="text/javascript">
  function addBreak(id) {
    loadForFree(id, '{{ route('attendance.break') }}', 'Break', 'very-small');
  }
  function addEndBreak(id) {
    loadForFree(id, '{{ route('attendance.end_break') }}', 'End Break', 'very-small');
  }
  function addOut(id) {
    loadForFree(id, '{{ route('attendance.out') }}', 'Out', 'very-small');
  }
  function filterAttendance(date){
    $('#datatable').fadeOut()
    if($('#hh').length<=0){
      $('#datatable').after(`
        <h3 id="hh">Please wait</h3>
        `)
    }
    table.ajax.url('{{ url('hris/manage_attendance/filter_dt') }}/'+date).load()
    table.on('draw', function(){
      $('#hh').remove()
      $(this).fadeIn()
    })
  }
</script>