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
use dls\web\core\blocks\manager;
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
	* @param config		$config		Config object
	* @param language	$language	Language object
	* @param template	$template	Template object
	* @param manager	$manager	Blocks manager object
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
			'core.memberlist_view_profile' => 'view_profile_stats',
		];
	}

	/**
	* Event core.memberlist_view_profile
	*
	* @param \phpbb\event\data $event The event object
	*/
	public function view_profile_stats($event): void
	{
		$u_bday = $event['member']['user_birthday'];

		if ($this->config['allow_birthdays'] && $u_bday && $this->config['dls_zodiac'])
		{
			$this->language->add_lang(['zodiac', 'astro'], 'dls/web');

			// Format date
			$u_bday = str_replace(' ', '', $u_bday);
			$date = \DateTime::createFromFormat('d-m-Y', $u_bday);

			foreach ($this->plugin->get('zodiac') as $service)
			{
				foreach ($service->load($date->format($service->get_format())) as $row)
				{
					$this->template->assign_block_vars('zodiac_data', [
						'stem'	  => $row['stem'],
						'sign'	  => $row['sign'],
						'symbol'  => $row['symbol'],
						'plant'	  => $row['plant'],
						'gem'	  => $row['gem'],
						'ruler'	  => $row['ruler'],
						'extra'	  => $row['extra'],
						'dir'	  => $row['dir'],
						'element' => $row['element'],
						'name'	  => $row['name'],
					]);
				}
			}
		}
	}
}
