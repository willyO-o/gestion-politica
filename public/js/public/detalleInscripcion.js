$(function () {



    const meses = {
        "1": "Enero",
        "2": "Febrero",
        "3": "Marzo",
        "4": "Abril",
        "5": "Mayo",
        "6": "Junio",
        "7": "Julio",
        "8": "Agosto",
        "9": "Septiembre",
        "10": "Octubre",
        "11": "Noviembre",
        "12": "Diciembre"
    }

    const coloresAsistencia = { "A": "success", "F": "danger", "P": "info", "": "" };


    asistenciaMensual();

    function asistenciaMensual() {

        $.post(window.baseUrl + '/asistencias-inscripcion', { idInscripcion: $('#idInscripcion').val(), idGrupoEntrenamiento: $('#idGrupo').val(), _token: window.crfToken })
            .done(function (data) {
                listarAsistencia(data.data.asistencia, data.data.diasEntrenamiento)
            })
            .fail(function (err) {
                console.log(err);
            });
    }


    function generarCabeceraAsistencia() {


        let cabeceraDias = "";

        for (let i = 1; i <= 31; i++) {
            cabeceraDias += `<th>${i}</th>`;
        }

        let cabecera = `<thead>
        <tr>
            <th >Mes - Gestión</th>
            ${cabeceraDias}
            <th class="text-${coloresAsistencia["A"]}" >Asistencias</th>
            <th class="text-${coloresAsistencia["F"]}" >Faltas</th>
            <th class="text-${coloresAsistencia["P"]}" >Permisos</th>
        </tr>
        </thead>`;

        // $('#tabla-asistencias').append(cabecera);

        return cabecera;

    }

    function listarAsistencia(listado,listaDiasEntrenamiento) {

        let filas = "";

        listado.forEach(element => {

            let totales={
                "A":0,
                "F":0,
                "P":0
            }
            let fila = `<tr> <td>${meses[element.mes]} - ${element.anio}</td>`;

            let asistenciaMes = JSON.parse(element.asistencias);

            for (let i = 1; i <= 31; i++) {

                let celdaAsistencia = verificarAsistencia(asistenciaMes, element.mes, element.anio, i, listaDiasEntrenamiento);
                fila += `<td class="text-${coloresAsistencia[celdaAsistencia]}">${celdaAsistencia}</td>`;

                totales[celdaAsistencia]++;
            }

            fila += `<td class="text-${coloresAsistencia["A"]}">${totales['A']}</td>`;
            fila += `<td class="text-${coloresAsistencia["F"]}"> ${totales['F']}</td>`;
            fila += `<td class="text-${coloresAsistencia["P"]}"> ${totales['P']}</td>`;

            fila += `</tr>`;

            filas += fila;

        });

        $('#tabla-asistencias').html(`${generarCabeceraAsistencia()} <tbody>${filas}</tbody>`);
    }

    function verificarAsistencia(asistenciaMes, mes, anio, dia,listaDiasEntrenamiento) {

        // let asistencia = asistenciaMes.find(element => element.mes == mes && element.anio == anio && element.dia == dia);

        // obtener el ultimo dia del mes en funcion al mes anio y dia
        let ultimoDia = new Date(anio, mes, 0).getDate();
        // console.log('ultimoDia', ultimoDia);

        if (dia > ultimoDia) {
            return '';
        }

        let fechaActual = new Date();
        let fechaVerificar = new Date(anio, mes - 1, dia);

        if (fechaVerificar > fechaActual) {
            return '';
        }

        let fechaInicio= new Date($('#fechaInicio').val());

        if(fechaVerificar<fechaInicio){
            return '';
        }

        let diaSemana = fechaVerificar.getDay();

        let exitente = listaDiasEntrenamiento.find(element => element.dia_semanal == diaSemana);

        // if (!exitente) {
        //     return '';
        // }




        let asistencia = asistenciaMes.find(element => {
            let fecha = new Date(element.fecha_asistencia + 'T00:00:00');

            return fecha.getDate() == dia

        });


        if(!exitente){
            if(asistencia){
                return `A`;
            }
            return '';
        }


        if(asistencia && asistencia.permiso){
            return `P`;
        }

        if (asistencia) {
            return `A`;
        }

        return `F`;

    }

})
