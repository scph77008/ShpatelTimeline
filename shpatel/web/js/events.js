$(function () {
    const JS_TIME_MODIFIER = 1000;

    $.getJSON('/app_dev.php/api/?entity=Event', function (data) {
        var seriesData = [];
        var dataLabels = [];

        data.map(function (event) {
            seriesData.push([
                event.time.timestamp * JS_TIME_MODIFIER, (event.weight > 0 ? event.weight : null)
            ]);

            // TODO: понять, что сюда кидать
            dataLabels.push(event.catId);

        });
        $('#charts').highcharts('StockChart',
            {
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true
                        }
                    }
                },

                title: {
                    text: 'CATS! '
                },

                xAxis: {
                    type: 'datetime'
                },

                series:
                [
                    {
                        name: 'shpatelek',
                        data: seriesData,
                        connectNulls: true // Соеднияем точки без веса по последнему значению
                        // TODO: каринки в datalabels
                        // dataLabels: dataLabels
                    }
                ]

            });


    });

});