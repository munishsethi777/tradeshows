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
	    $query = "SELECT poinchargeusers.qccode poqccode, qcschedules.itemnumbers,qcschedules.po,  qcschedules.qc, users.fullname,users.qccode,classcodes.classcode, qcschedulesapproval.* FROM qcschedulesapproval inner join qcschedules on qcschedulesapproval.qcscheduleseq = qcschedules.seq inner join users  on qcschedulesapproval.userseq = users.seq left join users poinchargeusers on qcschedules.poinchargeuser = poinchargeusers.seq inner join classcodes on classcodes.seq = qcschedules.classcodeseq where qcscheduleseq in($qcscheduleSeqs) order by seq desc"; 	    
		//$query = "SELECT qcschedules.itemnumbers,qcschedules.po,users.fullname,users.qccode,qcschedulesapproval.* FROM qcschedulesapproval inner join qcschedules on qcschedulesapproval.qcscheduleseq = qcschedules.seq inner join users  on qcschedulesapproval.userseq = users.seq where qcscheduleseq in($qcscheduleSeqs) order by seq desc"; 	    
		$approvals =  self::$dataStore->executeQuery($query);
	    $mainArr = array();
	    $sessionUtil = SessionUtil::getInstance();
	    $loggedInUserTimeZone = $sessionUtil->getUserLoggedInTimeZone();
	    foreach ($approvals as $approval){
	        $appliedOn = $approval["appliedon"];
	        $respondedOn = $approval["respondedon"];
	        $appliedOn = DateUtil::convertDateToFormatWithTimeZone($appliedOn, "Y-m-d H:i:s", "n/j/y h:i a",$loggedInUserTimeZone);
	        $respondedOn = DateUtil::convertDateToFormatWithTimeZone($respondedOn, "Y-m-d H:i:s", "n/j/y h:i a",$loggedInUserTimeZone);
	        $approval["appliedon"] = $appliedOn;
			$approval["respondedon"] = $respondedOn;
			$approval["poincharge"] = $approval["poqccode"];
	        array_push($mainArr,$approval);
	    }
	    return  $mainArr;
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