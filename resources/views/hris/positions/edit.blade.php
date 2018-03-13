<form onsubmit="save(this, event, 'update')" id="edit-form" role="form" action="{{ route('position.update') }}" method="post">
  {{ csrf_field() }}
  {{ id_field($data->id) }}
  {{ method_field('PUT') }}
  <div class="row">
    <div class="col-md-12">
      {!! ed_inp_txt($data->name, 'name', 'Name') !!}
      {!! old_fl($data->name, 'name') !!}
    </div>
    <div class="col-md-12">
      {{ save_button('update') }} {{ save_close_button('update') }}
    </div>
  </div>
</form>