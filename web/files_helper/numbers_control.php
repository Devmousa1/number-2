<?php

include_once 'numbers_handle.php';

function ADD_NUMBER($site,$app,$country,$server,$price,$mode='all'){
	global $numbers_db;
	global $NUMBERS;
	$response      = false;
	$saveCLI    = "{$site}#{$server}";
	$Ajmal         = $mode != 'all' ? 'showes' : 'countries';
	if(is_array($NUMBERS['numbers']["{$Ajmal}"][$app][$country])){
		if(array_key_exists($saveCLI,$NUMBERS['numbers']["{$Ajmal}"][$app][$country])){
			$response = 'already';
			return $response;
		}
	}
	$NUMBERS['numbers']["{$Ajmal}"][$app][$country][$saveCLI]  = $price;
	if($numbers_db->setData($NUMBERS)){
		$response    = true;
	}
	return $response;
}

?>