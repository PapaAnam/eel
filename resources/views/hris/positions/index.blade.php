<div class="row">
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">Data</div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">
                {{ export_btn('position') }}
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
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">New</div>
          <div class="panel-body">
            @include('hris.positions.add')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('layouts.form.remove')