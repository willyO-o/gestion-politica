@section('content')
    <div class="row">
        <div class="col-xxl-5">
            <div class="d-flex flex-column h-100">
                {{-- <div class="row h-100">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="alert alert-warning border-0 rounded-0 m-0 d-flex align-items-center"
                                    role="alert">
                                    <i data-feather="alert-triangle" class="text-warning me-2 icon-sm"></i>
                                    <div class="flex-grow-1 text-truncate">
                                        Your free trial expired in <b>17</b> days.
                                    </div>
                                    <div class="flex-shrink-0">
                                        <a href="pages-pricing"
                                            class="text-reset text-decoration-underline"><b>Upgrade</b></a>
                                    </div>
                                </div>

                                <div class="row align-items-end">
                                    <div class="col-sm-8">
                                        <div class="p-3">
                                            <p class="fs-16 lh-base">Upgrade your plan from a <span class="fw-semibold">Free
                                                    trial</span>, to ‘Premium Plan’ <i class="mdi mdi-arrow-right"></i></p>
                                            <div class="mt-3">
                                                <a href="pages-pricing"
                                                    class="btn btn-success waves-effect waves-light">Upgrade
                                                    Account!</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="px-3">
                                            <img src="/assets/images/user-illustarator-2.png" class="img-fluid"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end card-body-->
                        </div>
                    </div> <!-- end col-->
                </div> <!-- end row--> --}}

                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Usuarios</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                                data-target="{{ $users }}">0</span></h2>
                                        <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                                                <i class="ri-arrow-up-line align-middle"></i>
                                            </span> vs. previous month</p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary rounded-circle fs-2">
                                                <i data-feather="users"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Casas de Campaña</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                                data-target="{{ $sucursales }}">0</span></h2>
                                        <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                                                <i class="ri-arrow-up-line align-middle"></i>
                                            </span>   </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-danger rounded-circle fs-2">
                                                <i data-feather="map-pin"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div> <!-- end row-->

                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Encargados</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                                data-target="{{ $entrenadores }}">0</span>
                                        </h2>
                                        <p class="mb-0 text-muted"><span class="badge bg-light text-info mb-0">
                                                <i class="ri-arrow-up-line align-middle"></i>
                                            </span> </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-warning rounded-circle fs-2">
                                                <i data-feather="user"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Inscritos</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                                data-target="{{$inscritos}}">0</span></h2>
                                        <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                                                <i class="ri-arrow-up-line align-middle"></i>
                                            </span> </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-success rounded-circle fs-2">
                                                <i data-feather="users"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div> <!-- end row-->
            </div>
        </div> <!-- end col-->

        <div class="col-xxl-7">
            <div class="row h-100">
                <div class="col-xl-6">

                    <div class="card">
                        <div class="card-header border-0">
                            <h4 class="card-title mb-0">Calendario</h4>
                        </div><!-- end cardheader -->
                        <div class="card-body pt-0">
                            <div class="upcoming-scheduled">
                                <input type="text" class="form-control" data-provider="flatpickr"
                                    data-date-format="d M, Y" data-deafult-date="today" data-inline-date="true">
                            </div>

                            <h6 class="text-uppercase fw-semibold mt-4 mb-3 text-muted">Eventos:</h6>
                            {{-- <div class="mini-stats-wid d-flex align-items-center mt-3">
                                <div class="flex-shrink-0 avatar-sm">
                                    <span
                                        class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-success fs-4">
                                        09
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Development planning</h6>
                                    <p class="text-muted mb-0">iTest Factory </p>
                                </div>
                                <div class="flex-shrink-0">
                                    <p class="text-muted mb-0">9:20 <span class="text-uppercase">am</span></p>
                                </div>
                            </div><!-- end --> --}}


                            <div class="mt-3 text-center">
                                <a href="javascript:void(0);" class="text-muted text-decoration-underline">Ver todos los eventos</a>
                            </div>

                        </div><!-- end cardbody -->
                    </div><!-- end card -->

                </div><!-- end col -->

                <div class="col-xl-6">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Inscritos Por Casas de Campaña</h4>

                        </div>
                        <div class="card-body p-0">
                            <div>
                                <div id="chartInscritosSucursal"
                                    data-colors='["--vz-primary", "--vz-primary", "--vz-info", "--vz-info", "--vz-danger", "--vz-primary", "--vz-primary", "--vz-warning", "--vz-primary", "--vz-primary"]'
                                    class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div> <!-- end col-->

            </div> <!-- end row-->
        </div><!-- end col -->
    </div> <!-- end row-->

    {{-- <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header border-0 align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Audiences Metrics</h4>
                    <div>
                        <button type="button" class="btn btn-soft-secondary btn-sm shadow-none">
                            ALL
                        </button>
                        <button type="button" class="btn btn-soft-secondary btn-sm shadow-none">
                            1M
                        </button>
                        <button type="button" class="btn btn-soft-secondary btn-sm shadow-none">
                            6M
                        </button>
                        <button type="button" class="btn btn-soft-primary btn-sm shadow-none">
                            1Y
                        </button>
                    </div>
                </div><!-- end card header -->
                <div class="card-header p-0 border-0 bg-soft-light">
                    <div class="row g-0 text-center">
                        <div class="col-6 col-sm-4">
                            <div class="p-3 border border-dashed border-start-0">
                                <h5 class="mb-1"><span class="counter-value" data-target="854">0</span>
                                    <span class="text-success ms-1 fs-12">49%<i
                                            class="ri-arrow-right-up-line ms-1 align-middle"></i></span>
                                </h5>
                                <p class="text-muted mb-0">Avg. Session</p>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-6 col-sm-4">
                            <div class="p-3 border border-dashed border-start-0">
                                <h5 class="mb-1"><span class="counter-value" data-target="1278">0</span>
                                    <span class="text-success ms-1 fs-12">60%<i
                                            class="ri-arrow-right-up-line ms-1 align-middle"></i></span>
                                </h5>
                                <p class="text-muted mb-0">Conversion Rate</p>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-6 col-sm-4">
                            <div class="p-3 border border-dashed border-start-0 border-end-0">
                                <h5 class="mb-1"><span class="counter-value" data-target="3">0</span>m
                                    <span class="counter-value" data-target="40">0</span>sec
                                    <span class="text-success ms-1 fs-12">37%<i
                                            class="ri-arrow-right-up-line ms-1 align-middle"></i></span>
                                </h5>
                                <p class="text-muted mb-0">Avg. Session Duration</p>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                </div><!-- end card header -->
                <div class="card-body p-0 pb-2">
                    <div>
                        <div id="audiences_metrics_charts" data-colors='["--vz-success", "--vz-gray-300"]'
                            class="apex-charts" dir="ltr"></div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-6">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Audiences Sessions by Country</h4>
                    <div class="flex-shrink-0">
                        <div class="dropdown card-header-dropdown">
                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="fw-semibold text-uppercase fs-12">Sort by: </span><span
                                    class="text-muted">Current Week<i class="mdi mdi-chevron-down ms-1"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Today</a>
                                <a class="dropdown-item" href="#">Last Week</a>
                                <a class="dropdown-item" href="#">Last Month</a>
                                <a class="dropdown-item" href="#">Current Year</a>
                            </div>
                        </div>
                    </div>
                </div><!-- end card header -->
                <div class="card-body p-0">
                    <div>
                        <div id="audiences-sessions-country-charts" data-colors='["--vz-success", "--vz-info"]'
                            class="apex-charts" dir="ltr">
                        </div>
                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div> --}}
@endsection



@extends('admin.layouts.base')

@section('css')
    <link href="/assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);"></a>Administración</li>
            <li class="breadcrumb-item active">Inicio </li>
        </ol>
    </div>
@endsection

@section('title')
    Inicio
@endsection

@section('js')
    <script src="/assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Vector map-->
    <script src="/assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="/assets/libs/jsvectormap/maps/world-merc.js"></script>

    <!-- Dashboard init -->
    <script src="/assets/js/pages/dashboard-analytics.init.js"></script>

    <script src="{{url("/admin/js/inicio.js")}}"></script>


    <!-- Sweet Alerts js -->
@endsection
