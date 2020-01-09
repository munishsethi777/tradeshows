<?include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/GraphicsLog.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/GraphicLogMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/User.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Department.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/DepartmentMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/UserType.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/QCScheduleNotificationType.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/GraphicLogsNotificationType.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/ContainerScheduleNotificationType.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DropdownUtil.php");
$userTypes = UserType::getAll();
$departmentMgr = DepartmentMgr::getInstance();
$departments = $departmentMgr->getAll();
$user = new User();
$userMgr = UserMgr::getInstance();
$userSelected = "";
$supervisorSelected = "";
$qcChecked = "";
$classCodeChecked = "";
$chinaTeamChecked = "";
$usaTeamChecked = "";
$graphicDesignerChecked = "";
$containerInformationChecked = "";
$containerDeliveryChecked = "";
$containerOfficeChecked = "";
$qcChecked = "";
$weeklyMailButtonChecked = "";
$qcPlannerButtonChecked = "";
$qcApprovedRejectNotification = "";
$isManageCustomerChecked = "";
$graphicLog = new GraphicsLog(); 
$graphicLogMgr = GraphicLogMgr::getInstance();
$readOnlyPO = "";
$showQCDiv = "none";
$isEnabled = "";
$isSendNotifications = "";
$qcDepartmentChecked = "";
$containerDepartmentChecked = "";
$graphicDepartmentChecked  = "";
$customerDepartmentChecked = "";
$userDepartmentChecked = "";
$emailLogsChecked = "";
if(isset($_POST["id"])){
	$seq = $_POST["id"];
	$user = $userMgr->findBySeq($seq);
	if($user->getUserType() == UserType::SUPERVISOR){
		$supervisorSelected = "selected";
	}else{
		$userSelected = "selected";
	}
	if($user->getIsEnabled() == 1){
		$isEnabled = "checked";
	}
	if($user->getIsSendNotifications() == 1){
		$isSendNotifications = "checked";
	}
}
$userDepartments = $departmentMgr->getUserDepartments($user->getSeq());
$departmentSeqArr = array_map(create_function('$o', 'return $o->getDepartmentSeq();'), $userDepartments);
$userRoles = $userMgr->getUserRolesValuesArr($user->getSeq());
if(in_array(Permissions::china_team,$userRoles)){
	$chinaTeamChecked = "checked";
}if(in_array(Permissions::usa_team,$userRoles)){
	$usaTeamChecked = "checked";
}if(in_array(Permissions::graphic_designer,$userRoles)){
	$graphicDesignerChecked = "checked";
}if(in_array(Permissions::qc,$userRoles)){
	$qcChecked = "checked";
}if(in_array(Permissions::container_information,$userRoles)){
	$containerInformationChecked = "checked";
}if(in_array(Permissions::container_delivery_information,$userRoles)){
	$containerDeliveryChecked = "checked";
}if(in_array(Permissions::container_office_information,$userRoles)){
	$containerOfficeChecked = "checked";
}if(in_array(Permissions::class_code,$userRoles)){
	$classCodeChecked = "checked";
}if(in_array(Permissions::weekly_mail_button,$userRoles)){
    $weeklyMailButtonChecked = "checked";
}if(in_array(Permissions::qc_planner_button,$userRoles)){
    $qcPlannerButtonChecked  = "checked";
}if(in_array(Permissions::approved_reject_notification,$userRoles)){
    $qcApprovedRejectNotification  = "checked";
}
if(in_array(1,$departmentSeqArr)){
	$qcDepartmentChecked = "checked";
}if(in_array(2,$departmentSeqArr)){
	$graphicDepartmentChecked = "checked";
}if(in_array(4,$departmentSeqArr)){
	$containerDepartmentChecked = "checked";
}if(in_array(7,$departmentSeqArr)){
    $customerDepartmentChecked = "checked";
}if(in_array(5,$departmentSeqArr)){
    $userDepartmentChecked = "checked";
}if(in_array(8,$departmentSeqArr)){
    $emailLogsChecked = "checked";
}
/*echo $optiondata = array('<script type="text/javascript">
                     $(document).ready(function(){ 
	                 $("#timezone option").each(function(){
                      data = $(this).val();             
	                   });
                     });
                    </script>');

//$string_version = implode(',', $optiondata);
//echo $string_version;*/
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin | Create User</title>
<?include "ScriptsInclude.php"?>
<style type="text/css">
.panel-body{
	padding:15px !important;
}
.col-form-label{
	font-weight:400 !important;
}
.areaTitle{
	margin:0px 0px 0px 15px !important;
	color:#1ab394;
	font-size:15px;
}
.bg-white{
	background-color:rgb(252,252,252);
}
.bg-muted{
}
.outterDiv{
	border-bottom:1px silver dashed;
	padding:20px 10px;
}
.todo-list{
	font-size:12px !important;
}
.todo-list > li{
	padding:8px !important;
}
</style>
</head>
<body>
    <div id="wrapper">
    <?php include("adminmenuInclude.php")?>  
    <div id="page-wrapper" class="gray-bg">
	    <div class="row border-bottom">
	    	<div class="col-lg-12">
	         <div class="ibox">
	         	<div class="ibox-title">
                   	 <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
						<a class="navbar-minimalize minimalize-styl-2 btn btn-primary "
							href="#"><i class="fa fa-bars"></i> </a>
							<h5 class="pageTitle">Create/Edit User</h5>
					</nav>
                 </div>
                 <div class="ibox-content">
                 	<?include "progress.php"?>
                 	 <form id="createUserForm" method="post" action="Actions/UserAction.php" class="m-t-lg">
                     	<input type="hidden" id ="call" name="call"  value="saveUser"/>
                        <input type="hidden" id ="seq" name="seq"  value="<?php echo $user->getSeq()?>"/>
                        <div class="p-xs outterDiv">
                        	 <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Email Id:</label>
	                        	<div class="col-lg-4">
	                            	<input type="email" required  maxLength="250" value="<?php echo $user->getEmail()?>" name="email" class="form-control">
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Password:</label>
	                        	<div class="col-lg-4">
	                        		<input type="text" required maxLength="250" value="<?php echo $user->getPassword()?>" name="password" class="form-control">
	                            </div>
	                        </div>
	                        
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Full Name:</label>
	                        	<div class="col-lg-4">
	                            	<input type="text"  maxLength="250" value="<?php echo $user->getFullName()?>" name="fullname" class="form-control">
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Mobile:</label>
	                        	<div class="col-lg-4">
	                        		<input type="text" maxLength="250" value="<?php echo $user->getMobile()?>" name="mobile" class="form-control">
	                            </div>
	                       </div>
	                        
	                        <div class="form-group row i-checks">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Enabled :</label>
	                        	<div class="col-lg-4">
	                        		<input type="checkbox" <?php echo $isEnabled?> name="isenabled"/>
	                            </div>
	                            
	                            <label class="col-lg-2 col-form-label bg-formLabel">Send Notifications :</label>
	                        	<div class="col-lg-4">
	                        		<input type="checkbox" <?php echo $isSendNotifications?> name="issendnotifications"/>
	                            </div>
	                        </div>
	                        
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">User Type:</label>
	                        	<div class="col-lg-4">
	                        		<select name="usertype" class="form-control">
	                            		<option <?php echo $userSelected?> value="USER">User</option>
	                            		<option <?php echo $supervisorSelected?> value="SUPERVISOR">Supervisor</option>
	                            	</select>
	                            </div>
	                            
	                            <label class="col-lg-2 col-form-label bg-formLabel">Time Zone:</label>
	                        	<div class="col-lg-4">
	                        		<?php  
	                        		
	                        		$select = DropDownUtils::getTimezone("usertimezone","",$user->getUserTimezone(),true);
	                        		echo $select;
                                    //include('timezoneselect.php');
                                     ?>
	                            </div>
	                       </div>
	                        
