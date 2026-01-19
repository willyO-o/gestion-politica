$(function () {

    'use strict';

    const apiWhastapp = "https://api.whatsapp.com/send?phone=591";

    const defaultImage = baseUrl + "/assets/images/users/user-dummy-img.jpg";




    let dataScroll = {
        'page': 1,
        'size': 15,
        'search': '',
        '_token': crfToken,
    }


    let scrollPersonal = $('#tbodyListaPersonal').scrollPagination({
        'url': baseUrl + '/admin/personas-listar', // the url you are fetching the results
        'method': 'post',
        'data': getDataFilter(),
        'dataTemplateCallback': rowHtml,
        'elementCountSelector': '#contadorListaPersonal',
        'elementCountTemplate': '<span  class=""> Listando <b> {count}  </b>elementos de <b> {total} </b> encontrados </span>',
        'loading': '#loadingPersonal',
        'scroller': "#containerListaPersonal",
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
        dataScroll.estado_persona = $("#filtroEstadoPersona").val();

        dataScroll.search = $("#inputBuscarPersona").val();

        return dataScroll;
    }

    let imagenBase64 = null;

    var instanciaCroppie = null;
    var configCoppie = {
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

    var instanciaCroppieUpdate = null;

    $("#imagen")
        .on("change", function (e) {
            e.preventDefault();


            var files = e.target.files;

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

                        var reader = new FileReader();

                        reader.onload = function (event) {
                            var imageUrl = event.target.result;
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
        var parts = dataurl.split(','), // Separar en dos partes
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
                var imageUrl = event.target.result;
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


    function rowHtml(item,opacity = 0) {


        let html =/*html*/ `<tr data-id="${item.id_persona}" style='opacity:${opacity};-moz-opacity: ${opacity};filter: alpha(opacity=${opacity});'>

            <td class="nombre">
                ${item.nombre} ${item.paterno || ""} ${item.materno || ""}
            </td>
            <td class="ci">
                ${item.numero_documento || ""}
            </td>
            <td class="celular">
                ${item.celular || ""}
            </td>
            <td class="oficina break-word"  >
            ${item.genero || ""}
            </td>
            <td class="tipoPersonal">
                ${item.tipo_persona}
            </td>
            <td class="tipoPersonal">
                ${fomatDate(item.fecha_nacimiento)}
            </td>

            <td class="estado">
                ${item.estado_persona || ""}

            </td>
            <td class="tipoPersonal">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                    ${item.foto ? `<a class="image-popup cursor-pointer  "> <img src="${baseUrl}/storage/${item.foto}" alt="" class="avatar-xs  rounded"> </a>` : `<img src="${baseUrl}/assets/images/users/user-dummy-img.jpg" alt="" class="avatar-xs  ">`}
                    </div>
                    <a class="flex-grow-1 ms-2 btn-update-photo" href="javascript:void(0)">
                        Actualizar <br> Foto
                    </a>
                </div>
            </td>
            <td>
                <ul class="list-inline hstack gap-2 mb-0">
                    <li class="list-inline-item edit" >
                        <a href="javascript:void(0);" class="text-muted hover-info d-inline-block view-item-btn" tooltip="tooltip" data-bs-placement="top" title="Ver Detalles">
                            <i class="ri-eye-line fs-16"></i>
                        </a>
                    </li>
                    <li class="list-inline-item edit" >
                        <a href="javascript:void(0);" class="text-muted hover-warning d-inline-block edit-item-btn" tooltip="tooltip" data-bs-placement="top" title="Editar Persona">
                            <i class="ri-pencil-line fs-16"></i>
                        </a>
                    </li>
                    <li class="list-inline-item edit" >
                        <a href="javascript:void(0);" class="text-muted hover-danger d-inline-block remove-item-btn" tooltip="tooltip" data-bs-placement="top" title="Eliminar Persona">
                            <i class="ri-delete-bin-2-line fs-16"></i>
                        </a>
                    </li>

                </ul>
            </td>
        </tr>`;


        return html;

    }


    $("#tablaPersona")
        .on("click", ".view-item-btn", function (e) {
            e.preventDefault();

            let itemId = $(this).parents("tr").data("id");

            esqueletonLoader();

            $.get(baseUrl + '/admin/personas/' + itemId)
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

            $("#formPersona").removeClass('was-validated');

            let itemId = $(this).parents("tr").data("id");


            $("#add-btn").text("Actualizar Persona");

            $("#tituloModal").text("Actualizar Persona");

            $.get(baseUrl + '/admin/personas/' + itemId)
                .done(function (res) {


                    $("#action").val("actualizar");

                    for (const key in res.data) {
                        if (Object.hasOwnProperty.call(res.data, key)) {
                            const element = res.data[key];

                            $("#" + key).val(element);

                            if (key == "genero" || key == "estado_persona") {
                                // donde coincida name y value
                                $("input[name='" + key + "']").filter("[value='" + element + "']").prop("checked", true);
                            }

                            if (key == "foto" && element) {
                                // donde coincida name y value
                                $("#previev").attr("src", baseUrl + "/storage/" + element);
                            }

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


            let itemId = $(this).closest("tr").data("id");

            let nombre = $(this).closest("tr").find(".nombre").text();

            let btn = $(this);


            Swal.fire({
                title: '¿Estas seguro de eliminar a la persona: ' + nombre + '?',
                text: "No podras revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#5e72e4',
                cancelButtonColor: '#f5365c',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.post(baseUrl + '/admin/personas/' + itemId, { _token: crfToken, _method: 'DELETE' })
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
            $("#id_persona_psg").val("");

        })




    $("#formPersona")
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

            const foto = getCropieData();

            if (foto != null) {
                data.push({ name: "imagen_b64", value: foto });

            }


            let accion = $("#action").val();

            if (accion == "crear") {
                crearPersona(data);
                return;
            }

            if (accion == "actualizar") {

                actualizarPersona(data);

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
                    let row = rowHtml(data.data,1);
                    $("#tbodyListaPersonal").find(`tr[data-id="${data.data.id_persona}"]`).replaceWith(row);

                }
            })
            .fail(function (jqXHR) {

                processError(jqXHR);

            })
    }


    function limpiarForm() {
        $("#id_persona").val("");
        $("#formPersona").removeClass('was-validated');
        $("#formPersona")[0].reset();
        $("#previev").attr("src", defaultImage);
        $("#imagen").val("");
        $("#action").val("crear");
        $("#add-btn").text("Registrar Persona");
        $("#tituloModal").text("Registrar Persona");
    }

    $("#cancel-btn,#close-modal").click(function (e) {
        // e.preventDefault();
        limpiarForm();
    })

    function crearPersona(data) {

        $("#add-btn").prop("disabled", true).addClass("mdi-spin mdi-loading");

        $.post(baseUrl + '/admin/personas', data)
            .done(function (data) {

                $("#add-btn").prop("disabled", false).removeClass("mdi-spin mdi-loading");

                if (data.success) {
                    $("#cancel-btn").trigger("click");
                    notification(data.message, "Persona Registrada")
                    let row = rowHtml(data.data,1);
                    $("#tbodyListaPersonal").prepend(row);
                    $("#formPersona").removeClass('was-validated');
                }


            })
            .fail(function (jqXHR) {

                $("#add-btn").prop("disabled", false).removeClass("mdi-spin mdi-loading");

                processError(jqXHR);

            })

    }

    function actualizarPersona(data) {
        $("#add-btn").prop("disabled", true).addClass("mdi-spin mdi-loading");

        data.push({ name: "_method", value: "PUT" });

        $.post(baseUrl + '/admin/personas/' + $("#id_persona").val(), data)
            .done(function (data) {
                $("#add-btn").prop("disabled", false).removeClass("mdi-spin mdi-loading");

                if (data.success) {
                    $("#cancel-btn").trigger("click");

                    notification(data.message, "Persona Actualizada")
                    let row = rowHtml(data.data,1);
                    $("#tbodyListaPersonal").find(`tr[data-id="${data.data.id_persona}"]`).replaceWith(row);

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
        <div class="card" id="detallePersona">
            <div class="card-body text-center">
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
        </div>`;

        setTimeout(() => {
            $("#detallePersona").fadeOut("fast", function () {
                $(this).replaceWith(html);
                $(this).fadeIn("fast");
            });
        }, 1000);

    }



    function esqueletonLoader() {
        let html = /*html*/`
        <div class="card" id="detallePersona">
        <div class="card-body text-center">
            <div class="position-relative d-inline-block">
                <img src="${baseUrl}/assets/images/users/user-dummy-img.jpg" alt=""
                    class="avatar-lg rounded-circle img-thumbnail shadow">
                <span class="contact-active position-absolute rounded-circle bg-success"><span
                        class="visually-hidden"></span>
                </span>
            </div>
            <h5 class="mt-4 mb-1 placeholder-glow"><span class="placeholder col-6"></span> </h5>
            <p class="text-muted placeholder-glow"><span class="placeholder col-4"></span></p>

            <ul class="list-inline mb-0">
                <li class="list-inline-item avatar-xs placeholder-glow">
                    <a href="javascript:void(0);" class="avatar-title bg-soft-success text-success fs-15 rounded"
                        target="_blank" disabled="">
                        <i class="ri-whatsapp-line placeholder"></i>

                    </a>
                </li>
                <li class="list-inline-item avatar-xs placeholder-glow">
                    <a href="javascript:void(0);" class="avatar-title bg-soft-danger text-danger fs-15 rounded">
                        <i class="ri-mail-line placeholder"></i>
                    </a>
                </li>
                <li class="list-inline-item avatar-xs placeholder-glow">
                    <a href="javascript:void(0);" class="avatar-title bg-soft-info text-info fs-15 rounded">
                        <i class="ri-phone-line placeholder"></i>

                    </a>
                </li>

            </ul>
        </div>
        <div class="card-body">
            <h6 class="text-muted text-uppercase fw-semibold mb-3 placeholder-glow"><span class="placeholder col-8"></span> </h6>
            <p class="text-muted mb-4 placeholder-glow"><span class="placeholder col-10"></span></p>
            <div class="table-responsive table-card">
                <table class="table table-borderless mb-0">
                    <tbody>
                        <tr>
                            <td class="fw-medium placeholder-glow" scope="row">
                                <span class="placeholder col-8"></span>
                            </td>
                            <td class="placeholder-glow" > <span class="placeholder col-8"></span></td>
                        </tr>
                        <tr>
                            <td class="fw-medium placeholder-glow" scope="row"><span
                                    class="placeholder col-8"></span></td>
                            <td class="placeholder-glow" > <span class="placeholder col-8"></span></td>
                        </tr>
                        <tr>
                            <td class="fw-medium placeholder-glow" scope="row"><span
                                    class="placeholder col-8"></span></td>
                            <td class="placeholder-glow" > <span class="placeholder col-8"></span></td>
                        </tr>
                        <tr>
                            <td class="fw-medium placeholder-glow" scope="row"><span
                                    class="placeholder col-8"></span></td>
                            <td class="placeholder-glow" > <span class="placeholder col-8"></span></td>
                        </tr>
                        <tr>
                            <td class="fw-medium placeholder-glow" scope="row"><span
                                    class="placeholder col-8"></span></td>
                            <td class="placeholder-glow" > <span class="placeholder col-8"></span></td>
                        </tr>
                        <tr>
                            <td class="fw-medium placeholder-glow" scope="row"><span
                                    class="placeholder col-8"></span></td>
                            <td class="placeholder-glow" > <span class="placeholder col-8"></span></td>
                        </tr>
                        <tr>
                            <td class="fw-medium placeholder-glow" scope="row"><span
                                    class="placeholder col-8"></span></td>
                            <td class="placeholder-glow" > <span class="placeholder col-8"></span></td>
                        </tr>
                        <tr>
                            <td class="fw-medium placeholder-glow" scope="row"><span
                                    class="placeholder col-8"></span></td>
                            <td class="placeholder-glow" > <span class="placeholder col-8"></span></td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>`;


        $("#detallePersona").replaceWith(html);
    }








});
