<div class="container bg-white padding10 no-margin">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#data" data-toggle="tab">Data</a></li>
    <li><a href="#new" data-toggle="tab">New</a></li>
    <li><a href="#salary_rules" data-toggle="tab">Salary Rules</a></li>
    <li><a href="#non_active_employees" data-toggle="tab">Non Active Employees</a></li>
  </ul>
  <div class="tab-content" style="padding-top: 10px;">
    <div class="tab-pane active" id="data">
      <div class="row">
        <div class="col-md-12">
          {{ export_btn('employee') }}
        </div>
        <div class="col-md-12">
          <table class="table bordered border striped" id="datatable">
            <thead>
              <tr>
                <th>NIN</th>
                <th>Name</th>
                <th>Department</th>
                <th>Sub Department</th>
                <th>Position</th>
                <th width="200px">Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
    <div class="tab-pane" id="new">
      @include('hris.employees.add')
    </div>
    <div class="tab-pane" id="salary_rules">
      @include('hris.employees.salary_rules.index')
    </div>
    <div class="tab-pane" id="non_active_employees">
      @include('hris.employees.non_active.index')
    </div>
  </div>
</div>
{{ edit_url(route('employee.edit')) }}
<script type="text/javascript">
  function checkNIN(el)
  {
    if(el.parents('form').find('#nin').val()==''){
      $.Notify({keepOpen: true, type: 'alert', caption: 'Warning', content: 'Please insert NIN first!!!'});
      el.val('');
      return;
    }
  }
  function uploadPhoto(el, act = 'add')
  {
    el = $(el);
    var form = el.parents('form');
    var nin = form.find('#nin').val();
    checkNIN(el);
    var file = el[0].files[0];
    if(file==null)
      return;
    if(file.type!='image/jpeg' && file.type!='image/png'){
      $.Notify({keepOpen: true, type: 'alert', caption: 'Warning', content: 'File not supported!!!'});
      el.val('');
      return;
    }
    var data = new FormData();
    data.append('nin', nin);
    data.append('action', act);
    data.append('photo', file);
    data.append('_token', '{{ csrf_token() }}');
    $.ajax({
      url: '{{ route('employee.up_photo') }}',
      type: 'POST',
      data: data,
      cache: false,
      dataType: 'json',
      processData: false,
      contentType: false,
      success: function(data, textStatus, jqXHR)
      {
        $.Notify({type: 'success', caption: 'Success', content: data.success});
        form.find('#img-photo').attr('src', '{{ asset('storage') }}'+'/'+nin+'/photo/'+file.name);
        form.find('.photo').val(file.name)
      },
      error: function(jqXHR, textStatus, errorThrown)
      {
        $.Notify({keepOpen: true, type: 'alert', caption: 'Failed', content: JSON.parse(jqXHR.responseText).nin || JSON.parse(jqXHR.responseText).photo+'<br>'+'Dimension size must 300x400'});
      }
    });
  }

  function uploadHistory(el, type = 'elektoral', act = 'add')
  {
    var url = '{{ route('employee.upload_elektoral') }}';
    if(type=='cartao_rdtl')
      url = '{{ route('employee.upload_cartao_rdtl') }}'
    else if(type=='certidao_baptismo')
      url = '{{ route('employee.upload_certidao_baptismo') }}'
    el = $(el);
    var form = el.parents('form');
    var nin = form.find('#nin').val();
    checkNIN(el);
    var file = el[0].files[0];
    if(file==null)
      return;
    console.log(file);
    var supported_files = ['application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/msword', 'image/bmp', 'image/png', 'image/jpeg'];
    if(!$.inArray(file.type, supported_files)){
      $.Notify({keepOpen: true, type: 'alert', caption: 'Warning', content: 'File not supported!!!'});
      el.val('');
      return;
    }
    var data = new FormData();
    data.append('nin', nin);
    data.append('act', act);
    if(type=='elektoral')
      data.append('elektoral', file);
    else if(type=='cartao_rdtl')
      data.append('cartao_rdtl', file);
    else
      data.append('certidao_baptismo', file);
    data.append('_token', '{{ csrf_token() }}');
    $.ajax({
      url: url,
      type: 'POST',
      data: data,
      cache: false,
      dataType: 'json',
      processData: false,
      contentType: false,
      success: function(data, textStatus, jqXHR)
      {
        $.Notify({type: 'success', caption: 'Success', content: data.success});
        if(type=='elektoral')
          form.find('.elektoral').val(file.name)
        else if(type=='cartao_rdtl')
          form.find('.cartao_rdtl').val(file.name)
        else
          form.find('.certidao_baptismo').val(file.name)
      },
      error: function(jqXHR, textStatus, errorThrown)
      {
        $.Notify({keepOpen: true, type: 'alert', caption: 'Failed', content: JSON.parse(jqXHR.responseText).nin});
      }
    });
  }
  var myModal = $('#myModal');
</script>
@include('layouts.form.remove', ['modul'=>'employee'])