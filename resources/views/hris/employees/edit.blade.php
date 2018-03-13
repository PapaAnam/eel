<form id="edit-form" onsubmit="save(this, event)" role="form" action="{{ route('employee.update') }}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ method_field('PUT') }}
  {{ id_field($data->id) }}
  <div class="row">
    <div class="col-sm-3">
      <div class="panel panel-default">
        <div class="panel-heading">Employee Field</div>
        <div class="panel-body">
          <a class="form-control btn btn-default btn-default" href="#biography_edit" data-toggle="tab">
            Biography
          </a>
          <a class="form-control btn btn-default btn-default" href="#placement_edit" data-toggle="tab">
            Placement
          </a>
          <a class="form-control btn btn-default btn-default" href="#family_background_edit" data-toggle="tab">
            Family Background
          </a>
          <a class="form-control btn btn-default btn-default" href="#educational_history_edit" data-toggle="tab">
            Educational History
          </a>
          <a class="form-control btn btn-default btn-default" href="#important_file_edit" data-toggle="tab">
            Important File
          </a>
          {{ save_button('update').' '.save_close_button('update') }}
        </div>
      </div>
      <div class="image-container rounded bordered">
        <div class="frame"><img id="img-photo" src="{{ $photo }}"></div>
      </div>
    </div>
    <div class="col-sm-9">
      <div class="tab-content">
        <div class="tab-pane active" id="biography_edit">
          @include('hris.employees.edit.biography')
        </div>
        <div class="tab-pane" id="placement_edit">
          @include('hris.employees.edit.placement')
        </div>
        <div class="tab-pane" id="family_background_edit">
          @include('hris.employees.edit.family')
        </div>
        <div class="tab-pane" id="educational_history_edit">
          @include('hris.employees.edit.educational_history')
        </div>
        <div class="tab-pane" id="important_file_edit">
          @include('hris.employees.edit.important_file')
        </div>
      </div>
    </div>
  </div>
</form>
<script type="text/javascript">
  $('.date-mask').inputmask();
  $(".select2").select2({
    tags : true
  });
</script>