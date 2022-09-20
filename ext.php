<?php
/**
*
* GZ Web zodiac plugin. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, GanstaZ, http://www.github.com/GanstaZ/
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace ganstaz\wpz;

/**
* GZ Web zodiac plugin
*/
class ext extends \phpbb\extension\base
{
	/**
	* Enable zodiac if GZ Web is enabled
	*
	* @return bool
	* @access public
	*/
	public function is_enableable()
	{
		$is_enableable = true;

		$ext_manager = $this->container->get('ext.manager');

		if (!$ext_manager->is_enabled('ganstaz/web'))
		{
			$this->container->get('language')->add_lang('require', 'ganstaz/web');
			$is_enableable = false;
		}

		return $is_enableable;
	}
}
