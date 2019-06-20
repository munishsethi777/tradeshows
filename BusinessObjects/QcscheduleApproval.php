<?php
class QcscheduleApproval{
	private $seq,$qcscheduleseq,$userseq,$appliedon,$respondedon,$respondedbyuserseq,$responsetype,$responsecomments;
	public static $className = "QcscheduleApproval";
	public static $tableName = "qcschedulesapproval";
	public function setSeq($seq_){
		$this->seq = $seq_;
	}
	public function getSeq(){
		return $this->seq;
	}
	
	public function setQcscheduleSeq($qcscheduled_){
		$this->qcscheduleseq = $qcscheduled_;
	}
	public function getQcscheduleSeq(){
		return $this->qcscheduleseq;
	}
	
	public function setUserSeq($userSeq_){
		$this->userseq = $userSeq_;
	}
	public function getUserSeq(){
		return $this->userseq;
	}
	
	public function setAppliedOn($appliedOn_){
		$this->appliedon = $appliedOn_;
	}
	public function getAppliedOn(){
		return $this->appliedon;
	}
	
	public function setRespondedOn($respondedOn_){
		$this->respondedon = $respondedOn_;
	}
	public function getRespondedOn(){
		return $this->respondedon;
	}
	
	public function setRespondedByUserSeq($respondedUserSeq_){
		$this->respondedbyuserseq = $respondedUserSeq_;
	}
	public function getRespondedByUserSeq(){
		return $this->respondedbyuserseq;
	}
	
	public function setResponseType($responseType_){
		$this->responsetype = $responseType_;
	}
	public function getResponsetype(){
		return $this->responsetype;
	}
	
	public function setResponseComments($comments_){
		$this->responsecomments = $comments_;
	}
	public function getResponseComments(){
		return $this->responsecomments;
	}
}