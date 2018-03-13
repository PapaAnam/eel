{{-- @push('style')
  .bg-grey{
    background-color: #888888;
  }
@endpush --}}
<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">Application Skin</h3>
  </div>
  <div class="box-body">
    <input type="hidden" id="theme-token" value="{{ csrf_token() }}">
    <input type="hidden" id="theme-action" value="{{ route('setting.update_theme') }}">
    <div class="row">
      <div class="col-md-3">
        <a href="#" data-skin="skin-blue" class="clearfix full-opacity-hover a">
          <div>
            <span class="bg-blue-active b"></span>
            <span class="bg-blue c"></span>
          </div>
          <div>
            <span class="dark"></span>
            <span class="t"></span>
          </div>
        </a>
        <p class="text-center no-margin">Blue</p>
      </div>
      <div class="col-md-3">
        <a href="#" data-skin="skin-blue-light" class="clearfix full-opacity-hover a">
          <div>
            <span class="bg-blue-active b"></span>
            <span class="bg-blue c"></span>
          </div>
          <div>
            <span class="light"></span>
            <span class="t"></span>
          </div>
        </a>
        <p class="text-center no-margin" >Blue Light</p>
      </div>
      <div class="col-md-3">
        <a href="#" data-skin="skin-purple" class="clearfix full-opacity-hover a">
          <div>
            <span class="bg-purple-active b"></span>
            <span class="bg-purple c"></span>
          </div>
          <div>
            <span class="dark"></span>
            <span class="t"></span>
          </div>
        </a>
        <p class="text-center no-margin">Purple</p>
      </div>
      <div class="col-md-3">
        <a href="#" data-skin="skin-purple-light" class="clearfix full-opacity-hover a">
          <div>
            <span class="bg-purple-active b"></span>
            <span class="bg-purple c"></span>
          </div>
          <div>
            <span class="light"></span>
            <span class="t"></span>
          </div>
        </a>
        <p class="text-center no-margin">Purple Light</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <a href="#" data-skin="skin-yellow" class="clearfix full-opacity-hover a">
          <div>
            <span class="bg-yellow-active b"></span>
            <span class="bg-yellow c"></span>
          </div>
          <div>
            <span class="dark"></span>
            <span class="t"></span>
          </div>
        </a>
        <p class="text-center no-margin">Yellow</p>
      </div>
      <div class="col-md-3">
        <a href="#" data-skin="skin-yellow-light" class="clearfix full-opacity-hover a">
          <div>
            <span class="bg-yellow-active b"></span>
            <span class="bg-yellow c"></span>
          </div>
          <div>
            <span class="light"></span>
            <span class="t"></span>
          </div>
        </a>
        <p class="text-center no-margin" >Yellow Light</p>
      </div>
      <div class="col-md-3">
        <a href="#" data-skin="skin-red" class="clearfix full-opacity-hover a">
          <div>
            <span class="bg-red-active b"></span>
            <span class="bg-red c"></span>
          </div>
          <div>
            <span class="dark"></span>
            <span class="t"></span>
          </div>
        </a>
        <p class="text-center no-margin">Red</p>
      </div>
      <div class="col-md-3">
        <a href="#" data-skin="skin-red-light" class="clearfix full-opacity-hover a">
          <div>
            <span class="bg-red-active b"></span>
            <span class="bg-red c"></span>
          </div>
          <div>
            <span class="light"></span>
            <span class="t"></span>
          </div>
        </a>
        <p class="text-center no-margin">Red Light</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <a href="#" data-skin="skin-black" class="clearfix full-opacity-hover a">
          <div>
            <span class="bg-white-active b"></span>
            <span class="bg-white c"></span>
          </div>
          <div>
            <span class="dark"></span>
            <span class="t"></span>
          </div>
        </a>
        <p class="text-center no-margin">Black</p>
      </div>
      <div class="col-md-3">
        <a href="#" data-skin="skin-black-light" class="clearfix full-opacity-hover a">
          <div>
            <span class="bg-white-active b"></span>
            <span class="bg-white c"></span>
          </div>
          <div>
            <span class="light"></span>
            <span class="t"></span>
          </div>
        </a>
        <p class="text-center no-margin">Black Light</p>
      </div>
      <div class="col-md-3">
        <a href="#" data-skin="skin-green" class="clearfix full-opacity-hover a">
          <div>
            <span class="bg-green-active b"></span>
            <span class="bg-green c"></span>
          </div>
          <div>
            <span class="dark"></span>
            <span class="t"></span>
          </div>
        </a>
        <p class="text-center no-margin">Green</p>
      </div>
      <div class="col-md-3">
        <a href="#" data-skin="skin-green-light" class="clearfix full-opacity-hover a">
          <div>
            <span class="bg-green-active b"></span>
            <span class="bg-green c"></span>
          </div>
          <div>
            <span class="light"></span>
            <span class="t"></span>
          </div>
        </a>
        <p class="text-center no-margin">Green Light</p>
      </div>
      {{-- <div class="col-md-3">
        <a href="#" data-skin="skin-grey-light" class="clearfix full-opacity-hover a">
          <div>
            <span class="bg-grey-active b"></span>
            <span class="bg-grey c"></span>
          </div>
          <div>
            <span class="light"></span>
            <span class="t"></span>
          </div>
        </a>
        <p class="text-center no-margin">Grey Light</p>
      </div> --}}
    </div>
  </div>
</div>