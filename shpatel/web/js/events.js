$(function () {
    var JS_TIME_MODIFIER = 1000;
    function loadCats() {
        $.getJSON('/app_dev.php/api/cat/all/', function (cats) {
            $.each(cats, function (id, cat) {
                getSeriesDataByCatID(cat);
            });
        });
    }
    function getSeriesDataByCatID(cat) {
        $.getJSON('/app_dev.php/api/event/cat/' + cat.id, function (data) {
            var seriesData = [];
            data.map(function (event) {
                var marker = {};
                if (event.photo !== null) {
                    marker = {
                        enabled: true,
                        symbol: 'url(/uploads/events/' + event.catId + '/' + event.id + '/' + event.photo + ')',
                        width: 32,
                        height: 32
                    };
                }
                seriesData.push({
                    x: event.time.timestamp * JS_TIME_MODIFIER,
                    y: (event.weight > 0 ? event.weight : null),
                    name: event.description,
                    marker: marker
                });
            });
            chart.addSeries({
                name: cat.name,
                data: seriesData,
                connectNulls: true,
                dataLabels: {
                    enabled: true,
                    useHTML: true
                }
            }, true);
        });
    }
    var chart = new Highcharts.Chart({
        chart: {
            renderTo: 'charts',
            defaultSeriesType: 'spline',
            events: {
                load: loadCats
            }
        },
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
        series: []
    });
});
$(document).ajaxStop(function () {
    $('image').on('click', function (event) {
        $(this).fancybox({
            title: '<div class="image-description">' +
                $('#highcharts-0 > svg > g.highcharts-tooltip > text > tspan:nth-child(1)').text() +
                '</div><div class="image-date">...</div>',
            titlePosition: 'inside'
        });
    });
});
//# sourceMappingURL=events.js.map