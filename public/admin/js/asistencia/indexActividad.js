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



    let scrollActividad = $('#tbodyActividad').scrollPagination({
        'url': baseUrl + '/admin/actividad', // the url you are fetching the results
        'method': 'get',
        'data': getDataFilter(),
        'dataTemplateCallback': rowHtml,
        'elementCountSelector': '#contadorListaActividad',
        'elementCountTemplate': '<span  class=""> Listando <b> {count}  </b>elementos de <b> {total} </b> encontrados </span>',
        'loading': '#loadingActividad',
        'scroller': "#containerListaActividad",
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

        scrollActividad.resetScrollPagination(getDataFilter());


    });



    $("#filtroSucursal,#filtroCategoria")
        .on("change", function (e) {
            e.preventDefault();

            scrollActividad.resetScrollPagination(getDataFilter());

        })


    let timer = null;
    $("#buscarAsistencia")
        .on("input", function () {

            clearTimeout(timer);

            timer = setTimeout(() => {

                scrollActividad.resetScrollPagination(getDataFilter());

            }, 500);

        });

    function getDataFilter() {


        // dataScroll.fecha_inicio = $("#filtroCategoria").val();
        // dataScroll.fecha_fin = $("#filtroSucursal").val();

        dataScroll.search = $("#buscarAsistencia").val();

        return dataScroll;
    }







    function rowHtml(item, opacity = 0) {


        let html =/*html*/ `<tr data-id="${item.id}" style='opacity:${opacity};-moz-opacity: ${opacity};filter: alpha(opacity=${opacity});'>

            <td class="row_actividad">
                ${item.nombre_actividad || ""}
            </td>

            <td class="row_fecha_asistencia">
                ${fomatDate(item.fecha_actividad || "")}
            </td>
            <td class="row_descripcion">
                ${item.descripcion || ""}
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
                    <li class="list-inline-item edit" >
                        <a href="${baseUrl}/admin/marcar-asistencia?actividad=${item.id}" class="text-muted hover-danger d-inline-block " tooltip="tooltip" data-bs-placement="top" title="Ver Asistencias de la Actividad">
                            <i class="ri-list-check fs-16"></i>
                            Asistencias
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

    // let html5QrcodeScanner = new Html5QrcodeScanner(
    //     "reader",
    //     { fps: 10, qrbox: { width: 250, height: 250 } },
    //       /* verbose= */ false);

    // html5QrcodeScanner.render(onScanSuccess, onScanFailure);



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
                            title: `¿Desea Registrar <b class="text-${estado == "El Ingreso" ? "success" : "danger"} " > ${estado}  </b>   del Militante?:`,
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
                                                title: ` <p class="text-${estado == "El Ingreso" ? "success" : "danger"} ">Se registró  ${estado} del Militante: </p>  `,
                                                html: `<p>Nombre: <b>${nombre}  </b> </p> <p>Nro Inscripción: <b>${nroInscripcion} </b> </p> `,
                                                confirmButtonColor: '#3085d6',
                                                confirmButtonText: 'Aceptar'
                                            })

                                            scrollActividad.resetScrollPagination(getDataFilter());

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
                        title: `El militante:`,
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
        placeholder: "Ingrese Nro Inscripción, Nombre o C.I. del Militante",
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


    $("#tablaActividad")
        .on("click", ".editar-item-btn", function (e) {
            e.preventDefault();

            let id = $(this).closest("tr").data("id");

            $("#showModal").modal("show");

            $.get(baseUrl + '/admin/actividad/' + id + '/edit')
                .done(function (res) {
                    $('#showModal .modal-content').html(res);
                })
                .fail(function (jqXHR) {
                    processError(jqXHR);
                })


        })
        .on("click", ".eliminar-item-btn", function (e) {
            e.preventDefault();

            const btn = $(this);

            let itemId = btn.closest("tr").data("id");

            let actividad = btn.closest("tr").find(".row_actividad").text();

            Swal.fire({
                title: `¿Estas seguro de eliminar la actividad: ${actividad} ?`,
                text: "No podras revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#5e72e4',
                cancelButtonColor: '#f5365c',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.post(baseUrl + '/admin/actividad/' + itemId, { _token: crfToken, _method: 'DELETE' })
                        .done(function (data) {

                            if (data.success) {
                                notification(data.message, "Actividad Eliminada Correctamente...")

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

        $("#showModal").modal("show");

        $.get(baseUrl + '/admin/actividad/create')
            .done(function (res) {
                $('#showModal .modal-content').html(res);

            })
            .fail(function (jqXHR) {
                processError(jqXHR);
            })

    })

    $(document).on("submit", "#formActividad", function (e) {
        e.preventDefault();

        if (document.getElementById("formActividad").checkValidity() === false) {
            $(this).addClass("was-validated");
            return false;
        }


        $('#add-btn').attr('disabled', 'disabled');

        let data = $(this).serializeArray();

        let actionUrl = $(this).attr('action');

        $.post(actionUrl, data)
            .done(function (res) {

                $("#showModal").modal("hide");

                notification(res.message, "Actividad Guardada Correctamente...");

                scrollActividad.resetScrollPagination(getDataFilter());

            })
            .fail(function (jqXHR) {
                processError(jqXHR);
            })
            .always(function () {
                $('#add-btn').removeAttr('disabled');
            })


    })





})


