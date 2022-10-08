<?php
/**
*
* GZO Web. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, GanstaZ, https://www.github.com/GanstaZ/
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace ganstaz\zodiac\migrations;

class m3_zodiac_config extends \phpbb\db\migration\migration
{
	/**
	* {@inheritdoc}
	*/
	static public function depends_on()
	{
		return ['\ganstaz\zodiac\migrations\m1_zodiac'];
	}

	/**
	* Add the initial data in the database
	*
	* @return array Array of table data
	* @access public
	*/
	public function update_data()
	{
		return [
			// Add the config variables we want to be able to set
			['config.add', ['gzo_zodiac', 1]],
		];
	}
}
