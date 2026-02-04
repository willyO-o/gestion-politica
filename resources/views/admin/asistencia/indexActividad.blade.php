@section('content')
    <div class="row">

        <div class="col-lg-4 mx-auto">

            <div class="text-center mt-2">
                <button class="btn btn-primary" id="btnRegistrarAsistencia">
                    <i class="mdi mdi-plus"></i>
                    Registrar Nueva Actividad
                </button>
            </div>
        </div>

    </div>


    <div class="row mt-3">

        <div class="col-md-12">


            <div class="card">
                <div class="card-header row">
                    <div class="col-9">
                        <input type="search" class="form-control" id="buscarAsistencia"
                            placeholder="Buscar por actividad o descripción"
                            aria-label="Buscar por nombre o celular" aria-describedby="button-addon2">
                    </div>
                    <div class="col-auto">
                        <div id="reportrange"
                            style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                            <i class="mdi mdi-calendar"></i>&nbsp;
                            <span></span> <i class="fa fa-caret-down"></i>
                        </div>
                    </div>

                </div>
                <div class="card-body ">
                    <div>

                        <div class="table-responsive table-card  overflow-auto scroll-style" style="height: 65vh;"
                            id="containerListaActividad">
                            <table class="table align-middle table-wrap table-sm  mb-0" id="tablaActividad">
                                <thead class="table-light sticky-top top-0 z-index-10 ">
                                    <tr>
                                        <th data-sort="nombre" scope="col">Actividad</th>
                                        <th data-sort="nombre" scope="col">Fecha</th>
                                        <th data-sort="permiso" scope="col">Descripcion</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="small" id="tbodyActividad">

                                </tbody>
                                <tr>
                                    <td colspan="100%" class="text-center py-4" id="loadingActividad">
                                    </td>
                                </tr>
                            </table>


                        </div>

                    </div>




                </div>
            </div>


        </div>
    </div>

    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="tituloModal" data-bs-backdrop="static"
        data-bs-keyboard="false" data-bs-focus="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">

            </div>
        </div>
    </div>
@endsection



@extends('admin.layouts.base')

@section('css')
    {{-- <link href="{{ url('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link rel="stylesheet" href="{{ url('/assets/libs/glightbox/css/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/croppie_2.6.5_croppie.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ url('/css/daterangepicker.css') }}">
@endsection

@section('breadcrumb')
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);"></a>Inicio</li>
            <li class="breadcrumb-item active">Actividades  </li>
        </ol>
    </div>
@endsection

@section('title')
    Administración de Actividades
@endsection

@section('js')
    {{-- <script src="{{ url('/assets/js/pages/qrCode.min.js') }}"></script> --}}

    {{-- <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script> --}}
    <script src="{{ url('/assets/libs/moment/moment.js') }}"></script>
    <script src="{{ url('/js/plugins/daterangepicker.min.js') }}"></script>

    {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> --}}


    <script src="{{ url('/js/plugins/select2.min.js') }}"></script>
    <script src="{{ url('/js/plugins/html5-qrcode.min.js') }}"></script>
    <!-- list.js min js -->
    {{-- <script src="{{ url('assets/libs/list.js/list.min.js') }}"></script> --}}
    {{-- <script src="{{ url('assets/libs/list.pagination.js/list.pagination.min.js') }}"></script> --}}
    <script src="{{ url('/js/plugins/scrollpagination-container.js') }}"></script>


    <script src="{{ url('/assets/libs/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ url('/js/plugins/croppie_2.6.5_croppie.min.js') }}"></script>

    <script src="{{ url('/admin/js/asistencia/indexActividad.js?v='.config('app.constants.version') ) }}"></script>

    <!-- Sweet Alerts js -->
@endsection
