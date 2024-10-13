<?php

class OS_jello {
	
	public $DBP;
	
	private function fetch_data(){
		return json_decode(file_get_contents($this->DBP),1);
	}
	//// get key values
	/// can't key is null
	private function getData($key){
		$fetched      = $this->fetch_data();
		if(($RESPONSE = $fetched[$key])){
			return $RESPONSE;
		}
	}
	
	public function setData($data){
		$RESPONSE      = false;
		if(is_array($data)){
			file_put_contents($this->DBP,json_encode($data));
			$RESPONSE      = true;
		}
		return $RESPONSE;
	}
	
	public function getCard($nu){
		$fetched      = $this->fetch_data();
		if($fetched[$nu] != null){
			return $fetched[$nu];
		} else {
			return false;
		}
	}
	
	public function makeCard(){
		
		$qwerty     = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
		$fullCard   = array_merge($qwerty,[0,1,2,3,4,5,6,7,8,9]);
		$card          = $qwerty[array_rand($qwerty,1)];
		$length       = range(0,19);
		
		foreach($length as $y){
			$card    .= $fullCard[array_rand($fullCard,1)];
		}
		if($this->getCard($card) == false){
			return $card;
		} else {
			return $this->makeCard();
		}
	}
	
	public function delCard($card){
		$fetched      = $this->fetch_data();
		$see             = $this->getCard($card);
		if($see != false){
			unset($fetched[$card]);
			$this->setData($fetched);
		}
		return $see;
	}
	
	public function addCard($price,$owner='Admin'){
		$card           = $this->makeCard();
		$fetched      = $this->fetch_data();
		$fetched[$card]    = [
			'price'=>$price,
			'date'=>time(),
			'owner'=>$owner,
		];
		$this->setData($fetched);
		return $card;
	}
	
	public function setInviteBalance($balance){
		$fetched      = $this->fetch_data();
		$fetched['invite']['balance']    = $balance;
		return $this->setData($fetched);
	}
	
	public function getInviteBalance(){
		$fetched      = $this->fetch_data();
		if($fetched['invite']['balance'] != null){
			return $fetched['invite']['balance'];
		} else {
			$fetched['invite']['balance']     = '0.25';
			$this->setData($fetched);
			return $fetched['invite']['balance'];
		}
	}
	
	public function setJoin($channel){
		$fetched      = $this->fetch_data();
		$fetched['channel']    = $channel;
		$this->setData($fetched);
		return false;
	}
	
	public function getJoin(){
		$fetched      = $this->fetch_data();
		if($fetched['channel'] != null){
			return $fetched['channel'];
		} else {
			$fetched['channel']    = '@YemenDevs';
			$this->setData($fetched);
			return $fetched['channel'];
		}
	}
	
	public function setApiKey($site,$key){
		$fetched                = $this->fetch_data();
		$fetched[$site]     = $key;
		$this->setData($fetched);
	}
	
	public function getApiKey($site){
		$fetched                = $this->fetch_data();
		return $fetched[$site] ?? 'None';
	}
	
	public function onReady($key,$value=''){
		$fetched                = $this->fetch_data();
		if($value == ''){
			return $fetched[$key] ?? 0;
		} else {
			$fetched[$key]    += $value;
			$this->setData($fetched);
		}
	}
	
	public function __construct($opreat='Home'){
		if($opreat == 'CARDS'){
			$this->DBP     = 'database/cards.json';
		} else if($opreat == 'Home'){
			$this->DBP     = 'database/home.json';
		} else if($opreat == 'API_KEYs'){
			$this->DBP     = 'database/keys.json';
		} else if($opreat == 'GENERAL'){
			$this->DBP     = 'database/recently.json';
		}
	}
}

?>