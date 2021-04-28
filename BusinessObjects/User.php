<?php
class User{
	public static $tableName = "users";
	public static $className = "user";
	
	private $seq,$email,$password,$fullname,$mobile,$isenabled,$qccode,$usertype,$issendnotifications,$createdon,$lastmodifiedon,$usertimezone;
	private $lastloggedindate,$isenabledmobile,$deviceid,$gcmid,$freightforwarder,$warehouse,$requestdepartments;
	
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
	
	public function setLastLoggedInDate($date_){
	    $this->lastloggedindate = $date_;
	}
	public function getLastLoggedInDate(){
	    return $this->lastloggedindate;
	}
	
	public function setIsEnabledMobile($val){
	    $this->isenabledmobile = $val;
	}
	public function getIsEnabledMobile(){
	    return $this->isenabledmobile;
	}
	
	public function setDeviceId($deviceId_){
	    $this->deviceid = $deviceId_;
	}
	public function getDeviceId(){
	    return $this->deviceid;
	}
	
	public function setGCMId($val){
	    $this->gcmid = $val;
	}
	public function getGCMId(){
	    return $this->gcmid;
	}
	public function setFreightForwarder($val){
	    $this->freightforwarder = $val;
	}
	public function getFreightForwarder(){
	    return $this->freightforwarder;
	}
	public function setWareHouse($wareHouse){
		$this->warehouse = $wareHouse;
	}
	public function getWareHouse(){
		return $this->warehouse;
	}
	public function setRequestDepartments($requestDepartments){
		$this->requestdepartments = $requestDepartments;
	}
	public function getRequestDepartments(){
		return $this->requestdepartments;
	}
	function createFromRequest($request){
		if (is_array($request)){
			$this->from_array($request);
		}
		return $this;
	}
	
	public function from_array($array){
	    foreach(get_object_vars($this) as $attrName => $attrValue){
	        $flag = property_exists(self::$className, $attrName);
	        $isExists = array_key_exists($attrName, $array);
	        if($flag && $isExists){
	            $datePos = strpos(strtolower ($attrName),'date');
	            $value = $array[$attrName];
	            if($datePos !== false && !empty($value)){
	                $value = DateUtil::StringToDateByGivenFormat("m-d-Y", $value);
	            }
	            if(!empty($value)){
	                $this->{$attrName} = $value;
	            }else{
	                $this->{$attrName} = NULL;
	            }
	        }
	    }
	}
}