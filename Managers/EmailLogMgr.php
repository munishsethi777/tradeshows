<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/EmailLog.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/ExportUtil.php");
require_once $ConstantsArray['dbServerUrl'] .'PHPExcel/IOFactory.php';
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");


class EmailLogMgr{
    
    private static  $emailLogMgr;
    private static $dataStore;
    public static function getInstance()
    {
        
        if (!self::$emailLogMgr)
        {
            self::$emailLogMgr = new EmailLogMgr();
            self::$dataStore = new BeanDataStore(EmailLog::$className, EmailLog::$tableName);
        }
        return self::$emailLogMgr;
    }
    
    public function saveEmailLog($logType,$emailId,$failureMsg,$userSeq)
    {
        $emailLog = new Emaillog(); 
        $emailLog->setUserseq($userSeq);
        $emailLog->setEmailid($emailId);
        $emailLog->setFailuremsg($failureMsg);
        $emailLog->setLogtype($logType);  
        $emailLog->setCreatedon(new DateTime());
        $emailLog->setSendon(new DateTime());
        $emailLog->setSenton(new DateTime());
        $emailLog->setAttempts(0);
        return self::$dataStore->save($emailLog);
     
    }
    
 /*   public function deleteBySeqs($ids){
        return self::$dataStore->deleteInList($ids);
    }*/
    
    public function getEmailLogsForGrid(){
        $sessionUtil = SessionUtil::getInstance();
        $loggedInUserTimeZone = $sessionUtil->getUserLoggedInTimeZone();
        $query = "SELECT users.fullname,emaillogs.* from users INNER JOIN emaillogs ON users.seq = emaillogs.userseq";
        $emailLogs = self::$dataStore->executeQuery($query,true);
        $arr = array();
        foreach($emailLogs as $emailLog){
            $sendOn  = $emailLog["sendon"];
            $sendOn = DateUtil::convertDateToFormatWithTimeZone($sendOn, "Y-m-d H:i:s", "Y-m-d H:i:s", $loggedInUserTimeZone);
            $sentOn = $emailLog["senton"];
            $sentOn = DateUtil::convertDateToFormatWithTimeZone($sentOn, "Y-m-d H:i:s", "Y-m-d H:i:s", $loggedInUserTimeZone);
            $emailLog["sendon"] = $sendOn;
            $emailLog["senton"] = $sentOn;
            array_push($arr,$emailLog);
        }
        $mainArr["Rows"] = $arr;
        $query = "select count(*) from users INNER JOIN emaillogs on users.seq = emaillogs.userseq";
        $count = self::$dataStore->executeCountQueryWithSql($query,true);
        $mainArr["TotalRows"] = $count;
        
        return $mainArr;
    }
    public function exportEmailLogs($queryString){
        
         $output = array();
         parse_str($queryString, $output);
         $_GET = array_merge($_GET,$output);
         $query = "SELECT users.fullname,emaillogs.* from users INNER JOIN emaillogs ON users.seq = emaillogs.userseq";
         $emailLogs = self::$dataStore->executeQuery($query,true);
         ExportUtil::exportEmailLogs($emailLogs);
    }
        
}
