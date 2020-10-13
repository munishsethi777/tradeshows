<?php
class ClassCode{
	public static $className = "ClassCode";
	public static $tableName = "classcodes";
	private $seq,$classcode,$userseq,$lastmodifiedon,$createdon,$isenabled,$qcuser,$poinchargeuser;
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
	
	public function setQcUser($qcUser){
	    $this->qcuser = $qcUser;
	}
	
	public function getQcUser(){
	    return $this->qcuser;
	}
	
	public function setPoInchargeUser($poInchargeUser){
	    $this->poinchargeuser = $poInchargeUser;
	}
	
	public function getPoInchargeUser(){
	    return $this->poinchargeuser;
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