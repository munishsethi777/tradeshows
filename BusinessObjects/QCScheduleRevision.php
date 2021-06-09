<?php
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/QCSchedule.php");

class QCScheduleRevision extends QCSchedule{

	private $seq,$qcseq,$revisedby;
	public static $className = "QCScheduleRevision";
	public static $tableName = "qcschedulerevisions";
	
	public function setSeq($val){
		$this->seq = $val;
	}
	public function getSeq(){
		return $this->seq;
	}
	public function setQcSeq($qcSeq){
		$this->qcseq = $qcSeq;
	}
	public function getQcSeq(){
		return $this->qcseq;
	}
	public function setRevisedByUser($revisedBy){
		$this->revisedby = $revisedBy;
	}
	public function getRevisedByUser(){
		return $this->revisedby;
	}
}
?>