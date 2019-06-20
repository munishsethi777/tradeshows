<?php
class UserRole{

	private $seq, $userseq, $role,$createdon;

	public static $className = "UserRole";
	public static $tableName = "userroles";

	public function setSeq($seq_){
		$this->seq = $seq_;
	}
	public function getSeq(){
		return $this->seq;
	}
	public function setUserSeq($val){
		$this->userseq = $val;
	}
	public function getUserSeq(){
		return $this->userseq;
	}
	public function setRole($val){
		$this->role = $val;
	}
	public function getRole(){
		return $this->role;
	}
	public function setCreatedOn($val){
		$this->createdon = $val;
	}
	public function getCreatedOn(){
		return $this->createdon;
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
