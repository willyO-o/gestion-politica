var idBloqueActualPagina = null;
var nombreBloqueActualPagina = '';
var modalPaginasInstance = null;

// Función para abrir el modal de páginas
function abrirModalPaginas(idBloque, nombreBloque) {
    idBloqueActualPagina = idBloque;
    nombreBloqueActualPagina = nombreBloque;

    document.getElementById('tituloPaginasBloque').textContent = nombreBloque;
    document.getElementById('id_bloque_pagina').value = idBloque;

    cargarPaginasBloque();
    mostrarListaPaginas();

    if (!modalPaginasInstance) {
        modalPaginasInstance = new bootstrap.Modal(document.getElementById('modalPaginas'));
    }
    modalPaginasInstance.show();
}

// Cargar lista de páginas
function cargarPaginasBloque() {
    var tbody = document.getElementById('tbodyPaginas');
    var loading = document.getElementById('loadingPaginas');
    var contador = document.getElementById('contadorPaginas');
    var buscar = document.getElementById('inputBuscarPagina') ? document.getElementById('inputBuscarPagina').value : '';

    tbody.innerHTML = '';
    loading.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Cargando...';

    $.ajax({
        url: '/admin/paginas',
        type: 'GET',
        data: {
            id_bloque: idBloqueActualPagina,
            buscar: buscar
        },
        success: function(response) {
            loading.innerHTML = '';

            if (response.success) {
                contador.innerHTML = '<span class="badge bg-soft-info text-info">' + response.total + ' página(s)</span>';

                if (response.data.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted py-4">' +
                        '<i class="ri-pages-line fs-1 d-block mb-2"></i>' +
                        'No hay páginas registradas</td></tr>';
                    return;
                }

                response.data.forEach(function(pagina) {
                    var encargado = pagina.persona_nombres ?
                        pagina.persona_nombres + ' ' + (pagina.persona_apellido || '') :
                        '<span class="text-muted">Sin asignar</span>';

                    tbody.innerHTML += '<tr>' +
                        '<td><strong>' + pagina.titulo + '</strong></td>' +
                        '<td><a href="' + pagina.enlace + '" target="_blank" class="text-truncate d-inline-block" style="max-width: 180px;">' +
                            pagina.enlace + ' <i class="ri-external-link-line"></i></a></td>' +
                        '<td class="text-center"><span class="badge bg-soft-primary text-primary">' +
                            '<i class="ri-share-forward-line me-1"></i>' + (pagina.compartidas || 0) + '</span></td>' +
                        '<td class="text-center"><span class="badge bg-soft-danger text-danger">' +
                            '<i class="ri-heart-line me-1"></i>' + (pagina.me_gusta || 0) + '</span></td>' +
                        '<td>' + encargado + '</td>' +
                        '<td><div class="btn-group btn-group-sm">' +
                            '<button class="btn btn-soft-info" onclick="editarPagina(' + pagina.id + ')" title="Editar">' +
                                '<i class="ri-pencil-line"></i></button>' +
                            '<button class="btn btn-soft-danger" onclick="eliminarPagina(' + pagina.id + ', \'' + pagina.titulo.replace(/'/g, "\\'") + '\')" title="Eliminar">' +
                                '<i class="ri-delete-bin-line"></i></button>' +
                        '</div></td></tr>';
                });
            }
        },
        error: function() {
            loading.innerHTML = '<span class="text-danger">Error al cargar</span>';
        }
    });
}

// Mostrar formulario nueva página
function mostrarFormPagina() {
    document.getElementById('listaPaginasContainer').classList.add('d-none');
    document.getElementById('formPaginaContainer').classList.remove('d-none');
    document.getElementById('tituloFormPagina').textContent = 'Registrar Nueva Página';
    document.getElementById('actionPagina').value = 'crear';
    document.getElementById('id_pagina').value = '';
    document.getElementById('formPagina').reset();
    document.getElementById('formPagina').classList.remove('was-validated');
    document.getElementById('id_bloque_pagina').value = idBloqueActualPagina;
}

// Mostrar lista de páginas
function mostrarListaPaginas() {
    document.getElementById('formPaginaContainer').classList.add('d-none');
    document.getElementById('listaPaginasContainer').classList.remove('d-none');
}

// Cancelar formulario
function cancelarFormPagina() {
    mostrarListaPaginas();
    document.getElementById('formPagina').reset();
    document.getElementById('formPagina').classList.remove('was-validated');
}

// Editar página
function editarPagina(id) {
    $.ajax({
        url: '/admin/paginas/' + id,
        type: 'GET',
        success: function(response) {
            if (response.success) {
                var pagina = response.data;

                mostrarFormPagina();
                document.getElementById('tituloFormPagina').textContent = 'Editar Página';
                document.getElementById('actionPagina').value = 'editar';
                document.getElementById('id_pagina').value = pagina.id;
                document.getElementById('titulo_pagina').value = pagina.titulo;
                document.getElementById('enlace_pagina').value = pagina.enlace;
                document.getElementById('compartidas_pagina').value = pagina.compartidas || 0;
                document.getElementById('me_gusta_pagina').value = pagina.me_gusta || 0;

                if (document.getElementById('id_persona_pagina') && pagina.id_persona) {
                    document.getElementById('id_persona_pagina').value = pagina.id_persona;
                }
            }
        },
        error: function() {
            Swal.fire('Error', 'No se pudo cargar la página', 'error');
        }
    });
}

// Guardar página
function guardarPagina(event) {
    event.preventDefault();

    var form = document.getElementById('formPagina');
    if (!form.checkValidity()) {
        form.classList.add('was-validated');
        return;
    }

    var action = document.getElementById('actionPagina').value;
    var idPagina = document.getElementById('id_pagina').value;

    var datos = {
        titulo: document.getElementById('titulo_pagina').value,
        enlace: document.getElementById('enlace_pagina').value,
        compartidas: document.getElementById('compartidas_pagina').value || 0,
        me_gusta: document.getElementById('me_gusta_pagina').value || 0,
        id_bloque: document.getElementById('id_bloque_pagina').value,
        id_persona: document.getElementById('id_persona_pagina') ? document.getElementById('id_persona_pagina').value : null,
        _token: $('meta[name="csrf-token"]').attr('content')
    };

    var btn = document.getElementById('btnGuardarPagina');
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Guardando...';

    var url = '/admin/paginas';
    var method = 'POST';

    if (action === 'editar') {
        url = '/admin/paginas/' + idPagina;
        method = 'PUT';
    }

    $.ajax({
        url: url,
        type: method,
        data: datos,
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: response.message,
                    timer: 1500,
                    showConfirmButton: false
                });

                cancelarFormPagina();
                cargarPaginasBloque();
            } else {
                var errores = '';
                if (response.errors) {
                    $.each(response.errors, function(key, value) {
                        errores += value[0] + '<br>';
                    });
                }
                Swal.fire('Error', errores || response.message, 'error');
            }
        },
        error: function(xhr) {
            var errores = '';
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                $.each(xhr.responseJSON.errors, function(key, value) {
                    errores += value[0] + '<br>';
                });
            }
            Swal.fire('Error', errores || 'Error al guardar la página', 'error');
        },
        complete: function() {
            btn.disabled = false;
            btn.innerHTML = '<i class="ri-save-line me-1"></i> Guardar';
        }
    });
}

// Eliminar página
function eliminarPagina(id, titulo) {
    Swal.fire({
        title: '¿Eliminar página?',
        html: '¿Está seguro de eliminar la página <strong>' + titulo + '</strong>?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then(function(result) {
        if (result.isConfirmed) {
            $.ajax({
                url: '/admin/paginas/' + id,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Eliminado',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                        cargarPaginasBloque();
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Error al eliminar', 'error');
                }
            });
        }
    });
}

// Buscar páginas
function buscarPaginas() {
    cargarPaginasBloque();
}
