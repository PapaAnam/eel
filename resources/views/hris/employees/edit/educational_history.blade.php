<div class="panel panel-default">
  <div class="panel-heading">
    Educational History
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-sm-6">
        {!! ed_inp_txt($data->elementary, 'elementary', 'Elementary School') !!}
      </div>
      <div class="col-sm-3">
        {!! ed_inp_txt($data->el_year, 'el_year', 'Graduation Year') !!}
      </div>
      <div class="col-sm-6">
        {!! ed_inp_txt($data->junior, 'junior', 'Junior High School') !!}
      </div>
      <div class="col-sm-3">
        {!! ed_inp_txt($data->jun_year, 'jun_year', 'Graduation Year') !!}
      </div>
      <div class="col-sm-6">
        {!! ed_inp_txt($data->senior, 'senior', 'Senior High School') !!}
      </div>
      <div class="col-sm-3">
        {!! ed_inp_txt($data->sen_year, 'sen_year', 'Graduation Year') !!}
      </div>
      <div class="col-sm-6">
        {!! ed_inp_txt($data->university, 'university') !!}
      </div>
      <div class="col-sm-3">
        {!! ed_inp_txt($data->u_year, 'u_year', 'Graduation Year') !!}
      </div>
    </div>
  </div>
</div>