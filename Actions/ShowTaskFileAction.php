<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/ShowTaskFileMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ShowTaskFile.php");
$success = 1;
$call = "";
$response = new ArrayObject();
if(isset($_GET["call"])){
	$call = $_GET["call"];
}else{
	$call = $_POST["call"];
	
}
if($call == "loginAdmin"){
	$username = $_GET["username"];
	$password = $_GET["password"];
	$adminMgr = AdminMgr::getInstance();
	$admin = $adminMgr->logInAdmin($username,$password);
	if(!empty($admin) && $admin->getPassword() == $password){
		$sessionUtil = SessionUtil::getInstance();
		$sessionUtil->createAdminSession($admin);
		$response["admin"] = $adminMgr->toArray($admin);
		$message = "Login successfully";
	}else{
		$success = 0;
		$message = "Incorrect Username or Password";
	}
}

$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);
return;