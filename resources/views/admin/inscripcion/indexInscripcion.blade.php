
@section('content')
    <div class="row">

        <!--end col-->
        <div class="col-lg-12">
            <div class="card" id="contactList">
                <div class="card-header">
                    <div class="row py-2 justify-content-between">

                        <div class="col-md-6">
                            <div class="search-box">
                                <input type="search" class="form-control" placeholder="Buscar Nro. Inscripción, nombre o C.I."
                                    id="inputBuscarPersona">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        {{-- <div class="col-md-2">
                            <select class="form-select" id="filtroSelectTipoPersona">
                                <option value="">Todos</option>
                                @foreach ($tipoPersona as $tp)
                                    <option value="{{ $tp->id_tipo_persona }}">
                                        {{ $tp->tipo_persona }}</option>
                                @endforeach
                            </select>
                        </div> --}}


                        <div class="col-md-3">
                            <select class="form-select" id="filtroEstadoPersona">
                                <option value="">Estado (Todos)</option>
                                @foreach ($estadoPersona as $estado)
                                    <option value="{{ $estado->estado_inscripcion ?? 0 }}">
                                        {{ $estado->estado_inscripcion ?? 'SIN DEFINIR' }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-auto  ">
                            <button class="btn btn-primary add-btn w-100"><i class="ri-add-fill me-1 align-bottom"></i>
                                Registrar Militancia
                            </button>
                        </div>
                    </div>

                    <div id="contadorListaPersonal"></div>

                </div>
                <div class="card-body ">
                    <div>
                        <div class="table-responsive table-card  overflow-auto scroll-style" style="height: 65vh;"
                            id="containerListaInscripcion">
                            <table class="table align-middle table-hover table-wrap table-sm  mb-0" id="tablaInscripcion">
                                <thead class="table-light sticky-top top-0 z-index-10 ">
                                    <tr>
                                        <th data-sort="nombre" scope="col">Nro. <br> Inscripción</th>
                                        <th data-sort="nombre" scope="col">Datos del Militante</th>
                                        <th data-sort="celular" scope="col">Fecha Inicio/Fin</th>
                                        <th data-sort="oficina" scope="col" class="break-word">Observación</th>
                                        <th data-sort="tipoPersonal" scope="col"> Estado <br>Inscripción </th>
                                        <th data-sort="estado" scope="col">Bloque Politico</th>
                                        <th data-sort="estado" scope="col">Casa de Campaña</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="small" id="tbodyListaInscripcion">

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

        <!--end col-->
    </div>



    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="tituloModal" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false" data-bs-focus="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header bg-soft-info p-3">
                    <h5 class="modal-title" id="tituloModal">Registrar Militancia</h5>
                    <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form class="tablelist-form" autocomplete="off" id="formInscripcion" novalidate>

                    <div class="modal-body">

                        <ul class="nav nav-tabs nav-justified nav-border-top nav-border-top-success mb-3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#tab-inscripcion" role="tab"
                                    id="btn-tab-inscripcion" aria-selected="false">
                                    <i class=" ri-survey-line me-1 align-middle"></i>

                                    Inscripción
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tab-persona" role="tab"
                                    id="btn-tab-persona" style="display: none;" aria-selected="false">
                                    <i class="ri-user-line me-1 align-middle"></i>
                                    Nueva Persona
                                    <span class="badge bg-danger tr-active " id="errorSpan">Datos Inválidos</span>
                                </a>
                            </li>

                        </ul>
                        <div class="tab-content text-muted">
                            <div class="tab-pane active" id="tab-inscripcion" role="tabpanel">
                                <h4 class="text-center">Datos de Inscripción</h4>
                                <div class="row g-3">
                                    <input type="hidden" id="action" value="crear" />
                                    <input type="hidden" id="id_inscripcion" value="" />

                                    <div class="col-lg-6">
                                        <div class="choice-mb-none ">
                                            <label for="id_persona_inscribir" class="form-label">Militante <small
                                                    class="text-danger">*</small> </label>

                                            <select name="id_persona" id="id_persona_inscribir" required></select>


                                            <div class="form-check mt-2" id="containerCheckNuevaPersona">
                                                <input class="form-check-input" type="checkbox" id="checkNuevaPersona"
                                                    name="nueva_persona">
                                                <label class="form-check-label" for="checkNuevaPersona">
                                                    Registrar Nuevo Militante
                                                </label>
                                                <i class="ri-question-line text-muted align-bottom"
                                                    data-bs-toggle="tooltip" data-bs-placement="right"
                                                    title="Si la persona no se encuentra en la lista,
                                                    Se le habilitara un formulario para registrar una nueva persona."></i>
                                            </div>

                                            <div class="invalid-feedback">Por favor seleccione una Persona</div>
                                        </div>

                                    </div>

                                    <div class="col-lg-6">
                                        <div class="choice-mb-none ">
                                            <label for="id_sucursal_fk" class="form-label">Casa de Campaña <small
                                                    class="text-danger">*</small> </label>

                                            <select name="id_sucursal_fk" id="id_sucursal_fk" required></select>

                                            <div class="invalid-feedback">Por favor seleccione una Casa de Campaña</div>
                                        </div>

                                    </div>
                                    <div class="col-lg-12">
                                        <div>
                                            <label for="id_grupo_entrenamiento" class="form-label">Bloque de Militancia
                                                <small class="text-danger">*</small> </label>

                                            <select name="id_grupo_entrenamiento" class="form-select"
                                                id="id_grupo_entrenamiento" required>
                                                <option value="">Seleccione una Casa de Campaña para continuar...</option>
                                            </select>

                                            <div class="invalid-feedback">Por favor seleccione un Bloque de Militancia
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-lg-6 d-none">
                                        <div>
                                            <label for="tipo_inscripcion" class="form-label">Tipo de
                                                Militancia <small class="text-danger">*</small></label>

                                            <select class="form-select" id="tipo_inscripcion" name="tipo_inscripcion"
                                                required>
                                                <option value="DIRIGENCIA"> Dirigencia </option>
                                                <option value="CUADRO_TECNICO">Cuadro Técnico</option>
                                                <option value="ENCARGADO">Encargado</option>
                                                <option value="SIMPATIZANTE" selected>Simpatizante</option>

                                            </select>
                                            <div class="invalid-feedback">
                                                Por favor Seleccione un Tipo de Militancia.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 d-none">
                                        <div>
                                            <label for="monto_inscripcion" class="form-label">Aporte Inicial
                                                (Bs.)</label>
                                            <input type="text" id="monto_inscripcion" name="monto_inscripcion"
                                                class="form-control max-length txtDecimal" maxlength="8" value="0"
                                                placeholder=" Bs." />
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div>
                                            <label for="fecha_inicio" class="form-label">Fecha de Afiliación <small
                                                    class="text-danger">*</small> </label>

                                            <input type="date" class="form-control" id="fecha_inicio"
                                                name="fecha_inicio" required value="{{ date('Y-m-d') }}"
                                                max="{{ date('Y-m-d', strtotime('+1 year')) }}"
                                                min="2022-01-01" />

                                            <div class="invalid-feedback">
                                                Por favor ingrese una fecha de afiliación.
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4 d-none">
                                        <div>
                                            <label for="fecha_fin" class="form-label">Fecha de Finalización <small
                                                    class="text-danger">*</small> </label>

                                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin"
                                                max="{{ date('Y-m-d', strtotime('+2 year')) }}" />

                                            <div class="invalid-feedback">
                                                Por favor ingrese una fecha de finalización.
                                            </div>

                                        </div>
                                    </div>



                                    <div class="col-lg-6 d-none">
                                        <div>
                                            <label for="" class="form-label">Estado Inscripción <small
                                                    class="text-danger">*</small> </label>
                                            <div class="form-check form-radio-primary mb-0">
                                                <input class="form-check-input" type="radio" name="estado_inscripcion"
                                                    value="INSCRITO" id="estado_ins" required checked>
                                                <label class="form-check-label" for="estado_ins">
                                                    Inscrito
                                                </label>
                                            </div>
                                            <div class="form-check form-radio-warning mb-1">
                                                <input class="form-check-input" type="radio" name="estado_inscripcion"
                                                    value="PENDIENTE" id="estado_pen" required>
                                                <label class="form-check-label" for="estado_pen">
                                                    Pendiente
                                                </label>

                                            </div>
                                            <div class="form-check form-radio-danger mb-1">
                                                <input class="form-check-input" type="radio" name="estado_inscripcion"
                                                    value="RETIRADO" id="estado_ret" required>
                                                <label class="form-check-label" for="estado_ret">
                                                    Retirado
                                                </label>

                                            </div>


                                        </div>
                                    </div>






                                    <div class="col-lg-12 d-none">
                                        <div>
                                            <label for="descripcion" class="form-label">Descripción </label>

                                            <input type="text" class="form-control  txtDesc " id="descripcion"
                                                name="descripcion">

                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div>
                                            <label for="observacion" class="form-label">Observación </label>

                                            <input type="text" class="form-control  txtDesc " id="observacion"
                                                name="observacion">

                                        </div>
                                    </div>




                                </div>
                            </div>
                            <div class="tab-pane" id="tab-persona" role="tabpanel">
                                <h4 class="text-center">Datos del Inscrito</h4>

                                <fieldset disabled id="fieldSetPersona">


                                    <div class="row g-3">

                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <div class="position-relative d-inline-block">
                                                    <div class="position-absolute  bottom-0 end-0">
                                                        <label for="imagen" class="mb-0" data-bs-toggle="tooltip"
                                                            data-bs-placement="right" title="Seleccionar Foto">
                                                            <div class="avatar-xs cursor-pointer">
                                                                <div
                                                                    class="avatar-title bg-light border rounded-circle text-muted">
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
                                                            <img src="/assets/images/users/user-dummy-img.jpg"
                                                                id="previev" class="avatar-md rounded object-cover" />
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-4">
                                            <div>
                                                <label for="numero_documento" class="form-label">Nro C.I. del Militante
                                                    <small class="text-danger">*</small>
                                                </label>
                                                <input type="text" id="numero_documento" name="numero_documento"
                                                    class="form-control txtNormal sinEspacios" required placeholder="" />
                                                <small class="text-muted">(Nro. C.I. del Militante)</small>
                                                <div class="invalid-feedback">
                                                    Por favor ingrese un numero de carnet de identidad.
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-lg-8 d-none">
                                            <div>
                                                <label for="apoderado" class="form-label">Nombre Completo del Apoderado
                                                    <small class="text-muted">(opcional)</small> </label>
                                                <input type="text" id="apoderado" name="apoderado"
                                                    class="form-control txtMayuscula" placeholder="" />
                                                <small class="text-muted">(Padre o Madre del inscrito)</small>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div>
                                                <label for="nombre" class="form-label">Nombre(s) del Militante <small
                                                        class="text-danger">*</small> </label>
                                                <input type="text" id="nombre" name="nombre"
                                                    class="form-control txtMayuscula txtNormal" placeholder="" required />
                                                <div class="invalid-feedback">
                                                    Por favor ingrese un nombre .
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




                                        <div class="col-lg-4 d-none">
                                            <div>
                                                <label for="genero" class="form-label">Genero</label>
                                                <div class="form-check form-radio-primary mb-0">
                                                    <input class="form-check-input" type="radio" name="genero"
                                                        value="MASCULINO" id="genero_m" required checked>
                                                    <label class="form-check-label" for="genero_m">
                                                        Masculino
                                                    </label>
                                                </div>
                                                <div class="form-check form-radio-danger mb-1">
                                                    <input class="form-check-input" type="radio" name="genero"
                                                        value="FEMENINO" id="genero_f" required>
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
                                                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento
                                                    <small class="text-danger">*</small> </label>

                                                <input type="date" class="form-control" id="fecha_nacimiento"
                                                    name="fecha_nacimiento"
                                                    max="{{ date('Y-m-d', strtotime('-3 year')) }}"
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
                                                    class="form-control max-length txtNumero" maxlength="8"
                                                    placeholder="" />
                                            </div>
                                        </div>

                                        <div class="col-lg-4 d-none">
                                            <div>
                                                <label for="correo" class="form-label">Correo</label>
                                                <input type="email" id="correo" name="correo" class="form-control"
                                                    placeholder="" />
                                            </div>
                                        </div>




                                        <div class="col-lg-4 d-none">
                                            <div>
                                                <label for="estado_persona" class="form-label">Estado de
                                                    Inscripción</label>
                                                <div class="form-check form-radio-primary mb-0">
                                                    <input class="form-check-input" type="radio" name="estado_persona"
                                                        value="INSCRITO" id="estado_persona_inscrito" required checked>
                                                    <label class="form-check-label" for="estado_persona_inscrito">
                                                        Inscrito
                                                    </label>
                                                </div>
                                                <div class="form-check form-radio-danger mb-1">
                                                    <input class="form-check-input" type="radio" name="estado_persona"
                                                        value="PENDIENTE" id="estado_persona_pendiente" required>
                                                    <label class="form-check-label" for="estado_persona_pendiente">
                                                        Pendiente
                                                    </label>
                                                    <div class="invalid-feedback">
                                                        Por favor seleccione un estado.
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                        <div class="col-lg-4 d-none">
                                            <div>
                                                <label for="id_tipo_persona_fk" class="form-label">Tipo
                                                    Militancia <small class="text-danger">*</small></label>

                                                <select class="form-select" id="id_tipo_persona_fk"
                                                    name="id_tipo_persona_fk" required>
                                                    <option value="">Seleccione el Tipo de Militancia</option>
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
                                        <div class="col-lg-12 d-none">
                                            <div>
                                                <label for="direccion" class="form-label">Dirección de Domicilio </label>

                                                <input type="text" class="form-control txtMayuscula txtDesc "
                                                    id="direccion" name="direccion">

                                            </div>
                                        </div>
                                        <div class="col-lg-6 d-none">
                                            <div>
                                                <label for="lugar_nacimiento" class="form-label">Lugar de Nacimiento
                                                </label>

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
                                </fieldset>

                            </div>

                        </div>

                    </div>
                    <div class="modal-footer mt-4">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="reset" class="btn btn-light" data-bs-dismiss="modal"
                                id="cancel-btn">Cancelar</button>
                            <button type="submit" class="btn btn-success mdi" id="add-btn">Registrar
                                Inscripción</button>

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

    </div>

    <div class="modal fade" id="modalDetalle" tabindex="-1" aria-labelledby="t" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false" data-bs-focus="false">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-xl">
            <div class="modal-content border-0">
                <div class="modal-header bg-soft-info p-3">
                    <h5 class="modal-title" id="titleUpdatePhoto">Detalles Inscripcion</h5>
                    <button type="button" class="btn-close cancel-btn-photo" data-bs-dismiss="modal" aria-label="Close"
                        id=""></button>
                </div>

                <div class="modal-body" id="detallePersona">


                </div>
                <div class="modal-footer mt-1 d-flex justify-content-center">
                    <div class="hstack gap-2  text-center">
                        <button type="button" class="btn btn-light text-danger " data-bs-dismiss="modal">Cerrar</button>

                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="modal fade" id="modalPagos" tabindex="-1" aria-labelledby="t" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false" data-bs-focus="false">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-xl">
            <div class="modal-content border-0">
                <div class="modal-header bg-soft-secondary p-3">
                    <h5 class="modal-title" >Datos de Aporte Nro.: <span id="tituloModalPago" class="text-danger"></span></h5>
                    <button type="button" class="btn-close cancel-btn-photo" data-bs-dismiss="modal" aria-label="Close"
                        id="btn-cancel-pay-x"></button>
                </div>

                <div class="modal-body bg-light mb-0 pb-0" id="listadoPagos">

                    <div class="card ">
                        <form id="formPagos" action="#" novalidate method="POST" onkeydown="return event.key != 'Enter';">
                            <input type="hidden" id="id_inscripcion_pago" name="id_inscripcion" value="" />
                            <input type="hidden" id="id_pago_mes_gestion"  value="" />
                            <input type="hidden" id="actionPago"  value="registrar" />

                            <div class="card-body">
                                <h4 class="card-title text-center" id="actionTitlePago">Registrar Aporte</h4>
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <label for="datosInscripcionPago" class="form-label">Datos de aporte</label>
                                        <div type="text" class="form-control form-control-sm bg-light" id="datosInscripcionPago"  disabled ></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-lg-3">
                                        <div class="choice-mb-none ">
                                            <label for="id_gestion" class="form-label">Gestión <small
                                                    class="text-danger">*</small> </label>

                                            <select name="id_gestion" id="id_gestion" class="form-select form-select-sm"
                                                required>
                                                @foreach ($gestiones as $gestion)

                                                        <option value="{{ $gestion->id_gestion }}" >
                                                            {{ $gestion->gestion }} </option>

                                                @endforeach

                                            </select>

                                            <div class="invalid-feedback">Por favor seleccione una Gestión</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-3">
                                        <div>
                                            <label for="fecha_pago" class="form-label">Fecha de Aporte <small
                                                    class="text-danger">*</small> </label>

                                            <input type="date" class="form-control form-control-sm" id="fecha_pago"
                                                name="fecha_pago" required max="{{ date('Y-m-d') }}"
                                                value="{{ date('Y-m-d') }}" />

                                            <div class="invalid-feedback">
                                                Por favor ingrese la fecha que se realizo el pago.
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-3 d-none">
                                        <div>
                                            <label for="id_mes_fk" class="form-label">Mes del Pago
                                                <small class="text-danger">*</small></label>

                                            <select class="form-select form-select-sm" id="id_mes_fk" name="id_mes_fk"
                                                required>

                                                <option value="">Seleccione</option>
                                                @foreach ($meses as $mes)
                                                    <option value="{{ $mes->id_mes }}">
                                                        {{ $mes->mes }}</option>
                                                @endforeach

                                            </select>
                                            <div class="invalid-feedback">
                                                Por favor Seleccione un Mes.
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-4 col-lg-3">
                                        <div class="mt-1">
                                            <label for="monto" class="form-label">Monto
                                                (Bs.)</label>
                                            <input type="text" id="monto" name="monto"
                                                class="form-control form-control-sm max-length txtDecimal" maxlength="8" required
                                                placeholder=" Bs." />
                                                <div class="invalid-feedback">
                                                    Por favor ingrese el monto de la mensualidad, minimo 0 Bs.
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-3 d-none">
                                        <div class="mt-1">
                                            <label for="saldo" class="form-label">Saldo
                                                (Bs.)</label>
                                            <input type="text" id="saldo" name="saldo"
                                                class="form-control form-control-sm max-length txtDecimal" maxlength="8"
                                                placeholder=" Bs." />
                                        </div>
                                    </div>



                                    <div class="col-md-4 col-lg-3">
                                        <div class="mt-1">
                                            <label for="" class="form-label">Estado del aporte <small
                                                    class="text-danger">*</small> </label>
                                            <div class="form-check form-radio-primary mb-0">
                                                <input class="form-check-input" type="radio" name="estado_pago"
                                                    value="COMPLETADO" id="estado_pago_completo" required>
                                                <label class="form-check-label" for="estado_pago_completo">
                                                    Completado
                                                </label>
                                            </div>
                                            <div class="form-check form-radio-warning mb-1">
                                                <input class="form-check-input" type="radio" name="estado_pago"
                                                    value="PENDIENTE" id="estado_pago_pendiente" required>
                                                <label class="form-check-label" for="estado_pago_pendiente">
                                                    Pendiente
                                                </label>
                                                <div class="invalid-feedback">Por favor seleccione un Estado</div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div>
                                            <label for="observacion_pago" class="form-label">Observación <small
                                                    class="text-muted">(opcional)</small> </label>

                                            <input type="text" class="form-control  form-control-sm txtDesc "
                                                id="observacion_pago" name="observacion_pago">

                                        </div>
                                    </div>

                                </div>
                                <div class="row mt-2">
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between">

                                            <button type="submit" class="btn btn-danger btn-sm mdi" id="btn-cancel-pago">
                                                <i class="ri-close-fill me-1 align-bottom"></i>
                                                <span class=""> Cancelar Registro </span>
                                            </button>


                                            <button type="submit" class="btn btn-secondary btn-sm mdi" id="btn-add-pago">
                                                <i class="ri-save-fill me-1 align-bottom"></i>
                                                <span class=""> Registrar Aporte </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card mb-1">
                        <div class="card-header border border-top">
                            <form action="#" method="get" id="formGenerarPdfPagos" target="popupWindow"  onkeydown="return event.key != 'Enter';" >
                            <div class="row justify-content-between g-3">
                                <div class="col-md-4 col-lg-3">
                                    <h5 class="card-title">Listado de Aportes</h5>
                                </div>
                                <div class="col-md-4 col-lg-3 d-none">
                                    <div class="choice-mb-none ">
                                        <select name="id_gestion" id="filtro_gestion" class="form-select form-select-sm"
                                            required>
                                            <option value="" >Seleccione una Gestión</option>
                                            @foreach ($gestiones as $gestion)

                                                    <option value="{{ $gestion->id_gestion }}" >
                                                        {{ $gestion->gestion }} </option>

                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-3 d-none">
                                    <div class="choice-mb-none ">
                                        <select name="estado_pago" id="filtro_estado_pago" class="form-select form-select-sm"
                                            required>
                                            <option value="">Seleccione estado</option>
                                            <option value="PENDIENTE">Pendiente</option>
                                            <option value="COMPLETADO">Completado</option>


                                        </select>

                                    </div>
                                </div>

                                <div class="col-lg-3 text-end" >
                                    <button type="button" class="btn btn-sm btn-danger" id="btnPdfPagos">
                                        <i class="bx bxs-file-pdf align-middle me-1"></i>
                                        PDF
                                    </button>
                                </div>
                            </div>
                            </form>
                        </div>

                        <div class="card-body ">
                            <div class="table-responsive table-card  overflow-auto scroll-style" style="height: 40vh;"
                                id="containerListaInscripcions">
                                <table class="table align-middle table-wrap table-sm  mb-0" id="tablaPagos">
                                    <thead class="table-light sticky-top top-0 z-index-10 ">
                                        <tr>
                                            <th data-sort="nombre" scope="col">#</th>
                                            <th data-sort="nombre" scope="col">Gestión</th>
                                            <th data-sort="nombre" scope="col">Mes</th>
                                            <th data-sort="ci" scope="col"> Monto (Bs.)</th>
                                            <th data-sort="celular" scope="col">Saldo</th>
                                            <th data-sort="oficina" scope="col">Fecha de Pago</th>
                                            <th data-sort="tipoPersonal" scope="col"> Observación </th>
                                            <th data-sort="tipoPersonal" scope="col"> Estado </th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="small" id="tbodyListaPagos">

                                    </tbody>

                                </table>


                            </div>

                        </div>


                        <!--end add modal-->

                    </div>
                    <div class="modal-footer mt-1 p-0 d-flex justify-content-center">
                        <div class="hstack gap-2  text-center">
                            <button type="button" class="btn btn-light text-danger " data-bs-dismiss="modal" id="btn-cancel-pay">
                                <i class="ri-close-fill me-1 align-bottom"></i>
                                Cerrar
                            </button>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>



    <div id="placeholderDetalles" style="display:none;">
        <div class="row">

            <div class="col-md-6 ">
                <div class="card ">
                    <div class="card-body text-center">

                        <h5 class=" mb-1 ">Detalles de Inscripción </h5>
                        <p class="text-muted ">Nro. de Inscripción</p>


                    </div>
                    <div class="card-body">
                        <h6 class="text-muted text-uppercase fw-semibold mb-3">Grupo de Entrenamiento : </h6>
                        <p class="text-muted mb-4">Observaciones: </p>
                        <p class="text-muted mb-4">Detalles: </p>

                        <div class="table-responsive table-card">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td class="fw-medium placeholder-glow" scope="row"><span class="placeholder">
                                                Fecha Inicio / Fin </span> </td>
                                        <td class="placeholder-glow"><span class="placeholder">--------------------------
                                            </span> </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium placeholder-glow" scope="row"><span class="placeholder">
                                                Tipo Inscripción </span> </td>
                                        <td class="placeholder-glow"> <span class="placeholder">
                                                ------------------------- </span> </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium placeholder-glow" scope="row"><span class="placeholder">
                                                Matricula </span> </td>
                                        <td class="placeholder-glow"> <span class="placeholder">
                                                ------------------------- </span> </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium placeholder-glow" scope="row"><span class="placeholder">
                                                Estado Inscripcion </span> </td>
                                        <td class="placeholder-glow"> <span class="placeholder">
                                                ------------------------- </span> </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium placeholder-glow" scope="row"><span class="placeholder">
                                                Sucursal </span> </td>
                                        <td class="placeholder-glow"> <span class="placeholder">
                                                ------------------------- </span> </td>
                                    </tr>

                                    <tr>
                                        <td class="fw-medium placeholder-glow" scope="row"><span class="placeholder">
                                                Fecha de Registro </span> </td>
                                        <td class="placeholder-glow"><span class="placeholder">
                                                ------------------------- </span> </td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 ">



                <div class="card" id="detallePersona">
                    <div class="card-body text-center">
                        <div class="position-relative d-inline-block">
                            <img src="{{ url('assets/images/users/user-dummy-img.jpg') }}" alt=""
                                class="avatar-lg rounded-circle img-thumbnail shadow">
                            <span class="contact-active position-absolute rounded-circle bg-success"><span
                                    class="visually-hidden"></span>
                            </span>
                        </div>
                        <h5 class="mt-4 mb-1 placeholder-glow"><span class="placeholder col-6"></span> </h5>
                        <p class="text-muted placeholder-glow"><span class="placeholder col-4"></span></p>

                        <ul class="list-inline mb-0">
                            <li class="list-inline-item avatar-xs placeholder-glow">
                                <a href="javascript:void(0);"
                                    class="avatar-title bg-soft-success text-success fs-15 rounded" target="_blank"
                                    disabled="">
                                    <i class="ri-whatsapp-line placeholder"></i>

                                </a>
                            </li>
                            <li class="list-inline-item avatar-xs placeholder-glow">
                                <a href="javascript:void(0);"
                                    class="avatar-title bg-soft-danger text-danger fs-15 rounded">
                                    <i class="ri-mail-line placeholder"></i>
                                </a>
                            </li>
                            <li class="list-inline-item avatar-xs placeholder-glow">
                                <a href="javascript:void(0);" class="avatar-title bg-soft-info text-info fs-15 rounded">
                                    <i class="ri-phone-line placeholder"></i>

                                </a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-body">
                        <h6 class="text-muted text-uppercase fw-semibold mb-3 placeholder-glow"><span
                                class="placeholder col-8"></span> </h6>
                        <p class="text-muted mb-4 placeholder-glow"><span class="placeholder col-10"></span>
                        </p>
                        <div class="table-responsive table-card">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td class="fw-medium placeholder-glow" scope="row">
                                            <span class="placeholder col-8"></span>
                                        </td>
                                        <td class="placeholder-glow"> <span class="placeholder col-8"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium placeholder-glow" scope="row"><span
                                                class="placeholder col-8"></span></td>
                                        <td class="placeholder-glow"> <span class="placeholder col-8"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium placeholder-glow" scope="row"><span
                                                class="placeholder col-8"></span></td>
                                        <td class="placeholder-glow"> <span class="placeholder col-8"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium placeholder-glow" scope="row"><span
                                                class="placeholder col-8"></span></td>
                                        <td class="placeholder-glow"> <span class="placeholder col-8"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium placeholder-glow" scope="row"><span
                                                class="placeholder col-8"></span></td>
                                        <td class="placeholder-glow"> <span class="placeholder col-8"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium placeholder-glow" scope="row"><span
                                                class="placeholder col-8"></span></td>
                                        <td class="placeholder-glow"> <span class="placeholder col-8"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium placeholder-glow" scope="row"><span
                                                class="placeholder col-8"></span></td>
                                        <td class="placeholder-glow"> <span class="placeholder col-8"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium placeholder-glow" scope="row"><span
                                                class="placeholder col-8"></span></td>
                                        <td class="placeholder-glow"> <span class="placeholder col-8"></span>
                                        </td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
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
            <li class="breadcrumb-item active">Administrar Inscripciones </li>
        </ol>
    </div>
@endsection

@section('title')
    Administración de Inscripciones
@endsection

@section('js')
    <!-- list.js min js -->
    {{-- <script src="{{ url('assets/libs/list.js/list.min.js') }}"></script> --}}
    {{-- <script src="{{ url('assets/libs/list.pagination.js/list.pagination.min.js') }}"></script> --}}
    <script src="{{ url('/js/plugins/scrollpagination-container.js') }}"></script>

    <script src="{{ url('/assets/libs/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ url('/js/plugins/croppie_2.6.5_croppie.min.js') }}"></script>

    <script src="{{ url('/admin/js/inscripcion/indexInscripcion.js?v=4') }}"></script>

    <!-- Sweet Alerts js -->
@endsection
