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
							<?php if($isSessionAdmin || $permissionUtil->hasInstructionManualLogsDepartment()){?>
								<div class="col-lg-3">
									<div class="widget bg-success text-center  p-h-xl">
										<div class="row">
											<a href="adminManageInstructionManualLogs.php">
											<h1 class="m-t-xs font-bold"><i class="fa fa-wrench"></i></h1>
											<span>Instruction Manuals</span></a>
										</div>
									</div>
								</div>
							<?php }?>
							<?php if($isSessionAdmin || $permissionUtil->hasUserDepartment()){?>
								<div class="col-lg-3">
									<div class="widget text-center p-h-xl" style="background-color: dimgray;">
										<div class="row">
											<a href="adminManageUsers.php">
											<h1 class="m-t-xs font-bold"><i class="fa fa-user" aria-hidden="true"></i></h1>
											<span>User Management</span></a>
										</div>
									</div>
								</div>
							<?php }?>
		                    <?php if(empty( 
		                        ($isSessionAdmin || $permissionUtil->hasQCDepartment()) || 
		                        ($isSessionAdmin || $permissionUtil->hasGraphicsDepartment()) || 
		                        ($isSessionAdmin || $permissionUtil->hasContainerScheduleDepartment()) || 
		                        ($isSessionAdmin || $permissionUtil->hasManageCustomerDepartment())
		                        
		                        ))
		                     {
		                         echo "<center> <b>". StringConstants::PERMISSION_AllOW . "</b> </center>";
		                         echo '<a href="logout.php" class="clsLogout">Logout</a>';
		                     }?>
	                    </div>
            		</div>
	                <style>
						.requestLogCommentsAvatar{
							height: 40px; width: 40px; border-radius: 50%;
							align-items: center; display: flex; justify-content: center; 
							font-size: 16px; color:white;padding-top:10px;
							float:left;margin-right:10px;background-color:#72c8e7;
						}
					</style>
	                <div class="feed-activity-list">
                        <div class="feed-element">
                            <div class="requestLogCommentsAvatar" style="background-color:#72c8e7;">
								<p>MS</p>
							</div>  
							<div class="media-body ">
                                <small class="float-right">5m ago</small>
                                <strong>Monica Smith</strong> posted a comment. <br>
                                <small class="text-muted">Today 5:60 pm - 12.06.2014</small>
								<p class="m-t-xs">We need to hurry up the proceedins as we can not wait for more the shipments.</p>
                            </div>
                        </div>

					</div>
	                
	                <h2>Log History</h2>

					<div class="feed-activity-list">
					<div class="feed-element">
                            <div class="requestLogCommentsAvatar">
								<p>MS</p>
							</div>  
							<div class="media-body ">
                                <small class="float-right">5m ago</small>
                                <strong>Munish Sethi</strong> created the <b>Request</b> <br>
                                <small class="text-muted">Today 5:60 pm - 12.06.2014</small>
                            </div>
                        </div>
                        <div class="feed-element">
                            <div class="requestLogCommentsAvatar">
								<p>MS</p>
							</div>  
							<div class="media-body ">
                                <small class="float-right">5m ago</small>
                                <strong>Mukesh Sharma</strong> changed the <b>Status</b> <br>
                                <small class="text-muted">Today 5:60 pm - 12.06.2014</small>
								<p class="m-t-sm">
									<span class="label label-default">Not Started</span>
									<i class="fa fa-arrow-right text-default"></i>
									<span class="label label-primary">Started with Less Specifications</span>
								</p>
                            </div>
                        </div>
						<div class="feed-element">
                            <div class="requestLogCommentsAvatar">
								<p>MS</p>
							</div>  
							<div class="media-body ">
                                <small class="float-right">5m ago</small>
                                <strong>Mukesh Sharma</strong> changed the <b>Image Size</b> <br>
                                <small class="text-muted">Today 5:60 pm - 12.06.2014</small>
								<p class="m-t-sm">
									<span class="label">23 x 4 inches</span>
									<i class="fa fa-arrow-right text-default"></i>
									<span class="label">24 x 5 inches</span>
								</p>
                            </div>
                        </div>
						<div class="feed-element">
                            <div class="requestLogCommentsAvatar">
								<p>MS</p>
							</div>  
							<div class="media-body ">
                                <small class="float-right">5m ago</small>
                                <strong>Mukesh Sharma</strong> changed the <b>Assigned To</b> <br>
                                <small class="text-muted">Today 5:60 pm - 12.06.2014</small>
								<p class="m-t-sm">
									<span class="label">n.a</span>
									<i class="fa fa-arrow-right text-default"></i>
									<span class="label">Munish Sethi</span>
								</p>
                            </div>
                        </div>
						<div class="feed-element">
                            <div class="requestLogCommentsAvatar">
								<p>MS</p>
							</div>  
							<div class="media-body ">
                                <small class="float-right">5m ago</small>
                                <strong>Mukesh Sharma</strong> changed the <b>Assigned To</b> <br>
                                <small class="text-muted">Today 5:60 pm - 12.06.2014</small>
								<p class="m-t-sm">
									<span class="label">Munish Sethi</span>
									<i class="fa fa-arrow-right text-primary"></i>
									<span class="label">Mukesh Kumar</span>
								</p>
                            </div>
                        </div>
						<div class="feed-element">
                            <div class="requestLogCommentsAvatar">
								<p>MS</p>
							</div>  
							<div class="media-body ">
                                <small class="float-right">5m ago</small>
                                <strong>Mukesh Sharma</strong> changed the <b>Description Details</b> <br>
                                <small class="text-muted">Today 5:60 pm - 12.06.2014</small>
								<div class="row">
									<p class="m-t-sm col-lg-11">
										<span class="label1" style="width:45%;display:table-cell" >We need to hurry up the proceedins as we can not wait for more the shipments. for more the shipments. for more the shipments. for more the shipments.</span>
										<i class="fa fa-arrow-right text-default" style="width:5%;display:table-cell;text-align:center;vertical-align:middle"></i>
										<span class="label1" style="width:45%;display:table-cell">Customer is complaining about the quality of the product now. Pls do something about it</span>
									</p>
								</div>
                            </div>
                        </div>
						<div class="feed-element">
                            <div class="requestLogCommentsAvatar">
								<p>MS</p>
							</div>  
							<div class="media-body ">
                                <small class="float-right">5m ago</small>
                                <strong>Mukesh Sharma</strong> changed the <b>Some Other Details</b> <br>
                                <small class="text-muted">Today 5:60 pm - 12.06.2014</small>
								<div class="row">
									<p class="m-t-sm col-lg-11">
										<span class="label1" style="width:45%;display:table-cell" >Trying with smaller details Trying with smaller details Trying with smaller details Trying with smaller details Trying with smaller details Trying with smaller details Trying with smaller details Trying with smaller details Trying with smaller details Trying with smaller details Trying with smaller details Trying with smaller details Trying with smaller details</span>
										<i class="fa fa-arrow-right text-default" style="width:5%;display:table-cell;text-align:center;vertical-align:middle"></i>
										<span class="label1" style="width:45%;display:table-cell">Gone much smaller</span>
									</p>
								</div>
                            </div>
                        </div>
					</div>
	                
	                
	            </div>
        	</div>
       </div>
    </div>

   </body>
   
</html>
