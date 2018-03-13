<!DOCTYPE html>
<html>
<head>
    <title>Help Desk | Enterprise Edition</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta content="{{ csrf_token() }}" name="csrf-token" id="csrf-token">
    <meta content="{{ config('app.url') }}" name="base_url" id="base_url">
    <link rel="stylesheet" href="{{ asset(mix('css/preloader.css')) }}">
    <link href="{{ asset('css/new-metro.css') }}" rel="stylesheet">
    <link href="{{ asset('metro/build/css/metro-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('metro/build/css/metro-schemes.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/font-awesome-animation/font-awesome-animation.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/datatables/extensions/Responsive/css/dataTables.responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/iCheck/all.css') }}" rel="stylesheet">
    <link href="{{ asset('metro/build/transition_effects.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/tambahan.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}">
    @include('layouts.head_script')
</head>
<body>
    <div id="app">
        <preloader></preloader>
        <div class="menu">
            <router-view></router-view>
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
{{-- <script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}"></script> --}}
@if(config('app.env') == 'local')
<script src="http://localhost:35729/livereload.js"></script>
@endif
<script src="{{ asset(mix('js/help-desk.js')) }}"></script>
<script>
    $(document).ready(function(){
        $('.preloader').fadeOut();
    });
</script>
</body>
</html>