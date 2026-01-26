@section('content')
    <div class="row">

        <div class="col-lg-4 mx-auto">
            <div id="reader" width="600px"></div>

            <div class="text-center  badge-soft-primary mt-2" id="caja-reloj">
                <span class="h3 text-primary">
                    <i class="mdi mdi-clock-time-four-outline"></i>
                </span>
                <span class="h3  text-primary reloj" id="reloj" class="text-primary"></span>
            </div>
            <div class="text-center mt-2">
                <button class="btn btn-primary" id="btnRegistrarAsistencia">
                    <i class="mdi mdi-plus"></i>
                    Registrar Nueva Asistencia
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
                            placeholder="Buscar por inscripcion, nombre o C.I.  de militante"
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
                            id="containerListaAsistencia">
                            <table class="table align-middle table-wrap table-sm  mb-0" id="tablaAsistencia">
                                <thead class="table-light sticky-top top-0 z-index-10 ">
                                    <tr>
                                        <th data-sort="nombre" scope="col">Nro. <br> Inscripción</th>
                                        <th data-sort="nombre" scope="col">Militante</th>
                                        <th data-sort="celular" scope="col">Fecha Asistencia</th>
                                        <th data-sort="tipoPersonal" scope="col"> Entrada</th>
                                        <th data-sort="tipoPersonal" scope="col"> Salida </th>
                                        <th data-sort="estado" scope="col">Bloque Politico</th>
                                        <th data-sort="sucursal" scope="col">Casa de Campaña</th>
                                        <th data-sort="oficina" scope="col" class="break-word">Observación</th>
                                        <th data-sort="permiso" scope="col">Permiso</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="small" id="tbodyListaAsistencia">

                                </tbody>
                                <tr>
                                    <td colspan="100%" class="text-center py-4" id="loadingAsistencia">
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
                <div class="modal-header bg-soft-info p-3">

                    <h5 class="modal-title" id="tituloModal">Registrar Asistencia/Permiso</h5>

                    <button type="reset" class="btn-close cancel-btn" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form class="tablelist-form" autocomplete="off" id="formAsistencia" novalidate>

                    <div class="modal-body">

                        <input type="hidden" id="id_asistencia" value="" />
                        <input type="hidden" id="action" name="action" value="crear" />
                        <input type="hidden" id="id_grupo_entrenamiento_fk" name="id_grupo_entrenamiento_fk"
                            value="" />

                        <div class="row g-3">


                            <div class="col-lg-12">
                                <div>
                                    <label for="id_inscripcion_fk" class="form-label">Numero de Inscripción <small
                                            class="text-danger">*</small>
                                    </label>
                                    <select name="id_inscripcion_fk" id="nroInscripcion" required></select>

                                    <div class="invalid-feedback">
                                        Por favor ingrese un numero de inscripcion
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-12" id="caja-dias-entrenamiento" style="display: none">
                                <h4>Dias de Entrenamiento : <span></span></h4>
                            </div>


                            <div class="col-lg-6">

                                <div>
                                    <label for="permiso" class="form-label">Tipo <small class="text-danger">*</small>
                                    </label>
                                    <select name="permiso" id="permiso" class="form-select">
                                        <option value="0">Asistencia</option>
                                        <option value="1">Permiso</option>
                                    </select>

                                </div>

                            </div>


                            <div class="col-lg-6">

                                <div>
                                    <label for="fecha_asistencia" class="form-label">Fecha <small
                                            class="text-danger">*</small>
                                    </label>
                                    <input type="date" id="fecha_asistencia" name="fecha_asistencia"
                                        class="form-control txtNormal txtMayuscula " required value="{{ date('Y-m-d') }}"
                                        min="{{ date('2021-01-01') }}" max="{{ date('Y-m-d') }}" />
                                    <div class="invalid-feedback">
                                        Por favor ingrese una fecha para la asistencia o permiso.
                                    </div>
                                </div>

                            </div>
                        </div>


                        <fieldset class="row g-3" id="caja-horas">

                            <div class="col-lg-6">
                                <div>
                                    <label for="ingreso" class="form-label">Hora Ingreso <small
                                            class="text-danger">*</small>
                                    </label>
                                    <input type="time" id="ingreso" name="ingreso" class="form-control txtNormal "
                                        required />
                                    <div class="invalid-feedback">
                                        Por favor ingrese la hora de ingreso.
                                    </div>
                                </div>

                            </div>


                            <div class="col-lg-6">
                                <div>
                                    <label for="salida" class="form-label">Hora Salida <small
                                            class="text-danger">*</small>
                                    </label>
                                    <input type="time" id="salida" name="salida" class="form-control txtNormal "
                                        min="06:00:00" max="22:00:00" required placeholder="" />
                                    <div class="invalid-feedback">
                                        Por favor ingrese la hora de salida.
                                    </div>
                                </div>

                            </div>
                        </fieldset>



                        <div class="row g-3" id="caja-detalles" style="display: none">

                            <div class="col-lg-12">
                                <div>
                                    <label for="observacion" class="form-label">Detalle <small>(opcional)</small> </label>
                                    <textarea type="text" id="observacion" name="observacion" class="form-control txtNormal" placeholder=""></textarea>
                                    <small class="text-muted">(Motivo del Permiso o Justificacion)</small>

                                    <div class="invalid-feedback">
                                        Por favor ingrese una descripción para la categoria.
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="reset" class="btn btn-light cancel-btn"
                                data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success mdi" id="add-btn">

                                Registrar Asistencia </button>

                        </div>
                    </div>
                </form>
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
            <li class="breadcrumb-item active">Asistencia  </li>
        </ol>
    </div>
@endsection

@section('title')
    Administración de Asistencia
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

    <script src="{{ url('/admin/js/asistencia/indexMarcadoAsistencias.js?v='.config('app.constants.version') ) }}"></script>

    <!-- Sweet Alerts js -->
@endsection
