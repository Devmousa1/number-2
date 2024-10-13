<?php

include_once 'files_helper/numbers_handle.php';

function del_numbers($app,$country='',$serverCLI=''){
	$awn    = 1;
	$numbers_db     = new dataBase('numbers.json');
	$NUMBERS         = $numbers_db->fetch_data();
	if($NUMBERS['numbers']['countries'][$app][$country][$serverCLI] == true){
		unset($NUMBERS['numbers']['countries'][$app][$country][$serverCLI]);
		if($awn > count($NUMBERS['numbers']['countries'][$app][$country])){
			unset($NUMBERS['numbers']['countries'][$app][$country]);
			if($awn > count($NUMBERS['numbers']['countries'][$app])){
				unset($NUMBERS['numbers']['countries'][$app]);
			}
		}
		$numbers_db->setData($NUMBERS);
	}
}

function del_showes($app,$country='',$serverCLI=''){
	$awn    = 1;
	$numbers_db     = new dataBase('numbers.json');
	$NUMBERS         = $numbers_db->fetch_data();
	if($NUMBERS['numbers']['showes'][$app][$country][$serverCLI] == true){
		unset($NUMBERS['numbers']['showes'][$app][$country][$serverCLI]);
		if($awn > count($NUMBERS['numbers']['showes'][$app][$country])){
			unset($NUMBERS['numbers']['showes'][$app][$country]);
			if($awn > count($NUMBERS['numbers']['showes'][$app])){
				unset($NUMBERS['numbers']['showes'][$app]);
			}
		}
		$numbers_db->setData($NUMBERS);
	}
}

?>