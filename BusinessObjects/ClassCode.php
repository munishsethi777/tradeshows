<?php
class ClassCode{
	public static $className = "ClassCode";
	public static $tableName = "classcodes";
	private $seq,$classcode,$userseq,$lastmodifiedon,$createdon,$isenabled;
	private $vendorid;
	private $vendorname;
	private $email;
	private $contactname;
	private $port;
	private $buyername;
	private $buyeremail;
	private $assistantbuyer;
	private $assistantbuyeremail;
	private $chinarepname;
	private $chinarepemail;
	public function setSeq($seq_){
		$this->seq = $seq_;
	}
	public function getSeq(){
		return $this->seq;
	}
	
	public function setClassCode($classCode_){
		$this->classcode = $classCode_;
	}
	public function getClassCode(){
		return $this->classcode;
	}
	
	public function setUserSeq($userSeq_){
		$this->userseq = $userSeq_;
	}
	public function getUserSeq(){
		return $this->userseq;
	}
	
	public function setIsEnabled($val){
		$this->isenabled = $val;
	}
	
	public function getIsEnabled(){
		return $this->isenabled;
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
	
	public function getVendorId(){
		return $this->vendorid;
	}

	public function setVendorId($vendorid){
		$this->vendorid = $vendorid;
	}

	public function getVendorName(){
		return $this->vendorname;
	}

	public function setVendorName($vendorname){
		$this->vendorname = $vendorname;
	}

	public function getemail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getContactName(){
		return $this->contactname;
	}

	public function setContactName($contactname){
		$this->contactname = $contactname;
	}

	public function getPort(){
		return $this->port;
	}

	public function setPort($port){
		$this->port = $port;
	}

	public function getBuyerName(){
		return $this->buyername;
	}

	public function setBuyerName($buyername){
		$this->buyername = $buyername;
	}

	public function getBuyerEmail(){
		return $this->buyeremail;
	}

	public function setBuyerEmail($buyeremail){
		$this->buyeremail = $buyeremail;
	}

	public function getAssistantBuyer(){
		return $this->assistantbuyer;
	}

	public function setAssistantBuyer($assistantbuyer){
		$this->assistantbuyer = $assistantbuyer;
	}

	public function getAssistantBuyerEmail(){
		return $this->assistantbuyeremail;
	}

	public function setAssistantBuyerEmail($assistantbuyeremail){
		$this->assistantbuyeremail = $assistantbuyeremail;
	}

	public function getChinaRepName(){
		return $this->chinarepname;
	}

	public function setChinaRepName($chinarepname){
		$this->chinarepname = $chinarepname;
	}

	public function getChinaRepEmail(){
		return $this->chinarepemail;
	}

	public function setChinaRenEmail($chinarepemail){
		$this->chinarepemail = $chinarepemail;
	}

	public function createFromRequest($request){
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
				}
			}
		}
	}
}