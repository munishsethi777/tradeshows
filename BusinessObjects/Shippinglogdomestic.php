<?php
class Shippinglogdomestic{
    public static $className = "Shippinglogdomestic";
    public static $tableName = "shippinglogdomestic";
    private $seq,$orderno,$pkno,$pono,$ordershipdate,$ordermustarrivebydate,$canceldate,$csnote,$allocatedfull,$totalsoqty,$totalcase,$totalactualopenorder,$totalpickticketamount,$shipservicelevel,$warehousenotes,$logisticname,$pickuptype,$pickupreference,$confirmpickuptime,$statusoforder,$carrier,$confirmpickupdate,$numberofpallets,$logisticteaminternalnotes,$datelogisticalhandedpttoalmadate,$pickdate,$prono,$invoiced,$frieghtlocationinwarehouse,$datefrieghtpickedup,$notestologisticteamfromwarehouse,$createdon,$modifiedon,$shippinglogseq;
    public function getSeq(){
        return $this->seq;
    }
    public function setSeq($seq){
        $this->seq = $seq;
    }
    public function getOrderNo(){
        return $this->orderno;
    }
    public function setOrderNo($orderno){
        $this->orderno = $orderno;
    }
    public function getPkNo(){
        return $this->pkno;
    }
    public function setPkNo($pkno){
        $this->pkno = $pkno;
    }
    public function getPoNo(){
        return $this->pono;
    }
    public function setPoNo($pono){
        $this->pono = $pono;
    }
    public function getOrderShipDate(){
        return $this->ordershipdate;
    }
    public function setOrderShipDate($ordershipdate){
        $this->ordershipdate = $ordershipdate;
    }
    public function getOrderMustArriveByDate(){
        return $this->ordermustarrivebydate;
    }
    public function setOrderMustArriveByDate($ordermustarrivebydate){
        $this->ordermustarrivebydate = $ordermustarrivebydate;
    }
    public function getCancelDate(){
        return $this->canceldate;
    }
    public function setCancelDate($canceldate){
        $this->canceldate = $canceldate;
    }
    public function getCsNote(){
        return $this->csnote;
    }
    public function setCsNote($csnote){
        $this->csnote = $csnote;
    }
    public function getAllocatedFull(){
        return $this->allocatedfull;
    }
    public function setAllocatedFull($allocatedfull){
        $this->allocatedfull = $allocatedfull;
    }
    public function getTotalSoQty(){
        return $this->totalsoqty;
    }
    public function setTotalSoQty($totalsoqty){
        $this->totalsoqty = $totalsoqty;
    }
    public function getTotalCase(){
        return $this->totalcase;
    }
    public function setTotalCase($totalcase){
        $this->totalcase = $totalcase;
    }
    public function getTotalActualOpenOrder(){
        return $this->totalactualopenorder;
    }
    public function setTotalActualOpenOrder($totalactualopenorder){
        $this->totalactualopenorder = $totalactualopenorder;
    }
    public function getTotalPickTicketAmount(){
        return $this->totalpickticketamount;
    }
    public function setTotalPickTicketAmount($totalpickticketamount){
        $this->totalpickticketamount = $totalpickticketamount;
    }
    public function getShipServiceLevel(){
        return $this->shipservicelevel;
    }
    public function setShipServiceLevel($shipservicelevel){
        $this->shipservicelevel = $shipservicelevel;
    }
    public function getWarehouseNotes(){
        return $this->warehousenotes;
    }
    public function setWarehouseNotes($warehousenotes){
        $this->warehousenotes = $warehousenotes;
    }
    public function getLogisticName(){
        return $this->logisticname;
    }
    public function setLogisticName($logisticname){
        $this->logisticname = $logisticname;
    }
    public function getPickUpType(){
        return $this->pickuptype;
    }
    public function setPickUpType($pickuptype){
        $this->pickuptype = $pickuptype;
    }
    public function getPickUpReference(){
        return $this->pickupreference;
    }
    public function setPickUpReference($pickupreference){
        $this->pickupreference = $pickupreference;
    }
    public function getConfirmPickupTime(){
        return $this->confirmpickuptime;
    }
    public function setConfirmPickupTime($confirmpickuptime){
        $this->confirmpickuptime = $confirmpickuptime;
    }
    public function getStatusOfOrder(){
        return $this->statusoforder;
    }
    public function setStatusOfOrder($statusoforder){
        $this->statusoforder = $statusoforder;
    }
    public function getCarrier(){
        return $this->carrier;
    }
    public function setCarrier($carrier){
        $this->carrier = $carrier;
    }
    public function getConfirmPickupDate(){
        return $this->confirmpickupdate;
    }
    public function setConfirmPickupDate($confirmpickupdate){
        $this->confirmpickupdate = $confirmpickupdate;
    }
    public function getNumberOfPallets(){
        return $this->numberofpallets;
    }
    public function setNumberOfPallets($numberofpallets){
        $this->numberofpallets = $numberofpallets;
    }
    public function getLogisticTeamInternalNotes(){
        return $this->logisticteaminternalnotes;
    }
    public function setLogisticTeamInternalNotes($logisticteaminternalnotes){
        $this->logisticteaminternalnotes = $logisticteaminternalnotes;
    }
    public function getDateLogisticalHandedPtToAlmaDate(){
        return $this->datelogisticalhandedpttoalmadate;
    }
    public function setDateLogisticalHandedPtToAlmaDate($datelogisticalhandedpttoalmadate){
        $this->datelogisticalhandedpttoalmadate = $datelogisticalhandedpttoalmadate;
    }
    public function getPickDate(){
        return $this->pickdate;
    }
    public function setPickDate($pickdate){
        $this->pickdate = $pickdate;
    }
    public function getProno(){
        return $this->prono;
    }
    public function setProno($prono){
        $this->prono = $prono;
    }
    public function getInvoiced(){
        return $this->invoiced;
    }
    public function setInvoiced($invoiced){
        $this->invoiced = $invoiced;
    }
    public function getFrieghtLocationInWarehouse(){
        return $this->frieghtlocationinwarehouse;
    }
    public function setFrieghtLocationInWarehouse($frieghtlocationinwarehouse){
        $this->frieghtlocationinwarehouse = $frieghtlocationinwarehouse;
    }
    public function getDateFrieghtPickedUp(){
        return $this->datefrieghtpickedup;
    }
    public function setDateFrieghtPickedUp($datefrieghtpickedup){
        $this->datefrieghtpickedup = $datefrieghtpickedup;
    }
    public function getNotesToLogisticTeamFromWarehouse(){
        return $this->notestologisticteamfromwarehouse;
    }
    public function setNotesToLogisticTeamFromWarehouse($notestologisticteamfromwarehouse){
        $this->notestologisticteamfromwarehouse = $notestologisticteamfromwarehouse;
    }
    public function getCreatedOn(){
        return $this->createdon;
    }
    public function setCreatedOn($createdon){
        $this->createdon = $createdon;
    }
    public function getModifiedOn(){
        return $this->modifiedon;
    }
    public function setModifiedOn($modifiedon){
        $this->modifiedon = $modifiedon;
    }
    public function getShippingLogSeq(){
        return $this->shippinglogseq;
    }
    public function setShippingLogSeq($shippinglogseq){
        $this->shippinglogseq = $shippinglogseq;
    }

    public function from_array($array){
		foreach(get_object_vars($this) as $attrName => $attrValue){
			$flag = property_exists(self::$className, $attrName);
			$isExists = array_key_exists($attrName, $array);
			if($flag && $isExists){
				$datePos = strpos(strtolower ($attrName),'date');
				$value = $array[$attrName];
                if($attrName == "datelogisticalhandedpttoalmadate"){
                    $dateValue = DateUtil::StringToDateByGivenFormat("m-d-Y H:i:s", $value);
                    if($dateValue){
                        $value = $dateValue;
                    }
                }
                if($datePos !== false && !empty($value)){
					$dateValue = DateUtil::StringToDateByGivenFormat("m-d-Y", $value);
					if($dateValue){
						$value = $dateValue;
					}
				}
				if(!empty($value)){
					$this->{$attrName} = $value;
				}else{
					$this->{$attrName} = null;
				}
			}
		}
    }

    public function createFromRequest($request){
		if (is_array($request)){
			$this->from_array($request);
		}
		return $this;
	}
}