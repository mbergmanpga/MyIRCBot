<?php
require_once('vendor/autoload.php');

$config = array(
	"server"       => "irc.dev",
	"port"         => 6667,
	"username"     => "jQueryBot",
	"realname"     => "Why not javascript??",
	"nick"         => "jQueryBot",
	"channels"     => array( '#dev' ),
	"unflood"      => 500,
	"debug"        => true,
	"log"          => __DIR__ . '/bot.log',
);

$irc = new \MyIRCBot\IRC();
$irc->setConfig($config);
$irc->main();