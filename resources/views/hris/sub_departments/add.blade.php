<form id="sub-add-form" onsubmit="save(this, event)" role="form" action="{{ route('sd.create') }}" method="post">
  {{ csrf_field() }}
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="name">Name</label>
        <select name="name[]" id="name" multiple style="width: 100%;" class="form-control multiple select2" required></select>
        <span class="help-block"><strong></strong></span>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="department">Department</label>
        <select style="width: 100%;" class="select2 form-control sing" id="department" name="department" required>
          @foreach(App\Models\Hris\Department::all() as $d)
          <option value="{{ $d->id }}">{{ $d->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-md-12">
      {{ save_button() }}
    </div>
  </div>
</form>
<script type="text/javascript">
  $('#sub-add-form').find(".multiple").select2({
    tags : true
  });
  $('#sub-add-form').find(".sing").select2();
</script>