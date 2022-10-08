<?php
/**
*
* GZO Web. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, GanstaZ, https://www.github.com/GanstaZ/
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace ganstaz\zodiac\event;

use phpbb\language\language;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* GZO Zodiac: Event listener
*/
class listener implements EventSubscriberInterface
{
	/** @var language */
	protected $language;

	/**
	* Constructor
	*
	* @param language $language	Language object
	*/
	public function __construct(language $language)
	{
		$this->language = $language;
	}

	/**
	* Assign functions defined in this class to event listeners in the core
	*
	* @return array
	*/
	public static function getSubscribedEvents(): array
	{
		return [
			'core.user_setup' => 'add_language',
		];
	}

	/**
	* Event core.user_setup
	*
	* @param \phpbb\event\data $event The event object
	*/
	public function add_language($event): void
	{
		// Load a single language file from ganstaz/zodiac/language/en/common.php
		$this->language->add_lang('common', 'ganstaz/zodiac');
	}
}
