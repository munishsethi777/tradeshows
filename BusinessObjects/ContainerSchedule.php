<?php
class ContainerSchedule {
	public static $className = "ContainerSchedule";
	public static $tableName = "containerschedules";
	private $seq;
	private $awureference;
	private $truckername;
	private $trans;
	private $warehouse;
	private $container;
	private $etadatetime;
	private $terminal;
	private $terminalappointmentdatetime;
	private $etanotes;
	private $etanotesdatetime;
	private $lfdpickupdate;
	private $scheduleddeliverydatetime;
	private $confirmeddeliverydatetime;
	private $emptylfddate;
	private $deliverygate;
	private $emptyreturndate;
	private $alpinenotificatinpickupdatetime;
	private $emptynotes;
	private $emptynotesdatetime;
	private $notificationnotes;
	private $notificationnotesdatetime;
	private $containerdocspath;
	private $isidscomplete;
	private $issamplesreceived;
	private $msrfcreateddate;
	private $samplesreceiveddate;
	private $iscontainerreceivedinoms;
	private $containerreceivedinomsdate;
	private $issamplesreceivedinoms;
	private $samplesreceivedinomsdate;
	private $iscontainerreceivedinwms;
	private $containerreceivedinwmsdate;
	private $issamplesreceivedinwms;
	private $samplesreceivedinwmsdate;
	private $createdby;
	private $createdon;
	private $lastmodifiedon;
	private $emptyscheduledpickupdate;
	private $customexamterminal;
	private $customexamstatus;
	private $ishotcontainer;
	public function setSeq($seq) {
		$this->seq = $seq;
	}
	public function getSeq() {
		return $this->seq;
	}
	public function setAWUReference($awureference) {
		$this->awureference = $awureference;
	}
	public function getAWUReference() {
		return $this->awureference;
	}
	public function setTruckerName($truckername) {
		$this->truckername = $truckername;
	}
	public function getTruckerName() {
		return $this->truckername;
	}
	public function setTrans($trans) {
		$this->trans = $trans;
	}
	public function getTrans() {
		return $this->trans;
	}
	public function setWarehouse($warehouse) {
		$this->warehouse = $warehouse;
	}
	public function getWarehouse() {
		return $this->warehouse;
	}
	public function setContainer($container) {
		$this->container = $container;
	}
	public function getContainer() {
		return $this->container;
	}
	public function setEtaDateTime($eta) {
		$this->etadatetime = $eta;
	}
	public function getEtaDateTime() {
		return $this->etadatetime;
	}
	public function setTerminal($terminal) {
		$this->terminal = $terminal;
	}
	public function getTerminal() {
		return $this->terminal;
	}
	public function setTerminalAppointmentDateTime($terminalappointment) {
		$this->terminalappointmentdatetime = $terminalappointment;
	}
	public function getTerminalAppointmentDateTime() {
		return $this->terminalappointmentdatetime;
	}
	public function setETANotes($etanotes) {
		$this->etanotes = $etanotes;
	}
	public function getETANotes() {
		return $this->etanotes;
	}
	public function setETANotesdatetime($etanotesdate) {
		$this->etanotesdatetime = $etanotesdate;
	}
	public function getETANotesdatetime() {
		return $this->etanotesdatetime;
	}
	public function setLFDPickupDate($lfdpickup) {
		$this->lfdpickupdate = $lfdpickup;
	}
	public function getLFDPickupDate() {
		return $this->lfdpickupdate;
	}
	public function setScheduledDeliveryDateTime($scheduleddelivery) {
		$this->scheduleddeliverydatetime = $scheduleddelivery;
	}
	public function getScheduledDeliveryDateTime() {
		return $this->scheduleddeliverydatetime;
	}
	public function setConfirmedDeliveryDateTime($confirmeddelivery) {
		$this->confirmeddeliverydatetime = $confirmeddelivery;
	}
	public function getConfirmedDeliveryDateTime() {
		return $this->confirmeddeliverydatetime;
	}
	public function setEmptyLfdDate($emptylfddate) {
		$this->emptylfddate = $emptylfddate;
	}
	public function getEmptyLfdDate() {
		return $this->emptylfddate;
	}
	public function setDeliveryGate($deliverygate) {
		$this->deliverygate = $deliverygate;
	}
	public function getDeliveryGate() {
		return $this->deliverygate;
	}
	public function setEmptyReturnDate($emptyreturndate) {
		$this->emptyreturndate = $emptyreturndate;
	}
	public function getEmptyReturnDate() {
		return $this->emptyreturndate;
	}
	public function setAlpineNotificatinPickupDateTime($alpinenotificatinpickup) {
		$this->alpinenotificatinpickupdatetime = $alpinenotificatinpickup;
	}
	public function getAlpineNotificatinPickupDateTime() {
		return $this->alpinenotificatinpickupdatetime;
	}
	public function setEmptyNotes($emptynotes) {
		$this->emptynotes = $emptynotes;
	}
	public function getEmptyNotes() {
		return $this->emptynotes;
	}
	public function setEmptyNotesDateTime($emptynotesdate) {
		$this->emptynotesdatetime = $emptynotesdate;
	}
	public function getEmptyNotesDateTime() {
		return $this->emptynotesdatetime;
	}
	public function setNotificationNotes($notificationnotes) {
		$this->notificationnotes = $notificationnotes;
	}
	public function getNotificationNotes() {
		return $this->notificationnotes;
	}
	public function setNotificationNotesDateTime($notificationnotesdate) {
		$this->notificationnotesdatetime = $notificationnotesdate;
	}
	public function getNotificationNotesDateTime() {
		return $this->notificationnotesdatetime;
	}
	public function setContainerdocsPath($containerdocspath) {
		$this->containerdocspath = $containerdocspath;
	}
	public function getContainerdocsPath() {
		return $this->containerdocspath;
	}
	public function setIsIdsComplete($isidscomplete) {
		$this->isidscomplete = $isidscomplete;
	}
	public function getIsIdsComplete() {
		return $this->isidscomplete;
	}
	public function setIsSamplesReceived($issamplesreceived) {
		$this->issamplesreceived = $issamplesreceived;
	}
	public function getIsSamplesReceived() {
		return $this->issamplesreceived;
	}
	public function setMsrfCreatedDate($msrfcreateddate) {
		$this->msrfcreateddate = $msrfcreateddate;
	}
	public function getMsrfCreatedDate() {
		return $this->msrfcreateddate;
	}
	public function setSamplesReceivedDate($samplesreceiveddate) {
		$this->samplesreceiveddate = $samplesreceiveddate;
	}
	public function getSamplesReceivedDate() {
		return $this->samplesreceiveddate;
	}
	public function setIsContainerReceivedinOMS($iscontainerreceivedinoms) {
		$this->iscontainerreceivedinoms = $iscontainerreceivedinoms;
	}
	public function getIsContainerReceivedinOMS() {
		return $this->iscontainerreceivedinoms;
	}
	public function setContainerReceivedinOMSDate($containerreceivedinomsdate) {
		$this->containerreceivedinomsdate = $containerreceivedinomsdate;
	}
	public function getContainerReceivedinOMSDate() {
		return $this->containerreceivedinomsdate;
	}
	public function setIssamplesReceivedinOMS($issamplesreceivedinoms) {
		$this->issamplesreceivedinoms = $issamplesreceivedinoms;
	}
	public function getIssamplesReceivedinOMS() {
		return $this->issamplesreceivedinoms;
	}
	public function setSamplesReceivedinOMSDate($samplesreceivedinomsdate) {
		$this->samplesreceivedinomsdate = $samplesreceivedinomsdate;
	}
	public function getSamplesReceivedinOMSDate() {
		return $this->samplesreceivedinomsdate;
	}
	public function setIsContainerReceivedinWMS($iscontainerreceivedinwms) {
		$this->iscontainerreceivedinwms = $iscontainerreceivedinwms;
	}
	public function getIsContainerReceivedinWMS() {
		return $this->iscontainerreceivedinwms;
	}
	public function setContainerReceivedinWMSDate($containerreceivedinwmsdate) {
		$this->containerreceivedinwmsdate = $containerreceivedinwmsdate;
	}
	public function getContainerReceivedinWMSDate() {
		return $this->containerreceivedinwmsdate;
	}
	public function setIssamplesReceivedinWMS($issamplesreceivedinwms) {
		$this->issamplesreceivedinwms = $issamplesreceivedinwms;
	}
	public function getIssamplesReceivedinWMS() {
		return $this->issamplesreceivedinwms;
	}
	public function setSamplesReceivedinWMSDate($samplesreceivedinwmsdate) {
		$this->samplesreceivedinwmsdate = $samplesreceivedinwmsdate;
	}
	public function getSamplesReceivedinWMSDate() {
		return $this->samplesreceivedinwmsdate;
	}
	public function setCreatedby($createdby) {
		$this->createdby = $createdby;
	}
	public function getCreatedby() {
		return $this->createdby;
	}
	public function setCreatedon($createdon) {
		$this->createdon = $createdon;
	}
	public function getCreatedon() {
		return $this->createdon;
	}
	public function setLastModifiedon($lastmodifiedon) {
		$this->lastmodifiedon = $lastmodifiedon;
	}
	public function getLastModifiedon() {
		return $this->lastmodifiedon;
	}
	public function createFromRequest($request) {
		if (is_array ( $request )) {
			$this->from_array ( $request );
		}
		return $this;
	}
	
