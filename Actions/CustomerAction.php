<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/BuyerMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/CustomerRepAllotment.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/CustomerRep.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerRepMgr.php");
$success = 1;
$message ="";
$call = "";
$response = new ArrayObject();
$sessionUtil = SessionUtil::getInstance();
$customerMgr = CustomerMgr::getInstance();
$customerRepMgr = CustomerRepMgr::getInstance();

if(isset($_GET["call"])){
	$call = $_GET["call"];
}else{
	$call = $_POST["call"];
}
$customerMgr = CustomerMgr::getInstance();
if($call == "saveCustomer"){
    try{
        $message = StringConstants::CUSTOMER_SAVED_SUCCESSFULLY;
        $db_New = MainDB::getInstance();
		$conn = $db_New->getConnection();
		$conn->beginTransaction();
        $customer = new Customer();
        $buyers = array();
        $salesReps = array();
        $internalSupports = array();
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
        try{
            $seq = $customerMgr->saveCustomer($conn,$customer);
            $customerRepMgr->deleteBuyerReps($seq,$conn);
            $customerMgr->deleteCustomerRepAllotmentByAttribute($seq,$conn);
        }catch(Exception $e){
			throw new Exception($e);
		}
        if(isset($_REQUEST['salesrep_name'])){
            for($i = 0; $i < count($_REQUEST['salesrep_name']); $i++){
                if(!empty($_REQUEST['salesrep_name'][$i])){
                    $customerRepAllotment = new CustomerRepAllotment();
                    $customerRepAllotment->setCustomerSeq($seq);
                    $customerRepAllotment->setCustomerRepSeq($_REQUEST['salesrep_seq'][$i]);
                    $customerRepAllotment->setNotes($_REQUEST['salesrep_notes'][$i]);
                    try{
                        $customerMgr->saveCustomerRepAllotment($customerRepAllotment,$conn);
                    }catch(Exception $e){
                        throw new Exception("Problem occurred while saving <b> Sales Rep - " . $_REQUEST['salesrep_text'][$i] . "</b>");
                    }
                }
            }
        }
        if(isset($_REQUEST['internalsupport_name'])){
            for($i = 0; $i < count($_REQUEST['internalsupport_name']); $i++){
                if(!empty($_REQUEST['internalsupport_name'][$i])){
                    $customerRepAllotment = new CustomerRepAllotment();
                    $customerRepAllotment->setCustomerSeq($seq);
                    $customerRepAllotment->setCustomerRepSeq($_REQUEST['internalsupport_seq'][$i]);
                    $customerRepAllotment->setNotes($_REQUEST['internalsupport_notes'][$i]);
                    try{
                        $customerMgr->saveCustomerRepAllotment($customerRepAllotment,$conn);
                    }catch(Exception $e){
                        throw new Exception("Problem occurred while saving <b> Internal Support - " . $_REQUEST['internalsupport_text'][$i] . "</b>");
                    }
                }
            }
        }
        if(isset($_REQUEST['buyer_fullname'])){
            for($i = 0; $i < count($_REQUEST['buyer_fullname']); $i++){
                if(!empty($_REQUEST['buyer_fullname'][$i])){
                    $customerRepArr = [];
                    $customerRepArr['fullname'] = $_REQUEST['buyer_fullname'][$i];
                    $customerRepArr['email'] = $_REQUEST['buyer_email'][$i];
                    $customerRepArr['ext'] = $_REQUEST['buyer_ext'][$i];
                    $customerRepArr['cellphone'] = $_REQUEST['buyer_cellphone'][$i];
                    $customerRepArr['position'] = $_REQUEST['buyer_position'][$i];
                    $customerRepArr['category'] = $_REQUEST['buyer_category'][$i];
                    $customerRepArr['notes'] = $_REQUEST['buyer_notes'][$i];
                    $customerRepArr['telephone'] = $_REQUEST['buyer_telephone'][$i];
                    $customerRepArr['customerreptype'] = 'buyer';
                    $customerRepArr['isreceivesmonthlysalesreport'] = "no";
                    try{
                        $customerRepSeq = $customerRepMgr->save($customerRepArr);
                        $customerRepAllotment = new CustomerRepAllotment();
                        $customerRepAllotment->setCustomerSeq($seq);
                        $customerRepAllotment->setCustomerRepSeq($customerRepSeq);
                        $customerRepAllotment->setNotes($_REQUEST['buyer_notes'][$i]);
                        $customerMgr->saveCustomerRepAllotment($customerRepAllotment,$conn);
                    }catch(Exception $e){
                        throw new Exception("Problem occurred while saving <b> Buyer - " . $_REQUEST['buyer_fullname'][$i] . "</b>");
                    }
                }
            }
        }
        $conn->commit();
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
        $conn->rollBack();
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
        $customerReps = $customerMgr->getCustomerRepAllotmentByCustomerSeq($_GET['seq']);
        $response["customerreps"] = $customerReps;
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
if($call =="searchCustomerRep"){
    $customerRepType = $_GET['customerRepType'];
    if($customerRepType == "salesrep"){
        $customerRepType = "salesrep,inside_account_manager";
    }
    $searchString = $_GET["q"];
    $customersReps  = $customerMgr->searchCustomerRep($searchString,$customerRepType);
    $response['results'] = array();
    foreach($customersReps as $customersRep){
        $customersRep['id'] = $customersRep['seq'];
        $customersRep['text'] = $customersRep['fullname'];
        $customersRep['isreceivesmonthlysalesreport'] = $customersRep['isreceivesmonthlysalesreport'] == 1 ? 'Yes' : 'No';
        array_push($response['results'],$customersRep);
    }
    echo json_encode($response);
    return;
}
if($call == "getCustomerRepAllotmentsByCustomerSeq"){
    try{
        $customerRepAllotments = $customerMgr->getCustomerRepAllotmentByCustomerSeq($_REQUEST['customerseq']);
        $response['data'] = $customerRepAllotments;
    }catch(Exception $e){
        $message = $e->getMessage();
        $success = 0;
    }
}
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);