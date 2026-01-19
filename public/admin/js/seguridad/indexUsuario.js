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

    let listaPersonas = [];
    let listaSucursales = [];



    getParametros()

    function getParametros() {

        $.post(baseUrl + '/admin/usuarios-parametrico', { _token: crfToken })
            .done(function (data) {
                listaPersonas = data.data.personas;
                listaSucursales = data.data.sucursales;
                llenarSelectPersonas();
                llenarSelectSucursal();

            })
            .fail(function (jqXHR) {
                processError(jqXHR);
            })
    }


    let selectPersona = new Choices("#id_persona_fk", configChoices);
    let selectSucursal = new Choices("#susursales_autorizadas", configChoices);


    function llenarSelectPersonas() {

        let options = [];
        // placeholder
        options.push({
            label: "Seleccione una Persona...",
            value: "",
            id: "",
        });

        listaPersonas.forEach(function (row) {

            options.push({
                label: row.nombre + " " + row.paterno + " " + row.materno + " - C.I.: " + row.numero_documento + " - (" + row.tipo_persona + ")",
                value: row.id_persona,
                id: row.id_persona,
            });


        });

        selectPersona.setChoices(options, "value", "label", true);

        selectPersona.setChoiceByValue("");

    }



    function llenarSelectSucursal() {

        // crear choices select con tipos de activo  como label e iterar el campo subcategoria como options


        let optionsSucursal = [];
        // placeholder


        listaSucursales.forEach(function (row) {

            optionsSucursal.push({
                label: row.nombre_sucursal,
                value: row.id_sucursal,
                id: row.id_sucursal,
            });


        });

        selectSucursal.setChoices(optionsSucursal, "value", "label", true);

        // selectSucursal.setChoiceByValue("");

    }


    $("#id_persona_fk")
        .on("change", function (e) {
            e.preventDefault();

            let idPersona = $(this).val();

            if (idPersona == "") {

                $("#usuario").val("");
                $("#password").val("");
                $("#confirm_password").val("");

                return;
            }

            let persona = listaPersonas.find((item) => item.id_persona == idPersona);


            let usuarioClave = generarUsuario(persona);

            $("#usuario").val(usuarioClave.usuario);
            $("#password").val(usuarioClave.contrasenia);
            $("#confirm_password").val(usuarioClave.contrasenia);

        })


    $("#mostrarContrasenia")
        .on("change", function (e) {

            let tipo = $(this).prop("checked") ? "text" : "password";

            $("#password").attr("type", tipo);
            $("#confirm_password").attr("type", tipo);
        })


    function generarUsuario(persona) {

        let nombre = persona.nombre.split(" ")[0];
        nombre = nombre.trim().toUpperCase();

        let paterno = persona.paterno.split(" ")[0];
        paterno = paterno.trim().toUpperCase();

        let numeroDocumento = persona.numero_documento.trim();

        let usuario = `${nombre}${numeroDocumento}`;

        let contrasenia = `${paterno}_${numeroDocumento}`;

        return {
            usuario,
            contrasenia
        }

    }





    let dataScroll = {
        'page': 1,
        'size': 20,
        'search': '',
        '_token': crfToken,
    }


    let scrollUsuario = $('#tbodyListaUsuario').scrollPagination({
        'url': baseUrl + '/admin/usuarios-listar', // the url you are fetching the results
        'method': 'post',
        'data': getDataFilter(),
        'dataTemplateCallback': rowHtml,
        'elementCountSelector': '#contadorListaUsuario',
        'elementCountTemplate': '<span  class=""> Listando <b> {count}  </b>elementos de <b> {total} </b> encontrados </span>',
        'loading': '#loadingUsuario',
        'scroller': "#containerListaUsuario",
        'loadingText': `<div  class=" text-center"><span class="loaderHttp"></span><span class="text-muted">Cargando...</span></div>`,
        'loadingNomoreText': '<h6 class="text-danger">No se encontraron más Resultados</h6>',

    });


    $("#filtroSucursal,#filtroCategoria")
        .on("change", function (e) {
            e.preventDefault();

            scrollUsuario.resetScrollPagination(getDataFilter());

        })


    let timer = null;
    $("#inputBuscarUsuario")
        .on("input", function () {

            clearTimeout(timer);

            timer = setTimeout(() => {

                scrollUsuario.resetScrollPagination(getDataFilter());

            }, 500);

        });

    function getDataFilter() {

        dataScroll.search = $("#inputBuscarUsuario").val();

        return dataScroll;
    }









    function rowHtml(item, opacity = 0) {


        let html =/*html*/ `<tr data-id="${item.id}" style='opacity:${opacity};-moz-opacity: ${opacity};filter: alpha(opacity=${opacity});'>

            <td class="usuario">
                ${item.usuario}
            </td>
            <td class="nombre_persona">
                ${item.nombre || ""}  ${item.paterno || ""}  ${item.materno || ""} - C.I.: ${item.numero_documento || ""}
            </td>
            <td class="sucursales">
                ${listarSucursalesUsuario(item)}
            </td>
            <td class="rol">
                ${item.rol || ""}
            </td>
            <td class="entrenador">
                ${fomatDate(item.created_at || "", 'fh')}

            </td>

            <td class="estado">

                <div class="form-check form-switch">
                    <input class="form-check-input switch-status-btn" type="checkbox" role="switch"  ${item.estado_usuario == "ACTIVO" ? "checked" : ""} >
                </div>
            </td>

            <td>
                <ul class="list-inline hstack gap-2 mb-0">

                    <li class="list-inline-item edit" >
                        <a href="javascript:void(0);" class="text-muted hover-warning d-inline-block edit-item-btn" tooltip="tooltip" data-bs-placement="top" title="Editar Usuario">
                            <i class="ri-pencil-line fs-16"></i>
                        </a>
                    </li>
                    <li class="list-inline-item edit" >
                        <a href="javascript:void(0);" class="text-muted hover-danger d-inline-block remove-item-btn" tooltip="tooltip" data-bs-placement="top" title="Eliminar Usuario">
                            <i class="ri-delete-bin-2-line fs-16"></i>
                        </a>
                    </li>

                </ul>
            </td>
        </tr>`;


        return html;

    }


    function listarSucursalesUsuario(row) {

        let html = "";

        let sucursales = JSON.parse(row.sucursales_autorizadas || "[]");

        if (sucursales.length > 0) {
            sucursales.forEach(function (sucursal) {
                html += `<span class="badge badge-soft-primary mx-1">${sucursal.nombre_sucursal}</span>`;
            })
        }

        return html;

    }






    $("#tbodyListaUsuario")
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


            $("#add-btn").text("Actualizar Usuario");

            $("#tituloModal").text("Actualizar Usuario");

            $.get(baseUrl + '/admin/usuarios/' + itemId)
                .done(function (res) {


                    $("#action").val("actualizar");

                    for (const key in res.data) {
                        if (Object.hasOwnProperty.call(res.data, key)) {
                            const element = res.data[key];

                            $("#formUsuario #" + key).val(element);

                        }
                    }

                    $("#id_usuario").val(res.data.id);


                    let sucursales = JSON.parse(res.data.sucursales_autorizadas || "[]");

                    sucursales.forEach(function (sucursal) {
                        selectSucursal.setChoiceByValue(sucursal.id_sucursal);
                    })

                    selectPersona.setChoiceByValue(res.data.id_persona_fk);
                    selectPersona.disable();

                    $("#usuario").prop("disabled", true);

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

            $.post(baseUrl + '/admin/usuarios/' + itemId, { _token: crfToken, _method: 'PATCH', estado_usuario: estado })
                .done(function (data) {

                    notification(data.message, "Usuario Actualizado")

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

            let nombre = $(this).closest("tr").find(".usuario").text();

            let btn = $(this);


            Swal.fire({
                title: '¿Estas seguro de eliminar el usuario: ' + nombre + '?',
                text: "No podras revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#5e72e4',
                cancelButtonColor: '#f5365c',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.post(baseUrl + '/admin/usuarios/' + itemId, { _token: crfToken, _method: 'DELETE' })
                        .done(function (data) {

                            if (data.success) {
                                notification(data.message, "Usuario Eliminado...")

                                btn.closest("tr").fadeOut("slow", function () {
                                    $(this).remove();
                                })
                            }


                        })
                        .fail(function (jqXHR) {
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



    // $("#showModal").modal("show");



    $(".add-btn").click(function (e) {
        e.preventDefault();

        limpiarForm();
        $("#showModal").modal("show");


    })






    $("#formUsuario")
        .submit(function (e) {
            e.preventDefault();


            let form = $(this);
            form.addClass('was-validated');

            if (form[0].checkValidity() === false || validarFormulario(form) == false) {
                e.stopPropagation();
                return false;
            }

            let data = $(this).serializeArray();


            data.push({ name: "_token", value: crfToken });

            let accion = $("#action").val();

            if (accion == "crear") {
                crearUsuario(data);
                return;
            }

            if (accion == "actualizar") {

                actualizarUsuario(data);

                return;
            }


        })

    function validarFormulario(form) {

        let password = form.find("#password").val();
        let confirm_password = form.find("#confirm_password").val();

        if (password != confirm_password) {

            return false;
        }

        return true;

    }

    $("#confirm_password")
        .on("input", function (e) {
            let password = $("#password").val();
            let confirm_password = $(this).val();
            $(this).removeClass("is-invalid");

            if (password != confirm_password) {
                $(this).addClass("is-invalid");
            }

        })




    function limpiarForm() {
        $("#id_usuario").val("");
        $("#formUsuario").removeClass('was-validated');
        $("#formUsuario")[0].reset();
        $("#action").val("crear");
        $("#add-btn").text("Registrar Usuario");
        $("#tituloModal").text("Registrar Usuario");

        llenarSelectSucursal();
        llenarSelectPersonas();


        $("#usuario").prop("disabled", false);
        selectPersona.enable();
    }

    $("#cancel-btn,#close-modal").click(function (e) {
        // e.preventDefault();
        limpiarForm();
    })

    function crearUsuario(data) {

        $("#add-btn").prop("disabled", true).addClass("mdi-spin mdi-loading");

        $.post(baseUrl + '/admin/usuarios', data)
            .done(function (data) {

                if (data.success) {
                    $("#cancel-btn").trigger("click");
                    notification(data.message, "Usuario Creado Correctamente")
                    let row = rowHtml(data.data, 1);
                    $("#tbodyListaUsuario").prepend(row);
                    $("#formUsuario").removeClass('was-validated');
                }


            })
            .fail(function (jqXHR) {


                processError(jqXHR);

            })
            .always(function () {

                $("#add-btn").prop("disabled", false).removeClass("mdi-spin mdi-loading");

            })


    }

    function actualizarUsuario(data) {

        $("#add-btn").prop("disabled", true).addClass("mdi-spin mdi-loading");

        data.push({ name: "_method", value: "PUT" });

        $.post(baseUrl + '/admin/usuarios/' + $("#id_usuario").val(), data)
            .done(function (data) {

                if (data.success) {
                    $("#cancel-btn").trigger("click");

                    notification(data.message, "Usuario Actualizado Correctamente")
                    let row = rowHtml(data.data, 1);
                    $("#tbodyListaUsuario").find(`tr[data-id="${data.data.id}"]`).replaceWith(row);

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
