<?php
/**
*
* An extension for the phpBB Forum Software package.
*
* @copyright (c) GanstaZ, https://www.github.com/GanstaZ/
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace ganstaz\zodiac\src\subscriber;

use phpbb\language\language;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class subscribers implements EventSubscriberInterface
{
	public function __construct(private readonly language $language)
	{
	}

	public static function getSubscribedEvents(): array
	{
		return [
			'core.user_setup' => 'add_language',
		];
	}

	/**
	* Event core.user_setup
	*/
	public function add_language(): void
	{
		$this->language->add_lang('common', 'ganstaz/zodiac');
	}
}
