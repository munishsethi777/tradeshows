<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/BuyerMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
$success = 1;
$message ="";
$call = "";
$response = new ArrayObject();
$sessionUtil = SessionUtil::getInstance();
$customerMgr = CustomerMgr::getInstance();
if(isset($_GET["call"])){
	$call = $_GET["call"];
}else{
	$call = $_POST["call"];
}
$customerMgr = CustomerMgr::getInstance();
if($call == "saveCustomer"){
    try{
        $message = StringConstants::CUSTOMER_SAVED_SUCCESSFULLY;
        $customer = new Customer();
        $buyers = array();
        $salesReps = array();
        $internalSupports = array();
        try{
            for($i = 0;$i< count($_REQUEST["buyer_firstname"]);$i++){
                if(empty($_REQUEST["buyer_firstname"][$i]) && empty($_REQUEST["buyer_lastname"][$i]) 
                    && empty($_REQUEST["buyer_emailid"][$i]) && empty($_REQUEST["buyer_phone"][$i])
                    && empty($_REQUEST["buyer_phoneext"][$i]) && empty($_REQUEST["buyer_cellphone"][$i])
                    && empty($_REQUEST["buyer_skypePersonId"][$i]) && empty($_REQUEST["buyer_category"][$i])
                    && empty($_REQUEST["buyer_position"][$i])
                    ){
                        // Do nothing if all fields are empty
                }else{
                    $arr = array();
                    $arr["firstname"] = $_REQUEST["buyer_firstname"][$i];
                    $arr["lastname"] = $_REQUEST["buyer_lastname"][$i];
                    $arr["emailid"] = $_REQUEST["buyer_emailid"][$i];
                    $arr["phone"] = $_REQUEST["buyer_phone"][$i];
                    $arr["phoneext"] = $_REQUEST["buyer_phoneext"][$i];
                    $arr["cellphone"] = $_REQUEST["buyer_cellphone"][$i];
                    // $arr["skypepersonid"] = $_REQUEST["buyer_skypePersonId"][$i];
                    $arr["position"] = $_REQUEST["buyer_position"][$i];
                    $arr["category"] = $_REQUEST["buyer_category"][$i];
                    $arr["notes"] = $_REQUEST["buyer_notes"][$i];
                    $buyers[] = $arr;
                }
            }
        }catch(Exception $e){}
        if(isset($_REQUEST["salesRep_firstname"])){
            for($i = 0;$i<count($_REQUEST["salesRep_firstname"]);$i++){
                if(empty($_REQUEST["salesRep_firstname"][$i]) && empty($_REQUEST["salesRep_lastname"][$i]) 
                    && empty($_REQUEST["salesRep_emailid"][$i]) && empty($_REQUEST["salesRep_phone"][$i])
                    && empty($_REQUEST["salesRep_phoneext"][$i]) && empty($_REQUEST["salesRep_cellphone"][$i])
                    && empty($_REQUEST["salesRep_skypePersonId"][$i]) && empty($_REQUEST["salesRep_category"][$i])
                    && empty($_REQUEST["salesRep_position"][$i])
                    ){ 
                        // Do nothing if all fields are empty
                }else{
                    $arr = array();
                    $arr["firstname"] = $_REQUEST["salesRep_firstname"][$i];
                    $arr["lastname"] = $_REQUEST["salesRep_lastname"][$i];
                    $arr["emailid"] = $_REQUEST["salesRep_emailid"][$i];
                    $arr["phone"] = $_REQUEST["salesRep_phone"][$i];
                    $arr["phoneext"] = $_REQUEST["salesRep_phoneext"][$i];
                    $arr["cellphone"] = $_REQUEST["salesRep_cellphone"][$i];
                    // $arr["responsiblity"] = $_REQUEST["salesRep_responsiblity"][$i];
                    // $arr["skypepersonid"] = $_REQUEST["salesRep_skypePersonId"][$i];
                    $arr["position"] = $_REQUEST["salesRep_position"][$i];
                    $arr["category"] = $_REQUEST["salesRep_category"][$i];
                    $arr["notes"] = $_REQUEST["salesRep_notes"][$i];
                    $salesReps[] = $arr;
                }
            }
        }
        if(isset($_REQUEST["internalSupport_firstname"])){
            for($i = 0;$i < count($_REQUEST["internalSupport_firstname"]);$i++){
                if(empty($_REQUEST["internalSupport_firstname"][$i]) && empty($_REQUEST["internalSupport_lastname"][$i]) 
                    && empty($_REQUEST["internalSupport_emailid"][$i]) && empty($_REQUEST["internalSupport_phone"][$i])
                    && empty($_REQUEST["internalSupport_phoneext"][$i]) && empty($_REQUEST["internalSupport_cellphone"][$i])
                    && empty($_REQUEST["internalSupport_skypePersonId"][$i]) && empty($_REQUEST["internalSupport_category"][$i])
                    && empty($_REQUEST["internalSupport_position"][$i])
                    ){
                        // Do nothing if all fields are empty
                }else{
                    $arr = array();
                    $arr["firstname"] = $_REQUEST["internalSupport_firstname"][$i];
                    $arr["lastname"] = $_REQUEST["internalSupport_lastname"][$i];
                    $arr["emailid"] = $_REQUEST["internalSupport_emailid"][$i];
                    $arr["phone"] = $_REQUEST["internalSupport_phone"][$i];
                    $arr["phoneext"] = $_REQUEST["internalSupport_phoneext"][$i];
                    $arr["cellphone"] = $_REQUEST["internalSupport_cellphone"][$i];
                    $arr["skypepersonid"] = $_REQUEST["internalSupport_skypePersonId"][$i];
                    $arr["position"] = $_REQUEST["internalSupport_position"][$i];
                    $arr["category"] = $_REQUEST["internalSupport_category"][$i];
                    $arr["notes"] = $_REQUEST["internalSupport_notes"][$i];
                    $internalSupports[] = $arr;
                }
            }
        }
        $customer->from_array($_REQUEST);
        $seq = $_REQUEST['seq'];
        if(isset($_REQUEST["fullNameSelect"])){
            $existingCustomer = $customerMgr->findByCustomerSeq($_REQUEST["fullNameSelect"]);
            $customer->setFullName($existingCustomer->getFullName());
        }
        $isStore = 0;
        if(isset($_REQUEST["isstore"])){
            $isStore = 1;
        }
        //$customer->setFreightForwarderEmail($_REQUEST['freightforwarderemail']);
        //$customer->setFreightForwarderName($_REQUEST['freightforwardername']);
        $customer->setCustomerType($_REQUEST["customertype"]);
        $customer->setInsideAccountManager($_REQUEST["insideaccountmanager"]);
        $customer->setSalesAdminLead($_REQUEST["salesadminlead"]);
        $customer->setChainStoreSalesAdmin($_REQUEST["chainstoresalesadmin"]);
        $customer->setIsStore($isStore);
        $customer->setCreatedby($sessionUtil->getUserLoggedInSeq());
        $customer->setCreatedon(new DateTime());
        $customer->setLastmodifiedon(new DateTime());
        $customer->setIsQuestionnaireRequired(isset($_REQUEST['isquestionnairerequired']) ? 1 : 0);
        if($seq > 0){
            $message = StringConstants::CUSTOMER_UPDATE_SUCCESSFULLY;
        }
        $seq = $customerMgr->saveCustomerObject($customer);
        $buyerObjs = array();
        foreach($buyers as $buyer){
            $buyerObj = new Buyer();
            $buyerObj->setFirstName($buyer["firstname"]);
            $buyerObj->setLastName($buyer["lastname"]);
            $buyerObj->setEmail($buyer["emailid"]);
            $buyerObj->setOfficePhone($buyer["phone"]);
            $buyerObj->setOfficePhoneExt($buyer["phoneext"]);
            $buyerObj->setCellPhone($buyer["cellphone"]);
            $buyerObj->setNotes($buyer["notes"]);
            // $buyerObj->setSkypeId($buyer["skypepersonid"]);
            $buyerObj->setPosition($buyer["position"]);
            $buyerObj->setCategory($buyer["category"]);
            $buyerObj->setCreatedon(new DateTime());
            $buyerObj->setLastmodifiedon(new DateTime());
            $buyerObj->setCustomerSeq($seq);
            $buyerObj->setBuyerType("buyer");
            $buyerObj->setCreatedby($sessionUtil->getUserLoggedInSeq());
            $buyerObjs[] = $buyerObj;
        }
        foreach($salesReps as $salesRep){
            if(!($salesRep["firstname"] == "" && $salesRep["lastname"] == "" && $salesRep["emailid"] == "" && $salesRep["phone"] == "" && $salesRep["cellphone"] == "" && $salesRep["notes"] == "")){
                $buyerObj = new Buyer();
                $buyerObj->setFirstName($salesRep["firstname"]);
                $buyerObj->setLastName($salesRep["lastname"]);
                $buyerObj->setEmail($salesRep["emailid"]);
                $buyerObj->setOfficePhone($salesRep["phone"]);
                $buyerObj->setOfficePhoneExt($salesRep["phoneext"]);
                $buyerObj->setCellPhone($salesRep["cellphone"]);
                // $buyerObj->setSkypeId($salesRep["skypepersonid"]);
                $buyerObj->setPosition($salesRep["position"]);
                $buyerObj->setCategory($salesRep["category"]);
                $buyerObj->setNotes($salesRep["notes"]);
                // $buyerObj->setResponsibility($salesRep["responsiblity"]);
                $buyerObj->setCreatedon(new DateTime());
                $buyerObj->setLastmodifiedon(new DateTime());
                $buyerObj->setCustomerSeq($seq);
                $buyerObj->setBuyerType("salesrep");
                $buyerObj->setCreatedby($sessionUtil->getUserLoggedInSeq());
                $buyerObjs[] = $buyerObj;
            }
        }
        foreach($internalSupports as $internalSupport){
            $buyerObj = new Buyer();
            $buyerObj->setFirstName($internalSupport["firstname"]);
            $buyerObj->setLastName($internalSupport["lastname"]);
            $buyerObj->setEmail($internalSupport["emailid"]);
            $buyerObj->setOfficePhone($internalSupport["phone"]);
            $buyerObj->setOfficePhoneExt($internalSupport["phoneext"]);
            $buyerObj->setCellPhone($internalSupport["cellphone"]);
            // $buyerObj->setSkypeId($internalSupport["skypepersonid"]);
            $buyerObj->setPosition($internalSupport["position"]);
            $buyerObj->setCategory($internalSupport["category"]);
            $buyerObj->setNotes($internalSupport["notes"]);
            $buyerObj->setCreatedby($sessionUtil->getUserLoggedInSeq());
            $buyerObj->setCreatedon(new DateTime());
            $buyerObj->setLastmodifiedon(new DateTime());
            $buyerObj->setCustomerSeq($seq);
            $buyerObj->setBuyerType("internalSupport");
            $buyerObjs[] = $buyerObj;
        }
        $buyerMgr = BuyerMgr::getInstance();
        $buyerMgr->deleteByCustomerSeq($seq);
        foreach($buyerObjs as $buyerObj){
            $buyerMgr->saveBuyer($buyerObj);
        }
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
if($call == "importCustomers"){
	try{
		$isUpdate = false;
		$updateIds = null;
		if(isset($_POST["isupdate"]) && !empty($_POST["isupdate"])){
			$isUpdate = true;
			$updateIds = $_POST["updateIds"];
			$updateIds = explode(",",$updateIds);
		}
		if(isset($_FILES["file"])){
			$response = $customerMgr->importCustomers($_FILES["file"],$isUpdate,$updateIds);
			echo json_encode($response);
			return;
		}
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}

if($call == "getAllCustomers"){
	$customerJson = $customerMgr->getCustomersForGrid();
	echo json_encode($customerJson);
	return;
}
if($call == "export"){
	try{
        $queryString = "";
        if(isset($_GET["queryString"])){
            $queryString = $_GET["queryString"];
        }
	    $response = $customerMgr->exportCustomers($queryString);
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "getCustomerDetails"){
	try{
		$customer = $customerMgr->getCustomerArrayBySeq($_GET["seq"]);
		$response["customer"] = $customer;
		$buyerMgr = BuyerMgr::getInstance();
		$buyers = $buyerMgr->findArrByCustomerSeq($_GET["seq"]);
		$response["buyers"] = $buyers;
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}


if($call == "getCustomerIdBySeq"){
    try{
        $customerId = $customerMgr->getCustomerIdBySeq($_GET["seq"]);
        $response["customerid"] = $customerId;
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}

if($call == "getCustomerBuyers"){
    try{
        $customer = $customerMgr->getCustomerBuyers($_GET["id"]);
        $response["buyers"] = $customer;
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
if($call == "getBuyerCategories"){
    try{
        $ddhtml = $customerMgr->getCustomerBuyerCategories($_GET["selected"]);
        $response["categoryDD"] = $ddhtml;
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
if($call == "getSellerResponsibilitiesType"){
    try{
        $ddhtml = $customerMgr->getCustomerSellerResponsibilitiesType($_GET["selected"]);
        $response["responsibilityDD"] = $ddhtml;
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
if($call == "searchCustomers"){
	$searchString = $_GET["q"];
	$customers  = $customerMgr->searchCustomers($searchString);
	$response['results'] = array();
	foreach($customers as $customer){
		$json = array();
		$json['text'] = $customer['customername'];
		$json['id'] = $customer['customername'];
		array_push($response['results'],$json);
	}
	echo json_encode($response);
	return;
}

if($call == "searchCustomer"){
    $searchString = $_GET["q"];
    $customers  = $customerMgr->searchCustomer($searchString);
    $response['results'] = array();
    foreach($customers as $customer){
        $json = array();
        $json['text'] = $customer['fullname'];
        $json['id'] = $customer['seq'];
        array_push($response['results'],$json);
    }
    echo json_encode($response);
    return;
}

if($call == "deleteCustomers"){
    $ids = $_GET["ids"];
    try{
        $customerMgr->deleteByCustomerSeq($ids);
        $message = StringConstants::CUSTOMERS_DELETE_SUCCESSFULLY;
    }catch(Exception $e){
        $success = 0;
        $message = $e->getMessage();
    }
}
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);