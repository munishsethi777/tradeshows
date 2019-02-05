<?php 
$session = SessionUtil::getInstance();
$userNameLoggedIn = $session->getAdminLoggedInName();

$isDashboard="";
$isTradeShows="";
$isChangePassword="";
$isPublicRepository="";
$parts = Explode('/', $_SERVER["PHP_SELF"]);
$file =  $parts[count($parts) - 1];
$isTaskCategory = "";
$isMasterTask = "";
$isShowTasks = "";
$manageItems = "";
$manageCustomers = "";


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
}elseif($file=="adminImportItems.php"){
	$manageItems = "active";
}elseif($file=="adminImportCustomers.php"){
	$manageCustomers = "active";
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
                 <li class="<?php echo $isDashboard;?>">
                    <a href="dashboard.php"><i class="fa fa-tachometer"></i> 
                    	<span class="nav-label ">Dashboard</span>  
                    </a>
                </li>
                <li class="<?php echo $manageItems;?>">
                    <a href="adminImportItems.php"><i class="fa fa-globe"></i> 
                    	<span class="nav-label">Manage Items</span>  
                    </a>
                </li>
                <li class="<?php echo $manageCustomers;?>">
                   <a href="adminImportCustomers.php"><i class="fa fa-globe"></i> 
                	   	<span class="nav-label">Manage Customers</span>  
                   </a>
                </li>
                <li class="<?php echo $isTaskCategory;?>">
                    <a href="adminShowTaskCategory.php"><i class="fa fa-cube"></i> 
                    	<span class="nav-label ">Task Categories</span>  
                    </a>
                </li>
                <li class="<?php echo $isMasterTask;?>">
                    <a href="adminShowTaskList.php"><i class="fa fa-life-ring"></i> 
                    	<span class="nav-label">Master Tasks</span>  
                    </a>
                </li>
                 
                <li class="<?php echo $isTradeShows;?>">
                    <a href="adminShowList.php"><i class="fa fa-globe"></i> 
                    	<span class="nav-label">TradeShows</span>  
                    </a>
                </li>
                <li class="<?php echo $isShowTasks;?>">
                    <a href="adminShowTasks.php"><i class="fa fa-globe"></i> 
                    	<span class="nav-label">TradeShows Tasks</span>  
                    </a>
                </li>
                <li class="<?php echo $isPublicRepository;?>">
                    <a href="adminPublicRepository.php"><i class="fa fa-globe"></i> 
                    	<span class="nav-label">Public Repository</span>  
                    </a>
                </li>
                <li class="<?php echo $isChangePassword;?>">
                    <a href="adminChangePassword.php"><i class="fa fa-key"></i> 
                    	<span class="nav-label">Change Password</span>  
                    </a>
                </li>
                <li>
                    <a href="logout.php"><i class="fa fa-sign-out"></i> 
                    	<span class="nav-label">Logout</span>  
                    </a>
                </li>
            </ul>

        </div>
    </nav>
