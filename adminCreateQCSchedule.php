<?include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/QCSchedule.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/QcscheduleApprovalMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/QCScheduleMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DropdownUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
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
							<h5 class="pageTitle">Create/Edit QC Schedule</h5>
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
	                       		<label class="col-lg-2 col-form-label bg-formLabel">QC</label>
	                        	<div class="col-lg-4">
	                        		<?php 
										$select = DropDownUtils::getQCUsers("qcuser", null,$qcUser,false,true);
		                        		echo $select;
	                        			if($isSessionGeneralUser && !$isSessionSV){?>
	                        				<input type="hidden" id="qcuserhidden" value="<?php echo $qcUser?>" name="qcuser">
	                        			<?php }
                             		?>
	                            	<input style="display: none" type="text" id="qc" maxLength="250" value="<?php echo $qcSchedule->getQC()?>" name="qc" class="form-control">
	                            </div>
								<label class="col-lg-2 col-form-label bg-formLabel">PO</label>
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
	                            <label class="col-lg-2 col-form-label bg-formLabel">Class Code</label>
	                        	<div class="col-lg-4">
 	                            	<input type="hidden" name="classcode" id="classcode">
	                            	<?php 
				                           	$select = DropDownUtils::getClassCodes("classcodeseq", "", $qcSchedule->getClassCodeSeq(),false,true,false);
				                            echo $select;
	                             		?>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">PO Number</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" required  id="po" maxLength="50" value="<?php echo $qcSchedule->getPO()?>" name="po" class="form-control" <?php echo $readOnlyPO?>>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">PO Type</label>
	                        	<div class="col-lg-4">
	                            	<input type="text"  required id="potype" maxLength="50" value="<?php echo $qcSchedule->getPOType()?>" name="potype" class="form-control" <?php echo isset($fieldStateArr["potype"])?$fieldStateArr["potype"]:""?>>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Item Numbers</label>
	                        	<div class="col-lg-4">
	                            	<textarea <?php echo $readOnlyPO?> id="itemnumbers" required maxLength="200" name="itemnumbers" class="form-control"><?php echo $qcSchedule->getItemNumbers()?></textarea>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Ship Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" required placeholder="Select Date" id="shipdate" onchange="setDates(this.value)" maxLength="250" value="<?php echo $qcSchedule->getShipDate()?>" name="shipdate" class="form-control shipDateControl" <?php echo $readOnlyShipDate?> <?php echo isset($fieldStateArr["shipdate"])?$fieldStateArr["shipdate"]:""?>>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Submit for Approval</label>
	                        	<div class="col-lg-4">
	                        		<input type="checkbox" <?php echo $isSubmitApprovalDisabled?> <?php echo $approvalChecked?> id="isapproval" class="form-control i-checks" name="isapproval"/>
	                        		<small><?php echo $disabledSubmitComments?></small>
	                           </div>
	                           
	                           <label class="col-lg-2 col-form-label bg-formLabel">Latest Ship Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date" id="latestshipdate" maxLength="250" value="<?php echo $qcSchedule->getLatestShipDate()?>" name="latestshipdate" class="form-control dateControl" <?php echo isset($fieldStateArr["latestshipdate"])?$fieldStateArr["latestshipdate"]:""?>>
	                            </div>
	                        </div>
	                        
	                    </div>
                        <div class="bg-muted p-xs outterDiv">
	                        <div class="form-group row">
                        		<h4 class="areaTitle">Scheduled Information</h4><br>
	                         	<label class="col-lg-2 col-form-label bg-formLabel">Ready Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" readonly id="screadydate" maxLength="250" value="<?php echo $qcSchedule->getSCReadyDate()?>" name="screadydate" class="form-control" <?php echo isset($fieldStateArr["screadydate"])?$fieldStateArr["screadydate"]:""?>>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Final Inspection Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" readonly id="scfinalinspectiondate" maxLength="250" value="<?php echo $qcSchedule->getSCFinalInspectionDate()?>" name="scfinalinspectiondate" class="form-control" <?php echo isset($fieldStateArr["scfinalinspectiondate"])?$fieldStateArr["scfinalinspectiondate"]:""?>>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-2 col-form-label bg-formLabel">Middle Inspection Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" readonly id="scmiddleinspectiondate" maxLength="250" value="<?php echo $qcSchedule->getSCMiddleInspectionDate()?>" name="scmiddleinspectiondate" class="form-control" <?php echo isset($fieldStateArr["scmiddleinspectiondate"])?$fieldStateArr["scmiddleinspectiondate"]:""?>>
	                            	 
	                            </div>
	                           
	                            <label class="col-lg-2 col-form-label bg-formLabel">First Inspection Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" readonly id="scfirstinspectiondate" maxLength="250" value="<?php echo $qcSchedule->getSCFirstInspectionDate()?>" name="scfirstinspectiondate" class="form-control" <?php echo isset($fieldStateArr["scfirstinspectiondate"])?$fieldStateArr["scfirstinspectiondate"]:""?>>
	                            </div>
	                            
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-2 col-form-label bg-formLabel">Production Start Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" readonly id="scproductionstartdate" maxLength="250" value="<?php echo $qcSchedule->getSCProductionStartDate()?>" name="scproductionstartdate" class="form-control" <?php echo isset($fieldStateArr["scproductionstartdate"])?$fieldStateArr["scproductionstartdate"]:""?>>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Graphics Receive Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" readonly  id="scgraphicsreceivedate" maxLength="250" value="<?php echo $qcSchedule->getSCGraphicsReceiveDate()?>" name="scgraphicsreceivedate" class="form-control" <?php echo isset($fieldStateArr["scgraphicsreceivedate"])?$fieldStateArr["scgraphicsreceivedate"]:""?>>
	                            </div>
	                       </div>
	                  </div>
	                  
	                  <div class="bg-white p-xs outterDiv">
	                        <div class="form-group row">
                        		<h4 class="areaTitle">Appointment Information</h4><br>
	                         	<label class="col-lg-2 col-form-label bg-formLabel">Ready Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date"  id="apreadydate" maxLength="250" value="<?php echo $qcSchedule->getAPReadyDate()?>" name="apreadydate" class="form-control dateControl" <?php echo isset($fieldStateArr["apreadydate"])?$fieldStateArr["apreadydate"]:""?>>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Final Inspection Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date" id="apfinalinspectiondate" maxLength="250" value="<?php echo $qcSchedule->getAPFinalInspectionDate()?>" name="apfinalinspectiondate" class="form-control dateControl" <?php echo isset($fieldStateArr["apfinalinspectiondate"])?$fieldStateArr["apfinalinspectiondate"]:""?>>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-2 col-form-label bg-formLabel">Middle Inspection Date</label>

	                        	<div class="col-lg-2">
	                        		<div id="middleInspectionSelectDate">
	                            		<input type="text" placeholder="Select Date" id="apmiddleinspectiondate" maxLength="250" value="<?php echo $qcSchedule->getAPMiddleInspectionDate()?>" name="apmiddleinspectiondate" class="form-control dateControl" <?php echo isset($fieldStateArr["apmiddleinspectiondate"])?$fieldStateArr["apmiddleinspectiondate"]:""?>>
	                            	</div>
	                            	<div style="display:none" id="middleNaDiv">
										<?php 
			                             	$select = DropDownUtils::getReasonTypes("apmiddleinspectiondatenareason", null, $qcSchedule->getApMiddleInspectionDateNaReason(),false,true);
			                                echo $select;
	                             		?>
	                        		</div>
	                            </div>
	                             <label class="col-lg-1 col-form-label">NA</label>
	                            <div class="col-lg-1 i-checks">
	                            	<input type="checkbox" <?php echo $middleInspectionChk?> id="apMiddleInspectionChk" name="apMiddleInspectionChk" class="form-control" <?php echo isset($fieldStateArr["apMiddleInspectionChk"])?$fieldStateArr["apMiddleInspectionChk"]:""?>>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">First Inspection Date</label>
	                          	<div class="col-lg-2">
	                        		<div id="firstInspectionSelectDate">
	                            		<input type="text" placeholder="Select Date" id="apfirstinspectiondate" maxLength="250" value="<?php echo $qcSchedule->getAPFirstInspectionDate()?>" name="apfirstinspectiondate" class="form-control dateControl" <?php echo isset($fieldStateArr["apfirstinspectiondate"])?$fieldStateArr["apfirstinspectiondate"]:""?>>
	                            	</div>
	                            	<div style="display:none" id="firstNaDiv">
										<?php 
			                             	$select = DropDownUtils::getReasonTypes("apfirstinspectiondatenareason", null, $qcSchedule->getApFirstInspectionDateNaReason(),false,true);
			                                echo $select;
	                             		?>
	                        		</div>
	                            </div>
	                              <label class="col-lg-1 col-form-label">NA</label>
	                            <div class="col-lg-1 i-checks">
	                            	<input type="checkbox" <?php echo $firstInspectionChk?> id="apFirstInspectionChk" name="apFirstInspectionChk" class="form-control" <?php echo isset($fieldStateArr["apFirstInspectionChk"])?$fieldStateArr["apFirstInspectionChk"]:""?> >

	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-2 col-form-label bg-formLabel">Production Start Date</label>
	                        	<div class="col-lg-4">

	                            	<input type="text" placeholder="Select Date" id="approductionstartdate" maxLength="250" value="<?php echo $qcSchedule->getAPProductionStartDate()?>" name="approductionstartdate" class="form-control dateControl" <?php echo isset($fieldStateArr["approductionstartdate"])?$fieldStateArr["approductionstartdate"]:""?>>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Graphics Receive Date</label>
	                        	<div class="col-lg-2">
	                        		<div id="graphicsReceiveDateDiv">
	                            		<input type="text" placeholder="Select Date" id="apgraphicsreceivedate" maxLength="250" value="<?php echo $qcSchedule->getAPGraphicsReceiveDate()?>" name="apgraphicsreceivedate" class="form-control dateControl" <?php echo isset($fieldStateArr["apgraphicsreceivedate"])?$fieldStateArr["apgraphicsreceivedate"]:""?>>
	                            	</div>
	                            	<div style="display:none" id="graphicsNaReasonDiv">
										<?php 
			                             	$select = DropDownUtils::getGraphicsNAReasonTypes("apgraphicsreceivedatenareason", null, $qcSchedule->getAPGraphicsReceiveDateNAReason(),false,true);
			                                echo $select;
	                             		?>
	                        		</div>
	                            </div>
	                             <label class="col-lg-1 col-form-label">NA</label>
	                            <div class="col-lg-1 i-checks">
	                            	<input type="checkbox" <?php echo $graphicsReceiveChk?> id="apGraphicsReceiveChk" name="apGraphicsReceiveChk" class="form-control" <?php echo isset($fieldStateArr["apMiddleInspectionChk"])?$fieldStateArr["apMiddleInspectionChk"]:""?>>
	                            </div>
	                            
	                            
	                       </div>
	                  </div>
	                  
	                  
	                  <div class="bg-muted p-xs outterDiv">
	                        <div class="form-group row">
                        		<h4 class="areaTitle">Actual Information</h4><br>
	                         	<label class="col-lg-2 col-form-label bg-formLabel">Ready Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date"  id="acreadydate" maxLength="250" value="<?php echo $qcSchedule->getACReadyDate()?>" name="acreadydate" class="form-control dateControl" <?php echo isset($fieldStateArr["acreadydate"])?$fieldStateArr["acreadydate"]:""?>>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Final Inspection Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date"  onchange="handleIsCompletedCheckbox()" id="acfinalinspectiondate" maxLength="250" value="<?php echo $qcSchedule->getACFinalInspectionDate()?>" name="acfinalinspectiondate" class="form-control dateControl" <?php echo isset($fieldStateArr["acfinalinspectiondate"])?$fieldStateArr["acfinalinspectiondate"]:""?>>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-2 col-form-label bg-formLabel">Middle Inspection Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date" id="acmiddleinspectiondate" maxLength="250" value="<?php echo $qcSchedule->getACMiddleInspectionDate()?>" name="acmiddleinspectiondate" class="form-control dateControl" <?php echo isset($fieldStateArr["acmiddleinspectiondate"])?$fieldStateArr["acmiddleinspectiondate"]:""?>>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">First Inspection Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date" id="acfirstinspectiondate" maxLength="250" value="<?php echo $qcSchedule->getACFirstInspectionDate()?>" name="acfirstinspectiondate" class="form-control dateControl" <?php echo isset($fieldStateArr["acfirstinspectiondate"])?$fieldStateArr["acfirstinspectiondate"]:""?>>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-2 col-form-label bg-formLabel">Middle Inspection Notes</label>
	                        	<div class="col-lg-4">
	                            	
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">First Inspection Notes</label>
	                        	<div class="col-lg-4">
	                        		
	                            </div>
	                       </div>
	                        <div class="form-group row">
	                          <div class="col-lg-6">
	                         		<textarea id="acmiddleinspectionnotes" maxLength="2500" name="acmiddleinspectionnotes" class="form-control editor" <?php echo isset($fieldStateArr["acmiddleinspectionnotes"])?$fieldStateArr["acmiddleinspectionnotes"]:""?> ><?php echo $qcSchedule->getAcMiddleInspectionNotes()?></textarea>
	                            </div>
	                            <div class="col-lg-6">
	                                <textarea id="acfirstinspectionnotes" maxLength="2500" name="acfirstinspectionnotes" class="form-control editor" <?php echo isset($fieldStateArr["acfirstinspectionnotes"])?$fieldStateArr["acfirstinspectionnotes"]:""?> ><?php echo $qcSchedule->getAcFirstInspectionNotes()?></textarea>
	                            </div>
	                       </div>
	                        <div class="form-group row">
	                            <label class="col-lg-2 col-form-label bg-formLabel">Production Start Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date" id="acproductionstartdate" maxLength="250" value="<?php echo $qcSchedule->getACProductionStartDate()?>" name="acproductionstartdate" class="form-control dateControl" <?php echo isset($fieldStateArr["acproductionstartdate"])?$fieldStateArr["acproductionstartdate"]:""?>>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Graphics Receive Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date" id="acgraphicsreceivedate" maxLength="250" value="<?php echo $qcSchedule->getACGraphicsReceiveDate()?>" name="acgraphicsreceivedate" class="form-control dateControl" <?php echo isset($fieldStateArr["acgraphicsreceivedate"])?$fieldStateArr["acgraphicsreceivedate"]:""?>>
	                            </div>
	                       </div>
	                  </div>
                        <div class="bg-white p-xs outterDiv">
                       		<div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Status</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" id="status" maxLength="100" value="<?php echo $qcSchedule->getStatus()?>" name="status" class="form-control" <?php echo isset($fieldStateArr["status"])?$fieldStateArr["status"]:""?>>
	                           
	                            </div>
	                        	<label class="col-lg-2 col-form-label bg-formLabel">Final Inspection Notes</label>
	                        	<div class="col-lg-4">
	                            </div>
	                        </div>
	                        
	                        <div class="form-group row">
	                        	<div class="col-lg-6">
	                         	 </div>
	                        	<div class="col-lg-6">
	                        		<textarea style="height:100px" id="notes" <?php echo isset($fieldStateArr["notes"])?$fieldStateArr["notes"]:""?> maxLength="500" name="notes" class="form-control editor" ><?php echo $qcSchedule->getNotes()?></textarea>
	                        	 </div>	
	                        </div>
	                       
	                        <div class="form-group row">
	                       		
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Completed</label>
	                        	<div class="col-lg-10 completed">
	                        		<input type="checkbox" <?php echo $isCompleted; ?>  id="iscompleted" class="form-control i-checks" name="iscompleted" />
	                           </div>
	                       		
	                       	</div>
	                    </div> 
	                   
	                    
                        <div class="bg-white p-xs">
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label"></label>
	                        	<div class="col-lg-2">
		                        	<button class="btn btn-primary" onclick="saveQCSchedule()" type="button" style="width:85%">
	                                	Save
		                          	</button>
		                        </div>
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
var qcReadonly = "<?php echo $qcUserReadonly?>";
$(document).ready(function(){
	if(qcReadonly != ""){
		$("#qcuser").attr("disabled","disabled");
	}else{
		$("#qcuser").removeAttr("disabled");
	}
	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
	   	radioClass: 'iradio_square-green',
	   	
	});
	var middleInspectionNa = "<?php echo $middleInspectionChk?>";
	if(middleInspectionNa != ""){
		showHideMiddleNaDiv(true);
	}

	var firstInspectionNa = "<?php echo $firstInspectionChk?>";
	if(firstInspectionNa != ""){
		showHideFirstNaDiv(true);
	}

	var graphicsReceiveNa = "<?php echo $graphicsReceiveChk?>";
	if(graphicsReceiveNa != ""){
		showHideGraphicsNaDiv(true);
	}
	
	$('.dateControl').attr("autocomplete","off");
	$('.shipDateControl').attr("autocomplete","off");	
	$('.dateControl').datetimepicker({
	    timepicker:false,
	    format:'m-d-Y',
	    scrollMonth : false,
		scrollInput : false
	});
	$('.shipDateControl').datetimepicker({
	    timepicker:false,
	    format:'m-d-Y',
	    scrollMonth : false,
		scrollInput : false,
		minDate: 0
	});
	<?php if($readOnlyShipDate == "readonly"){?>
		$("#shipdate").prop('disabled', true) ;
	<?php }?>
	
	<?php if($readOnlyComplete == "readonly"){?>
		 //$("#iscompleted").prop("disabled", true);
	<?php }?>
	
	handleIsCompletedCheckbox();
	
	$('#apMiddleInspectionChk').on('ifChanged', function(event){
		var flag  = $("#apMiddleInspectionChk").is(':checked');
		showHideMiddleNaDiv(flag)
  	});
	$('#apFirstInspectionChk').on('ifChanged', function(event){
		var flag  = $("#apFirstInspectionChk").is(':checked');
		showHideFirstNaDiv(flag);
	});
	$('#apGraphicsReceiveChk').on('ifChanged', function(event){
		var flag  = $("#apGraphicsReceiveChk").is(':checked');
		showHideGraphicsNaDiv(flag);
	});
	requiredAcFinalInspection();
	$('#isapproval').on('ifChanged', function(event){
		requiredAcFinalInspection();
  	});
});

