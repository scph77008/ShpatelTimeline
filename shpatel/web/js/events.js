$(function () {
    const JS_TIME_MODIFIER = 1000;

    $.getJSON('/app_dev.php/api/?entity=Event', function (data) {
        console.log(data);
        var seriesData = [];

        data.map(function (event) {
            seriesData.push([
                event.time.timestamp * JS_TIME_MODIFIER, event.weight
            ]);

        });
        var series = [{name: 'shpatelek', data: seriesData}];
        console.log(series);
        $('#charts').highcharts('StockChart',
            {
                title: {
                    text: 'CATS! '
                },

                xAxis: {
                    type: 'datetime'

                },

                series: series
            });


    });

});