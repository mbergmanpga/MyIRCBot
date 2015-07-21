<?php
namespace MyIRCBot;

use Philip\IRC\Response;
use Philip\Philip;

class IRC
{
	private $_config;

	/**
	 * @var User[]
	 */
	private $_users;

	/**
	 * @description
	 * @author michael.bergman@telesphere.com
	 * ---------------------------------
	 *
	 * @param $config
	 */
	private $_actions;

	public function setConfig($config)
	{
		$this->_config = $config;
	}

	public function main()
	{
		$bot = new Philip($this->_config);

		$bot->onMessages('/\!\$\([\'`"]#(.*)[\'`"]\)\.(.*)\(\);/', function ($event)
		{
			$matches = $event->getMatches();
			$username = $matches[0];
			$action = $matches[1];

			if(!isset($this->_users[$username]))
			{
				$this->_users[$username] = new User();
			}

			if(!isset($this->_actions[$action]))
			{
				$msg = "Sorry, {$this->_usersobs[$username]} I did not compute that last request";
			}
			else
			{
				$msg = $this->doDamage($this->_users[$username], Actions::PUNCHED);
			}

			$this->multiLineMsg($event, $msg);
		});

		$this->help($bot);

		$bot->run();
	}

	public function doDamage(User &$user, $action)
	{
		$username = $user->getUsername();
		$initHP = $user->getHP();
		$damage = $user->doDamage(rand(0, 40));
		$newHP = $user->getHP();

		$msg = "========================";
		$msg .= "\n $username HP:$initHP";
		$msg .= "\n $username was $action and took $damage Damage";
		$msg .= "\n $username now has $newHP HP";
		$msg .= "\n ------------------------";

		return $msg;
	}

	public function help($bot)
	{
		$bot->onMessages('/MrRobot help/i', function ($event)
		{
			$msg = "Available Commands:" .
			       "\n-------------------" .
			       "\n$('#username').punch();";

			$this->multiLineMsg($event, $msg);
		});
	}

	public function multiLineMsg($event, $msg)
	{
		$messages = explode("\n", $msg);

		foreach($messages as $message)
		{
			$event->addResponse(Response::msg(
				$event->getRequest()
				      ->getSource(),
				$message
			));
		}
	}
}