<form role="form" action="{{ route('mutation.update') }}" method="post" id="edit-form">
  {{ csrf_field() }}
  {{ method_field('PUT') }}
  {{ id_field($data->id) }}
  <div class="row">
    <div class="col-sm-6 col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">Employee To Mutation</div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              {{ input_text('emp', 'Employee', '('.$data->nin.') '.$data->e_name, 'readonly') }}
            </div>
            <div class="employee-position-department">
            </div>
            <div class="col-md-12">
              {{ select('manager', 'The Leader Who Rule', App\Models\Hris\Employee::employees(), '', $data->manager) }}
            </div>
            <div class="col-md-12">
              {{ input_text('city', 'Leader City', $data->city, 'required') }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          Mutation To
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="department">Department</label>
                <select onchange="checkSubDep(this, this.value)" class="select2 form-control" id="department" name="department" required style="width: 100%;">
                  @foreach(App\Models\Hris\Department::all() as $d)
                  <option value="{{ $d->id }}">{{ $d->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="sub_department">Sub Department</label>
                <select class="select2 form-control" id="sub_department" name="sub_department" required style="width: 100%;">

                </select>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="position">Mutation To Position</label>
                <select class="select2 form-control" id="position" name="position" required style="width: 100%;">
                  @foreach(App\Models\Hris\Position::all() as $p)
                  <option value="{{ $p->id }}">{{ $p->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">Mutation Data</div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              {{ input_text('mutation_id', 'Mutation ID', $data->mutation_id, 'readonly') }}
            </div>
            <div class="col-md-12">
              {{ textarea('reason', '', $data->reason) }}
            </div>
            <div class="col-md-12">
              {{ input_date('effect_on', '', substr($data->effect_on, 0, 11)) }}
            </div>
            <div class="col-sm-12">
              {{ save_button('update').' '.save_close_button('update') }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<script type="text/javascript">
  var edit_form = $('#edit-form');
  checkSubDep(edit_form.find('#department'), edit_form.find('#department').val());
  $('#edit-form').find('.select2').select2();
</script>