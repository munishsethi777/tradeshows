<?php
class Department{

	private $seq, $title, $isenabled,$createdon,$lastmodifiedon;

	public static $className = "Department";
	public static $tableName = "departments";

	public function setSeq($seq_){
		$this->seq = $seq_;
	}
	public function getSeq(){
		return $this->seq;
	}
	public function setTitle($val){
		$this->title = $val;
	}
	public function getTitle(){
		return $this->title;
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
