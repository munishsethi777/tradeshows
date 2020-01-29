<?php
require_once('../../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
$sessionUtil = SessionUtil::getInstance();
$userMgr = UserMgr::getInstance();
$call = "";
if(isset($_REQUEST["call"])){
    $call = $_REQUEST["call"];
}
$success = 1;
$message = "";
$response = new ArrayObject();
if($call != "login"){
    $sessionUtil->createMobileUserSession($_REQUEST);
    $userSeq = $sessionUtil->getUserLoggedInSeq();
    $message = $userMgr->isValidForMobile($userSeq);
    if(!empty($message)){
        $success = 0;
        $call = "";
    }
}
if($call == "login"){
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $password = urldecode($password);
    $gcmId = "";
    if(isset($_GET["gcmid"])){
        $gcmId = $_GET["gcmid"];
    }
    $deviceId = "";
    if(isset($_GET["deviceid"])){
        $deviceId = $_GET["deviceid"];
    }
    $userMgr = UserMgr::getInstance();
    try{
        $user = $userMgr->logInUserforMobile($username,$password);
        if($user != null){
            $user["lastloggedindate"] = new DateTime();
            if(isset($gcmId) && !empty($gcmId) && $gcmId != "null"){
                $user["gcmid"] = $gcmId;
            }
            if(!empty($deviceId)){
                $user["deviceid"] = $deviceId;
            }
            $userMgr->updateLastLoggedInAndGCM($user);
            $response["user"]  = $user;
        }else{
            $success = 0;
            $message = StringConstants::INCORRECT_USERNAME_PASSWORD;
        }
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}

if($call == "changePassword"){
    try{
        $userSeq = $_GET['userSeq'];
        $earlierPassword = $_GET["earlierPassword"];
        $newPassword = $_GET["newPassword"];
        $user = $userMgr->findBySeq($userSeq);
        if($user->getPassword() != $earlierPassword){
            throw new Exception(StringConstants::EARLIER_PASSWORD_DOES_NOT_MATCH);
        }
        if(!isset($newPassword) || empty($newPassword) || $newPassword==""){
            throw new Exception(StringConstants::NEW_PASSWORD_CONFIRM_PASSWORD_MATCH);
        }
        $userMgr->ChangePassword($newPassword);
        $message = StringConstants::NEW_PASSWORD_EMPTY;
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}

if($call == "forgotPassword"){
    try{
        $email = $_GET['email'];
        if(!empty($email)){
            $user = $userMgr->FindByUserName($email);
            if(!empty($user)){
                //$userMgr->sendPassword($user);
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
if($call == "getUserDetail"){
    try{
        $userSeq = $sessionUtil->getUserLoggedInSeq();
        $response["userDetail"] = $userMgr->findArrBySeq($userSeq);
     }catch (Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
if($call == "updateUserDetail"){
    try{
        $seq = $sessionUtil->getUserLoggedInSeq();
        $user = $userMgr->findBySeq($seq);
        $user = $user->from_array($_REQUEST);
        $userMgr->saveUser($user);
        $message = StringConstants::SETTINGS_UPDATE_SUCCCESSFULLY;
    }catch (Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header("Content-type: application/json");
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);
return;