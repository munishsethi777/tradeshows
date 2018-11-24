<?php
class TaskAssignee{
	public static $tableName = "taskassignees";
	public static $className = "taskassignee";
	
	private $seq,$taskseq, $userseq;
	
	public function setSeq($seq){
		$this->seq = $seq;
	}
	public function getSeq(){
		return $this->seq;
	}
	
	public function setTaskSeq($taskSeq){
		$this->taskseq = $taskSeq;
	}
	public function getTaskSeq(){
		return $this->taskseq;
	}

	public function setUserSeq($userSeq){
		$this->userseq = $userSeq;
	}
	public function getUserSeq(){
		return $this->userseq;
	}
	
}