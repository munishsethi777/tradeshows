<?php 
require_once($ConstantsArray['dbServerUrl'] ."Managers/DepartmentMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/DepartmentType.php");
$session = SessionUtil::getInstance();
$userLoggedInSeq = $session->getUserLoggedInSeq();
$userNameLoggedIn = $session->getUserLoggedInName();
$sessionUtil = SessionUtil::getInstance();
$isSessionSupervisor = $sessionUtil->isSessionSupervisor();
$isSessionAdmin = $sessionUtil->isSessionAdmin();
$isDashboard="";
$isUserDashboard="";
$isTradeShows="";
$isChangePassword="";
$isUserChangePassword="";
$isPublicRepository="";
$parts = Explode('/', $_SERVER["PHP_SELF"]);
$file =  $parts[count($parts) - 1];
$isTaskCategory = "";
$isMasterTask = "";
$isShowTasks = "";
$manageItems = "";
$manageItemSpecification = "";
$manageCustomers = "";
$adminManageOrders = "";
$manageQCSchedules = "";
$manageClassCodes = "";
$manageGraphicLogs = "";
$isManageUsers = "";
$manageContainerSchedules = "";
$manageEmailLogs = "";
$manageTeams ="";
//echo  $file;
if($file == "dashboard.php"){
	$isDashboard = "active";
}elseif($file=="adminShowList.php" || $file=="adminCreateShow.php"){
	$isTradeShows = "active";
}elseif($file=="adminChangePassword.php"){
	$isChangePassword = "active";
}elseif($file=="adminPublicRepository.php"){
	$isPublicRepository = "active";
}elseif($file=="adminShowTaskCategory.php" || $file == "adminCreateTaskCategory.php"){
	$isTaskCategory = "active";
}elseif($file=="adminShowTaskList.php"){
	$isMasterTask = "active";
}elseif($file=="adminShowTasks.php"){
	$isShowTasks = "active";
}elseif($file=="adminManageItems.php" || $file=="adminImportItems.php"){
	$manageItems = "active";
}elseif($file=="adminManageItemSpecifications.php" || $file=="adminImportItemSpecifications.php"){
	$manageItemSpecification = "active";
}elseif($file=="adminImportCustomers.php" || $file=="adminManageCustomers.php"){
	$manageCustomers = "active";
}elseif($file=="adminImportOrders.php" || $file=="adminManageOrders.php"){
	$adminManageOrders = "active";
}elseif($file=="adminManageQCSchedules.php" || $file== "adminCreateQCSchedule.php" || $file=="adminImportQCSchedules.php"){
	$manageQCSchedules = "active";
}elseif($file=="adminManageGraphicLogs.php" || $file== "adminCreateGraphicLog.php" || $file=="adminImportGraphicLogs.php"){
	$manageGraphicLogs = "active";
}elseif($file=="adminManageUsers.php" || $file== "adminCreateUser.php"){
	$isManageUsers = "active";
}if($file == "userDashboard.php"){
	$isUserDashboard = "active";
}elseif($file == "userChangePassword.php"){
	$isUserChangePassword = "active";
}elseif($file == "createClassCode.php" || $file== "manageClassCodes.php"){
	$manageClassCodes = "active";
}elseif($file == "createContainerSchedule.php" || $file== "manageContainerSchedules.php"){
	$manageContainerSchedules = "active";
}elseif($file == "manageEmailLogs.php"){
    $manageEmailLogs ="active";
}elseif($file == "manageTeams.php"){
    $manageTeams = "active";
}



?>

