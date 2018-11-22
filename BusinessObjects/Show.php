<?php
class Show{
	private $seq,$title,$description,$startdate,$enddate;
	public static $className = "Show";
	public static $tableName = "shows";
	public function setSeq($seq_){
		$this->seq = $seq_;
	}
	public function getSeq(){
		return $this->seq;
	}
	
	public function setTitle($title_){
		$this->title = $title_;
	}
	public function getTitle(){
		return $this->title;
	}
	
	public function setDescription($description_){
		$this->description = $description_;
	}
	public function getDescription(){
		return $this->description;
	}
	
	public function setStartDate($startDate_){
		$this->startdate = $startDate_;
	}
	public function getStartDate(){
		return $this->startdate;
	}
	
	public function setEndDate($endDate_){
		$this->enddate = $endDate_;
	}
	public function getEndDate(){
		return $this->enddate;
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
			if($flag){
				$this->{$attrName} = $array[$attrName];
			}
		}
	}
	
}