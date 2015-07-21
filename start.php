<?php
require_once('vendor/autoload.php');

$config = array(
	"server"   => "irc.dev",
	"port"     => 6667,
	"username" => "MrRobot",
	"realname" => "mkay..",
	"nick"     => "MrRobot",
	"channels" => array('#dev'),
	"unflood"  => 500,
	"debug"    => true,
	"log"      => __DIR__ . '/bot.log',
);

$irc = new \MyIRCBot\IRC();
$irc->setConfig($config);
$irc->main();