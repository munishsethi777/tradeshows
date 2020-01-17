<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/BuyerMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/AlpineSpecialProgram.php");
class AlpineSpecialProgramMgr{
    
    private static  $AlpineSpecialProgram;
    private static $dataStore;
    public static function getInstance()
    {
        if (!self::$AlpineSpecialProgram)
        {
            self::$AlpineSpecialProgram = new AlpineSpecialProgramMgr();
            self::$dataStore = new BeanDataStore(AlpineSpecialProgram::$className, AlpineSpecialProgram::$tableName);
        }
        return self::$AlpineSpecialProgram;
    }
    
    public function saveAlpineSpecialProgram($alpineProg){
        $this->deleteByCustomerSeq($alpineProg->getCustomerSeq());
        $id = self::$dataStore->save($alpineProg);
        return $id;
    }
    
    public function deleteByCustomerSeq($customerSeq){
        $query = "delete from alpinespecialprograms where customerseq in ($customerSeq)";
        return self::$dataStore->executeQuery($query);
    }
    
    public function findByCustomerSeq($customerSeq){
        $condition = array("customerseq"=>$customerSeq);
        $alpineSpProg = self::$dataStore->executeConditionQuery($condition);
        if(!empty($alpineSpProg)){
            return $alpineSpProg[0];
        }
        return null;
    }
}