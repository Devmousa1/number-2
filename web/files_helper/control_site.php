<?php


trait information {
	public function key5sim_biz(){
		#return $this->show_keys()[__FUNCTION__] ?? null;
		return '11203531173e4854be4f508d2ee3df88';
	}
	
	public function fastpva_com(){
		#return $this->show_keys()[__FUNCTION__] ?? null;
	}
	
	public function key_sms_man(){
		return 'Jello747474474';
	}
	
	public function show_keys(){
		return json_decode(file_get_contents('database/keys.json'),1);
	}
	public function getMyKey(){
		$fetched        = $this->show_keys();
		return $fetched[$this->myName] ?? 'Null';
	}
}

trait curl_opreats {
	
	public function sendCurl($url,$method,$mode,$headers=[]){
		$myCurl       = curl_init();
		curl_setopt($myCurl, CURLOPT_URL, $url);
		curl_setopt($myCurl, CURLOPT_RETURNTRANSFER, $mode);
		curl_setopt($myCurl, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($myCurl, CURLOPT_HTTPHEADER, $headers);
		$result           = curl_exec($myCurl);
		#print( $result);
		if(curl_errno($myCurl)){
    		return [false, curl_error($myCurl)];
		}
		curl_close($myCurl);
		return [true,$result];
	}
}

trait a5sim_biz {
	public function URL(){
		return "https://api1.5sim.biz/stubs/handler_api.php?api_key={$this->getMyKey()}&";
	}
	
	public function get_default_apps($app){
		$apps_default = ['tg'=>'telegram','wa'=>'whatsapp','tw'=>'twitter','fb'=>'facebook','sc'=>'snapchat','nf'=>'netflix','imo'=>'imo','go'=>'google','ig'=>'instagram','tt'=>'tiktok'];
		return $apps_default[$app] ?? $app;
	}
	public function get_default_countries($country){
		$countries_default    = [
			'RU'=> 0,'UA'=> 1,'KZ'=> 2,'CN'=> 3,'PH'=> 4,'MM'=> 5,'ID'=> 6,'MY'=> 7,'KE'=> 8,'TZ'=> 9,'VN'=> 10,'KG'=> 11,'US'=> 187,'IL'=> 13,'HK'=> 14,'PL'=> 15,'GB'=> 16,'MG'=> 17,'ZR'=> 18,'NG'=> 19,'MO'=> 20,'EG'=> 21,'IN'=> 22,'IE'=> 23,'KH'=> 24,'LA'=> 25,'HT'=> 26,'CI'=> 27,'GM'=> 28,'RS'=> 29,'eee'=> 30,'ZA'=> 31,'RO'=> 32,'CO'=> 33,'EE'=> 34,'AZ'=> 35,'CA'=> 36,'MA'=> 37,'GH'=> 38,'AR'=> 39,'UZ'=> 40,'CM'=> 41,'TD'=> 42,'DE'=> 43,'LT'=> 44,'SE'=> 46,'IQ'=> 47,'NL'=> 48,'LV'=> 49,'AT'=> 50,'BY'=> 51,'TH'=> 52,'SA'=> 53,'MX'=> 54,'TW'=> 55,'ES'=> 56,'IR'=> 57,'DZ'=> 58,'SI'=> 59,'BD'=> 60,'SN'=> 61,'TR'=> 62,'CZ'=> 63,'LK'=> 64,'PE'=> 65,'PK'=> 66,'NZ'=> 67,'GN'=> 68,'ML'=> 69,'VE'=> 70,'ET'=> 71,'MN'=> 72,'BR'=> 73,'AF'=> 74,'UG'=> 75,'AO'=> 76,'CY'=> 77,'FR'=> 78,'PG'=> 79,'MZ'=> 80,'NP'=> 81,'BE'=> 82,'BG'=> 83,'HU'=> 84,'MD'=> 85,'IT'=> 86,'PY'=> 87,'HN'=> 88,'TN'=> 89,'NI'=> 90,'TL'=> 91,'BO'=> 92,'CR'=> 93,'GT'=> 94,'AE'=> 95,'ZW'=> 96,'PR'=> 97,'SD'=> 98,'TG'=> 99,'KW'=> 100,'SV'=> 101,'LY'=> 102,'JM'=> 103,'TT'=> 104,'EC'=> 105,'SZ'=> 106,'OM'=> 107,'BA'=> 108,'DO'=> 109,'SY'=> 110,'QA'=> 111,'PA'=> 112,'CU'=> 113,'MR'=> 112,'SL'=> 115,'JO'=> 116,'PT'=> 117,'BB'=> 118,'BI'=> 119,'BJ'=> 120,'BW'=> 123,'GE'=> 128,'GR'=> 129,'GW'=> 130,'GY'=> 131,'LR'=> 135,'LS'=> 136,'MW'=> 137,'NA'=> 138,'RW'=> 140,'SK'=> 141,'SR'=> 142,'TJ'=> 143,'BH'=> 145,'ZM'=> 147,'AM'=> 148,'BF'=> 152,'GA'=> 154,'AL'=> 155,'UY'=> 156,'MU'=> 157,'BT'=> 158,'MV'=> 159,'GP'=> 160,'TM'=> 161,'GF'=> 162,'FI'=> 163,'LC'=> 164,'LU'=> 165,'VC'=> 166,'GQ'=> 167,'DJ'=> 168,'AG'=> 169
		];
		return $countries_default[$country] ?? 'any';
	}
	
