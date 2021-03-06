<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    {{ config('app.marketing_name') }}
  </title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta content="{{ config('app.url') }}" name="base_url" id="base_url">
  <meta content="{{ config('app.url') }}" name="domain" id="domain">
  <meta content="{{ config('app.marketing') }}" name="marketing-idea-base" id="marketing-idea-base">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> --}}
  <link rel="stylesheet" href="{{ asset('css/new-metro.css?3892832') }}">
  <link rel="stylesheet" href="{{ asset('css/metro-schemes.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/metro-icons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/font-awesome-animation.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/fullcalendar.min.css') }}">
  <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('datatable/responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('iCheck/all.css') }}">
  <link rel="stylesheet" href="{{ asset('css/new_preloader.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/hris-additional.css') }}">
  <link rel="stylesheet" href="{{ asset('css/tiles.css') }}">
  <style>
  .mac {
    position: fixed;
    z-index: 2;
    display: none;
  }
</style>
</head>
<body>
  <div id="app-marketing-idea">
    <marketing-idea></marketing-idea>
  </div>
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/metro.min.js') }}"></script>
  {{-- <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script> --}}
  <script src="{{ asset('js/select2.full.min.js') }}"></script>
  <script src="{{ asset('js/jquery.inputmask.js') }}"></script>
  <script src="{{ asset('js/jquery.inputmask.extensions.js') }}"></script>
  <script src="{{ asset('js/jquery.inputmask.date.extensions.js') }}"></script>
  <script src="{{ asset('js/moment.min.js') }}"></script>
  <script src="{{ asset('js/fullcalendar.min.js') }}"></script>
  <script src="{{ asset('iCheck/icheck.min.js') }}"></script>
  <script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('datatable/responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('datatable/responsive/js/responsive.bootstrap4.min.js') }}"></script>
  @if(config('app.is_online'))
  <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{config('app.map_api')}}"></script>
  @endif
  @include('manifest')
  <script src="{{ asset(mix('js/marketing-idea.js')) }}"></script>
</body>
</html>