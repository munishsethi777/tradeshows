<?php
require_once($ConstantsArray['dbServerUrl'] . "DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Shippinglog.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Shippinglogdomestic.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Shippingloginternet.php");
class ShippinglogMgr{
    private static $shippinglogMgr;
    private static $dataStore;
    private static $internetDatastore;
    private static $domesticDatastore;
    public static function getInstance(){
        if(!self::$shippinglogMgr){
            self::$shippinglogMgr = new ShippinglogMgr();
            self::$dataStore = new BeanDataStore(Shippinglog::$className, Shippinglog::$tableName);
            self::$internetDatastore = new BeanDataStore(Shippingloginternet::$className, Shippingloginternet::$tableName);
            self::$domesticDatastore = new BeanDataStore(Shippinglogdomestic::$className, Shippinglogdomestic::$tableName);
        }
        return self::$shippinglogMgr;
    }
    public function save($shippinglog){
        if($shippinglog->getSeq() != "0"){
            $condition = array();
            $condition["shippinglogseq"] = $shippinglog->getSeq();
            self::$domesticDatastore->deleteByAttribute($condition);
            self::$internetDatastore->deleteByAttribute($condition);
        }
        return self::$dataStore->save($shippinglog);
    }
    public function saveInternet($shippingloginternet){
        return self::$internetDatastore->save($shippingloginternet);
    }
    public function saveDomestic($shippinglogdomestic){
        return self::$domesticDatastore->save($shippinglogdomestic);
    }
    public function getShippinglogsForGrid(){
        $query ="SELECT shippinglog.* FROM `shippinglog`";
		
		$sessionUtil = SessionUtil::getInstance();
		$loggedInUserTimeZone = $sessionUtil->getUserLoggedInTimeZone();
		$isSessionSV = $sessionUtil->isSessionSupervisor();
		$qcLoggedInSeq = $sessionUtil->getUserLoggedInSeq();
		$isGeneralUser = $sessionUtil->isSessionGeneralUser();
	
		$shippinglogs = self::$dataStore->executeQuery($query,true,true,true);
        $arr = array();
        $shippinglogseqs = array();
        $shippinglog_array = array();
		foreach ($shippinglogs as $shippinglog){
            if(!in_array($shippinglog["seq"],$shippinglogseqs)){
                if(!empty($shippinglogseqs)){
                    $arr[] = $shippinglog_array;
                }
                $shippinglog_array = array();
                $shippinglogseqs[] = $shippinglog["seq"];
                $shippinglog_array["id"] = $shippinglog["seq"];
                $shippinglog_array["orderissue"] = $shippinglog["orderissuedate"];
                $shippinglog_array["customername"] = $shippinglog["customername"];
                $shippinglog_array["batchno"] = $shippinglog["batchno"];
                $shippinglog_array["enteredby"] = $shippinglog["enteredby"];
                $shippinglog_array["business"] = $shippinglog["business"];
                $shippinglog_array["isedi"] = $shippinglog["isedi"];
                $shippinglog_array["createdon"] = $shippinglog["createdon"];
                $shippinglog_array["lastmodifiedon"] = $shippinglog["lastmodifiedon"];
            }
        }
        $arr[] = $shippinglog_array;
		$mainArr["Rows"] = $arr;
		$mainArr["TotalRows"] = $this->getAllCount(true,$isGeneralUser,$qcLoggedInSeq,$isSessionSV);
		return $mainArr;
    }
    public function getAllCount($isApplyFilter,$isGeneralUser,$qcLoggedInSeq,$isSessionSV){
        $query = "SELECT count(*) FROM `shippinglog`";
        // $sessionUtil = SessionUtil::getInstance();
        // $myTeamMembersArr  = $sessionUtil->getMyTeamMembers();
        // if($isGeneralUser && !($isSessionSV)){
        //     if(count($myTeamMembersArr) == 0){
        //         $query .= " where qcschedules.qcuser = $qcLoggedInSeq ";
        //     }else{
        //         $myTeamMembersCommaSeparated = implode(',', $myTeamMembersArr);
        //         $query .= " where qcschedules.qcuser in($myTeamMembersCommaSeparated)";
        //     }
        // }
        $count = self::$dataStore->executeCountQueryWithSql($query,$isApplyFilter,true);
        return $count;
    }
    public function getBySeq($seq){
        $shippinglog = self::$dataStore->findBySeq($seq);
        return $shippinglog;
    }
    /**
     * Used For Edit Case
     * @param seq the value of the seq of shippinglog
     */
    public function findBySeq($seq){
        
        $sql = "SELECT shippinglog.*, shippinglogdomestic.*,shippingloginternet.*,shippinglogdomestic.ordershipdate AS domesticordershipdate,shippingloginternet.ordershipdate AS internetordershipdate FROM `shippinglog` LEFT JOIN shippinglogdomestic ON shippinglogdomestic.shippinglogseq = shippinglog.seq LEFT JOIN shippingloginternet ON shippingloginternet.shippinglogseq = shippinglog.seq WHERE shippinglog.seq = $seq";
        $shippinglog_response = self::$dataStore->executeQuery($sql,false,true,false);
        $shippinglog_array = array();
        $shippinglog_array["seq"] = $shippinglog_response[0]["seq"];
        
        $orderissuedate = DateUtil::StringToDateByGivenFormat("Y-m-d",$shippinglog_response[0]["orderissuedate"]);
        if($orderissuedate != false){
            $shippinglog_array["orderissuedate"] = $orderissuedate->format("m-d-Y");
        }else{
            $shippinglog_array["orderissuedate"] = "";
        }
        $shippinglog_array["customername"] = $shippinglog_response[0]["customername"];
        $shippinglog_array["batchno"] = $shippinglog_response[0]["batchno"];
        $shippinglog_array["enteredby"] = $shippinglog_response[0]["enteredby"];
        $shippinglog_array["business"] = $shippinglog_response[0]["business"];
        $shippinglog_array["isedi"] = $shippinglog_response[0]["isedi"];
        if($shippinglog_response[0]["business"] == "domestic"){
            $shippinglog_array["orderno"] = $shippinglog_response[0]["orderno"];
            $shippinglog_array["pkno"] = $shippinglog_response[0]["pkno"];
            $shippinglog_array["pono"] = $shippinglog_response[0]["pono"];

            $ordershipdate = DateUtil::StringToDateByGivenFormat("Y-m-d",$shippinglog_response[0]["domesticordershipdate"]);
            if($ordershipdate != false){
                $shippinglog_array["ordershipdate"] = $ordershipdate->format("m-d-Y");
            }else{
                $shippinglog_array["ordershipdate"] = "";
            }

            $ordermustarrivebydate = DateUtil::StringToDateByGivenFormat("Y-m-d",$shippinglog_response[0]["ordermustarrivebydate"]);
            if($ordermustarrivebydate != false){
                $shippinglog_array["ordermustarrivebydate"] = $ordermustarrivebydate->format("m-d-Y");
            }else{
                $shippinglog_array["ordermustarrivebydate"] = "";
            }

            $canceldate = DateUtil::StringToDateByGivenFormat("Y-m-d",$shippinglog_response[0]["canceldate"]);
            if($canceldate != false){
                $shippinglog_array["canceldate"] = $canceldate->format("m-d-Y");
            }else{
                $shippinglog_array["canceldate"] = "";
            }
            $shippinglog_array["csnotes"] = $shippinglog_response[0]["csnote"];
            $shippinglog_array["allocatedfull"] = $shippinglog_response[0]["allocatedfull"];
            $shippinglog_array["totalsoqty"] = $shippinglog_response[0]["totalsoqty"];
            $shippinglog_array["totalcase"] = $shippinglog_response[0]["totalcase"];
            $shippinglog_array["totalactualopenorder"] = $shippinglog_response[0]["totalactualopenorder"];
            $shippinglog_array["totalpickticketamount"] = $shippinglog_response[0]["totalpickticketamount"];
            $shippinglog_array["shipservicelevel"] = $shippinglog_response[0]["shipservicelevel"];
            $shippinglog_array["warehousenotes"] = $shippinglog_response[0]["warehousenotes"];
            $shippinglog_array["logisticname"] = $shippinglog_response[0]["logisticname"];
            $shippinglog_array["pickuptype"] = $shippinglog_response[0]["pickuptype"];
            $shippinglog_array['pickupreference'] = $shippinglog_response[0]["pickupreference"];
            $shippinglog_array['confirmpickuptime'] = $shippinglog_response[0]["confirmpickuptime"];
            $shippinglog_array["statusoforder"] = $shippinglog_response[0]["statusoforder"];
            $shippinglog_array["carrier"] = $shippinglog_response[0]["carrier"];
            
            $confirmpickupdate = DateUtil::StringToDateByGivenFormat("Y-m-d",$shippinglog_response[0]["confirmpickupdate"]);
            if($confirmpickupdate != false){
                $shippinglog_array["confirmpickupdate"] = $confirmpickupdate->format("m-d-Y");
            }else{
                $shippinglog_array["confirmpickupdate"] = "";
            }
            $shippinglog_array["numberofpallets"] = $shippinglog_response[0]["numberofpallets"];
            $shippinglog_array["logisticteaminternalnotes"] = $shippinglog_response[0]["logisticteaminternalnotes"];
            
            $datelogisticalhandedpttoalmadate = DateUtil::StringToDateByGivenFormat("Y-m-d H:i:s",$shippinglog_response[0]["datelogisticalhandedpttoalmadate"]);
            if($datelogisticalhandedpttoalmadate != false){
                $shippinglog_array["datelogisticalhandedpttoalmadate"] = $datelogisticalhandedpttoalmadate->format("m-d-Y H:i:s");
            }else{
                $shippinglog_array["datelogisticalhandedpttoalmadate"] = "";
            }

            $pickdate = DateUtil::StringToDateByGivenFormat("Y-m-d",$shippinglog_response[0]["pickdate"]);
            if($pickdate != false){
                $shippinglog_array["pickdate"] = $pickdate->format("m-d-Y");
            }else{
                $shippinglog_array["pickdate"] = "";
            }
        
            $shippinglog_array["prono"] = $shippinglog_response[0]["prono"];
            $shippinglog_array["invoiced"] = $shippinglog_response[0]["invoiced"];
            $shippinglog_array["frieghtlocationinwarehouse"] = $shippinglog_response[0]["frieghtlocationinwarehouse"];
            $datefrieghtpickedup = DateUtil::StringToDateByGivenFormat("Y-m-d",$shippinglog_response[0]["datefrieghtpickedup"]);
            if($datefrieghtpickedup != false){
                $shippinglog_array["datefrieghtpickedup"] = $datefrieghtpickedup->format("m-d-Y");
            }else{
                $shippinglog_array["datefrieghtpickedup"] = "";
            }
            $shippinglog_array["notestologisticteamfromwarehouse"] = $shippinglog_response[0]["notestologisticteamfromwarehouse"];
        }else{
            $ordershipdate = DateUtil::StringToDateByGivenFormat("Y-m-d",$shippinglog_response[0]["internetordershipdate"]);
            if($ordershipdate != false){
                $shippinglog_array["ordershipdate"] = $ordershipdate->format("m-d-Y");
            }else{
                $shippinglog_array["ordershipdate"] = "";
            }
            $shippinglog_array["whno"] = $shippinglog_response[0]["whno"];
            $shippinglog_array["totalnumberofpickticketsforrma"] = $shippinglog_response[0]["totalnumberofpickticketsforrma"];
            $shippinglog_array["allocationtime"] = $shippinglog_response[0]["allocationtime"];
            $shippinglog_array["totalnumberofpickticketsforbatchfromomsreport"] = $shippinglog_response[0]["totalnumberofpickticketsforbatchfromomsreport"];
            $shippinglog_array["totalnumberofpickticketsforpalletorders"] = $shippinglog_response[0]["totalnumberofpickticketsforpalletorders"];

            $shippinglog_array["savebatchto"] = array();
            $shippinglog_array["createshipmentsinlingo"] = array();
            $shippinglog_array["printlabelsfromcustomerportal"] = array();
            $shippinglog_array["sendasnthroughlingo"] = array();
            $shippinglog_array["sendinvoicethroughlingo"] = array();
            $shippinglog_array["verifywithleadbatchandlabelsprintedname"] = array();
            $shippinglog_array["notesforlogisticinusaoffice"] = array();
            $shippinglog_array["printpicklistfromwms"] = array();
            $shippinglog_array["openpickticketpdfbatchtoverifyweights"] = array();
            $shippinglog_array["printlabelsfromalpineups"] = array();
            $shippinglog_array["addtrackingincustomerportal"] = array();
            $shippinglog_array["sendinvoiceoncustomerportal"] = array();
            $shippinglog_array["issuedtoorderleadalma"] = array();
            $shippinglog_array["orderleadissuedbatchtowarehouse"] = array();
            $shippinglog_array["invoicedateinoms"] = array();
            $shippinglog_array["warehouseleadconfirmedpickticketsreviewed"] = array();
            $shippinglog_array["numberofinvoicesgenerated"] = array();
            $shippinglog_array["invoicedissuestoreporttousaoffice"] = array();
            $shippinglog_array["omsinvoicedupdatedwithfrieghtcostinsource"] = array();
            $shippinglog_array["createasnandinvoicedinlingo"] = array();
            $shippinglog_array["databatchis100invoiced"] = array();
            foreach($shippinglog_response as $shipping){
                $savebatchto = DateUtil::StringToDateByGivenFormat("Y-m-d",$shipping["savebatchto"]);
                if($savebatchto != false){
                    $shippinglog_array["savebatchto"][] = $savebatchto->format("m-d-Y");
                }else{
                    $shippinglog_array["savebatchto"][] = "";
                }
                $shippinglog_array["createshipmentsinlingo"][] = $shipping["createshipmentsinlingo"];
                $shippinglog_array["printlabelsfromcustomerportal"][] = $shipping["printlabelsfromcustomerportal"];
                $shippinglog_array["sendasnthroughlingo"][] = $shipping["sendasnthroughlingo"];
                $shippinglog_array["sendinvoicethroughlingo"][] = $shipping["sendinvoicethroughlingo"];
                
                $verifywithleadbatchandlabelsprintedname = DateUtil::StringToDateByGivenFormat("Y-m-d H:i:s",$shipping["verifywithleadbatchandlabelsprintedname"]);
                if($verifywithleadbatchandlabelsprintedname != false){
                    $shippinglog_array["verifywithleadbatchandlabelsprintedname"][] = $verifywithleadbatchandlabelsprintedname->format("m-d-Y H:i:s");
                }else{
                    $shippinglog_array["verifywithleadbatchchandlabelsprintedname"][] = "";
                }
                $shippinglog_array["notesforlogisticinusaoffice"][] = $shipping["notesforlogisticinusaoffice"];
                $shippinglog_array["printpicklistfromwms"][] = $shipping["printpicklistfromwms"];
                $shippinglog_array["openpickticketpdfbatchtoverifyweights"][] = $shipping["openpickticketpdfbatchtoverifyweights"];
                $shippinglog_array["printlabelsfromalpineups"][] = $shipping["printlabelsfromalpineups"];
                $shippinglog_array["addtrackingincustomerportal"][] = $shipping["addtrackingincustomerportal"];
                $shippinglog_array["sendinvoiceoncustomerportal"][] = $shipping["sendinvoiceoncustomerportal"];
                
                $issuedtoorderleadalma = DateUtil::StringToDateByGivenFormat("Y-m-d H:i:s",$shipping["issuedtoorderleadalma"]);
                if($issuedtoorderleadalma != false){
                    $shippinglog_array["issuedtoorderleadalma"][] = $issuedtoorderleadalma->format("m-d-Y H:i:s");
                }else{
                    $shippinglog_array["issuedtoorderleadalma"][] = "";
                }
                
                $orderleadissuedbatchtowarehouse = DateUtil::StringToDateByGivenFormat("Y-m-d H:i:s",$shipping["orderleadissuedbatchtowarehouse"]);
                if($orderleadissuedbatchtowarehouse != false){
                    $shippinglog_array["orderleadissuedbatchtowarehouse"][] = $orderleadissuedbatchtowarehouse->format("m-d-Y H:i:s");
                }else{
                    $shippinglog_array["orderleadissuedbatchtowarehouse"][] = "";
                }
                
                $invoicedateinoms = DateUtil::StringToDateByGivenFormat("Y-m-d",$shipping["invoicedateinoms"]);
                if($invoicedateinoms != false){
                    $shippinglog_array["invoicedateinoms"][] = $invoicedateinoms->format("m-d-Y");
                }else{
                    $shippinglog_array["invoicedateinoms"][] = "";
                }
                $shippinglog_array["warehouseleadconfirmedpickticketsreviewed"][] = $shipping["warehouseleadconfirmedpickticketsreviewed"];
                $shippinglog_array["numberofinvoicesgenerated"][] = $shipping["numberofinvoicesgenerated"];
                $shippinglog_array["invoicedissuestoreporttousaoffice"][] = $shipping["invoicedissuestoreporttousaoffice"];
                
                $omsinvoicedupdatedwithfrieghtcostinsource = DateUtil::StringToDateByGivenFormat("Y-m-d",$shipping["omsinvoicedupdatedwithfrieghtcostinsource"]);
                if($omsinvoicedupdatedwithfrieghtcostinsource != false){
                    $shippinglog_array["omsinvoicedupdatedwithfrieghtcostinsource"][] = $omsinvoicedupdatedwithfrieghtcostinsource->format("m-d-Y");
                }else{
                    $shippinglog_array["omsinvoicedupdatedwithfrieghtcostinsource"][] = "";
                }
                
                $createasnandinvoicedinlingo = DateUtil::StringToDateByGivenFormat("Y-m-d",$shipping["createasnandinvoicedinlingo"]);
                if($createasnandinvoicedinlingo != false){
                    $shippinglog_array["createasnandinvoicedinlingo"][] = $createasnandinvoicedinlingo->format("m-d-Y");
                }else{
                    $shippinglog_array["createasnandinvoicedinlingo"][] = "";
                }
                
                $datebatchis100invoiced = DateUtil::StringToDateByGivenFormat("Y-m-d",$shipping["datebatchis100invoiced"]);
                if($datebatchis100invoiced != false){
                    $shippinglog_array["datebatchis100invoiced"][] = $datebatchis100invoiced->format("m-d-Y");
                }else{
                    $shippinglog_array["datebatchis100invoiced"][] = "";
                }
            } 
        }
        return $shippinglog_array;
    }
    public function delete($seq){
        $condition = array();
        $condition["seq"] = $seq;
        try{
            self::$dataStore->deleteByAttribute($condition);
            return true;
        }catch(Exception $e){
            return false;
        }
    }
}