<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark"
    data-sidebar-size="lg" data-sidebar-image="img-5" data-preloader="enable">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8" />
    <title>{{ config('app.constants.name', 'SICAF') }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">

    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="shortcut icon" href="{{ url('favicon.ico') }}">

    @include('admin.layouts.head-css')



    @yield('css')

    <link rel="stylesheet" href="{{ url('/admin/css/app-0143830c.css') }}">


    {{-- @vite(['resources/sass/app.scss']) --}}



</head>

<body>



    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('admin.layouts.topbar')
        @include('admin.layouts.sidebar')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between mb-2">
                                <h4 class="mb-sm-0"> @yield('title') </h4>

                                @yield('breadcrumb')

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- contenido -->

                    @yield('content')

                    <!-- fin contenido -->


                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @include('admin.layouts.footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->






    @include('admin.layouts.customizer')


    @include('admin.layouts.vendor-scripts')




    <script src="{{ url('/admin/js/app-f2327e30.js') }}"></script>

    @yield('js')



    <script src="{{ url('/assets/js/app.js') }}"></script>


    {{-- @vite(['resources/js/app.js']) --}}

</body>

</html>
