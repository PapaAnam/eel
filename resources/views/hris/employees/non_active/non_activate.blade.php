<form id="non-activate-form" onsubmit="save(this, event, 'update')" role="form" action="{{ route('employee.non_active') }}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ id_field($data->id) }}
  <div class="row">
    <div class="col-sm-12">
      {{ input_text('employee', '', $data->name, 'disabled') }}
    </div>
    <div class="col-sm-12">
      <div class="form-group">
        <label for="non_active">Reason</label>
        <select name="non_active" id="non_active" class="form-control select2" style="width: 100%;">
          @for($i=1;$i<=7;$i++)
          <option value="{{ $i }}">{{ non_active($i) }}</option>
          @endfor
        </select>
      </div>
    </div>
    <div class="col-sm-12">
      {{ save_button('update').' '.save_close_button('update') }}
    </div>
  </div>
</form>
<script type="text/javascript">
  $('#non-activate-form').find(".select2").select2();
</script>