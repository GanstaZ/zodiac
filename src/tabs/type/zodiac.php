<?php
/**
*
* An extension for the phpBB Forum Software package.
*
* @copyright (c) GanstaZ, https://www.github.com/GanstaZ/
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace ganstaz\zodiac\src\tabs\type;

use phpbb\config\config;
use ganstaz\zodiac\src\manager;
use ganstaz\gzo\src\tabs\type\base;

/**
* Member zodiac tab
*/
class zodiac extends base
{
	public function __construct
	(
		$auth,
		$db,
		$dispatcher,
		$controller,
		$language,
		$twig,
		$user,
		private readonly config $config,
		private readonly manager $manager
	)
	{
		parent::__construct($auth, $db, $dispatcher, $controller, $language, $twig, $user);
	}

	/**
	* {@inheritdoc}
	*/
	public function namespace(): string
	{
		return '@ganstaz_zodiac/';
	}

	/**
	* {@inheritdoc}
	*/
	public function icon(): string
	{
		return 'sun-o';
	}

	/**
	* {@inheritdoc}
	*/
	public function load(string $username): void
	{
		$member = $this->get_user_data($username);

		$u_bday = $member['user_birthday'];

		if ($this->config['allow_birthdays'] && $u_bday && $this->config['gzo_zodiac'])
		{
			$this->language->add_lang(['zodiac', 'astro'], 'ganstaz/zodiac');

			// Format date
			$u_bday = str_replace(' ', '', $u_bday);
			$date = \DateTime::createFromFormat('d-m-Y', $u_bday);

			foreach ($this->manager->get_zodiac_types() as $zodiac_type)
			{
				$zodiac = $this->manager->get($zodiac_type);

				foreach ($zodiac->load($date->format($zodiac->get_format())) as $row)
				{
					$this->twig->assign_block_vars('zodiac_data', [
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
