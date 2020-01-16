<?php
//require_once($ConstantsArray['dbServerUrl'] ."DataStores/ContainerScheduleDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ContainerSchedule.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/ExportUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once $ConstantsArray['dbServerUrl'] .'PHPExcel/IOFactory.php';
require_once $ConstantsArray['dbServerUrl'] .'Managers/ClassCodeMgr.php';
require_once $ConstantsArray['dbServerUrl'] .'Managers/ContainerScheduleDatesMgr.php';
require_once $ConstantsArray['dbServerUrl'] .'Managers/ContainerScheduleNotesMgr.php';
require_once($ConstantsArray['dbServerUrl'] ."Enums/TruckerType.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/WareHouseType.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/TerminalType.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/CustomExamStatusType.php");
class ContainerScheduleMgr{
	private static $containerScheduleMgr;
	private static $dataStore;
	public static function getInstance()
	{
		if (!self::$containerScheduleMgr)
		{
			self::$containerScheduleMgr = new ContainerScheduleMgr();
			//self::$dataStore = ContainerScheduleDataStore::getInstance();//new BeanDataStore(ContainerSchedule::$className, ContainerSchedule::$tableName);
			self::$dataStore = new BeanDataStore(ContainerSchedule::$className, ContainerSchedule::$tableName);
		}
		return self::$containerScheduleMgr;
	}
	
	public function save($containerSchedule){
    	$id = self::$dataStore->save($containerSchedule);
    	return $id;
    }
    
	public function getContainerSchedulesForGrid(){
	    $sessionUtil = SessionUtil::getInstance();
	    $loggedInUserTimeZone = $sessionUtil->getUserLoggedInTimeZone();
		//$containerSchedules = $this->findAllArr(true);
		$query = "select * from containerschedules";
		$query = $this->applyDefaultCondition($query);
		$containerSchedules = self::$dataStore->executeQuery($query,true);
		$mainArr = array();
		foreach ($containerSchedules as $containerSchedule){
		    $wareHouse = $containerSchedule["warehouse"];
		    $terminal = $containerSchedule["terminal"];
		    $trucker = $containerSchedule["truckername"];
		    if(!empty($wareHouse)){
		        $wareHouse = WareHouseType::getValue($wareHouse);
		    }
		    if(!empty($terminal)){
		        $terminal = TerminalType::getValue($terminal);
		    }
		    if(!empty($trucker)){
		        $trucker = TruckerType::getValue($trucker);
		    }
		    $containerSchedule["warehouse"] = $wareHouse;
		    $containerSchedule["terminal"] = $terminal;
		    $containerSchedule["truckername"] = $trucker;
		    $lastModifiedOn = $containerSchedule["lastmodifiedon"];
		    $lastModifiedOn = DateUtil::convertDateToFormatWithTimeZone($lastModifiedOn, "Y-m-d H:i:s", "Y-m-d H:i:s",$loggedInUserTimeZone);
		    $containerSchedule["lastmodifiedon"] = $lastModifiedOn;
		    array_push($mainArr,$containerSchedule);
		}
		$mainArr["Rows"] = $mainArr;
		$mainArr["TotalRows"] = $this->getAllCount(true);
		return $mainArr;
	}
	
	private function applyDefaultCondition($query){
	    if (isset($_GET['filterscount']))
	    {
	        $filterscount = $_GET['filterscount'];
	        if ($filterscount > 0){
	        }else{
	            $query .= " where emptyreturndate is NULL";
	            
	        }
	    }
	    return $query;
	}
	
	public function getAllCount(){
	    $query = "select count(*) from containerschedules";
	    $query = $this->applyDefaultCondition($query);
	    $count = self::$dataStore->executeCountQueryWithSql($query,true);
		return $count;
	}
	
	public function findAllArr($isApplyFilter = false){
		$containerSchedules = self::$dataStore->findAllArr($isApplyFilter);
		return $containerSchedules;
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
		$containerSchedulesArr = $this->setNotesAndDates($containerSchedules);
		ExportUtil::exportContainerSchedules($containerSchedulesArr);
	}
	
	
	public function setNotesAndDates($containerSchedules){
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
	        $wareHouse = $containerSchedule->getWareHouse();
	        $terminal = $containerSchedule->getTerminal();
	        $trucker = $containerSchedule->getTruckerName();
	        if(!empty($wareHouse)){
	            $wareHouse = WareHouseType::getValue($wareHouse);
	        }
	        if(!empty($terminal)){
	            $terminal = TerminalType::getValue($terminal);
	        }
	        if(!empty($trucker)){
	            $trucker = TruckerType::getValue($trucker);
	        }
	        $containerSchedule->setWareHouse($wareHouse);
	        $containerSchedule->setTerminal($terminal);
	        $containerSchedule->setTruckerName($trucker);
	        array_push($containerSchedulesArr,$containerSchedule);
	    }
	    return $containerSchedulesArr;
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
	
