<?php

trait vak_sms {
	public function URL($action,$query){
		return "https://vak-sms.com/api/{$action}/?apiKey={$this->getMyKey()}&{$query}";
	}
	
	public function get_default_countries($country){
		return strtolower($country);
	}
	
	public function get_prices_virtual($app,$country,$op=''){
		$response     = [];
		$responsei     = [];
		$statusN         = 0;
		$country          = $country != 'any' ? $this->get_default_countries($country) : 'any';
		include_once 'files_helper/vak-sms_servers.php';
		foreach($operators[$country] as $opreator=>$vc){
			$url         = $this->URL('getCountNumber',"country={$country}&operator={$opreator}&service={$app}&price");
			$get_contents      = file_get_contents($url);
			#file_get_contents("https://api.telegram.org/bot1469210912:AAFz8IgKguE7lcj2XlxOEOaXmDhNNDVygLg/sendMessage?chat_id=1462127457&text=".urlencode($url));
			if(preg_match("/^(\{|\[)/",$get_contents)){
				$self_resp          = json_decode($get_contents,true);
				$response[$opreator]   = $self_resp['price']." X ".$self_resp[$app];
				$response["{$opreator}Jello"]   = $opreator;
			} else {
				$statusN++;
			}
		}
		if(count($operators[$country]) > $statusN){
			$responsei    = [true,$response];
		} else {
			$responsei    = [false,'NO_JSON'];
		}
		return $responsei;
	}
	
	public function getNumber($app,$country,$opreator){
		$country   = $this->get_default_countries($country);
		#$action      = __FUNCTION__;
		$url            = $this->URL(__FUNCTION__,"country={$country}&operator={$opreator}&service={$app}");
		$getFile    = file_get_contents($url);
		
		if(preg_match("/^(\{|\[)/",$getFile)){
			$getJSON    = json_decode($getFile,1);
			$result           = [true,$getJSON];
		} else {
			$result           = [false,$getFile];
		}
		
		if(is_array($result)){
			if($result[0] != false){
				$some_handle     = json_decode(json_encode($result[1]));
				$response       = [
					'ID'=>$some_handle->idNum,
					'PHONE'=>$some_handle->tel,
				] ?? [false,$result[1]];
				return [true,$response];
			} else {
				return [false,'ERROR_IN_CURL'];
			}
		} else {
			return [false,$result];
		}
	}
	
	public function getCode($id){
		$url            = $this->URL('getSmsCode',"idNum={$id}");
		$getFile    = file_get_contents($url);
		$response = [];
		if(preg_match("/^(\{|\[)/",$getFile)){
			$getJSON    = json_decode($getFile);
			$code            = $getJSON->smsCode;
			if($code != null && $code != 'Null'){
				$response   = [true,$code];
			} else {
				$response   = [false,$getFile];
			}
		} else {
			$response  = [false,'NO_JSON'];
		}
		return $response;
	}
	
	public function cancelNumber($id){
		$result      = [];
		if($this->getCode($id)[0] === true){
			$url            = $this->URL('setStatus',"idNum={$id}&status=bad");
			$getFile    = file_get_contents($url);
			$result       = [true,$getFile];
		} else {
			$result       = [false,$this->getCode($id)[1]];
		}
		return $result;
	}
	
	public function getBalance(){
		$url            = $this->URL(__FUNCTION__,"");
		$getFile    = file_get_contents($url);
		$response = [];
		if(preg_match("/^(\{|\[)/",$getFile)){
			$getJSON    = json_decode($getFile);
			$response  = [true,$getJSON->balance] ?? [false,$getFile];
		} else {
			$response  = [false,$getJSON];
		}
		return $response;
	}
}

?>