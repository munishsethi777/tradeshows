<?php
    require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/RequestType.php");
    require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");

    class RequestTypeMgr{
        private static $requestTypeMgr;
        private static $dataStore;
        private static $selectSqlForGrid = "SELECT requesttypes.*, departments.title as departmenttitle, users.fullname as createdbyfullname FROM requesttypes 
                                LEFT JOIN departments on departments.seq = requesttypes.departmentseq
                                LEFT JOIN users on users.seq = requesttypes.createdby";
        private static $selectCountSql = "SELECT COUNT(seq) from requesttypes";
        private static $selectSql = "SELECT * FROM requesttypes";
        public static function getInstance(){
            if (!self::$requestTypeMgr){
                self::$requestTypeMgr = new RequestTypeMgr();
                self::$dataStore = new BeanDataStore(RequestType::$className,RequestType::$tableName);
            }
            return self::$requestTypeMgr;
        }
        public function findBySeq($seq){
            $requestType = self::$dataStore->findBySeq($seq);
            return $requestType;
        }
        private function processRowsForGrid($rows){
            $sessionUtil = SessionUtil::getInstance();
            $loggedInUserTimeZone = $sessionUtil->getUserLoggedInTimeZone();
            $arr = array();
            foreach($rows as $row){
                $row["createdon"] = DateUtil::convertDateToFormat($row["createdon"],"Y-m-d H:i:s","Y-m-d H:i:s");
                // $row["approvedmanualdueprintdate"] = DateUtil::convertDateToFormat($row["approvedmanualdueprintdate"], "Y-m-d", "Y-m-d H:i:s");
                // $row["instructionmanuallogstatus"] = InstructionManualLogStatus::getValue($row["instructionmanuallogstatus"]);
                $lastModifiedOn = DateUtil::convertDateToFormatWithTimeZone($row["lastmodifiedon"], "Y-m-d H:i:s", "Y-m-d H:i:s",$loggedInUserTimeZone);
                $row["lastmodifiedon"] = $lastModifiedOn;
                array_push($arr,$row);
            }
            return $arr;
        }
        public function save($request,$loggedInUserSeq){
           $requestType = new RequestType();
           $requestType->createFromRequest($request);
           $requestType->setCreatedBy($loggedInUserSeq);
           $requestType->setCreatedOn(new DateTime);
           $requestType->setLastModifiedOn(new DateTime);
           return self::$dataStore->save($requestType);
        }
        public function getAllRequestTypes(){
            $rows = self::$dataStore->executeQuery(self::$selectSqlForGrid,true);
            $mainArr["Rows"] = $this->processRowsForGrid($rows);
            $count = self::$dataStore->executeCountQueryWithSql(self::$selectCountSql,true);
            $mainArr["TotalRows"] = $count;
            return $mainArr;
        }
        public function findAllForDropDown(){
            $sql = self::$selectSql;
            $requestTypes = self::$dataStore->executeObjectQuery($sql);
            $arr = array();
            foreach ($requestTypes as $requestType){
                $title = $requestType->getTitle();
                $seq = $requestType->getSeq();
                $arr[$seq] = $title;
            }
            return $arr;
        }
        public function findByDepartmentSeqForDropDown($seq){
            $sql = self::$selectSql . " WHERE departmentseq = " . $seq;
            $requestTypes = self::$dataStore->executeObjectQuery($sql);
            $arr = array();
            foreach ($requestTypes as $requestType){
                $title = $requestType->getTitle();
                $seq = $requestType->getSeq();
                $arr[$seq] = $title;
            }
            return $arr;
        }
    }
?>