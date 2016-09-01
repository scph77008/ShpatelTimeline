/// <reference path="jquery.d.ts" />
/// <reference path="highstocks.d.ts" />
/// <reference path="fancybox.d.ts" />
/// <reference path="cat.ts" />
/// <reference path="fancybox.d.ts" />
/**
 *Терминология:
 * 
 *	Highcharts:
 * @chart - общее название графика (чарта). Включает в себя объект HighchartsChartObject
 * @series - одна "линия" данных
 * @point - точка на линии
 *
 * TODO: дополнить
 */
$(function ()
{
	const JS_TIME_MODIFIER = 1000;

	/**
	 * Подгружает series для графика
	 */
	function loadCats()
	{
		/**
		 * @type Cat[] cats
		 */
		$.getJSON('/app_dev.php/api/cat/all/', function (cats)
		{
			$.each(cats, function (id, cat)
			{
				getSeriesDataByCatID(cat);
			});
		});
	}

	/**
	 * Подгружает все события для кота
	 * @param cat
	 */
	function getSeriesDataByCatID(cat)
	{
		$.getJSON('/app_dev.php/api/event/cat/' + cat.id, function (data)
		{
			var seriesData = [];

			data.map(function (event)
			{
				var marker = {};
				/**
				 * Подставляем миниатюры
				 */
				if (event.photo !== null)
				{
					marker = {
						enabled: true,
						symbol : 'url(/uploads/events/' + event.catId + '/' + event.id + '/' + event.photo + ')',
						width  : 32,
						height : 32
					}
				}

				/**
				 * Добавляет событие в линию
				 */
				seriesData.push({
					x     : event.time.timestamp * JS_TIME_MODIFIER,
					y     : (event.weight > 0 ? event.weight : null),
					name  : event.description,
					marker: marker
				});
			});

			/**
			 * Добавляет линию кота
			 */
			chart.addSeries({
				name        : cat.name,
				data        : seriesData,
				connectNulls: true, // Соеднияем точки без веса по последнему значению
				// TODO: каринки в datalabels
				dataLabels  : {
					enabled: true,
					useHTML: true
				}
			}, true)
		});
	}

	/**
	 * @type {HighchartsChartObject}
	 */
	let chart = new Highcharts.Chart(
		{
			chart: {
				renderTo         : 'charts',
				defaultSeriesType: 'spline',
				events           : {
					/**
					 * Вызывает подгрузку линий уже после создания чарта
					 */
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
			title      : {
				text: 'CATS! '
			},
			xAxis      : {
				type: 'datetime'
			},
			/**
			 * Изначально пустые данные, втянем AJAX-ом
			 */
			series     : []
		});
});
/**
 * Активруем fancybox после подгрузки изображений ajax-ом, иначе не работает
 */
$(document).ajaxStop(function ()
{
	$('image').on('click', function (event)
	{

		$(this).fancybox({
			/**
			 * Именно здесь хранится название изображения, когда курсор над ним
			 * TODO: добавить дату
			 */
			title        : '<div class="image-description">' +
			$('#highcharts-0 > svg > g.highcharts-tooltip > text > tspan:nth-child(1)').text() +
			'</div><div class="image-date">...</div>',
			titlePosition: 'inside'
		});

	});
});