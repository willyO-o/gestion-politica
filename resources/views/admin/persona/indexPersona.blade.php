@section('content')
    <div class="row">

        <!--end col-->
        <div class="col-xxl-9">
            <div class="card" id="contactList">
                <div class="card-header">
                    <div class="row py-2">

                        <div class="col-md-6">
                            <div class="search-box">
                                <input type="search" class="form-control" placeholder="Buscar Persona, nombre o C.I."
                                    id="inputBuscarPersona">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" id="filtroSelectTipoPersona">
                                <option value="">Todos</option>
                                @foreach ($tipoPersona as $tp)
                                    <option value="{{ $tp->id_tipo_persona }}">
                                        {{ $tp->tipo_persona }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-2">
                            <select class="form-select" id="filtroEstadoPersona">
                                <option value="">Todos</option>
                                @foreach ($estadoPersona as $estado)
                                    <option value="{{ $estado->estado_persona ?? 0 }}" >
                                        {{ $estado->estado_persona ?? 'SIN DEFINIR' }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-2  ">
                            <button class="btn btn-outline-info add-btn"><i class="ri-add-fill me-1 align-bottom"></i>
                                Registrar Persona
                            </button>
                        </div>
                    </div>

                    <div id="contadorListaPersonal"></div>

                </div>
                <div class="card-body ">
                    <div>
                        <div class="table-responsive table-card  overflow-auto scroll-style" style="height: 60vh;"
                            id="containerListaPersonal">
                            <table class="table align-middle table-wrap table-sm  mb-0" id="tablaPersona">
                                <thead class="table-light sticky-top top-0 z-index-10 ">
                                    <tr>
                                        <th data-sort="nombre" scope="col">Nombre</th>
                                        <th data-sort="ci" scope="col">C.I.</th>
                                        <th data-sort="celular" scope="col">Celular</th>
                                        {{-- <th data-sort="oficina" scope="col" class="break-word">Genero</th>
                                        <th data-sort="tipoPersonal" scope="col">Tipo </th>
                                        <th data-sort="tipoPersonal" scope="col">F. Nacimiento </th>
                                        <th data-sort="estado" scope="col">Estado</th> --}}
                                        <th data-sort="estado" scope="col">Foto</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="small" id="tbodyListaPersonal">

                                </tbody>
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
        <div class="col-xxl-3">
            <div class="card " id="detallePersona">
                <div class="card-body text-center">
                    <div class="position-relative d-inline-block">
                        <img src="{{ url('assets/images/users/user-dummy-img.jpg') }}" alt=""
                            class="avatar-lg rounded-circle img-thumbnail shadow">
                        <span class="contact-active position-absolute rounded-circle bg-success"><span
                                class="visually-hidden"></span>
                        </span>
                    </div>
                    <h5 class="mt-4 mb-1 ">Detalles de la Persona </h5>
                    <p class="text-muted">Tipo</p>

                    <ul class="list-inline mb-0">
                        <li class="list-inline-item avatar-xs">
                            <a href="javascript:void(0);" class="avatar-title bg-soft-success text-success fs-15 rounded"
                                disabled="">
                                <i class="ri-whatsapp-line"></i>

                            </a>
                        </li>
                        <li class="list-inline-item avatar-xs">
                            <a href="javascript:void(0);" class="avatar-title bg-soft-danger text-danger fs-15 rounded"
                                disabled>
                                <i class="ri-mail-line"></i>
                            </a>
                        </li>
                        <li class="list-inline-item avatar-xs">
                            <a href="javascript:void(0);" class="avatar-title bg-soft-info text-info fs-15 rounded"
                                disabled>
                                <i class="ri-phone-line"></i>

                            </a>
                        </li>

                    </ul>
                </div>
                <div class="card-body">
                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Información Personal </h6>
                    <p class="text-muted mb-4">Aqui se especifican los datos Personales.</p>
                    <div class="table-responsive table-card">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="fw-medium" scope="row">Nro. C.I.</td>
                                    <td>-------------------------- </td>
                                </tr>
                                <tr>
                                    <td class="fw-medium" scope="row">Celular</td>
                                    <td>-------------------------- </td>
                                </tr>
                                {{-- <tr>
                                    <td class="fw-medium" scope="row">Correo</td>
                                    <td>-------------------------- </td>
                                </tr>
                                <tr>
                                    <td class="fw-medium" scope="row">Genero</td>
                                    <td>-------------------------- </td>
                                </tr> --}}
                                {{-- <tr>
                                    <td class="fw-medium" scope="row">Fecha Nacimiento / Edad</td>
                                    <td>-------------------------- </td>
                                </tr>
                                <tr>
                                    <td class="fw-medium" scope="row">Dirección Domicilio</td>
                                    <td>-------------------------- </td>
                                </tr>
                                <tr>
                                    <td class="fw-medium" scope="row">Lugar de Nacimiento</td>
                                    <td>-------------------------- </td>
                                </tr> --}}
                                <tr>
                                    <td class="fw-medium" scope="row">Fecha de Registro</td>
                                    <td>--------------------------</td>
                                </tr>

                                <tr>
                                    <td class="fw-medium" scope="row">Estado Persona</td>
                                    <td>
                                        <span class="badge badge-soft-primary"> ---------------------<span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>



    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="tituloModal" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false" data-bs-focus="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header bg-soft-info p-3">
                    <h5 class="modal-title" id="tituloModal">Registrar Persona</h5>
                    <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form class="tablelist-form" autocomplete="off" id="formPersona" novalidate>

                    <div class="modal-body">



                        <input type="hidden" id="id_persona" value="" />
                        <input type="hidden" id="action" name="action" value="crear" />

                        <div class="row g-3">

                            <div class="col-lg-12">
                                <div class="text-center">
                                    <div class="position-relative d-inline-block">
                                        <div class="position-absolute  bottom-0 end-0">
                                            <label for="imagen" class="mb-0" data-bs-toggle="tooltip"
                                                data-bs-placement="right" title="Seleccionar Foto">
                                                <div class="avatar-xs cursor-pointer">
                                                    <div class="avatar-title bg-light border rounded-circle text-muted">
                                                        <i class="ri-image-fill"></i>
                                                    </div>
                                                </div>
                                            </label>
                                            <input class="form-control d-none" value="" id="imagen"
                                                type="file" accept="image/png, image/gif, image/jpeg">
                                        </div>
                                        <div class="position-relative  btn-clear-photo">
                                            <div class="position-absolute  top-0 end-0">
                                                <label for="" class="mb-0" data-bs-toggle="tooltip"
                                                    data-bs-placement="right" title="Quitar">
                                                    <div class="avatar-xs cursor-pointer">
                                                        <div
                                                            class="avatar-title bg-light border rounded-circle text-danger">
                                                            <i class=" ri-delete-bin-line"></i>
                                                        </div>
                                                    </div>
                                                </label>

                                            </div>
                                        </div>

                                        <div class="avatar-lg p-1">
                                            <div class="avatar-title bg-light rounded">
                                                <img src="/assets/images/users/user-dummy-img.jpg" id="previev"
                                                    class="avatar-md rounded object-cover" />
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="col-lg-4">
                                <div>
                                    <label for="numero_documento" class="form-label">Nro C.I.  <small
                                            class="text-danger">*</small>
                                    </label>
                                    <input type="text" id="numero_documento" name="numero_documento"
                                        class="form-control txtNormal sinEspacios" required placeholder="" />
                                    <small class="text-muted">(Nro. C.I. del Inscrito)</small>
                                    <div class="invalid-feedback">
                                        Por favor ingrese un numero de carnet de identidad.
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-8 d-none">
                                <div>
                                    <label for="apoderado" class="form-label">Nombre Completo del Apoderado <small
                                            class="text-muted">(opcional)</small> </label>
                                    <input type="text" id="apoderado" name="apoderado"
                                        class="form-control txtMayuscula" placeholder="" />
                                    <small class="text-muted">(Padre o Madre del inscrito)</small>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div>
                                    <label for="nombre" class="form-label">Nombre(s) de la Persona <small
                                            class="text-danger">*</small> </label>
                                    <input type="text" id="nombre" name="nombre"
                                        class="form-control txtMayuscula txtNormal" placeholder="" required />
                                    <div class="invalid-feedback">
                                        Por favor ingrese un nombre o nombres.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div>
                                    <label for="paterno" class="form-label">Apellido Paterno</label>
                                    <input type="text" id="paterno" name="paterno"
                                        class="form-control txtMayuscula txtNormal" placeholder="" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div>
                                    <label for="materno" class="form-label">Apellido Materno</label>
                                    <input type="text" id="materno" name="materno"
                                        class="form-control txtMayuscula txtNormal" placeholder="" />
                                </div>
                            </div>




                            <div class="col-lg-4 d-none" >
                                <div>
                                    <label for="genero" class="form-label">Genero</label>
                                    <div class="form-check form-radio-primary mb-0">
                                        <input class="form-check-input" type="radio" name="genero" value="MASCULINO" selected
                                            id="genero_m" >
                                        <label class="form-check-label" for="genero_m" >
                                            Masculino
                                        </label>
                                    </div>
                                    <div class="form-check form-radio-danger mb-1">
                                        <input class="form-check-input" type="radio" name="genero" value="FEMENINO"
                                            id="genero_f" required>
                                        <label class="form-check-label" for="genero_f">
                                            Femenino
                                        </label>
                                        <div class="invalid-feedback">
                                            Por favor seleccione un genero.
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-4 d-none">
                                <div>
                                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento <small
                                            class="text-danger">*</small> </label>

                                    <input type="date" class="form-select" id="fecha_nacimiento"
                                        name="fecha_nacimiento" required max="{{ date('Y-m-d') }}"
                                        min="{{ date('Y-m-d', strtotime('-80 year')) }}" />

                                    <div class="invalid-feedback">
                                        Por favor ingrese una fecha de nacimiento.
                                    </div>

                                </div>
                            </div>


                            <div class="col-lg-4">
                                <div>
                                    <label for="celular" class="form-label">Telefono/Celular</label>
                                    <input type="text" id="celular" name="celular"
                                        class="form-control max-length txtNumero" maxlength="8" placeholder="" />
                                </div>
                            </div>

                            <div class="col-lg-6 d-none">
                                <div>
                                    <label for="correo" class="form-label">Correo</label>
                                    <input type="email" id="correo" name="correo" class="form-control"
                                        placeholder="" />
                                </div>
                            </div>





                            <div class="col-lg-6 d-none">
                                <div>
                                    <label for="id_tipo_persona_fk" class="form-label">Tipo
                                        Militancia <small class="text-danger">*</small></label>

                                    <select class="form-select" id="id_tipo_persona_fk" name="id_tipo_persona_fk"
                                        required>
                                        <option value="">Seleccione el Tipo de Persona</option>
                                        @foreach ($tipoPersona as $tp)
                                            <option value="{{ $tp->id_tipo_persona }}" selected>
                                                {{ $tp->tipo_persona }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor Seleccione un Tipo de Persona.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 d-none">
                                <div>
                                    <label for="direccion" class="form-label">Dirección de Domicilio </label>

                                    <input type="text" class="form-control txtMayuscula txtDesc " id="direccion"
                                        name="direccion">

                                </div>
                            </div>
                            <div class="col-lg-6 d-none">
                                <div>
                                    <label for="lugar_nacimiento" class="form-label">Lugar de Nacimiento </label>

                                    <input class="form-control txtMayuscula txtDesc " id="lugar_nacimiento"
                                        name="lugar_nacimiento" list="listaLugarNacimiento">

                                    <datalist id="listaLugarNacimiento">

                                        <option value="LA PAZ - MURILLO - NUESTRA SEÑORA DE LA PAZ"></option>
                                        <option value="ARGENTINA -  BUENOS AIRES"> </option>
                                        <option value="ARGENTINA - BOLIVIANO POR PADRES "> </option>
                                        <option value="ARGENTINA BUENOS AIRES"> </option>
                                        <option value="ARGENTINA-CIUDAD AUTONOMA DE BUENOS AIRES"> </option>
                                        <option value="BRASIL - SAO PAULO - SP"> </option>
                                        <option value="COCHABAMBA - CERCADO - COCHABAMBA "> </option>
                                        <option value="LA PAZ"> </option>
                                        <option value="LA PAZ - CAMACHO - ALTO CHIJJINI"> </option>
                                        <option value="LA PAZ - CAMACHO - JANCO MARCA"> </option>
                                        <option value="LA PAZ - CAMACHO - TILACOCA"> </option>
                                        <option value="LA PAZ - CAMACHO - VILLA JICHANI"> </option>
                                        <option value="LA PAZ - CAMCHO - QUILIMA"> </option>
                                        <option value="LA PAZ - INGAVI - HUACULLANI"> </option>
                                        <option value="LA PAZ - INQUISIVI - COLQUIRI"> </option>
                                        <option value="LA PAZ - LARECAJA - AMAGUAYA"> </option>
                                        <option value="LA PAZ - LARECAJA - CHAPACA"> </option>
                                        <option value="LA PAZ - LOS ANDES - VIRUYO"> </option>
                                        <option value="LA PAZ - MURILLO - EL ALTO"> </option>
                                        <option value="LA PAZ - MURILLO - MUESTRA SEÑORA DE LA PAZ"> </option>
                                        <option value="LA PAZ - MURILLO - NUESTRA SEÑORA DE LA PAZ"> </option>
                                        <option value="LA PAZ - MURILLO - POMAMAYA "> </option>
                                        <option value="LA PAZ - MURILLO- EL ALTO"> </option>
                                        <option value="LA PAZ - OMASUYOS - ANCORAIMES"> </option>
                                        <option value="LA PAZ - OMASUYOS - MACAMACA"> </option>
                                        <option value="LA PAZ - OMASUYOS - PATAPATANI"> </option>
                                        <option value="LA PAZ - OMASUYOS - TACAMARA"> </option>
                                        <option value="LA PAZ - OMASUYOS - TINTAYA MACAMACA"> </option>
                                        <option value="LA PAZ - SUD YUNGAS - TOTORAPAMPA"> </option>
                                        <option value="LA PAZ MURILLO-EL ALTO"> </option>
                                        <option value="LA PAZ- SUD YUNGAS - LA ASUNTA"> </option>
                                        <option value="LA PAZ-MURILLO- NUESTRA SEÑORA DE LA PAZ"> </option>
                                        <option value="LAPAZ - BAUTISTA SAAVEDRA - CHACAHUAYA"> </option>
                                        <option value="LAZ PAZ - MURILLO - EL ALTO"> </option>
                                        <option value="ORURO - CERCADO - ORURO"> </option>
                                        <option value="POTOSI - TOMAS FRIAS - POTOSI"> </option>

                                    </datalist>
                                    <small class="text-muted">(Puede seleccionar o agregar opciones)</small>

                                </div>
                            </div>



                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="reset" class="btn btn-light" data-bs-dismiss="modal"
                                id="cancel-btn">Cancelar</button>
                            <button type="submit" class="btn btn-success mdi" id="add-btn">Registrar
                                Persona</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="modal fade" id="modalPhoto" tabindex="-1" aria-labelledby="t" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false" data-bs-focus="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header bg-soft-info p-3">
                    <h5 class="modal-title" id="titleUpdatePhoto">Actualizar Foto</h5>
                    <button type="reset" class="btn-close cancel-btn-photo" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>

                <div class="modal-body">



                    <input type="hidden" id="id_persona_photo" value="" />

                    <div class="row g-3">
                        <div class="col-md-10">
                            <div class="text-center">

                                <div class="input-group">
                                    <input type="file" class="form-control" id="imagenUpdate">
                                    <label class="input-group-text" for="imagenUpdate">Buscar</label>


                                </div>

                            </div>

                        </div>
                        <div class="col-md-2">
                            <div class="text-center">



                                <button class="input-group-text btn btn-primary" id="btnTomarFoto">
                                    <i class="ri-camera-fill align-bottom"></i>
                                    Tomar Foto</button>

                            </div>

                        </div>


                        <div class="col-12">
                            <div class="text-center">
                                <h5 class="text-muted">Vista Previa</h5>
                                <div class="position-relative d-inline-block">

                                    <div class="position-absolute  bottom-0 end-0">

                                    </div>

                                    <div id="cropieContainerUpdate" class="overflow-x-scroll">
                                        <div class="avatar-xl p-1">
                                            <div class="avatar-title bg-light rounded">
                                                <img src="/assets/images/users/user-dummy-img.jpg" id="previevUpdate"
                                                    class="avatar-lg rounded object-cover" />
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>





                    </div>
                    <div class="modal-footer mt-5 d-flex justify-content-center">
                        <div class="hstack gap-2  text-center">
                            <button type="button" class="btn btn-light text-danger cancel-btn-photo"
                                data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success mdi" id="btn-update-photo" disabled>
                                <i class="ri-save-fill me-1 align-bottom"></i>
                                Guardar
                                Foto</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--end row-->
    @endsection



    @extends('admin.layouts.base')

    @section('css')
        {{-- <link href="{{ url('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" /> --}}
        <link rel="stylesheet" href="{{ url('/assets/libs/glightbox/css/glightbox.min.css') }}">
        <link rel="stylesheet" href="{{ url('/css/croppie_2.6.5_croppie.min.css') }}">
    @endsection

    @section('breadcrumb')
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);"></a>Inicio</li>
                <li class="breadcrumb-item active">Administrar Personas </li>
            </ol>
        </div>
    @endsection

    @section('title')
        Administración de Personas
    @endsection

    @section('js')
        <!-- list.js min js -->
        {{-- <script src="{{ url('assets/libs/list.js/list.min.js') }}"></script> --}}
        {{-- <script src="{{ url('assets/libs/list.pagination.js/list.pagination.min.js') }}"></script> --}}
        <script src="{{ url('/js/plugins/scrollpagination-container.js') }}"></script>

        <script src="{{ url('/assets/libs/glightbox/js/glightbox.min.js') }}"></script>
        <script src="{{ url('/js/plugins/croppie_2.6.5_croppie.min.js') }}"></script>

        <script src="{{ url('/admin/js/persona/indexPersona.js') }}"></script>

        <!-- Sweet Alerts js -->
    @endsection
