<form role="form" onsubmit="save(this, event, 'update')" id="edit-form" action="{{ route('sd.update') }}" method="post">
  {{ csrf_field() }}
  {{ method_field('PUT') }}
  {{ id_field($data->id) }}
  <div class="row">
    <div class="col-md-6">
      {!! ed_inp_txt($data->name, 'name') !!}
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="department">Department</label>
        <select style="width: 100%;" class="select2 form-control" id="department" name="department" required>
          @foreach(App\Models\Hris\Department::all() as $d)
            <option @if($data->department==$d->id) selected @endif value="{{ $d->id }}">{{ $d->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-md-12">
      {{ save_button('update') }} {{ save_close_button('update') }}
    </div>
  </div>
</form>
<script type="text/javascript">
  $('#edit-form').find('.select2').select2();
</script>