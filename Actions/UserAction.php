<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/DepartmentMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/User.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/UserDepartment.php");

$success = 1;
$call = "";
$response = new ArrayObject();
$userMgr = UserMgr::getInstance();
$departmentMgr = DepartmentMgr::getInstance();
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
		$seq = 0;
		if(isset($_REQUEST["seq"]) && !empty($_REQUEST["seq"])){
			$seq = $_REQUEST["seq"];
			$message = "User updated successfully.";
		}else{
			$user->setCreatedOn(new DateTime());
		}
		$user->setSeq($seq);
		$user->setLastModifiedOn(new DateTime());
		$id = $userMgr->saveUser($user);
		$departmentMgr->deleteUseDepartments($id);
		try{
			foreach($_POST as $key => $value){
				if(strpos($key, "dep") !== false){
					$dseq = substr($key,3);
					$userDept = new UserDepartment();
					$userDept->setUserSeq($id);
					$userDept->setDepartmentSeq($dseq);
					$userDept->setLastModifiedOn(new DateTime());
					$userDept->setCreatedOn(new DateTime());
					$departmentMgr->saveUserDepartment($userDept);
				}
			}
		}catch(Exception $e){
			return $e->getMessage();
		}
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