<?php
class Shippingloginternet{
    public static $className = "Shippingloginternet";
    public static $tableName = "shippingloginternet";
    private $seq,$ordershipdate,$whno,$totalnumberofpickticketsforrma,$totalnumberofparcelpickticket,$allocationtime,$totalnumberofpickticketsforbatchfromomsreport,$totalnumberofpickticketsforpalletorders,$savebatchto,$createshipmentsinlingo,$printlabelsfromcustomerportal,$sendasnthroughlingo,$sendinvoicethroughlingo,$verifywithleadbatchandlabelsprintedname,$notesforlogisticinusaoffice,$printpicklistfromwms,$openpickticketpdfbatchtoverifyweights,$printlabelsfromalpineups,$addtrackingincustomerportal,$sendinvoiceoncustomerportal,$issuedtoorderleadalma,$orderleadissuedbatchtowarehouse,$invoicedateinoms,$warehouseleadconfirmedpickticketsreviewed,$numberofinvoicesgenerated,$invoicedissuestoreporttousaoffice,$omsinvoicedupdatedwithfrieghtcostinsource,$createasnandinvoicedinlingo,$datebatchis100invoiced,$createdon,$modifiedon,$shippinglogseq;
    public function getSeq(){
        return $this->seq;
    }
    public function setSeq($seq){
        $this->seq = $seq;
    }
    public function getOrderShipDate(){
        return $this->ordershipdate;
    }
    public function setOrderShipDate($ordershipdate){
        $this->ordershipdate = $ordershipdate;
    }
    public function getWhNo(){
        return $this->whno;
    }
    public function setWhNo($whno){
        $this->whno = $whno;
    }
    public function getTotalNumberOfPickTicketsForRMA(){
        return $this->totalnumberofpickticketsforrma;
    }
    public function setTotalNumberOfPickTicketsForRMA($totalnumberofpickticketsforrma){
        $this->totalnumberofpickticketsforrma = $totalnumberofpickticketsforrma;
    }
    public function getTotalNumberOfParcelPickTicket(){
        return $this->totalnumberofparcelpickticket;
    }
    public function setTotalNumberOfParcelPickTicket($totalnumberofparcelpickticket){
        $this->totalnumberofparcelpickticket = $totalnumberofparcelpickticket;
    }
    public function getAllocationTime(){
        return $this->allocationtime;
    }
    public function setAllocationTime($allocationtime){
        $this->allocationtime = $allocationtime;
    }
    public function getTotalNumberOfPickTicketsForBatchFromOMSReport(){
        return $this->totalnumberofpickticketsforbatchfromomsreport;
    }
    public function setTotalNumberOfPickTicketsForBatchFromOMSReport($totalnumberofpickticketsforbatchfromomsreport){
        $this->totalnumberofpickticketsforbatchfromomsreport = $totalnumberofpickticketsforbatchfromomsreport;
    }
    public function getTotalNumberOfPickTicketsForPalletOrders(){
        return $this->totalnumberofpickticketsforpalletorders;
    }
    public function setTotalNumberOfPickTicketsForPalletOrders($totalnumberofpickticketsforpalletorders){
        $this->totalnumberofpickticketsforpalletorders = $totalnumberofpickticketsforpalletorders;
    }
    public function getSaveBatchTo(){
        return $this->savebatchto;
    }
    public function setSaveBatchTo($savebatchto){
        $this->savebatchto = $savebatchto;
    }
    public function getCreateShipmentsInLingo(){
        return $this->createshipmentsinlingo;
    }
    public function setCreateShipmentsInLingo($createshipmentsinlingo){
        $this->createshipmentsinlingo = $createshipmentsinlingo;
    }
    public function getPrintLabelsFromCustomerPortal(){
        return $this->printlabelsfromcustomerportal;
    }
    public function setPrintLabelsFromCustomerPortal($printlabelsfromcustomerportal){
        $this->printlabelsfromcustomerportal = $printlabelsfromcustomerportal;
    }
    public function getSendASNThroughLingo(){
        return $this->sendasnthroughlingo;
    }
    public function setSendASNThroughLingo($sendasnthroughlingo){
        $this->sendasnthroughlingo = $sendasnthroughlingo;
    }
    public function getSendInvoiceThroughLingo(){
        return  $this->sendinvoicethroughlingo;
    }
    public function setSendInvoiceThroughLingo($sendinvoicethroughlingo){
        $this->sendinvoicethroughlingo = $sendinvoicethroughlingo;
    }
    public function getVerifyWithLeadBatchAndLabelsPrintedName(){
        return $this->verifywithleadbatchandlabelsprintedname;
    }
    public function setVerifyWithLeadBatchAndLabelsPrintedName($verifywithleadbatchandlabelsprintedname){
        $this->verifywithleadbatchandlabelsprintedname = $verifywithleadbatchandlabelsprintedname;
    }
    public function getNotesForLogisticInUSAOffice(){
        return $this->notesforlogisticinusaoffice;
    }
    public function setNotesForLogisticInUSAOffice($notesforlogisticinusaoffice){
        $this->notesforlogisticinusaoffice = $notesforlogisticinusaoffice;
    }
    public function getPrintPickListFromWMS(){
        return $this->printpicklistfromwms;
    }
    public function setPrintPickListFromWMS($printpicklistfromwms){
        $this->printpicklistfromwms = $printpicklistfromwms;
    }
    public function getOpenPickTicketPDFBatchToVerifyWeights(){
        return $this->openpickticketpdfbatchtoverifyweights;
    }
    public function setOpenPickTicketPDFBatchToVerifyWeights($openpickticketpdfbatchtoverifyweights){
        $this->openpickticketpdfbatchtoverifyweights = $openpickticketpdfbatchtoverifyweights;
    }
    public function getPrintLabelsFromAlpineUps(){
        return $this->printlabelsfromalpineups;
    }
    public function setPrintLabelsFromAlpineUps($printlabelsfromalpineups){
        $this->printlabelsfromalpineups = $printlabelsfromalpineups;
    }
    public function getAddTrackingInCustomerPortal(){
        return $this->addtrackingincustomerportal;
    }
    public function setAddTrackingInCustomerPortal($addtrackingincustomerportal){
        $this->addtrackingincustomerportal = $addtrackingincustomerportal;
    }
    public function getSendInvoiceOnCustomerPortal(){
        return $this->sendinvoiceoncustomerportal;
    }
    public function setSendInvoiceOnCustomerPortal($sendinvoiceoncustomerportal){
        $this->sendinvoiceoncustomerportal = $sendinvoiceoncustomerportal;
    }
    public function getIssuedToOrderLeadAlma(){
        return $this->issuedtoorderleadalma;
    }
    public function setIssuedToOrderLeadAlma($issuedtoorderleadalma){
        $this->issuedtoorderleadalma = $issuedtoorderleadalma;
    }
    public function getOrderLeadIssuedBatchToWarehouse(){
        return $this->orderleadissuedbatchtowarehouse;
    }
    public function setOrderLeadIssuedBatchToWarehouse($orderleadissuedbatchtowarehouse){
        $this->orderleadissuedbatchtowarehouse = $orderleadissuedbatchtowarehouse;
    }
    public function getInvoiceDateInOMS(){
        return $this->invoicedateinoms;
    }
    public function setInvoiceDateInOMS($invoicedateinoms){
        $this->invoicedateinoms = $invoicedateinoms;
    }
    public function getWarehouseLeadConfirmedPickTicketsReviewed(){
        return $this->warehouseleadconfirmedpickticketsreviewed;
    }
    public function setWarehouseLeadConfirmedPickTicketsReviewed($warehouseleadconfirmedpickticketsreviewed){
        $this->warehouseleadconfirmedpickticketsreviewed = $warehouseleadconfirmedpickticketsreviewed;
    }
    public function getNumberOfInvoicesGenerated(){
        return $this->numberofinvoicesgenerated;
    }
    public function setNumberOfInvoicesGenerated($numberofinvoicesgenerated){
        $this->numberofinvoicesgenerated = $numberofinvoicesgenerated;
    }
    public function getInvoicedIssueStorePortToUSAOffice(){
        return $this->invoicedissuestoreporttousaoffice;
    }
    public function setInvoicedIssueStorePortUSAOffice($invoicedissuestoreporttousaoffice){
        $this->invoicedissuestoreporttousaoffice = $invoicedissuestoreporttousaoffice;
    }
    public function getOMSInvoicedUpdatedWithFrieghtCostInSource(){
        return $this->omsinvoicedupdatedwithfrieghtcostinsource;
    }
    public function setOMSInvoicedUpdatedWithFrieghtCostInSource($omsinvoicedupdatedwithfrieghtcostinsource){
        $this->omsinvoicedupdatedwithfrieghtcostinsource = $omsinvoicedupdatedwithfrieghtcostinsource;
    }
    public function getCreateASNAndInvoicedInLingo(){
        return $this->createasnandinvoicedinlingo;
    }
    public function setCreateASNAndInvoicedInLingo($createasnandinvoicedinlingo){
        $this->createasnandinvoicedinlingo = $createasnandinvoicedinlingo;
    }
    public function getDateBatchIs100Invoiced(){
        return $this->datebatchis100invoiced;
    }
    public function setDateBatchIs100Invoiced($datebatchis100invoiced){
        $this->datebatchis100invoiced = $datebatchis100invoiced;
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