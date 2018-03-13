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
            {{ export_btn('mutation') }}
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <table class="table bordered border striped" id="datatable">
              <thead>
                <tr>
                  <th width="10px">#</th>
                  <th>Mutation ID</th>
                  <th>Employee</th>
                  <th>New Position</th>
                  <th>Created At</th>
                  <th width="230px">Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="new">
        @include('hris.mutations.add')
      </div>
    </div>
  </div>
</div>
@include('layouts.form.remove', ['modul'=>'mutation'])