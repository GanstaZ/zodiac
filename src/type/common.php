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

use ganstaz\zodiac\src\helper;

/**
* Common zodiac
*/
class common extends base
{
	public function __construct(private readonly helper $helper)
	{
	}

	/**
	* {@inheritdoc}
	*/
	public function load(string $dob): array
	{
		$array = [];
		foreach ($this->helper->filter([1, 2, 3, 4]) as $rows)
		{
			foreach ($rows as $row)
			{
				if ($this->compare($dob, $row))
				{
					$array[] = $this->get_data($row);
				}
			}
		}

		return $array;
	}

	protected function compare(string $dob, array $dates): bool
	{
		[$month, $day] = $this->map($dob);
		$date = $this->map($dates['date']);

		return ($month === $date[0] && $day >= $date[1]) || ($month === $date[2] && $day <= $date[3]);
	}

	protected function map(string $date): array
	{
		return array_map('intval', explode('-', $date));
	}
}