	public function get_prices_virtual($app,$country){
		$response     = [];
		$responsei     = [];
		$app            = $app != 'any' ? $this->get_default_apps($app) : '';
		$country     = $country != 'any' ? $this->get_default_countries($country) : 'any';
		$url     = $this->URL()."action=getPrices&country={$country}&service={$app}";
		$get_contents      = file_get_contents($url);
		#print($url);
		#$get_contents      = file_get_contents($this->URL."guest/prices?country=$country&product=$app");
		#$get_contents =  file_get_contents("https://5sim.biz/v1/guest/prices?country=russia&product={$app}");
		#file_get_contents('https://5sim.biz/v1/guest/prices?country=russia');
		if(preg_match("/^(\{|\[)/",$get_contents)){
			$self_resp          = json_decode($get_contents,true);
			print($get_contents);
			foreach ($self_resp as $country=>$lan){
				foreach($self_resp[$country] as $app=>$opreats){
					#print_r($self_resp[$country]);
					foreach($opreats as $key=>$value){
						$response[$key]   = $value['cost']." | ".$value['count'];
						$response[$key.'Jello']   = $key;
					}
				}
			}
			$responsei    = [true,$response];
		} else {
			$responsei    = [false,'NO_JSON'];
		}
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
		$action      = __FUNCTION__;
		$url             =  $this->URL()."action={$action}&service={$app}&operator={$opreator}&country={$country}";
		$headers   = $this->get_headers();
		#echo $url; exit;
		#$result      = $this->sendCurl($url,'GET',true,$headers);
		$result      = file_get_contents($url);
		if(preg_match("/[a-zA-Z\_]\:(.+)\:(.+)/",$result,$bought)){
			$result     = [true,['id'=>$bought[1],'phone'=>$bought[2]]];
			#print_r($result);
		} else {
			return [false,$result];
		}
		#print($result) ?? print_r($result);
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
		$url              =  $this->URL()."action=getStatus&id={$id}";
		$headers    = $this->get_headers();
		$result        = $this->sendCurl($url,'GET',true,$headers);
		#$result      = file_get_contents($url);
		
		if(preg_match("/[a-zA-Z\_]\:(.+)/",$result[1],$bought)){
			$result     = [true,['status'=>'RECEIVED','code'=>$bought[1]]];
		} else {
			$result   = $result[1];
		}
		
		if(is_array($result)){
			if($result[0] != false){
				$some_handle     = json_decode(json_encode($result[1]));
				if($some_handle->status == 'RECEIVED'){
					$response       = [
						#'PHONE'=>$some_handle->phone,
						'CODE'=>$some_handle->code,
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
		$url              =  $this->URL()."action=setStatus&status=8&id={$id}";
		$headers    = $this->get_headers();
		$result        = $this->sendCurl($url,'GET',true,$headers);
		if(is_array($result)){
			if($result[0] != false){
				$some_handle     = json_decode($result[1]);
				
				if($result[1] == 'ACCESS_CANCEL' || $result[1] == 'STATUS_CANCEL'){
					return [true,$result[1]];
				} else {
					return [false,$result[1]];
				}
			} else {
				return [false,'ERROR_IN_CURL'];
			}
		} else {
			return [false,'PARSE_IN_CURL'];
		}
	}
	
	public function finishNumber($id){
		#$url              =  $this->URL."user/finish/{$id}";
		$url              =  $this->URL()."action=setStatus&status=6&id={$id}";
		$headers    = $this->get_headers();
		$result        = $this->sendCurl($url,'GET',true,$headers);
		if(is_array($result)){
			if($result[0] != false){
				#$some_handle     = json_decode($result[1]);
				if(preg_match("/^ACCESS/",$result[1])){
					return [true,$result[1]];
				} else {
					return [false,$result[1]];
				}
			} else {
				return [false,'ERROR_IN_CURL'];
			}
		} else {
			return [false,'PARSE_IN_CURL',$result[1]];
		}
	}
	
	public function getBalance(){
		$action     = __FUNCTION__;
		$url            =  $this->URL()."action={$action}";
		$result      = file_get_contents($url);
		if(preg_match("/[a-zA-Z\_]\:(.+)/",$result,$balance)){
			return [true,$balance[1]];
		} else {
			return [false,$this->getMyKey()];
		}
	}
	//// other codes
}

class MySite {
	public $myName;
	#use information, curl_opreats, a5sim_biz;
	use information;
	use curl_opreats;
	#if(true){
		use a5sim_biz;
	#}
	public function __construct($site){
	$this->myName    = $site;
	}
}

include_once 'files_helper/sms-man.php';

class MySmsMan {
	public $myName;
	use information;
	use curl_opreats;
	#if(true){
		use sms_man;
	#}
	public function __construct($site){
	$this->myName    = $site;
	}
}

include_once 'files_helper/vak-sms.php';

class MyVakSms {
	public $myName;
	use information;
	use curl_opreats;
	#if(true){
		use vak_sms;
	#}
	public function __construct($site){
	$this->myName    = $site;
	}
}

include_once 'files_helper/fastpva.php';

class MyFastpva {
	public $myName;
	use information;
	use curl_opreats;
	#if(true){
		use fast_pva;
	#}
	public function __construct($site){
	$this->myName    = $site;
	}
}

include_once 'files_helper/vsms3.php';
class My_sms_3t {
	public $myName;
	use information;
	use curl_opreats;
	#if(true){
		use sms_3t;
	#}
	public function __construct($site){
	$this->myName    = $site;
	}
}

include_once 'files_helper/super-sms.php';
class My_super_sms {
	public $myName;
	use information;
	use curl_opreats;
	#if(true){
		use super_sms;
	#}
	public function __construct($site){
	$this->myName    = $site;
	}
}

include_once 'files_helper/sms-code.php';

class My_sms_code {
	public $myName;
	use information;
	use curl_opreats;
	#if(true){
		use sms_code;
	#}
	public function __construct($site){
	$this->myName    = $site;
	}
}

include_once 'files_helper/houz-sms.php';
class My_houz_sms {
	public $myName;
	use information;
	use curl_opreats;
	#if(true){
		use houz_sms;
	#}
	public function __construct($site){
	$this->myName    = $site;
	}
}

include_once 'files_helper/duraincloud.php';
class My_durain_cloud {
	public $myName;
	use information;
	use curl_opreats;
	#if(true){
		use durain_cloud;
	#}
	public function __construct($site){
	$this->myName    = $site;
	}
}

include_once 'files_helper/dromsms.php';
class My_drop_sms {
	public $myName;
	use information;
	use curl_opreats;
	#if(true){
		use drop_sms;
	#}
	public function __construct($site){
	$this->myName    = $site;
	}
}

/*

*/




/*
vps.sms3t.com
dropsms.ru
mm.duraincloud.com
h5.haozhuma.com
fastpva.com
5sim.biz
sms-code.ru
thesupercomm.com
sms-man.com
*/

function get_aclass($site){
	$aClass    = false;
	switch ($site){
		case '5sim.biz':
		$aClass     = new MySite('5sim.biz');
		break;
		case 'sms-man.com':
		$aClass     = new MySmsMan('sms-man.com');
		break;
		case 'vak-sms.com':
		$aClass     = new MyVakSms('vak-sms.com');
		break;
		case 'fastpva.com':
		$aClass     = new MyFastpva('fastpva.com');
		break;
		
		case 'vps.sms3t.com':
		$aClass     = new My_sms_3t('vps.sms3t.com');
		break;
		
		case 'dropsms.ru':
		$aClass     = new My_drop_sms('dropsms.ru');
		break;
		
		case 'mm.duraincloud.com':
		$aClass     = new My_durain_cloud('mm.duraincloud.com');
		break; 
		
		case 'h5.haozhuma.com':
		$aClass     = new My_houz_sms('h5.haozhuma.com');
		break;
		
		case 'sms-code.ru':
		$aClass     = new My_sms_code('sms-code.ru');
		break;
		
		case 'thesupercomm.com':
		$aClass     = new My_super_sms('thesupercomm.com');
		break;
	}
	return $aClass;
}
#print(
#$owner = get_aclass('5sim.biz');
#print_r($owner->get_prices_virtual('wa','RU'));
#print_r($owner->getNumber('wa','HT','any'));
#print_r($owner->getCode(421542172));
#print_r($owner->cancelNumber(421557063));
#print_r($owner->finishNumber(421542172));
?>