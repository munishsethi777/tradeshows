<?include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/QCSchedule.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/QcscheduleApprovalMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/QCScheduleMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DropdownUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/PermissionUtil.php");
$permissionUtil = PermissionUtil::getInstance();
$hasQCReadonly = $permissionUtil->hasQCReadonly();

$qcSchedule = new QCSchedule();
$qcScheduleMgr = QCScheduleMgr::getInstance();
$readOnlyPO = "";
$middleInspectionChk = "";
$firstInspectionChk = "";
$graphicsReceiveChk = "";
$qcUser = 0;
$poUser = 0;
$qcUserReadonly = "";
$sessionUtil = SessionUtil::getInstance();
$isSessionGeneralUser = $sessionUtil->isSessionGeneralUser();
$isSessionSV = $sessionUtil->isSessionSupervisor();
$isSessionAdmin = $sessionUtil->isSessionAdmin();
$readOnlyShipDate = ""; 
if($isSessionGeneralUser && !$isSessionSV){
 	$qcUser = $sessionUtil->getUserLoggedInSeq();
	$qcUserReadonly = "readonly";
}
 $seq = 0;
 $seqs = 0;
 $isSubmitApprovalDisabled = "";
 $disabledSubmitComments = "";
 $approvalChecked = "";
 $isCompleted = "";
 $readOnlyComplete = "readonly";
 $fieldStateArr = array();
 if(isset($_POST["id"])){
 	$seq = $_POST["id"];
 	$seqs = $_POST["seqs"];
 	if($seq != $seqs){
 		$qcScheduleAndFieldState = $qcScheduleMgr->findCommonQCAndFieldStates($seqs);
 		$qcSchedule = $qcScheduleAndFieldState["qcschedule"];
 		$fieldStateArr = $qcScheduleAndFieldState["fieldState"];
 	}else{
 		$qcSchedule = $qcScheduleMgr->findBySeq($seq);
 	}
 	$qcSchedule->setItemNumbers($_POST["itemnumbers"]);
 	$itemNumbersArr = explode(",",$_POST["itemnumbers"]);
 	$acFinalInspectionDate = $qcSchedule->getACFinalInspectionDate();
  	if($acFinalInspectionDate == "NA"){
  		$isSubmitApprovalDisabled = "disabled";
  		$disabledSubmitComments = '(Selected Items has different "Final Inspection Dates". You can only Submit for Approval those items which has same or no "Final Inspection Dates")';
  	}
 	if(!empty($qcSchedule->getApMiddleInspectionDateNaReason())){
 		$middleInspectionChk = "checked";
 	}
 	if(!empty($qcSchedule->getApFirstInspectionDateNaReason())){
 		$firstInspectionChk = "checked";
 	}
 	if(!empty($qcSchedule->getAPGraphicsReceiveDateNAReason())){
 		$graphicsReceiveChk = "checked";
 	}
 	$readOnlyPO = "readonly";
 	if(!$isSessionAdmin){
 	    $readOnlyShipDate = "readonly";
 	}
 	$qcUser = $qcSchedule->getQCUser();
 	$qcscheduleApprovalMgr = QcscheduleApprovalMgr::getInstance();
 	$approvals = $qcscheduleApprovalMgr->getLastestQcScheduleApproval($seqs);
 	if(!empty($approvals)){
	 	foreach ($approvals as $approval){
		 	if(!empty($approval)){
			 	$status = $approval->getResponseType();
			 	if($status == QCScheduleApprovalType::pending || $status == QCScheduleApprovalType::approved){
			 		$isSubmitApprovalDisabled = "disabled";
			 		$disabledSubmitComments = 'Some of the selected items are already submitted for approval. You can not submit these items for approval again.';
			 		
			 		if(count($itemNumbersArr) == 1){
			 			$disabledSubmitComments = "(Pending Approval)";
			 			if($status == QCScheduleApprovalType::approved){
			 				$disabledSubmitComments = "(Approved)";
			 			}
			 		}
			 		$approvalChecked = "checked";
			 		break;
			 	}
		 	}
	 	}
 	}
    if($qcSchedule->getIsCompleted() == 1){
        $isCompleted = "checked";
    }else{
        $isCompleted = "";
	}
 }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin | QC Schedule</title>
