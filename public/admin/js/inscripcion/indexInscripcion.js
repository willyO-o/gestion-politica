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


    let scrollPersonal = $('#tbodyListaInscripcion').scrollPagination({
        'url': baseUrl + '/admin/inscripciones-listar', // the url you are fetching the results
        'method': 'post',
        'data': getDataFilter(),
        'dataTemplateCallback': rowHtml,
        'elementCountSelector': '#contadorListaPersonal',
        'elementCountTemplate': '<span  class=""> Listando <b> {count}  </b>elementos de <b> {total} </b> encontrados </span>',
        'loading': '#loadingPersonal',
        'scroller': "#containerListaInscripcion",
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


    $("#imagenUpdate")
        .on("change", function (e) {
            e.preventDefault();


            let filesImg = e.target.files;

            croppieUpdateInit(filesImg);


        })



    $("#btnTomarFoto")
        .on("click", function (e) {
            e.preventDefault();

            $("#btn-update-photo").prop("disabled", true);
            $("#imagenUpdate").val("");
            $("#cropieContainerUpdate").html(`<video id="video" class="placeholder" autoplay></video><br>
            <button id="capturarFoto" class="btn btn-outline-info mt-1"> <i class="ri-camera-fill align-bottom"></i> Capturar</button>
            <canvas id="canvas" width="300" height="300" class="d-none"></canvas>`);

            let video = document.getElementById('video');



            let constraints = {
                video: {
                    width: 300,
                    height: 300
                }
            };

            navigator.mediaDevices.getUserMedia(constraints)
                .then(function (mediaStream) {
                    video.srcObject = mediaStream;
                    video.onloadedmetadata = function (e) {
                        video.play();
                        $("#video").removeClass("placeholder");
                    };
                })
                .catch(function (err) {
                    console.log(err.name + ": " + err.message);
                });


        })

    $("#modalPhoto").on("click", "#capturarFoto", function (e) {
        e.preventDefault();

        let video = document.getElementById('video');

        //campturar la imagen y enviarla a croppieupdate

        let canvas = document.getElementById('canvas');

        canvas.getContext('2d').drawImage(video, 0, 0, 300, 300);

        let data = canvas.toDataURL('image/png');

        let blob = dataURLtoBlob(data);

        let file = new File([blob], "foto.png", { type: "image/png" });

        let filesImg = [file];

        croppieUpdateInit(filesImg);

    })



    function dataURLtoBlob(dataurl) {
        let parts = dataurl.split(','), // Separar en dos partes
            mime = parts[0].match(/:(.*?);/)[1], // Obtener el tipo MIME
            bstr = atob(parts[1]), // Decodificar base64
            n = bstr.length,
            u8arr = new Uint8Array(n); // Crear un array de bytes

        while (n--) {
            u8arr[n] = bstr.charCodeAt(n); // Convertir a bytes
        }

        return new Blob([u8arr], { type: mime }); // Crear el Blob
    }


    function croppieUpdateInit(filesImg) {

        if (filesImg.length > 0) {


            let updateReader = new FileReader();

            updateReader.onload = function (event) {
                let imageUrl = event.target.result;
                $('#cropieContainerUpdate').html('<img src="' + imageUrl + '">');
                instanciaCroppieUpdate = new Croppie($('#cropieContainerUpdate img')[0], configCoppie);

                // console.log(instanciaCroppieUpdate);
            }

            updateReader.readAsDataURL(filesImg[0]);


            $("#btn-update-photo").prop("disabled", false);


        } else {
            instanciaCroppieUpdate.destroy();
            instanciaCroppieUpdate = null;
            $('#cropieContainerUpdate').html(`<div class="avatar-lg p-1">
                <div class="avatar-title bg-light rounded">
                        <img src="/assets/images/users/user-dummy-img.jpg" id="previevUp"
                            class="avatar-md rounded object-cover" />
                    </div>
                </div>`);

            $("#btn-update-photo").prop("disabled", true);


        }
    }


    $("#btn-update-photo")
        .on("click", function (e) {

            e.preventDefault();

            if (!instanciaCroppieUpdate && $("#id_persona_photo").val() == "") {
                notification("Por verifique la imagen y la persona seleccionada", "No se puede actualizar la foto", "error");
                return;
            }

            instanciaCroppieUpdate.result('base64', 'viewport', 'png', 0.9).then(function (result) {

                updateFoto(result);

            });





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


    function getCropieData() {

        // verificar la instancia cropie y verificar y esta alguna imagen en el preview con pregmatch umagen base64
        if (!instanciaCroppie || !$("#previev").attr("src").match(/^data:image\/(png|jpg|jpeg);base64,/)) {

            return null;
        }

        let respuesta = $("#previev").attr("src");


        return respuesta;
    }


    function rowHtml(item, opacity = 0) {


        let html =/*html*/ `<tr data-id="${item.id_inscripcion}" style='opacity:${opacity};-moz-opacity: ${opacity};filter: alpha(opacity=${opacity});'>

            <td class="numero">
                ${item.numero || ""}
            </td>

            <td class="">

                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-2">
                        ${item.foto ? `<a class="image-popup cursor-pointer  "> <img src="${baseUrl}/storage/${item.foto}" alt="" class="avatar-lg  rounded"> </a>` : `<img src="${baseUrl}/assets/images/users/user-dummy-img.jpg" alt="" class="avatar-lg  ">`}
                    </div>
                        <div class="flex-grow-1">
                                <h5 class="fs-14 mb-1">
                                <a class="flex-grow-1 btn-update-photo" href="javascript:void(0)" data-persona="${item.id_persona}"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Actualizar Foto">
                                    <i class="ri-camera-fill align-bottom"></i>

                                </a>
                                    <a href="javascript:void(0)" class="text-dark nombre">${item.nombre} ${item.paterno || ""} ${item.materno || ""} </a>

                                </h5>
                                <p class="text-muted mb-0">C.I.: <span class="fw-medium"> ${(item.numero_documento)} </span></p>
                                <p class="text-muted mb-0">Fecha nac: <span class="fw-medium"> ${fomatDate(item.fecha_nacimiento)} / ${calcularEdad(item.fecha_nacimiento)} </span></p>
                                <p class="text-muted mb-0">Genero: <span class="fw-medium"> ${item.genero || ""} </span></p>
                                <p class="text-muted mb-0">Celular: <span class="fw-medium"> ${item.celular || "-"} </span></p>

                            </div>
                        </div>


            </td>

            <td class="celular">
                ${item.tipo_inscripcion || ""}
            </td>
            <td class="oficina break-word"  >
                <p class="text-muted mb-0">F. Inscripción: <span class="fw-medium"> ${fomatDate(item.fecha_inicio)} </span></p>
                <p class="text-muted mb-0">F. Finalización: <span class="fw-medium"> ${fomatDate(item.fecha_fin)} </span></p>

            </td>

            <td class="tipoPersonal break-word">
                <div class="" style="max-width:150px;">
                ${item.observacion || ""}

                </div>
            </td>

            <td class="estado">
                ${numeroMonto(item.monto_inscripcion || "")}

            </td>
            <td class="tipoPersonal">
                <span class="text-${estadoInscripcion[item.estado_inscripcion] || "primary"}">
                 ${item.estado_inscripcion || ""}

                </span>
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

            <td>
                <ul class="list-inline hstack gap-2 mb-0">
                    <li class="list-inline-item edit" >
                        <a href="javascript:void(0);" class="text-info hover-secondary d-inline-block view-item-btn" tooltip="tooltip" data-bs-placement="top" title="Ver Detalles de Inscripción">
                            <i class="mdi mdi-eye-outline mdi-20px"></i>
                        </a>
                    </li>
                    <li class="list-inline-item edit" >
                        <a href="javascript:void(0);" class="text-warning hover-secondary  d-inline-block edit-item-btn" tooltip="tooltip" data-bs-placement="top" title="Editar Inscripción">
                            <i class="mdi mdi-pencil-outline mdi-20px"></i>
                        </a>
                    </li>


                </ul>
                <ul class="list-inline hstack gap-2 mb-0">
                    <li class="list-inline-item edit" >
                        <a href="javascript:void(0);" class="text-muted hover-danger d-inline-block remove-item-btn" tooltip="tooltip" data-bs-placement="top" title="Eliminar Inscripción">
                            <i class="ri-delete-bin-2-line fs-16"></i>
                        </a>
                    </li>
                    <li class="list-inline-item edit" >
                        <a href="javascript:void(0);" class="text-primary hover-secondary d-inline-block card-control-btn" tooltip="tooltip" data-bs-placement="top" title="TARJETA DE CONTROL">
                            <i class="mdi mdi-card-text-outline mdi-20px"></i>
                        </a>
                    </li>

                </ul>
                <ul class="list-inline hstack gap-2 mb-0">
                    <li class="list-inline-item edit" >
                        <a href="javascript:void(0);" class="text-success hover-secondary d-inline-block card-btn" tooltip="tooltip" data-bs-placement="top" title="Credencial">
                            <i class=" mdi mdi-card-account-details-star-outline mdi-20px"></i>
                        </a>
                    </li>
                    <li class="list-inline-item edit" >
                        <a href="javascript:void(0);" class="text-secondary hover-secondary d-inline-block pay-list-btn" tooltip="tooltip" data-bs-placement="top" title="Listar Pagos">
                            <i class=" mdi mdi-cash-register mdi-20px"></i>
                        </a>
                    </li>
                </ul>
            </td>
        </tr>`;


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
        .on("click", ".edit-item-btn", function (e) {
            e.preventDefault();

            limpiarForm();

            $("#formInscripcion").removeClass('was-validated');
            $("#checkNuevaPersona").prop("disabled", true).prop("checked", false)
            $("#containerCheckNuevaPersona").hide();

            let itemId = $(this).parents("tr").data("id");


            $("#add-btn").text("Actualizar Inscripción");

            $("#tituloModal").text("Modificar Inscripcion");

            $.get(baseUrl + '/admin/inscripciones/' + itemId)
                .done(function (res) {


                    $("#action").val("actualizar");

                    for (const key in res.data) {
                        if (Object.hasOwnProperty.call(res.data, key)) {
                            const element = res.data[key];

                            $("#tab-inscripcion").find("#" + key).val(element);

                            if (key == "estado_inscripcion") {
                                // donde coincida name y value
                                $("input[name='" + key + "']").filter("[value='" + element + "']").prop("checked", true);
                            }


                        }
                    }

                    const nombrePersona = res.data.nombre + " " + (res.data.paterno || "") + " " + (res.data.materno || "");

                    selectPersona.setChoices([{ value: res.data.id_persona, label: nombrePersona, id: res.data.id_persona }], 'value', 'label', true);
                    selectPersona.setChoiceByValue(res.data.id_persona);
                    selectPersona.disable();

                    selectSucursales.setChoiceByValue(res.data.id_sucursal_fk);

                    generateSelectGrupo(res.data.id_sucursal_fk);

                    selectGrupos.setChoiceByValue(res.data.id_grupo_entrenamiento);

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
        .on("click", ".remove-item-btn", function (e) {
            e.preventDefault();


            // return false;
            let itemId = $(this).closest("tr").data("id");

            let numero = $(this).closest("tr").find(".numero").text();

            let btn = $(this);


            Swal.fire({
                title: '¿Estas seguro de eliminar a la inscripcion numero: <b>' + numero + '</b>?',
                text: "No podras revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#5e72e4',
                cancelButtonColor: '#f5365c',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.post(baseUrl + '/admin/inscripciones/' + itemId, { _token: crfToken, _method: 'DELETE' })
                        .done(function (data) {

                            if (data.success) {
                                notification(data.message, "Persona Eliminada...")

                                btn.closest("tr").fadeOut("slow", function () {
                                    btn.closest("tr").remove();
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

            let itemId = $(this).data("persona");

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
        .on("click", ".card-control-btn", function (e) {
            e.preventDefault();

            const idInscripcion = $(this).closest("tr").data("id");
            const url = baseUrl + "/admin/tarjeta-control/" + idInscripcion;

            window.open(url, "Tarjeta de Control", "width=800,height=800");

            $(this).removeData();

        })
        .on("click", ".card-btn", function (e) {
            e.preventDefault();

            const idInscripcion = $(this).closest("tr").data("id");
            const url = baseUrl + "/admin/credencial/" + idInscripcion;

            window.open(url, "Tarjeta de Control", "width=800,height=800");

            $(this).removeData();

        })
        .on("click", ".pay-btn", function (e) {

            e.preventDefault();

        })
        .on("click", ".pay-list-btn", function (e) {
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

            $("#modalPagos").modal("show");

            cargarPagos(idInscripcion);

            $(this).removeData();


        })


    // $("#modalPagos").modal("show");





    // $("#modalPhoto").modal("show");


    $(".add-btn").click(function (e) {
        e.preventDefault();

        limpiarForm();
        $("#showModal").modal("show");


    })


    // $("#showModal").modal("show");

    $("#ci")
        .on("change", function (e) {
            e.preventDefault();
            // $("#id_persona_psg").val("");

        })




    $("#formInscripcion")
        .submit(async function (e) {
            e.preventDefault();


            let form = $(this);
            form.addClass('was-validated');

            if (form[0].checkValidity() === false) {
                e.stopPropagation();
                return false;
            }

            let accion = $("#action").val();

            const mensaje = accion == "crear" ? "¿Estas seguro de registrar la inscripción?" : "¿Estas seguro de actualizar la inscripción?";


            let confirn = await confirmarEnvio("Si, " + accion.toUpperCase(), mensaje);

            if (confirn == false) {
                return;
            }


            let data = $(this).serializeArray();


            data.push({ name: "_token", value: crfToken });

            const foto = getCropieData();

            if (foto != null) {
                data.push({ name: "imagen_b64", value: foto });

            }



            if (accion == "crear") {

                crearInscripcion(data);
                return;
            }

            if (accion == "actualizar") {

                actualizarInscripcion(data);

                return;
            }


        })

    $(".cancel-btn-photo").click(function (e) {
        e.preventDefault();


        limpiarFormFoto()


    })

    function limpiarFormFoto() {
        $("#modalPhoto").modal("hide");
        $("#id_persona_photo").val("");
        if (instanciaCroppieUpdate) {
            instanciaCroppieUpdate.destroy();
        }
        instanciaCroppieUpdate = null;
        $('#cropieContainerUpdate').html(`<div class="avatar-lg p-1">
                <div class="avatar-title bg-light rounded">
                        <img src="/assets/images/users/user-dummy-img.jpg" id="previevUp"
                            class="avatar-md rounded object-cover" />
                    </div>
                </div>`);

        $("#imagenUpdate").val("");
        $("#titleUpdatePhoto").text("Actualizar Foto de: ");
        $("#btn-update-photo").prop("disabled", true);

    }


    function updateFoto(imgB64) {


        $.post(baseUrl + '/admin/personas-actualizar-foto/' + $("#id_persona_photo").val(), { _token: crfToken, imagen_b64: imgB64 })
            .done(function (data) {

                if (data.success) {


                    $(".cancel-btn-photo")[0].click();

                    notification(data.message, "Foto de la Persona Actualizada")
                    $("#tbodyListaInscripcion").find(`[data-persona="${data.data.id_persona}"]`).closest("tr").find("img").attr("src", baseUrl + "/storage/" + data.data.foto);

                }
            })
            .fail(function (jqXHR) {

                processError(jqXHR);

            })
    }


    function limpiarForm() {

        $("#id_inscripcion").val("");
        $("#formInscripcion").removeClass('was-validated');
        $("#formInscripcion")[0].reset();
        $("#previev").attr("src", defaultImage);
        $("#imagen").val("");
        $("#action").val("crear");
        $("#add-btn").text("Registrar Inscripción");
        $("#tituloModal").text("Registrar Inscripción");

        generateSelectSucursal();
        selectPersona.enable();

        $("#fieldSetPersona").prop("disabled", true);

        $("#btn-tab-inscripcion").tab("show");
        $("#btn-tab-persona").hide();
        $("#checkNuevaPersona").prop("disabled", false).prop("checked", false)
        $("#containerCheckNuevaPersona").show();
    }

    $("#cancel-btn,#close-modal").click(function (e) {
        // e.preventDefault();
        limpiarForm();
    })

    function crearInscripcion(data) {

        $("#add-btn").prop("disabled", true).addClass("mdi-spin mdi-loading");

        $.post(baseUrl + '/admin/inscripciones', data)
            .done(function (data) {

                $("#add-btn").prop("disabled", false).removeClass("mdi-spin mdi-loading");

                if (data.success) {
                    $("#cancel-btn").trigger("click");
                    notification(data.message, "Inscripcion Registrada")
                    let row = rowHtml(data.data, 1);
                    $("#tbodyListaInscripcion").prepend(row);
                    $("#formInscripcion").removeClass('was-validated');
                }


            })
            .fail(function (jqXHR) {

                $("#add-btn").prop("disabled", false).removeClass("mdi-spin mdi-loading");

                processError(jqXHR);

            })

    }

    function actualizarInscripcion(data) {
        $("#add-btn").prop("disabled", true).addClass("mdi-spin mdi-loading");

        data.push({ name: "_method", value: "PUT" });

        $.post(baseUrl + '/admin/inscripciones/' + $("#id_inscripcion").val(), data)
            .done(function (data) {
                $("#add-btn").prop("disabled", false).removeClass("mdi-spin mdi-loading");

                if (data.success) {
                    $("#cancel-btn").trigger("click");

                    notification(data.message, "Inscripción Actualizada")
                    let row = rowHtml(data.data, 1);
                    $("#tbodyListaInscripcion").find(`tr[data-id="${data.data.id_inscripcion}"]`).replaceWith(row, 1);

                }

                $("#add-btn").prop("disabled", false).removeClass("mdi-spin mdi-loading");

            })
            .fail(function (jqXHR) {
                $("#add-btn").prop("disabled", false).removeClass("mdi-spin mdi-loading");

                processError(jqXHR);

            })

    }




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





    function htmlPagos(listadoPagos) {


        let html = "";

        if (listadoPagos.length == 0) {
            html = /*html*/ `<tr>
                    <td colspan="100%" class="text-center py-4" id="loadingPagosInscripcion">
                        <span class="text-danger text-center">Sin Pagos Registrados...</span>
                    </td>
                </tr>`;

            $("#tbodyListaPagos").html(html);

        };


        listadoPagos.forEach((item, index) => {



            html +=/*html*/ `<tr data-id="${item.id_pago_mes_gestion}"  class="trPago">

                <td class="numero">
                    ${index + 1}
                </td>
                <td class="numero">
                    ${item.gestion || ""}
                </td>

                <td class="numero">
                    ${item.mes || ""}
                </td>


                <td class="monto">
                    ${numeroMonto(item.monto || "")}

                </td>
                <td class="saldo">
                    ${numeroMonto(item.saldo || "")}

                </td>
                <td class="oficina break-word"  >

                   <span class="fw-medium"> ${fomatDate(item.fecha_pago)} </span>

                </td>

                <td class="tipoPersonal break-word">
                    <div class="" style="max-width:150px;">

                    ${item.observacion || ""}

                    </div>
                </td>

                <td class="tipoPersonal">

                    <span class="badge badge-soft-${item.estado_pago == "PENDIENTE" ? "warning" : "success"}">${item.estado_pago || ""}</span>
                </td>

                <td>
                    <ul class="list-inline hstack gap-2 mb-0">

                        ${item.estado_pago == "PENDIENTE" ?
                    `<li class="list-inline-item " >
                                    <a href="javascript:void(0);" class="text-warning hover-secondary  d-inline-block edit-item-btn-pago" tooltip="tooltip" data-bs-placement="top" title="Editar Pago">
                                        <i class="mdi mdi-pencil-outline mdi-20px"></i>
                                    </a>
                                </li>`
                    :
                    ""
                }

                    </ul>

                </td>
            </tr>`;


        })

        $("#tbodyListaPagos").html(html);

    }




    ///***********************************            PAGOS              */


    $("#formPagos")
        .submit(async function (e) {
            e.preventDefault();

            let form = $(this);
            form.addClass('was-validated');

            if (form[0].checkValidity() === false) {
                e.stopPropagation();
                return false;
            }

            let accion = $("#actionPago").val();

            const mensaje = accion == "crear" ? "¿Estas seguro de registrar el pago?" : "¿Estas seguro de actualizar el pago?";

            const confimar = await confirmarEnvio("Si, " + accion.toUpperCase(), mensaje);

            if (confimar == false) {
                return;
            }

            let datos = $(this).serializeArray();
            datos.push({ name: "_token", value: crfToken });


            if (accion == "registrar") {

                crearPago(datos);
                return;
            }

            if (accion == "actualizar") {

                datos.push({ name: "_method", value: "PUT" });
                actualizarPago(datos);

                return;
            }



        })


    function crearPago(data) {

        $("#btn-add-pago").prop("disabled", true).addClass("mdi-spin mdi-loading");

        $.post(baseUrl + '/admin/pagos-mes-gestion', data)
            .done(function (res) {

                $("#btn-add-pago").prop("disabled", false).removeClass("mdi-spin mdi-loading");

                if (res.success) {

                    notification(res.message, "Pago Registrado")
                    limpiarFormPago(false);
                    cargarPagos($("#id_inscripcion_pago").val());
                }

            })
            .fail(function (jqXHR) {

                $("#btn-add-pago").prop("disabled", false).removeClass("mdi-spin mdi-loading");

                processError(jqXHR);

            })

    }


    function actualizarPago(data) {

        $("#btn-add-pago").prop("disabled", true).addClass("mdi-spin mdi-loading");

        $.post(baseUrl + '/admin/pagos-mes-gestion/' + $("#id_pago_mes_gestion").val(), data)

            .done(function (res) {

                $("#btn-add-pago").prop("disabled", false).removeClass("mdi-spin mdi-loading");

                if (res.success) {

                    notification(res.message, "Pago Actualizado")
                    limpiarFormPago(false);
                    cargarPagos($("#id_inscripcion_pago").val());
                }

            })
            .fail(function (jqXHR) {

                $("#btn-add-pago").prop("disabled", false).removeClass("mdi-spin mdi-loading");

                processError(jqXHR);

            })

    }


    $("#btn-cancel-pay,#btn-cancel-pay-x").click(function (e) {
        e.preventDefault();
        limpiarFormPago();
    })

    function limpiarFormPago(all = true) {
        $("#formPagos")[0].reset();
        $("#formPagos").removeClass('was-validated');
        $("#actionPago").val("registrar");
        $("#btn-add-pago span").text("Registrar Pago");
        $("#actionTitlePago").text("Registrar Pago");
        $("#id_pago_mes_gestion").val("");
        $("#formPagos").find("#fecha_pago").prop("disabled", false);

        $("#formPagos").find("select").prop("disabled", false);



        if (all) {
            $("#id_inscripcion_pago").val("");
            $("#datosInscripcionPago").text("");
        }
    }


    function cargarPagos(idInscripcion) {


        loadingTable($("#tbodyListaPagos"));

        let datos = {
            id_gestion: $("#filtro_gestion").val(),
            estado_pago: $("#filtro_estado_pago").val(),
        }

        $.get(baseUrl + '/admin/pagos-inscripcion/' + idInscripcion, datos)
            .done(function (data) {
                htmlPagos(data.data);
            })
            .fail(function (jqXHR) {
                processError(jqXHR);
            })

    }

    $("#tbodyListaPagos")
        .on("click", ".edit-item-btn-pago", function (e) {
            e.preventDefault();

            const idPago = $(this).closest("tr.trPago").data("id");

            $("#tbodyListaPagos").find("tr.trPago").removeClass("table-info");

            $(this).closest("tr.trPago").addClass("table-info");

            $("#actionPago").val("actualizar");
            $("#btn-add-pago span").text("Actualizar Pago");
            $("#actionTitlePago").text("Actualizar Pago");
            $("#formPagos").find("select").prop("disabled", true);
            $("#formPagos").find("#fecha_pago").prop("disabled", true);
            $.get(baseUrl + '/admin/pagos-mes-gestion/' + idPago)

                .done(function (data) {

                    $("#id_pago_mes_gestion").val(data.data.id_pago_mes_gestion);

                    for (const key in data.data) {
                        if (Object.hasOwnProperty.call(data.data, key)) {
                            const element = data.data[key];

                            $("#formPagos").find("#" + key).val(element);

                            if (key == "estado_pago") {
                                // donde coincida name y value
                                $("#formPagos").find("input[name='" + key + "']").filter("[value='" + element + "']").prop("checked", true);
                            }

                        }
                    }

                })
                .fail(function (jqXHR) {
                    processError(jqXHR);

                })


            $(this).removeData();


        })


    $("#btn-cancel-pago").click(function (e) {
        e.preventDefault();

        $("#tbodyListaPagos").find("tr.trPago").removeClass("table-info");
        limpiarFormPago(false);
    })


    $("#btnPdfPagos")
        .click(function (e) {
            e.preventDefault();

            const idInscripcion = $("#id_inscripcion_pago").val();

            const url = baseUrl + "/admin/pagos-inscripcion-pdf/" + idInscripcion;

            $("#formGenerarPdfPagos").attr("action", url);

            window.open('about:blank', 'popupWindow', 'width=800,height=800,scrollbars=yes');
            $("#formGenerarPdfPagos").submit();


        })

    $("#filtro_gestion,#filtro_estado_pago")
        .on("change", function (e) {
            e.preventDefault();
            const idInscripcion = $("#id_inscripcion_pago").val();

            cargarPagos(idInscripcion);
        })

});
