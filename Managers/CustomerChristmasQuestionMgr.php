<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/CustomerChristmasQuestion.php");
class CustomerChristmasQuestionMgr{
    
    
    private static  $customerChritmasQuestionMgr;
    private static $dataStore;
    public static function getInstance()
    {
        if (!self::$customerChritmasQuestionMgr)
        {
            self::$customerChritmasQuestionMgr = new CustomerChristmasQuestionMgr();
            self::$dataStore = new BeanDataStore(CustomerChristmasQuestion::$className, CustomerChristmasQuestion::$tableName);
        }
        return self::$customerChritmasQuestionMgr;
    }
    
    public function saveCustomerSpecialProgram($customerChritmasQuestionMgr){
        $this->deleteByCustomerSeq($customerChritmasQuestionMgr->getCustomerSeq());
        $id = self::$dataStore->save($customerChritmasQuestionMgr);
        return $id;
    }
    
    public function deleteByCustomerSeq($customerSeq){
        $query = "delete from customerchristmasquestions where customerseq in ($customerSeq)";
        return self::$dataStore->executeQuery($query);
    }
    
    
    //for edit mode
    public function findByCustomerSeq($customerSeq){
        $condition = array("customerseq"=>$customerSeq);
        $customerChritmasQuestion = self::$dataStore->executeConditionQuery($condition);
        if(!empty($customerChritmasQuestion)){
            $customerChritmasQuestion = $this->convertDateFormat($customerChritmasQuestion[0]);
            return $customerChritmasQuestion;
        }
        return null;
    }
    public function findArrByCustomerSeq($customerSeq){
    	$condition = array("customerseq"=>$customerSeq);
    	$customerChritmasQuestion = self::$dataStore->executeConditionQueryForArray($condition);
    	return $customerChritmasQuestion;
    }
    private function convertDateFormat($customerChritmasQuestion){
        $fromFormat = "Y-m-d";
        $toFormat = "m-d-Y";
        
        $dateStr = $customerChritmasQuestion->getStrategicPlanningMeetDate();  
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerChritmasQuestion->setStrategidPlanningMeetDate($dateStr);
        
        $dateStr = $customerChritmasQuestion->getInvitedtoXmasShowRoomDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerChritmasQuestion->setInvitedtoXmasShowRoomDate($dateStr);
        
        $dateStr = $customerChritmasQuestion->getInvitedToxMasShowroomReminderDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerChritmasQuestion->setInvitedToxMasShowroomReminderDate($dateStr);
        
        $dateStr = $customerChritmasQuestion->getChristmas2020ReviewingDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerChritmasQuestion->setChristmas2020ReviewingDate($dateStr);
        
        $dateStr = $customerChritmasQuestion->getChristMasquoteByDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerChritmasQuestion->setChristMasquoteByDate($dateStr);
        
        return $customerChritmasQuestion;
    }
}