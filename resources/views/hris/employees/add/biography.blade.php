<div class="panel panel-default">
  <div class="panel-heading">
    Biography
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-sm-6">
        {!! inp_text('nin', 'NIN', 'required') !!}
      </div>
      <div class="col-sm-6">
        {!! inp_text('name', 'Name', 'required') !!}
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label for="gender">Gender</label>
          <select style="width: 100%;" class="form-control select2" id="gender" name="gender">
            <option value="Male" @if(old('gender')=='Male') selected @endif>Male</option>
            <option value="Female" @if(old('gender')=='Female') selected @endif>Female</option>
          </select>
        </div>
      </div>
      <div class="col-sm-4">
        {!! inp_text('born_in', 'Born In', 'required') !!}
      </div>
      <div class="col-sm-4">
        {{ input_date('birthdate', 'Birth Date') }}
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="marital_status">Marital Status</label>
          <select style="width: 100%;" class="form-control select2" id="marital_status" name="marital_status">
            @for($i=1;$i<=2;$i++)
            <option value="{{ $i }}">{{ maried($i) }}</option>
            @endfor
          </select>
        </div>
      </div>
      <div class="col-sm-6">
        {!! inp_textarea('present_address') !!}
      </div>
      <div class="col-sm-6">
        {!! inp_text('handphone') !!}
      </div>
      <div class="col-sm-6">
        {{ input_date('joining_date') }}
      </div>
      <div class="col-sm-4">
        {!! inp_file('ph', 'Photo', 'onchange="uploadPhoto(this)"') !!}
        <input type="hidden" name="photo" class="photo">
      </div>
    </div>
  </div>
</div>