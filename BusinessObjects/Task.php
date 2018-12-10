<?php
class Task{
	public static $tableName = "tasks";
	public static $className = "task";

	private $seq,$taskcategoryseq,$title,$description,$daysrequired,$assignee,$startdatereferencedays,$parenttaskseq;
	private $isCustom;

	public function setSeq($seq_){
		$this->seq = $seq_;
	}
	public function getSeq(){
		return $this->seq;
	}
	public function setTaskCategorySeq($taskCategorySeq){
		$this->taskcategoryseq = $taskCategorySeq;
	}
	public function getTaskCategorySeq(){
		return $this->taskcategoryseq;
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

	public function setDaysRequired($val){
		$this->daysrequired = $val;
	}
	public function getDaysRequired(){
		return $this->daysrequired;
	}
	
	public function setAssignee($val){
		$this->assignee = $val;
	}
	public function getAssignee(){
		return $this->assignee;
	}
	
	public function setStartDateReferenceDays($val){
		$this->startdatereferencedays = $val;
	}
	public function getStartDateReferenceDays(){
		return $this->startdatereferencedays;
	}
	
	public function setParentTaskSeq($val){
		$this->parenttaskseq = $val;
	}
	public function getParentTaskSeq(){
		return $this->parenttaskseq;
	}
	
	public function setIsCustom($isCustom_){
		$this->isCustom = $isCustom_;
	}
	public function getIsCustom(){
		return $this->isCustom;
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