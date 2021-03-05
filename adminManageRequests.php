<?include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/QCSchedule.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestLogMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DropdownUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/PermissionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");

$userMgr = UserMgr::getInstance();
$permissionUtil = PermissionUtil::getInstance();
$hasQCReadonly = $permissionUtil->hasQCReadonly();
$sessionUtil = SessionUtil::getInstance();
$loggedInUserSeq = $sessionUtil->getUserLoggedInSeq();
$userRoles = $userMgr->getUserRolesArr($loggedInUserSeq);
$requestLogMgr = RequestLogMgr::getInstance();
$isRequester = 0;
// $isRequester = in_array('request_management_requester',$userRoles);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Requests Module</title>
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
div#myDropZone {
    width: 100px;
    height: 100px;
    background-color: gray;
}
#apmiddleinspectiondatenareason,
#apfirstinspectiondatenareason,
#apgraphicsreceivedatenareason{
	margin-bottom:0px !important;
}
.requestLogCommentsAvatar{
	height: 40px; width: 40px; border-radius: 50%;
	align-items: center; display: flex; justify-content: center; 
	font-size: 16px; color:white;padding-top:10px;
	float:left;margin-right:10px;background-color:#72c8e7;
}
.tab-content{
	padding: 15px;
}
.fa-arrow-right{
	margin:0 15px;
}
#attachmentsRow{
	overflow-x: auto;
}
.dropzone{
    min-height:200px !important;
}
</style>
<script src="scripts/createRequest.js"></script>
</head>
<body>
    <div id="wrapper">
		<?php include("adminmenuInclude.php")?>  
		<input id="loggedInUserSeq" type="hidden" name="loggedinuserseq" value="<?php echo $loggedInUserSeq;?>" />
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
						<div class="modal fade mt-lg-t" tabindex="-1" role="dialog" aria-hidden="true" id="requestFormDiv" style="margin: auto; max-width: 80%;">
							<input id="seq" type="hidden" name="seq" value=""/>
							<div class="bg-white p-xs outterDiv">
								<?php if (in_array(Permissions::request_management_assignee, $userRoles) || in_array(Permissions::request_management_manager, $userRoles)){?>
    								<div class="form-group row">
    									<label class="col-lg-2 col-form-label bg-formLabel">Assigned By</label>
    									<div class="col-lg-4">
    										<?php
    											$select = DropDownUtils::getUsersForDDByPermission("assignedbyseq", '', '', true, true, "Manager");
    											echo $select;
    										?>
    									</div>
    									<label class="col-lg-2 col-form-label bg-formLabel">Assigned To</label>
    									<div class="col-lg-4">
    										<?php
    											$select = DropDownUtils::getUsersForDDByPermission("assignedtoseq", '', '', true, true, "Assignee");
    											echo $select;
    										?>
    									</div>
    								</div>
    							<?php }?>
								<div class="form-group row">
									<label class="col-lg-2 col-form-label bg-formLabel">Department</label>
									<div class="col-lg-4">
										<?php
											$select = DropDownUtils::getDepartmentType("departmentseq", 'onChangeDepartment(this.value)', '', true, true);
											echo $select;
										?>
									</div>
									<label class="col-lg-2 col-form-label bg-formLabel">Request Type</label>
									<div class="col-lg-4">
										<select id="requesttypeseq" class='form-control' onchange="onRequestTypeChange(this)"></select>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-2 col-form-label bg-formLabel">Priority</label>
									<div class="col-lg-4">
										<?php 
											$select = DropDownUtils::getRequestPriority("priority", null,'',false,true);
											echo $select;
										?>
									</div>
									<label class="col-lg-2 col-form-label bg-formLabel">Status</label>
									<div class="col-lg-4">
										<select id="requeststatusseq" class="col-lg-4 form-control" name="requeststatusseq"></select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-2 col-form-label bg-formLabel">Project Due Date</label>
									<div class="col-lg-4">
										<div class='input-group date' >
											<input type='text' id='duedate' name='
											' class='form-control dateControl datepicker' readonly>
											<span class='input-group-addon'><i class='fa fa-calendar'></i></span>
										</div>
									</div>
								</div>
							</div> 
							<form id="requestSpecsFieldsForm" method="post">
								<div class="bg-white p-xs outterDiv" style="background-color:rgb(236, 255, 237)">
									<div id="requestSpecsFields"></div>
								</div>
							</form>
							
							<div class="bg-white p-xs outterDiv">
								<?php if (in_array(Permissions::request_management_assignee, $userRoles) || in_array(Permissions::request_management_manager, $userRoles)){?>
    								<div class="form-group row">
    									<label class="col-lg-2 col-form-label bg-formLabel">Assignee Due Date</label>
    									<div class="col-lg-4">
    										<div class='input-group date' >
    											<input type='text' id='assigneeduedate' name='assigneeduedate' class='form-control dateControl datepicker' readonly>
    											<span class='input-group-addon'><i class='fa fa-calendar'></i></span>
    										</div>
    									</div>
    									<label class="col-lg-2 col-form-label bg-formLabel">Estimated Hours</label>
    									<div class="col-lg-4">
    										<input id="estimatedhours" class="form-control" type="number" name="estimatedhours"/>
    									</div>
    								</div>
    								<div class="form-group row">
    									<label class="col-lg-2 col-form-label bg-formLabel">Requires Manager Approvel</label>
    									<div class="col-lg-4">
    										<?php 
    											$select = DropDownUtils::getBooleanDropDown("isrequiredapprovalfrommanager", 'null','1',false,true);
    											echo $select;
    										?>
    									</div>
    									<label class="col-lg-2 col-form-label bg-formLabel">Requires Requester's Approvel</label>
    									<div class="col-lg-4">
    										<?php 
    											$select = DropDownUtils::getBooleanDropDown("isrequiredapprovalfromrequester", null,'0',false,true);
    											echo $select;
    										?>
    									</div>
    								</div>
    								<div class="form-group row">
    									<label class="col-lg-2 col-form-label bg-formLabel">Requires Robby's Approvel</label>
    									<div class="col-lg-4">
    										<?php 
    											$select = DropDownUtils::getBooleanDropDown("isrequiredapprovalfromrobby", null,'0',false,true);
    											echo $select;
    										?>
    									</div>
    								</div>
    							<?php }?>
								<div class="bg-white p-xs">
									<div class="form-group row ">
										<div class="col-lg-2 pull-right">
											<a class="btn btn-default" onclick="closeRequestForm()" type="button" style="width:85%">
												Close
											</a>
										</div>
										<div class="col-lg-2 pull-right">
											<button class="btn btn-primary" onclick="saveRequest()" type="button" style="width:85%">
												Save
											</button>
										</div>
									</div>
								</div>
								<form action="Actions/RequestAction.php" class="dropzone" id="requestAttachmentDropzoneForm" enctype="multipart/form-data">
									<input type="hidden" name="call" value="saveRequestAttachment" />
									<input type="hidden" id="requestSeqForRequestAttachment" name="requestseq" value="" />
									<div class="fallback">
										<input id="requestattachmentfilename" name="requestattachmentfilename[]" type="file" multiple />
									</div>
								</form>
								
								<div class='row p-sm m-xs' id='attachmentsRow'></div>
								
								<div class="form-group row m-t-sm commentsAndHistoryDiv">
									<div class="col-lg-12">
										<div class="row">
											<ul class="nav nav-tabs" role="tablist">
												<li class="primaryLI active"><a class="nav-link" data-toggle="tab"  href="#tab-1"> Comments</a></li>
												<li class="darkLI"><a class="nav-link" data-toggle="tab" href="#tab-2">History</a></li>
											</ul>
										</div>
										<div class="row">
											<div class="tab-content">
												<div role="tabpanel" id="tab-1" class="tab-pane active">
													<div id="loadComments"></div>
													<textarea id="commentBox" class="form-control" name="commentbox" ></textarea>
													<button id="saveRequestLogComments" type="button" class="btn btn-primary m-t-sm" disabled>Save</button>
													<!-- <button id="commentCancelBtn" type="button" class="btn btn-light">Cancel</button> -->
												</div>
												<div role="tabpanel" id="tab-2" class="tab-pane">
													<div id="loadHistory"></div>
												</div>
											</div>
										</div>
									</div>
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
<script type="text/javascript">
$(document).ready(function(){
	loadGrid()	
	$('.dateControl').datetimepicker({
		timepicker:false,
		format:'m-d-Y',
		scrollMonth : false,
		scrollInput : false,
		onSelectDate:function(ct,$i){
			//setDuration();
		}
	});
});
Dropzone.autoDiscover = false;
const requestAttachmentDropzone = new Dropzone('#requestAttachmentDropzoneForm', {
	autoProcessQueue : false,
	url : 'Actions/RequestAction.php?call=saveRequestAttachment',
	init : function(){
		this.on("success", function(file, responseJson) {
		   var response = JSON.parse(responseJson);
		   $("#attachmentsRow").append(response.data);
        });
		this.on("processing", function(){
			this.options.autoProcessQueue = true;
		});
		this.on("complete", function(file) {
		   this.removeFile(file);
        });
	}
});
Dropzone.options.imageUpload = {
    maxFilesize:1,
    acceptedFiles: ".jpeg,.jpg,.png,.gif"
  };
