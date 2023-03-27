<?php
/**
*
* An extension for the phpBB Forum Software package.
*
* @copyright (c) GanstaZ, https://www.github.com/GanstaZ/
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace ganstaz\zodiac\src\type;

interface zodiac_interface
{
	/**
	* Returns the name of the zodiac
	*/
	public function get_name(): string;

	/**
	* Load the zodiac data (tropical, sidereal, chinese, myanmar)
	*    $format - m-d, Y & so on
	*/
	public function load(string $format): array;

	/**
	* Get the zodiac data - zodiac data, must have keys
	*	 [stem, sign, animal, plant, gem, ruler, extra, dir, element, name]
	*/
	public function get_data(array $row): array;

	/**
	* Returns the format of the zodiac date
	*/
	public function get_format(): string;
}