	public function setEmptyScheduledPickUpDate($schedulePickUpDate_){
	    $this->emptyscheduledpickupdate = $schedulePickUpDate_;
	}
	
	public function getEmptyScheduledPickUpDate(){
	    return $this->emptyscheduledpickupdate;
	}
	
	public function setCustomExamTerminal($customexamterminal_){
	    $this->customexamterminal = $customexamterminal_;
	}
	public function getCustomExamTerminal(){
	    return $this->customexamterminal;
	}
	
	public function setCustomExamStatus($customerexamstatus_){
	    $this->customexamstatus = $customerexamstatus_;
	}
	public function getCustomExamStatus(){
	    return $this->customexamstatus;
	}
	
	public function setIsHotContainer($ishotcontainer_){
	    $this->ishotcontainer = $ishotcontainer_;
	}
	public function getIsHotContainer(){
	    return $this->ishotcontainer;
	}
	
	
	public function from_array($array) {
		foreach ( get_object_vars ( $this ) as $attrName => $attrValue ) {
			$flag = property_exists ( self::$className, $attrName );
			$isExists = array_key_exists ( $attrName, $array );
			if ($flag && $isExists) {
				$datePos = strpos ( strtolower ( $attrName ), 'date' );
				$dateTimePos = strpos ( strtolower ( $attrName ), 'datetime' );
				$isBoolean = substr($attrName, 0,2) == "is" ? true : false;
				
				$value = $array [$attrName];
				if ($datePos !== false && ! empty ( $array [$attrName] )) {
					$value = DateUtil::StringToDateByGivenFormat ( "m-d-Y", $array [$attrName] );
				}
				if ($dateTimePos !== false && ! empty ( $array [$attrName] )) {
					$value = DateUtil::StringToDateByGivenFormat ( "m-d-Y h:i A", $array [$attrName] );
				}
				if($isBoolean == true) {
					if(!empty ($array [$attrName])){
						$value = true;
					}else{
						$value = false;
					}	
				}
				if (! empty ( $value )) {
					$this->{$attrName} = $value;
				}
			}
		}
	}
}
