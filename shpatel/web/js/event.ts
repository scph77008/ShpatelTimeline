/**
 * Cобытие, пришедшее из API
 * Описательный класс
 * Created by andrey on 31.08.16.
 */
function Event(event)
{
	/**
	 * @type {number}
	 */
	this.id = event.id;

	/**
	 * @type {number}
	 */
	this.catId = event.catId;

	/**
	 * @type {Date}
	 */
	this.time = event.time;

	/**
	 * @type {string}
	 */
	this.photo = event.photo;

	/**
	 * @type {string}
	 */
	this.description = event.description;

	/**
	 * @type {number}
	 */
	this.weight = event.weight;
}