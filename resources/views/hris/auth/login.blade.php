<!DOCTYPE html>
<html lang="en">
<head>
  <title>HRIS LOGIN PAGE</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="{{asset('login-asset/images/icons/favicon.ico"')}}"/>
  <link rel="stylesheet" type="text/css" href="{{asset('login-asset/vendor/bootstrap/css/bootstrap.min.css')}}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('login-asset/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('login-asset/fonts/iconic/css/material-design-iconic-font.min.css')}}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('login-asset/vendor/animate/animate.css')}}">
  <!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="{{asset('login-asset/vendor/css-hamburgers/hamburgers.min.css')}}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('login-asset/vendor/animsition/css/animsition.min.css')}}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('login-asset/vendor/select2/select2.min.css')}}">
  <!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="{{asset('login-asset/vendor/daterangepicker/daterangepicker.css')}}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('login-asset/css/util.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('login-asset/css/main.css')}}">
  <!--===============================================================================================-->
</head>
<body>

  <div class="limiter">
    <div class="container-login100" style="background-image: url('{{asset('login-asset/images/bg-01.jpg')}}');">
      <div class="wrap-login100">
        <form method="POST" class="login100-form validate-form" action="{{ route('hris.login') }}">
          @csrf
          <center>
            <img style="max-width: 200px; border: 10px solid white; padding: 3px; border-radius: 10px;" src="images/logo.jpg" alt="">
          </center>

          <span class="login100-form-title p-b-34 p-t-27">
            Log in
          </span>
          @if (session('error_msg'))
          <center>
            <div class="alert alert-danger">
              {{session('error_msg')}}
            </div>
          </center>
          @endif

          @if (count($errors->all()) > 0)
          <center>
            <div class="alert alert-danger">
              @foreach ($errors->all() as $error)
                {{$error}} <br>
              @endforeach
            </div>
          </center>
          @endif

          <div class="wrap-input100 validate-input" data-validate = "Enter username">
            <input value="{{old('username')}}" required="required" class="input100" type="text" name="username" placeholder="Username">
            <span class="focus-input100" data-placeholder="&#xf207;"></span>
          </div>

          <div class="wrap-input100 validate-input" data-validate="Enter password">
            <input value="{{old('password')}}" required="required" class="input100" type="password" name="password" placeholder="Password">
            <span class="focus-input100" data-placeholder="&#xf191;"></span>
          </div>

          <div class="contact100-form-checkbox">
            <input class="input-checkbox100" value="1" id="ckb1" type="checkbox" name="remember_me">
            <label class="label-checkbox100" for="ckb1">
              Remember me
            </label>
          </div>

          <div class="container-login100-form-btn">
            <button type="submit" class="login100-form-btn">
              Login
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  

  <div id="dropDownSelect1"></div>
  
  <!--===============================================================================================-->
  <script src="{{asset('login-asset/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
  <!--===============================================================================================-->
  <script src="{{asset('login-asset/vendor/animsition/js/animsition.min.js')}}"></script>
  <!--===============================================================================================-->
  <script src="{{asset('login-asset/vendor/bootstrap/js/popper.js')}}"></script>
  <script src="{{asset('login-asset/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
  <!--===============================================================================================-->
  <script src="{{asset('login-asset/vendor/select2/select2.min.js')}}"></script>
  <!--===============================================================================================-->
  <script src="{{asset('login-asset/vendor/daterangepicker/moment.min.js')}}"></script>
  <script src="{{asset('login-asset/vendor/daterangepicker/daterangepicker.js')}}"></script>
  <!--===============================================================================================-->
  <script src="{{asset('login-asset/vendor/countdowntime/countdowntime.js')}}"></script>
  <!--===============================================================================================-->
  <script src="{{asset('login-asset/js/main.js')}}"></script>

</body>
</html>