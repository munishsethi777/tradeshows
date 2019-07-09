<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ContainerScheduleNote.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/ContainerScheduleNoteType.php");

class ContainerScheduleNotesMgr{
	private static $containerScheduleNotesMgr;
	private static $dataStore;
	public static function getInstance(){
		if (!self::$containerScheduleNotesMgr){
			self::$containerScheduleNotesMgr = new ContainerScheduleNotesMgr();
			self::$dataStore = new BeanDataStore(ContainerScheduleNote::$className, ContainerScheduleNote::$tableName);
		}
		return self::$containerScheduleNotesMgr;
	}
	
	public function save($containerScheduleNote){
    	self::$dataStore->save($containerScheduleNote);
    }
    
    
    public function saveFromContainerSchedule($containerSchedule,$existingContainerSchedule){
    	$etaNotes = $containerSchedule->getETANotes();
    	$existingEtaNotes = $existingContainerSchedule->getETANotes();
    	if(!empty($etaNotes) && $etaNotes != $existingEtaNotes){
    		$containerScheduleNote = $this->getScheduleNoteObj($containerSchedule,
    				ContainerScheduleNoteType::eta);
    		$this->save($containerScheduleNote);
    	}
    	$emptyReturnNotes = $containerSchedule->getEmptyNotes();
    	$existingEmptyReturnNotes = $existingContainerSchedule->getEmptyNotes();
    	if(!empty($emptyReturnNotes) && $emptyReturnNotes != $existingEmptyReturnNotes){
    		$containerScheduleNote = $this->getScheduleNoteObj($containerSchedule,
    				ContainerScheduleNoteType::empty_return);
    		$this->save($containerScheduleNote);
    	}
    	$notificationNotes = $containerSchedule->getNotificationNotes();
    	$existingNotificationNotes = $existingContainerSchedule->getNotificationNotes();
    	if(!empty($notificationNotes) && $notificationNotes != $existingNotificationNotes){
    		$containerScheduleNote = $this->getScheduleNoteObj($containerSchedule,
    				ContainerScheduleNoteType::notification_pickup);
    		$this->save($containerScheduleNote);
    	}
    }
    
    public function getScheduleNoteObj($containerSchedule,$noteType){
    	$containerScheduleNote = new ContainerScheduleNote();
    	$containerScheduleNote->setContainerscheduleseq($containerSchedule->getSeq());
    	$notes = "";
    	if($noteType == ContainerScheduleNoteType::eta){
    		$notes = $containerSchedule->getETANotes();
    	}if($noteType == ContainerScheduleNoteType::empty_return){
    		$notes = $containerSchedule->getEmptyNotes();
    	}if($noteType == ContainerScheduleNoteType::notification_pickup){
    		$notes = $containerSchedule->getNotificationNotes();
    	}
    	$containerScheduleNote->setNotes($notes);
    	$containerScheduleNote->setCreatedby($containerSchedule->getCreatedBy());
    	$containerScheduleNote->setNotesType($noteType);
    	$containerScheduleNote->setCreatedon(new DateTime());
    	return $containerScheduleNote;
    }
    
    public function findByContainerScheduleSeq($containerScheduleSeq){
    	$colVal["containerscheduleseq"] = $containerScheduleSeq;
    	$query = "select users.email,containerschedulenotes.* from containerschedulenotes inner join users on containerschedulenotes.createdby = users.seq where containerscheduleseq = $containerScheduleSeq order by seq desc";
    	$containerScheduleNotes =  self::$dataStore->executeObjectQuery($query);
    	$containerScheduleNotes = $this->groupByNoteType($containerScheduleNotes);
    	return $containerScheduleNotes;
    }
    
    function groupByNoteType($array) {
    	$return = array();
    	foreach($array as $val) {
    		$createdOn = $val->getCreatedOn();
    		$dateVal = DateUtil::convertDateToFormat($createdOn, "Y-m-d H:i:s","m/d/Y : h.i a");
    		$val->setCreatedOn($dateVal);
    		$return[$val->getNotesType()][] = $val;
    	}
    	return $return;
    }
}