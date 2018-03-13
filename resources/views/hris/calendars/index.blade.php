<link rel="stylesheet" href="{{ asset('plugins/fullcalendar/fullcalendar.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/fullcalendar/fullcalendar.print.css') }}" media="print">
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        Calendar
      </div>
      <div class="panel-body">
        <h6 id="idi" style="display:none;">Getting data from server</h6>
        <div id="calendar""></div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            New
          </div>
          <div class="panel-body">
            <div class="row">
              <form action="{{ route('special_day.create') }}" onsubmit="save(this, event)">
                {{ csrf_field() }}
                {{-- {{ inp_date('date', 'Date') }} --}}
                <div class="input-control col-md-12" data-role="datepicker" data-format="mm-dd">
                  {{-- <label for="date-event">Date</label> --}}
                  <input type="text" name="date_event" id="date-event" placeholder="Date">
                </div>
                <div class="col-md-12">
                  {{ input_text('event') }}
                </div>
                <div class="col-md-12">
                  {{ save_button('insert', 'Save', 'refresh-calendar') }}
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            Data
          </div>
          <div class="panel-body">
            <table class="table table-striped table-bordered" id="datatable">
              <thead>
                <th width="10px">#</th>
                <th>Each Date</th>
                <th>Event</th>
                <th width="100px">Action</th>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('layouts.form.remove', ['modul'=>'special_day'])
{{-- <script src="{{ asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script> --}}
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/fullcalendar/fullcalendar.min.js') }}"></script>
<script>
  $(function () {
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'today',
        month: 'month',
        week: 'week',
        day: 'day'
      },
      events : {
        url: '{{ route('special_day.event_list') }}',
        error : function(res){
          errorMsg(res.message)
        }
      },
      loading: function(bool) {
        $('#idi').toggle(bool)
      }
    });
    setTimeout(function(){
      $('#calendar').fullCalendar('today');
    }, 2000);
    $("#datepicker").datepicker();
  });
</script>