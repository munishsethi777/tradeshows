<?php
class User{
	public static $tableName = "users";
	public static $className = "user";
	
	private $seq,$email,$password,$fullname,$mobile,$isenabled,$qccode,$usertype,$issendnotifications,$createdon,$lastmodifiedon,$usertimezone;
	
	public function setSeq($seq_){
		$this->seq = $seq_;
	}
	public function getSeq(){
		return $this->seq;
	}
	
	public function setEmail($val){
		$this->email = $val;
	}
	public function getEmail(){
		return $this->email;
	}
	
	public function setPassword($val){
		$this->password = $val;
	}
	public function getPassword(){
		return $this->password;
	}
	
	public function setFullName($val){
		$this->fullname = $val;
	}
	public function getFullName(){
		return $this->fullname;
	}
	
	public function setMobile($val){
		$this->mobile = $val;
	}
	public function getMobile(){
		return $this->mobile;
	}
	
	public function setIsEnabled($val){
		$this->isenabled = $val;
	}
	public function getIsEnabled(){
		return $this->isenabled;
	}
	public function setUserType($val){
		$this->usertype = $val;
	}
	public function getUserType(){
		return $this->usertype;
	}
	public function setQCCode($val){
		$this->qccode = $val;
	}
	public function getQCCode(){
		return $this->qccode;
	}
	public function setIsSendNotifications($val){
		$this->issendnotifications = $val;
	}
	public function getIsSendNotifications(){
		return $this->issendnotifications;
	}
	public function setCreatedOn($val){
		$this->createdon = $val;
	}
	public function getCreatedOn(){
		return $this->createdon;
	}
	public function setLastModifiedOn($val){
		$this->lastmodifiedon = $val;
	}
	public function getLastModifiedOn(){
		return $this->lastmodifiedon;
	}
	public function setUserTimeZone($val){
	    $this->usertimezone = $val;
	}
	public function getUserTimeZone(){
	    return $this->usertimezone;
	}
	function createFromRequest($request){
		if (is_array($request)){
			$this->from_array($request);
		}
		return $this;
	}
	
	public function from_array($array)
	{
		foreach(get_object_vars($this) as $attrName => $attrValue){
			$flag = property_exists(self::$className, $attrName);
			if($flag && array_key_exists($attrName, $array)){
				$this->{$attrName} = $array[$attrName];
			}
		}
	}
	
}