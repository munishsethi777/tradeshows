<?php 
$session = SessionUtil::getInstance();
$userNameLoggedIn = $session->getUserLoggedInName();

$isDashboard="";
$isUpcomingTasks="";
$isChangePassword="";


$parts = Explode('/', $_SERVER["PHP_SELF"]);
$file =  $parts[count($parts) - 1];


//echo  $file;
if($file == "userDashboard.php"){
	$isDashboard = "active";
}elseif($file == "userUpcomingShows.php"){
	$isUpcomingTasks = "active";
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
                    <a href="userDashboard.php"><i class="fa fa-tachometer"></i> 
                    	<span class="nav-label ">Dashboard</span>  
                    </a>
                </li>
                <li class="<?php echo $isUpcomingTasks;?>">
                    <a href="userUpcomingShows.php"><i class="fa fa-life-ring"></i> 
                    	<span class="nav-label ">Upcoming Tasks</span>  
                    </a>
                </li>
                <li class="<?php echo $isChangePassword;?>">
                    <a href="#"><i class="fa fa-clock-o"></i> 
                    	<span class="nav-label">Historical Tasks</span>  
                    </a>
                </li>
                <li class="<?php echo $isChangePassword;?>">
                    <a href="userPublicRepository.php"><i class="fa fa-clock-o"></i> 
                    	<span class="nav-label">Public Repository</span>  
                    </a>
                </li>
                <li class="<?php echo $isChangePassword;?>">
                    <a href="#"><i class="fa fa-key"></i> 
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
