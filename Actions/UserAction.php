<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/User.php");
$success = 1;
$call = "";
$response = new ArrayObject();
if(isset($_GET["call"])){
	$call = $_GET["call"];
}else{
	$call = $_POST["call"];

}
if($call == "loginUser"){
	$username = $_GET["username"];
	$password = $_GET["password"];
	$userMgr = UserMgr::getInstance();
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
		$adminMgr = AdminMgr::getInstance();
		$isPasswordExists = $adminMgr->isPasswordExist($earlierPassword);
		if($isPasswordExists){
			$adminMgr->ChangePassword($password);
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
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);
return;