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
        $customer->from_array($_REQUEST);
        $seq = $_REQUEST['seq'];
        if(isset($_REQUEST['hasshipping'])){
            $customer->setHasShippingMark("1");
        }else{
            $customer->setHasShippingMark("0");
        }
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
        $customer->setIsStore($isStore);
        $customer->setCreatedby($sessionUtil->getUserLoggedInSeq());
        $customer->setCreatedon(new DateTime());
        $customer->setLastmodifiedon(new DateTime());
        if($seq > 0){
            $message = StringConstants::CUSTOMER_UPDATE_SUCCESSFULLY;
        }
        $customerMgr->saveCustomerObject($customer);
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
	    $queryString = $_GET["queryString"];
	    $response = $customerMgr->exportCustomers($queryString);
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "getCustomerDetails"){
	try{
		$customer = $customerMgr->findBySeq($_GET["seq"]);
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