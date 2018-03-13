<div class="panel panel-default">
  <div class="panel-heading">
    Placement
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <label for="department">Department</label>
          <select onchange="checkSubDep(this, this.value)" class="select2 form-control" id="department" name="department" required style="width: 100%;">
            @foreach(App\Models\Hris\Department::all() as $d)
            <option value="{{ $d->id }}" @if($d->id==$department) selected @endif>{{ $d->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label for="sub_department">Sub Department</label>
          <select class="select2 form-control" id="sub_department" name="sub_department" required style="width: 100%;">
            @foreach(App\Models\Hris\SubDepartment::where('department', $department)->get() as $d)
            <option value="{{ $d->id }}" @if($d->id==$data->department) selected @endif>{{ $d->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label for="position">Position</label>
          <select class="select2 form-control" id="position" name="position" required style="width: 100%;">
            @foreach(App\Models\Hris\Position::all() as $p)
            <option value="{{ $p->id }}" @if($data->position==$p->id) selected @endif>{{ $p->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label for="type">Type</label>
          <select class="select2 form-control" id="type" name="type" style="width: 100%;">
            @for($i=1;$i<=2;$i++)
            <option value="{{ $i }}" @if($i==$d->type) selected @endif>{{ employee_type($i) }}</option>
            @endfor
          </select>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label for="from">From</label>
          <select class="select2 form-control" id="from" name="from" style="width: 100%;">
            <option value="Local" @if($data->e_from=='Local') selected @endif >Local</option>
            <option value="International" @if($data->e_from=='International') selected @endif >International</option>
          </select>
        </div>
      </div>
      <div class="col-sm-4">
        {{ input_date('joining_date', '', $data->joining_date) }}
      </div>
      <div class="col-sm-4">
        {{ input_text('bri_account', '', $data->bri_account) }}
      </div>
    </div>
  </div>
</div>

