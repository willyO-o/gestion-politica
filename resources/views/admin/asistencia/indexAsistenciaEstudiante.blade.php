@section('content')
    <div class="row">

        <!--end col-->
        <div class="col-lg-12">
            <div class="card" id="contactList">
                <div class="card-header">
                    <div class="row py-2">

                        <div class="col-md-4 d-none">
                            <div class="search-box">
                                <input type="search" class="form-control"
                                    placeholder="Buscar Nro. Inscripción, nombre o C.I." id="inputBuscarPersona">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <select class="form-select" id="filtroGrupoEntrenamiento">
                                <option value="">Todos</option>

                            </select>
                        </div>


                        <div class="col-md-2">

                            <div class="input-group">
                                <input type="hidden" id="filtroMes" class=' form-control' type="text" value="{{date("d/m/Y")}}" />
                                <input id="selectorMes" class="form-control" type="text" value=""  readonly/>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger" id="btnGenerarPDF">
                                <i class=" bx bxs-file-pdf"></i>
                                PDF
                            </button>

                        </div>

                    </div>


                </div>
                <div class="card-body ">
                    <div>
                        <div class="table-responsive table-card  overflow-auto scroll-style" "
                            id="containerListaAsistencia">
                            <table class="table align-middle table-bordered border-dark table-sm  mb-0 text-center table-hover" id="tablaAsistencia">
                                <thead class="table-light  ">
                                    <tr>
                                        <th >Nombre </th>
                                        <th >Mes </th>

                                    </tr>
                                </thead>

                                <tr>
                                    <td colspan="100%" class="text-center py-4" id="loadingPersonal">
                                    </td>
                                </tr>
                            </table>


                        </div>

                    </div>



                    <!--end add modal-->


                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->

        <!--end col-->
    </div>
@endsection



@extends('admin.layouts.base')

@section('css')
    {{-- <link href="{{ url('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link rel="stylesheet" href="{{ url('/assets/libs/glightbox/css/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/croppie_2.6.5_croppie.min.css') }}">

    <link rel="stylesheet" href="{{ url('/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ url('/css/MonthPicker.min.css') }}">
    <style>
        .table-excel2 {
            background-color: #34a853d1 !important;
            color: white;


        }
    </style>
@endsection

@section('breadcrumb')
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);"></a>Inicio</li>
            <li class="breadcrumb-item active">Asistencia Actividades </li>
        </ol>
    </div>
@endsection

@section('title')
    Administración de Asistencia
@endsection

@section('js')

    <!-- list.js min js -->
    {{-- <script src="{{ url('assets/libs/list.js/list.min.js') }}"></script> --}}
    {{-- <script src="{{ url('assets/libs/list.pagination.js/list.pagination.min.js') }}"></script> --}}
    <script src="{{ url('/js/plugins/scrollpagination-container.js') }}"></script>

    <script src="{{ url('/assets/libs/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ url('/js/plugins/croppie_2.6.5_croppie.min.js') }}"></script>
    <script src="{{ url('/js/plugins/jquery-ui.js') }}"></script>


    <script src="{{ url('/js/plugins/MonthPicker.min.js') }}"></script>

    <script src="{{ url('/admin/js/asistencia/indexAsistenciaEstudiante.js') }}"></script>

    {{-- <script src="{{ url('/admin/js/inscripcion/indexInscripcion.js') }}"></script> --}}

    <!-- Sweet Alerts js -->
@endsection
