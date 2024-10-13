<?php


function get_countries_view($from=0,$to=30){
	if($to == 'all'){
		return array_slice($countries_names,$from);
	}
	return array_slice($countries_names,$from,$to);
}


?>
