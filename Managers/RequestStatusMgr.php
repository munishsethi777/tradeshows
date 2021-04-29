<?php
    require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/RequestStatus.php");
    require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");

    class RequestStatusMgr{
        private static $requesStatusMgr;
        private static $dataStore;
        private static $selectSql = "SELECT * FROM requeststatuses";

        public static function getInstance(){
            if (!self::$requesStatusMgr){
                self::$requesStatusMgr = new RequestStatusMgr();
                self::$dataStore = new BeanDataStore(RequestStatus::$className,RequestStatus::$tableName);
            }
            return self::$requesStatusMgr;
        }
        public function save($request,$loggedInUserSeq,$requestTypeSeq){
            $earlierStatuses = $this->findByRequestTypeSeq($requestTypeSeq);
            $currentDate = new DateTime();
            if(count($earlierStatuses)){
                foreach($earlierStatuses as $earlierRequestStatus){
                    if(!empty($request['editingrequeststatus'.$earlierRequestStatus['seq']])){
                        $colValuePair = array();
                        $colValuePair['title'] = $request['editingrequeststatus'.$earlierRequestStatus['seq']];
                        $colValuePair['lastmodifiedon'] = $currentDate;
                        $conditionPair = array();
                        $conditionPair['seq'] = $earlierRequestStatus['seq'];
                        self::$dataStore->updateByAttributes($colValuePair,$conditionPair);
                    }else{
                        self::$dataStore->deleteBySeq($earlierRequestStatus['seq']);
                    }
                }
            }
            
            if(isset($request['requeststatus'])){
                for($i=0; $i <= count($request['requeststatus']); $i++){
                    if(!empty($request['requeststatus'][$i])){
                        $requestStatus = new RequestStatus();
                        $requestStatus->setRequestTypeSeq($requestTypeSeq);
                        $requestStatus->setTitle($request['requeststatus'][$i]);
                        $requestStatus->setCreatedBy($loggedInUserSeq);
                        $requestStatus->setCreatedOn($currentDate);
                        $requestStatus->setLastModifiedOn($currentDate);
                        self::$dataStore->save($requestStatus);
                    }
                } 
            }
            
        }
        public function deleteByRequestTypeSeq($seq){
            $colValuePair['requestTypeSeq'] = $seq;
            self::$dataStore->deleteByAttribute($colValuePair);
        }
        public function findByRequestTypeSeq($seq){
            $query = self::$selectSql . " WHERE requesttypeseq = " . $seq;
            $requestStatusArray = self::$dataStore->executeQuery($query,false,true);
            return $requestStatusArray;
        }
        public function findAllForDropDown(){
            $sql = self::$selectSql;
            $requestStatuses = self::$dataStore->executeObjectQuery($sql);
            $arr = array();
            foreach ($requestStatuses as $requestStatus){
                $title = $requestStatus->getTitle();
                $seq = $requestStatus->getSeq();
                $arr[$seq] = $title;
            }
            return $arr;
        }
        public function findByColValuePair($col,$val){
            $colValuePair = array();
            $colValuePair[$col] = $val;
            $requestStatus = self::$dataStore->executeConditionQuery($colValuePair);
            return $requestStatus;
        }
        public function findBySeq($seq){
            return self::$dataStore->findBySeq($seq);
        }
    }
?>