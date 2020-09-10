<?php
require_once("../IConstants.inc");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Shippinglog.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Shippinglogdomestic.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Shippingloginternet.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ShippinglogMgr.php");

require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ConfigurationMgr.php");
$success = 1;
$message = "";
$call = "";
$response = new ArrayObject();
if(isset($_GET["call"])){
    $call = $_GET["call"];
}else{
    $call = $_POST["call"];
}
$shippinglogMgr = ShippinglogMgr::getInstance();
if($call == "saveShippinglog"){
    try{
        $seq = $_REQUEST["seq"];
        $shippinglog = new Shippinglog();
        $shippinglog = $shippinglog->createFromRequest($_REQUEST);
        //$shippinglog->setSeq($seq);
        if(isset($_REQUEST["isedi"])){
            $shippinglog->setIsEdi("1");
        }
        $shippinglog->setLastModifiedOn(new DateTime());
        if($seq == "0"){
            $shippinglog->setCreatedOn(new DateTime());
        }
        $seq = $shippinglogMgr->save($shippinglog);
        if($_REQUEST["business"] == "domestic"){
            $shippinglogdomestic = new Shippinglogdomestic();
            $shippinglogdomestic = $shippinglogdomestic->createFromRequest($_REQUEST);
            $shippinglogdomestic->setSeq(null);
            if(isset($_REQUEST["allocatefull"])){
                $shippinglogdomestic->setAllocatedFull("1");
            }else{
                $shippinglogdomestic->setAllocatedFull("0");
            }
            if(isset($_REQUEST["invoiced"])){
                $shippinglogdomestic->setInvoiced("1");
            }else{
                $shippinglogdomestic->setInvoiced("0");
            }
            $shippinglogdomestic->setCreatedOn(new DateTime());
            $shippinglogdomestic->setModifiedOn(new DateTime());
            $shippinglogdomestic->setShippinglogSeq($seq);
            $domesticSeq = $shippinglogMgr->saveDomestic($shippinglogdomestic);
        }else{
            $shippingloginternetlength = $_REQUEST["totalnumberofpickticketsforpalletorders"];
            //$shippingloginternetArray = array();
            for($i = 0;$i < $shippingloginternetlength + 1;$i++){
                $shippingloginternet = new Shippingloginternet();
                if($_REQUEST["ordershipdate"] != ""){
                    $shippingloginternet->setOrderShipDate(DateUtil::StringToDateByGivenFormat("m-d-Y", $_REQUEST["ordershipdate"]));
                }
                $shippingloginternet->setWhNo($_REQUEST["whno"]);
                $shippingloginternet->setTotalNumberOfPickTicketsForBatchFromOMSReport($_REQUEST["totalnumberofpickticketsforbatchfromomsreport"]);
                $shippingloginternet->setTotalNumberOfPickTicketsForPalletOrders($_REQUEST["totalnumberofpickticketsforpalletorders"]);
                $shippingloginternet->setTotalNumberOfPickTicketsForRMA($_REQUEST["totalnumberofpickticketsforrma"]);
                $shippingloginternet->setTotalNumberOfParcelPickTicket($_REQUEST["totalnumberofpickticketsforbatchfromomsreport"] - $_REQUEST["totalnumberofpickticketsforpalletorders"] - $_REQUEST["totalnumberofpickticketsforrma"]);
                $shippingloginternet->setAllocationTime($_REQUEST["allocationtime"]);
                if($_REQUEST["savebatchto"][$i] != ""){
                    $shippingloginternet->setSaveBatchTo(DateUtil::StringToDateByGivenFormat("m-d-Y", $_REQUEST["savebatchto"][$i]));
                }
                $shippingloginternet->setCreateShipmentsInLingo($_REQUEST["createshipmentsinlingo"][$i]);
                $shippingloginternet->setPrintLabelsFromCustomerPortal($_REQUEST["printlabelsfromcustomerportal"][$i]);
                $shippingloginternet->setSendASNThroughLingo($_REQUEST["sendasnthroughlingo"][$i]);
                $shippingloginternet->setSendInvoiceThroughLingo($_REQUEST["sendinvoicethroughlingo"][$i]);
                if($_REQUEST["verifywithleadbatchandlabelsprintedname"][$i] != ""){
                    $shippingloginternet->setVerifyWithLeadBatchAndLabelsPrintedName(DateUtil::StringToDateByGivenFormat("m-d-Y H:i:s", $_REQUEST["verifywithleadbatchandlabelsprintedname"][$i]));
                }
                $shippingloginternet->setNotesForLogisticInUSAOffice($_REQUEST["notesforlogisticinusaoffice"][$i]);
                $shippingloginternet->setPrintPickListFromWMS($_REQUEST["printpicklistfromwms"][$i]);
                $shippingloginternet->setOpenPickTicketPDFBatchToVerifyWeights($_REQUEST["openpickticketpdfbatchtoverifyweights"][$i]);
                $shippingloginternet->setPrintLabelsFromAlpineUps($_REQUEST["printlabelsfromalpineups"][$i]);
                $shippingloginternet->setAddTrackingInCustomerPortal($_REQUEST["addtrackingincustomerportal"][$i]);
                $shippingloginternet->setSendInvoiceOnCustomerPortal($_REQUEST["sendinvoiceoncustomerportal"][$i]);
                if($_REQUEST["issuedtoorderleadalma"][$i] != ""){
                    $shippingloginternet->setIssuedToOrderLeadAlma(DateUtil::StringToDateByGivenFormat("m-d-Y H:i:s", $_REQUEST["issuedtoorderleadalma"][$i]));
                }
                if($_REQUEST["orderleadissuedbatchtowarehouse"][$i] != ""){
                    $shippingloginternet->setOrderLeadIssuedBatchToWarehouse(DateUtil::StringToDateByGivenFormat("m-d-Y H:i:s", $_REQUEST["orderleadissuedbatchtowarehouse"][$i]));
                }
                if($_REQUEST["invoicedateinoms"][$i] != ""){
                    $shippingloginternet->setInvoiceDateInOMS(DateUtil::StringToDateByGivenFormat("m-d-Y", $_REQUEST["invoicedateinoms"][$i]));
                }
                if($_REQUEST["warehouseleadconfirmedpickticketsreviewed"][$i] != ""){
                    $shippingloginternet->setWarehouseLeadConfirmedPickTicketsReviewed($_REQUEST["warehouseleadconfirmedpickticketsreviewed"][$i]);
                }
                if($_REQUEST["numberofinvoicesgenerated"][$i] != ""){
                    $shippingloginternet->setNumberOfInvoicesGenerated($_REQUEST["numberofinvoicesgenerated"][$i]);
                }
                $shippingloginternet->setInvoicedIssueStorePortUSAOffice($_REQUEST["invoicedissuestoreportusaoffice"][$i]);
                if($_REQUEST["omsinvoicedupdatedwithfrieghtcostinsource"][$i] != ""){
                    $shippingloginternet->setOMSInvoicedUpdatedWithFrieghtCostInSource(DateUtil::StringToDateByGivenFormat("m-d-Y", $_REQUEST["omsinvoicedupdatedwithfrieghtcostinsource"][$i]));
                }
                if($_REQUEST["createasnandinvoicedinlingo"][$i] != ""){
                    $shippingloginternet->setCreateASNAndInvoicedInLingo(DateUtil::StringToDateByGivenFormat("m-d-Y", $_REQUEST["createasnandinvoicedinlingo"][$i]));
                }
                if($_REQUEST["datebatchis100invoiced"][$i] != ""){
                    $shippingloginternet->setDateBatchIs100Invoiced(DateUtil::StringToDateByGivenFormat("m-d-Y", $_REQUEST["datebatchis100invoiced"][$i]));
                }
                $shippingloginternet->setCreatedOn(new DateTime());
                $shippingloginternet->setModifiedOn(new DateTime());
                $shippingloginternet->setShippinglogSeq($seq);
                $internetseq = $shippinglogMgr->saveInternet($shippingloginternet);
                //$shippingloginternetArray[] = $shippingloginternet;
            }
        }
        $response["success"] = "1";
        $response["message"] = "";
        echo json_encode($response);
    } catch(Exception $e){
        $response["success"] = "0";
        $response["message"] = $e->getMessage();
    }
}
if($call == "getAllShippinglogs"){
    $shippinglogsJson = $shippinglogMgr->getShippinglogsForGrid();
	echo json_encode($shippinglogsJson);
	return;
}
if($call == "getShippinglog"){
    try{
        $seq = $_REQUEST["seq"];
        $shippinglog_array = $shippinglogMgr->findBySeq($seq);
        echo json_encode($shippinglog_array);
    }catch(Exception $e){
        $response["success"] = "0";
        $response["message"] = $e->getMessage();
        echo $response;
    }
}
if($call == "deleteShippinglog"){
    $seqs = explode(",",$_REQUEST["seqs"]);
    $deletedseqs = array();
    $notdeletedseqs = $seqs;
    try{
        foreach($seqs as $index => $seq){
            $result = $shippinglogMgr->delete($seq);
            if($result){
                $deletedseqs[] = $seq;
                unset($notdeletedseqs[$index]);
            }
        }
        if(count($notdeletedseqs)>0){
            $response["success"] = "0";
            $response["message"] = count($deletedseqs) . " has been deleted.\n " . count($notdeletedseqs) . " has not been deleted.";
        }else{
            $response["success"] = "1";
            $response["message"] = count($deletedseqs) . " has been deleted";
        }
    }catch(Exception $e){
        $response["success"] = "0";
        $response["message"] = "Selected rows failed to delete $e->getMessage()";
    }
    echo json_encode($response);
}
if($call == "updateShippinglog"){}