<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/QcscheduleApproval.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/ExportUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/QCScheduleApprovalType.php");
require_once $ConstantsArray['dbServerUrl'] . 'PHPExcel/IOFactory.php';

class QcscheduleApprovalMgr{
	private static  $qcScheduleApprovalMgr;
	private static $dataStore;
	public static function getInstance()
	{
		if (!self::$qcScheduleApprovalMgr)
		{
			self::$qcScheduleApprovalMgr = new QcscheduleApprovalMgr();
			self::$dataStore = new BeanDataStore(QcscheduleApproval::$className, QcscheduleApproval::$tableName);
		}
		return self::$qcScheduleApprovalMgr;
	}
	
	public function saveApprovalFromQCSchedule($qcSchedule,$responseType = null){
		$qcScheduleApproval = new QcscheduleApproval();
		$qcScheduleApproval->setAppliedOn(new DateTime());
		$qcScheduleApproval->setQcscheduleSeq($qcSchedule->getSeq());
		$userSeq = SessionUtil::getInstance()->getUserLoggedInSeq();
		$qcScheduleApproval->setUserSeq($userSeq);
		$approvalComments = "Approved";
		if(empty($responseType)){
		    $responseType = QCScheduleApprovalType::pending;
		    $approvalComments = "";
		}
		$qcScheduleApproval->setResponseComments($approvalComments);
		$qcScheduleApproval->setResponseType($responseType);
		self::$dataStore->save($qcScheduleApproval);
	}
	
	public function hasPendingApprovals($qcscheduleSeq){
		$condition["responsetype"] = QCScheduleApprovalType::pending;
		$condition["qcscheduleseq"] = $qcscheduleSeq;
		$count = self::$dataStore->executeCountQuery($condition);
		return $count >0;
	}
	
	public function isApprovalExistsForQCSchedule($qcscheduleSeq){
	    $condition["qcscheduleseq"] = $qcscheduleSeq;
	    $count = self::$dataStore->executeCountQuery($condition);
	    return $count >0;
	    
	}
	
	public function getLastestQcScheduleApproval($qcscheduleSeqs){
		$query = "select * from qcschedulesapproval where qcscheduleseq in($qcscheduleSeqs) order by seq desc";
		$approvals = self::$dataStore->executeObjectQuery($query);
		return $approvals;
	}
	
	public function getQcScheduleApproval($qcscheduleSeqs){
	    $query = "SELECT users.fullname,users.qccode,qcschedulesapproval.* FROM qcschedulesapproval left join users  on qcschedulesapproval.userseq = users.seq where qcscheduleseq in($qcscheduleSeqs) order by seq desc"; 	    
	    $approvals =  self::$dataStore->executeQuery($query);
	    unset($approvals[0]);
	    return  $approvals;
	}
	
	public function updateApprovalStatus($approvalSeq,$status,$comments){
		$condition["seq"] = $approvalSeq;
		$attr["responsetype"] = $status;
		$attr["respondedon"] = new DateTime();
		$attr["responsecomments"] = $comments;
		$sessionUtil = SessionUtil::getInstance();
		$attr["respondedbyuserseq"] = $sessionUtil->getUserLoggedInSeq();
		return self::$dataStore->updateByAttributesWithBindParams($attr,$condition);
	}
}