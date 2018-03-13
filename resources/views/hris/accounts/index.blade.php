<div class="row">
  <div class="col-md-12">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#data" data-toggle="tab">Data</a></li>
      <li><a href="#new" data-toggle="tab">New</a></li>
    </ul>
    <div class="tab-content" style="padding-top: 10px;">
      <div class="tab-pane active" id="data">
        <div class="row">
          <div class="col-md-12">
            {{ export_btn('account') }}
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <table class="table bordered border striped" id="datatable">
              <thead>
                <tr>
                  <th width="10px">#</th>
                  <th>Username</th>
                  <th>Level</th>
                  <th>Staff</th>
                  <th>Department</th>
                  <th>Position</th>
                  <th width="150px">Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="new">
        @include('hris.accounts.add')
      </div>
    </div>
  </div>
</div>
@include('layouts.form.remove', ['modul'=>'account'])
<script type="text/javascript">
  $('#add-form').find('#check-all').on('ifChecked', function(event){
    $('#add-form').find('.check-menu').iCheck('check');
  });
  $('#add-form').find('#check-all').on('ifUnchecked', function(event){
    $('#add-form').find('.check-menu').iCheck('uncheck');
  });
</script>