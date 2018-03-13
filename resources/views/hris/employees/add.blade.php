<form onsubmit="save(this, event)" id="add-form" role="form" action="{{ route('employee.create') }}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="row">
    <div class="col-sm-3">
      <div class="panel panel-default">
        <div class="panel-heading">Employee Field</div>
        <div class="panel-body">
          <a class="form-control btn btn-default btn-default" href="#biography" data-toggle="tab">
            Biography
          </a>
          <a class="form-control btn btn-default btn-default" href="#placement" data-toggle="tab">
            Placement
          </a>
          <a class="form-control btn btn-default btn-default" href="#family_background" data-toggle="tab">
            Family Background
          </a>
          <a class="form-control btn btn-default btn-default" href="#educational_history" data-toggle="tab">
            Educational History
          </a>
          <a class="form-control btn btn-default btn-default" href="#important_file" data-toggle="tab">
            Important File
          </a>
          {{ save_button() }}
        </div>
      </div>
      <div class="image-container rounded bordered">
        <div class="frame"><img id="img-photo" src="{{ asset('images/employee/default.jpg') }}"></div>
      </div>
    </div>
    <div class="col-sm-9">
      <div class="tab-content">
        <div class="tab-pane active" id="biography">
          @include('hris.employees.add.biography')
        </div>
        <div class="tab-pane active" id="placement">
          @include('hris.employees.add.placement')
        </div>
        <div class="tab-pane" id="family_background">
          @include('hris.employees.add.family')
        </div>
        <div class="tab-pane" id="educational_history">
          @include('hris.employees.add.educational_history')
        </div>
        <div class="tab-pane" id="important_file">
          @include('hris.employees.add.important_file')
        </div>
      </div>
    </div>
  </div>
</form>
<script type="text/javascript">
  $('.date-mask').inputmask();
  var myModal = $('#myModal');
  function checkSubDep(el, val=null)
  {
    var dept = el;
    var dept_id;
    if(val!=null){
      dept = $(el);
      dept_id = val;
    }else
    dept_id = el.val();
    var sub_dept = dept.parents('.panel').find('#sub_department');
    $.ajax({
      url : '{{ route('employee.check_sub_department') }}',
      type : 'POST',
      data : {
        _token : '{{ csrf_token() }}',
        id : dept_id
      },
      success : function(r){
        sub_dept.html(r);
      }
    });
  }
  $('#add-form').find('.select2').select2();
  checkSubDep($('#add-form').find('#department'));
  $('#add-form').find('.danger').css({'backgroundColor' : $('.box').css('backgroundColor'), 'border':'none'});
</script>