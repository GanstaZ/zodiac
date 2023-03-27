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

use phpbb\cache\service as cache;
use phpbb\db\driver\driver_interface;

class helper
{
	/** @var int type */
	protected $type = 6;

	public function __construct(
		private readonly cache $cache,
		private readonly driver_interface $db,
		private readonly string $zodiac,
		private readonly string $zodiac_dates
	)
	{
	}

	/**
	* Get zodiac data
	*/
	function zodiac_data(?int $type = null): array
	{
		if (($zodiac = $this->cache->get('_zodiac')) === false)
		{
			$sql = 'SELECT z.*, zd.*
					FROM ' . $this->zodiac . ' z, ' . $this->zodiac_dates . ' zd
					WHERE z.sign_id = zd.zid';
			$result = $this->db->sql_query($sql);

			$zodiac = [];
			while ($row = $this->db->sql_fetchrow($result))
			{
				$select = (int) $row['sign_id'];

				if ((int) $row['type'] === $this->type)
				{
					$select = (string) $row['ext'];
				}

				$zodiac[(int) $row['type']][$select] = array_filter($row);
			}
			$this->db->sql_freeresult($result);

			$this->cache->put('_zodiac', $zodiac);
		}

		return $zodiac[(int) $type] ?? $zodiac;
	}

	/**
	* Filter data
	*/
	public function filter(array $allowed): array
	{
		return array_intersect_key($this->zodiac_data(), array_flip($allowed));
	}
}
