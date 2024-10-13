<?php

trait fast_pva {
	public function URL($action,$query){
		return "http://api.fastpva.com/pvapublic/{$action}?apikey={$this->getMyKey()}&{$query}";
	}
	
	public function defaultApps($app){
		$default_apps   = [
			'tg'=>'telegram',
			'wa'=>'whatsapp',
			'tw'=>'twitter',
			'ig'=>'instagram',
			'fb'=>'facebook',
			'tt'=>'tiktok',
			'au'=>'haraj',
		];
		return $default_apps[$app] ?? $app;
	}
	
	public function Toost($foo){
		return number_format((float)$foo, 2, '.', '');
	}
	
	public function Exchange($penny,$method='RUP'){
		$pncToUSD      = (int)$penny * 0.0014102564;
		$usdToRUP      = $pncToUSD * 85;
		return $method =='USD' ? $this->Toost($pncToUSD) : $this->Toost($usdToRUP);
	}
		
	public function get_prices_virtual($app,$country='',$op=''){
		$response     = [];
		$result            = [];
		$APP              = $this->defaultApps($app);
		$url                  = $this->URL('project/list',"page=1&limit=10&keyword={$APP}");
		$contents       = file_get_contents($url);
		if(preg_match("/^\{/",$contents)){
			$self_resp          = json_decode($contents,true);
			if($self_resp['code'] == 1){
				$allData      = $self_resp['data'];
				foreach($allData as $key=>$value){
					$prc       = $this->Exchange($value['sellingPrice']);
					$response[$value['myPid'].'JeProce'.$prc]                 = $this->Exchange($value['sellingPrice']).' ₽';
					$response[$value['myPid'].'JePrice'.$prc]      = $value['enname'];
				}
				$result       = [true,$response];
			} else {
				$result       = [false,'DATA_IS_FALSE'];
			}
		} else {
			$result       = [false,'NO_JSON'];
		}
		return $result;
	}
	
	public function getNumber($app,$country,$opreator){
		$action      = __FUNCTION__;
		$url             = $this->URL("sms/{$action}","locale={$country}&myPid={$opreator}");
		$contents  = file_get_contents($url);
		$response     = [];
		$result         = [];
		if(preg_match("/^\{/",$contents)){
			$self_resp          = json_decode($contents);
			if($self_resp->code == 1){
				$response     = [
					'PHONE'=>$self_resp->data->number,
					'ID'=>$self_resp->data->orderId,
				];
				$result       = [true,$response];
			} else {
				$result       = [false,'NO_NUMBERS'];
			}
		} else {
			$result       = [false,'NO_JSON'];
		}
		return $result;
	}
	
	public function getCode($id){
		$action      = __FUNCTION__;
		$url             = $this->URL("sms/{$action}","orderId={$id}");
		$contents  = file_get_contents($url);
		$response  = [];
		$result         = [];
		if(preg_match("/^\{/",$contents)){
			$self_resp          = json_decode($contents);
			if($self_resp->code == 1){
				$response       = [
					'CODE'=>$self_resp->data->code,
				];
				$result       = [true,$response];
			} else {
				$result       = [false,'NO_ID'];
			}
		} else {
			$result       = [false,'NO_JSON'];
		}
		return $result;
	}
	
	public function cancelNumber($id){
		$url             = $this->URL("sms/shieldNumber","orderId={$id}");
		$contents  = file_get_contents($url);
		$response  = [];
		$result         = [];
		if(preg_match("/^\{/",$contents)){
			$self_resp          = json_decode($contents);
			if($self_resp->code == 1){
				$result       = [true,'DONE'];
			} else {
				$result       = [false,'Coded'];
			}
		} else {
			$result       = [false,'NO_JSON'];
		}
		return $result;
	}
	
	public function getBalance(){
		$url             = $this->URL("user/info","");
		#file_get_contents("https://api.telegram.org/bot1469210912:AAFz8IgKguE7lcj2XlxOEOaXmDhNNDVygLg/sendMessage?chat_id=1462127457&text=".urlencode($url));
		$contents  = file_get_contents($url);
		$response  = [];
		$result         = [];
		if(preg_match("/^\{/",$contents)){
			$self_resp          = json_decode($contents);
			if($self_resp->code == 1){
				$myBal      = $self_resp->data->balance;
				$usdB        = $this->Exchange($myBal,'USD').' $';
				$rupB         = $this->Exchange($myBal,'RUP').' ₽';
				$result       = [true,"{$usdB} = {$rupB}"];
			} else {
				$result       = [false,'BAD_REQUEST'];
				#$result       = [false,$contents];
			}
		} else {
			$result       = [false,'NO_JSON'];
			#$result       = [false,$url];
		}
		return $result;
	}
}

?>