<form onsubmit="save(this, event)" id="add-form" role="form" action="{{ route('position.create') }}" method="post">
  {{ csrf_field() }}
  <div class="row">
    <div class="col-md-12">
      {{ input_text('name', '', '', 'required') }}
    </div>
    <div class="col-md-12">
      {{ save_button() }}
    </div>
  </div>
</form>