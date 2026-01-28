<div class="modal-header bg-soft-info p-3">
    <h5 class="modal-title" id="tituloModal">Registrar Bloque </h5>
    <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
</div>
<form class="tablelist-form" autocomplete="off" id="formGrupoEntrenamiento" novalidate action="#" method="POST">

    <div class="modal-body">

        <input type="hidden" id="id_grupo_entrenamiento" value="" />
        <input type="hidden" id="action" name="action" value="crear" />

        <div class="row g-3">


            <div class="col-lg-12">
                <div>
                    <label for="nombre_grupo" class="form-label">Nombre Bloque <small class="text-danger">*</small>
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
                    <label for="descripcion_grupo" class="form-label">Descripción de actividades del
                        Bloque
                        <small class="text-danger">*</small>
                    </label>
                    <textarea type="text" id="descripcion_grupo" name="descripcion_grupo" class="form-control txtNormal  " required
                        rows="15" placeholder=""></textarea>
                    <div class="invalid-feedback">
                        Por favor ingrese una descripción para el bloque político.
                    </div>
                </div>

            </div>



            <div class="col-lg-6">
                <div>
                    <label for="id_categoria" class="form-label">Distrito <small class="text-danger">*</small>
                    </label>
                    <select type="text" id="id_categoria" name="id_categoria" class="form-control   " required
                        placeholder=""></select>
                    <div class="invalid-feedback">
                        Por favor seleccione un distrito.
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div>
                    <label for="id_sucursal_fk" class="form-label">Casa de campaña <small
                            class="text-secondary">(opcional)</small>
                    </label>
                    <select type="text" id="id_sucursal_fk" name="id_sucursal_fk" class="form-control   "
                        placeholder=""></select>
                    <div class="invalid-feedback">
                        Por favor seleccione una casa de campaña.
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div>
                    <label for="id_entrenador" class="form-label"> Encargado <small
                            class="text-secondary">(opcional)</small>
                    </label>
                    <select type="text" id="id_entrenador" name="id_entrenador" class="form-control   "
                        placeholder=""></select>
                    <div class="invalid-feedback">
                        Por favor seleccione un encargado.
                    </div>
                </div>
            </div>

            <div class="col-lg-6 d-none">
                <div>
                    <label for="id_gestion" class="form-label">Gestión <small class="text-secondary">(opcional)</small>
                    </label>
                    <select type="text" id="id_gestion" name="id_gestion" class="form-control   " required
                        placeholder="">
                        @foreach ($gestiones as $gestion)
                            <option value="{{ $gestion->id_gestion }}">{{ $gestion->gestion }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Por favor seleccione una gestion.
                    </div>
                </div>
            </div>

            <div class="col-lg-6 d-none ">
                <div>
                    <label for="direccion_sucursal" class="form-label">Tipo bloque político <small
                            class="text-danger">*</small> </label><br>

                    <select name="dia" id="" class="form-select">

                        <option value="ALCALDIA">Alcaldía</option>
                        <option value="GOBERNACION">Gobernación</option>
                        <option value="ALCALDIA y GOBERNACION">Ambos</option>

                    </select>
                    <div class="invalid-feedback">
                        Por favor seleccione un tipo de bloque político.
                    </div>

                </div>
            </div>



            <div class="col-lg-3">
                <div>
                    <label for="fecha_creacion" class="form-label">Fecha Creación <small class="text-danger">*</small>
                    </label>
                    <input type="date" id="fecha_creacion" name="fecha_creacion" class="form-control   " required
                        placeholder="" value="{{ date('Y-m-d') }}" />
                    <div class="invalid-feedback">
                        Por favor ingrese una fecha de creación.
                    </div>
                </div>

            </div>


            <div class="col-lg-3 d-none">
                <div>
                    <label for="fecha_fin" class="form-label">Fecha Fin</label>
                    <input type="date" id="fecha_fin" name="fecha_fin" class="form-control  " placeholder="" />
                </div>
            </div>





            <div class="col-lg-3 d-none">
                <div>
                    <label for="hora_inicio" class="form-label"> Hora de Inicio <small class="text-danger">*</small>
                    </label>
                    <input type="time" id="hora_inicio" name="hora_inicio" class="form-control  " min="06:00"
                        max="21:00" />
                    <small class="text-muted"> </small>

                </div>
            </div>

            <div class="col-lg-3 d-none">
                <div>
                    <label for="hora_fin" class="form-label">Hora de Finalización <small
                            class="text-danger">*</small> </label>

                    <input type="time" id="hora_fin" name="hora_fin" class="form-control  " min="06:00"
                        max="21:00" />
                    <small class="text-muted"></small>

                </div>
            </div>


            <div class="col-lg-6 d-none">
                <div>
                    <label for="" class="form-label">Turno</label>


                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="turno" id="turno-maniana"
                            value="MAÑANA">
                        <label class="form-check-label" for="turno-maniana">
                            Mañana
                        </label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="turno" id="turno-tarde"
                            value="TARDE">
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
                        <label for="" class="form-label">Dia Extra de Entrenamiento
                        </label><br>
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
                        <input type="time" id="hora_inicio_dia_extra" name="hora_inicio_dia_extra" min="06:00"
                            max="21:00" class="form-control  " />

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
