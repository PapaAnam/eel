@extends('layouts.view')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>AnnouncementS</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="{{ $back }}">AnnouncementS</a></li>
      <li class="active">Edit</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="box box-primary">
      <div class="box-body">
        <form role="form" action="{{ $action }}" method="post">
          {{ csrf_field() }}
          {{ method_field('PUT')}}
          {{ id_field($data->id) }}
          <div class="row">
            <div class="col-md-12">
              <label for="demo">Demo</label>
              <div class="callout">
                <h4 class="title"></h4>
                <p id="content"></p>
              </div>
            </div>
            <div class="col-md-6">
              {{ edit_input_text($errors, $data->title, 'title') }}
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="d"></label>
                <a data-toggle="tooltip" title="Check Demo" class="form-control btn btn-primary btn-sm pointer" onclick="checkDemo()"><i class="fa fa-eye"></i> Click me to view demo</a>
              </div>
            </div>
            <div class="col-md-12">
              <textarea onchange="checkDemo()" name="content" class="textarea" placeholder="Insert Content" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $data->content }}</textarea>
            </div>
            <div class="col-md-3">
              {{ edit_input_date($errors, eng_date2($data->show_at), 'show_at') }}
            </div>
            <div class="col-md-3">
              {{ edit_input_date($errors, eng_date2($data->until_at), 'until_at') }}
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="color">Color</label>
                <select onchange="checkDemo()" name="color" id="color" style="width: 100%;" class="form-control">
                  <option @if($data->color=='callout-info') selected @endif value="callout-info">Blue</option>
                  <option @if($data->color=='callout-warning') selected @endif value="callout-warning">Yellow</option>
                  <option @if($data->color=='callout-danger') selected @endif value="callout-danger">Red</option>
                  <option @if($data->color=='callout-success') selected @endif value="callout-success">Green</option>
                </select>
              </div>
            </div>
          </div>
          {{ save_btn() }}
        </form>
      </div>
    </div>
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">

      </div>
      <!--/.col (left) -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@push('css')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush
@push('js')
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
@endpush
@push('ready-function')
$(".textarea").wysihtml5();
checkDemo();
@endpush
@push('function')
function checkDemo()
{
  var t = $('#title').val();
  var c = $('.textarea').val();
  var col = $('#color').val();
  $('.title').text(t);
  $('p#content').html(c);
  $('.callout').attr('class','').addClass('callout '+col);
}
@endpush