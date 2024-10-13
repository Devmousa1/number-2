<?php

class user_config {
	
	public $user;
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
	
	public function getBalance(){
		$fetched     = $this->fetch_data();
		return $fetched['emails'][$this->user]['balance'] ?? 0;
	}
	
	
	public function addBalance($money){
		$fetched     = $this->fetch_data();
		$fetched['emails'][$this->user]['balance'] += $money;
		$this->setData($fetched);
	}
	
	public function delBalance($money,$mode='del'){
		$fetched     = $this->fetch_data();
		if($mode == 'del'){
			$fetched['emails'][$this->user]['balance']            -= $money;
		} else {
			$fetched['emails'][$this->user]['sold_balance'] += $money;
		}
		$this->setData($fetched);
	}
	
	public function setBalance($balance){
		$fetched     = $this->fetch_data();
		$fetched['emails'][$this->user]['balance'] = $balance;
		$this->setData($fetched);
	}
	
	public function addNewNumber($number,$code,$app){
		$fetched     = $this->fetch_data();
		$CPU_nu    = "«Number» / {$number} «Code» / {$code} «APP» / {$app}";
		$fetched['emails'][$this->user]['numbers']['bought'][$CPU_nu] = time();
		$this->setData($fetched);
	}
	
	public function addShowNumber($number,$code,$app){
		$fetched     = $this->fetch_data();
		$CPU_nu    = "«Number» / {$number} «Code» / {$code} «APP» / {$app}";
		$fetched['emails'][$this->user]['numbers']['shows'][$CPU_nu] = time();
		$this->setData($fetched);
	}
	
	public function getAnother($key){
		$fetched     = $this->fetch_data();
		return $fetched['emails'][$this->user][$key] ?? false;
	}
	public function getWallet(){
		$fetched     = $this->fetch_data();
		return $fetched['emails'][$this->user]['wallet'] ?? false;
	}
	
	public function getHashCode(){
		$fetched     = $this->fetch_data();
		return $fetched['emails'][$this->user]['hash_invite'] ?? false;
	}
	
	
	public function setPassword($PW_new){
		$fetched     = $this->fetch_data();
		$fetched['emails'][$this->user]['password'] = md5($PW_new);
		$this->setData($fetched);
	}
	
	public function getPassword(){
		$fetched     = $this->fetch_data();
		return $fetched['emails'][$this->user]['password'] ?? false;
	}
	
	public function getInviteURL(){
		$fetched     = $this->fetch_data();
		return $fetched['emails'][$this->user]['hash_invite'] ?? false;
	}
	
	public function getInvites(){
		$fetched     = $this->fetch_data();
		return count($fetched['emails'][$this->user]['invites']) ?? false;
	}
	
	public function addInvite($member){
		$fetched     = $this->fetch_data();
		$fetched['emails'][$this->user]['invites'][$member]     = time();
		$this->setData($fetched);
	}
	
	public function getOwner(){
		$fetched     = $this->fetch_data();
		return $fetched['emails'][$this->user]['owner'] ?? false;
	}
	
	public function getSoldBalance(){
		$fetched     = $this->fetch_data();
		return $fetched['emails'][$this->user]['sold_balance'] ?? 0;
	}
	
	public function setOwner($owner){
		$fetched     = $this->fetch_data();
		$fetched['emails'][$this->user]['owner'] = $owner;
		$this->setData($fetched);
	}
	
	public function addingCard($card){
		$fetched     = $this->fetch_data();
		$fetched['emails'][$this->user]['cards'][$card]  = time();
		$fetched['emails'][$this->user]['try'] += 1;
		$this->setData($fetched);
	}
	
	
	public function __construct($user){
		$this->user     = $user;
		$this->DBP     = 'database/emails.json';
		/* $fetched         = $this->fetch_data();
		if($fetched['emails'][$user] == null){
			exit;
		} */
	}
}
	

?>