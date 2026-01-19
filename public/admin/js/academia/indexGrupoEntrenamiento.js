$(function () {

    'use strict';





    const apiWhastapp = "https://api.whatsapp.com/send?phone=591";

    let configChoices = {
        removeItemButton: true,

        noResultsText: "No se encontraron resultados",
        noChoicesText: "No hay opciones para seleccionar",
        itemSelectText: "Click para seleccionar",
        searchPlaceholderValue: "Buscar...",
        searchPlaceholderValue: null,
        loadingText: "Buscando...",
        searchFields: ["label", "value"],
        shouldSort: false,
    };

    let listaCategorias = [];
    let listaSucursales = [];
    let listaEntrenadores = [];



    getParametros()

    function getParametros() {

        $.post(baseUrl + '/admin/grupos-entrenamientos-parametrico', { _token: crfToken })
            .done(function (data) {
                listaCategorias = data.datos.categorias;
                listaSucursales = data.datos.sucursales;
                listaEntrenadores = data.datos.entrenadores;
                llenarSelectCategoria();
                llenarSelectSucursal();
                llenarSelectEntrenador();

                llenarFiltros();
            })
            .fail(function (jqXHR) {
                processError(jqXHR);
            })
    }


    let selectCategoria = new Choices("#id_categoria", configChoices);
    let selectSucursal = new Choices("#id_sucursal_fk", configChoices);
    let selectEntrenador = new Choices("#id_entrenador", configChoices);


    let filtroCategoria = new Choices("#filtroCategoria", configChoices);
    let filtroSucursal = new Choices("#filtroSucursal", configChoices);



    function llenarSelectCategoria() {

        // crear choices select con tipos de activo  como label e iterar el campo subcategoria como options


        let optionsCategoria = [];
        // placeholder
        optionsCategoria.push({
            label: "Seleccione una Categoría",
            value: "",
            id: "",
        });

        listaCategorias.forEach(function (row) {

            optionsCategoria.push({
                label: row.nombre_categoria,
                value: row.id_categoria,
                id: row.id_categoria,
            });


        });

        selectCategoria.setChoices(optionsCategoria, "value", "label", true);

        selectCategoria.setChoiceByValue("");

    }


    function llenarSelectSucursal() {

        // crear choices select con tipos de activo  como label e iterar el campo subcategoria como options


        let optionsSucursal = [];
        // placeholder
        optionsSucursal.push({
            label: "Seleccione una Sucursal",
            value: "",
            id: "",
        });

        listaSucursales.forEach(function (row) {

            optionsSucursal.push({
                label: row.nombre_sucursal,
                value: row.id_sucursal,
                id: row.id_sucursal,
            });


        });

        selectSucursal.setChoices(optionsSucursal, "value", "label", true);

        selectSucursal.setChoiceByValue("");

    }

    function llenarSelectEntrenador() {

        // crear choices select con tipos de activo  como label e iterar el campo subcategoria como options


        let options = [];
        // placeholder
        options.push({
            label: "Seleccione un Entrenador",
            value: "",
            id: "",
        });

        listaEntrenadores.forEach(function (row) {

            options.push({
                label: row.nombre + " " + row.paterno + " " + row.materno + " - C.I.: " + row.numero_documento,
                value: row.id_persona,
                id: row.id_persona,
            });


        });

        selectEntrenador.setChoices(options, "value", "label", true);

        selectEntrenador.setChoiceByValue("");

    }



    function llenarFiltros() {


        let optionsSucursal = [];
        // placeholder
        optionsSucursal.push({
            label: "Seleccione una Sucursal",
            value: "",
            id: "",
        });

        listaSucursales.forEach(function (row) {

            optionsSucursal.push({
                label: row.nombre_sucursal,
                value: row.id_sucursal,
                id: row.id_sucursal,
            });


        });

        filtroSucursal.setChoices(optionsSucursal, "value", "label", true);

        filtroSucursal.setChoiceByValue("");




        let optionsCategoria = [];
        // placeholder
        optionsCategoria.push({
            label: "Seleccione una Categoría",
            value: "",
            id: "",
        });

        listaCategorias.forEach(function (row) {

            optionsCategoria.push({
                label: row.nombre_categoria,
                value: row.id_categoria,
                id: row.id_categoria,
            });


        });

        filtroCategoria.setChoices(optionsCategoria, "value", "label", true);

        filtroCategoria.setChoiceByValue("");


    }






    let dataScroll = {
        'page': 1,
        'size': 15,
        'search': '',
        '_token': crfToken,
    }


    let scrollGrupoEntrenamiento = $('#tbodyListaGrupo').scrollPagination({
        'url': baseUrl + '/admin/grupos-entrenamientos-listar', // the url you are fetching the results
        'method': 'post',
        'data': getDataFilter(),
        'dataTemplateCallback': rowHtml,
        'elementCountSelector': '#contadorListaGrupo',
        'elementCountTemplate': '<span  class=""> Listando <b> {count}  </b>elementos de <b> {total} </b> encontrados </span>',
        'loading': '#loadingGrupo',
        'scroller': "#containerListaGrupo",
        'loadingText': `<div  class=" text-center"><span class="loaderHttp"></span><span class="text-muted">Cargando...</span></div>`,
        'loadingNomoreText': '<h6 class="text-danger">No se encontraron más Resultados</h6>',

    });


    $("#filtroSucursal,#filtroCategoria")
        .on("change", function (e) {
            e.preventDefault();

            scrollGrupoEntrenamiento.resetScrollPagination(getDataFilter());

        })


    let timer = null;
    $("#inputBuscarGrupo")
        .on("input", function () {

            clearTimeout(timer);

            timer = setTimeout(() => {

                scrollGrupoEntrenamiento.resetScrollPagination(getDataFilter());

            }, 500);

        });

    function getDataFilter() {


        dataScroll.id_categoria = $("#filtroCategoria").val();
        dataScroll.id_sucursal = $("#filtroSucursal").val();

        dataScroll.search = $("#inputBuscarGrupo").val();

        return dataScroll;
    }









    function rowHtml(item, opacity = 0) {


        let html =/*html*/ `<tr data-id="${item.id_grupo_entrenamiento}" style='opacity:${opacity};-moz-opacity: ${opacity};filter: alpha(opacity=${opacity});'>

            <td class="nombre_grupo">
                ${item.nombre_grupo} ${item.central == 1 ? '<span class="badge badge-soft-success">Central</span>' : ""}
            </td>
            <td class="nombre_sucursal">
                ${item.nombre_sucursal || ""}
            </td>
            <td class="descripcion_grupo">
                ${item.descripcion_grupo || ""}
            </td>
            <td class="nombre_categoria">
                ${item.nombre_categoria || ""}
            </td>
            <td class="entrenador">
                ${item.nombre || ""}  ${item.paterno || ""}  ${item.materno || ""}
            </td>
            <td class="gestion">
                ${item.gestion || ""}
            </td>
            <td class="fecha_creacion">
                ${fomatDate(item.fecha_creacion || "")}
            </td>
            <td class="fecha_fin">
                ${fomatDate(item.fecha_fin || "")}
            </td>
            <td class="dia">
                ${item.dia}
            </td>


            <td class="hora">
                ${item.hora_inicio || ""}
                <br>
                ${item.hora_fin || ""}
            </td>

            <td class="dia_extra">
                ${item.dia_extra || ""}
            </td>
            <td class="hora_inicio_dia_extra">
                ${item.hora_inicio_dia_extra || ""}
            </td>
            <td class="turno">
                ${item.turno}
            </td>
            <td class="estado">

                <div class="form-check form-switch">
                    <input class="form-check-input switch-status-btn" type="checkbox" role="switch"  ${item.estado_grupo == "ACTIVO" ? "checked" : ""} >
                </div>
            </td>

            <td>
                <ul class="list-inline hstack gap-2 mb-0">

                    <li class="list-inline-item edit" >
                        <a href="javascript:void(0);" class="text-muted hover-warning d-inline-block edit-item-btn" tooltip="tooltip" data-bs-placement="top" title="Editar Sucursal">
                            <i class="ri-pencil-line fs-16"></i>
                        </a>
                    </li>
                    <li class="list-inline-item edit" >
                        <a href="javascript:void(0);" class="text-muted hover-danger d-inline-block remove-item-btn" tooltip="tooltip" data-bs-placement="top" title="Eliminar Sucursal">
                            <i class="ri-delete-bin-2-line fs-16"></i>
                        </a>
                    </li>

                </ul>
            </td>
        </tr>`;


        return html;

    }






    $("#tbodyListaGrupo")
        .on("click", ".view-item-btn", function (e) {
            e.preventDefault();

            let itemId = $(this).parents("tr").data("id");

            esqueletonLoader();

            $.get(baseUrl + '/admin/grupos-entrenamientos/' + itemId)
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


            $("#add-btn").text("Actualizar Grupo de Entrenamiento");

            $("#tituloModal").text("Actualizar Grupo de Entrenamiento");

            $.get(baseUrl + '/admin/grupos-entrenamientos/' + itemId)
                .done(function (res) {


                    $("#action").val("actualizar");

                    for (const key in res.data) {
                        if (Object.hasOwnProperty.call(res.data, key)) {
                            const element = res.data[key];

                            $("#formGrupoEntrenamiento #" + key).val(element);

                        }
                    }

                    $(`#formGrupoEntrenamiento input[name="turno"][value="${res.data.turno}"]`).prop("checked", true);

                    selectCategoria.setChoiceByValue(res.data.id_categoria);
                    selectSucursal.setChoiceByValue(res.data.id_sucursal_fk);
                    selectEntrenador.setChoiceByValue(res.data.id_entrenador);

                    let diasArray = JSON.parse(res.data.dias_entrenamiento || "[]");
                    let diaExtraArray = JSON.parse(res.data.dias_extra_entrenamiento || "[]");

                    if (diasArray.length > 0) {
                        diasArray.forEach(function (dia) {
                            $(`#check-dias-${dia}`).prop("checked", true);
                        })
                    }

                    if (diaExtraArray.length > 0) {
                        diaExtraArray.forEach(function (dia) {
                            $(`#check-dia-extra-${dia}`).prop("checked", true);
                        })
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

            $.post(baseUrl + '/admin/grupos-entrenamientos/' + itemId, { _token: crfToken, _method: 'PATCH', estado_grupo: estado })
                .done(function (data) {

                    notification(data.message, "Grupo Actualizado")

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

            let nombre = $(this).closest("tr").find(".nombre_grupo").text();

            let btn = $(this);


            Swal.fire({
                title: '¿Estas seguro de eliminar el grupo de Entrenamiento: ' + nombre + '?',
                text: "No podras revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#5e72e4',
                cancelButtonColor: '#f5365c',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.post(baseUrl + '/admin/grupos-entrenamientos/' + itemId, { _token: crfToken, _method: 'DELETE' })
                        .done(function (data) {

                            if (data.success) {
                                notification(data.message, "Grupo de Entrenamiento...")

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






    $("#formGrupoEntrenamiento")
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
                crearGrupoEntrenamiento(data);
                return;
            }

            if (accion == "actualizar") {

                actualizarGrupoEntrenamiento(data);

                return;
            }


        })




    function limpiarForm() {
        $("#id_grupo_entrenamiento").val("");
        $("#formGrupoEntrenamiento").removeClass('was-validated');
        $("#formGrupoEntrenamiento")[0].reset();
        $("#imagen").val("");
        $("#action").val("crear");
        $("#add-btn").text("Registrar Grupo de Entrenamiento");
        $("#tituloModal").text("Registrar Grupo de Entrenamiento");

        llenarSelectCategoria();
        llenarSelectSucursal();
        llenarSelectEntrenador();
    }

    $("#cancel-btn,#close-modal").click(function (e) {
        // e.preventDefault();
        limpiarForm();
    })

    function crearGrupoEntrenamiento(data) {

        $("#add-btn").prop("disabled", true).addClass("mdi-spin mdi-loading");

        $.post(baseUrl + '/admin/grupos-entrenamientos', data)
            .done(function (data) {

                if (data.success) {
                    $("#cancel-btn").trigger("click");
                    notification(data.message, "Grupo de Entrenamiento Registrado Correctamente")
                    let row = rowHtml(data.data, 1);
                    $("#tbodyListaGrupo").prepend(row);
                    $("#formGrupoEntrenamiento").removeClass('was-validated');
                }


            })
            .fail(function (jqXHR) {


                processError(jqXHR);

            })
            .always(function () {

                $("#add-btn").prop("disabled", false).removeClass("mdi-spin mdi-loading");

            })


    }

    function actualizarGrupoEntrenamiento(data) {

        $("#add-btn").prop("disabled", true).addClass("mdi-spin mdi-loading");

        data.push({ name: "_method", value: "PUT" });

        $.post(baseUrl + '/admin/grupos-entrenamientos/' + $("#id_grupo_entrenamiento").val(), data)
            .done(function (data) {

                if (data.success) {
                    $("#cancel-btn").trigger("click");

                    notification(data.message, "Grupo de Entrenamiento Actualizado Correctamente")
                    let row = rowHtml(data.data, 1);
                    $("#tbodyListaGrupo").find(`tr[data-id="${data.data.id_grupo_entrenamiento}"]`).replaceWith(row);

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








$(function () {

    // ***************************************************** buscador personas ajax
    // let choicesConfigAjax = {
    //     placeholder: 'Buscar Persona...',
    //     noResultsText: 'No se encontraron resultados',
    //     removeItemButton: true,
    //     position: 'bottom',
    //     noChoicesText: 'Escriba almenos 3 caracteres para comenzar busqueda',
    //     searchPlaceholderValue: 'Buscar por C.I o Nombre...',

    // };

    // let timerPersona = null;

    // let elemet = document.querySelector('select#id_entrenador');
    // let selectPersona = new Choices(elemet, choicesConfigAjax);

    // elemet.addEventListener('search', function (e) {

    //     clearTimeout(timerPersona);

    //     if (e.detail.value.length < 3) {
    //         selectPersona.clearChoices();
    //         selectPersona.setChoices([{ value: '', label: 'Escriba almenos 4 caracteres para comenzar busqueda' }], 'value', 'label', false);
    //         return;
    //     }
    //     selectPersona.clearChoices();

    //     selectPersona.setChoices([{ value: '', label: 'Buscando...' }], 'value', 'label', false);

    //     timerPersona = setTimeout(function () {


    //         if (e.detail.value.length > 3) {

    //             $.post(baseUrl + '/admin/persona-buscar', { search: e.detail.value, tipo_persona: 2, _token: crfToken })
    //                 .done(function (data) {
    //                     // console.log(res);
    //                     selectPersona.clearChoices();

    //                     selectPersona.setChoices(data, 'id', 'text', false);
    //                 })
    //                 .fail(function () {
    //                     processError(jqXHR);
    //                 });

    //         } else {
    //             selectPersona.clearChoices();
    //         }

    //     }, 500);


    // });
})
