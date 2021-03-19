<?php
    require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
    require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/CustomerRep.php");
    require_once($ConstantsArray['dbServerUrl'] ."Enums/CustomerRepTypes.php");
    require_once($ConstantsArray['dbServerUrl'] ."Enums/BuyerCategoryType.php");
    require_once($ConstantsArray['dbServerUrl'] ."Enums/CustomerPositionTypes.php");

    class CustomerRepMgr{
        private static $customerRepMgr;
        private static $dataStore;
        private static $selectSqlForGrid = "SELECT * From customerreps";

        public static function getInstance()
        {
            if (!self::$customerRepMgr)
            {
                self::$customerRepMgr = new CustomerRepMgr();
                self::$dataStore = new BeanDataStore(CustomerRep::$className, CustomerRep::$tableName);
            }
            return self::$customerRepMgr;
        }
        public function save($REQUEST){
            $customerRep = new CustomerRep();
            $customerRep->createFromRequest($REQUEST);
            $customerRep->setIsReceivesMonthlySalesReport($REQUEST['isreceivesmonthlysalesreport'] == 'yes' ? 1 : 0);
            self::$dataStore->save($customerRep);
        }
        public function getAllCustomerReps(){
            $query = self::$selectSqlForGrid;
            $customerReps = self::$dataStore->executeQuery($query,false,true);
            $row = array();
            foreach($customerReps as $customerRep){
                $customerRep['customerreptype'] = CustomerRepTypes::getValue($customerRep['customerreptype']);
                $customerRep['category'] = BuyerCategoryType::getValue($customerRep['category']);
                $customerRep['position'] = CustomerPositionTypes::getValue($customerRep['position']);
                array_push($row,$customerRep);
            }
            $mainArr["Rows"] = $row;
            $mainArr["TotalRows"] = $this->getAllCount(true);
            return $mainArr;
        }
        public function getAllCount($isApplyFilter){
            $count = self::$dataStore->executeCountQuery(null,$isApplyFilter);
            return $count;
        }
        public function findBySeq($seq){
            $customerRep = self::$dataStore->findBySeq($seq);
            return $customerRep;
        }
        public function deleteBySeqs($ids) {
            $flag = self::$dataStore->deleteInList ( $ids );
            return $flag;
        }
        public function findByAttributes($colValuePairArr){
            $customerReps = self::$dataStore->executeConditionQuery($colValuePairArr);
            return $customerReps;
        }
    }
?>