<!-- 	                        <div class="form-group row m-t-xl"> -->
<!-- 	                       		<label class="col-lg-3 col-form-label bg-primary">Select Permissions</label> -->
<!-- 	                        </div> -->
	                        <div class="form-group row i-checks m-t-xl">
	                        	<div class="col-lg-12">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                             <div class="pull-left m-r-sm">
                                            	<input type="checkbox" class="i-checks" <?php echo $qcDepartmentChecked?> value="1" id="qcDepartment" name="departments[]"/>
                                            </div>  QC Schedules
                                        </div>
                                        <div id="qcPermissionsDiv" class="panel-body i-checks">
                                        
                                            <label class="col-lg-3 col-form-label">
                                            	<input type="checkbox" <?php echo $qcChecked?> value="qc" id="qcpermission" name="permissions[]"/>
				                        		Quality Controller
                                            </label>
				                        	
				                        	<label class="col-lg-3 col-form-label">
				                        		<input type="checkbox" <?php echo $classCodeChecked?> value="class_code" id="classcodepermission" name="permissions[]"/>
												Class Code
											</label>
				                        	
				                        	<label class="col-lg-3 col-form-label">
				                        		<input type="checkbox" <?php echo $weeklyMailButtonChecked?> value="weekly_mail_button" id="weeklymailbuttonpermission" name="permissions[]"/>
				                            	Weekly Mail Button
				                        		
				                            </label>
				                            
				                            <label class="col-lg-3 col-form-label">
				                            	<input type="checkbox" <?php echo $qcPlannerButtonChecked?> value="qc_planner_button" id="qcplannerbuttonpermission" name="permissions[]"/>
				                            	Qc Planner Button
				                            </label>
				                            <div class="row m-t-xl"></div>
				                            <label class="col-lg-3 col-form-label">
				                            	<input type="checkbox" <?php echo $qcApprovedRejectNotification?> value="approved_reject_notification" id="qcapprovalrejectpermission" name="permissions[]"/>
				                            	Approved/Reject Notification
				                            </label>
				                        	
				                            <div class="qcDIV form-group col-lg-6" style="display:<?php echo "block"?>">
					                            <label class="col-lg-3 col-form-label">QC Code :</label>
					                        	<div class="col-lg-8">
					                            	<input type="text" maxLength="250" value="<?php echo $user->getQCCode()?>" id="qccode" name="qccode" class="form-control">
					                            </div>
					                        </div>
					                        <div class="col-lg-12 m-t-sm"><h4>Select Notifications</h4> </div>
				                            <ul class="col-lg-6 todo-list ui-sortable p-h-xs">
						                        <li>
						                           	<input name="permissions[]" value="upcoming_inspections_report_weekly" type="checkbox" <?php echo in_array(QCScheduleNotificationType::getName(QCScheduleNotificationType::upcoming_inspections_report_weekly), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">Upcoming Inspections Report (Weekly)</span>
						                        </li>
						                        <li>
						                           	<input name="permissions[]" type="checkbox" value="missing_appointments_report_weekly" <?php echo in_array(QCScheduleNotificationType::getName(QCScheduleNotificationType::missing_appointments_report_weekly), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs" >Missing Appointments Report (Weekly)</span>
						                        </li>
						                        <li>
						                           	<input name="permissions[]" type="checkbox" value="incompleted_schedules_report_weekly" <?php echo in_array(QCScheduleNotificationType::getName(QCScheduleNotificationType::incompleted_schedules_report_weekly), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs" >Incompleted Schedules Report (Weekly)</span>
						                        </li>
											</ul>
						                    
						                    <ul class="col-lg-6 todo-list ui-sortable p-xs">
						                    	<li>
						                           	<input name="permissions[]" type="checkbox" value="pending_qc_approval_report_weekly" <?php echo in_array(QCScheduleNotificationType::getName(QCScheduleNotificationType::pending_qc_approval_report_weekly), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">Pending QC Approval Report (Weekly)</span>
						                        </li>
												<li>
						                           	<input name="permissions[]" type="checkbox" value="qc_planner_report_weekly" <?php echo in_array(QCScheduleNotificationType::getName(QCScheduleNotificationType::qc_planner_report_weekly), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">QC Planner Report (Weelky)</span>
						                        </li>
												<li>
						                           	<input name="permissions[]" type="checkbox" value="qc_approved_rejected_instant" <?php echo in_array(QCScheduleNotificationType::getName(QCScheduleNotificationType::qc_approved_rejected_instant), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">QC Approved/Rejected (Instant)</span>
						                        </li>
						                    </ul>
				                            
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <div class="pull-left m-r-sm">
                                            	<input type="checkbox" <?php echo $graphicDepartmentChecked?> value="2" id="graphicDepartment" name="departments[]" />
                                            </div>Graphic Logs
                                        </div>
                                        <div id="graphicPermissionsDiv" class="panel-body i-checks">
                                            <label class="col-lg-3 col-form-label">
				                        		<input type="checkbox" <?php echo $usaTeamChecked?> value="usa_team" id="usaTeamPermission" name="permissions[]"/>
				                            	USA Team
				                            </label>
				                            
				                            <label class="col-lg-3 col-form-label">
				                        		<input type="checkbox" <?php echo $chinaTeamChecked?> value="china_team" id="chinaTeamPermission" name="permissions[]"/>
				                            	China Team
				                            </label>
				                            
				                            <label class="col-lg-3 col-form-label">
				                        		<input type="checkbox" <?php echo $graphicDesignerChecked?> value="graphic_designer" id="graphicDesignerPermission"  name="permissions[]"/>
				                            	Graphic Designer
				                            </label>
				                            
				                            <div class="col-lg-12 m-t-sm"><h4>Select Notifications</h4> </div>
				                            <ul class="col-lg-6 todo-list ui-sortable p-h-xs">
						                        <li>
						                           	<input name="permissions[]" type="checkbox" value="projects_completed_last_week_weekly" <?php echo in_array(GraphicLogsNotificationType::getName(GraphicLogsNotificationType::projects_completed_last_week_weekly), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">Projects Completed Last Week (Weekly)</span>
						                        </li>
						                        <li>
						                           	<input name="permissions[]" type="checkbox" value="projects_over_due_till_now_weekly" <?php echo in_array(GraphicLogsNotificationType::getName(GraphicLogsNotificationType::projects_over_due_till_now_weekly), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">Projects Over Due till now (Weekly)</span>
						                        </li>
						                        <li>
						                           	<input name="permissions[]" type="checkbox" value="projects_in_buyer_review_weekly" <?php echo in_array(GraphicLogsNotificationType::getName(GraphicLogsNotificationType::projects_in_buyer_review_weekly), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">Projects In Buyer Review (Weekly)</span>
						                        </li>
						                        <li>
						                           	<input name="permissions[]" type="checkbox" value="projects_in_manager_review_weekly" <?php echo in_array(GraphicLogsNotificationType::getName(GraphicLogsNotificationType::projects_in_manager_review_weekly), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">Projects In Manager Review (Weekly)</span>
						                        </li>
												<li>
						                           	<input name="permissions[]" type="checkbox" value="projects_in_robby_review_weekly" <?php echo in_array(GraphicLogsNotificationType::getName(GraphicLogsNotificationType::projects_in_robby_review_weekly), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">Projects In Robby Review (Weekly)</span>
						                        </li>
												<li>
						                           	<input name="permissions[]" type="checkbox" value="projects_missing_info_from_china_weekly" <?php echo in_array(GraphicLogsNotificationType::getName(GraphicLogsNotificationType::projects_missing_info_from_china_weekly), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">Projects Missing Info From China (Weekly)</span>
						                        </li>
						                        <li>
						                           	<input name="permissions[]" type="checkbox" value="project_passed_due_with_missing_info_from_china_daily" <?php echo in_array(GraphicLogsNotificationType::getName(GraphicLogsNotificationType::project_passed_due_with_missing_info_from_china_daily), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">Project Passed Due with Missing Info From China (Daily)</span>
						                        </li>
											</ul>
						                    <ul class="col-lg-6 todo-list ui-sortable p-xs">
						                    	<li>
						                           	<input name="permissions[]" type="checkbox" value="projects_due_for_today_daily" <?php echo in_array(GraphicLogsNotificationType::getName(GraphicLogsNotificationType::projects_due_for_today_daily), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">Project Due for Today (Daily)</span>
						                        </li>
												<li>
						                           	<input name="permissions[]" type="checkbox" value="projects_due_less_than_20_days_from_entry_date_daily" <?php echo in_array(GraphicLogsNotificationType::getName(GraphicLogsNotificationType::projects_due_less_than_20_days_from_entry_date_daily), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">Proect Due less than 20 days from entry date (Daily)</span>
						                        </li>
												<li>
						                           	<input name="permissions[]" type="checkbox" value="projects_due_less_than_20_days_from_today_daily" <?php echo in_array(GraphicLogsNotificationType::getName(GraphicLogsNotificationType::projects_due_less_than_20_days_from_today_daily), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">Project Due Less than 20 days from today (Daily)</span>
						                        </li>
												<li>
						                           	<input name="permissions[]" type="checkbox" value="projects_missing_info_from_china_daily" <?php echo in_array(GraphicLogsNotificationType::getName(GraphicLogsNotificationType::projects_missing_info_from_china_daily), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">Projects Missing Info from China (Daily)</span>
						                        </li>
												<li>
						                           	<input name="permissions[]" type="checkbox" value="graphic_logs_status_change_instant" <?php echo in_array(GraphicLogsNotificationType::getName(GraphicLogsNotificationType::graphic_logs_status_change_instant), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">Graphic Logs Status change (Instant)</span>
						                        </li>
						                        <li>
						                           	<input name="permissions[]" type="checkbox" value="graphic_logs_notes_update_instant" <?php echo in_array(GraphicLogsNotificationType::getName(GraphicLogsNotificationType::graphic_logs_notes_update_instant), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">Graphic Logs Notes Update (Instant)</span>
						                        </li>
						                    </ul>
				                            
                                        </div>
                                    </div>
                                </div>
	                        	<div class="col-lg-12">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <div class="pull-left m-r-sm">
                                            	<input type="checkbox" <?php echo $containerDepartmentChecked?> value="4" id="containerDepartment" name="departments[]"/>
                                            </div>Container Schedule
                                        </div>
                                        <div id='containerPermissionsDiv' class="panel-body i-checks">
                                            <label class="col-lg-3 col-form-label bg-formLabelDark m-r-sm">
				                        		<input type="checkbox" <?php echo $containerInformationChecked?> value="container_information" id="containerpermission" name="permissions[]"/>
				                            	Container Information
				                            </label>
				                            
				                            <label class="col-lg-3 col-form-label bg-formLabelMauve m-r-sm">
				                        		<input type="checkbox" <?php echo $containerDeliveryChecked?> value="container_delivery_information" id="containerdevilerypermission" name="permissions[]"/>
				                            	Delivery Information
				                            </label>
				                            <label class="col-lg-3 col-form-label bg-formLabelBrown">
				                        		<input type="checkbox" <?php echo $containerOfficeChecked?> value="container_office_information" id="containerofficepermission" name="permissions[]"/>
				                            	Office Information
				                            </label>
				                            <div class="col-lg-12 m-t-sm"><h4>Select Notifications</h4> </div>
				                            <ul class="col-lg-6 todo-list ui-sortable p-h-xs">
						                        <li>
						                           	<input name="permissions[]" type="checkbox" value="send_eta_report_weekly" <?php echo in_array(ContainerScheduleNotificationType::getName(ContainerScheduleNotificationType::send_eta_report_weekly), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">Send ETA Report (Weekly)</span>
						                        </li>
						                        <li>
						                           	<input name="permissions[]" type="checkbox" value="empty_return_date_past_empty_lFD_report_weekly" <?php echo in_array(ContainerScheduleNotificationType::getName(ContainerScheduleNotificationType::empty_return_date_past_empty_lFD_report_weekly), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">Empty Return Date Past Empty LFD Report (Weekly)</span>
						                        </li>
						                        <li>
						                           	<input name="permissions[]" type="checkbox" value="pending_schedule_delivery_date_for_today_report_daily"<?php echo in_array(ContainerScheduleNotificationType::getName(ContainerScheduleNotificationType::pending_schedule_delivery_date_for_today_report_daily), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">Pending Schedule Delivery Date for Today Report (Daily)</span>
						                        </li>
						                        <li>
						                           	<input name="permissions[]" type="checkbox" value="empty_alpine_notication_pickup_date_daily" <?php echo in_array(ContainerScheduleNotificationType::getName(ContainerScheduleNotificationType::empty_alpine_notication_pickup_date_daily), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">Empty Alpine Notication Pickup Date (Daily)</span>
						                        </li>
												<li>
						                           	<input name="permissions[]" type="checkbox" value="missing_id_report_daily" <?php echo in_array(ContainerScheduleNotificationType::getName(ContainerScheduleNotificationType::missing_id_report_daily), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">Missing ID Report (Daily)</span>
						                        </li>
												<li>
						                           	<input name="permissions[]" type="checkbox" value="missing_terminal_appointment_date_daily" <?php echo in_array(ContainerScheduleNotificationType::getName(ContainerScheduleNotificationType::missing_terminal_appointment_date_daily), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">Missing Terminal Appointment Date (Daily)</span>
						                        </li>
											</ul>
						                    
						                    <ul class="col-lg-6 todo-list ui-sortable p-xs">
						                    	<li>
						                           	<input name="permissions[]" type="checkbox" value="missing_schedule_delivery_date_daily" <?php echo in_array(ContainerScheduleNotificationType::getName(ContainerScheduleNotificationType::missing_schedule_delivery_date_daily), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">Missing Schedule Delivery Date (Daily)</span>
						                        </li>
												<li>
						                           	<input name="permissions[]" type="checkbox" value="missing_confirm_delivery_date_daily" <?php echo in_array(ContainerScheduleNotificationType::getName(ContainerScheduleNotificationType::missing_confirm_delivery_date_daily), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">Missing Confirmed Delivery Date (Daily)</span>
						                        </li>
												<li>
						                           	<input name="permissions[]" type="checkbox" value="missing_received_dates_in_wms_daily" <?php echo in_array(ContainerScheduleNotificationType::getName(ContainerScheduleNotificationType::missing_received_dates_in_wms_daily), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">Missing Received Dates in WMS (Daily)</span>
						                        </li>
												<li>
						                           	<input name="permissions[]" type="checkbox" value="missing_received_dates_in_oms_daily" <?php echo in_array(ContainerScheduleNotificationType::getName(ContainerScheduleNotificationType::missing_received_dates_in_oms_daily), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">Missing Received Dates in OMS (Daily)</span>
						                        </li>
												<li>
						                           	<input name="permissions[]" type="checkbox" value="send_alpine_picking_date_change_instant" <?php echo in_array(ContainerScheduleNotificationType::getName(ContainerScheduleNotificationType::send_alpine_picking_date_change_instant), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">Send Alpine Picking Date Change (Instant)</span>
						                        </li>
												<li>
						                           	<input name="permissions[]" type="checkbox" value="terminal_appointment_date_change_instant" <?php echo in_array(ContainerScheduleNotificationType::getName(ContainerScheduleNotificationType::terminal_appointment_date_change_instant), $userRoles) ?  "checked" : ""?>/>
													<span class="m-l-xs">Terminal Appointment Date Change (Instant)</span>
						                        </li>
						                    </ul>
				                            
                                        </div>
                                    </div>
                                </div>
	                        	<div class="col-lg-12">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <div class="pull-left m-r-sm">
                                            	<input type="checkbox" <?php echo $customerDepartmentChecked?> value="7" id="customerDepartment" name="departments[]" />
                                            </div>Customer Management
                                        </div>                                  
                                </div>
                                <div class="col-lg-12">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <div class="pull-left m-r-sm">
                                            	<input type="checkbox" <?php echo $userDepartmentChecked?> value="5" id="customerDepartment" name="departments[]" />
                                            </div>User Management
                                        </div>                                  
                                </div>
                                <div class="col-lg-12">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <div class="pull-left m-r-sm">
                                            	<input type="checkbox" <?php echo $emailLogsChecked?> value="8" id="customerDepartment" name="departments[]" />
                                            </div>Email Logs Management
                                        </div>                                  
                                </div>
	                        
	                        </div>
	                    	<!-- 
	                    	<div class="form-group row m-t-xl">
	                       		<label class="col-lg-3 col-form-label bg-primary">Select Departments</label>
	                        </div>
	                    	<div class="form-group row i-checks">
	                    		
	                        </div> 
	                        -->    
	                 	 
	                    
                        <div class="bg-white p-xs">
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label"></label>
	                        	<div class="col-lg-2">
		                        	<button class="btn btn-primary" onclick="saveUser()" type="button" style="width:85%">
	                                	Save
		                          	</button>
		                        </div>
		                        <div class="col-lg-2">
		                          	<a class="btn btn-default" href="adminManageUsers.php" type="button" style="width:85%">
	                                	Cancel
		                          	</a>
		                        </div>
		                    </div>
	                    </div>
	                    
	                   </form>
                	 </div>           
	         	</div>
	    	</div>
       	<div class="row">
       	 	
        </div>
     </div>   	
    </div>
    </div>
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
	
	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
	   	radioClass: 'iradio_square-green',
	});

	$('.userTypeDD').change(function(event){
		if(this.value == "QC"){
			$(".qcDIV").show();
		}else{
			$(".qcDIV").hide();
		}
	});
	<?php if(!empty($user->getUserType())){?>	
		$(".userTypeDD").val("<?php echo $user->getUserType()?>");
	<?php }?>
	$('#qcpermission').on('ifChanged', function(event){
		var flag  = $("#qcpermission").is(':checked');
		if(flag){
			$("#qccode").attr("required","required");
		}else{
			$("#qccode").removeAttr("required");
		}
  	});
	disabledQCPermissions();
	disabledGraphicPermissions();
	disabledContainerPermissions();
	$('#qcDepartment').on('ifChanged', function(event){
		disabledQCPermissions();
  	});
	$('#graphicDepartment').on('ifChanged', function(event){
		disabledGraphicPermissions();
  	});
	$('#containerDepartment').on('ifChanged', function(event){
		disabledContainerPermissions();
  	});
});
function disabledGraphicPermissions(){
	var flag  = $("#graphicDepartment").is(':checked');
	if(!flag){
		$('#graphicPermissionsDiv').iCheck('uncheck')
		$("#chinaTeamPermission").attr("disabled","disabled");
		$("#usaTeamPermission").attr("disabled","disabled");
		$("#graphicDesignerPermission").attr("disabled","disabled");
	}else{
		$("#chinaTeamPermission").removeAttr("disabled");
		$("#usaTeamPermission").removeAttr("disabled");
		$("#graphicDesignerPermission").removeAttr("disabled");
	}
}
function disabledQCPermissions(){
	var flag  = $("#qcDepartment").is(':checked');
	if(!flag){
		$('#qcPermissionsDiv').iCheck('uncheck')
		$("#qcpermission").attr("disabled","disabled");
		$("#qccode").attr("disabled","disabled");
		$("#classcodepermission").attr("disabled","disabled");
		$("#weeklymailbuttonpermission").attr("disabled","disabled");
		$("#qcplannerbuttonpermission").attr("disabled","disabled");
		$("#qcapprovalrejectpermission").attr("disabled","disabled");
		
		
	}else{
		$("#qccode").removeAttr("disabled");
		$("#qcpermission").removeAttr("disabled");
		$("#classcodepermission").removeAttr("disabled");
		$("#weeklymailbuttonpermission").removeAttr("disabled");
		$("#qcplannerbuttonpermission").removeAttr("disabled");
		$("#qcapprovalrejectpermission").removeAttr("disabled");
	}
}
function disabledContainerPermissions(){
	var flag  = $("#containerDepartment").is(':checked');
	if(!flag){
		$('#containerPermissionsDiv').iCheck('uncheck')
		$("#containerpermission").attr("disabled","disabled");
		$("#containerdevilerypermission").attr("disabled","disabled");
		$("#containerofficepermission").attr("disabled","disabled");
	}else{
		$("#containerpermission").removeAttr("disabled");
		$("#containerdevilerypermission").removeAttr("disabled");
		$("#containerofficepermission").removeAttr("disabled");
	}
}

function saveUser(){
	if($("#createUserForm")[0].checkValidity()) {
		showHideProgress()
		$('#createUserForm').ajaxSubmit(function( data ){
		   showHideProgress();
		   var flag = showResponseToastr(data,null,null,"ibox");
		   if(flag){
			   window.setTimeout(function(){window.location.href = "adminManageUsers.php"},100);
		   }
	    })	
	}else{
		$("#createUserForm")[0].reportValidity();
	}
}
</script>