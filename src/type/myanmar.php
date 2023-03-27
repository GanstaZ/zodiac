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

use ganstaz\zodiac\src\helper;

/**
* Myanmar zodiac
*/
class myanmar extends base
{
	public function __construct(private readonly helper $helper)
	{
	}

	/**
	* {@inheritdoc}
	*/
	public function load(string $dob): array
	{
		$row = $this->helper->zodiac_data(6)[$dob];

		if (!empty($row))
		{
			return [$this->get_data($row)];
		}
	}
}
