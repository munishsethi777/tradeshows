<?php
    require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/RequestType.php");
    require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
    require_once($ConstantsArray['dbServerUrl'] ."Enums/RequestDepartments.php");

    class RequestTypeMgr{
        private static $requestTypeMgr;
        private static $dataStore;
        private static $selectSqlForGrid = "SELECT requesttypes.*, users.fullname FROM requesttypes
                                            LEFT JOIN users on users.seq = requesttypes.createdby";
        private static $selectCountSql = "SELECT COUNT(requesttypes.seq) from requesttypes LEFT JOIN users on users.seq = requesttypes.createdby";
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
                $row["requesttypes.createdon"] = DateUtil::convertDateToFormat($row["createdon"],"Y-m-d H:i:s","Y-m-d H:i:s");
                $row["department"] = RequestDepartments::getValue($row['department']);
                // $row["approvedmanualdueprintdate"] = DateUtil::convertDateToFormat($row["approvedmanualdueprintdate"], "Y-m-d", "Y-m-d H:i:s");
                // $row["instructionmanuallogstatus"] = InstructionManualLogStatus::getValue($row["instructionmanuallogstatus"]);
                $lastModifiedOn = DateUtil::convertDateToFormatWithTimeZone($row["lastmodifiedon"], "Y-m-d H:i:s", "Y-m-d H:i:s",$loggedInUserTimeZone);
                $row["requesttypes.lastmodifiedon"] = $lastModifiedOn;
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
            $userMgr = UserMgr::getInstance();
            $sessionUtil = SessionUtil::getInstance();
            $loggedInUserSeq = $sessionUtil->getUserLoggedInSeq();
            $user = $userMgr->findBySeq($loggedInUserSeq);
            $requestDepartments = $user->getRequestDepartments();
            $requestDepartments = implode("','",explode(',',$requestDepartments));
            $sql = self::$selectSqlForGrid ; 
            $rows = self::$dataStore->executeQuery($sql,true,true);
            $mainArr["Rows"] = $this->processRowsForGrid($rows);
            $countSql = self::$selectCountSql ;
            $count = self::$dataStore->executeCountQueryWithSql($countSql,true);
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
        public function findByDepartmentForDropDown($department){
            $sql = self::$selectSql . " WHERE department = '" . $department . "'";
            $requestTypes = self::$dataStore->executeObjectQuery($sql);
            $arr = array();
            foreach ($requestTypes as $requestType){
                $title = $requestType->getTitle();
                $seq = $requestType->getSeq();
                $arr[$seq] = $title;
            }
            return $arr;
        }
        public function getAttributeBySeq($attribute,$seq){
            $query = "SELECT " . $attribute . " FROM requesttypes WHERE seq = " . $seq;
            return self::$dataStore->executeQuery($query,false,true)[0][$attribute];
        }
        public function deleteBySeqs($ids) {
            $flag = self::$dataStore->deleteInList ( $ids );
            return $flag;
        }
    }
?>