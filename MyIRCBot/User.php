<?php

namespace MyIRCBot;

class User
{
	private $username;
	private $hp;
	private $level;

	public function __construct()
	{
		$this->hp = 40;
	}

	public function getUsername()
	{
		return $this->username;
	}

	public function getHP()
	{
		return $this->hp;
	}

	public function getLevel()
	{
		return $this->level;
	}

	public function doDamage($damage)
	{
		if ($this->hp > 0)
		{
			$this->hp = $this->hp -= floor($damage);
		}

		if ($this->hp < 0)
		{
			$this->hp = 0;
		}

		return $damage;
	}
}