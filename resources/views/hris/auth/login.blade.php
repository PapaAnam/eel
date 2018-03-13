<?php
function random($ar)
{
  return $ar[array_rand($ar)];
}
$ar = [0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f'];
$colors = [];
for($a=1;$a<=200;$a++)
  array_push($colors, ('#'.random($ar).random($ar).random($ar).random($ar).random($ar).random($ar)));
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="description" content="Aplikasi penggajian yang mudah digunakan untuk melakukan penggajian">
  <meta name="keywords" content="HRIS Application, Aplikasi penggajian karyawan, Sistem penggajian karyawan">
  <meta content="{{ config('app.url') }}" name="base_url" id="base_url">
  <meta name="author" content="Hairul Anam">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Login HRIS</title>
  <link rel="stylesheet" href="{{ asset('css/metro.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/metro-icons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/animate.delay.min.css') }}">
  <style>
  <?php echo "
  .rainbow {
    background: ".random($colors).";
    width : 100%;
    height: 100%;
    display: block;
    -webkit-animation: rainbow infinite alternate;  Safari 4.0 - 8.0 
    -webkit-animation-duration: 2s; /* Safari 4.0 - 8.0 */
    animation: rainbow infinite alternate;
    animation-duration: 100s;

  }
  @-webkit-keyframes rainbow {";
  $anim = "";
  for($i=10;$i<=100;$i+=10)
    $anim .= $i."% {background-color: ".random($colors).";} ";
  echo $anim."}
  @keyframes rainbow {".$anim."}"  ?>
</style>
</head>
<body class="rainbow">
  <div id="login-hris">
    <login-hris></login-hris>
  </div>
  @component('manifest')
  @endcomponent
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset(mix('js/login-hris.js')) }}"></script>
</body>
</html>