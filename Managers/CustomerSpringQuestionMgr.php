<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/CustomerSpringQuestion.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
class CustomerSpringQuestionMgr
{
    private static  $CustomerSpringQuestionMgr;
    private static $dataStore;
    
    public static function getInstance()
    {
        if (!self::$CustomerSpringQuestionMgr)
        {
            self::$CustomerSpringQuestionMgr = new CustomerSpringQuestionMgr();
            self::$dataStore = new BeanDataStore(CustomerSpringQuestion::$className, CustomerSpringQuestion::$tableName);
        }
        return self::$CustomerSpringQuestionMgr;
    }
    
    public function saveSpringQuestion($springQuestion){
        //$this->deleteByCustomerSeq($springQuestion->getCustomerSeq());
        $id = self::$dataStore->save($springQuestion);
        return $id;
    }
    
    public function deleteByCustomerSeq($customerSeq){
        $query = "delete from customerspringquestions where customerseq in ($customerSeq)";
        return self::$dataStore->executeQuery($query);
    }
    
    public function deleteBySeq($seq){
        $flag = self::$dataStore->deleteBySeq($seq);
        return $flag;
    }
    
    public function findByCustomerSeq($customerSeq){
        $condition = array("customerseq"=>$customerSeq);
        $customerSpringQuestions = self::$dataStore->executeConditionQuery($condition);
        if(!empty($customerSpringQuestions)){
            $customerSpringQuestions = $this->convertDateFormat($customerSpringQuestions[0]);
            return $customerSpringQuestions;
        }
        return null;
    }
    
    public function findArrByCustomerSeq($customerSeq){
        $query = "select * from customerspringquestions where customerseq = $customerSeq";
        $customerSpringQuestions = self::$dataStore->executeQuery($query,false,true);
        return $customerSpringQuestions;
    }
    
    public function findbySeq($seq){
        $customerSpringQuestion = self::$dataStore->findBySeq($seq);
        $customerSpringQuestion = $this->convertDateFormat($customerSpringQuestion);
        return $customerSpringQuestion;
    }
    
    private function convertDateFormat($customerSpringQuestion){
        $fromFormat = "Y-m-d";
        $toFormat = "m-d-Y";
        $dateStr = $customerSpringQuestion->getStrategicPlanningMeetingDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion->setStrategicPlanningMeetingDate($dateStr);
        
        $dateStr = $customerSpringQuestion->getInvitedToSpringShowroomDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion->setInvitedToSpringShowroomDate($dateStr);
        
        $dateStr = $customerSpringQuestion->getInvitedToSpringShowroomReminderDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion->setInvitedToSpringShowroomReminderDate($dateStr);
        
        $dateStr = $customerSpringQuestion->getChristmasQuoteByDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion->setChristmasQuoteByDate($dateStr);
        
        $dateStr = $customerSpringQuestion->getSpringReviewingDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion->setSpringReviewingDate($dateStr);
        
        $dateStr = $customerSpringQuestion->getQuoteSpringByDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion->setQuoteSpringByDate($dateStr);
        
        
        return $customerSpringQuestion;
    }
    
    private function convertDateFormatForArr($customerSpringQuestion){
        $fromFormat = "Y-m-d";
        $toFormat = "m-d-Y";
        $dateStr = $customerSpringQuestion["strategicplanningmeetingmate"];
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion["strategicplanningmeetingmate"] = $dateStr;
        
        $dateStr = $customerSpringQuestion["invitedtospringshowroomdate"];
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion["invitedtospringshowroomdate"] = $dateStr;
        
        $dateStr =  $customerSpringQuestion["invitedtospringshowroomreminderdate"];
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion["invitedtospringshowroomreminderdate"] = $dateStr;
        
        $dateStr =  $customerSpringQuestion["christmasquotebydate"];
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion["christmasquotebydate"] = $dateStr;
        
        $dateStr = $customerSpringQuestion["springreviewingdate"];
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion["springreviewingdate"] = $dateStr;
        
        $dateStr = $customerSpringQuestion["quotespringbydate"];
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion["quotespringbydate"] = $dateStr;
        return $customerSpringQuestion;
    }
    
}
