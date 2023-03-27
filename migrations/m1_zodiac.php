<?php
/**
*
* An extension for the phpBB Forum Software package.
*
* @copyright (c) GanstaZ, https://www.github.com/GanstaZ/
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace ganstaz\zodiac\migrations;

class m1_zodiac extends \phpbb\db\migration\migration
{
	/**
	* {@inheritdoc}
	*/
	public function effectively_installed()
	{
		return $this->check('zodiac') && $this->check('zodiac_dates') && $this->check('zodiac_symbols') && $this->check('zodiac_heavenly_stems');
	}

	/**
	* Check condition exists for a given table name
	*/
	public function check(string $name): bool
	{
		return $this->db_tools->sql_table_exists($this->table_prefix . 'gzo_' . $name);
	}

	/**
	* {@inheritdoc}
	*/
	public static function depends_on(): array
	{
		return ['\ganstaz\gzo\migrations\v24\m1_main'];
	}

	/**
	* Add the table schemas to the database:
	*/
	public function update_schema(): array
	{
		return [
			'add_tables' => [
				$this->table_prefix . 'gzo_zodiac' => [
					'COLUMNS' => [
						'sign_id' => ['UINT', null, 'auto_increment'],
						'sign'	  => ['VCHAR', ''],
						'plant'	  => ['VCHAR', ''],
						'gem'	  => ['VCHAR', ''],
						'ruler'	  => ['VCHAR', ''],
						'ext'	  => ['VCHAR', ''],
						'enr'	  => ['TINT:3', 0],
						'dir'	  => ['TINT:3', 0],
					],
					'PRIMARY_KEY' => ['sign_id'],
				],
				$this->table_prefix . 'gzo_zodiac_dates' => [
					'COLUMNS' => [
						'date_id' => ['UINT', null, 'auto_increment'],
						'zid'	  => ['UINT', 0],
						'type'	  => ['TINT:3', 0],
						'date'	  => ['VCHAR', ''],
					],
					'PRIMARY_KEY' => ['date_id'],
				],
				$this->table_prefix . 'gzo_zodiac_symbols' => [
					'COLUMNS' => [
						'symbol_id' => ['UINT', null, 'auto_increment'],
						'symbol'	=> ['VCHAR', ''],
						'type'		=> ['TINT:3', 0],
						'ruler'		=> ['VCHAR', ''],
						'ext'		=> ['VCHAR', ''],
						'dir'		=> ['TINT:3', 0],
					],
					'PRIMARY_KEY' => ['symbol_id'],
				],
				$this->table_prefix . 'gzo_zodiac_heavenly_stems' => [
					'COLUMNS' => [
						'stem_id' => ['UINT', null, 'auto_increment'],
						'snr'	  => ['TINT:3', 0],
						'enr'	  => ['TINT:3', 0],
						'sid'	  => ['TINT:3', 0],
						'aid'	  => ['TINT:3', 0],
						'bid'	  => ['TINT:3', 0],
						'cid'	  => ['TINT:3', 0],
						'did'	  => ['TINT:3', 0],
						'eid'	  => ['TINT:3', 0],
						'fid'	  => ['TINT:3', 0],
					],
					'PRIMARY_KEY' => ['stem_id'],
				],
			],
		];
	}

	/**
	* Drop the schemas from the database
	*/
	public function revert_schema(): array
	{
		return [
			'drop_tables' => [
				$this->table_prefix . 'gzo_zodiac',
				$this->table_prefix . 'gzo_zodiac_dates',
				$this->table_prefix . 'gzo_zodiac_symbols',
				$this->table_prefix . 'gzo_zodiac_heavenly_stems',
			],
		];
	}
}
