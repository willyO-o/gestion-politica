@section('content')
    <div class="row">

        <!--end col-->
        <div class="col-xxl-12">
            <div class="card" id="contactList">
                <div class="card-header">
                    <div class="row py-2  ">

                        <div class="col-xl-3 col-md-6">
                            <div class="search-box">
                                <input type="search" class="form-control" placeholder="Buscar bloque politico."
                                    id="inputBuscarGrupo">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="">

                                <select id="filtroSucursal" class="form-select"></select>

                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="">
                                <select id="filtroCategoria"  class="form-select"></select>
                            </div>
                        </div>



                        <div class="col-auto   ">
                            <button class="btn btn-outline-info add-btn"><i class="ri-add-fill me-1 align-bottom"></i>
                                Registrar Nuevo Bloque Politico
                            </button>
                        </div>
                    </div>

                    <div id="contadorListaGrupo"></div>

                </div>
                <div class="card-body ">
                    <div>
                        <div class="table-responsive table-card  overflow-auto scroll-style" style="height: 65vh;"
                            id="containerListaGrupo">
                            <table class="table align-middle table-wrap table-sm  mb-0" id="tablaGrupo">
                                <thead class="table-light sticky-top top-0 z-index-10 ">
                                    <tr>
                                        <th data-sort="nombre" scope="col">Nombre Bloque</th>
                                        <th data-sort="nombre" scope="col">Casa de campaña</th>
                                        <th data-sort="nombre" scope="col">Descripción Bloque</th>
                                        <th data-sort="ci" scope="col">Distrito</th>
                                        <th data-sort="celular" scope="col">Encargado</th>
                                        <th data-sort="tipoPersonal" scope="col">gestion </th>
                                        <th data-sort="celular" scope="col">fecha creación</th>
                                        <th data-sort="celular" scope="col">fecha finalización</th>

                                        <th scope="col">Estado</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="small" id="tbodyListaGrupo">

                                </tbody>
                                <tr>
                                    <td colspan="100%" class="text-center py-4" id="loadingGrupo">
                                    </td>
                                </tr>
                            </table>


                        </div>

                    </div>

                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->

        <!--end col-->
    </div>



    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="tituloModal" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false" data-bs-focus="false">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content border-0">
                <div class="modal-header bg-soft-info p-3">
                    <h5 class="modal-title" id="tituloModal">Registrar Bloque Politico</h5>
                    <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>

                <form class="tablelist-form" autocomplete="off" id="formGrupoEntrenamiento" novalidate action="#"
                    method="POST">

                    <div class="modal-body">

                        <input type="hidden" id="id_grupo_entrenamiento" value="" />
                        <input type="hidden" id="action" name="action" value="crear" />

                        <div class="row g-3">


                            <div class="col-lg-12">
                                <div>
                                    <label for="nombre_grupo" class="form-label">Nombre Bloque <small
                                            class="text-danger">*</small>
                                    </label>
                                    <input type="text" id="nombre_grupo" name="nombre_grupo"
                                        class="form-control txtNormal txtMayuscula " required placeholder="" />
                                    <div class="invalid-feedback">
                                        Por favor ingrese un nombre para el bloque político.
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-12">
                                <div>
                                    <label for="descripcion_grupo" class="form-label">Descripción del Bloque Politico
                                        <small class="text-danger">*</small>
                                    </label>
                                    <textarea type="text" id="descripcion_grupo" name="descripcion_grupo" class="form-control txtNormal  " required
                                        placeholder=""></textarea>
                                    <div class="invalid-feedback">
                                        Por favor ingrese una descripción para el bloque político.
                                    </div>
                                </div>

                            </div>



                            <div class="col-lg-6">
                                <div>
                                    <label for="id_categoria" class="form-label">Distrito <small
                                            class="text-danger">*</small>
                                    </label>
                                    <select type="text" id="id_categoria" name="id_categoria" class="form-control   "
                                        required placeholder=""></select>
                                    <div class="invalid-feedback">
                                        Por favor seleccione un distrito.
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label for="id_sucursal_fk" class="form-label">Casa de campaña <small
                                            class="text-danger">*</small>
                                    </label>
                                    <select type="text" id="id_sucursal_fk" name="id_sucursal_fk"
                                        class="form-control   " required placeholder=""></select>
                                    <div class="invalid-feedback">
                                        Por favor seleccione una casa de campaña.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label for="id_entrenador" class="form-label"> Encargado <small
                                            class="text-danger">*</small>
                                    </label>
                                    <select type="text" id="id_entrenador" name="id_entrenador"
                                        class="form-control   " required placeholder=""></select>
                                    <div class="invalid-feedback">
                                        Por favor seleccione un encargado.
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label for="id_gestion" class="form-label">Gestión <small
                                            class="text-danger">*</small>
                                    </label>
                                    <select type="text" id="id_gestion" name="id_gestion" class="form-control   "
                                        required placeholder="">
                                        @foreach ($gestiones as $gestion)
                                            <option value="{{ $gestion->id_gestion }}">{{ $gestion->gestion }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor seleccione una gestion.
                                    </div>
                                </div>
                            </div>

                            <hr>


                            <div class="col-lg-3">
                                <div>
                                    <label for="fecha_creacion" class="form-label">Fecha Creación <small
                                            class="text-danger">*</small> </label>
                                    <input type="date" id="fecha_creacion" name="fecha_creacion"
                                        class="form-control   " required placeholder="" />
                                    <div class="invalid-feedback">
                                        Por favor ingrese una fecha de creación.
                                    </div>
                                </div>

                            </div>


                            <div class="col-lg-3 d-none">
                                <div>
                                    <label for="fecha_fin" class="form-label">Fecha Fin</label>
                                    <input type="date" id="fecha_fin" name="fecha_fin" class="form-control  "
                                        placeholder="" />
                                </div>
                            </div>


                            <div class="col-lg-6 d-none">
                                <div>
                                    <label for="direccion_sucursal" class="form-label">Dias de entrenamiento <small
                                            class="text-danger">*</small> </label><br>
                                    @foreach ($dias as $dia)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox"
                                                id="check-dias-{{ $dia->id_dia }}" name="dias[]"
                                                value="{{ $dia->id_dia }}">

                                            <label class="form-check-label"
                                                for="check-dias-{{ $dia->id_dia }}">{{ $dia->nombre_dia }}</label>
                                        </div>
                                    @endforeach

                                    <div class="invalid-feedback">
                                        Por favor seleccione al menos un dia de entrenamiento.
                                    </div>

                                </div>
                            </div>


                            <div class="col-lg-3 d-none">
                                <div>
                                    <label for="hora_inicio" class="form-label"> Hora de Inicio <small
                                            class="text-danger">*</small> </label>
                                    <input type="time" id="hora_inicio" name="hora_inicio" class="form-control  "
                                        min="06:00" max="21:00"  />
                                    <small class="text-muted"> </small>

                                </div>
                            </div>

                            <div class="col-lg-3 d-none">
                                <div>
                                    <label for="hora_fin" class="form-label">Hora de Finalización <small
                                            class="text-danger">*</small> </label>

                                    <input type="time" id="hora_fin" name="hora_fin" class="form-control  "
                                        min="06:00" max="21:00"  />
                                    <small class="text-muted"></small>

                                </div>
                            </div>


                            <div class="col-lg-6 d-none">
                                <div>
                                    <label for="" class="form-label">Turno</label>


                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="turno" id="turno-maniana"
                                            value="MAÑANA" >
                                        <label class="form-check-label" for="turno-maniana">
                                            Mañana
                                        </label>
                                    </div>

                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="turno" id="turno-tarde"
                                            value="TARDE" >
                                        <label class="form-check-label" for="turno-tarde">
                                            Tarde
                                        </label>
                                        <div class="invalid-feedback">
                                            Por favor seleccione el turno al que pertenece el grupo de entrenamiento.
                                        </div>
                                    </div>

                                </div>


                            <div class="col-lg-6 d-none">
                                <div>
                                    <label for="" class="form-label">Dia Extra de Entrenamiento </label><br>
                                    @foreach ($dias as $dia)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"
                                                id="check-dia-extra-{{ $dia->id_dia }}" name="dia_extra[]"
                                                value="{{ $dia->id_dia }}">

                                            <label class="form-check-label"
                                                for="check-dia-extra-{{ $dia->id_dia }}">{{ $dia->nombre_dia }}</label>
                                        </div>
                                    @endforeach

                                    <div class="invalid-feedback">
                                        Por favor seleccione al menos un dia de entrenamiento.

                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-3 d-none">
                                <div>
                                    <label for="hora_inicio_dia_extra" class="form-label"> Hora de Inicio dia
                                        Extra</label>
                                    <input type="time" id="hora_inicio_dia_extra" name="hora_inicio_dia_extra"
                                        min="06:00" max="21:00" class="form-control  " />

                                        <div class="invalid-feedback">
                                            Por favor seleccione una hora entre las 6:00 y 21:00.
                                        </div>

                                    <small class="text-muted"> </small>

                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="modal-footer mt-3">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="reset" class="btn btn-light" data-bs-dismiss="modal"
                                id="cancel-btn">Cancelar</button>
                            <button type="submit" class="btn btn-success mdi" id="add-btn">Registrar
                                Grupo de Entrenamiento</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection



@extends('admin.layouts.base')

@section('css')
@endsection

@section('breadcrumb')
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);"></a>Inicio</li>
            <li class="breadcrumb-item active">Administrar Grupos de Entrenamiento </li>
        </ol>
    </div>
@endsection

@section('title')
    Administración de Grupos de Entrenamiento
@endsection

@section('js')
    <!-- list.js min js -->
    {{-- <script src="{{ url('assets/libs/list.js/list.min.js') }}"></script> --}}
    {{-- <script src="{{ url('assets/libs/list.pagination.js/list.pagination.min.js') }}"></script> --}}
    <script src="{{ url('/js/plugins/scrollpagination-container.js') }}"></script>

    <script src="{{ url('/admin/js/academia/indexGrupoEntrenamiento.js') }}"></script>

    <!-- Sweet Alerts js -->
@endsection
