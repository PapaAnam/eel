<form role="form" action="{{ route('attendance.break_update') }}" method="post">
  {{ csrf_field() }}
  {{ method_field('PUT') }}
  {{ id_field($data->id) }}
  <div class="row">
    <div class="col-md-12">
      {{ input_text('emp', 'Employee', '('.$data->nin.') '.$data->e_name, 'readonly') }}
    </div>
    <div class="col-md-12">
      {{ input_date('d', 'Date', $data->created_at, 'readonly') }}
    </div>
    <div class="col-md-12">
      {{ input_time('break', '', $data->break, 'required') }}
    </div>
    <div class="col-md-12">
      {{ save_button('update').' '.save_close_button('update') }}
    </div>
  </div>
</form>
<script type="text/javascript">
  $("[data-mask]").inputmask();
</script>