<?include "ScriptsInclude.php"?>
<style type="text/css">
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
	padding:20px 20px;
}
#apmiddleinspectiondatenareason,
#apfirstinspectiondatenareason,
#apgraphicsreceivedatenareason{
	margin-bottom:0px !important;
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
							<h5 class="pageTitle">Create Request</h5>
					</nav>
                 </div>
                 <div class="ibox-content">
                 	<?include "progress.php"?>
                 	 <form id="createQCScheduleForm" method="post" action="Actions/QCScheduleAction.php" class="m-t-lg">
                     	<input type="hidden" id ="call" name="call"  value="saveQCSchedule"/>
                     	<input type="hidden" id ="seqs" name="seqs"  value="<?php echo $seqs?>"/>
                        <input type="hidden" id ="seq" name="seq"  value="<?php echo $seq?>"/>
                        <input type="hidden" id="materialtotalpercent" name="materialtotalpercent"/>
                        <div class="bg-white p-xs outterDiv">
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Request Number</label>
	                        	<div class="col-lg-4">
                                <input type="text" id="123" value="IMG_1"  maxLength="250" name="123" class="form-control 123" readonly/>
	                            </div>
								<label class="col-lg-2 col-form-label bg-formLabel">Priority</label>
	                        	<div class="col-lg-4">
	                        		<?php 
										$select = DropDownUtils::getPOUsers("poinchargeuser", null,$qcSchedule->getPoInchargeUser(),false,true);
		                        		echo $select;
	                        			if($isSessionGeneralUser && !$isSessionSV){?>
	                        				<input type="hidden" id="pouserhidden" value="<?php echo $poUser?>" name="pouser">
	                        			<?php }
                             		?>
	                            	<input style="display: none" type="text" id="po" maxLength="250" value="" name="po" class="form-control">
	                            </div>
	                       </div>
	                       <div class="form-group row">
	                            <label class="col-lg-2 col-form-label bg-formLabel">Department</label>
	                        	<div class="col-lg-4">
 	                            	<input type="hidden" name="classcode" id="classcode">
	                            	<?php 
				                           	$select = DropDownUtils::getClassCodes("classcodeseq", "", $qcSchedule->getClassCodeSeq(),false,true,false);
				                            echo $select;
	                             		?>
	                            </div>
                                <label class="col-lg-2 col-form-label bg-formLabel">Request Type</label>
	                        	<div class="col-lg-4">
 	                            	<input type="hidden" name="classcode" id="classcode">
	                            	<?php 
				                           	$select = DropDownUtils::getClassCodes("classcodeseq", "", $qcSchedule->getClassCodeSeq(),false,true,false);
				                            echo $select;
	                             		?>
	                            </div>
	                        </div>

	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Request Due Date</label>
	                        	<div class="col-lg-4">
                                    <input type="text" required placeholder="Select Date" id="shipdate" onchange="setDates(this.value)" maxLength="250" value="<?php echo $qcSchedule->getShipDate()?>" name="shipdate" class="form-control shipDateControl" <?php echo $readOnlyShipDate?> <?php echo isset($fieldStateArr["shipdate"])?$fieldStateArr["shipdate"]:""?>>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Requester</label>
	                        	<div class="col-lg-4">
	                        		<?php 
										$select = DropDownUtils::getPOUsers("poinchargeuser", null,$qcSchedule->getPoInchargeUser(),false,true);
		                        		echo $select;
	                        			if($isSessionGeneralUser && !$isSessionSV){?>
	                        				<input type="hidden" id="pouserhidden" value="<?php echo $poUser?>" name="pouser">
	                        			<?php }
                             		?>
	                            </div>
	                        </div>
	                    </div> 
                        <div class="bg-white p-xs outterDiv" style="background-color:rgb(236, 255, 237)">
                            <div class="form-group row">
                                <h4 class="areaTitle">Image Request Details</h4><br>
                                <label class="col-lg-2 col-form-label bg-formLabel">Qty of Images</label>
                                <div class="col-lg-4">
                                    <input type="text" id="apreadydate" maxLength="250" value="<?php echo $qcSchedule->getAPReadyDate()?>" name="apreadydate" class="form-control dateControl" <?php echo isset($fieldStateArr["apreadydate"])?$fieldStateArr["apreadydate"]:""?>>
                                </div>
                                <label class="col-lg-2 col-form-label bg-formLabel">Image Format</label>
                                <div class="col-lg-4">
                                    <input type="text" id="apfinalinspectiondate" maxLength="250" value="<?php echo $qcSchedule->getAPFinalInspectionDate()?>" name="apfinalinspectiondate" class="form-control dateControl" <?php echo isset($fieldStateArr["apfinalinspectiondate"])?$fieldStateArr["apfinalinspectiondate"]:""?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label bg-formLabel">Size</label>
                                <div class="col-lg-4">
                                    <input type="text" id="apreadydate" maxLength="250" value="<?php echo $qcSchedule->getAPReadyDate()?>" name="apreadydate" class="form-control dateControl" <?php echo isset($fieldStateArr["apreadydate"])?$fieldStateArr["apreadydate"]:""?>>
                                </div>
                                <label class="col-lg-2 col-form-label bg-formLabel">Product List</label>
                                <div class="col-lg-4">
                                    <input type="text" id="apfinalinspectiondate" maxLength="250" value="<?php echo $qcSchedule->getAPFinalInspectionDate()?>" name="apfinalinspectiondate" class="form-control dateControl" <?php echo isset($fieldStateArr["apfinalinspectiondate"])?$fieldStateArr["apfinalinspectiondate"]:""?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label bg-formLabel">To be Used for</label>
                                <div class="col-lg-4">
                                    <input type="text" id="apreadydate" maxLength="250" value="<?php echo $qcSchedule->getAPReadyDate()?>" name="apreadydate" class="form-control dateControl" <?php echo isset($fieldStateArr["apreadydate"])?$fieldStateArr["apreadydate"]:""?>>
                                </div>
                                <label class="col-lg-2 col-form-label bg-formLabel">Tradeshow</label>
                                <div class="col-lg-4">
                                    <input type="text" id="apfinalinspectiondate" maxLength="250" value="<?php echo $qcSchedule->getAPFinalInspectionDate()?>" name="apfinalinspectiondate" class="form-control dateControl" <?php echo isset($fieldStateArr["apfinalinspectiondate"])?$fieldStateArr["apfinalinspectiondate"]:""?>>
                                </div>
                            </div>
	                    </div>
                        
                        <div class="bg-white p-xs outterDiv">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label bg-formLabel">Assigner</label>
                                <div class="col-lg-4">
                                    <input type="text" id="apreadydate" maxLength="250" value="<?php echo $qcSchedule->getAPReadyDate()?>" name="apreadydate" class="form-control dateControl" <?php echo isset($fieldStateArr["apreadydate"])?$fieldStateArr["apreadydate"]:""?>>
                                </div>
                                <label class="col-lg-2 col-form-label bg-formLabel">Assignee</label>
                                <div class="col-lg-4">
                                    <input type="text" id="apfinalinspectiondate" maxLength="250" value="<?php echo $qcSchedule->getAPFinalInspectionDate()?>" name="apfinalinspectiondate" class="form-control dateControl" <?php echo isset($fieldStateArr["apfinalinspectiondate"])?$fieldStateArr["apfinalinspectiondate"]:""?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label bg-formLabel">Assignee Due Date</label>
                                <div class="col-lg-4">
                                    <input type="text" id="apreadydate" maxLength="250" value="<?php echo $qcSchedule->getAPReadyDate()?>" name="apreadydate" class="form-control dateControl" <?php echo isset($fieldStateArr["apreadydate"])?$fieldStateArr["apreadydate"]:""?>>
                                </div>
                                <label class="col-lg-2 col-form-label bg-formLabel">Estimated Hours</label>
                                <div class="col-lg-4">
                                    <input type="text" id="apfinalinspectiondate" maxLength="250" value="<?php echo $qcSchedule->getAPFinalInspectionDate()?>" name="apfinalinspectiondate" class="form-control dateControl" <?php echo isset($fieldStateArr["apfinalinspectiondate"])?$fieldStateArr["apfinalinspectiondate"]:""?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label bg-formLabel">Status</label>
                                <div class="col-lg-4">
                                    <input type="text" id="apreadydate" maxLength="250" value="<?php echo $qcSchedule->getAPReadyDate()?>" name="apreadydate" class="form-control dateControl" <?php echo isset($fieldStateArr["apreadydate"])?$fieldStateArr["apreadydate"]:""?>>
                                </div>
                                <label class="col-lg-2 col-form-label bg-formLabel">Required Manager's approval</label>
                                <div class="col-lg-4">
                                    <input type="text" id="apfinalinspectiondate" maxLength="250" value="<?php echo $qcSchedule->getAPFinalInspectionDate()?>" name="apfinalinspectiondate" class="form-control dateControl" <?php echo isset($fieldStateArr["apfinalinspectiondate"])?$fieldStateArr["apfinalinspectiondate"]:""?>>
                                </div>
                            </div>
							<div class="form-group row">
                                <label class="col-lg-2 col-form-label bg-formLabel">Required Requester's Approval</label>
                                <div class="col-lg-4">
                                    <input type="text" id="apreadydate" maxLength="250" value="<?php echo $qcSchedule->getAPReadyDate()?>" name="apreadydate" class="form-control dateControl" <?php echo isset($fieldStateArr["apreadydate"])?$fieldStateArr["apreadydate"]:""?>>
                                </div>
                                <label class="col-lg-2 col-form-label bg-formLabel">Required Robby's Approval</label>
                                <div class="col-lg-4">
                                    <input type="text" id="apfinalinspectiondate" maxLength="250" value="<?php echo $qcSchedule->getAPFinalInspectionDate()?>" name="apfinalinspectiondate" class="form-control dateControl" <?php echo isset($fieldStateArr["apfinalinspectiondate"])?$fieldStateArr["apfinalinspectiondate"]:""?>>
                                </div>
                            </div>
	                    </div>



                        <div class="bg-white p-xs">
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label"></label>
	                        	<?php if(!$hasQCReadonly){?>
	                        	<div class="col-lg-2">
		                        	<button class="btn btn-primary" onclick="saveQCSchedule()" type="button" style="width:85%">
	                                	Save
		                          	</button>
		                        </div>
		                        <?php }?>
		                        <div class="col-lg-2">
		                          	<a class="btn btn-default" href="adminManageQCSchedules.php" type="button" style="width:85%">
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


</script>