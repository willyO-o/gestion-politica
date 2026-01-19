$(function () {

    'use strict';

    const apiWhastapp = "https://api.whatsapp.com/send?phone=591";

    const defaultImage = baseUrl + "/assets/images/users/user-dummy-img.jpg";

    const estadoInscripcion = {
        "PENDIENTE": "warning",
        "INSCRITO": "success",
        "CONCLUIDO": "danger",
        "RETIRADO": "danger",
    }




    let listaSucursales = [];
    let listaGrupoEntrenamiento = [];
    let listaCaracteristicas = [];


    $.get(baseUrl + '/admin/seguimientos-caracteristicas-atributo')
        .done(function (data) {

            listaCaracteristicas = data;

        })
        .fail(function (jqXHR) {
            processError(jqXHR);
        })

    getParametros()
    function getParametros(tipo = "all") {

        $.post(baseUrl + '/admin/inscripciones-parametrico', { _token: crfToken, tipo: tipo })
            .done(function (data) {


                if (tipo == "all" || tipo == "sucursal") {
                    listaSucursales = data.data.sucursal;
                    generateSelectSucursal();

                }

                if (tipo == "all" || tipo == "grupo") {
                    listaGrupoEntrenamiento = data.data.grupo;

                }


            })
            .fail(function (jqXHR) {
                processError(jqXHR);

            })
    }



    function generateSelectSucursal() {

        selectSucursales.clearChoices();

        let optionsSucursal = [];
        // placeholder
        optionsSucursal.push({
            label: "Seleccione Sucursal",
            value: "",
            id: "",
        });

        listaSucursales.forEach((item) => {
            optionsSucursal.push({
                label: item.nombre_sucursal,
                value: item.id_sucursal,
                id: item.id_sucursal,
            });
        });

        selectSucursales.setChoices(optionsSucursal, "value", "label", true);

        selectSucursales.setChoiceByValue("");

    }

    function generateSelectGrupo(idSucursal) {

        selectGrupos.clearChoices();

        let optionsGrupoEntrenamiento = [];
        // placeholder
        optionsGrupoEntrenamiento.push({
            label: "Seleccione Grupo de Entrenamiento",
            value: "",
            id: "",
            disabled: true,
        });


        listaGrupoEntrenamiento.forEach((item) => {
            if (Number(item.id_sucursal_fk) == Number(idSucursal)) {
                optionsGrupoEntrenamiento.push({
                    label: item.gestion + " - " + item.nombre_categoria + " - TURNO " + item.turno + " [" + item.dia + "]",
                    value: item.id_grupo_entrenamiento,
                    id: item.id_grupo_entrenamiento,
                });
            }

        });


        if (optionsGrupoEntrenamiento.length == 1) {
            optionsGrupoEntrenamiento = [];
            optionsGrupoEntrenamiento.push({
                label: "Por favor seleccione una sucursal para continuar...",
                value: "",
                id: "",
                disabled: true,
            });
        }


        selectGrupos.setChoices(optionsGrupoEntrenamiento, "value", "label", true);

        selectGrupos.setChoiceByValue("");

    }


    let dataScroll = {
        'page': 1,
        'size': 10,
        'search': '',
        '_token': crfToken,
    }


    let scrollPersonal = $('#tbodyListaSeguimiento').scrollPagination({
        'url': baseUrl + '/admin/seguimientos-listar', // the url you are fetching the results
        'method': 'post',
        'data': getDataFilter(),
        'dataTemplateCallback': rowHtml,
        'elementCountSelector': '#contadorListaPersonal',
        'elementCountTemplate': '<span  class=""> Listando <b> {count}  </b>elementos de <b> {total} </b> encontrados </span>',
        'loading': '#loadingPersonal',
        'scroller': "#containerListaSeguimiento",
        'loadingText': `<div  class=" text-center"><span class="loaderHttp"></span><span class="text-muted">Cargando...</span></div>`,
        'loadingNomoreText': '<h6 class="text-danger">No se encontraron más Resultados</h6>',

    });


    $("#filtroSelectTipoPersona,#filtroEstadoPersona")
        .on("change", function (e) {
            e.preventDefault();


            scrollPersonal.resetScrollPagination(getDataFilter());

        })

    let timer = null;
    $("#inputBuscarPersona")
        .on("input", function () {

            clearTimeout(timer);

            timer = setTimeout(() => {

                scrollPersonal.resetScrollPagination(getDataFilter());

            }, 500);

        });

    function getDataFilter() {


        dataScroll.tipo_persona = $("#filtroSelectTipoPersona").val();
        dataScroll.estado_inscripcion = $("#filtroEstadoPersona").val();

        dataScroll.search = $("#inputBuscarPersona").val();

        return dataScroll;
    }

    let imagenBase64 = null;

    let instanciaCroppie = null;
    let configCoppie = {
        viewport: {
            width: 300, // Ancho mínimo del área de recorte
            height: 300, // Altura mínima del área de recorte
            type: 'square' // Tipo de área de recorte (cuadrada)

        },
        boundary: {
            width: 400, // Ancho máximo del contenedor
            height: 400, // Altura máxima del contenedor

        }
    };

    let instanciaCroppieUpdate = null;

    $("#imagen")
        .on("change", function (e) {
            e.preventDefault();


            let files = e.target.files;

            if (files.length > 0) {


                //recortar en un modal sweetalert

                Swal.fire({
                    title: 'Recortar Imagen',
                    html: '<div id="croppieContainer"></div>',
                    showCancelButton: true,
                    confirmButtonText: 'Recortar',
                    cancelButtonText: 'Cancelar',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {

                        return instanciaCroppie.result('base64', 'viewport', 'png', 0.9).then(function (result) {
                            return result;
                        });
                    },
                    didOpen: function () {

                        let reader = new FileReader();

                        reader.onload = function (event) {
                            let imageUrl = event.target.result;
                            $('#croppieContainer').html('<img src="' + imageUrl + '">');
                            instanciaCroppie = new Croppie($('#croppieContainer img')[0], configCoppie);
                        };

                        reader.readAsDataURL(files[0]);

                    },
                    didClose: function () {

                    }
                }).then(function (result) {
                    if (result.isConfirmed) {

                        if (!result.value || !result.value.match(/^data:image\/(png|jpg|jpeg);base64,/)) {
                            Swal.showValidationMessage('No se pudo recortar la imagen, Intente nuevamente')

                            return;
                        }


                        $("#previev").attr("src", result.value);

                    }

                });

            } else {
                instanciaCroppie.destroy();
                instanciaCroppie = null;
                $('#croppieContainer').html('');
                $("#previev").attr("src", defaultImage);

            }

        })








    $("#showModal").on("click", ".btn-clear-photo", function (e) {
        e.preventDefault();

        if (instanciaCroppie) {
            instanciaCroppie.destroy();
            instanciaCroppie = null;
            $('#croppieContainer').html('');
            $("#previev").attr("src", defaultImage);
            return;
        }

    })


    function rowHtml(item, opacity = 0) {


        let html =/*html*/ `<tr data-id="${item.id_inscripcion}" style='opacity:${opacity};-moz-opacity: ${opacity};filter: alpha(opacity=${opacity});'>

            <td class="numero">
                ${item.numero || ""}
            </td>

            <td class="datosPersonales">

                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-2">
                        ${item.foto ? `<a class="image-popup cursor-pointer  "> <img src="${baseUrl}/storage/${item.foto}" alt="" class="avatar-lg   rounded photo-student"> </a>` : `<img src="${baseUrl}/assets/images/users/user-dummy-img.jpg" alt="" class="avatar-lg  ">`}
                    </div>
                    <div class="flex-grow-1">
                                <h5 class="fs-14 mb-1">

                                    <a href="javascript:void(0)" class="text-dark nombre">${item.nombre} ${item.paterno || ""} ${item.materno || ""} </a>

                                </h5>
                                <p class="text-muted mb-0">C.I.: <span class="fw-medium"> ${(item.numero_documento)} </span></p>
                                <p class="text-muted mb-0">Fecha nac: <span class="fw-medium"> ${fomatDate(item.fecha_nacimiento)} / ${calcularEdad(item.fecha_nacimiento)} </span></p>
                                <p class="text-muted mb-0">Genero: <span class="fw-medium"> ${item.genero || ""} </span></p>
                                <p class="text-muted mb-0">Celular: <span class="fw-medium"> ${item.celular || "-"} </span></p>

                    </div>
                </div>

            </td>




            <td class="grupo break-word">
                <div class="" style="max-width:150px;">
                    ${item.gestion || ""} -
                    ${item.nombre_categoria || ""}
                    TURNO ${item.turno || ""}
                    [${item.dia || ""}]

                </div>
            </td>
            <td class="sucursal break-word">
                <div class="" style="max-width:150px;">
                    ${item.nombre_sucursal || ""}

                </div>
            </td>

            <td class="tipoPersonal">
                <span class="badge badge-soft-${estadoInscripcion[item.estado_inscripcion] || "primary"}">${item.estado_inscripcion || ""}</span>
            </td>

            <td class="seguimientos">
                ${getValoracionesHtml(item)}
            </td>

            <td>
                <ul class="list-inline hstack gap-2 mb-0">
                    <li class="list-inline-item edit" >
                        <a href="javascript:void(0);" class="text-info hover-secondary d-inline-block view-item-btn" tooltip="tooltip" data-bs-placement="top" title="Ver Detalles de Inscripción">
                            <i class="mdi mdi-eye-outline mdi-20px"></i>
                        </a>
                    </li>

                </ul>

                <ul class="list-inline hstack gap-2 mb-0">

                    ${item.estado_inscripcion != "CONCLUIDO" ?
                ` <li class="list-inline-item edit" >
                            <a type="button" class="text-secondary hover-secondary d-inline-block add-seguimiento-btn" tooltip="tooltip" data-bs-placement="top" title="Agregar Seguimiento">
                                <i class=" mdi mdi-table-large-plus mdi-20px"></i>
                            </a>
                        </li>`:
                ""
            }

                    <li class="list-inline-item edit" >
                            <a type="button" class="text-secondary hover-info d-inline-block list-seguimiento-btn" tooltip="tooltip" data-bs-placement="top" title="Listar Seguimientos">
                                <i class=" mdi mdi-clipboard-list-outline mdi-20px"></i>
                            </a>
                        </li>


                </ul>
            </td>
        </tr>`;


        return html;

    }


    function getValoracionesHtml(row) {

        let html = "";

        const valoraciones = JSON.parse(row.valoraciones || "[]");
        const cantidadValoraciones = row.cantidad_valoraciones || 0;

        if (cantidadValoraciones == 0 || valoraciones.length == 0) {
            return `<span class="badge badge-soft-danger">Sin Seguimientos</span>`;
        }

        valoraciones.forEach((item, index) => {

            html += `<p class="mb-0 text-muted"> ${index + 1}. <a type="button" class=" btn-view-seguimiento " data-seguimiento="${item.id_valoracion}"> <b> ${item.numero_valoracion || ""} <span class="text-muted"> <i class="mdi mdi-calendar-clock-outline"></i> ${fomatDate(item.fecha_valoracion)} </span></b> </a> </p>`;

        })

        html += cantidadValoraciones > 5 ? `<p  class="  hover-secondary mb-0  "> <span class="badge badge-soft-info">+${cantidadValoraciones - 5} </span> </p>` : "";


        return html;


    }


    // $("#modalDetalle").modal("show");


    $("#tablaInscripcion")
        .on("click", ".view-item-btn", function (e) {
            e.preventDefault();

            let itemId = $(this).parents("tr").data("id");

            esqueletonLoader();

            $.get(baseUrl + '/admin/inscripciones/' + itemId)
                .done(function (data) {


                    detallePersona(data.data);

                    $("#modalDetalle").modal("show");

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

            $.post(baseUrl + '/personas/' + itemId, { _token: crfToken, _method: 'PATCH', estado_persona: estado })
                .done(function (data) {

                    notification(data.message, "Persona Actualizada")

                })
                .fail(function (jqXHR) {

                    btn.prop("checked", !btn.prop("checked"));
                    processError(jqXHR);
                })

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
        .on("click", ".add-seguimiento-btn", function (e) {
            e.preventDefault();

            const idInscripcion = $(this).closest("tr").data("id");

            const numeroInscripcion = $(this).closest("tr").find(".numero").text()

            const nombrePersona = $(this).closest("tr").find(".nombre").text()
            const nombreGrupoEntrenamiento = $(this).closest("tr").find(".grupo").text()
            const nombreSucursal = $(this).closest("tr").find(".sucursal").text()

            const textoConcatenado = `<b class="text-danger">${numeroInscripcion.trim()} </b>  - <b class="">${nombrePersona.trim()}</b>  -  ${nombreGrupoEntrenamiento.trim()}  - SUC.  ${nombreSucursal.trim()} `;

            const datosInscripcion = textoConcatenado.replace(/\s\s+/g, ' ').trim()

            $("#tituloModalPago").text(numeroInscripcion);
            $("#datosInscripcionPago").html(datosInscripcion);

            $("#id_inscripcion_pago").val(idInscripcion);

            let fotoEstudiante = $(this).closest("tr").find(".photo-student").attr("src");

            $("#fotoEstudiante").attr("src", fotoEstudiante);
            generateHtmlValoracionTabla();
            $("#modalAddSeguimiento").modal("show");


            $(this).removeData();


        })
        .on("click", ".list-seguimiento-btn", function (e) {
            e.preventDefault();

            const idInscripcion = $(this).closest("tr").data("id");

            const numeroInscripcion = $(this).closest("tr").find(".numero").text()

            const grupo = $(this).closest("tr").find(".grupo").text()
            const sucursal = $(this).closest("tr").find(".sucursal").text()
            const textoConcatenado = `<p class="mb-1" > Nro.: <b class="text-danger"> ${numeroInscripcion.trim()}</b> </p> <p class="mb-1" >${grupo.trim()}</p> <p class="mb-1"> Sucursal: ${sucursal}</p>`;
            const datosInscripcion = textoConcatenado.replace(/\s\s+/g, ' ').trim()

            const datosInscrito = $(this).closest("tr").find(".datosPersonales").html();

            $("#tituloModalListadoSeguimiento").text(numeroInscripcion);
            $("#datosSeguimientoGrupo").html(datosInscripcion);
            $("#datosSeguimientosInscrito").html(datosInscrito);

            $("#containerValoracion").html("");
            $("#id_inscripcion_seguimiento").val(idInscripcion);

            cargarSeguimientos(idInscripcion);

            $("#modalListadoSeguimientos").modal("show");


        })



    function detallePersona(datos) {
        let html = /*html*/`

        <div class="row">
            <div class="col-md-6 ">
                <div class="card ">
                        <div class="card-body text-center">

                            <h5 class=" mb-1 ">
                                Detalles de Inscripción
                           </h5>
                            <p class="text-muted ">Nro. ${datos.numero || ""}</p>


                        </div>
                        <div class="card-body">
                            <h6 class="text-muted text-uppercase fw-semibold mb-3">Grupo de Entrenamiento : <br>  ${datos.gestion || ""} -
                            ${datos.nombre_categoria || ""}
                            TURNO ${datos.turno || ""}
                            [${datos.dia || ""}] </h6>
                            <p class="text-muted mb-4">Observaciones: ${datos.observacion || ""}</p>
                            <p class="text-muted mb-4">Detalles: ${datos.descripcion || ""} </p>

                            <div class="table-responsive table-card">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="fw-medium " scope="row"><span
                                                    class=""> Fecha Inicio / Fin </span> </td>
                                            <td class=""><span
                                                    class=""> ${fomatDate(datos.fecha_inicio)} al  ${fomatDate(datos.fecha_fin)} </span> </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium " scope="row"><span
                                                    class=""> Tipo Inscripción </span> </td>
                                            <td class=""> <span class="">
                                                    ${datos.tipo_inscripcion || ""} </span> </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium " scope="row"><span
                                                    class=""> Matricula </span> </td>
                                            <td class=""> <span class="">
                                            ${numeroMonto(datos.monto_inscripcion || "")} Bs.</span> </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium " scope="row"><span
                                                    class=""> Estado Inscripcion </span> </td>
                                            <td class=""> <span class="">
                                                    ${datos.estado_inscripcion || ""} </span> </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium " scope="row"><span
                                                    class=""> Sucursal </span> </td>
                                            <td class=""> <span class="">
                                                    ${datos.nombre_sucursal || ""} </span> </td>
                                        </tr>

                                        <tr>
                                            <td class="fw-medium " scope="row"><span
                                                    class=""> Fecha de Registro </span> </td>
                                            <td class=""><span class="">
                                            ${fomatDate(datos.created_at, "fh")} </span> </td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        <div class="col-md-6 ">

        <div class="card" >
            <div class="card-body text-center">
                <h5 class=" mb-1 ">
                Datos del Inscrito
        </h5>
                <div class="position-relative d-inline-block">
                    <img src="${baseUrl}${datos.foto ? "/storage/" + datos.foto : "/assets/images/users/user-dummy-img.jpg"} " alt=""
                        class="avatar-lg rounded img-thumbnail shadow">
                    <span class="contact-active position-absolute rounded bg-success"><span
                            class="visually-hidden"></span>
                </div>
                <h5 class="mt-4 mb-1">${datos.nombre} ${datos.paterno || ""} ${datos.materno || ""}</h5>
                <p class="text-muted">${datos.tipo_persona}</p>

                <ul class="list-inline mb-0">
                    <li class="list-inline-item avatar-xs">
                        <a href="${apiWhastapp}${datos.celular}" class="avatar-title bg-soft-success text-success fs-15 rounded ${datos.celular ? "" : "d-none"}" target="_blank" ${datos.celular ? "" : "disabled"}>
                            <i class="ri-whatsapp-line"></i>

                        </a>
                    </li>
                    <li class="list-inline-item avatar-xs">
                        <a href="mailto:${datos.correo}" class="avatar-title bg-soft-danger text-danger fs-15 rounded ${datos.correo ? "" : "d-none"}">
                            <i class="ri-mail-line"></i>
                        </a>
                    </li>
                    <li class="list-inline-item avatar-xs">
                        <a href="tel:${datos.celular}" class="avatar-title bg-soft-info text-info fs-15 rounded ${datos.celular ? "" : "d-none"}">
                        <i class="ri-phone-line"></i>

                        </a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <h6 class="text-muted text-uppercase fw-semibold mb-3">Información Personal </h6>
                <p class="text-muted mb-4"><b>Apoderado: </b> ${datos.apoderado || "-"}</p>
                <div class="table-responsive table-card">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <td class="fw-medium" scope="row">Nro. C.I.</td>
                                <td> ${datos.numero_documento || ""}</td>
                            </tr>
                            <tr>
                                <td class="fw-medium" scope="row">Celular</td>
                                <td> ${datos.celular || ""}</td>
                            </tr>
                            <tr>
                                <td class="fw-medium" scope="row">Correo</td>
                                <td>${datos.correo || ""} </td>
                            </tr>
                            <tr>
                                <td class="fw-medium" scope="row">Genero</td>
                                <td> ${datos.genero || ""}</td>
                            </tr>
                            <tr>
                                <td class="fw-medium" scope="row">Fecha Nacimiento / Edad</td>
                                <td> ${fomatDate(datos.fecha_nacimiento) || ""} / ${calcularEdad(datos.fecha_nacimiento)} </td>
                            </tr>
                            <tr>
                                <td class="fw-medium" scope="row">Dirección Domicilio</td>
                                <td>${datos.direccion || ""} </td>
                            </tr>
                            <tr>
                                <td class="fw-medium" scope="row">Lugar de Nacimiento</td>
                                <td>${datos.lugar_nacimiento || ""} </td>
                            </tr>
                            <tr>
                                <td class="fw-medium" scope="row">Fecha de Registro</td>
                                <td>${fomatDate(datos.created_at || "", "fh")} </td>
                            </tr>

                            <tr>
                                <td class="fw-medium" scope="row">Estado Inscripción</td>
                                <td>
                                    <span class="badge badge-soft-primary">${datos.estado_persona || ""}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>


        </div>`;

        setTimeout(() => {
            $("#detallePersona").fadeOut("fast", function () {
                $(this).html(html);
                $(this).fadeIn("fast");
            });
        }, 1000);

    }



    function esqueletonLoader() {

        let html = $("#placeholderDetalles").html();

        $("#detallePersona").html(html);
    }







    let choicesConfigAjax = {
        placeholder: 'Buscar Persona...',
        noResultsText: 'No se encontraron resultados',
        removeItemButton: true,
        position: 'bottom',
        noChoicesText: 'Escriba almenos 4 caracteres para comenzar busqueda',
        searchPlaceholderValue: 'Buscar por C.I o Nombre...',
        searchResultLimit: 10,

    };


    let timerselectPersona = null;


    let elemet = document.querySelector('select#id_persona_inscribir');
    let selectPersona = new Choices(elemet, choicesConfigAjax);

    elemet.addEventListener('search', function (e) {

        clearTimeout(timerselectPersona);


        if (e.detail.value.length < 4) {
            selectPersona.clearChoices();
            selectPersona.setChoices([{ value: '', label: 'Escriba almenos 4 caracteres para comenzar busqueda', disabled: true }], 'value', 'label', false);
            return;
        }

        selectPersona.clearChoices();
        selectPersona.setChoices([{ value: '', label: 'Buscando...', disabled: true }], 'value', 'label', false);

        timerselectPersona = setTimeout(function () {


            if (e.detail.value.length > 3) {

                $.post(baseUrl + '/admin/persona-buscar', { search: e.detail.value, _token: crfToken })
                    .done(function (data) {
                        selectPersona.clearChoices();

                        selectPersona.setChoices(data, 'id', 'text', false);
                    })
                    .fail(function () {
                        processError(jqXHR);
                    });

            } else {
                selectPersona.clearChoices();
            }
        }, 500);


    });

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

    let selectSucursales = new Choices("#id_sucursal_fk", configChoices);
    let selectGrupos = new Choices("#id_grupo_entrenamiento", configChoices);


    $("#showModal")
        .on("change", "#id_sucursal_fk", function (e) {

            e.preventDefault();

            $("#monto_inscripcion").val("");

            let idSucursal = Number($(this).val());

            generateSelectGrupo(idSucursal);

            $(this).removeData();

        })
        .on("change", "#id_grupo_entrenamiento", function (e) {

            e.preventDefault();

            $("#monto_inscripcion").val("");

            let idGrupo = Number($(this).val());

            let grupo = listaGrupoEntrenamiento.find(item => Number(item.id_grupo_entrenamiento) == idGrupo);

            if (grupo) {
                $("#monto_inscripcion").val(grupo.precio);
            }

            $(this).removeData();

        })



    $("#checkNuevaPersona")
        .on("change", function (e) {

            const checked = $(this).prop("checked");
            selectPersona.clearChoices();
            selectPersona.setChoices([{ value: '', label: '', disabled: true }], 'value', 'label', false);
            selectPersona.setChoiceByValue("");

            if (checked == false) {


                selectPersona.enable();
                $("#fieldSetPersona").prop("disabled", true);
                $("#btn-tab-persona").hide();

                return;
            }

            selectPersona.disable();

            $("#btn-tab-persona").show();
            $("#btn-tab-persona").tab("show");
            $("#fieldSetPersona").prop("disabled", false);


        })





    function htmlSeguimientos(listadoPagos) {


        let html = "";

        if (listadoPagos.length == 0) {
            html = /*html*/ `<tr>
                    <td colspan="100%" class="text-center py-4" id="loadingPagosInscripcion">
                        <span class="text-danger text-center">Sin Seguimientos Registrados...</span>
                    </td>
                </tr>`;

            $("#tbodyListaSeguimientos").html(html);

        };

        listadoPagos.forEach((item, index) => {



            html +=/*html*/ `<tr data-id="${item.id_valoracion}"  class="trSeguimiento">

                <td class="numero">
                    ${index + 1}
                </td>
                <td class="codigo">
                    ${item.numero_valoracion || ""}
                </td>
                <td class="fecha">
                    ${fomatDate(item.fecha_valoracion)}
                </td>
                <td class="puesto">
                    ${item.puesto || ""}
                </td>
                <td class="dorsal">
                    ${item.dorsal || ""}
                </td>
                <td class="altura">
                    ${item.altura ? item.altura + " m." : ""}
                </td>
                <td class="peso">
                    ${item.peso ? item.peso + " Kg." : ""}
                </td>
                <td class="pierna">
                    ${item.pierna || ""}
                </td>


                <td>
                    <ul class="list-inline hstack gap-2 mb-0">

                        <li class="list-inline-item " >
                                        <a href="javascript:void(0)" class="text-info hover-info  d-inline-block view-seguimiento-btn" tooltip="tooltip" data-bs-placement="top" title="Editar Pago">
                                            <i class="mdi mdi-eye-outline mdi-20px"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="text-danger hover-danger  d-inline-block pdf-seguimiento" tooltip="tooltip" data-bs-placement="top" title="Editar Pago">
                                            <i class="mdi mdi-file-pdf-box mdi-20px"></i>
                                        </a>
                        </li>


                    </ul>

                </td>
            </tr>`;


        })

        $("#tbodyListaSeguimientos").html(html);

    }




    ///***********************************            SEGUIMIENTOS              */


    $("#formSeguimiento")
        .submit(async function (e) {
            e.preventDefault();

            let form = $(this);


            form.addClass('was-validated');

            if (form[0].checkValidity() === false && validarValoraciones() === false) {
                e.stopPropagation();
                return false;
            }

            let accion = $("#actionSeguimiento").val();

            const mensaje = accion == "registrar" ? "¿Estas seguro de Registrar El Seguimiento ?" : "¿Estas seguro de actualizar el Seguimiento?";

            const confimar = await confirmarEnvio("Si, " + accion.toUpperCase(), mensaje);

            if (confimar == false) {
                return;
            }


            let datos = $(this).serializeArray();
            datos.push({ name: "_token", value: crfToken });


            if (accion == "registrar") {

                crearSeguimiento(datos);
                return;
            }

            if (accion == "actualizar") {

                datos.push({ name: "_method", value: "PUT" });
                actualizarPago(datos);

                return;
            }



        })


    function crearSeguimiento(data) {

        $("#btn-add-seguimiento").prop("disabled", true).addClass("mdi-spin mdi-loading");

        $.post(baseUrl + '/admin/seguimientos', data)
            .done(function (res) {

                $("#btn-add-seguimiento").prop("disabled", false).removeClass("mdi-spin mdi-loading");

                if (res.success) {

                    notification(res.message, "Seguimiento Registrado")
                    limpiarFormSeguimiento(false);
                }

            })
            .fail(function (jqXHR) {

                $("#btn-add-seguimiento").prop("disabled", false).removeClass("mdi-spin mdi-loading");

                processError(jqXHR);

            })

    }


    function actualizarPago(data) {

        $("#btn-add-seguimiento").prop("disabled", true).addClass("mdi-spin mdi-loading");

        $.post(baseUrl + '/admin/pagos-mes-gestion/' + $("#id_pago_mes_gestion").val(), data)

            .done(function (res) {

                $("#btn-add-seguimiento").prop("disabled", false).removeClass("mdi-spin mdi-loading");

                if (res.success) {

                    notification(res.message, "Pago Actualizado")
                    limpiarFormSeguimiento(false);
                }

            })
            .fail(function (jqXHR) {

                $("#btn-add-seguimiento").prop("disabled", false).removeClass("mdi-spin mdi-loading");

                processError(jqXHR);

            })

    }


    function validarValoraciones() {

        let valid = true;


        const caracteristicas = listaCaracteristicas;

        caracteristicas.forEach((item, index) => {


            const atributosConDatos = $(`#containerCaracteristicas [name^="valoracion[${item.id_caracteristica}]"][name$="]"]`).toArray().filter(function (item) {
                return $(item).val() != "";
            })


            if (atributosConDatos.length == 0) {

                Swal.fire({
                    title: 'Error!',
                    text: `Debe ingresar almenos una valoracion en la caracteristica: ${item.caracteristica}`,
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                })

                valid = false;

                return false;

            }

        })


        return valid;

    }


    $("#btn-cancel-pay,#btn-cancel-pay-x").click(function (e) {
        e.preventDefault();
        limpiarFormSeguimiento();
    })

    function limpiarFormSeguimiento(all = true) {
        $("#formSeguimiento")[0].reset();
        $("#formSeguimiento").removeClass('was-validated');
        $("#actionSeguimiento").val("registrar");
        $("#btn-add-seguimiento span").text("Registrar Seguimiento");
        $("#actionTitleSeguimiento").text("Registrar Seguimiento");
        $("#id_pago_mes_gestion").val("");
        $("#formSeguimiento").find("#fecha_pago").prop("disabled", false);

        $("#formSeguimiento").find("select").prop("disabled", false);



        if (all) {
            $("#id_inscripcion_pago").val("");
            $("#datosInscripcionPago").text("");
        }
    }


    function cargarSeguimientos(idInscripcion) {


        loadingTable($("#tbodyListaSeguimientos"));

        let datos = {
            id_gestion: $("#filtro_gestion").val(),
            estado_pago: $("#filtro_estado_pago").val(),
        }

        $.get(baseUrl + '/admin/seguimientos-inscripcion/' + idInscripcion, datos)
            .done(function (data) {
                htmlSeguimientos(data.data);
            })
            .fail(function (jqXHR) {
                processError(jqXHR);
            })

    }

    $("#tbodyListaSeguimientos")
        .on("click", ".edit-item-btn-pago", function (e) {
            e.preventDefault();

            const idPago = $(this).closest("tr.trPago").data("id");

            $("#tbodyListaPagos").find("tr.trPago").removeClass("table-info");

            $(this).closest("tr.trPago").addClass("table-info");

            $("#actionSeguimiento").val("actualizar");
            $("#btn-add-seguimiento span").text("Actualizar Pago");
            $("#actionTitleSeguimiento").text("Actualizar Pago");
            $("#formSeguimiento").find("select").prop("disabled", true);
            $("#formSeguimiento").find("#fecha_pago").prop("disabled", true);
            $.get(baseUrl + '/admin/pagos-mes-gestion/' + idPago)

                .done(function (data) {

                    $("#id_pago_mes_gestion").val(data.data.id_pago_mes_gestion);

                    for (const key in data.data) {
                        if (Object.hasOwnProperty.call(data.data, key)) {
                            const element = data.data[key];

                            $("#formSeguimiento").find("#" + key).val(element);

                            if (key == "estado_pago") {
                                // donde coincida name y value
                                $("#formSeguimiento").find("input[name='" + key + "']").filter("[value='" + element + "']").prop("checked", true);
                            }

                        }
                    }

                })
                .fail(function (jqXHR) {
                    processError(jqXHR);

                })


            $(this).removeData();


        })
        .on("click", ".view-seguimiento-btn", function (e) {
            e.preventDefault();

            const idSeguimiento = $(this).closest("tr.trSeguimiento").data("id");

            $("#tbodyListaSeguimientos").find("tr.trSeguimiento").removeClass("table-info");
            $(this).closest("tr.trSeguimiento").addClass("table-info");

            loadingDiv($("#containerValoracion"));

            $.get(baseUrl + '/admin/seguimientos-atributo/' + idSeguimiento)
                .done(function (data) {
                    generarTablaVistaValoracion(data.data);
                })
                .fail(function (jqXHR) {
                    processError(jqXHR);
                })


            $(this).removeData();
        })
        .on("click", ".pdf-seguimiento", function (e) {
            e.preventDefault();

            const idSeguimiento = $(this).closest("tr.trSeguimiento").data("id");

            const url = baseUrl + "/admin/reporte-seguimiento/" + idSeguimiento;

            window.open( url, '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=100,width=800,height=800');

            $(this).removeData();
        })




    $("#btn-cancel-pago").click(function (e) {
        e.preventDefault();

        $("#tbodyListaPagos").find("tr.trPago").removeClass("table-info");
        limpiarFormSeguimiento(false);
    })


    $("#btnPdfSeguimientos")
        .click(function (e) {
            e.preventDefault();

            const idInscripcion = $("#id_inscripcion_seguimiento").val();

            const url = baseUrl + "/admin/seguimientos-inscripcion-pdf/" + idInscripcion;

            window.open( url, '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=100,width=800,height=800');

            $(this).removeData();
        })







    ///************************************************************   caracteristicas atributto */


    $("#containerCaracteristicas")
        .on("input", ".inputAtributo", function (e) {
            e.preventDefault();

            let valor = Number($(this).val());

            if (valor > 100) {
                $(this).val(100);
            }

            if (valor == 0) {
                $(this).val("");
            }



        });




    function generateHtmlValoracionTabla(el = "#containerCaracteristicas") {



        // console.log("car", listaCaracteristicas);

        $(el).html("");

        let html = '';



        listaCaracteristicas.forEach((item, index) => {

            html += '<table  class="table table-bordered border-dark table-sm mb-1 " >';

            const atributos = JSON.parse(item.atributos || "[]");

            html += getHeadTitle(item, atributos);
            html += getHeadTable(atributos);

            html += getBodyTable(atributos, item);

            html += getInputCaracteristica(item, atributos);


            html += '</table>';

        })

        // console.log(html);


        $(el).html(html);


    }

    function getInputCaracteristica(item, atributos) {

        let html = '';

        html += `
            <tr >
                <td  class="text-end">
                    <span class="fw-medium">Observaciones: </span>
                </td>
                <td colspan="${atributos.length}" class="text-start">
                    <textArea  class="form-control form-control-sm"  cols="1"  name="observaciones[${item.id_caracteristica}]" placeholder="Puede describir observaciones"></textArea>
                    <input type="hidden" class="" name="caracteristicas[]" value="${item.id_caracteristica}">
                </td>
            </tr>
        `;

        return html;
    }

    function getHeadTitle(item, atributos) {
        let html = '';

        html += '<thead class="table-dark">';
        html += '<tr>';
        html += `<th class="text-center " colspan=${atributos.length + 1}> <span class="mb-0 ">${item.caracteristica}</span></th>`;
        html += '</tr>';

        html += '</thead>';

        return html;

    }
    function getHeadTable(atributos) {
        let html = '';

        html += '<thead class="bg-soft-dark">';
        html += '<tr>';
        atributos.forEach((itemAtributo, indexAtributo) => {
            html += '<th class="text-center heading">';
            html += '<label class="form-check-label " for="atributo' + itemAtributo.id_atributo + '">' + itemAtributo.nombre_atributo + '</label>';
            html += '</th>';
        })
        html += '<th class="text-center heading">Media</th>';
        html += '</tr>';

        html += '</thead>';

        return html;

    }

    function getBodyTable(atributos, item) {
        let html = '';

        html += '<tbody>';
        html += '<tr class="rowTr">';
        atributos.forEach((itemAtributo, indexAtributo) => {
            html += '<td class="text-center">';
            html += `<input class="form-control form-control-sm max-length txtNumero inputAtributo" name="valoracion[${item.id_caracteristica}][${itemAtributo.id_atributo}]"  maxlength="3" type="number" value="" id="atributo${itemAtributo.id_atributo}">`;
            html += '</td>';
        })

        html += '<td class="text-center"> <input class="form-control form-control-sm text-center inputMedia"  type="text" value=""  disabled></td>';
        html += '</tr>';

        html += '</tbody>';

        return html;

    }

    $("#containerCaracteristicas")
        .on("change", ".inputAtributo", function (e) {
            e.preventDefault();

            let valor = $(this).val();

            // if (typeof valor != "number"  && valor == "") {
            //     return;
            // }

            const row = $(this).closest("tr.rowTr");

            let sum = 0;
            let cantidad = 0;

            row.find(".inputAtributo").each(function (index, item) {

                let valor = Number($(item).val());

                if (valor > 0 || valor != "") {
                    sum += valor;
                    cantidad++;
                }



            })

            let media = sum / cantidad;

            media = isNaN(media) ? "" : media.toFixed(2);

            row.find(".inputMedia").val(media);

            $(this).removeData();
        })



    function generarTablaVistaValoracion(datos) {


        let html = generateHtmlValoracionTabla("#containerValoracion");


        datos.forEach((caracteristica, index) => {

            const atributos = JSON.parse(caracteristica.atributos || "[]");

            const row = $("#containerValoracion").find(`input[name="caracteristicas[]"][value="${caracteristica.id_caracteristica}"]`).closest("table");

            row.find(`textArea[name="observaciones[${caracteristica.id_caracteristica}]"]`).val(caracteristica.observacion_valoracion || "");

            let sum = 0;

            let cantidad = 0;

            atributos.forEach((atributo, indexAtributo) => {

                row.find(`input[name="valoracion[${caracteristica.id_caracteristica}][${atributo.id_atributo_fk}]"]`).val(atributo.valor || "");

                let valor = Number(atributo.valor);

                if (valor > 0 || valor != "") {
                    sum += valor;
                    cantidad++;
                }

            })

            let media = sum / cantidad;

            media = isNaN(media) ? "" : media.toFixed(2);

            row.find(".inputMedia").val(media);


        })

        $("#containerValoracion").prop("disabled", true);
        $("#containerValoracion").find("input").css("text-align", "center");

        $("#modalValoracion").modal("show");




    }

});
