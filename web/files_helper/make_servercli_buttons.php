<?php

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
*/

function make_servercli_buttons($data,$litsarray){
	$keyboard = [];
	$tableN      = 0;
	global $extra_buttons;
	foreach($litsarray as $key=>$value){
		$keyboard['inline_keyboard'][$tableN][]  = ['text'=>$key,'callback_data'=>$data.$key];
		$tableN++;
	}
	#$tableN++;
	preg_match("/^(del\-th.s)\_([^\_]+)\_/",$data,$resp);
	$ward     = $resp[2];
	$keyboard['inline_keyboard'][$tableN][]  = ['text'=>$extra_buttons['back_'],'callback_data'=>$ward];
	return $keyboard;
}

###print_r(make_servercli_buttons('del-from_tg_',$NUMBERS['numbers']['countries']['tg']['YE']));