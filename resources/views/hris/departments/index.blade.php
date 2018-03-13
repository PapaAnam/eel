<div class="row">
  <div class="col-md-12">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#department_data" data-toggle="tab">Departments Data</a></li>
      <li><a href="#department_recycle" data-toggle="tab">Departments Recycle</a></li>
      @if(App\Models\Hris\Authority::allowed('sub_department'))
      <li><a href="#sub_department_data" data-toggle="tab">Sub Departments Data</a></li>
      <li><a href="#sub_department_recycle" data-toggle="tab">Sub Departments Recycle</a></li>
      @endif
    </ul>
    <div class="tab-content" style="padding-top: 10px;">
      <div class="tab-pane active" id="department_data">
        <div class="row">
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">Data</div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12">
                    {{ export_btn('department') }}
                  </div>
                  <div class="col-md-12">
                    <table class="table bordered border striped" id="datatable">
                      <thead>
                        <tr>
                          <th width="10px">#</th>
                          <th>Name</th>
                          <th width="200px">Action</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <department-add action="{{ route('department.create') }}" csrf_token="{{ csrf_token() }}"></department-add>
        </div>
      </div>
      <div class="tab-pane" id="department_recycle">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">Data</div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12">
                    {{ refresh_button('refreshTable()') }}
                  </div>
                  <div class="col-md-12">
                    <table class="table bordered border striped" id="department-recycle">
                      <thead>
                        <tr>
                          <th width="10px">#</th>
                          <th>Name</th>
                          <th>Deleted At</th>
                          <th width="200px">Action</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @if(App\Models\Hris\Authority::allowed('sub_department'))
      <div class="tab-pane" id="sub_department_data">
        <div class="row">
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">Data</div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12">
                    {{ export_btn('sd') }}
                  </div>
                  <div class="col-md-12">
                    <table class="table bordered border striped sub_departments">
                      <thead>
                        <tr>
                          <th width="10px">#</th>
                          <th>Name</th>
                          <th>Department</th>
                          <th width="200px">Action</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">New</div>
              <div class="panel-body">
                @include('hris.sub_departments.add')
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="sub_department_recycle">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">Data</div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12">
                    {{ refresh_button('refreshTable()') }}
                  </div>
                  <div class="col-md-12">
                    <table class="table bordered border striped" id="sub-department-recycle">
                      <thead>
                        <tr>
                          <th width="10px">#</th>
                          <th>Name</th>
                          <th>Department</th>
                          <th>Deleted At</th>
                          <th width="200px">Action</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>
  </div>
</div>