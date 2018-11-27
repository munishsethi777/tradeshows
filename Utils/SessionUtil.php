<?php
class SessionUtil{
    private static $LOGIN_MODE = "loginMode";
    private static $ADMIN_SEQ = "adminSeq";
    private static $ADMIN_NAME = "adminName";
    private static $ADMIN_USERNAME = "adminUserName";
    private static $ADMIN_LOGGED_IN = "adminLoggedIn";

    private static $USER_SEQ = "userSeq";
    private static $USER_USERNAME = "userUserName";
    private static $USER_LOGGED_IN = "userLoggedIn";

	private static $USER_IMAGE = "userimage";
    private static $ROLE = "role";
    
  
	private static $sessionUtil;	
	public static function getInstance(){
		if(!self::$sessionUtil){
			session_start();
		   	self::$sessionUtil = new SessionUtil();
			return self::$sessionUtil;
		}
		return self::$sessionUtil;
	}

    public function createAdminSession(Admin $admin){
        $arr = new ArrayObject();
        $arr[0] = $admin->getSeq();
        $arr[1] = $admin->getName();
        $arr[2] = $admin->getUserName();
        $_SESSION[self::$ADMIN_LOGGED_IN] = $arr;
    }
    
    public function createUserSession(User $user){
    	$arr = new ArrayObject();
    	$arr[0] = $user->getSeq();
    	$arr[1] = $user->getFullName();
    	$arr[2] = $user->getEmail();
    	$_SESSION[self::$USER_LOGGED_IN] = $arr;
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

    public function getAdminLoggedInName(){
      if( $_SESSION[self::$ADMIN_LOGGED_IN] != null){
                $arr = $_SESSION[self::$ADMIN_LOGGED_IN];
                return $arr[1];
        }
    }
    
    public function getAdminLoggedInUserName(){
    	if($_SESSION[self::$ADMIN_LOGGED_IN] != null){
    			$arr = $_SESSION[self::$ADMIN_LOGGED_IN];
    			return $arr[2];
    	}
    }

    
    public function getAdminLoggedInSeq(){
        if($_SESSION[self::$ADMIN_LOGGED_IN] != null){
	    				$arr = $_SESSION[self::$ADMIN_LOGGED_IN];
	    				return $arr[0];
	    }
    }
    
    public function getUserLoggedInName(){
    	if( $_SESSION[self::$USER_LOGGED_IN] != null){
    		$arr = $_SESSION[self::$USER_LOGGED_IN];
    		return $arr[1];
    	}
    }
    
    public function getUserLoggedInUserName(){
    	if($_SESSION[self::$USER_LOGGED_IN] != null){
    		$arr = $_SESSION[self::$USER_LOGGED_IN];
    		return $arr[2];
    	}
    }
    
    
    public function getUserLoggedInSeq(){
    	if($_SESSION[self::$USER_LOGGED_IN] != null){
    		$arr = $_SESSION[self::$USER_LOGGED_IN];
    		return $arr[0];
    	}
    }


	public function isSessionAdmin(){
		if( array_key_exists(self::$ADMIN_LOGGED_IN,$_SESSION)){
		//if(	$_SESSION[self::$ADMIN_LOGGED_IN] != null){
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
	
	public function sessionCheck(){
		$bool = self::isSessionAdmin();
		if($bool == false){
			header("location: adminlogin.php");
			die;
		}
	}
	
	public function sessionCheckUser(){
		$bool = self::isSessionUser();
		if($bool == false){
			header("location: userlogin.php");
			die;
		}
	}
	
	
	public function destroySession(){
		$boolAdmin = self::isSessionAdmin();
		$_SESSION = array();
		session_destroy();
		if($boolAdmin == true){
			header("Location:adminlogin.php");
			die;
		}else{
			header("Location:userlogin.php");
			die;
		}
	}

  

}
?>