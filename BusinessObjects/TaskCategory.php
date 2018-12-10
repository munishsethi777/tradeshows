<?php
class TaskCategory{
	public static $tableName = "taskcategories";
	public static $className = "taskcategory";
	
	private $seq,$title,$description,$type;
	
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
	
	public function setDescription($val){
		$this->description = $val;
	}
	public function getDescription(){
		return $this->description;
	}
	
	public function setType($val){
		$this->type = $val;
	}
	public function getType(){
		return $this->type;
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