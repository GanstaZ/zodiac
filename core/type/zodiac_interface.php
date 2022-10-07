<?php
/**
*
* GZO Web. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, GanstaZ, http://www.github.com/GanstaZ/
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace ganstaz\zodiac\core\type;

/**
* GZO Web: zodiac interface
*/
interface zodiac_interface
{
	/**
	* Returns the name of the zodiac
	*
	* @return string Name of the zodiac
	*/
	public function get_name();

	/**
	* Load the zodiac data (tropical, sidereal, chinese, myanmar)
	*
	* @param string $format Format date string to (m-d, Y & so on)
	* @return array
	*/
	public function load(string $format);

	/**
	* Get the zodiac data
	*
	* @param array $row data
	* @return array zodiac data, must have keys
	*	 [stem, sign, animal, plant, gem, ruler, extra, dir, element, name]
	*/
	public function get_data(array $row);

	/**
	* Returns the format of the zodiac date
	*
	* @return string format
	*/
	public function get_format();
}
