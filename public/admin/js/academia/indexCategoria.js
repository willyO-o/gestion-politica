$(function () {

    'use strict';

    const apiWhastapp = "https://api.whatsapp.com/send?phone=591";





    let dataScroll = {
        'page': 1,
        'size': 20,
        'search': '',
        '_token': crfToken,
    }


    let scrollCategoria = $('#tbodyListaCategoria').scrollPagination({
        'url': baseUrl + '/admin/categorias-listar', // the url you are fetching the results
        'method': 'post',
        'data': getDataFilter(),
        'dataTemplateCallback': rowHtml,
        'elementCountSelector': '#contadorListaCategoria',
        'elementCountTemplate': '<span  class=""> Listando <b> {count}  </b>elementos de <b> {total} </b> encontrados </span>',
        'loading': '#loadingCategoria',
        'scroller': "#containerListaCategoria",
        'loadingText': `<div  class=" text-center"><span class="loaderHttp"></span><span class="text-muted">Cargando...</span></div>`,
        'loadingNomoreText': '<h6 class="text-danger">No se encontraron más Resultados</h6>',

    });


    $("#filtroSelectTipoPersona,#filtroEstadoPersona")
        .on("change", function (e) {
            e.preventDefault();


            scrollCategoria.resetScrollPagination(getDataFilter());

        })


    let timer = null;
    $("#inputBuscarCategoria")
        .on("input", function () {

            clearTimeout(timer);

            timer = setTimeout(() => {

                scrollCategoria.resetScrollPagination(getDataFilter());

            }, 500);

        });


    function getDataFilter() {



        dataScroll.search = $("#inputBuscarCategoria").val();

        return dataScroll;
    }









    function rowHtml(item, opacity = 0) {


        let html =/*html*/ `<tr data-id="${item.id_categoria}" style='opacity:${opacity};-moz-opacity: ${opacity};filter: alpha(opacity=${opacity});'>

            <td class="nombre_categoria">
                ${item.nombre_categoria} ${item.central == 1 ? '<span class="badge badge-soft-success">Central</span>' : ""}
            </td>
            <td class="descripcion">
                ${item.descripcion || ""}
            </td>
            <td class="precio">
                ${numeroMonto(item.precio || "")}
            </td>


            <td class="fecha_creacion">
                ${fomatDate(item.created_at || "", "fh")}
            </td>

            <td class="estado">

                <div class="form-check form-switch">
                    <input class="form-check-input switch-status-btn" type="checkbox" role="switch"  ${item.estado == "ACTIVO" ? "checked" : ""} >
                </div>
            </td>

            <td>
                <ul class="list-inline hstack gap-2 mb-0">

                    <li class="list-inline-item edit" >
                        <a href="javascript:void(0);" class="text-muted hover-warning d-inline-block edit-item-btn" tooltip="tooltip" data-bs-placement="top" title="Editar Categoria">
                            <i class="ri-pencil-line fs-16"></i>
                        </a>
                    </li>
                    <li class="list-inline-item edit" >
                        <a href="javascript:void(0);" class="text-muted hover-danger d-inline-block remove-item-btn" tooltip="tooltip" data-bs-placement="top" title="Eliminar Categoria">
                            <i class="ri-delete-bin-2-line fs-16"></i>
                        </a>
                    </li>

                </ul>
            </td>
        </tr>`;


        return html;

    }




    $("#tablaCategoria")
        .on("click", ".view-item-btn", function (e) {
            e.preventDefault();

            let itemId = $(this).parents("tr").data("id");

            esqueletonLoader();

            $.get(baseUrl + '/admin/categorias/' + itemId)
                .done(function (data) {


                    detallePersona(data.data);
                    // hacer scroll hasta el detalle
                    $('html, body').animate({
                        scrollTop: $("#detallePersona").offset().top
                    }, 1000);

                })
                .fail(function (jqXHR) {
                    processError(jqXHR);

                })
            $(this).removeData();


        })
        .on("click", ".edit-item-btn", function (e) {
            e.preventDefault();

            limpiarForm();

            let itemId = $(this).closest("tr").data("id");


            $("#add-btn").text("Actualizar Categoria");

            $("#tituloModal").text("Actualizar Categoria");

            $.get(baseUrl + '/admin/categorias/' + itemId)
                .done(function (res) {


                    $("#action").val("actualizar");

                    for (const key in res.data) {
                        if (Object.hasOwnProperty.call(res.data, key)) {
                            const element = res.data[key];

                            $("#formCategoria #" + key).val(element);

                        }
                    }

                    $("#showModal").modal("show");
                })
                .fail(function (jqXHR) {
                    processError(jqXHR);

                })


            $(this).removeData();



        })
        .on("click", ".switch-status-btn", function (e) {

            let itemId = $(this).closest("tr").data("id");
            let estado = $(this).prop("checked") ? "ACTIVO" : "INACTIVO";

            let btn = $(this);

            $.post(baseUrl + '/admin/categorias/' + itemId, { _token: crfToken, _method: 'PATCH', estado: estado })
                .done(function (data) {

                    if (data.success) {


                        notification(data.message, "Persona Actualizada")

                    }
                })
                .fail(function (jqXHR) {

                    btn.prop("checked", !btn.prop("checked"));
                    processError(jqXHR);
                })

            $(this).removeData();


        })
        .on("click", ".remove-item-btn", function (e) {
            e.preventDefault();


            let itemId = $(this).closest("tr").data("id");

            let nombre = $(this).closest("tr").find(".nombre_categoria").text();

            let btn = $(this);


            Swal.fire({
                title: '¿Estas seguro de eliminar la Categoria: ' + nombre + '?',
                text: "No podras revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#5e72e4',
                cancelButtonColor: '#f5365c',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.post(baseUrl + '/admin/categorias/' + itemId, { _token: crfToken, _method: 'DELETE' })
                        .done(function (data) {

                            if (data.success) {
                                notification(data.message, "Persona Eliminada...")

                                btn.closest("tr").fadeOut("slow", function () {
                                    $(this).remove();
                                })
                            }


                        })
                        .fail(function (jqXHR, textStatus, errorThrown) {
                            processError(jqXHR);

                        })
                }
            })

            $(this).removeData();


        })
        .on("click", ".btn-update-photo", function (e) {
            e.preventDefault();

            let itemId = $(this).closest("tr").data("id");

            $("#id_persona_photo").val(itemId);

            let nombre = $(this).closest("tr").find(".nombre").text();

            $("#titleUpdatePhoto").text("Actualizar Foto de: " + nombre);

            $("#modalPhoto").modal("show");

            $(this).removeData();

        })
        .on("click", ".image-popup", function (e) {
            e.preventDefault();

            let src = $(this).find("img").attr("src");


            const lightbox = GLightbox({
                elements: [{ href: src, type: 'image' }],

            });

            lightbox.open();

            $(this).removeData();
        })




    $(".add-btn").click(function (e) {
        e.preventDefault();

        limpiarForm();
        $("#showModal").modal("show");


    })






    $("#formCategoria")
        .submit(function (e) {
            e.preventDefault();


            let form = $(this);
            form.addClass('was-validated');

            if (form[0].checkValidity() === false) {
                e.stopPropagation();
                return false;
            }

            let data = $(this).serializeArray();


            data.push({ name: "_token", value: crfToken });

            let accion = $("#action").val();

            if (accion == "crear") {
                crearCategoria(data);
                return;
            }

            if (accion == "actualizar") {

                actualizarCategoria(data);

                return;
            }


        })




    function limpiarForm() {
        $("#id_categoria").val("");
        $("#formCategoria").removeClass('was-validated');
        $("#formCategoria")[0].reset();
        $("#action").val("crear");
        $("#add-btn").text("Registrar Categoria");
        $("#tituloModal").text("Registrar Categoria");
    }

    $("#cancel-btn,#close-modal").click(function (e) {
        // e.preventDefault();
        limpiarForm();
    })

    function crearCategoria(data) {

        $("#add-btn").prop("disabled", true).addClass("mdi-spin mdi-loading");

        $.post(baseUrl + '/admin/categorias', data)
            .done(function (data) {


                if (data.success) {
                    $("#cancel-btn").trigger("click");
                    notification(data.message, "Categoria Registrada")
                    let row = rowHtml(data.data, 1);
                    $("#tbodyListaCategoria").prepend(row);
                    $("#formCategoria").removeClass('was-validated');
                }


            })
            .fail(function (jqXHR) {


                processError(jqXHR);

            })
            .always(function () {

                $("#add-btn").prop("disabled", false).removeClass("mdi-spin mdi-loading");

            })


    }

    function actualizarCategoria(data) {

        $("#add-btn").prop("disabled", true).addClass("mdi-spin mdi-loading");

        data.push({ name: "_method", value: "PUT" });

        $.post(baseUrl + '/admin/categorias/' + $("#id_categoria").val(), data)
            .done(function (data) {

                if (data.success) {
                    $("#cancel-btn").trigger("click");

                    notification(data.message, "Categoria Actualizada")
                    let row = rowHtml(data.data, 1);
                    $("#tbodyListaCategoria").find(`tr[data-id="${data.data.id_categoria}"]`).replaceWith(row);

                }

            })
            .fail(function (jqXHR) {

                processError(jqXHR);

            })
            .always(function () {

                $("#add-btn").prop("disabled", false).removeClass("mdi-spin mdi-loading");

            })

    }








});
