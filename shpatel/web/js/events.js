$(function ()
{
	$.getJSON('https://www.highcharts.com/samples/data/jsonp.php?filename=usdeur.json&callback=?', function (data) 
	{
		console.log(data);
	});
	
});