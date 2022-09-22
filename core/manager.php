<?php
/**
*
* GZO Web. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2021, GanstaZ, http://www.github.com/GanstaZ/
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace ganstaz\zodiac\core;

use phpbb\di\service_collection;

/**
* GZO Web: zodiac manager
*/
class manager
{
	/** @var array Contains all available zodiac types */
	protected static $zodiac = false;

	/**
	* Constructor
	*
	* @param service_collection $collection
	*/
	public function __construct(service_collection $collection)
	{
		$this->register_zodiac_types($collection);
	}

	/**
	* Register all available zodiac types
	*
	* @param Service collection of zodiac types
	*/
	protected function register_zodiac_types($collection): void
	{
		if (!empty($collection))
		{
			self::$zodiac = [];
			foreach ($collection as $type)
			{
				self::$zodiac[$type->get_name()] = $type;
			}
		}
	}

	/**
	* Get zodiac type by name
	*
	* @param string $name Name of the zodiac
	* @return object
	*/
	public function get($name): object
	{
		return self::$zodiac[$name] ?? (object) [];
	}

	/**
	* Get all available zodiac types
	*
	* @return array
	*/
	public function get_zodiac_types(): array
	{
		return array_keys(self::$zodiac) ?? [];
	}

	/**
	* Remove tab
	*
	* @param string $name Name of the zodiac we want to remove
	* @return void
	*/
	public function remove($name): void
	{
		if (isset(self::$zodiac[$name]) || array_key_exists($name, self::$zodiac))
		{
			unset(self::$zodiac[$name]);
		}
	}
}
