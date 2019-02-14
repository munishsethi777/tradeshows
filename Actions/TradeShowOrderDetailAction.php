<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/TradeShowOrderDetailMgr.php");
$success = 1;
$message ="";
$call = "";
$response = new ArrayObject();
if(isset($_GET["call"])){
	$call = $_GET["call"];
}else{
	$call = $_POST["call"];
}
$tradeShowOrderDetailMgr = TradeShowOrderDetailMgr::getInstance();
if($call == "getDetailByOrderSeq"){
	$orderSeq = $_GET["orderseq"];
	$orderDetailJson = $tradeShowOrderDetailMgr->getOrderDetailForGrid($orderSeq);
	echo json_encode($orderDetailJson);
	return;
}