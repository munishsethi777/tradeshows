<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/TradeShowOrderMgr.php");
$success = 1;
$message ="";
$call = "";
$response = new ArrayObject();
if(isset($_GET["call"])){
	$call = $_GET["call"];
}else{
	$call = $_POST["call"];
}
$tradeShowOrderMgr = TradeShowOrderMgr::getInstance();
if($call == "importOrders"){
	try{
		if(isset($_FILES["file"])){
			$response = $tradeShowOrderMgr->importOrders($_FILES["file"]);
			echo json_encode($response);
			return;
		}
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}

if($call == "getAllTradeShowOrders"){
	$orderJson = $tradeShowOrderMgr->getOrdersForGrid();
	echo json_encode($orderJson);
	return;
}