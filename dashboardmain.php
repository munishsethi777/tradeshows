<?include("SessionCheck.php");
include("StringConstants.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/PermissionUtil.php");
$permissionUtil = PermissionUtil::getInstance();
$sessionUtil = SessionUtil::getInstance();
$isSessionAdmin = $sessionUtil->isSessionAdmin();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Dashboard</title>
    <?include "ScriptsInclude.php"?>
    <style type="text/css">
    	h1{font-size:38pt}
    	a{color:white}
    </style>
</head>
<body>
<div id="wrapper">
	<div id="page-wrapper" class="gray-bg" style="margin:0px !important">
		<div class="row border-bottom"></div>
        <div class="row m-t-xl">
			<div class="col-lg-8 col-lg-offset-2">
	        	<div class="ibox">
					
					<h2 class="text-center p-m">
						<img style="opacity:0.7" class="m-b-sm text-center" src="images/logo.png"><br>
						Home for Alpine Business Intelligence Portal
					</h2>
					
					<div class="ibox-content m-t-sm m-b-sm">
						<div class="row">
							<?php if($isSessionAdmin || $permissionUtil->hasQCDepartment()){?>
							<div class="col-lg-3">
		                        <div class="widget bg-danger text-center  p-h-xl">
		                        	<div class="row">
		                        		<a href="adminManageQCSchedules.php">
		                        		<h1 class="m-t-xs font-bold"><i class="fa fa-clock-o"></i></h1>
		                                <span>Schedule Management</span></a>
		                            </div>
								</div>
	                        </div>
							<?php }?>
							<?php if($isSessionAdmin || $permissionUtil->hasGraphicsDepartment()){?>
								<div class="col-lg-3">
			                        <div class="widget bg-warning text-center p-h-xl">
			                        	<div class="row">
			                        		<a href="adminManageGraphicLogs.php">
			                        		<h1 class="m-t-xs font-bold"><i class="fa fa-file-image-o"></i></h1>
			                                <span>Graphic Logs</span></a>
			                            </div>
									</div>
		                        </div>
	                        <?php }?>
	                        <?php if($isSessionAdmin || $permissionUtil->hasContainerScheduleDepartment()){?>
		                        <div class="col-lg-3">
			                        <div class="widget bg-info text-center  p-h-xl">
			                        	<div class="row">
			                        		<a href="manageContainerSchedules.php">
			                        		<h1 class="m-t-xs font-bold"><i class="fa fa-ship"></i></h1>
			                                <span>Container Scheduling</span></a>
			                            </div>
									</div>
		                        </div>
		                    <?php } ?>
		                     <?php if($isSessionAdmin || $permissionUtil->hasManageCustomerDepartment()){?>
    		                    <div class="col-lg-3">
    			                        <div class="widget bg-primary text-center  p-h-xl">
    			                        	<div class="row">
    			                        		<a href="manageCustomers.php">
    			                        		<h1 class="m-t-xs font-bold"><i class="fa fa-users"></i></h1>
    			                                <span>Customer Management</span></a>
    			                            </div>
    									</div>
    		                        </div>
		                        <?php }?>
		                    <?php if(empty( ($isSessionAdmin || $permissionUtil->hasQCDepartment()) || ($isSessionAdmin || $permissionUtil->hasGraphicsDepartment()) || ($isSessionAdmin || $permissionUtil->hasContainerScheduleDepartment())))
		                     {
		                         echo "<center> <b>". StringConstants::PERMISSION_AllOW . "</b> </center>";
		                         echo '<a href="logout.php" class="clsLogout">Logout</a>';
		                     }?>
	                    </div>
            		</div>
	                
	                
	            </div>
        	</div>
       </div>
    </div>

   </body>
   
</html>
