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
                                    id="inputBuscarCategoria">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>



                        <div class="col-auto  ">
                            <button class="btn btn-outline-info add-btn"><i class="ri-add-fill me-1 align-bottom"></i>
                                Registrar Nueva Categoria
                            </button>
                        </div>
                    </div>

                    <div id="contadorListaCategoria"></div>

                </div>
                <div class="card-body ">
                    <div>
                        <div class="table-responsive table-card  overflow-auto scroll-style" style="height: 60vh;"
                            id="containerListaCategoria">
                            <table class="table align-middle table-wrap table-sm  mb-0" id="tablaCategoria">
                                <thead class="table-light sticky-top top-0 z-index-10 ">
                                    <tr>
                                        <th data-sort="nombre" scope="col">Categoria</th>
                                        <th data-sort="ci" scope="col">Descripción</th>
                                        <th data-sort="celular" scope="col">Precio</th>
                                        <th data-sort="celular" scope="col">Fecha Creación</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="small" id="tbodyListaCategoria">

                                </tbody>
                                <tr>
                                    <td colspan="100%" class="text-center py-4" id="loadingCategoria">
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

                    <h5 class="modal-title" id="tituloModal">Registrar Categoría</h5>

                    <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form class="tablelist-form" autocomplete="off" id="formCategoria" novalidate>

                    <div class="modal-body">

                        <input type="hidden" id="id_categoria" value="" />
                        <input type="hidden" id="action" name="action" value="crear" />

                        <div class="row g-3">

                            <div class="col-lg-6">
                                <div>
                                    <label for="nombre_categoria" class="form-label">Nombre de la Categoria <small
                                            class="text-danger">*</small>
                                    </label>
                                    <input type="text" id="nombre_categoria" name="nombre_categoria"
                                        class="form-control txtNormal txtMayuscula " required placeholder="" />
                                    <div class="invalid-feedback">
                                        Por favor ingrese un nombre para la categoria.
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label for="precio" class="form-label">Precio / costo matrícula (Bs.)</label>
                                    <input type="text" id="precio" name="precio"
                                        class="form-control txtMayuscula txtDecimal" placeholder="" required />
                                        <div class="invalid-feedback">
                                            Por favor ingrese un precio para la categoria.
                                        </div>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div>
                                    <label for="descripcion" class="form-label">Descripción  </label>
                                    <textarea type="text" id="descripcion" name="descripcion"
                                        class="form-control txtNormal" placeholder="" required ></textarea>
                                    <small class="text-muted">(Descripción a que publico va dirigido)</small>

                                    <div class="invalid-feedback">
                                        Por favor ingrese una descripción para la categoria.
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="reset" class="btn btn-light" data-bs-dismiss="modal"
                                id="cancel-btn">Cancelar</button>
                            <button type="submit" class="btn btn-success mdi" id="add-btn">Registrar
                                Categoria</button>

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
                <li class="breadcrumb-item active">Administrar Categorias </li>
            </ol>
        </div>
    @endsection

    @section('title')
        Administración de Categorias
    @endsection

    @section('js')
        <!-- list.js min js -->
        {{-- <script src="{{ url('assets/libs/list.js/list.min.js') }}"></script> --}}
        {{-- <script src="{{ url('assets/libs/list.pagination.js/list.pagination.min.js') }}"></script> --}}
        <script src="{{ url('/js/plugins/scrollpagination-container.js') }}"></script>

        <script src="{{ url('/admin/js/academia/indexCategoria.js') }}"></script>

        <!-- Sweet Alerts js -->
    @endsection