<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> 
                    	<a data-toggle="dropdown" class="dropdown-toggle" href="#"> 
	                    	<span class="clear"> 
	                    		<span class="block m-t-xs"> 
	                    			<strong class="font-bold">Alpine Tradeshows Management</strong>
	                    			<br><small>Welcome <?php echo $userNameLoggedIn?></small>
	                    		</span>
							</span>
						</a>
                    </div>
					
                </li>
                <?php if($isSessionAdmin){?>
                <li class="<?php echo $isDashboard;?>">
                    <a href="dashboard.php"><i class="fa fa-tachometer"></i> 
                    	<span class="nav-label ">Dashboard</span>  
                    </a>
                </li>
                <li class="<?php echo $manageItems;?>">
                    <a href="adminManageItems.php"><i class="fa fa-cubes"></i> 
                    	<span class="nav-label">Manage Items</span>  
                    </a>
                </li>
                <li class="<?php echo $manageItemSpecification;?>">
                    <a href="adminManageItemSpecifications.php"><i class="fa fa-database"></i> 
                    	<span class="nav-label">Manage Items Specs.</span>  
                    </a>
                </li>
                <li class="<?php echo $manageQCSchedules;?>">
                    <a href="adminManageQCSchedules.php"><i class="fa fa-flag"></i> 
                    	<span class="nav-label">QC Schedules</span>  
                    </a>
                </li>
                <li class="<?php echo $manageClassCodes;?>">
                    <a href="manageClassCodes.php"><i class="fa fa-bookmark"></i> 
                    	<span class="nav-label">Class Codes</span>  
                    </a>
                </li>
                <li class="<?php echo $manageGraphicLogs;?>">
                    <a href="adminManageGraphicLogs.php"><i class="fa fa-paint-brush"></i> 
                    	<span class="nav-label">Graphic Logs</span>  
                    </a>
                </li>
                <li class="<?php echo $manageContainerSchedules?>">
                    <a href="manageContainerSchedules.php"><i class="fa fa-ship"></i> 
                    	<span class="nav-label">Container Schedules</span>  
                    </a>
                </li>
                <li class="<?php echo $manageEmailLogs?>">
                    <a href="manageEmailLogs.php"><i class="fa fa-envelope"></i> 
                    	<span class="nav-label">Email Logs</span>  
                    </a>
                </li>
                
                <!-- 
                <li class="<?php echo $manageCustomers;?>">
                   <a href="adminManageCustomers.php"><i class="fa fa-group"></i> 
                	   	<span class="nav-label">Manage Customers</span>  
                   </a>
                </li>
                <li class="<?php echo $adminManageOrders;?>">
                   <a href="adminManageOrders.php"><i class="fa fa-truck"></i> 
                	   	<span class="nav-label">Manage Orders</span>  
                   </a>
                </li>
                
                <li class="<?php echo $isTaskCategory;?>">
                    <a href="adminShowTaskCategory.php"><i class="fa fa-code-fork"></i> 
                    	<span class="nav-label ">Task Categories</span>  
                    </a>
                </li>
                <li class="<?php echo $isMasterTask;?>">
                    <a href="adminShowTaskList.php"><i class="fa fa-tasks"></i> 
                    	<span class="nav-label">Master Tasks</span>  
                    </a>
                </li>
                 
                <li class="<?php echo $isTradeShows;?>">
                    <a href="adminShowList.php"><i class="fa fa-calendar-o"></i> 
                    	<span class="nav-label">TradeShows</span>  
                    </a>
                </li>
                <li class="<?php echo $isShowTasks;?>">
                    <a href="adminShowTasks.php"><i class="fa fa-calendar"></i> 
                    	<span class="nav-label">TradeShows Tasks</span>  
                    </a>
                </li> 
                <li class="<?php echo $isPublicRepository;?>">
                    <a href="adminPublicRepository.php"><i class="fa fa-globe"></i> 
                    	<span class="nav-label">Public Repository</span>  
                    </a>
                </li>-->
                <li class="<?php echo $isManageUsers;?>">
                    <a href="adminManageUsers.php"><i class="fa fa-group"></i> 
                    	<span class="nav-label">Manage Users</span>  
                    </a>
                </li>
                 <li class="<?php echo $manageTeams;?>">
                    <a href="manageTeams.php"><i class="fa fa-group"></i> 
                    	<span class="nav-label">Manage Teams</span>  
                    </a>
                </li>
                <li class="<?php echo $isChangePassword;?>">
                    <a href="adminChangePassword.php"><i class="fa fa-key"></i> 
                    	<span class="nav-label">Change Password</span>  
                    </a>
                </li>
                <?php }else{
                	$departmentMgr = DepartmentMgr::getInstance();
                	$departments = $departmentMgr->getUserAssignedDepartments($userLoggedInSeq);
                	?>
                	<li class="<?php echo $isUserDashboard?>">
	                    <a href="userDashboard.php"><i class="fa fa-tachometer"></i> 
	                    	<span class="nav-label ">Dashboard</span>  
	                    </a>
	                </li>
	                <?php if(in_array(DepartmentType::Item_Specs,$departments)){?>
	                	<li class="<?php echo $manageItemSpecification;?>">
		                    <a href="adminManageItemSpecifications.php"><i class="fa fa-database"></i> 
		                    	<span class="nav-label">Manage Items Specs.</span>  
		                    </a>
		                </li>
		            <?php }?>
		            <?php if($isSessionSupervisor){?>
		              <li class="<?php echo $manageClassCodes;?>">
		                    <a href="manageClassCodes.php"><i class="fa fa-flag"></i> 
		                    	<span class="nav-label">Class Codes</span>  
		                    </a>
                		</li>
                	<?php }?>
                	 <?php if($isSessionSupervisor){?>
		              <li class="<?php echo $manageEmailLogs;?>">
		                    <a href="manageEmailLogs.php"><i class="fa fa-envelope"></i> 
		                    	<span class="nav-label">Email Logs</span>  
		                    </a>
                		</li>
                	<?php }?>
                	
	                <?php if(in_array(DepartmentType::QC_Schedules,$departments)){?>
		                <li class="<?php echo $manageQCSchedules;?>">
		                    <a href="adminManageQCSchedules.php"><i class="fa fa-flag"></i> 
		                    	<span class="nav-label">QC Schedules</span>  
		                    </a>
		                </li>
	                <?php }?>
	                <?php if(in_array(DepartmentType::Graphics_Logs,$departments)){?>
		                <li class="<?php echo $manageGraphicLogs;?>">
		                    <a href="adminManageGraphicLogs.php"><i class="fa fa-paint-brush"></i> 
		                    	<span class="nav-label">Graphic Logs</span>  
		                    </a>
		                </li>
	                <?php }?>
	                 <?php if(in_array(DepartmentType::Container_Schedules,$departments)){?> 
		                <li class="<?php echo $manageContainerSchedules?>">
	                    	<a href="manageContainerSchedules.php"><i class="fa fa-ship"></i> 
	                    		<span class="nav-label">Container Schedules</span>  
	                   		</a>
	                	</li>
                	<?php }?>
	                <li class="<?php echo $isUserChangePassword?>">
	                    <a href="userChangePassword.php"><i class="fa fa-key"></i> 
	                    	<span class="nav-label">Change Password</span>  
	                    </a>
	                </li>
                <?php }?>
                <li>
                    <a href="logout.php"><i class="fa fa-sign-out"></i> 
                    	<span class="nav-label">Logout</span>  
                    </a>
                </li>
            </ul>

        </div>
    </nav>
