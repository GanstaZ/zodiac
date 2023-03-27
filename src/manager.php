<?php
/**
*
* An extension for the phpBB Forum Software package.
*
* @copyright (c) GanstaZ, https://www.github.com/GanstaZ/
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace ganstaz\zodiac\src;

use phpbb\di\service_collection;

/**
* Zodiac manager
*/
class manager
{
	protected static array $zodiac = [];

	public function __construct(private readonly service_collection $collection)
	{
		if (!empty($collection))
		{
			foreach ($collection as $type)
			{
				self::$zodiac[$type->get_name()] = $type;
			}
		}
	}

	public function get(string $name): object
	{
		return self::$zodiac[$name] ?? (object) [];
	}

	public function get_zodiac_types(): array
	{
		return array_keys(self::$zodiac) ?? [];
	}

	public function remove(string $name): void
	{
		if (isset(self::$zodiac[$name]) || array_key_exists($name, self::$zodiac))
		{
			unset(self::$zodiac[$name]);
		}
	}
}
