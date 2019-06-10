<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/User.php");
$success = 1;
$call = "";
$response = new ArrayObject();
$userMgr = UserMgr::getInstance();
if(isset($_GET["call"])){
	$call = $_GET["call"];
}else{
	$call = $_POST["call"];

}
if($call == "saveUser"){
	try{
		$message = "User saved successfully.";
		$user = new User();
		$user->createFromRequest($_REQUEST);
		if(isset($_REQUEST["isenabled"])){
			$user->setIsEnabled(1);
		}else {
			$user->setIsEnabled(0);
		}
		if(isset($_REQUEST["isqc"])){
			$user->setIsQC(1);
		}else {
			$user->setIsQC(0);
			$user->setQCCode(null);
		}
		$seq = 0;
		if(isset($_REQUEST["seq"]) && !empty($_REQUEST["seq"])){
			$seq = $_REQUEST["seq"];
			$message = "User updated successfully.";
		}
		$user->setSeq($seq);
		$id = $userMgr->saveUser($user);
		
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}

if($call == "loginUser"){
	$username = $_GET["username"];
	$password = $_GET["password"];
	
	$user = $userMgr->logInUser($username, $password);
	if(!empty($user) && $user->getPassword() == $password){
		$sessionUtil = SessionUtil::getInstance();
		$sessionUtil->createUserSession($user);
		$response["user"] = $userMgr->toArray($user);
		$message = "Login successfully";
	}else{
		$success = 0;
		$message = "Incorrect Username or Password";
	}
}
if($call == "changePassword"){
	$password = $_GET["newPassword"];
	$earlierPassword = $_GET["earlierPassword"];
	try{
		$userMgr = UserMgr::getInstance();
		$isPasswordExists = $userMgr->isPasswordExist($earlierPassword);
		if($isPasswordExists){
			$userMgr->ChangePassword($password);
			$message = "Password Updated Successfully";
		}else{
			$message = "Incorrect Current Password!";
			$success = 0;
		}

	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "getAllUsers"){
	$json = $userMgr->getUsersForGrid();
	echo json_encode($json);
	return;
}
if($call == "deleteUser"){
	$ids = $_GET["ids"];
	try{
		$flag = $userMgr->deleteBySeqs($ids);
		$message = "Users Deleted successfully";
	}catch(Exception $e){
		$success = 0;
		$message = $e->getMessage();
		//$message = ErrorUtil::checkReferenceError(LearningPlan::$className,$e);
	}
}
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);
return;