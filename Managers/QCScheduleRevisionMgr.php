<?php
    require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/QCScheduleRevision.php");
    require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
    class QCScheduleRevisionMgr{
        private static  $qcScheduleRevisionMgr;
        private static $dataStore;
        private static $filterExportSelectSql = "select poinchargeusers.qccode poqccode , qcschedulerevisions.qcseq as scheduleseq,classcode,users.qccode ,responsetype, qcschedulerevisions.poinchargeuser,qcschedulerevisions.*,revisedbyuser.fullname as revisedbyusername from qcschedulerevisions 
					left join users on qcschedulerevisions.qcuser = users.seq 
					left join classcodes on qcschedulerevisions.classcodeseq = classcodes.seq 
					left join users poinchargeusers on qcschedulerevisions.poinchargeuser = poinchargeusers.seq
                    left join users revisedbyuser on qcschedulerevisions.revisedbyuser = revisedbyuser.seq
					left join qcschedulesapproval on qcschedulerevisions.seq = qcschedulesapproval.qcscheduleseq and qcschedulesapproval.seq in (select max(qcschedulesapproval.seq) from qcschedulesapproval GROUP by qcschedulesapproval.qcscheduleseq)";

        public static function getInstance()
        {
            if (!self::$qcScheduleRevisionMgr)
            {
                self::$qcScheduleRevisionMgr = new QCScheduleRevisionMgr();
                self::$dataStore = new BeanDataStore(QCScheduleRevision::$className, QCScheduleRevision::$tableName);
            }
            return self::$qcScheduleRevisionMgr;
	    }
        public function saveQcScheduleRevision($qcScheduleRevision){
            return self::$dataStore->save($qcScheduleRevision);
        }
        public function saveQcScheduleRevisionWithConn($qcScheduleRevision,$conn){
            return self::$dataStore->saveObject($qcScheduleRevision,$conn);
        }
        public function getQCRevisionsByQcSeq($qcSeq){
            $sql = self::$filterExportSelectSql . " WHERE qcseq = " . $qcSeq;
            $qcRevisions = self::$dataStore->executeQuery($sql,false,true);
            return $qcRevisions;
        }
        public function getQCRevisionObjectByQCSchedule($qcSchedule){
            $sessionUtil = SessionUtil::getInstance();  
            $qcScheduleRevision = new QCScheduleRevision($qcSchedule);
            $qcScheduleRevision->setSeq(null);
            $qcScheduleRevision->setQcSeq($qcSchedule->getSeq());
            $qcScheduleRevision->setRevisedByUser($sessionUtil->getUserLoggedInSeq());
            return $qcScheduleRevision;
        }
        
    }
?>