<!DOCTYPE html>
<html class="wide wow-animation" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Site Title-->
    <title>{{ config('app.constants.name', 'RT') }}</title>


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">


    @include('public.layouts.head-css')
    <link rel="stylesheet" href="{{ url('/admin/css/app-0143830c.css') }}">

    @yield('css')
    {{-- @vite(['resources/sass/app.scss']) --}}


</head>

<body>
    {{-- <div class="preloader">
        <div class="preloader-body">
            <div class="preloader-item"></div>
        </div>
    </div> --}}
    <div class="preloader">
        <div class="main-fader" responsive-height-comments>
            <div class="loader">
                <img src="{{ url('img/mts/logo-mts.png') }}" alt="">
            </div>
        </div>
    </div>
    <!-- Page-->
    <div class="page">
        <!-- Page Header-->
        @include('public.layouts.header')

        @yield('breadcrumb')


        @yield('content')

        <!-- Swiper-->


        <!-- Latest News-->

        <!-- Page Footer-->
        @include('public.layouts.footer')
        <!-- Modal Video-->

    </div>
    <!-- PANEL-->
    {{-- <div class="layout-panel-wrap">
        <div class="layout-panel">
            <button class="layout-panel-toggle" data-custom-toggle=".layout-panel-wrap"><span></span></button>
            <div class="layout-panel-content">
                <h6>Choose your color scheme:</h6>
                <div class="theme-switcher-list">
                    <button class="theme-switcher-list-item" data-theme-name="soccer">Soccer</button>
                    <button class="theme-switcher-list-item" data-theme-name="baseball">Baseball</button>
                    <button class="theme-switcher-list-item" data-theme-name="basketball">Basketball</button>
                    <button class="theme-switcher-list-item" data-theme-name="billiards">Billiards</button>
                    <button class="theme-switcher-list-item" data-theme-name="bowling">Bowling</button>
                    <button class="theme-switcher-list-item" data-theme-name="rugby">Rugby</button>
                    <button class="theme-switcher-list-item" data-theme-name="tennis">Tennis</button>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Global Mailform Output-->
    <div class="snackbars" id="form-output-global"></div>
    <!-- Javascript-->


    @include('public.layouts.scripts')
    <script src="{{ url('/admin/js/app-9c4e4404.js') }}"></script>


    @yield('js')
    {{-- @vite(['resources/js/app.js']) --}}


</body>

</html>
