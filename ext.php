<?php
/**
*
* An extension for the phpBB Forum Software package.
*
* @copyright (c) GanstaZ, https://www.github.com/GanstaZ/
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace ganstaz\zodiac;

class ext extends \phpbb\extension\base
{
	/**
	* Enable Zodiac if GZO is enabled
	*/
	public function is_enableable(): bool
	{
		$is_enableable = true;

		$ext_manager = $this->container->get('ext.manager');

		if (!$ext_manager->is_enabled('ganstaz/gzo'))
		{
			$this->container->get('language')->add_lang('require', 'ganstaz/zodiac');
			$is_enableable = false;
		}

		return $is_enableable;
	}
}
