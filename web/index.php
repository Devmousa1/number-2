<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo('Script started');
date_default_timezone_set('Asia/Aden');

include_once 'regEx.php';
include_once "dbControl.php";

include_once 'info.php';

$myURL    = $_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'];
$url            = "https://api.telegram.org/bot{$bot_API_KEY}/setWebHook?url={$myURL}";
echo('url: ' . $url);
$response = file_get_contents($url);

// Log webhook response
echo('Webhook set response: ' . $response);
include_once "telegram_bot.php";
/*
if(preg_match("/^\{/",$argv[1])){
	$update                       = json_decode($argv[1]) ?? [];
}
*/

$update = json_decode(file_get_contents('php://input'));
echo('Update received: ' . print_r($update, true));

if($update != null){
	include_once 'variables.php';
	include_once 'mybot.php';
	echo('Bot logic executed');
	exit;
}
echo('No update received, exiting.');
exit;



?>