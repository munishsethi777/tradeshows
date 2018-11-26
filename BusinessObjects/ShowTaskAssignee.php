<?php
class ShowTaskAssignee{
	public static $tableName = "showtaskassignees";
	public static $className = "showtaskassignee";

	private $seq,$showtaskseq, $userseq;

	public function setSeq($seq){
		$this->seq = $seq;
	}
	public function getSeq(){
		return $this->seq;
	}

	public function setShowTaskSeq($showTaskSeq){
		$this->showtaskseq = $showTaskSeq;
	}
	public function getShowTaskSeq(){
		return $this->showtaskseq;
	}

	public function setUserSeq($userSeq){
		$this->userseq = $userSeq;
	}
	public function getUserSeq(){
		return $this->userseq;
	}

}