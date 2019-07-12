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
	
	public function exportContainerSchedules($queryString){
		$output = array();
		parse_str($queryString, $output);
		$_GET = array_merge($_GET,$output);
		$containerSchedules = self::$dataStore->findAll(true);
		$containerSchedulesNoteMgr = ContainerScheduleNotesMgr::getInstance();
		$containerScheduleDateMgr = ContainerScheduleDatesMgr::getInstance();
		$containerSchedulesArr = array();
		foreach ($containerSchedules as $containerSchedule){
			$notes  = $containerSchedulesNoteMgr->findByContainerScheduleSeq($containerSchedule->getSeq());
			$dates = $containerScheduleDateMgr->findByContainerScheduleSeq($containerSchedule->getSeq());
			$etaNotes = "";
			$emptyReturnNotes = "";
			$notificationNotes = "";
			if(isset($notes[ContainerScheduleNoteType::eta])){
				$etaNotes = $this->getFormattedNotes($notes[ContainerScheduleNoteType::eta]);
				$containerSchedule->setETANotes($etaNotes);
			}
			if(isset($notes[ContainerScheduleNoteType::empty_return])){
				$emptyReturnNotes = $this->getFormattedNotes($notes[ContainerScheduleNoteType::empty_return]);
				$containerSchedule->setEmptyNotes($emptyReturnNotes);
			}
			if(isset($notes[ContainerScheduleNoteType::notification_pickup])){
				$notificationNotes = $this->getFormattedNotes($notes[ContainerScheduleNoteType::notification_pickup]);
				$containerSchedule->setNotificationNotes($notificationNotes);
			}
			if(isset($dates[ContainerScheduleDateType::eta])){
				$etaDates = $this->getDates($dates[ContainerScheduleDateType::eta]);
				$containerSchedule->setEtaDateTime($etaDates);
			}
			if(isset($dates[ContainerScheduleDateType::confirmed_delivery])){
				$confirmDeliveryDates = $this->getDates($dates[ContainerScheduleDateType::confirmed_delivery]);
				$containerSchedule->setConfirmedDeliveryDateTime($confirmDeliveryDates);
			}
			if(isset($dates[ContainerScheduleNoteType::notification_pickup])){
				$notificationNoteDates = $this->getDates($dates[ContainerScheduleNoteType::notification_pickup]);
				$containerSchedule->setAlpineNotificatinPickupDateTime($notificationNoteDates);
			}
			array_push($containerSchedulesArr,$containerSchedule);
		}
		ExportUtil::exportContainerSchedules($containerSchedulesArr);
	}
	
	private function getDates($datesArr){
		$dateStr = "";
		foreach ($datesArr as $date){
			$dateVal = DateUtil::convertDateToFormat($date, "m-d-Y h:i a", "n/j/y h:i a");
			$dateStr .= $dateVal ."\n";
		}
		$dateStr = substr($dateStr, 0, -1);
		return $dateStr;
	}
	
	private function getFormattedNotes($notesArr){
		$noteStr = "";
		foreach ($notesArr as $note){
			$notes = $note->getNotes();
			$noteStr .= $note->getCreatedOn()." ".$note->email . " - ". $note->getNotes() ."\n";
		}
		$noteStr = substr($noteStr, 0, -1);
		return $noteStr;
	}
	
	private function groupByPO($containerSchedules){
		$mainArr = array();
		foreach ($containerSchedules as $containerSchedule){
			$itemNumbers = "";
			foreach ($qcSchedules as $qcSchedule){
				$itemNumbers .= $qcSchedule->getItemNumbers() . "\n";
			}
			//$itemNumbers = substr($itemNumbers, 0, -2);
			$qcSchedule->setItemNumbers(trim($itemNumbers));
			array_push($mainArr,$qcSchedule);
		}
		return $mainArr;
	}
	
	function group_by($array) {
		$return = array();
		foreach($array as $val) {
			$return[$val->getNoteType()][] = $val->getNotes() . "\n";
		}
		return $return;
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