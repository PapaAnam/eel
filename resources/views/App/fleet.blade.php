<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    {{ config('lisun.fleet.name') }}
  </title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta content="{{ config('lisun.fleet.base_url') }}" name="base_url" id="base_url">
  <meta content="{{ config('app.url') }}" name="domain" id="domain">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset(mix('css/fleet-lib.css')) }}">
</head>
<body>
  <div id="app-fleet">
    <fleet-management></fleet-management>
  </div>
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  @component('manifest')
  @endcomponent
  <script src="{{ asset(mix('js/fleet-lib.js')) }}"></script>
  <script src="{{ asset(mix('js/fleet.js')) }}"></script>
</body>
</html>