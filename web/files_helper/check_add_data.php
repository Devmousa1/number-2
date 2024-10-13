<?php

include_once 'numbers_handle.php';

function check_CASC($info=[],$mode='all'){
	global $NUMBERS;
	$Ajmal         = $mode != 'all' ? 'showes' : 'countries';
	if($NUMBERS['numbers']["{$Ajmal}"][$info[1]][$info[3]][$info[0].'#'.str_replace('Jello','',$info[4])] != null){
		return 'used';
	} else {
		return 'none';
	}
}

?>