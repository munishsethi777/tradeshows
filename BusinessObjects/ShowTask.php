<?php
class ShowTask{
	private $seq,$showseq,$taskseq,$assignee,$starteddatereferencedays,$startdate,$enddate,$comments,$status;
	public static $className = "ShowTask";
	public static $tableName = "showtasks";
	
	public function setSeq($seq_){
		$this->seq = $seq_;
	}
	public function getSeq(){
		return $this->seq;
	}
	
	public function setShowSeq($showSeq_){
		$this->showseq = $showSeq_;
	}
	public function getShowSeq(){
		return $this->showseq;
	}
	
	public function setTaskSeq($taskSeq_){
		$this->taskseq = $taskSeq_;
	}
	public function getTaskSeq(){
		return $this->taskseq;
	}
	
	public function setAssignee($assigne_){
		$this->assignee = $assigne_;
	}
	public function getAssignee(){
		return $this->assignee;
	}
	
	public function setStartedDateReferenceDays($refDays_){
		$this->starteddatereferencedays = $refDays_;
	}
	public function getStartedDateReferenceDays(){
		return $this->starteddatereferencedays;
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
	
	public function setComments($comments_){
		$this->comments = $comments_;
	}
	public function getComments(){
		return $this->comments;
	}
	
	public function setStatus($status_){
		$this->status = $status_;
	}
	public function getStatus(){
		return $this->status;
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