function loadGrid(){
	var actions = function(row, columnfield, value, defaulthtml, columnproperties) {
            data = $('#requestGrid').jqxGrid('getrowdata', row);
            var html = "<div style='text-align: center; margin-top:1px;font-size:18px'>";
            html += "<a href='javascript:editButtonClick(" + data['seq'] + ")' ><i class='fa fa-edit' title='Edit Requests Fields'></i></a>";
            html += "</div>";
            return html;
        }
	var columns = [
		{ text: 'Edit',datafield: 'Actions',cellsrenderer: actions,width: '3%',filterable: false},
		{ text: 'id', datafield: 'seq' , hidden:true},
		{ text: 'Department', datafield: 'departmenttitle', width:"13%"},
// 		{ text: 'Request Name', datafield: 'title', width:"12%"},
		{ text: 'Request Code', datafield: 'code', width:"10%"},
		{ text: 'Priority', datafield: 'priority', width:"5%"},
		{ text: 'Request Type', datafield: 'requesttypetitle',width:"10%"}, 
		{ text: 'Requested By', datafield: 'createdbyfullname', width:"10%"},
		{ text: 'Assigned By', datafield: 'assignedbyfullname', width:"10%"},	
		{ text: 'Assigned To', datafield: 'assignedtofullname', width:"10%"},       
		{ text: 'Status', datafield: 'requeststatustitle', width:"8%"},
		{ text: 'Last Modified', datafield: 'lastmodifiedon',width:"10%",filtertype: 'date',cellsformat: 'M-d-yyyy hh:mm tt'},
    ]
   
    var source =
    {
        datatype: "json",
        id: 'id',
        pagesize: 20,
        sortcolumn: 'lastmodifiedon',
        sortdirection: 'desc',
        datafields: [
			{ name: 'id', type: 'integer' },
			{ name: 'seq', type: 'integer' }, 
			{ name: 'departmenttitle', type: 'integer' },
			{ name: 'title', type: 'string' },
			{ name: 'code', type: 'string' },
			{ name: 'priority', type: 'string' },
            { name: 'requesttypetitle', type: 'string' },
            { name: 'createdbyfullname', type: 'string'},
			{ name: 'assignedbyfullname', type: 'string'},  
			{ name: 'assignedtofullname', type: 'string'},              
            { name: 'lastmodifiedon', type: 'date' },
			{ name: 'requeststatustitle', type: 'string'},
            { name: 'action', type: 'string' } 
        ],                          
        url: 'Actions/RequestAction.php?call=getAllRequestsForGrid',
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
//             container.append(editButton);
//             container.append(deleteButton);
            container.append(reloadButton);
            statusbar.append(container);
            editButton.jqxButton({  width: 65, height: 18 });
            addButton.jqxButton({  width: 65, height: 18 });
            deleteButton.jqxButton({  width: 65, height: 18 });
            reloadButton.jqxButton({  width: 70, height: 18 });

			addButton.click(function (event) {
				$("#seq").val("");
				$(".commentsAndHistoryDiv").hide();
				$("#requestFormDiv #requestSpecsFields").html("<center><small>Select request type to display related fields</small></center>");
				$("#requestFormDiv #departmentseq").val("");
				$("#requestFormDiv #requesttypeseq").empty();
				$("#requestFormDiv #requeststatusseq ").empty();
				$("#requestFormDiv #seq").val("");
				$("#requestFormDiv #duedate").val('');
				$("#requestFormDiv #estimatedHours").val('');
				$("#requestFormDiv #isrequiredapprovalfrommanager").val('');
				$("#requestFormDiv #isrequiredapprovalfromrequester").val('');
				$("#requestFormDiv #isrequiredapprovalfromrobby").val('');
				$("#requestFormDiv #assigneeDueDate").val('');
				$("#requestFormDiv #assignedbyseq").val('');
        		$("#requestFormDiv #assignedtoseq").val('');
				// $("#requestAttachmentDropzoneForm").empty('');
				$('#requestFormDiv').modal('show');
				$("#loadHistory,#loadComments").html("");
    			$("#saveRequestLogComments").prop('disabled','true');
				requestAttachmentDropzone.removeAllFiles(true);
				requestAttachmentDropzone.options.autoProcessQueue = false;
				$("#attachmentsRow").html("");
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