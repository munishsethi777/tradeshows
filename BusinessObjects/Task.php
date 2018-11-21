<?php
class Task{
	public static $tableName = "tasks";
	public static $className = "task";

	private $seq,$taskcategoryseq,$title,$description,$daysrequired,$assignee,$startdatereferencedays,$parenttaskseq;

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

}