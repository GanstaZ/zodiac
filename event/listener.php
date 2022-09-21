<?php
/**
*
* GZO Web. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2021, GanstaZ, http://www.github.com/GanstaZ/
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace ganstaz\zodiac\event;

use phpbb\config\config;
use phpbb\language\language;
use phpbb\template\template;
use ganstaz\zodiac\core\manager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* GZO Web: Event listener
*/
class listener implements EventSubscriberInterface
{
	/** @var config */
	protected $config;

	/** @var language */
	protected $language;

	/** @var template */
	protected $template;

	/** @var manager */
	protected $manager;

	/**
	* Constructor
	*
	* @param config   $config   Config object
	* @param language $language	Language object
	* @param template $template	Template object
	* @param manager  $manager  Zodiac manager object
	*/
	public function __construct(
		config $config,
		language $language,
		template $template,
		manager $manager = null
	)
	{
		$this->config   = $config;
		$this->language = $language;
		$this->template = $template;
		$this->manager  = $manager;
	}

	/**
	* Assign functions defined in this class to event listeners in the core
	*
	* @return array
	*/
	public static function getSubscribedEvents(): array
	{
		return [
			// 'core.memberlist_view_profile' => 'view_profile_stats',
		];
	}
}
