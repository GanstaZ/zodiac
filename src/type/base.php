<?php
/**
*
* An extension for the phpBB Forum Software package.
*
* @copyright (c) GanstaZ, https://www.github.com/GanstaZ/
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace ganstaz\zodiac\src\type;

abstract class base implements zodiac_interface
{
	protected string $name;

	protected string $format;

	protected array $types = ['ZODIAC', 'TROPICAL', 'SIDEREAL', 'NATIVE', 'CELTIC', 'CHINESE', 'MYANMAR',];

	protected array $elements = [
		1 => 'FIRE',
		2 => 'EARTH',
		3 => 'AIR',
		4 => 'WATER',
		5 => 'WOOD',
		6 => 'METAL',
		7 => 'TOTEM',
	];

	/** cardinal directions */
	protected array $direction = [
		1 => 'NORTH',
		2 => 'EAST',
		3 => 'SOUTH',
		4 => 'WEST',
		5 => 'NORTHEAST',
		6 => 'SOUTHEAST',
		7 => 'SOUTHWEST',
		8 => 'NORTHWEST',
		9 => 'CENTER',
	];

	/**
	* {@inheritdoc}
	*/
	public function get_data(array $row): array
	{
		return [
			'stem'	  => isset($row['snr']) ? (int) $row['snr'] : '',
			'sign'	  => isset($row['sign']) ? (string) $row['sign'] : '',
			'symbol'  => isset($row['symbol']) ? (string) $row['symbol'] : '',
			'plant'	  => isset($row['plant']) ? (string) $row['plant'] : '',
			'gem'	  => isset($row['gem']) ? (string) $row['gem'] : '',
			'ruler'	  => isset($row['ruler']) ? (string) $row['ruler'] : '',
			'extra'	  => isset($row['ext']) ? (string) $row['ext'] : '',
			'dir'	  => isset($row['dir']) ? $this->direction[(int) $row['dir']] : '',
			'element' => isset($row['enr']) ? $this->elements[(int) $row['enr']] : '',
			'name'	  => isset($row['type']) ? $this->types[(int) $row['type']] : '',
		];
	}

	/**
	* Sets the name of the zodiac
	*/
	public function set_name(string $name): void
	{
		$this->name = $name;
	}

	/**
	* {@inheritdoc}
	*/
	public function get_name(): string
	{
		return $this->name;
	}

	/**
	* {@inheritdoc}
	*/
	public function get_format(): string
	{
		return $this->format;
	}

	/**
	* Sets the format of the zodiac
	*/
	public function set_format(string $format): void
	{
		$this->format = $format;
	}
}
