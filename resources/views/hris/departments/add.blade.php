<div class="row">
  <form id="add-form" onsubmit="save(this, event)" role="form" action="{{ route('department.create') }}" method="post">
    {{ csrf_field() }}
    <div class="col-md-12">
      <div class="form-group">
        <label for="name">Name</label>
        <select style="width: 100%;" name="name[]" id="name" multiple class="form-control select2 multiple"></select>
        <span class="help-block"><strong></strong></span>
      </div>
    </div>
    <div class="col-md-12">
      {{ save_button() }}
    </div>
  </form>
</div>
<script type="text/javascript">
  $('#add-form').find(".multiple").select2({
    tags : true
  });
</script>