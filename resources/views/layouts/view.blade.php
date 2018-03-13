<!DOCTYPE html>
<html>
@include('layouts.head')
<body>
  <div class="loader">
    <div data-role="preloader" data-type="ring"></div>
    <h3></h3>
  </div>
  <div class="menu">
    @include('layouts.header')
    <div class="menu-body">
      @yield('module')
    </div>
  </div>
  <div class="mac-view">
    <div class="mac-preloader">
      <div class="mac-module-icon">
        <i></i>
      </div>
      <div class="mac-loader">
        <div data-role="preloader" data-type="ring"></div>
      </div>
    </div>
    <div class="mac">
      <div class="mac-header">
        <div class="mac-icon float-left">
          <i></i>
        </div>
        <div class="mac-title float-left"></div>
        <div class="mac-close float-right">
          <i class="fa fa-close"></i>
        </div>
      </div>  
      <div class="mac-content"></div>
      <div class="mac-footer"></div>
    </div>
  </div>
  <div class="mac-edit">
    <div class="mac-preloader">
      <div class="mac-module-icon">
        <i></i>
      </div>
      <div class="mac-loader">
        <div data-role="preloader" data-type="ring"></div>
      </div>
    </div>
    <div class="mac">
      <div class="mac-header">
        <div class="mac-icon float-left">
          <i></i>
        </div>
        <div class="mac-title float-left"></div>
        <div class="mac-close float-right">
          <i class="fa fa-close"></i>
        </div>
      </div>  
      <div class="mac-content"></div>
      <div class="mac-footer"></div>
    </div>
  </div>
  <div class="mac-detail">
    <div class="mac-preloader">
      <div class="mac-module-icon">
        <i></i>
      </div>
      <div class="mac-loader">
        <div data-role="preloader" data-type="ring"></div>
      </div>
    </div>
    <div class="mac">
      <div class="mac-header">
        <div class="mac-icon float-left">
          <i></i>
        </div>
        <div class="mac-title float-left"></div>
        <div class="mac-close float-right">
          <i class="fa fa-close"></i>
        </div>
      </div>  
      <div class="mac-content"></div>
      <div class="mac-footer"></div>
    </div>
  </div>
  <div class="mac-free">
    <div class="mac-preloader">
      <div class="mac-module-icon">
        <i></i>
      </div>
      <div class="mac-loader">
        <div data-role="preloader" data-type="ring"></div>
      </div>
    </div>
    <div class="mac">
      <div class="mac-header">
        <div class="mac-icon float-left">
          <i></i>
        </div>
        <div class="mac-title float-left"></div>
        <div class="mac-close float-right">
          <i class="fa fa-close"></i>
        </div>
      </div>  
      <div class="mac-content"></div>
      <div class="mac-footer"></div>
    </div>
  </div>
  <div class="please-wait">
    <i class="fa fa-spinner fa-spin"></i>
  </div>
</div>
@include('layouts.script')
<script src="{{ asset(mix('js/hris.js')) }}"></script>
</body>
</html>