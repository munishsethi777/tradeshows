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
	
	public function saveApprovalFromQCSchedule($qcSchedule){
		$qcScheduleApproval = new QcscheduleApproval();
		$qcScheduleApproval->setAppliedOn(new DateTime());
		$qcScheduleApproval->setQcscheduleSeq($qcSchedule->getSeq());
		$userSeq = SessionUtil::getInstance()->getUserLoggedInSeq();
		$qcScheduleApproval->setUserSeq($userSeq);
		$qcScheduleApproval->setResponseType(QCScheduleApprovalType::pending);
		self::$dataStore->save($qcScheduleApproval);
		QCNotificationsUtil::sendQCApprovalNotification($qcSchedule);
	}
	
	public function hasPendingApprovals($qcscheduleSeq){
		$condition["responsetype"] = QCScheduleApprovalType::pending;
		$condition["qcscheduleseq"] = $qcscheduleSeq;
		$count = self::$dataStore->executeCountQuery($condition);
		return $count >0;
	}
	
	public function getLastestQcScheduleApproval($qcscheduleSeq){
		$query = "select * from qcschedulesapproval where qcscheduleseq = $qcscheduleSeq order by seq desc";
		$approvals = self::$dataStore->executeObjectQuery($query);
		if(!empty($approvals)){
			return $approvals[0];		
		}
		return null;
	}
	
	
	public function updateApprovalStatus($approvalSeq,$status){
		$condition["seq"] = $approvalSeq;
		$attr["responsetype"] = $status;
		return self::$dataStore->updateByAttributesWithBindParams($attr,$condition);
	}
}