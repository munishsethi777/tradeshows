<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/ContainerScheduleDataStore.php");
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
require_once($ConstantsArray['dbServerUrl'] ."Enums/BeanReturnDataType.php");
class ContainerScheduleMgr{
	private static $containerScheduleMgr;
	private static $dataStore;
	private static $userDataStore;
	private static $select = "select * from containerschedules";
	private static $selectCountSql = "SELECT COUNT(seq) from containerschedules";
	private static $timeZone = "America/Los_Angeles";
	private static $currentDateInDBFormat;
	public static function getInstance()
	{
		if (!self::$containerScheduleMgr)
		{
			self::$containerScheduleMgr = new ContainerScheduleMgr();
			self::$dataStore = new BeanDataStore(ContainerSchedule::$className, ContainerSchedule::$tableName);
			self::$userDataStore = new BeanDataStore(User::$className, User::$tableName);
			self::$currentDateInDBFormat = DateUtil::getDateInDBFormat(0,null,self::$timeZone);
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
	    $loggedInUserSeq = $sessionUtil->getUserLoggedInSeq();
	    $user = self::$userDataStore->findBySeq($loggedInUserSeq);
		//$containerSchedules = $this->findAllArr(true);
		$query = "select * from containerschedules";
		$query = $this->applyDefaultCondition($query);
		if(!empty($user->getFreightForwarder())){
		    if(strpos($query, "where") == false){
		        $query .= " WHERE";
		    }else{
		        $query .= " AND";
		    }
		    $query .= " freightforwarder like '".$user->getFreightForwarder()."'";
		}
		$containerSchedules = self::$dataStore->executeQuery($query,true,true);
		$mainArr = array();
		foreach ($containerSchedules as $containerSchedule){
		    $wareHouse = $containerSchedule["warehouse"];
		    $terminal = $containerSchedule["terminal"];
			$trucker = $containerSchedule["truckername"];
			$isHotContainer = $containerSchedule['ishotcontainer'];
		    if(!empty($wareHouse)){
		        $wareHouse = WareHouseType::getValue($wareHouse);
		    }
		    if(!empty($terminal)){
		        $terminal = TerminalType::getValue($terminal);
		    }
		    if(!empty($trucker)){
		        $trucker = TruckerType::getValue($trucker);
			}
			if($isHotContainer == NULL){
				$isHotContainer = "0";
			}
			if($containerSchedule["lfdpickupdate"] != NULL){
				$containerSchedule["lfdpickupdate"] = DateUtil::convertDateToFormat($containerSchedule["lfdpickupdate"],"Y-m-d","Y-m-d H:i:s");
			}
			if($containerSchedule["containerreceivedinomsdate"] != NULL){
				$containerSchedule["containerreceivedinomsdate"] = DateUtil::convertDateToFormat($containerSchedule["containerreceivedinomsdate"],"Y-m-d","Y-m-d H:i:s");
			}
			if($containerSchedule["containerreceivedinwmsdate"] != NULL){
				$containerSchedule["containerreceivedinwmsdate"] = DateUtil::convertDateToFormat($containerSchedule["containerreceivedinwmsdate"],"Y-m-d","Y-m-d H:i:s");
			}
			if($containerSchedule["emptylfddate"] != NULL){
				$containerSchedule["emptylfddate"] = DateUtil::convertDateToFormat($containerSchedule["emptylfddate"],"Y-m-d","Y-m-d H:i:s");
			}
			if($containerSchedule["emptyreturndate"] != NULL){
				$containerSchedule["emptyreturndate"] = DateUtil::convertDateToFormat($containerSchedule["emptyreturndate"],"Y-m-d","Y-m-d H:i:s");
			}
// 			if($containerSchedule["emptynotesdatetime"] != NULL){
// 				$containerSchedule["emptynotesdatetime"] = DateUtil::convertDateToFormat($containerSchedule["emptynotesdatetime"],"Y-m-d","Y-m-d H:i:s");
// 			}
// 			if($containerSchedule["notificationnotesdatetime"] != NULL){
// 				$containerSchedule["notificationnotesdatetime"] = DateUtil::convertDateToFormat($containerSchedule["notificationnotesdatetime"],"Y-m-d","Y-m-d H:i:s");
// 			}
			if($containerSchedule["msrfcreateddate"] != NULL){
				$containerSchedule["msrfcreateddate"] = DateUtil::convertDateToFormat($containerSchedule["msrfcreateddate"],"Y-m-d","Y-m-d H:i:s");
			}
			if($containerSchedule["samplesreceiveddate"] != NULL){
				$containerSchedule["samplesreceiveddate"] = DateUtil::convertDateToFormat($containerSchedule["samplesreceiveddate"],"Y-m-d","Y-m-d H:i:s");
			}
			if($containerSchedule["samplesreceivedinomsdate"] != NULL){
				$containerSchedule["samplesreceivedinomsdate"] = DateUtil::convertDateToFormat($containerSchedule["samplesreceivedinomsdate"],"Y-m-d","Y-m-d H:i:s");
			}
			if($containerSchedule["samplesreceivedinwmsdate"] != NULL){
				$containerSchedule["samplesreceivedinwmsdate"] = DateUtil::convertDateToFormat($containerSchedule["samplesreceivedinwmsdate"],"Y-m-d","Y-m-d H:i:s");
			}
		    $containerSchedule["warehouse"] = $wareHouse;
		    $containerSchedule["terminal"] = $terminal;
		    $containerSchedule["truckername"] = $trucker;
		    $lastModifiedOn = $containerSchedule["lastmodifiedon"];
			//$containerSchedule["terminalappointmentdatetime"] = DateUtil::convertDateToFormat($containerSchedule["terminalappointmentdatetime"],"Y-m-d","Y-m-d H:i:s");
			$lastModifiedOn = DateUtil::convertDateToFormatWithTimeZone($lastModifiedOn, "Y-m-d H:i:s", "Y-m-d H:i:s",$loggedInUserTimeZone);
			$containerSchedule["lastmodifiedon"] = $lastModifiedOn;
			$containerSchedule["ishotcontainer"] = $isHotContainer;
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
	    $sessionUtil = SessionUtil::getInstance();
	    $loggedInUserSeq = $sessionUtil->getUserLoggedInSeq();
	    $user = self::$userDataStore->findBySeq($loggedInUserSeq);
	    $query = $this->applyDefaultCondition($query);
	   if(!empty($user->getFreightForwarder())){
		    if(strpos($query, "where") == false){
		        $query .= " WHERE";
		    }else{
		        $query .= " AND";
		    }
		    $query .= " freightforwarder like '".$user->getFreightForwarder()."'";
		}
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
		$fileName = "ContainerSchedules";
		ExportUtil::exportContainerSchedules($containerSchedulesArr,$fileName);
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
	        if(isset($dates[ContainerScheduleDateType::requested_delivery])){
	        	$requestedDeliveryDates = $this->getDates($dates[ContainerScheduleDateType::requested_delivery]);
	        	$containerSchedule->setRequestedDeliveryDateTime($requestedDeliveryDates);
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
        
        $dateStr = $containerSchedule["requesteddeliverydatetime"];
        $containerSchedule["requesteddeliverydatetime"] =
        DateUtil::convertDateToFormat($dateStr,$fromFormatWithTime,$toFormatWithTime);
        $reqDDatesArr = $containerScheduleDatesArr[ContainerScheduleDateType::requested_delivery];
        array_shift($reqDDatesArr);
        if(!empty($etaDatesArr)){
        	$containerSchedule["requesteddeliverydatetime"] = $containerSchedule["requesteddeliverydatetime"] . " (Earlier Date : ".$reqDDatesArr[0].")";
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
	            $notesHtml .= " ".$note->getCreatedOn() . " "; 
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
		$requestedDeliverydateStr = $containerSchedule->getRequestedDeliveryDateTime();
		$containerSchedule->setRequestedDeliveryDateTime(
				DateUtil::convertDateToFormat($requestedDeliverydateStr,$fromFormatWithTime,$toFormatWithTime));
		return $containerSchedule;
	}
	
	public function getContainerScheduleNotificationDateCount(){
		$container_schedule_datastore = ContainerScheduleDataStore::getInstance();
		$eta_report_count = count($container_schedule_datastore->getETADatesPendingInNextSevenDays());
		$empty_return_date_past_empty_lfd_report = count($container_schedule_datastore->getEmptyReturnDatePastEmptyLFD());
 		$pending_schedule_delivery_date_for_today_report = count($container_schedule_datastore->getPendingScheduleDeliveryDateForToday());
 		$empty_alpine_notification_pickup_date = count($container_schedule_datastore->getMissingAlpineNotificationDate());
 		$missing_id_report = count($container_schedule_datastore->getMissingIDReport());
 		$missing_terminal_appointment_date = count($container_schedule_datastore->getMissingTerminalAppointmentDate());
 		$missing_schedule_delivery_date = count($container_schedule_datastore->getMissingScheduleDeliveryDate());
 		$missing_confirmed_delivery_date = count($container_schedule_datastore->getMissingConfirmDeliveryDate());
 		$missing_received_dates_in_wms = count($container_schedule_datastore->getMissingReceivedDatesInWMS());
 		$missing_received_dates_in_oms = count($container_schedule_datastore->getMissingReceivedDatesInOMS());
		return [
			"eta_report_count" => $eta_report_count,
			"empty_return_date_past_empty_lfd_report" => $empty_return_date_past_empty_lfd_report,
			"pending_schedule_delivery_date_for_today_report" => $pending_schedule_delivery_date_for_today_report,
			"empty_alpine_notification_pickup_date" => $empty_alpine_notification_pickup_date,
			"missing_id_report" => $missing_id_report,
			"missing_terminal_appointment_date" => $missing_terminal_appointment_date,
			"missing_schedule_delivery_date" => $missing_schedule_delivery_date,
			"missing_confirmed_delivery_date" => $missing_confirmed_delivery_date,
			"missing_received_dates_in_wms" => $missing_received_dates_in_wms,
			"missing_received_dates_in_oms" => $missing_received_dates_in_oms
		];
	}
	public function getAllContainerSchedules($beanReturnDataType){
        if($beanReturnDataType == BeanReturnDataType::count){
            $query = self::$selectCountSql;
            $containerSchedules = self::$dataStore->executeCountQueryWithSql($query);
            return $containerSchedules;
        }elseif($beanReturnDataType == BeanReturnDataType::export){
            $query = self::$select;
            $containerSchedules = self::$dataStore->executeObjectQuery($query);
            return $containerSchedules;
        }
    }
    public function getETADatesPendingInNextSevenDays($beanReturnDataType){
		$currentDate = DateUtil::getDateInDBFormat(0,null,self::$timeZone);
        $currentDateWithInterval = DateUtil::getDateInDBFormat(6,null,self::$timeZone);
        if($beanReturnDataType == BeanReturnDataType::count){
            $query = self::$selectCountSql . " where etadatetime >= '$currentDate' and etadatetime < '$currentDateWithInterval'";
            $containerSchedules = self::$dataStore->executeCountQueryWithSql($query);
            return $containerSchedules;
        }elseif($beanReturnDataType == BeanReturnDataType::export){
            $query = $query = self::$select . " where etadatetime >= '$currentDate' and etadatetime < '$currentDateWithInterval'";;
            $containerSchedules = self::$dataStore->executeObjectQuery($query);
            return $containerSchedules;
        }
    }
    public function getEmptyReturnDatePastEmptyLFD($beanReturnDataType){
		$currentDate = DateUtil::getDateInDBFormatWithInterval(1,null,true,self::$timeZone);
        $currentDateInterval7Days = DateUtil::getDateInDBFormatWithInterval(7,null,true,self::$timeZone);
        if($beanReturnDataType == BeanReturnDataType::count){
            $query = self::$selectCountSql . " where emptyreturndate >= '$currentDateInterval7Days' and emptyreturndate <= '$currentDate' and emptyreturndate > emptylfddate";
            $containerSchedules = self::$dataStore->executeCountQueryWithSql($query);
            return $containerSchedules;
        }elseif($beanReturnDataType == BeanReturnDataType::export){
			$query = self::$select . " where emptyreturndate >= '$currentDateInterval7Days' and emptyreturndate <= '$currentDate' and emptyreturndate > emptylfddate";
			$containerSchedules = self::$dataStore->executeObjectQuery($query);
            return $containerSchedules;
        }
    }
    public function getPendingScheduleDeliveryDateForToday($beanReturnDataType){
		$currentDate = DateUtil::getDateInDBFormat(0,null,self::$timeZone);
        if($beanReturnDataType == BeanReturnDataType::count){
            $query = self::$selectCountSql . " where Date_format(scheduleddeliverydatetime, '%Y-%m-%d') = '$currentDate'";
            $containerSchedules = self::$dataStore->executeCountQueryWithSql($query);
            return $containerSchedules;
        }elseif($beanReturnDataType == BeanReturnDataType::export){
			$query = self::$select . " where Date_format(scheduleddeliverydatetime, '%Y-%m-%d') = '$currentDate'";
			$containerSchedules = self::$dataStore->executeObjectQuery($query);
            return $containerSchedules;
        }
    }
    public function getMissingTerminalAppointmentDate($beanReturnDataType)
    {
        if($beanReturnDataType == BeanReturnDataType::count){
            $query = self::$selectCountSql . " where lfdpickupdate is not NULL and terminalappointmentdatetime is NULL";
            $containerSchedules = self::$dataStore->executeCountQueryWithSql($query);
            return $containerSchedules;
        }elseif($beanReturnDataType == BeanReturnDataType::export){
			$query = self::$select . " where lfdpickupdate is not NULL and terminalappointmentdatetime is NULL";
			$containerSchedules = self::$dataStore->executeObjectQuery($query);
            return $containerSchedules;
        }
    }
    public function getMissingAlpineNotificationDate($beanReturnDataType)
    {
		$currentDate = self::$currentDateInDBFormat;
        if($beanReturnDataType == BeanReturnDataType::count){
            $query = self::$selectCountSql . " where scheduleddeliverydatetime < '$currentDate' and alpinenotificatinpickupdatetime is NULL";
            $containerSchedules = self::$dataStore->executeCountQueryWithSql($query);
            return $containerSchedules;
        }elseif($beanReturnDataType == BeanReturnDataType::export){
			$query = self::$select . " where scheduleddeliverydatetime < '$currentDate' and alpinenotificatinpickupdatetime is NULL";
			$containerSchedules = self::$dataStore->executeObjectQuery($query);
            return $containerSchedules;
        }
    }
    public function getMissingConfirmDeliveryDate($beanReturnDataType)
    {	
		$currentDate = self::$currentDateInDBFormat;
        if($beanReturnDataType == BeanReturnDataType::count){
            $query = self::$selectCountSql . " where Date_format(scheduleddeliverydatetime, '%Y-%m-%d') = '$currentDate' and confirmeddeliverydatetime is NULL";
            $containerSchedules = self::$dataStore->executeCountQueryWithSql($query);
            return $containerSchedules;
        }elseif($beanReturnDataType == BeanReturnDataType::export){
			$query = self::$select . " where Date_format(scheduleddeliverydatetime, '%Y-%m-%d') = '$currentDate' and confirmeddeliverydatetime is NULL";
			$containerSchedules = self::$dataStore->executeObjectQuery($query);
            return $containerSchedules;
        }
    }
    public function getMissingIDReport($beanReturnDataType){
		$dateIntervalWith2Days = DateUtil::getDateInDBFormatWithInterval(2,null,true,self::$timeZone);
        $currentDate = self::$currentDateInDBFormat;
        if($beanReturnDataType == BeanReturnDataType::count){
            $query = self::$selectCountSql . " where etadatetime > '$dateIntervalWith2Days' AND etadatetime < '$currentDate' and (isidscomplete is null or isidscomplete = 0)";
            $containerSchedules = self::$dataStore->executeCountQueryWithSql($query);
            return $containerSchedules;
        }elseif($beanReturnDataType == BeanReturnDataType::export){
			$query = self::$select . " where etadatetime > '$dateIntervalWith2Days' AND etadatetime < '$currentDate' and (isidscomplete is null or isidscomplete = 0)";
			$containerSchedules = self::$dataStore->executeObjectQuery($query);
            return $containerSchedules;
        }
    }
    public function getMissingReceivedDatesInOMS($beanReturnDataType){
        if($beanReturnDataType == BeanReturnDataType::count){
            $query = self::$selectCountSql . " where containerreceivedinwmsdate is not NULL and (containerreceivedinomsdate is NULL or (issamplesreceived = 1 and samplesreceivedinomsdate is NULL))";
            $containerSchedules = self::$dataStore->executeCountQueryWithSql($query);
            return $containerSchedules;
        }elseif($beanReturnDataType == BeanReturnDataType::export){
			$query = self::$select . " where containerreceivedinwmsdate is not NULL and (containerreceivedinomsdate is NULL or (issamplesreceived = 1 and samplesreceivedinomsdate is NULL))";
			$containerSchedules = self::$dataStore->executeObjectQuery($query);
            return $containerSchedules;
        }
    }
    public function getMissingReceivedDatesInWMS($beanReturnDataType){
        if($beanReturnDataType == BeanReturnDataType::count){
            $query = self::$selectCountSql . " where confirmeddeliverydatetime is not NULL and (containerreceivedinwmsdate is NULL or (issamplesreceived = 1 and samplesreceivedinwmsdate is NULL))";
            $containerSchedules = self::$dataStore->executeCountQueryWithSql($query);
            return $containerSchedules; 
        }elseif($beanReturnDataType == BeanReturnDataType::export){
			$query = self::$select . " where confirmeddeliverydatetime is not NULL and (containerreceivedinwmsdate is NULL or (issamplesreceived = 1 and samplesreceivedinwmsdate is NULL))";
			$containerSchedules = self::$dataStore->executeObjectQuery($query);
            return $containerSchedules;
        }
    }
    public function getMissingScheduleDeliveryDate($beanReturnDataType)
    {
        if($beanReturnDataType == BeanReturnDataType::count){
            $query = self::$selectCountSql . " where terminalappointmentdatetime is not NULL and scheduleddeliverydatetime is NULL";
            $containerSchedules = self::$dataStore->executeCountQueryWithSql($query);
            return $containerSchedules;
        }elseif($beanReturnDataType == BeanReturnDataType::export){
			$query = self::$select . " where terminalappointmentdatetime is not NULL and scheduleddeliverydatetime is NULL";
			$containerSchedules = self::$dataStore->executeObjectQuery($query);
            return $containerSchedules;
        }
    }
    public function exportFilterData($filterId){
        $containerSchedules = null;
        $ContainerExportSchedulesAndFileName = array();
        $fileName = "ContainerSchedules";
        if($filterId == "container_schedules_all_count_export_date"){
            $containerSchedules = $this->getAllContainerSchedules(BeanReturnDataType::getValue("export"));
        }elseif($filterId == "container_schedules_eta_report_count_export_date"){
            $containerSchedules = $this->getETADatesPendingInNextSevenDays(BeanReturnDataType::getValue("export"));
            $fileName = "ContainerSchedulesETADatesPendingInNextSevenDays";
        }elseif($filterId == "container_schedules_empty_return_date_past_empty_lfd_count_export_date"){
            $containerSchedules = $this->getEmptyReturnDatePastEmptyLFD(BeanReturnDataType::getValue("export"));
            $fileName = "ContainerSchedulesEmptyReturnDatePastEmptyLFD";
        }elseif($filterId == "container_schedules_pending_schedule_delivery_date_count_export_date"){
            $containerSchedules = $this->getPendingScheduleDeliveryDateForToday(BeanReturnDataType::getValue("export"));
            $fileName = "ContainerSchedulesPendingScheduleDeliveryDateForToday";
        }elseif($filterId == "container_schedules_missing_terminal_appointment_date_count_export_date"){
            $containerSchedules = $this->getMissingTerminalAppointmentDate(BeanReturnDataType::getValue("export"));
            $fileName = "ContainerSchedulesMissingTerminalAppointmentDate";
        }elseif($filterId == "container_schedules_empty_alpine_notification_pickup_date_count_export_date"){
            $containerSchedules = $this->getMissingAlpineNotificationDate(BeanReturnDataType::getValue("export"));
            $fileName = "ContainerSchedulesMissingAlpineNotificationDate";
        }elseif($filterId == "container_schedules_missing_confirmed_delivery_date_count_export_date"){
            $containerSchedules = $this->getMissingConfirmDeliveryDate(BeanReturnDataType::getValue("export"));
            $fileName = "ContainerSchedulesMissingConfirmDeliveryDate";
        }elseif($filterId == "container_schedules_missing_id_count_export_date"){
            $containerSchedules = $this->getMissingIDReport(BeanReturnDataType::getValue("export"));
            $fileName = "ContainerSchedulesMissingIDReport";
        }elseif($filterId == "container_schedules_missing_received_dates_in_oms_count_export_date"){
            $containerSchedules = $this->getMissingReceivedDatesInOMS(BeanReturnDataType::getValue("export"));
            $fileName = "ContainerSchedulesMissingReceivedDatesInOMS";
        }elseif($filterId == "container_schedules_missing_received_dates_in_wms_count_export_date"){
            $containerSchedules = $this->getMissingReceivedDatesInWMS(BeanReturnDataType::getValue("export"));
            $fileName = "ContainerSchedulesMissingReceivedDatesInWMS";
        }elseif($filterId == "container_schedules_missing_schedule_delivery_date_count_export_date"){
			$containerSchedules = $this->getMissingScheduleDeliveryDate(BeanReturnDataType::getValue("export"));
			$fileName = "ContainerScheduleMissingScheduleDeliveryDate";
        }
        $containerSchedulesArr = $this->setNotesAndDates($containerSchedules);
        $ContainerExportSchedulesAndFileName['containerSchedulesArr'] = $containerSchedulesArr;
        $ContainerExportSchedulesAndFileName['fileName'] = $fileName;
        return $ContainerExportSchedulesAndFileName;
    }
}