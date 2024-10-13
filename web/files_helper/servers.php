<?php

#include_once 'files_helper/control_site.php';
include_once 'files_helper/control_site.php';


function get_servers($site,$app,$country){
	#exa select_add_country_sms.com_tg_all_RU
	#$site          = $data[0];
	#$app          = $data[1];
	#$awq          = $data[2];
	#$country   = $data[3];
	
	$connect = get_aclass($site);
	
	$resp       = $connect->get_prices_virtual($app,$country);
	if(is_array($resp)){
		if($resp[0] == true){
			return $resp[1];
		}
	}
	#$ servers { Vertual1 , Vertual2 }
	##$r_data    = "select_server_{$site}_{$app}_{$awq}_{$country}";
	return ["Default"=>'any'];
}

#$connect = get_aclass('5sim.biz');
	
	#$resp       = $connect->get_prices_virtual(0,8);
#print_r(get_servers(['5sim.biz','tg','77','RU']));
?>