<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        {{ config('app.name') }}
    </title>
    @include('meta')
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome-animation.min.css') }}">
    <link rel="stylesheet" href="{{ asset(mix('css/enterprise.css')) }}">
</head>
<body>
    <div id="app">
        <div class="menu">
            <enterprise-edition></enterprise-edition>
        </div>
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    @component('manifest')
    @endcomponent
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset(mix('js/enterprise-lib.js')) }}"></script>
    <script src="{{ asset(mix('js/enterprise.js')) }}"></script>
</body>
</html>