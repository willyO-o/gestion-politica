@section('content')
    <div class="row">

        <!--end col-->
        <div class="col-xxl-12">
            <div class="card" id="contactList">
                <div class="card-header">
                    <div class="row py-2  justify-content-between">

                        <div class="col-xl-3 col-md-6">
                            <div class="search-box">
                                <input type="search" class="form-control" placeholder="Buscar Usuario."
                                    id="inputBuscarUsuario">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>




                        <div class="col-auto   ">
                            <button class="btn btn-outline-info add-btn"><i class="ri-add-fill me-1 align-bottom"></i>
                                Registrar Nuevo Usuario
                            </button>
                        </div>
                    </div>

                    <div id="contadorListaUsuario"></div>

                </div>
                <div class="card-body ">
                    <div>
                        <div class="table-responsive table-card  overflow-auto scroll-style" style="height: 65vh;"
                            id="containerListaUsuario">
                            <table class="table align-middle table-wrap table-sm  mb-0" id="tablaUsuario">
                                <thead class="table-light sticky-top top-0 z-index-10 ">
                                    <tr>
                                        <th data-sort="nombre" scope="col">Nombre de Usuario</th>
                                        <th data-sort="nombre" scope="col">Nombre Persona</th>
                                        <th data-sort="nombre" scope="col">Sucursal a Cargo</th>
                                        <th data-sort="ci" scope="col">Rol</th>
                                        <th data-sort="celular" scope="col">fecha creación</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="small" id="tbodyListaUsuario">

                                </tbody>
                                <tr>
                                    <td colspan="100%" class="text-center py-4" id="loadingUsuario">
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
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content border-0">
                <div class="modal-header bg-soft-info p-3">
                    <h5 class="modal-title" id="tituloModal">Registrar Usuario</h5>
                    <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>

                <form class="tablelist-form" autocomplete="off" id="formUsuario" novalidate action="#" method="POST">

                    <div class="modal-body">

                        <input type="hidden" id="id_usuario" value="" />
                        <input type="hidden" id="action" name="action" value="crear" />

                        <div class="row g-3">


                            <div class="col-lg-12">
                                <div>
                                    <label for="id_persona_fk" class="form-label">Persona <small
                                            class="text-danger">*</small>
                                    </label>
                                    <select type="text" id="id_persona_fk" name="id_persona_fk" class="form-select   "
                                        required placeholder=""></select>
                                    <div class="invalid-feedback">
                                        Por favor seleccione la persona que pertenece el usuario.
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div>
                                    <label for="usuario" class="form-label">Nombre Usuario <small
                                            class="text-danger">*</small>
                                    </label>
                                    <input type="text" id="usuario" name="usuario"
                                        class="form-control txtNormal txtMayuscula  sinEspacios" required placeholder="" />
                                    <div class="invalid-feedback">
                                        Por favor ingrese un nombre para el usuario
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label for="password" class="form-label">Contraseña <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" id="password" name="password" class="form-control   sinEspacios " required
                                        placeholder="">
                                    <div class="invalid-feedback">
                                        Por favor ingrese una contraseña.
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label for="confirm_password" class="form-label">Confirmar Contraseña <small
                                            class="text-danger">*</small>
                                    </label>
                                    <input type="text" id="confirm_password" name="confirm_password"
                                        class="form-control  sinEspacios " required placeholder="">
                                    <div class="invalid-feedback">
                                        Las contraseñas no coinciden.
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="mostrarContrasenia" checked="">
                                        <label class="form-check-label" for="mostrarContrasenia">
                                            Mostrar Contraseña
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div>
                                    <label for="susursales_autorizadas" class="form-label"> Sucursales a cargo <small
                                            class="text-danger">*</small>
                                    </label>
                                    <select type="text" id="susursales_autorizadas" name="susursales_autorizadas[]" multiple
                                        class="form-control   " required placeholder=""></select>
                                    <div class="invalid-feedback">
                                        Por favor seleccione una o mas sucursales.
                                    </div>
                                </div>
                            </div>



                            <div class="col-lg-6">
                                <div>
                                    <label for="id_rol_fk" class="form-label">Rol de Usuario <small
                                            class="text-danger">*</small>
                                    </label>
                                    <select type="text" id="id_rol_fk" name="id_rol_fk" class="form-select   "
                                        required placeholder="">
                                        <option value="">Seleccione un rol</option>
                                        @foreach ($roles as $rol)
                                            <option value="{{ $rol->id_rol }}">{{ $rol->rol }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor seleccione un rol para el usuario.
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="reset" class="btn btn-light" data-bs-dismiss="modal"
                                id="cancel-btn">Cancelar</button>
                            <button type="submit" class="btn btn-success mdi" id="add-btn">Registrar Usuario</button>

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
            <li class="breadcrumb-item active">Administrar Usuarios </li>
        </ol>
    </div>
@endsection

@section('title')
    Administración de Usuarios
@endsection

@section('js')
    <!-- list.js min js -->
    {{-- <script src="{{ url('assets/libs/list.js/list.min.js') }}"></script> --}}
    {{-- <script src="{{ url('assets/libs/list.pagination.js/list.pagination.min.js') }}"></script> --}}
    <script src="{{ url('/js/plugins/scrollpagination-container.js') }}"></script>

    <script src="{{ url('/admin/js/seguridad/indexUsuario.js') }}"></script>

    <!-- Sweet Alerts js -->
@endsection
