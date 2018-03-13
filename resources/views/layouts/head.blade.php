<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    {{ App\Models\Hris\ApplicationSetting::find(1)->name }}
  </title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta content="{{ csrf_token() }}" name="csrf_token" id="csrf_token">
  <meta content="{{ config('app.url') }}" name="base_url" id="base_url">
  <meta content="{{ config('app.url') }}" name="domain" id="domain">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @include('layouts.css')
  @include('css.tile_style')
  @include('layouts.head_script')
</head>