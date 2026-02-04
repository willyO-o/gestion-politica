<div class="modal-header bg-soft-info p-3">

    <h5 class="modal-title" id="tituloModal">{{$actividad->exists ? 'Editar' : 'Registrar'}} Actividad</h5>

    <button type="reset" class="btn-close cancel-btn" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
</div>
<form class="tablelist-form" autocomplete="off" action="{{ $actividad->exists ? route('actividad.update', $actividad->id) : route('actividad.store') }}" id="formActividad" novalidate>

    @csrf
    @if($actividad->exists)
        @method('PUT')
    @endif
    <div class="modal-body">

        <div class="row g-3">

            <div class="col-lg-8">

                <div>
                    <label for="permiso" class="form-label">
                        Nombre Actividad <small class="text-danger">*</small>
                    </label>
                    <input type="text" id="nombre_actividad" name="nombre_actividad"
                        class="form-control txtNormal txtMayuscula " required
                        placeholder="Ingrese el nombre de la actividad" value="{{ old('nombre_actividad', $actividad->nombre_actividad) }}" />
                </div>

            </div>


            <div class="col-lg-4">

                <div>
                    <label for="fecha_actividad" class="form-label">Fecha <small class="text-danger">*</small>
                    </label>
                    <input type="date" id="fecha_actividad" name="fecha_actividad"
                        class="form-control txtNormal txtMayuscula " required value="{{ old('fecha_actividad', $actividad->fecha_actividad ?? date('Y-m-d')) }}" />
                    <div class="invalid-feedback">
                        Por favor ingrese una fecha para la actividad.
                    </div>
                </div>

            </div>
            <div class="col-lg-12">

                <div>
                    <label for="descripcion" class="form-label">Descripción
                        <small class="text-muted">
                            (Opcional)
                        </small>
                    </label>
                    <textarea name="descripcion" id="descripcion" class="form-control" rows="6">{{ old('descripcion', $actividad->descripcion) }}</textarea>


                </div>

            </div>
        </div>


    </div>
    <div class="modal-footer mt-3">
        <div class="hstack gap-2 justify-content-end">
            <button type="reset" class="btn btn-light cancel-btn" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success mdi" id="add-btn">
                <i class="mdi mdi-content-save"></i>
                {{ $actividad->exists ? 'Actualizar' : 'Registrar' }} Actividad </button>

        </div>
    </div>
</form>
