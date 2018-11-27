<?php 

$isDashboard="";
$isTradeShows="";
$isChangePassword="";

$parts = Explode('/', $_SERVER["PHP_SELF"]);
$file =  $parts[count($parts) - 1];


//echo  $file;
if($file == "dashboard.php"){
	$isDashboard = "active";
}elseif($file=="adminShowList.php" || $file=="adminCreateShow.php"){
	$isTradeShows = "active";
}elseif($file=="adminChangePassword.php"){
	$isChangePassword = "active";
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
                <li class="<?php echo "inactive";?>">
                    <a href="#"><i class="fa fa-cube"></i> 
                    	<span class="nav-label ">Task Categories</span>  
                    </a>
                </li>
                <li class="<?php echo "inactive";?>">
                    <a href="#"><i class="fa fa-life-ring"></i> 
                    	<span class="nav-label">Tasks</span>  
                    </a>
                </li>
                <li class="<?php echo $isTradeShows;?>">
                    <a href="adminShowList.php"><i class="fa fa-globe"></i> 
                    	<span class="nav-label">TradeShows</span>  
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
