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
						<div id="requestGrid">						
						</div>
						<form id="form1" name="form1" method="post" action="adminCreateUser.php">
							<input type="hidden" id="id" name="id"/>
						</form> 
						<div class="modal fade mt-lg-t" tabindex="-1" role="dialog" 
						aria-hidden="true" id="requestForm" style="margin: auto; max-width: 80%;">
							<?include "progress.php"?>
							<form id="createQCScheduleForm" method="post" action="Actions/QCScheduleAction.php">
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
											<a class="btn btn-default" onclick="closeRequestForm()" type="button" style="width:85%">
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
$(document).ready(function(){
    	loadGrid()	
});

function closeRequestForm(){
	$('#requestForm').modal('hide');
};

function showRequestsDetails(seq, rowId){
    currentRowId = rowId;
    showHideProgress();
    $.getJSON("Actions/RequestAction.php?call=getRequestsDetails&seq=" + seq ,function(data){
	});		
}

function loadGrid(){
	var actions = function (row, columnfield, value, defaulthtml, columnproperties) {
        data = $('#requestGrid').jqxGrid('getrowdata', row);
        var html = "<div style='margin-top:5px;'><a href='javascript:showRequestsDetails(" + data['seq'] + ")'>";
		html += "</div></a>";   
	    return html;
	}
	var columns = [
      { text: 'id', datafield: 'seq' , hidden:true},
	  { text: 'Request Name', datafield: 'title', width:"12%"},
      { text: 'Request Type', datafield: 'requesttypeseq',width:"9%"},     
      { text: 'Requested By', datafield: 'requestedby', width:"20%", cellsrenderer:actions},  
	  { text: 'Assigned To', datafield: 'assignedto', width:"10%", cellsrenderer:actions},          
      { text: 'Last Modified', datafield: 'lastmodifiedon',width:"12%",filtertype: 'date',cellsformat: 'M-dd-yyyy H:mm'},
    ]
   
    var source =
    {
        datatype: "json",
        id: 'id',
        pagesize: 20,
        sortcolumn: 'lastmodifiedon',
        sortdirection: 'desc',
        datafields: [
					{ name: 'seq', type: 'integer' }, 
					{ name: 'title', type: 'string' },
                    { name: 'requesttypeseq', type: 'string' },
                    { name: 'requestedby', type: 'string'},  
					{ name: 'assignedto', type: 'string'},              
                    { name: 'lastmodifiedon', type: 'date' },
                    { name: 'action', type: 'string' } 
        ],                          
        url: 'Actions/RequestAction.php?call=getAllRequests',
        root: 'Rows',
        cache: false,
        beforeprocessing: function(data)
        {        
            source.totalrecords = data.TotalRows;
        },
        filter: function()
        {
            // update the grid and send a request to the server.
            $("#requestGrid").jqxGrid('updatebounddata', 'filter');
        },
        sort: function()
        {
            // update the grid and send a request to the server.
            $("#requestGrid").jqxGrid('updatebounddata', 'sort');
        },
        addrow: function (rowid, rowdata, position, commit) {
            commit(true);
        },
        deleterow: function (rowid, commit) {
            commit(true);
        },
        updaterow: function (rowid, newdata, commit) {
            commit(true);
        }
    };
	var dataAdapter = new $.jqx.dataAdapter(source);
    // initialize jqxGrid
    $("#requestGrid").jqxGrid(
    {
    	width: '100%',
		height: '600',
		source: dataAdapter,
		filterable: true,
		sortable: true,
		autoshowfiltericon: true,
		columns: columns,
		pageable: true,
		altrows: true,
		enabletooltips: true,
		columnsresize: true,
		columnsreorder: true,
		selectionmode: 'checkbox',
		showstatusbar: true,
		virtualmode: true,
		rendergridrows: function (toolbar) {
          return dataAdapter.records;     
   		 },
        renderstatusbar: function (statusbar) {
            var container = $("<div style='overflow: hidden; position: relative; margin: 5px;height:30px'></div>");
            var addButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-plus-square'></i><span style='margin-left: 4px; position: relative;'>Add</span></div>");
            var editButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-edit'></i><span style='margin-left: 4px; position: relative;'>Edit</span></div>");
            var deleteButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-times-circle'></i><span style='margin-left: 4px; position: relative;'>Delete</span></div>");
            var reloadButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-refresh'></i><span style='margin-left: 4px; position: relative;'>Reload</span></div>");
            container.append(addButton);
            container.append(editButton);
            container.append(deleteButton);
            container.append(reloadButton);
            statusbar.append(container);
            editButton.jqxButton({  width: 65, height: 18 });
            addButton.jqxButton({  width: 65, height: 18 });
            deleteButton.jqxButton({  width: 65, height: 18 });
            reloadButton.jqxButton({  width: 70, height: 18 });

			addButton.click(function (event) {
				$('#requestForm').modal('show');
			});
            deleteButton.click(function (event) {
            	deleteRows("requestGrid","Actions/RequestAction.php?call=deleteRequest");
           	});
            editButton.click(function (event){
            	var selectedrowindex = $("#requestGrid").jqxGrid('selectedrowindexes');
                var value = -1;
                indexes = selectedrowindex.filter(function(item) { 
                    return item !== value
                })
                if(indexes.length != 1){
                    bootbox.alert("Please Select single row for edit.", function() {});
                    return;    
                }
                var row = $('#requestGrid').jqxGrid('getrowdata', indexes);
                $("#id").val(row.seq);                        
                $("#form1").submit();    
            });
             $("#requestGrid").bind('rowselect', function (event) {
                 var selectedRowIndex = event.args.rowindex;
                  var pageSize = event.args.owner.rows.records.length - 1;                       
                 if($.isArray(selectedRowIndex)){           
                     if(isSelectAll){
                         isSelectAll = false;    
                     } else{
                         isSelectAll = true;
                     }                                                                     
                     $('#requestGrid').jqxGrid('clearselection');
                     if(isSelectAll){
                         for (i = 0; i <= pageSize; i++) {
                             var index = $('#requestGrid').jqxGrid('getrowboundindex', i);
                             $('#requestGrid').jqxGrid('selectrow', index);
                         }    
                     }
                 }                        
            });
            // reload grid data.
            reloadButton.click(function (event) {
                $("#requestGrid").jqxGrid({ source: dataAdapter });
            });
        }
    });
}
</script>