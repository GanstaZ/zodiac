<?php
/**
*
* GZO Web. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2021, GanstaZ, http://www.github.com/GanstaZ/
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace ganstaz\zodiac\core\tabs\type;

use phpbb\config\config;
use ganstaz\zodiac\core\manager;
use ganstaz\web\core\tabs\type\base;

/**
* GZO Web: Member zodiac tab
*/
class zodiac extends base
{
	/** @var config */
	protected $config;

	/** @var manager */
	protected $manager;

	/**
	* Constructor
	*
	* @param config  $config  Config object
	* @param manager $manager Zodiac manager object
	*/
	public function __construct
	(
		$auth,
		$db,
		$dispatcher,
		$controller,
		$language,
		$template,
		$config,
		$manager
	)
	{
		parent::__construct($auth, $db, $dispatcher, $controller, $language, $template);

		$this->config  = $config;
		$this->manager = $manager;
	}

	/**
	* {@inheritdoc}
	*/
	public function load(string $username): void
	{
		$member = $this->get_user_data($username);
	}
}
