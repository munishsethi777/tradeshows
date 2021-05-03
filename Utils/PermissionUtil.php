<?php
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/Permissions.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/DepartmentType.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
class PermissionUtil{
	private static $permissionUtil;
	private static $sessionUtil;
	private static $permissions;
	private static $departments;
	private static $DEPARTMENTS = "departments";
	private static $user;
	public static function getInstance(){
		if(empty(self::$permissionUtil)){
			self::$permissionUtil = new PermissionUtil();
			self::$sessionUtil = SessionUtil::getInstance();
			self::$permissions = self::$sessionUtil->getUserLoggedInPermissions(); 
			self::$departments = self::$sessionUtil->getUserDepartments();
			$userMgr = UserMgr::getInstance();
			self::$user = $userMgr->findBySeq(self::$sessionUtil->getUserLoggedInSeq());
		}
		return self::$permissionUtil;
	}
	public function userFreightForwarder(){//containers module
	    return self::$user->getFreightForwarder();
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
	
	public function hasContainerScheduleInformationPermission(){
		return in_array(Permissions::getName(Permissions::container_information),self::$permissions);
	}
	
	public function hasContainerDeliveryInformationPermission(){
		return in_array(Permissions::getName(Permissions::container_delivery_information),self::$permissions);
	}
	
	public function hasContainerOfficeInformationPermission(){
		return in_array(Permissions::getName(Permissions::container_office_information),self::$permissions);
	}
	
	public function hasWeeklyMailButtonPermission(){
	    return in_array(Permissions::getName(Permissions::weekly_mail_button),self::$permissions);
	}
	
	public function hasQCPlannerButtonPermission(){
	    return in_array(Permissions::getName(Permissions::qc_planner_button),self::$permissions);
	}
	public function hasQCReadonly(){
		return in_array(Permissions::getName(Permissions::qc_isreadonly),self::$permissions);
	}
	public function hasInstructionManualUsaTeamPermission(){
		return in_array(Permissions::getName(Permissions::instruction_manual_usa_team),self::$permissions);
	}
	public function hasInstructionManualChinaTeamPermission(){
		return in_array(Permissions::getName(Permissions::instruction_manual_china_team),self::$permissions);
	}
	public function hasInstructionManualTechnicalTeamPermission(){
		return in_array(Permissions::getName(Permissions::instruction_manual_technical_team),self::$permissions);
	}
	public function hasProjectTypePermission(){
		return in_array(Permissions::getName(Permissions::project_type_permission),self::$permissions);
	}


	
	public function hasQCDepartment(){
		return in_array(DepartmentType::QC_Schedules,self::$departments);
	}
	public function hasGraphicsDepartment(){
		return in_array(DepartmentType::Graphics_Logs,self::$departments);
	}
	public function hasContainerScheduleDepartment(){
		return in_array(DepartmentType::Container_Schedules,self::$departments);
	}
	public function hasManageCustomerDepartment(){
	    return in_array(DepartmentType::Manage_Customers,self::$departments);
	}
	public function hasInstructionManualLogsDepartment(){
	    return in_array(DepartmentType::Instruction_Manual,self::$departments);
	}
	public static function isAuthenticate($page){
			self::$sessionUtil = SessionUtil::getInstance();
			self::$departments = self::$sessionUtil->getUserDepartments();
			if($page == "adminManageQCSchedules.php" || 
					$page == "adminCreateQCSchedule.php"){
				$department = DepartmentType::QC_Schedules;
				if(in_array($department, self::$departments)){
					return true;
				}
			}else if($page == "adminManageGraphicLogs.php" || 
					$page == "adminCrateGraphicLog.php"){
				$department = DepartmentType::Graphics_Logs;
				if(in_array($department, self::$departments)){
					return true;
				}
			}else if($page == "createContainerSchedule.php" || 
					$page == "manageContainerSchedules.php"){
				$department = DepartmentType::Container_Schedules;
				if(in_array($department, self::$departments)){
					return true;
				}
			}else if($page == "createCustomer.php" ||
			    $page == "manageCustomers.php"){
			        $department = DepartmentType::Manage_Customers;
			        if(in_array($department, self::$departments)){
			            return true;
			        }
			}else if($page == "adminCreateUser.php" ||
			    $page == "adminManageUsers.php"){
			        $department = DepartmentType::Users;
			        if(in_array($department, self::$departments)){
			            return true;
			        }
			}else if($page == "manageEmailLogs.php"){
			        $department = DepartmentType::Email_Logs;
			        if(in_array($department, self::$departments)){
			            return true;
			        }
			}
			else{
				return true;
			}
		return false;
	}
	public function hasUserDepartment(){
	    return in_array(DepartmentType::Users,self::$departments);
	}
	public function hasRequestsDepartment(){
	    return in_array(DepartmentType::Requests_Module,self::$departments);
	}
}