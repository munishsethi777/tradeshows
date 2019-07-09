<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ContainerSchedule.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/ExportUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once $ConstantsArray['dbServerUrl'] .'PHPExcel/IOFactory.php';
require_once $ConstantsArray['dbServerUrl'] .'Managers/ClassCodeMgr.php';
require_once $ConstantsArray['dbServerUrl'] .'Managers/ContainerScheduleDatesMgr.php';
class ContainerScheduleMgr{
	private static $containerScheduleMgr;
	private static $dataStore;
	public static function getInstance()
	{
		if (!self::$containerScheduleMgr)
		{
			self::$containerScheduleMgr = new ContainerScheduleMgr();
			self::$dataStore = new BeanDataStore(ContainerSchedule::$className, ContainerSchedule::$tableName);
		}
		return self::$containerScheduleMgr;
	}
	
	public function save($containerSchedule){
    	$id = self::$dataStore->save($containerSchedule);
    	return $id;
    }
    
    
	
	public function getContainerSchedulesForGrid(){
		$containerSchedules = $this->findAllArr(true);
		$mainArr["Rows"] = $containerSchedules;
		$mainArr["TotalRows"] = $this->getAllCount(true);
		return $mainArr;
	}
	
	public function getAllCount(){
		$count = self::$dataStore->executeCountQuery(null,true);
		return $count;
	}
	
	public function findAllArr($isApplyFilter = false){
		$itemArr = self::$dataStore->findAllArr($isApplyFilter);
		return $itemArr;
	}
		
	public function deleteByIds($ids){
		return self::$dataStore->deleteInList($ids);
	} 
	public function findBySeq($seq){
		$containerSchedule = self::$dataStore->findBySeq($seq);
		return $containerSchedule;
	}
	
	public function findBySeqForEdit($seq){
		$containerSchedule = self::$dataStore->findBySeq($seq);
		$fromFormatWithTime = "Y-m-d H:i:s";
		$fromformat = "Y-m-d";
		$toFormatWithTime = "m-d-Y h:i a";
		$toFormat = "m-d-Y";
		$dateStr = $containerSchedule->getEtaDateTime();
		$containerSchedule->setEtaDateTime(
				DateUtil::convertDateToFormat($dateStr,$fromFormatWithTime,$toFormatWithTime));
		$dateStr = $containerSchedule->getTerminalAppointmentDateTime();
		$containerSchedule->setTerminalAppointmentDateTime(
				DateUtil::convertDateToFormat($dateStr,$fromFormatWithTime,$toFormatWithTime));
		$dateStr = $containerSchedule->getLFDPickupDate();
		$containerSchedule->setLFDPickupDate(
				DateUtil::convertDateToFormat($dateStr,$fromformat,$toFormat));
		$dateStr = $containerSchedule->getScheduledDeliveryDateTime();
		$containerSchedule->setScheduledDeliveryDateTime(
				DateUtil::convertDateToFormat($dateStr,$fromFormatWithTime,$toFormatWithTime));
		$dateStr = $containerSchedule->getConfirmedDeliveryDateTime();
		$containerSchedule->setConfirmedDeliveryDateTime(
				DateUtil::convertDateToFormat($dateStr,$fromFormatWithTime,$toFormatWithTime));
		$dateStr = $containerSchedule->getEmptyLfdDate();
		$containerSchedule->setEmptyLfdDate(
				DateUtil::convertDateToFormat($dateStr,$fromformat,$toFormat));
		$dateStr = $containerSchedule->getEmptyReturnDate();
		$containerSchedule->setEmptyReturnDate(
				DateUtil::convertDateToFormat($dateStr,$fromformat,$toFormat));
		$dateStr = $containerSchedule->getAlpineNotificatinPickupDateTime();
		$containerSchedule->setAlpineNotificatinPickupDateTime(
				DateUtil::convertDateToFormat($dateStr,$fromFormatWithTime,$toFormatWithTime));
		$dateStr = $containerSchedule->getMsrfCreatedDate();
		$containerSchedule->setMsrfCreatedDate(
				DateUtil::convertDateToFormat($dateStr,$fromformat,$toFormat));
		$dateStr = $containerSchedule->getSamplesReceivedDate();
		$containerSchedule->setSamplesReceivedDate(
				DateUtil::convertDateToFormat($dateStr,$fromformat,$toFormat));
		
		$dateStr = $containerSchedule->getContainerReceivedinOMSDate();
		$containerSchedule->setContainerReceivedinOMSDate(
				DateUtil::convertDateToFormat($dateStr,$fromformat,$toFormat));
		$dateStr = $containerSchedule->getSamplesReceivedinOMSDate();
		$containerSchedule->setSamplesReceivedinOMSDate(
				DateUtil::convertDateToFormat($dateStr,$fromformat,$toFormat));
		$dateStr = $containerSchedule->getContainerReceivedinWMSDate();
		$containerSchedule->setContainerReceivedinWMSDate(
				DateUtil::convertDateToFormat($dateStr,$fromformat,$toFormat));
		$dateStr = $containerSchedule->getSamplesReceivedinWMSDate();
		$containerSchedule->setSamplesReceivedinWMSDate(
				DateUtil::convertDateToFormat($dateStr,$fromformat,$toFormat));
		return $containerSchedule;
	}
}