<?php
/**
*
* GZO Web. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, GanstaZ, https://www.github.com/GanstaZ/
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace ganstaz\zodiac\core\type;

use ganstaz\zodiac\core\helper;

/**
* GZO Web: Myanmar zodiac
*/
class myanmar extends base
{
	/** @var helper */
	protected $helper;

	/**
	* Constructor
	*
	* @param helper $helper Zodiac helper object
	*/
	public function __construct(helper $helper)
	{
		$this->helper = $helper;
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
