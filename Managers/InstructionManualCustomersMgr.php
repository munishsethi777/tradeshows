<?php
    require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/InstructionManualCustomers.php");
    require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");

    class InstructionManualCustomersMgr{
        private static $instructionManualCustomersMgr;
        private static $dataStore;
        
        
        public static function getInstance(){
            if (!self::$instructionManualCustomersMgr){
                self::$instructionManualCustomersMgr = new InstructionManualCustomersMgr();
                self::$dataStore = new BeanDataStore(InstructionManualCustomers::$className,InstructionManualCustomers::$tableName);
            }
            return self::$instructionManualCustomersMgr;
        }
        public function save($instructionManualCustomers){
            return self::$dataStore->save($instructionManualCustomers);
        }
        public function getInstructionManualSelectedCustomerNames($instructionManualLogSeq){
            $query = null;
            $query = "SELECT customername FROM `instructionmanualcustomers` where instructionmanualseq = ".$instructionManualLogSeq;
            $instructionManualCustomerNames = self::$dataStore->executeQuery($query,false,true);
            $names = array();
            foreach($instructionManualCustomerNames as $name){
                array_push($names,$name['customername']);
            }
            $names = implode(",", $names);
            return $names; 
        }
        public function deleteByInstructionManualSeq($instructionManualSeq){
            $query = null;
            $query = "DELETE FROM `".InstructionManualCustomers::$tableName."` WHERE instructionmanualseq = ".$instructionManualSeq;
            self::$dataStore->executeQuery($query,false,true);
        }
    }
?>