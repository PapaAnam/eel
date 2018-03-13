<div class="panel panel-default">
  <div class="panel-heading">
    Biography
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-sm-6">
        {!! ed_inp_txt($data->nin, 'nin', 'NIN', 'required') !!}
        {!! old_fl($data->nin, 'nin') !!}
      </div>
      <div class="col-sm-6">
        {!! ed_inp_txt($data->name, 'name', 'Name', 'required') !!}
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label for="gender">Gender</label>
          <select style="width: 100%;" class="form-control select2" id="gender" name="gender">
            <option value="Male" @if($data->gender=='Male') selected @endif>Male</option>
            <option value="Female" @if($data->gender=='Female') selected @endif>Female</option>
          </select>
        </div>
      </div>
      <div class="col-sm-4">
        {!! ed_inp_txt($data->born_in, 'born_in', 'Born In', 'required') !!}
      </div>
      <div class="col-sm-4">
        {{ input_date('birthdate', 'Birth Date', $data->birthdate) }}
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="marital_status">Marital Status</label>
          <select style="width: 100%;" class="form-control select2" id="marital_status" name="marital_status">
            @for($i=1;$i<=2;$i++)
            <option value="{{ $i }}" @if($data->marital_status==$i) selected @endif>{{ maried($i) }}</option>
            @endfor
          </select>
        </div>
      </div>
      <div class="col-sm-6">
        {!! ed_inp_textarea($data->present_address, 'present_address') !!}
      </div>
      <div class="col-sm-6">
        {!! ed_inp_txt($data->handphone, 'handphone') !!}
      </div>
      <div class="col-sm-6">
        {!! inp_file('ph', 'Photo', 'onchange="uploadPhoto(this)"') !!}
        <input type="hidden" name="photo" class="photo">
      </div>
      <div class="col-sm-12">
        <div class="alert alert-info">
          <h4><i class="icon fa fa-info-circle"></i> Please read!</h4>
          Leave blank photo if do not want to change
        </div>
      </div>
    </div>
  </div>
</div>