	public function findArrBySeqForView($seq){
	    $containerSchedule = self::$dataStore->findArrayBySeq($seq);
	    $containerScheduleDatesMgr = ContainerScheduleDatesMgr::getInstance();
	    $containerScheduleDatesArr = $containerScheduleDatesMgr->findByContainerScheduleSeq($seq);
	    $fromFormatWithTime = "Y-m-d H:i:s";
	    $fromformat = "Y-m-d";
	    $toFormatWithTime = "m-d-Y h:i a";
	    $toFormat = "m-d-Y";
	    $dateStr = $containerSchedule["etadatetime"];
	    $containerSchedule["etadatetime"] = 
	           DateUtil::convertDateToFormat($dateStr,$fromFormatWithTime,$toFormatWithTime);
        $etaDatesArr = $containerScheduleDatesArr[ContainerScheduleDateType::eta];
        array_shift($etaDatesArr);
        if(!empty($etaDatesArr)){
            $containerSchedule["etadatetime"] = $containerSchedule["etadatetime"] . " (Earlier Date : ".$etaDatesArr[0].")";
        }
	    
	    $dateStr = $containerSchedule["terminalappointmentdatetime"];
	    $containerSchedule["terminalappointmentdatetime"] =  
	           DateUtil::convertDateToFormat($dateStr,$fromFormatWithTime,$toFormatWithTime);
	    
	    $dateStr = $containerSchedule["ldfpickupdate"];
	    $containerSchedule["ldfpickupdate"] = 
	           DateUtil::convertDateToFormat($dateStr,$fromformat,$toFormat);
	    
	    $dateStr = $containerSchedule["scheduleddeliverydatetime"];
	    $containerSchedule["scheduleddeliverydatetime"] = 
	           DateUtil::convertDateToFormat($dateStr,$fromFormatWithTime,$toFormatWithTime);
	    
	    $dateStr = $containerSchedule["confirmeddeliverydatetime"];
	    $containerSchedule["confirmeddeliverydatetime"] =  
	        DateUtil::convertDateToFormat($dateStr,$fromFormatWithTime,$toFormatWithTime);
	    
	    $dateStr = $containerSchedule["emptylfddate"];
	    $containerSchedule["emptylfddate"] = 
	        DateUtil::convertDateToFormat($dateStr,$fromformat,$toFormat);
	    
	    $dateStr = $containerSchedule["emptyreturndate"];
	    $containerSchedule["emptyreturndate"] = 
	        DateUtil::convertDateToFormat($dateStr,$fromformat,$toFormat);
	    
	    $dateStr = $containerSchedule["alpinenotificatinpickupdatetime"];
	    $containerSchedule["alpinenotificatinpickupdatetime"] =
	        DateUtil::convertDateToFormat($dateStr,$fromFormatWithTime,$toFormatWithTime);
        $notificationDatesArr = $containerScheduleDatesArr[ContainerScheduleDateType::notification_pickup];
        array_shift($notificationDatesArr);
        if(!empty($notificationDatesArr)){
            $containerSchedule["alpinenotificatinpickupdatetime"] = $containerSchedule["alpinenotificatinpickupdatetime"] . " (Earlier Date : ".$notificationDatesArr[0].")";
        }
	        
	    $dateStr = $containerSchedule["msrfcreateddate"] ;
	    $containerSchedule["msrfcreateddate"] = 
	        DateUtil::convertDateToFormat($dateStr,$fromformat,$toFormat);
	    
	    $dateStr = $containerSchedule["samplesreceiveddate"];
	    $containerSchedule["samplesreceiveddate"] = 
	        DateUtil::convertDateToFormat($dateStr,$fromformat,$toFormat);
	    
	    $dateStr = $containerSchedule["containerreceivedinomsdate"];
	    $containerSchedule["containerreceivedinomsdate"] = 
	        DateUtil::convertDateToFormat($dateStr,$fromformat,$toFormat);
	    
	    $dateStr = $containerSchedule["samplesreceivedinomsdate"];
	    $containerSchedule["samplesreceivedinomsdate"] =
	        DateUtil::convertDateToFormat($dateStr,$fromformat,$toFormat);
	    
	    $dateStr = $containerSchedule["containerreceivedinwmsdate"];
	    $containerSchedule["containerreceivedinwmsdate"] = 
	        DateUtil::convertDateToFormat($dateStr,$fromformat,$toFormat);
	    
	    $dateStr = $containerSchedule["samplesReceivedinWMSDate"];
	    $containerSchedule["samplesReceivedinWMSDate"] = 
	        DateUtil::convertDateToFormat($dateStr,$fromformat,$toFormat);
	    $containerSchedule["issamplesreceived"] = $this->getYesNo($containerSchedule["issamplesreceived"]);
	    $containerSchedule["isidscomplete"] = $this->getYesNo($containerSchedule["isidscomplete"]);
	    $containerSchedule["containerno"] = $containerSchedule["container"];
	    if(!empty($containerSchedule["customexamstatus"])){
	        $containerSchedule["customexamstatus"] = 
	            CustomExamStatusType::getValue($containerSchedule["customexamstatus"]);
	    }
	    $containerSchedule["etanotes"] = $this->getNotesForView($seq, ContainerScheduleNoteType::eta);
	    $containerSchedule["emptynotes"] = $this->getNotesForView($seq, ContainerScheduleNoteType::empty_return);
	    $containerSchedule["notificationnotes"] = $this->getNotesForView($seq, ContainerScheduleNoteType::notification_pickup);
	    return $containerSchedule;
	}
	
	private function getNotesForView($seq,$type){
	    $containerScheduleNotesMgr = ContainerScheduleNotesMgr::getInstance();
	    $containerScheduleNotesArr = $containerScheduleNotesMgr->findByContainerScheduleSeq($seq);
	    $notesHtml = "";
	    if(isset($containerScheduleNotesArr[$type])){
	        $notes =  $containerScheduleNotesArr[$type];
	        foreach ($notes as $note){
	            $notesHtml .= '<li class="list-group-item">';
	            $notesHtml .= '<i class="fa fa-clock-o"></i>';
	            $notesHtml .= $note->getCreatedOn() . " "; 
	            $notesHtml .= '<a class="text-info" href="#">';
	            $notesHtml .= $note->email . " ";
	            $notesHtml .= '</a>' . $note->getNotes();
				$notesHtml .= '</li>';
	        }
	        return $notesHtml;
	    }
	    
	}
	
	private function getYesNo($bool){
	    if(!empty($bool)){
	        $bool = "Yes";
	    }else{
	        $bool = "No";
	    }
	    return $bool;
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