function requiredAcFinalInspection(){
	var flag  = $("#isapproval").is(':checked');
	if(flag){
		$("#acfinalinspectiondate").attr("required","required");
	}else{
		$("#acfinalinspectiondate").removeAttr("required");
	}
}
function showHideMiddleNaDiv(flag){
	if(flag){
		$("#middleInspectionSelectDate").hide();
		$("#middleNaDiv").show();
		$("#acmiddleinspectiondate").val("");
		$("#acmiddleinspectiondate").attr("disabled","disabled");
	}else{
		$("#acmiddleinspectiondate").removeAttr("disabled");
		$("#middleInspectionSelectDate").show();
		$("#middleNaDiv").hide();
	}
}

function showHideFirstNaDiv(flag){
	if(flag){
		$("#firstInspectionSelectDate").hide();
		$("#firstNaDiv").show();
		$("#acfirstinspectiondate").val("");
		$("#acfirstinspectiondate").attr("disabled","disabled");
	}else{
		$("#acfirstinspectiondate").removeAttr("disabled");
		$("#firstInspectionSelectDate").show();
		$("#firstNaDiv").hide();
	}
}

function showHideGraphicsNaDiv(flag){
	if(flag){
		$("#graphicsReceiveDateDiv").hide();
		$("#graphicsNaReasonDiv").show();
		$("#acgraphicsreceivedate").val("");
		$("#acgraphicsreceivedate").attr("disabled","disabled");
	}else{
		$("#acgraphicsreceivedate").removeAttr("disabled");
		$("#graphicsReceiveDateDiv").show();
		$("#graphicsNaReasonDiv").hide();
	}
}



	
$('.editor').summernote({
	height: 120,
	minHeight: null,             // set minimum height of editor
	maxHeight: null,
	toolbar: [
	    // [groupName, [list of button]]
	    ['style', ['bold', 'italic', 'underline', 'clear']],
	    ['fontsize', ['fontsize']],
	    ['color', ['color']],
	    ['para', ['ul', 'ol', 'paragraph']],
	    ['height', ['height']]
	  ]
});
var acFirstInspectionNotesDisable = '<?php echo isset($fieldStateArr["acfirstinspectionnotes"])?$fieldStateArr["acfirstinspectionnotes"]:""?>';
var acMiddleInspectionNotesDisable = '<?php echo isset($fieldStateArr["acmiddleinspectionnotes"])?$fieldStateArr["acmiddleinspectionnotes"]:""?>';
if(acFirstInspectionNotesDisable != ""){
	$('#acfirstinspectionnotes').summernote(acFirstInspectionNotesDisable.slice(0, -1));
}
if(acMiddleInspectionNotesDisable != ""){
	$('#acmiddleinspectionnotes').summernote(acMiddleInspectionNotesDisable.slice(0, -1));
}
function setDates(shipDateStr){
	if(shipDateStr == ""){
		$("#screadydate").val("");
		$("#scfinalinspectiondate").val("");
		$("#scmiddleinspectiondate").val("");
		$("#scfirstinspectiondate").val("");
		$("#scproductionstartdate").val("");
		$("#scgraphicsreceivedate").val("");
		return;
	}
	var shipDate = getDate(shipDateStr);
	readyDateDays = 14;
	var scReadyDate = subtractDays(shipDate,readyDateDays);
	scReadyDateStr = dateToStr(scReadyDate);
	$("#screadydate").val(scReadyDateStr);

	shipDate = getDate(shipDateStr);
	finalInspectionDateDays = 10;
	var finalInspectionDate = subtractDays(shipDate,finalInspectionDateDays);
	finalInspectionDateStr = dateToStr(finalInspectionDate);
	$("#scfinalinspectiondate").val(finalInspectionDateStr);

	shipDate = getDate(shipDateStr);
	middleInspectionDateDays = 15;
	var middleInspectionDate = subtractDays(shipDate,middleInspectionDateDays);
	middleInspectionDateStr = dateToStr(middleInspectionDate);
	$("#scmiddleinspectiondate").val(middleInspectionDateStr);

	shipDate = getDate(shipDateStr);	
	firstInspectionDateDays = 35;
	var firstInspectionDate = subtractDays(shipDate,firstInspectionDateDays);
	firstInspectionDateStr = dateToStr(firstInspectionDate);
	$("#scfirstinspectiondate").val(firstInspectionDateStr);

	shipDate = getDate(shipDateStr);
	productionDateDays = 45;
	var productionDate = subtractDays(shipDate,productionDateDays);
	productionDateStr = dateToStr(productionDate);
	$("#scproductionstartdate").val(productionDateStr);

	shipDate = getDate(shipDateStr);
	graphicsDateDays = 30;
	var graphicsDate = subtractDays(shipDate,graphicsDateDays);
	graphicsDateStr = dateToStr(graphicsDate);
	$("#scgraphicsreceivedate").val(graphicsDateStr);
}
function saveQCSchedule(){
	$("#classcode").val(($( "#classcodeseq option:selected" ).text()));
	if($("#createQCScheduleForm")[0].checkValidity()) {
		showHideProgress()
		$('#createQCScheduleForm').ajaxSubmit(function( data ){
		   showHideProgress();
		   var flag = showResponseToastr(data,null,null,"ibox");
		   if(flag){
			   window.setTimeout(function(){window.location.href = "adminManageQCSchedules.php"},100);
		   }
	    })	
	}else{
		$("#createQCScheduleForm")[0].reportValidity();
	}
}
function getDate(dateString) {
    var parts = dateString.split('-');
    var month = parts[0] - 1;
    var day = parts[1];
    var year = parts[2]
    var dateObj = new Date(year,month,day);
    return dateObj;
}
function dateToStr(date){
	var dd = date.getDate();
	var mm = date.getMonth() + 1; //January is 0!

	var yyyy = date.getFullYear();
	if (dd < 10) {
	  dd = '0' + dd;
	} 
	if (mm < 10) {
	  mm = '0' + mm;
	} 
	var dateStr = mm + '-' +  dd + '-' + yyyy;
	return dateStr;
}
function addDays(date, days) {
   date.setDate(date.getDate() + days);
   return date;
}
function subtractDays(date, days) {
	 var sDate = date;
	 sDate.setDate(sDate.getDate() - days);
	 return sDate;
}
function handleIsCompletedCheckbox(){
	finalinspectiondate = $("#acfinalinspectiondate").val();
    if(finalinspectiondate != null && finalinspectiondate != ''){   
	   //$("#iscompleted").removeAttr("disabled");   
    }else{
       //$("#iscompleted").attr("disabled", 'disabled');   
       //$('#iscompleted').iCheck('uncheck');
	   //$("#iscompleted").removeAttr('checked');
	}
   	
}

</script>