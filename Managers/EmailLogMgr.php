<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/EmailLog.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/ExportUtil.php");
require_once $ConstantsArray['dbServerUrl'] .'PHPExcel/IOFactory.php';

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
        $query = "SELECT users.fullname,emaillogs.* from users INNER JOIN emaillogs ON users.seq = emaillogs.userseq";
        $emailLogs = self::$dataStore->executeQuery($query,true);
        $mainArr["Rows"] = $emailLogs;
        
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
