$(function () {
    const JS_TIME_MODIFIER = 1000;

    $.getJSON('/app_dev.php/api/?entity=Event', function (data) {
        var seriesData = [];

        data.map(function (event) {
            seriesData.push([
                event.time.timestamp * JS_TIME_MODIFIER, (event.weight > 0 ? event.weight : null)
            ]);
        });
        $('#charts').highcharts('StockChart',
            {
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
                    }
                ]

            });


    });

});