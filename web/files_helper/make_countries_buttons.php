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

include '../texts.php';
*/

function make_countries_buttons($data,$array_countries=[],$next=false,$first=false,$loop=90,$extra=false){
	$ssl               = 0;
	$tableN        = 0;
	$width          = 0;
	$keyboard   = [];
	global $countries_names;
	global $extra_buttons;
	foreach($array_countries as $country=>$van){
		if(is_array($extra)){
			if($extra['search'] != null){
				$keyboard['inline_keyboard'][0][]  = ['text'=>$extra_buttons['search_'],'callback_data'=>'search_'.$data.$country];
				$tableN++;
				$keyboard['inline_keyboard'][$tableN][]  = ['text'=>$countries_names[$country],'callback_data'=>$data.$country];
				$width++;
				$ssl++;
				continue;
			}
		}
		if($ssl > $loop){
			break;
		}
		$keyboard['inline_keyboard'][$tableN][]  = ['text'=>$countries_names[$country],'callback_data'=>$data.$country];
		$width++;
		if($width >= 3){
			$tableN++;
			$width   -= 3;
		}
	}
	if($next != false || $first != false){
		$tableN++;
		if($next != false){
			$keyboard['inline_keyboard'][$tableN][]  = ['text'=>$extra_buttons['next_'],'callback_data'=>"move_{$loop}_".$data];
		}
		if($first != false){
			$keyboard['inline_keyboard'][$tableN][]  = ['text'=>$extra_buttons['first_'],'callback_data'=>"goto_{$loop}_".$data];
		}
	}
	$tableN++;
	$keyboard['inline_keyboard'][$tableN][]  = ['text'=>$extra_buttons['back_'],'callback_data'=>"delCountry"];
	return $keyboard;
}

##print_r(make_countries_buttons('del-from_tg_',$NUMBERS['numbers']['countries']['tg'],1,1));
?>