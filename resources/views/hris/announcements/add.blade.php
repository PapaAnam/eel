<link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
<form role="form" action="{{ route('announcement.create') }}" method="post">
  {{ csrf_field() }}
  <div class="row">
    {{-- <div class="col-md-12">
      <label for="demo">Demo</label>
      <div class="callout">
        <h4 class="title"></h4>
        <p id="content"></p>
      </div>
    </div> --}}
    <div class="col-md-6">
      {!! inp_text('title') !!}
    </div>
    {{-- <div class="col-md-3">
      <div class="form-group">
        <label for="d"></label>
        <a data-toggle="tooltip" title="Check Demo" class="form-control btn btn-primary btn-sm pointer" onclick="checkDemo()"><i class="fa fa-eye"></i> Click me to view demo</a>
      </div>
    </div> --}}
    <div class="col-md-12">
      <textarea name="content" class="textarea" placeholder="Insert Content" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('content') }}</textarea>
    </div>
    <div class="col-md-3">
      {!! inp_date('show_at') !!}
    </div>
    <div class="col-md-3">
      {!! inp_date('until_at') !!}
    </div>
    {{-- <div class="col-md-3">
      <div class="form-group">
        <label for="color">Color</label>
        <select name="color" id="color" style="width: 100%;" class="form-control">
          <option value="callout-info">Blue</option>
          <option value="callout-warning">Yellow</option>
          <option value="callout-danger">Red</option>
          <option value="callout-success">Green</option>
        </select>
      </div>
    </div> --}}
  </div>
  {!! save_btn() !!}
</form>
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script>
  $(".textarea").wysihtml5({
    toolbar : {
      "image" : false,
      "link" : false
    }
  });
  function checkDemo()
  {
    var t = $('#title').val();
    var c = $('.textarea').val();
    var col = $('#color').val();
    $('.title').text(t);
    $('p#content').html(c);
    $('.callout').attr('class','').addClass('callout '+col);
  }
</script>