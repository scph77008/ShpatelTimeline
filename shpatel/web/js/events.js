$(function () {
    var JS_TIME_MODIFIER = 1000;
    $.getJSON('/app_dev.php/api/cat/1/', function (data) {
        var seriesData = [];
        var dataLabels = [];
        data.map(function (event) {
            // Фотки
            if (event.photo !== null) {
                var marker = {
                    enabled: true,
                    symbol: 'url(/uploads/events/' + event.catId + '/' + event.id + '/' + event.photo + ')',
                    width: 32,
                    height: 32
                };
            }
            else {
                var marker = {};
            }
            // Данные
            seriesData.push({
                x: event.time.timestamp * JS_TIME_MODIFIER,
                y: (event.weight > 0 ? event.weight : null),
                name: event.description,
                marker: marker
            });
            /*

             */
            // TODO: понять, что сюда кидать
            dataLabels.push([event.catId]);
        });
        $('#charts').highcharts('StockChart', {
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
            series: [
                {
                    name: 'shpatelek',
                    data: seriesData,
                    connectNulls: true,
                    // TODO: картинки в datalabels
                    dataLabels: {
                        enabled: true,
                        useHTML: true
                    }
                }
            ]
        });
        $('image').on('click', function (event) {
            $(this).fancybox({
                title: '<div class="image-description">' +
                    $('#highcharts-0 > svg > g.highcharts-tooltip > text > tspan:nth-child(1)').text() +
                    '</div> <div class="image-date">...</div>',
                titlePosition: 'inside'
            });
        });
    });
});
//# sourceMappingURL=events.js.map