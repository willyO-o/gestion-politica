$(function () {
    "use strict";


    console.log("probando :)");

    var start = moment().subtract(29, 'days');
    var end = moment();


    let dataScroll = {
        'page': 1,
        'size': 15,
        'search': '',
        '_token': crfToken,
        'fecha_inicio': start.format('YYYY-MM-DD'),
        'fecha_fin': end.format('YYYY-MM-DD'),

    }



    let scrollGrupoEntrenamiento = $('#tbodyListaAsistencia').scrollPagination({
        'url': baseUrl + '/admin/asistencia-estudiante-listar', // the url you are fetching the results
        'method': 'post',
        'data': getDataFilter(),
        'dataTemplateCallback': rowHtml,
        'elementCountSelector': '#contadorListaAsistencia',
        'elementCountTemplate': '<span  class=""> Listando <b> {count}  </b>elementos de <b> {total} </b> encontrados </span>',
        'loading': '#loadingAsistencia',
        'scroller': "#containerListaAsistencia",
        'loadingText': `<div  class=" text-center"><span class="loaderHttp"></span><span class="text-muted">Cargando...</span></div>`,
        'loadingNomoreText': '<h6 class="text-danger">No se encontraron más Resultados</h6>',

    });






    function cb(start, end) {
        $('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Hoy': [moment(), moment()],
            'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Ultimos 7 Dias': [moment().subtract(6, 'days'), moment()],
            'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
            'Este Mes': [moment().startOf('month'), moment().endOf('month')],
            'Mes Pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'Ultimos 3 Meses': [moment().subtract(3, 'month').startOf('month'), moment().endOf('month')],
            'Este Año': [moment().startOf('year'), moment().endOf('year')],
            'Año Pasado': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],


        },
        locale: {
            format: 'DD/MM/YYYY', // Formato de fecha
            separator: " - ",
            applyLabel: "Aplicar",
            cancelLabel: "Cancelar",
            fromLabel: "Desde",
            toLabel: "Hasta",
            customRangeLabel: "Rango Personalizado",
            weekLabel: "Sem",
            daysOfWeek: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
            monthNames: [
                "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
            ],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            firstDay: 1,
            cancelClass: "btn-danger",
            applyClass: "btn-info",
        },
        language: 'es'
    }, cb);

    cb(start, end);


    $('#reportrange').on('apply.daterangepicker', function (ev, picker) {

        dataScroll.fecha_inicio = picker.startDate.format('YYYY-MM-DD');
        dataScroll.fecha_fin = picker.endDate.format('YYYY-MM-DD');

        scrollGrupoEntrenamiento.resetScrollPagination(getDataFilter());


    });



    $("#filtroSucursal,#filtroCategoria")
        .on("change", function (e) {
            e.preventDefault();

            scrollGrupoEntrenamiento.resetScrollPagination(getDataFilter());

        })


    let timer = null;
    $("#buscarAsistencia")
        .on("input", function () {

            clearTimeout(timer);

            timer = setTimeout(() => {

                scrollGrupoEntrenamiento.resetScrollPagination(getDataFilter());

            }, 500);

        });

    function getDataFilter() {


        // dataScroll.fecha_inicio = $("#filtroCategoria").val();
        // dataScroll.fecha_fin = $("#filtroSucursal").val();

        dataScroll.search = $("#buscarAsistencia").val();

        return dataScroll;
    }




    // function updateClock() {
    //     const now = new Date(); // Obtener la fecha y hora actual de la zona horaria local
    //     const hours = String(now.getHours()).padStart(2, '0'); // Asegurar dos dígitos para horas
    //     const minutes = String(now.getMinutes()).padStart(2, '0'); // Asegurar dos dígitos para minutos
    //     const seconds = String(now.getSeconds()).padStart(2, '0'); // Asegurar dos dígitos para segundos

    //     // Actualizar el contenido del reloj
    //     const clockElement = document.getElementById('reloj');
    //     clockElement.textContent = `${hours}:${minutes}:${seconds}`;
    // }

    function updateClock() {
        // Obtener la hora exacta en una zona horaria específica
        const now = new Date();
        const options = { timeZone: 'America/La_Paz', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };

        // Formatear la hora usando Intl.DateTimeFormat
        const formatter = new Intl.DateTimeFormat('en-US', options);
        const parts = formatter.formatToParts(now);

        // Extraer horas, minutos y segundos
        const hours = parts.find(part => part.type === 'hour').value;
        const minutes = parts.find(part => part.type === 'minute').value;
        const seconds = parts.find(part => part.type === 'second').value;

        // Actualizar el contenido del reloj
        // const clockElement = document.querySelector('.reloj');
        // clockElement.textContent = `${hours}:${minutes}:${seconds}`;
        $(".reloj").text(`${hours}:${minutes}:${seconds}`);
    }

    setInterval(updateClock, 1000); // Actualizar cada segundo





    function rowHtml(item, opacity = 0) {


        let html =/*html*/ `<tr data-id="${item.id_asistencia}" style='opacity:${opacity};-moz-opacity: ${opacity};filter: alpha(opacity=${opacity});'>

            <td class="row_numero">
                ${item.numero}
            </td>
            <td class="row_nombre">
                ${item.nombre || ""}  ${item.paterno || ""}  ${item.materno || ""}
            </td>
            <td class="row_fecha_asistencia">
                ${fomatDate(item.fecha_asistencia || "")}
            </td>

            <td class="row_ingreso">
                ${fomatDate(item.ingreso || "", "h")}
            </td>
            <td class="row_salida">
                ${fomatDate(item.salida || "", "h")}
            </td>

            <td class="row_grupo">
                ${item.nombre_grupo || ""}
            </td>

            <td class="row_sucursal">
                ${item.nombre_sucursal || ""}
            </td>
            <td class="row_observacion">
                ${item.observacion || "-"}
            </td>
            <td class="row_permiso">
                ${item.permiso ? "SI" : ""}
            </td>
            <td>
                <ul class="list-inline hstack gap-2 mb-0">

                    <li class="list-inline-item edit" >
                        <a href="javascript:void(0);" class="text-muted hover-warning d-inline-block editar-item-btn" tooltip="tooltip" data-bs-placement="top" title="Editar Sucursal">
                            <i class="ri-pencil-line fs-16"></i>
                        </a>
                    </li>
                    <li class="list-inline-item edit" >
                        <a href="javascript:void(0);" class="text-muted hover-danger d-inline-block eliminar-item-btn" tooltip="tooltip" data-bs-placement="top" title="Eliminar Sucursal">
                            <i class="ri-delete-bin-2-line fs-16"></i>
                        </a>
                    </li>

                </ul>
            </td>
        </tr>`;


        return html;

    }







    function onScanSuccess(decodedText, decodedResult) {
        // handle the scanned code as you like, for example:
        // console.log(`Code matched = ${decodedText}`, decodedResult);

        const codigo = decodedText;

        html5QrcodeScanner.pause();
        solicitarMarcadoEstudiante(codigo)

    }

    function onScanFailure(error) {
        // handle scan failure, usually better to ignore and keep scanning.
        // for example:
        // console.warn(`Code scan error = ${error}`);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbox: { width: 250, height: 250 } },
          /* verbose= */ false);

    html5QrcodeScanner.render(onScanSuccess, onScanFailure);



    function solicitarMarcadoEstudiante(codigo) {

        $.post(baseUrl + '/admin/asistencia-estudiante', { codigo: codigo, _token: crfToken })
            .done(function (res) {
                if (res.success) {

                    let nombre = res.data.inscripcion.nombre + " " + res.data.inscripcion.paterno + " " + res.data.inscripcion.materno;
                    let nroInscripcion = res.data.inscripcion.numero;

                    let estado = res.data.asistencia ? (res.data.asistencia.salida ? false : "La Salida") : "El Ingreso";

                    let idAsistencia = res.data.asistencia ? res.data.asistencia.id_asistencia : null;

                    const idInscripcion = res.data.inscripcion.id_inscripcion;

                    if (estado) {

                        Swal.fire({
                            title: `¿Desea Registrar <b class="text-${estado == "El Ingreso" ? "success" : "danger"} " > ${estado}  </b>   del estudiante?:`,
                            html: `<div><span class="h3 text-primary">
                            <i class="mdi mdi-clock-time-four-outline"></i></span>
                            <span class="h3  text-primary reloj" id="reloj" class="text-primary"></span></div><p>Nombre: <b>${nombre}  </b> </p> <p>Nro Inscripción: <b>${nroInscripcion} </b> </p>`,
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, registrar',
                            cancelButtonText: 'No, cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {

                                $.post(baseUrl + '/admin/asistencia-estudiante-registrar', { idInscripcion: idInscripcion, idAsistencia: idAsistencia, _token: crfToken })
                                    .done(function (res) {
                                        if (res.success) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: ` <p class="text-${estado == "El Ingreso" ? "success" : "danger"} ">Se registró  ${estado} del estudiante: </p>  `,
                                                html: `<p>Nombre: <b>${nombre}  </b> </p> <p>Nro Inscripción: <b>${nroInscripcion} </b> </p> `,
                                                confirmButtonColor: '#3085d6',
                                                confirmButtonText: 'Aceptar'
                                            })

                                            scrollGrupoEntrenamiento.resetScrollPagination(getDataFilter());

                                        }
                                    })
                                    .fail(function (jqXHR) {
                                        processError(jqXHR);
                                    })
                                    .always(function () {
                                        html5QrcodeScanner.resume();
                                    })

                            }
                            html5QrcodeScanner.resume();
                        })
                        return;
                    }

                    Swal.fire({
                        icon: 'warning',
                        title: `El estudiante:`,
                        html: `<p>Nombre: <b>${nombre}  </b> </p> <p>Nro Inscripcion: <b>${nroInscripcion} </b> </p> <p class="text-danger">Ya tiene registrado la asistencia del dia de hoy</p>`,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                    })
                        .then((result) => {
                            html5QrcodeScanner.resume();
                        })

                }
            })
            .fail(function (jqXHR) {
                processError(jqXHR, html5QrcodeScanner);
            })
        // .always(function () {
        //     html5QrcodeScanner.resume();
        // })


    }


    $("#nroInscripcion").select2({
        dropdownParent: $("#showModal"),
        minimumInputLength: 3,
        placeholder: "Ingrese Nro Inscripción, Nombre o C.I. del estudiante",
        language: {
            inputTooShort: function () {
                return "Ingrese 3 o más caracteres";
            },
            searching: function () {
                return "Buscando...";
            },
            noResults: function () {
                return "No se encontraron resultados";
            },

        },
        ajax: {
            url: baseUrl + '/admin/buscar-estudiante',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    search: params.term,
                };
            },
            processResults: function (data) {
                return {
                    results: data.map(item => {
                        return {
                            id: item.id,
                            text: item.text,
                            id_grupo_entrenamiento: item.id_grupo_entrenamiento,
                            foto: item.foto
                        }
                    })
                }
            },
            cache: true
        },
        templateResult: function (data) {

            if (!data.id) {
                return data.text;
            }

            var $result = $(`<span><img src="/storage/${data.foto}" class="avatar-xs  rounded"> ${data.text}</span>`);
            return $result;
        }
    }).on("select2:select", function (e) {
        let data = e.params.data;

        $("#id_grupo_entrenamiento_fk").val(data.id_grupo_entrenamiento);

        $.get(baseUrl + '/admin/listar-dias-entrenamiento-grupo', { id_grupo_entrenamiento: data.id_grupo_entrenamiento })
            .done(function (res) {
                if (!res) {
                    return;
                }

                let html = res.map(item => {
                    return `${item.nombre_dia}`
                }).join(", ");

                $("#caja-dias-entrenamiento").show();
                $("#caja-dias-entrenamiento").find("span").html(html);

            })
            .fail(function (jqXHR) {
                // processError(jqXHR);
            })
    })


    $("#tablaAsistencia")
        .on("click", ".editar-item-btn", function (e) {
            e.preventDefault();

            let id = $(this).closest("tr").data("id");

            $("#showModal").modal("show");

            resetForm();

            $.get(baseUrl + '/admin/asistencia/' + id)
                .done(function (res) {
                    if (res.success) {
                        let data = res.data;

                        $("#nroInscripcion").append(new Option(data.numero + ", " + data.nombre + " " + data.paterno + " " + data.materno + ", C.I: " + data.numero_documento, data.id_inscripcion_fk, true, true)).trigger('change').attr('disabled', 'disabled');
                        $("#id_grupo_entrenamiento_fk").val(data.id_grupo_entrenamiento);
                        $("#permiso").val(data.permiso).trigger("change");
                        $("#fecha_asistencia").val(data.fecha_asistencia);
                        if (data.permiso == 0) {
                            let ingreso = data.ingreso ? new Date(data.ingreso.replace(" ", "T")) : null;
                            let salida = data.salida ? new Date(data.salida.replace(" ", "T")) : null;
                            // poner las horas ingreso y salida en formato  "HH:mm"
                            $("#ingreso").val(ingreso.getHours().toString().padStart(2, "0") + ":" + ingreso.getMinutes().toString().padStart(2, "0"));
                            $("#salida").val(salida.getHours().toString().padStart(2, "0") + ":" + salida.getMinutes().toString().padStart(2, "0"));
                        }

                        $("#observacion").val(data.observacion);
                        $("#action").val("actualizar");
                        $("#id_asistencia").val(data.id_asistencia);
                        $("#tituloModal").text("Editar Asistencia/Permiso");
                        $("#add-btn").text("Actualizar Asistencia");

                        let html = data.dias_entrenamiento.map(item => {
                            return `${item.nombre_dia}`
                        }).join(", ");
                        $("#caja-dias-entrenamiento").show();
                        $("#caja-dias-entrenamiento").find("span").html(html);
                    }
                })
                .fail(function (jqXHR) {
                    processError(jqXHR);
                })


        })
        .on("click", ".eliminar-item-btn", function (e) {
            e.preventDefault();

            const btn = $(this);

            let itemId = btn.closest("tr").data("id");

            let fecha = btn.closest("tr").find(".row_fecha_asistencia").text();
            let codigo = btn.closest("tr").find(".row_numero").text();

            Swal.fire({
                title: `¿Estas seguro de eliminar la asistencia de fecha: ${fecha}, de la inscripcion: ${codigo} ?`,
                text: "No podras revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#5e72e4',
                cancelButtonColor: '#f5365c',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.post(baseUrl + '/admin/asistencia/' + itemId, { _token: crfToken, _method: 'DELETE' })
                        .done(function (data) {

                            if (data.success) {
                                notification(data.message, "Asistencia/Permiso Eliminado Correctamente...")

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
        })


    $("#btnRegistrarAsistencia").on("click", function (e) {
        e.preventDefault();

        resetForm();
        $("#showModal").modal("show");
    })

    $("#formAsistencia").submit(function (e) {
        e.preventDefault();

        if (document.getElementById("formAsistencia").checkValidity() === false) {
            $(this).addClass("was-validated");
            return false;
        }


        $('#add-btn').attr('disabled', 'disabled');

        let data = $(this).serializeArray();
        data.push({ name: "_token", value: crfToken });

        let actionUrl = baseUrl + '/admin/asistencia';

        if ($("#action").val() == "actualizar") {
            actionUrl = baseUrl + '/admin/asistencia/' + $("#id_asistencia").val();
            data.push({ name: "_method", value: "PUT" });
            data.push({ name: "id_inscripcion_fk", value: $("#nroInscripcion").val() });
            data.push({ name: "id_asistencia", value: $("#id_asistencia").val() });
        }

        $.post(actionUrl, data)
            .done(function (res) {

                $("#showModal").modal("hide");

                notification(data.message, "Asistencia/Permiso Guardado Correctamente...")

                resetForm();

                scrollGrupoEntrenamiento.resetScrollPagination(getDataFilter());


            })
            .fail(function (jqXHR) {
                processError(jqXHR);
            })
            .always(function () {
                $('#add-btn').removeAttr('disabled');
            })


    })


    function resetForm() {
        $("#formAsistencia")[0].reset();
        $("#formAsistencia").removeClass("was-validated");

        $("#nroInscripcion").val(null).trigger("change").removeAttr('disabled');
        $("#id_grupo_entrenamiento_fk").val(null);
        $("#permiso").val("0").trigger("change");
        $("#caja-dias-entrenamiento").hide();
        $("#id_asistencia").val(null);
        $("#action").val("crear");
        $("#tituloModal").text("Registrar Asistencia/Permiso");
        $("#add-btn").text("Registrar Asistencia");

    }

    $(".cancel-btn").on("click", function (e) {
        // e.preventDefault();
        resetForm();
    })

    $("#permiso").on("change", function (e) {
        e.preventDefault();

        if ($(this).val() == 1) {
            $("#caja-detalles").show();
            $("#caja-horas").hide();
            $("#caja-horas").attr('disabled', 'disabled');
            return;
        }

        $("#caja-detalles").hide();
        $("#caja-horas").show();
        $("#caja-horas").removeAttr('disabled');

    })


})


