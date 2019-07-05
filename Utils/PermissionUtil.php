<?php
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/Permissions.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/DepartmentType.php");
class PermissionUtil{
	private static $permissionUtil;
	private static $sessionUtil;
	private static $permissions;
	private static $departments;
	private static $DEPARTMENTS = "departments";
	public static function getInstance(){
		if(empty(self::$permissionUtil)){
			self::$permissionUtil = new PermissionUtil();
			self::$sessionUtil = SessionUtil::getInstance();
			self::$permissions = self::$sessionUtil->getUserLoggedInPermissions(); 
		}
		return self::$permissionUtil;
	}
	
	public function hasChinaOfficePermission(){
		return in_array(Permissions::getName(Permissions::china_team),self::$permissions);
	}
	public function hasUsaOfficePermission(){
		return in_array(Permissions::getName(Permissions::usa_team),self::$permissions);
	}
	public function hasGraphicDesignerPermission(){
		return in_array(Permissions::getName(Permissions::graphic_designer),self::$permissions);
	}
	public function hasQCPermission(){
		return in_array(Permissions::getName(Permissions::qc),self::$permissions);
	}
	
	public static function isAuthenticate($page){
			$departments = $_SESSION[self::$DEPARTMENTS];
			if($page == "adminManageQCSchedules.php" || 
					$page == "adminCreateQCSchedule.php"){
				$department = DepartmentType::QC_Schedules;
				if(in_array($department, $departments)){
					return true;
				}
			}else if($page == "adminManageGraphicLogs.php" || 
					$page == "adminCrateGraphicLog.php"){
				$department = DepartmentType::Graphics_Logs;
				if(in_array($department, $departments)){
					return true;
				}
			}
			else{
				return true;
			}
		return false;
	}
	
}