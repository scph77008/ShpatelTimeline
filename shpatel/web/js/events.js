$(function ()
{
	$.getJSON('/app_dev.php/api/?entity=Event', function (data)
	{
		var seriesData = [];

		data.map( function(event) {
			seriesData .push([
				event.time.timestamp, event.weight
			]);
		});
		var series = [{name:'shpatelek', data: seriesData}];

		console.log(series);
		$('#charts').highcharts('StockChart',
		{
			rangeSelector : {
				selected : 1
			},

			title : {
				text : 'CATS! '
			},

			series : series
		});


	});
	
});