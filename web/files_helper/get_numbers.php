<?php

include_once 'files_helper/numbers_handle.php';
/*
$NUMBERS['numbers']['countries'] = [
	'tg'=>[
		'YE'=>[
			'sms.com#virtual_24'=>70,
			'sms.com#any'=>21,
		],
		'RU'=>[
			'5sim.com#default'=>5,
			'sms-man.com#play'=>7,
		],
	],
];

include '../texts.php';
*/

function get_numbers($app='',$country='',$serverCLI=''){
	global $NUMBERS;
	global $countries_names;
	global $apps_code_name;
	if($app == ''){
		if(($response     = $NUMBERS['numbers']['countries'])){
			$response       = [true,$response];
		}
		else {
			$response      = [false,'[400 NO_NUMBERS]'];
		}
	}
	else {
		if(array_key_exists($app,$apps_code_name)){
			if($country == ''){
				if(($response     = $NUMBERS['numbers']['countries'][$app])){
					$response       = [true,$response];
				}
				else {
					$response      = [false,'[404 NO_APP_ADDED]'];
				}
			}
			else {
				if(array_key_exists($country,$countries_names)){
					if($serverCLI == ''){
						if(($response     = $NUMBERS['numbers']['countries'][$app][$country])){
							$response       = [true,$response];
						}
						else {
							$response      = [false,'[404 NO_COUNTRY_ADDED]'];
						}
					}
					else {
						if($NUMBERS['numbers']['countries'][$app][$country][$serverCLI] != null){
							$response       = $NUMBERS['numbers']['countries'][$app][$country][$serverCLI];
							$response       = [true,$response];
						}
						else {
							$response      = [false,'[404 NO_SERVER_CLI]'];
						}
					}
				}
				else {
					$response      = [false,'[403 ERROR_COUNTRY]'];
				}
			}
		}
		else {
			$response      = [false,'[403 ERROR_APP]'];
		}
	}
	
	return $response;
	
}

function get_numbers2($app='',$country='',$serverCLI=''){
	global $NUMBERS;
	global $countries_names;
	global $apps_code_name;
	if($app == ''){
		if(($response     = $NUMBERS['numbers']['showes'])){
			$response       = [true,$response];
		}
		else {
			$response      = [false,'[400 NO_NUMBERS]'];
		}
	}
	else {
		if(array_key_exists($app,$apps_code_name)){
			if($country == ''){
				if(($response     = $NUMBERS['numbers']['showes'][$app])){
					$response       = [true,$response];
				}
				else {
					$response      = [false,'[404 NO_APP_ADDED]'];
				}
			}
			else {
				if(array_key_exists($country,$countries_names)){
					if($serverCLI == ''){
						if(($response     = $NUMBERS['numbers']['showes'][$app][$country])){
							$response       = [true,$response];
						}
						else {
							$response      = [false,'[404 NO_COUNTRY_ADDED]'];
						}
					}
					else {
						if($NUMBERS['numbers']['showes'][$app][$country][$serverCLI] != null){
							$response       = $NUMBERS['numbers']['showes'][$app][$country][$serverCLI];
							$response       = [true,$response];
						}
						else {
							$response      = [false,'[404 NO_SERVER_CLI]'];
						}
					}
				}
				else {
					$response      = [false,'[403 ERROR_COUNTRY]'];
				}
			}
		}
		else {
			$response      = [false,'[403 ERROR_APP]'];
		}
	}
	
	return $response;
	
}

##print_r(get_numbers('tg','YE','sms.com#virtual_24'));