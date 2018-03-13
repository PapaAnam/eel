@extends('layouts.view')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>Mutations</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="{{ $back }}">Mutations</a></li>
      <li class="active">Edit</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header">
          </div>
          <div class="box-body">
            <form role="form" action="{{ $action }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            {{ id_field($data->id) }}
              <div class="row">
                <div class="col-md-12">
                  <div class="box box-solid">
                    <div class="box-body">
                        {{ csrf_field() }}
                        <div class="row">
                          <div class="col-md-4">
                            {{ edit_input_text($errors, $data->e_name.' ('.$old_position.')', 'employee', true) }}
                          </div>
                          <div class="col-md-4">
                            <div class="form-group {{ has_error($errors, 'department') }}">
                              <label for="department">Department</label>
                              <select class="select2 form-control" id="department" name="department" required style="width: 100%;">
                              @foreach($departments as $d)
                                @if($data->old_department==$d->id)
                                  <option value="{{ $d->id }}" selected>{{ $d->name }}</option>
                                @else
                                  <option value="{{ $d->id }}">{{ $d->name }}</option>
                                @endif
                              @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group {{ has_error($errors, 'position') }}">
                              <label for="position">Position</label>
                              <select class="select2 form-control" id="position" name="position" required style="width: 100%;">
                              @foreach($positions as $p)
                                @if($data->old_position==$p->id)
                                  <option value="{{ $p->id }}" selected>{{ $p->name }}</option>
                                @else
                                  <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endif
                              @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="col-md-12">
                            {{ edit_input_textarea($errors, $data->reason, 'reason') }}
                          </div>
                        </div>
                        {{ save_btn() }}
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection