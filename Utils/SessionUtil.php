<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/UserType.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/PermissionUtil.php");
class SessionUtil{
    private static $LOGIN_MODE = "loginMode";
    private static $ADMIN_SEQ = "adminSeq";
    private static $ADMIN_NAME = "adminName";
    private static $ADMIN_USERNAME = "adminUserName";
    private static $ADMIN_LOGGED_IN = "adminLoggedIn";

    private static $USER_SEQ = "userSeq";
    private static $USER_USERNAME = "userUserName";
    private static $USER_LOGGED_IN = "userLoggedIn";
    private static $URL_PREV_PAGE = "";
    
	private static $USER_IMAGE = "userimage";
    private static $ROLE = "role";
    private static $ROLES = "roles";
    private static $DEPARTMENTS = "departments";
    private static $TEAM_USERS_SEQS ="teamuserseqs";
  
	private static $sessionUtil;	
	public static function getInstance(){
		if(!self::$sessionUtil){
			session_start();
		   	self::$sessionUtil = new SessionUtil();
			return self::$sessionUtil;
		}
		return self::$sessionUtil;
	}

    public function createAdminSession(Admin $admin){//Not used anymore
        $arr = new ArrayObject();
        $arr[0] = $admin->getSeq();
        $arr[1] = $admin->getName();
        $arr[2] = $admin->getUserName();
        $arr[3] = $admin->getEmail();
        $_SESSION[self::$ROLE] = "admin";
        $_SESSION[self::$ADMIN_LOGGED_IN] = $arr;
    }
    
    public function createUserSession(User $user, $userRoles,$departments){
    	$arr = new ArrayObject();
    	$arr[0] = $user->getSeq();
    	$arr[1] = $user->getFullName();
    	$arr[2] = $user->getEmail();
    	$arr[3] = $user->getQCCode();
    	$userType = $user->getUserType();
    	$arr[4] = $user->getUserTimeZone();
    	$_SESSION[self::$ROLE] = $userType;
    	$_SESSION[self::$ROLES] = $userRoles;
    	$_SESSION[self::$DEPARTMENTS] = $departments;
    	$_SESSION[self::$USER_LOGGED_IN] = $arr;
    	//$_SESSION[self::$URL_PREV_PAGE] = $_SERVER['REQUEST_URI'];
    	
    }
    
    public function setMyTeamMembers($teamusers){
        $_SESSION[self::$TEAM_USERS_SEQS] =  $teamusers;
    }

    public function refreshAdminSession(){
    	$adminSeq = self::getAdminLoggedInSeq();
    	if(!empty($adminSeq)){
    		$ADS = AdminDataStore::getInstance();
    		$admin = $ADS->findBySeq($adminSeq);
    		self::createAdminSession($admin);
    		return true;
    	}
    	return false;
    }
    public function getUserDepartments(){
    	if( array_key_exists(self::$USER_LOGGED_IN,$_SESSION)){
    		$arr = $_SESSION[self::$DEPARTMENTS];
    		return $arr;
    	}
    }
    
    public function getAdminLoggedInName(){
    	if( array_key_exists(self::$ADMIN_LOGGED_IN,$_SESSION)){
    	//if( $_SESSION[self::$ADMIN_LOGGED_IN] != null){
                $arr = $_SESSION[self::$ADMIN_LOGGED_IN];
                return $arr[1];
        }
    }
    
    public function getAdminLoggedInUserName(){
    	if( array_key_exists(self::$ADMIN_LOGGED_IN,$_SESSION)){
    	//if($_SESSION[self::$ADMIN_LOGGED_IN] != null){
    			$arr = $_SESSION[self::$ADMIN_LOGGED_IN];
    			return $arr[2];
    	}
    }
	
    public function getAdminLoggedInEmail(){
    	if( array_key_exists(self::$ADMIN_LOGGED_IN,$_SESSION)){
    	//if($_SESSION[self::$ADMIN_LOGGED_IN] != null){
    		$arr = $_SESSION[self::$ADMIN_LOGGED_IN];
    		return $arr[3];
    	}
    }
    
    public function getAdminLoggedInSeq(){
//     	if( array_key_exists(self::$ADMIN_LOGGED_IN,$_SESSION)){
//     	//if($_SESSION[self::$ADMIN_LOGGED_IN] != null){
// 	 			$arr = $_SESSION[self::$ADMIN_LOGGED_IN];
// 	    		return $arr[0];
// 	    }
	    if( array_key_exists(self::$USER_LOGGED_IN,$_SESSION)){
	    	//if($_SESSION[self::$ADMIN_LOGGED_IN] != null){
	    	$arr = $_SESSION[self::$USER_LOGGED_IN];
	    	return $arr[0];
	    }
    }
    
    public function getUserLoggedInName(){
    	if( array_key_exists(self::$USER_LOGGED_IN,$_SESSION)){
    	//if( $_SESSION[self::$USER_LOGGED_IN] != null){
    		$arr = $_SESSION[self::$USER_LOGGED_IN];
    		return $arr[1];
    	}
    }
    
    public function getUserLoggedInUserName(){
    	if( array_key_exists(self::$USER_LOGGED_IN,$_SESSION)){
    	//if($_SESSION[self::$USER_LOGGED_IN] != null){
    		$arr = $_SESSION[self::$USER_LOGGED_IN];
    		return $arr[2];
    	}
    }
    
    
    public function getUserLoggedInQCCode(){
    	if( array_key_exists(self::$USER_LOGGED_IN,$_SESSION)){
    		//if($_SESSION[self::$USER_LOGGED_IN] != null){
    		$arr = $_SESSION[self::$USER_LOGGED_IN];
    		return $arr[3];
    	}
    }
    
    public function getUserLoggedInTimeZone(){
        if( array_key_exists(self::$USER_LOGGED_IN,$_SESSION)){
            //if($_SESSION[self::$USER_LOGGED_IN] != null){
            $arr = $_SESSION[self::$USER_LOGGED_IN];
            return $arr[4];
        }
    }
    
    public function getUserLoggedInSeq(){
    	if( array_key_exists(self::$USER_LOGGED_IN,$_SESSION)){
    	//if($_SESSION[self::$USER_LOGGED_IN] != null){
    		$arr = $_SESSION[self::$USER_LOGGED_IN];
    		return $arr[0];
    	}
    }
    public function getMyTeamMembers(){
        if( array_key_exists(self::$USER_LOGGED_IN,$_SESSION) && 
                array_key_exists(self::$TEAM_USERS_SEQS,$_SESSION)){  
           return  $_SESSION[self::$TEAM_USERS_SEQS];
        }
    }

	public function isSessionAdmin(){
		if($_SESSION[self::$USER_LOGGED_IN] != null &&
				UserType::getName(UserType::ADMIN) == $_SESSION[self::$ROLE]){
					return true;
		}
		return false;
	}
	
	public function isSessionQC(){
		if($_SESSION[self::$USER_LOGGED_IN] != null && 
				in_array(UserType::QC, $_SESSION[self::$ROLES])){
					return true;
		}
		return false;
	}
	
	public function getUserLoggedInPermissions(){
		if( array_key_exists(self::$USER_LOGGED_IN,$_SESSION)){
			return $_SESSION[self::$ROLES];
		}
		return array();
	}
	
	public function isSessionGeneralUser(){
		if($_SESSION[self::$USER_LOGGED_IN] != null && 
				UserType::getName(UserType::USER) == $_SESSION[self::$ROLE]){
					return true;
		}
		return false;
	}
	
	public function isSessionUser(){
		if( array_key_exists(self::$USER_LOGGED_IN,$_SESSION)){
			return true;
		}
		return false;
	}
	
	public function isSessionSupervisor(){
		if($_SESSION[self::$USER_LOGGED_IN] != null &&
				UserType::getName(UserType::SUPERVISOR) == $_SESSION[self::$ROLE]){
					return true;
		}
		return false;
	}
	
	public function sessionCheck(){
		//$bool = self::isSessionAdmin();
		$bool = self::isSessionUser();
		if($bool == false){
            $_SESSION['url'] = $_SERVER['REQUEST_URI'];
            $page= header("location: userlogin.php");  
		     
			die;
		}else{
			$boolAdmin = self::isSessionAdmin();
			if(!$boolAdmin){
				$page = basename ( $_SERVER ['PHP_SELF'] );
				if(!PermissionUtil::isAuthenticate($page)){
					header("location: logout.php");
					die;
				}
			}
		}
	}
	
	public function sessionCheckUser(){
		$bool = self::isSessionUser();
		if($bool == false){
			header("location: userlogin.php");
			die;
		}
	}
	
	
	
	public function createMobileUserSession($GET){
	    if(isset($GET["userSeq"])){
	        $userSeq = $GET["userSeq"];
	        $arr = new ArrayObject();
	        $arr[0] = $userSeq;
	        $_SESSION[self::$USER_LOGGED_IN] = $arr;
	        $_SESSION[self::$ROLE] = "admin";
	    }
	}
	
	
	
	public function destroySession(){
		$boolAdmin = self::isSessionAdmin();
		$_SESSION = array();
		session_destroy();
		if($boolAdmin == true){
			header("Location:userlogin.php");
			die;
		}else{
			header("Location:userlogin.php");
			die;
		}
	}

  

}
?>