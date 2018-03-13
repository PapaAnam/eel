<form role="form" action="{{ route('leave_period.update') }}" id="edit-form" method="post">
  {{ csrf_field() }}
  {{ id_field($data->id) }}
  {{ method_field('PUT') }}
  <div class="row">
    <div class="col-md-3">
      {{ input_text('special_permit', $data->special_permit) }}
    </div>
    <div class="col-md-3">
      {{ input_text('holiday', $data->holiday) }}
    </div>
    <div class="col-md-3">
      {{ input_text('father_leave', $data->father_leave) }}
    </div>
    <div class="col-md-3">
      {{ input_text('sick', $data->sick) }}
    </div>
    <div class="col-md-3">
      {{ input_text('pregnancy', $data->pregnancy) }}
    </div>
    <div class="col-md-12">
      {!! save_btn() !!}
    </div>
  </div>
</form>