$(function() {

    "use strict";

    getInicio();

    function getInicio(){

        $.post(baseUrl+'/admin/getInicio',{_token: crfToken})
        .done(function(data) {
            chartInscritosSucursal(data.data.inscritos);

        })
        .fail(function(jqXHR) {
            processError(jqXHR);
        });


    }



    function chartInscritosSucursal(data) {

        const colorRed = "#f06548";
        const colorBlue = "#25a0e2";
        let labels = [];
        let series = [];
        // let colors = [];
        let unidadesMedida = []

        data.forEach(function (item) {

            labels.push(item.nombre_sucursal);
            series.push(item.total_inscripciones);

        })



        let options = {
            series: [{
                data: series,
                name: 'Inscritos por Sucursal',
            }],
            chart: {
                type: 'bar',
                height: 436,
                toolbar: {
                    show: false,
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    horizontal: true,
                    distributed: true,
                    dataLabels: {
                        position: 'top',
                    },
                }
            },
            // colors: colors,
            dataLabels: {
                enabled: true,
                offsetX: 32,
                style: {
                    fontSize: '12px',
                    fontWeight: 400,
                    colors: ['#adb5bd']
                }
            },
            // yaxis: {
            //     labels: {
            //         formatter: function (value, indexInsumo) {
            //             if (!indexInsumo || indexInsumo.dataPointIndex == undefined) {
            //                 return value;
            //             }
            //             if (indexInsumo.dataPointIndex == -1) {
            //                 return value
            //             }
            //             return value + " " + unidadesMedida[indexInsumo.dataPointIndex];
            //         }
            //     },
            //     tickAmount: 4,
            //     min: 0
            // },

            legend: {
                show: false,
            },
            grid: {
                show: false,
            },
            xaxis: {
                categories: labels,
            },
            noData: {
                text: 'No se encontraron datos',
                align: 'center',
                verticalAlign: 'middle',
                offsetX: 0,
                offsetY: 0,
                style: {
                    color: undefined,
                    fontSize: '14px',
                    fontFamily: undefined
                }
            },
        };

        let chart2 = new ApexCharts(document.querySelector("#chartInscritosSucursal"), options);
        chart2.render();


    }


});
