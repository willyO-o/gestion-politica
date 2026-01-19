@section('content')
    <div class="row">

        <!--end col-->
        <div class="col-xxl-10">
            <div class="card" id="contactList">
                <div class="card-header">
                    <div class="row py-2 justify-content-between ">

                        <div class="col-md-6">
                            <div class="search-box">
                                <input type="search" class="form-control" placeholder="Buscar sucursal."
                                    id="inputBuscarSucursal">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>



                        <div class="col-md-2  ">
                            <button class="btn btn-outline-info add-btn"><i class="ri-add-fill me-1 align-bottom"></i>
                                Registrar Nueva Sucursal
                            </button>
                        </div>
                    </div>

                    <div id="contadorListaSucursal"></div>

                </div>
                <div class="card-body ">
                    <div>
                        <div class="table-responsive table-card  overflow-auto scroll-style" style="height: 60vh;"
                            id="containerListaSucursal">
                            <table class="table align-middle table-wrap table-sm  mb-0" id="tablaSucursal">
                                <thead class="table-light sticky-top top-0 z-index-10 ">
                                    <tr>
                                        <th data-sort="nombre" scope="col">sucursal</th>
                                        <th data-sort="ci" scope="col">Dirección</th>
                                        <th data-sort="celular" scope="col">telefono</th>
                                        <th data-sort="tipoPersonal" scope="col">Coordenadas </th>
                                        <th data-sort="celular" scope="col">fecha creación</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="small" id="tbodyListaSucursal">

                                </tbody>
                                <tr>
                                    <td colspan="100%" class="text-center py-4" id="loadingSucursal">
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
                    <h5 class="modal-title" id="tituloModal">Registrar Sucursal</h5>
                    <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form class="tablelist-form" autocomplete="off" id="formSucursal" novalidate>

                    <div class="modal-body">



                        <input type="hidden" id="id_sucursal" value="" />
                        <input type="hidden" id="action" name="action" value="crear" />

                        <div class="row g-3">

                            <div class="col-lg-6">
                                <div>
                                    <label for="nombre_sucursal" class="form-label">Número de la Sucursal <small
                                            class="text-danger">*</small>
                                    </label>
                                    <input type="text" id="nombre_sucursal" name="nombre_sucursal"
                                        class="form-control txtNormal txtMayuscula " required placeholder="" />
                                    <div class="invalid-feedback">
                                        Por favor ingrese un nombre de la sucursal.
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label for="telefono" class="form-label">Número de teléfono</label>
                                    <input type="text" id="telefono" name="telefono"
                                        class="form-control txtMayuscula txtNormal" placeholder="" />
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div>
                                    <label for="direccion_sucursal" class="form-label">Dirección de la Sucursal <small
                                            class="text-muted">(opcional)</small> </label>
                                    <textarea type="text" id="direccion_sucursal" name="direccion_sucursal"
                                        class="form-control txtNormal" placeholder="" ></textarea>
                                    <small class="text-muted">(Dirección de la oficina)</small>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label for="latitud" class="form-label"> Coordenadas Latitud</label>
                                    <input type="text" id="latitud" name="latitud"
                                        class="form-control  txtNormal" placeholder="Ej: -16.511235" />
                                        <small class="text-muted">(Coordenadas de Latititud )</small>

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label for="logitud" class="form-label">Coordenadas logitud</label>
                                    <input type="text" id="logitud" name="logitud"
                                        class="form-control  txtNormal" placeholder="Ej: -68.228188" />
                                        <small class="text-muted">(Coordenadas de Longitud )</small>

                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="reset" class="btn btn-light" data-bs-dismiss="modal"
                                id="cancel-btn">Cancelar</button>
                            <button type="submit" class="btn btn-success mdi" id="add-btn">Registrar
                                Sucursal</button>

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
    @endsection

    @section('breadcrumb')
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);"></a>Inicio</li>
                <li class="breadcrumb-item active">Administrar Sucursales </li>
            </ol>
        </div>
    @endsection

    @section('title')
        Administración de Sucursales
    @endsection

    @section('js')
        <!-- list.js min js -->
        {{-- <script src="{{ url('assets/libs/list.js/list.min.js') }}"></script> --}}
        {{-- <script src="{{ url('assets/libs/list.pagination.js/list.pagination.min.js') }}"></script> --}}
        <script src="{{ url('/js/plugins/scrollpagination-container.js') }}"></script>

        <script src="{{ url('/admin/js/academia/indexSucursal.js') }}"></script>

        <!-- Sweet Alerts js -->
    @endsection
