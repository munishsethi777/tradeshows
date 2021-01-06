<?include("SessionCheck.php");
    require_once('IConstants.inc');
    require_once($ConstantsArray['dbServerUrl'] ."Managers/InstructionManualLogsMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."Managers/InstructionManualCustomersMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."Managers/InstructionManualRequestsMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/InstructionManualLogs.php");
    require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/InstructionManualCustomers.php");
    require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/InstructionManualRequests.php");
    require_once($ConstantsArray['dbServerUrl'] ."Utils/DropdownUtil.php");
    require_once($ConstantsArray['dbServerUrl'] ."Utils/PermissionUtil.php");
    
    $instructionManualLog = new InstructionManualLogs();
    $instructionManualCustomers = new InstructionManualCustomers();
    $instructionManualRequests = new InstructionManualRequests();
    $instructionManualLogsMgr = InstructionManualLogsMgr::getInstance();
    $instructionManualCustomersMgr = InstructionManualCustomersMgr::getInstance();
    $instructionManualRequestsMgr = InstructionManualRequestsMgr::getInstance();
    $instructionManaulSelectedCustomerNames = "";
    $instructionManualSelectedRequests = "";
    $notesToUsa = "";
    $iscompleted = "";
    $isPrivateLabel="";
    if(isset($_POST['id'])){
        $seq = $_POST['id'];
        $instructionManualLog = $instructionManualLogsMgr->findBySeq($seq);
        $instructionManaulSelectedCustomerNames = $instructionManualCustomersMgr->getInstructionManualSelectedCustomerNames($seq);
        $instructionManualSelectedRequests = $instructionManualRequestsMgr->getInstructionManualSelectedRequests($seq);
        if($instructionManualLog->getIsCompleted() ==  1){
            $iscompleted = "checked";
        }else{
            $iscompleted = "";
        }
        if($instructionManualLog->getIsPrivateLabel() ==  1){
            $isPrivateLabel = "checked";
        }else{
            $isPrivateLabel = "";
        }
    }
    $instructionManualUsaTeamTabIndex = "";
    $instructionManualChinaTeamTabIndex = "";
    $instructionManualTechnicalTeamTabIndex = "";
    $permissionUtil = PermissionUtil::getInstance();
    $hasInstructionManualUsaTeamPermission = $permissionUtil->hasInstructionManualUsaTeamPermission();
    $hasInstructionManualChinaTeamPermission = $permissionUtil->hasInstructionManualChinaTeamPermission();
    $hasInstructionManualTechnicalTeamPermission = $permissionUtil->hasInstructionManualTechnicalTeamPermission();
    if(!$hasInstructionManualUsaTeamPermission){
        $instructionManualUsaTeamTabIndex = -1;
    }
    if(!$hasInstructionManualChinaTeamPermission){
        $instructionManualChinaTeamTabIndex = -1;
    }
    if(!$hasInstructionManualTechnicalTeamPermission){
        $instructionManualTechnicalTeamTabIndex = -1;
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin | Instruction Manual Log</title>
        <?include "ScriptsInclude.php"?>
        <style type="text/css">
            .col-form-label{
                font-weight:400 !important;
                line-height: 1.2 !important;
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
            #graphicstatus{
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
                                <h5 class="pageTitle">Create/Edit Instruction Manual Log</h5>
                        </nav>
                    </div>
                    <div class="ibox-content">
                        <?include "progress.php"?>  
                        <form id="createInstructionManualLogsForm" method="post" action="Actions/InstructionManualLogsAction.php" class="m-t-lg">
                            <input type="hidden" id ="call" name="call"  value="saveInstructionManualLog"/>
                            <input type="hidden" id ="seq" name="seq"  value="<?php echo $instructionManualLog->getSeq()?>"/>
                            <div class="bg-white1 p-xs outterDiv usadiv" style="position:relative">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label bg-formLabelPeach">To be Filled by USA Team</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label bg-formLabelPeach">Entered By:</label>
                                    <div class="col-lg-4">
                                        <?php 
                                                $select = DropDownUtils::getInstructionManualUSATeamUsers("createdby", "", $instructionManualLog->getCreatedBy(),false,true);
                                                echo $select;
                                        ?>
                                    </div>
                                    <label class="col-lg-2 col-form-label bg-formLabelPeach">Entry Date :</label>
                                    <div class="col-lg-4">
                                        <div class="input-group date">
                                            <input tabindex="<?php echo $instructionManualUsaTeamTabIndex?>" type="text" id="entrydate" onchange="entryDateOnChange(this.value)" maxLength="250" value="<?php echo $instructionManualLog->getEntryDate()?>" name="entrydate" class="form-control dateControl currentdatepicker datepicker" >
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label bg-formLabelPeach">PO Ship Date :</label>
                                    <div class="col-lg-4">
                                        <div class="input-group date">
                                            <input tabindex="<?php echo $instructionManualUsaTeamTabIndex?>" type="text" id="poshipdate" onchange="poDateOnChange(this.value)" maxLength="250" value="<?php echo $instructionManualLog->getPoShipDate()?>" name="poshipdate" class="form-control dateControl" >
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <label class="col-lg-2 col-form-label bg-formLabelPeach">Approved IM due for print :</label>
                                    <div class="col-lg-4">
                                        <div class="input-group date">
                                            <input tabindex="<?php echo $instructionManualUsaTeamTabIndex?>" type="text" id="approvedmanualdueprintdate"  maxLength="250" value="<?php echo $instructionManualLog->getApprovedManualDuePrintDate()?>" name="approvedmanualdueprintdate" class="form-control dateControl" >
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label bg-formLabelPeach">Item no. :</label>
                                    <div class="col-lg-4">
                                        <input tabindex="<?php echo $instructionManualUsaTeamTabIndex?>" type="text"  maxLength="25" value="<?php echo $instructionManualLog->getItemNumber()?>" id="itemnumber" name="itemnumber" class="form-control">
                                    </div>
                                    <label class="col-lg-2 col-form-label bg-formLabelPeach">Class Code</label>
                                    <div class="col-lg-4">
                                        <input type="hidden" name="classcode" id="classcode">
                                        <?php 
                                                $select = DropDownUtils::getClassCodes("classcodeseq","",$instructionManualLog->getClassCodeSeq(),false,true,false);
                                                echo $select;
                                            ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label bg-formLabelPeach">Diagram due date :</label>
                                    <div class="col-lg-4">
                                        <div class="input-group date">
                                            <input tabindex="<?php echo $instructionManualUsaTeamTabIndex?>" type="text" id="graphicduedate"  maxLength="250" value="<?php echo $instructionManualLog->getGraphicDueDate()?>" name="graphicduedate" class="form-control" readonly>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <label class="col-lg-2 col-form-label bg-formLabelPeach">New or Revised : </label>
                                    <div class="col-lg-4">
                                        <?php 
                                                $select = DropDownUtils::getInstructionManualNewOrRevised("neworrevised","",$instructionManualLog->getNewOrRevised(),false,false,false);
                                                echo $select;
                                            ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label bg-formLabelPeach">Instruction Manual Type :</label>
                                    <div class="col-lg-4">
                                        <?php 
                                                $select = DropDownUtils::getInstructionManualType("instructionmanualtype","",$instructionManualLog->getInstructionManualType(),false,false,false);
                                                echo $select;
                                            ?>
                                    </div>
                                    <label class="col-lg-2 col-form-label bg-formLabelPeach">Customers : </label>
                                    <div class="col-lg-4">
                                        <?php 
                                                $select = DropDownUtils::getCustomerNameType("usacustomers[]",'',$instructionManaulSelectedCustomerNames,$instructionManualCustomers->getCustomerName(),false,true,true);
                                                echo $select;
                                            ?>
                                    </div>
                                </div>
                                <div class="form-group row i-checks">
                                    <label class="col-lg-2 col-form-label bg-formLabelPeach">Requested changes :</label>
                                    <div class="col-lg-4">
                                        <?php 
                                                $select = DropDownUtils::getInstructionManualRequestedChanges("requestedchanges[]",'',$instructionManualSelectedRequests,$instructionManualRequests->getRequestType(),false,true,true);
                                                echo $select;
                                        ?>
                                    </div>
                                    <label class="col-lg-2 col-form-label bg-formLabelPeach"> Is Private Label :</label>
                                    <div class="col-lg-4 ">
                                        <input type="checkbox" <?php echo $isPrivateLabel ?> name="isprivatelabel"/>
                                    </div>  
                                </div>
                                <div class="form-group row">
                                    <div class="panel panel-peach">
                                        <div class="panel-heading">Notes to China Office</div>
                                        <div class="panel-body">
                                            <textarea class="form-control" maxLength="1000" name="notestochina" ><?php echo $instructionManualLog->getNotesToChina()?></textarea>
                                        </div>    
                                    </div>
                                </div>
                                
                            </div>
                            <div class="bg-white1 p-xs outterDiv chinadiv" style="position:relative">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label bg-formLabelYellow">To be Filled by China Team</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label bg-formLabelYellow">Date diagram saved :</label>
                                    <div class="col-lg-4">
                                        <div class="input-group date">
                                            <input tabindex="<?php echo $instructionManualChinaTeamTabIndex?>" type="text" id="diagramsaveddate"  maxLength="250" value="<?php echo $instructionManualLog->getDiagramSavedDate()?>" name="diagramsaveddate" class="form-control dateControl">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <label class="col-lg-2 col-form-label bg-formLabelYellow">Diagram saved by : </label>
                                    <div class="col-lg-4">
                                        <?php 
                                                $select = DropDownUtils::getInstructionManualChinaTeamUsers("diagramsavedbyuserseq","",$instructionManualLog->getDiagramSavedByUserSeq(),false,false,false);
                                                echo $select;
                                            ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="panel panel-yellow">
                                        <div class="panel-heading">Notes to USA Office</div>
                                        <div class="panel-body">
                                            <textarea tabindex="instructionManualChinaTeamTabIndex" class="form-control" maxLength="1000" name="notestousa" >
                                                <?php echo $instructionManualLog->getNotesToUsa()?>
                                            </textarea>
                                        </div>    
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white1 p-xs outterDiv technicaldiv" style="position:relative">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label bg-formLabelMauve">To be Filled by Technical Writer</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label bg-formLabelMauve">Assigned to :</label>
                                    <div class="col-lg-4">
                                        <?php 
                                                $select = DropDownUtils::getInstructionManualTechnicalWriterUsers("assignedtouser","",$instructionManualLog->getAssignedToUser(),false,false,false);
                                                echo $select;
                                            ?>
                                    </div>
                                    <label class="col-lg-2 col-form-label bg-formLabelMauve">Status : </label>
                                    <div class="col-lg-4">
                                        <?php 
                                                $select = DropDownUtils::getInstructionManualLogStatus("instructionmanuallogstatus","statusChange(this.value)",$instructionManualLog->getInstructionManualLogStatus(),false,false,false);
                                                echo $select;
                                            ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label bg-formLabelMauve">Start date :</label>
                                    <div class="col-lg-4">
                                        <div class="input-group date">
                                            <input tabindex="<?php //echo $usaTabIndex?>" type="text" id="starteddate"  maxLength="250" value="<?php echo $instructionManualLog->getStartedDate()?>" name="starteddate" class="form-control" readonly>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                        </div>
                                    </div>
                                    <label class="col-lg-2 col-form-label bg-formLabelMauve">Supervisor return : </label>
                                    <div class="col-lg-4">
                                        <div class="input-group date">
                                            <input tabindex="<?php //echo $usaTabIndex?>" type="text" id="supervisorreturndate"  maxLength="250" value="<?php echo $instructionManualLog->getSupervisorReturnDate()?>" name="supervisorreturndate" class="form-control dateControl">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>   
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label bg-formLabelMauve">Manager Return :</label>
                                    <div class="col-lg-4">
                                        <div class="input-group date">
                                            <input tabindex="<?php //echo $usaTabIndex?>" type="text" id="managerreturndate"  maxLength="250" value="<?php echo $instructionManualLog->getManagerReturnDate()?>" name="managerreturndate" class="form-control dateControl">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <label class="col-lg-2 col-form-label bg-formLabelMauve">Buyer return : </label>
                                    <div class="col-lg-4">
                                        <div class="input-group date">
                                            <input tabindex="<?php //echo $usaTabIndex?>" type="text" id="buyerreturndate"  maxLength="250" value="<?php echo $instructionManualLog->getBuyerReturnDate()?>" name="buyerreturndate" class="form-control dateControl" >
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>     
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label bg-formLabelMauve">Sent to china :</label>
                                    <div class="col-lg-4">
                                        <div class="input-group date">
                                            <input tabindex="<?php //echo $usaTabIndex?>" type="text" id="senttochinadate"  maxLength="250" value="<?php echo $instructionManualLog->getSentToChinaDate()?>" name="senttochinadate" class="form-control" readonly>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row i-checks">
                                    <label class="col-lg-2 col-form-label bg-formLabelMauve"> Is Completed :</label>
                                    <div class="col-lg-4">
                                        <input type="checkbox" <?php echo $iscompleted ?> name="iscompleted"/>
                                    </div>
                                </div>                         
                            </div>
                            <div class="bg-white p-xs">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label"></label>
                                    <div class="col-lg-2">
                                        <button class="btn btn-primary" onclick="saveInstructionManualLog()" type="button" style="width:85%">
                                            Save
                                        </button>
                                    </div>
                                    <div class="col-lg-2">
                                        <a class="btn btn-default" href="adminManageInstructionManualLogs.php" type="button" style="width:85%">
                                            Cancel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
var index = 0;
$(document).ready(function(){
	$('.dateControl').datetimepicker({
	    timepicker:false,
	    format:'m-d-Y',
	    scrollMonth : false,
		scrollInput : false,
		onSelectDate:function(ct,$i){
			//setDuration();
		}
	});
    $("#usacustomers").chosen({width:"100%"});
    $("#requestedchanges").chosen({width:"100%"});
    $('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
	   	radioClass: 'iradio_square-green',
    });
    var hasInstructionManualUsaTeamPermission = "<?php echo $hasInstructionManualUsaTeamPermission?>";
	var hasInstructionManualChinaTeamPermission = "<?php echo $hasInstructionManualChinaTeamPermission?>";
	var hasInstructionManualTechnicalTeamPermission = "<?php echo $hasInstructionManualTechnicalTeamPermission?>";
	
	if(hasInstructionManualUsaTeamPermission != "1"){
		disabledDiv("usadiv")
	}
	if(hasInstructionManualChinaTeamPermission != "1"){
		disabledDiv("chinadiv")
	}
	if(hasInstructionManualTechnicalTeamPermission != "1"){
		disabledDiv("technicaldiv")
    }
    function disabledDiv(divClass){
	var disableDivHtml = '<div style="position: absolute;top:0;left:0;width: 100%;height:100%;z-index:2;opacity:0.4;filter: alpha(opacity = 50)"></div>';
	$('.'+divClass).fadeTo('slow',.6);
	$('.'+divClass).append(disableDivHtml);
}
});
function saveInstructionManualLog(){
	if($("#createInstructionManualLogsForm")[0].checkValidity()) {
		showHideProgress()
		$('#createInstructionManualLogsForm').ajaxSubmit(function( data ){
		   showHideProgress();
		   var flag = showResponseToastr(data,null,null,"ibox");
		   if(flag){
			   window.setTimeout(function(){window.location.href = "adminManageInstructionManualLogs.php"},100);
		   }
	    })	
	}else{
		$("#createInstructionManualLogsForm")[0].reportValidity();
	}
}
function poDateOnChange(poShipDateStr){
	if(poShipDateStr == ""){
        $("#approvedmanualdueprintdate").val("");
        return;
	}
	var poShipDate = getDate(poShipDateStr);
	var approvedManualDueDays = 21;
	var approvedManualDueDate = subtractDays(poShipDate, approvedManualDueDays);
    var approvedManualDueDateStr  = dateToStr(approvedManualDueDate);
    $("#approvedmanualdueprintdate").val(approvedManualDueDateStr);
}
function entryDateOnChange(entryDateStr){
	if(entryDateStr == ""){
        $("#graphicduedate").val("");
		return;
	}
	var entryDate = getDate(entryDateStr);
	var diagramDueDays = 14;
    var diagramDueDate = addDays(entryDate,diagramDueDays);
    var diagramDueDateStr = dateToStr(diagramDueDate);
    $("#graphicduedate").val(diagramDueDateStr);
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
function subtractDays(date, days) {
    var sDate = date;
    sDate.setDate(sDate.getDate() - days);
    return sDate;
}
function addDays(date, days) {
    var sDate = date;
    sDate.setDate(sDate.getDate() + days);
    return sDate;
}
function statusChange(selectedStatus){
    var startDate = $("#starteddate").val();
    var sentToChinaDate = $("#senttochinadate").val();
    if((selectedStatus == "in_progress" && startDate =="") || (selectedStatus == "sent_to_china" && sentToChinaDate =="")){
        $.getJSON("Actions/InstructionManualLogsAction.php?call=getloggedInUserTime", 
            (response) => {
                if(selectedStatus == "in_progress"){
                    $("#starteddate").val(response);
                }else{
                    $("#senttochinadate").val(response);
                }
                
            }
        );
    }
}
</script>
