<?php
    require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/InstructionManualCustomers.php");
    require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");

    class InstructionManualRequestsMgr{
        private static $instructionManualRequestsMgr;
        private static $dataStore;
        
        
        public static function getInstance(){
            if (!self::$instructionManualRequestsMgr){
                self::$instructionManualRequestsMgr = new InstructionManualRequestsMgr();
                self::$dataStore = new BeanDataStore(InstructionManualRequests::$className,InstructionManualRequests::$tableName);
            }
            return self::$instructionManualRequestsMgr;
        }
        public function save($instructionManualRequests){
            return self::$dataStore->save($instructionManualRequests);
        }
        public function getInstructionManualSelectedRequests($instructionManualLogSeq){
            $query = null;
            $query = "SELECT requesttype FROM `instructionmanualrequests` where instructionmanualseq = ".$instructionManualLogSeq;
            $instructionManualRequests = self::$dataStore->executeQuery($query,false,true);
            $requests = array();
            foreach($instructionManualRequests as $request){
                array_push($requests,$request['requesttype']);
            }
            $requests = implode(",", $requests);
            return $requests; 
        }
        public function deleteByInstructionManualSeq($instructionManualSeq){
            $query = null;
            $query = "DELETE FROM `".InstructionManualRequests::$tableName."` WHERE instructionmanualseq = ".$instructionManualSeq;
            self::$dataStore->executeQuery($query,false,true);
        }
    }
?>