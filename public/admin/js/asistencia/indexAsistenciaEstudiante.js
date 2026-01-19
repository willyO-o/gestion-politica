$(function () {

    'use strict';



    const diasSemana = { 0: "Domingo", 1: "Lunes", 2: "Martes", 3: "Miercoles", 4: "Jueves", 5: "Viernes", 6: "Sábado" };

    const coloresAsistencia = { "A": "success", "F": "danger", "P": "info", "": "" };

    const nombresMeses = { 0: "Enero", 1: "Febrero", 2: "Marzo", 3: "Abril", 4: "Mayo", 5: "Junio", 6: "Julio", 7: "Agosto", 8: "Septiembre", 9: "Octubre", 10: "Noviembre", 11: "Diciembre" };

    const coloresInscipcion = {"INSCRITO":"success","RETIRADO":"danger","PENDIENTE":"warning","CAMBIO DE TURNO":"secondary"};

    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: 'Anterior',
        nextText: 'Siguiente',
        currentText: 'Hoy',
        monthNames: nombresMeses,
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
            'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: '',
    };

    // Establece la configuración en español
    $.datepicker.setDefaults($.datepicker.regional['es']);


    $('#selectorMes').MonthPicker({
        Button: `<a class="input-group-text ui-button"><i class="mdi mdi-calendar mdi-24px"></i> </a>`,
        SelectedMonth: new Date(),
        MonthFormat: 'MM, yy',
        //mes maximo mes actual
        MaxMonth: 0,
        // mes minimo enero 2023
        MinMonth: new Date(2023, 0),
        // UseInputMask: true,
        OnAfterChooseMonth: function (selectedDate) {

            $("#filtroMes").val(selectedDate.toLocaleDateString()).trigger("change");
            // Do something with selected JavaScript date.
        },
        // cambiar lenguaje
    })
    // $('#js-monthpicker').monthpicker({

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
        // desabilitar el boton x para limpiar el select
        removeItemButton: false,

    };

    let listaGruposEntrenamiento = [];
    let filtroGruposEntrenamiento = new Choices("#filtroGrupoEntrenamiento", configChoices);

    $.get('/admin/listar-grupos-entrenamiento')
        .done(function (data) {

            listaGruposEntrenamiento = data;
            llenarSelectGrupo()
            listarAsistencias();

        })
        .fail(function (error) {
            console.log(error);
        });


    $("#filtroGrupoEntrenamiento, #filtroMes").on("change", function () {

        listarAsistencias();

    });



    function llenarSelectGrupo() {



        let optionsGrupoEntrenamiento = [];


        listaGruposEntrenamiento.forEach(function (row, index) {

            optionsGrupoEntrenamiento.push({
                label: row.nombre_grupo + ", Distrito: " + row.nombre_sucursal ,
                value: row.id_grupo_entrenamiento,
                id: row.id_grupo_entrenamiento,
                selected: index === 0 ? true : false,
            });


        });

        filtroGruposEntrenamiento.setChoices(optionsGrupoEntrenamiento, "value", "label", true);

        filtroGruposEntrenamiento.setChoiceByValue("");

    }

    // listarAsistencias();
    function listarAsistencias() {

        $("#tablaAsistencia").html(`<tbody><tr><td colspan="100%" class='p-5'>
                    <div class="spinner-border text-primary" role="status">
                    </div>
            </td></tr></tbody>`);

        let idGrupoEntrenamiento = filtroGruposEntrenamiento.getValue(true);
        let fechaMesSeleccionado = $("#filtroMes").val();


        if (idGrupoEntrenamiento === "") {
            return;
        }

        if (!fechaMesSeleccionado) {
            fechaMesSeleccionado = new Date().toLocaleDateString()
        }


        $.get('/admin/asistencia', { idGrupoEntrenamiento: idGrupoEntrenamiento, fechaMesSeleccionado: fechaMesSeleccionado })
            .done(function (data) {

                construrTablaAsistencia(idGrupoEntrenamiento, data, fechaMesSeleccionado);

            })
            .fail(function (error) {
                console.log(error);
            });
    }


    function construrTablaAsistencia(idGrupoEntrenamiento, listado, fechaMesSeleccionado) {

        const grupoEntrenamiento = listaGruposEntrenamiento.find(grupo => grupo.id_grupo_entrenamiento == idGrupoEntrenamiento);





        let diasEntrenamiento = grupoEntrenamiento.dia?.split(",").map(dia => dia.trim())|| [];


        if (grupoEntrenamiento.dia_extra) {


            if (!diasEntrenamiento.includes(grupoEntrenamiento.dia_extra.normalize("NFD").replace(/[\u0300-\u036f]/g, ""))) {
                diasEntrenamiento.push(grupoEntrenamiento.dia_extra);
            }

        }


        const arrayFecha = fechaMesSeleccionado.split("/");
        const mesSeleccionado = Number(arrayFecha[1]) - 1;
        const anioSeleccionado = Number(arrayFecha[2]);


        let fechasMes = generarListadoFechasMesActual(diasEntrenamiento, mesSeleccionado, anioSeleccionado);


        const diasEntrenamientoFilterObjeto = diasEntrenamiento.map(dia => {
            return {
                key: Object.keys(diasSemana).find(key => diasSemana[key] === dia.normalize("NFD").replace(/[\u0300-\u036f]/g, "")),
                value: dia
            }
        })

        // ordenar de mayor a menor segun su llave
        diasEntrenamientoFilterObjeto.sort((a, b) => a.key - b.key);





        let cabecera = construirCabeceraTabla(diasEntrenamiento, fechasMes,mesSeleccionado,anioSeleccionado);


        $("#tablaAsistencia").html(`<thead class="table-excel2">${cabecera}</thead>`);



        let cuerpoTabla = construirDatosTablaAsistencia(fechasMes, listado);

        $("#tablaAsistencia").append(`<tbody>${cuerpoTabla}</tbody>`);


    }

    // construir cabecera de tabla con el formato "inscripcione"|$Mes>Semanas>$Dias entrenamiento
    function construirCabeceraTabla(diasEntrenamiento, fechasMes,mesSeleccionado,anioSeleccionado) {



        let cantidadSemanas = Math.ceil(fechasMes.length / diasEntrenamiento.length);
        let cabecera = "<tr ><th rowspan='4' class='align-middle'>Nombre Inscrito</th></tr>";
        cabecera += `<tr><th colspan="${fechasMes.length}">Resumen de asistencia del mes de  <b > ${nombresMeses[mesSeleccionado]} - ${anioSeleccionado}</b> </th><th rowspan='3' class="text-${coloresAsistencia["A"]}">Asistencias</th> <th rowspan='3' class="text-${coloresAsistencia["F"]}">Faltas</th><th rowspan='3' class="text-${coloresAsistencia["P"]}">Permisos</th></tr>`;

        cabecera += "<tr>";
        for (let i = 1; i <= cantidadSemanas; i++) {

            cabecera += `<th colspan="${cantidadDiasSemana(fechasMes, i)}">Semana ${i}</th>`;

        }
        cabecera += "</tr>";

        cabecera += "<tr>";

        fechasMes.forEach(fecha => {
            // cabecera += `<th> <p class="mb-1">${fecha.fecha.toLocaleDateString()}</p> ${diasSemana[fecha.dia_semana] }</th>`;
            cabecera += `<th> <p class="mb-1">${fecha.fecha.getDate()}</p> ${diasSemana[fecha.dia_semana]}</th>`;
        });

        cabecera += "</tr>";


        return cabecera;
    }


    function cantidadDiasSemana(fechasMes, nroSemana) {

        let cantidad = 0;

        fechasMes.forEach(fecha => {
            if (fecha.nro_semana === nroSemana) {
                cantidad++;
            }
        });

        return cantidad;

    }


    function construirDatosTablaAsistencia(diasEntrenamiento, listado) {

        let datos = "";

        listado.forEach(row => {

            let asistencias = JSON.parse(row.asistencias);



            datos += "<tr>";
            datos += `<td class="text-start">${row.nombre} ${row.paterno} ${row.materno} <span class="badge badge-soft-${coloresInscipcion[row.estado_inscripcion] || "dark"}"> ${row.estado_inscripcion}</span></td>`;

            let totalesAsistencia = { "A": 0, "F": 0, "P": 0 };

            diasEntrenamiento.forEach(dia => {
                // extraer asistencia si existe la asistencia en el listado de asistencias usando el dia de diasEntrenamiento las asistencias estan en formato 'Y-m-d' y los diasEntrenamiento en formato Date de javascript,
                // si no existe la asistencia colocar un campo vacio

                let asistencia = extraerAsistencia(asistencias, dia.fecha);

                datos += `<td class="text-${coloresAsistencia[asistencia]}">${asistencia}</td>`;

                totalesAsistencia[asistencia]++;
            });

            datos += `<td class="text-${coloresAsistencia["A"]}">${totalesAsistencia["A"]}</td>`;
            datos += `<td class="text-${coloresAsistencia["F"]}">${totalesAsistencia["F"]}</td>`;
            datos += `<td class="text-${coloresAsistencia["P"]}">${totalesAsistencia["P"]}</td>`;
            datos += "</tr>";

        });

        return datos;

    }


    function extraerAsistencia(asistecias, diaEntrenamiento) {


        let hoy = new Date();

        if (diaEntrenamiento > hoy) {
            return "";
        }

        let asistencia = asistecias.find(asistencia => {




            if (asistencia.fecha_asistencia == null) {
                return false;
            }

            let asistenciaFecha = new Date(asistencia.fecha_asistencia + "T00:00:00");
            if (asistenciaFecha == "Invalid Date") {
                return false;
            }

            if (asistenciaFecha.toLocaleDateString() == diaEntrenamiento.toLocaleDateString()) {

                return asistencia;
            }

        });

        if (asistencia == undefined) {
            return "F";
        }

        if (asistencia.permiso == 1) {
            return "P";
        }


        return "A";


    }



    function generarListadoFechasMesActual(diasEntrenamiento, mes, anio) {

        // generar los dias del mes actual pero capturar solo los dias de entrenamiento que se encuantra en la variable diasEntrenamiento en este formato {nro_dia_mensual: (1-31), dia_semana: (0-6) , fecha: "2021-12-01"}
        let fechaMesGenerar = new Date(anio, mes, 1);

        let mesActual = fechaMesGenerar.getMonth();
        let anioActual = fechaMesGenerar.getFullYear();

        let ultimoDiaMes = new Date(anioActual, mesActual + 1, 0);

        let fechas = [];



        for (let i = 1; i <= ultimoDiaMes.getDate(); i++) {

            let fecha = new Date(anioActual, mesActual, i);


            let dia = fecha.getDay();
            let diaMensual = fecha.getDate();

            if (!diasEntrenamiento.includes(diasSemana[dia])) {
                continue;
            }
            fechas.push({ nro_dia_mensual: diaMensual, dia_semana: dia, fecha: fecha, nro_semana: getWeekNumber(fecha) });

        }

        return fechas



    }


    function getWeekNumber(date) {
        const firstDayOfMonth = new Date(date.getFullYear(), date.getMonth(), 1);
        const dayOfWeek = firstDayOfMonth.getDay(); // Día de la semana del primer día del mes
        const adjustedDate = date.getDate() + dayOfWeek - 1; // Ajustamos la fecha al inicio de la semana
        return Math.floor(adjustedDate / 7) + 1; // Calculamos la semana dentro del mes
    }


    $("#btnGenerarPDF").on("click", function (e) {
        e.preventDefault();

        let idGrupoEntrenamiento = $("#filtroGrupoEntrenamiento").val();
        let fechaMesSeleccionado = $("#filtroMes").val();


        console.log(idGrupoEntrenamiento);

        if (idGrupoEntrenamiento === "") {
            return;
        }



        window.open(`/admin/asistencia-pdf?${encodeURI(`idGrupoEntrenamiento=${idGrupoEntrenamiento}&fechaMesSeleccionado=${fechaMesSeleccionado}`)}`, "_blank");



    });

})
