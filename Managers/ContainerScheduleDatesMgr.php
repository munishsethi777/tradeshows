<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ContainerScheduleDate.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/ContainerScheduleDateType.php");


class ContainerScheduleDatesMgr{
	private static $containerScheduleDatesMgr;
	private static $dataStore;
	
	public static function getInstance(){
		if (!self::$containerScheduleDatesMgr){
			self::$containerScheduleDatesMgr = new ContainerScheduleDatesMgr();
			self::$dataStore = new BeanDataStore(ContainerScheduleDate::$className, ContainerScheduleDate::$tableName);
		}
		return self::$containerScheduleDatesMgr;
	}
	
	public function save($containerScheduleDate){
    	self::$dataStore->save($containerScheduleDate);
    }
    
    private function getContainerScheduleDateObj($containerSchedule,$dateTimeType){
    	$containerScheduleDateMgr = ContainerScheduleDatesMgr::getInstance();
    	$containerScheduleDate = new ContainerScheduleDate();
    	$containerScheduleDate->setContainerscheduleseq($containerSchedule->getSeq());
    	$containerScheduleDate->setCreatedby($containerSchedule->getCreatedBy());
    	$dateTime = new DateTime();
    	if($dateTimeType == ContainerScheduleDateType::eta){
    		$dateTime = $containerSchedule->getEtaDateTime();
    	}else if($dateTimeType == ContainerScheduleDateType::confirmed_delivery){
    		$dateTime = $containerSchedule->getConfirmedDeliveryDateTime();
    	}else if($dateTimeType == ContainerScheduleDateType::notification_pickup){
    		$dateTime = $containerSchedule->getAlpineNotificatinPickupDateTime();
    	}
    	$containerScheduleDate->setDatetime($dateTime);
    	$containerScheduleDate->setDatetimetype($dateTimeType);
    	$containerScheduleDate->setCreatedon(new DateTime());
    	return $containerScheduleDate;
    }
    
    public function saveFromContainerSchedule($containerSchedule,$existingContainerSchedle){
    	$etaDateTime = $containerSchedule->getEtaDateTime();
    	$existingEtaDateTimeStr = $existingContainerSchedle->getEtaDateTime();
    	$existingEtaDateTime = DateUtil::StringToDateByGivenFormat("Y-m-d H:i:s", $existingEtaDateTimeStr);
    	if($etaDateTime !=  $existingEtaDateTime){
    		$containerScheduleDate = $this->getContainerScheduleDateObj(
    				$containerSchedule, ContainerScheduleDateType::eta);
    		$this->save($containerScheduleDate);	
    	}
    	$confirmDeliveryDate = $containerSchedule->getConfirmedDeliveryDateTime();
    	$existingDeliveryDateStr = $existingContainerSchedle->getConfirmedDeliveryDateTime();
    	$existingDeliveryDate = DateUtil::StringToDateByGivenFormat("Y-m-d H:i:s", $existingDeliveryDateStr);
    	if($confirmDeliveryDate !=  $existingDeliveryDate){
    		$containerScheduleDate = $this->getContainerScheduleDateObj(
    				$containerSchedule, ContainerScheduleDateType::confirmed_delivery);
    		$this->save($containerScheduleDate);
    	}
    	$pickupDateTime = $containerSchedule->getAlpineNotificatinPickupDateTime();
    	$existingPickupDateTimeStr = $existingContainerSchedle->getAlpineNotificatinPickupDateTime();
    	$existingPickupDateTime = DateUtil::StringToDateByGivenFormat("Y-m-d H:i:s", $existingPickupDateTimeStr);
    	if($pickupDateTime !=  $existingPickupDateTime){
    		$containerScheduleDate = $this->getContainerScheduleDateObj(
    				$containerSchedule, ContainerScheduleDateType::notification_pickup);
    		$this->save($containerScheduleDate);
    	}
    }
    
    public function findByContainerScheduleSeq($containerScheduleSeq){
    	$colVal["containerscheduleseq"] = $containerScheduleSeq;
    	$query = "select * from containerscheduledates where containerscheduleseq = $containerScheduleSeq order by seq desc";
    	$containerScheduleDates =  self::$dataStore->executeObjectQuery($query);
    	$containerScheduleDates = $this->groupByDateTimeType($containerScheduleDates);
    	return $containerScheduleDates;
    }
    
    function groupByDateTimeType($array) {
    	$return = array();
    	foreach($array as $val) {
    		$toFormatWithTime = "m-d-Y h:i a";
    		$dateVal = DateUtil::convertDateToFormat($val->getDateTime(), "Y-m-d H:i:s", $toFormatWithTime);
    		$return[$val->getDateTimeType()][] = $dateVal;
    	}
    	return $return;
    }
    
}