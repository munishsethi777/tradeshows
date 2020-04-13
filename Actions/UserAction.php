<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/DepartmentMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/TeamMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/ForgotPasswordUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/User.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/UserDepartment.php");
require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");
$success = 1;
$call = "";
$redirect = "";
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
	    $message = StringConstants::USER_SAVED_SUCCESSFULLY;
		$user = new User();
		$user->createFromRequest($_REQUEST);
		$permissions = array(); 
		if(isset($_POST["permissions"]) && !empty($_POST["permissions"])){
		    $permissions = $_POST["permissions"];
		}
		
		$departments = array();
		if(isset($_POST["departments"]) && !empty($_POST["departments"])){
		    $departments = $_POST["departments"];
		}
		if(isset($_REQUEST["isenabled"])){
			$user->setIsEnabled(1);
		}else {
			$user->setIsEnabled(0);
		}
		if(isset($_REQUEST["isenabledmobile"])){
			$user->setIsEnabledMobile(1);
		}else {
			$user->setIsEnabledMobile(0);
		}
		if(isset($_REQUEST["issendnotifications"])){
			$user->setIsSendNotifications(1);
		}else {
			$user->setIsSendNotifications(0);
		}
		$seq = 0;
		if(isset($_REQUEST["seq"]) && !empty($_REQUEST["seq"])){
			$seq = $_REQUEST["seq"];
			$message = StringConstants::USER_UPDATE_SUCCCESSFULLY;
		}else{
			$user->setCreatedOn(new DateTime());
		}
		//if($user->getUserType() != UserType::QC){
			//$user->setQCCode(null);
		//}
		$user->setSeq($seq);
		$user->setLastModifiedOn(new DateTime());
		if(!in_array("qc",$permissions)){
			$user->setQCCode(null);
		}
		$id = $userMgr->saveUser($user);
		$departmentMgr->deleteUseDepartments($id);
		$userMgr->deleteUseRoles($id);
		foreach($permissions as $key => $value){
			$userRole = new UserRole();
			$userRole->setUserSeq($id);
			$userRole->setRole($value);
			$userRole->setCreatedOn(new DateTime());
			$userMgr->saveUserRole($userRole);
		}
		foreach($departments as $key => $value){
			$userDept = new UserDepartment();
			$userDept->setUserSeq($id);
			$userDept->setDepartmentSeq($value);
			$userDept->setLastModifiedOn(new DateTime());
			$userDept->setCreatedOn(new DateTime());
			$departmentMgr->saveUserDepartment($userDept);
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
		if($user->getIsEnabled() != true){
			$success = 0;
			$message = StringConstants::USER_DISABLED;
		}else{
			$userRoles = $userMgr->getUserRolesArr($user->getSeq());
			$departmentMgr = DepartmentMgr::getInstance();
			$departments = $departmentMgr->getUserAssignedDepartments($user->getSeq());
			$teamsMgr = TeamMgr::getInstance();
			$teamusers = $teamsMgr->getUserTeam($user->getSeq());
			$sessionUtil = SessionUtil::getInstance();
			$sessionUtil->createUserSession($user,$userRoles,$departments);
			$sessionUtil->setMyTeamMembers($teamusers);
			$response["user"] = $userMgr->toArray($user);
			$userMgr->updateLastLoggedInDate($user->getSeq());
			$message = StringConstants::LOGIN_SUCCESSFULLY;
			if(!empty($_SESSION['url'])){
			  $redirect = $_SESSION['url'];
			 }
			/*if($_SESSION['url'])
			{
			    header("location:". $_SESSION['url']);
			}*/
		}
		
	}else{
		$success = 0;
		$message = StringConstants::INCORRECT_USERNAME_PASSWORD;
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
			$message = StringConstants::PASSWORD_UPDATE_SUCCESSFULLY;
		}else{
		    $message = StringConstants::INCORRECT_CURRENT_PASSWORD;
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
		$message = StringConstants::USER_DELETE_SUCCESSFULLY;
	}catch(Exception $e){
		$success = 0;
		$message = $e->getMessage();
		//$message = ErrorUtil::checkReferenceError(LearningPlan::$className,$e);
	}
}
if($call == "forgotPassword"){
    try{
        $username = $_POST['username'];
        if(!empty($username)){
           $user = $userMgr->FindByUserName($username);
            if(!empty($user)){
                $isSent = ForgotPasswordUtil::sendForgotPasswordEmail($user);
                if(!$isSent){
                    throw new Exception(StringConstants::SERVER_ERROR);
                }
            }else{
                throw new Exception(StringConstants::USER_DOES_NOT_EXITS_WITH_THIS_USER_NAME);
            }
        }
        $message = StringConstants::FORGET_MESSAGE_SUCCESS;
    }catch (Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
if($call == "resetPassword"){
    try{
        $id = $_POST['id'];  
        $password = $_POST["newPassword"];
        $confirmPassword = $_POST["confirmPassword"];
        if($password != $confirmPassword){
            throw new Exception(StringConstants::NEW_PASSWORD_CONFIRM_PASSWORD_MATCH);
        }
        if(!empty($id)){
            $userName = SecurityUtil::Decode($id);
            $user = $userMgr->FindByUserName($userName);
            if(!empty($user)){
                $flag = $userMgr->resetPassword($password,$userName);
                if(!$flag){
                    throw new Exception(StringConstants::ERROR_RESET_PASSWORD_FAILED);
                }
            }else{
                throw new Exception(StringConstants::ERROR_INVALID_RESET_PASSWORD_URL);
            }
        }else{
            throw new Exception(StringConstants::ERROR_INVALID_RESET_PASSWORD_URL);
        }
        $message = StringConstants::PASSWORD_CHANGEED_SUCCESSFULLY;
    }catch (Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
if($call == "refreshSession"){
		$sessionUtil = SessionUtil::getInstance();
		$userSeq = $sessionUtil->getUserLoggedInSeq();
		$user = $userMgr->findBySeq($userSeq);
    	if(!empty($userSeq)){
    		$userRoles = $userMgr->getUserRolesArr($user->getSeq());
    		$departmentMgr = DepartmentMgr::getInstance();
    		$departments = $departmentMgr->getUserAssignedDepartments($user->getSeq());
    		$teamsMgr = TeamMgr::getInstance();
    		$teamusers = $teamsMgr->getUserTeam($user->getSeq());
    		$sessionUtil->createUserSession($user,$userRoles,$departments);
    		$sessionUtil->setMyTeamMembers($teamusers);
    		echo 1;
    		return;
    	}
    	echo 0;
    	return;
}

$response["success"] = $success;
$response["message"] = $message;
$response["url"] = $redirect;
echo json_encode($response);
return;