<?include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/QCSchedule.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestLogMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DropdownUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/PermissionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/UserConfigurationMgr.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/ReportingDataParameterType.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/UserConfigurationType.php");

$userMgr = UserMgr::getInstance();
$permissionUtil = PermissionUtil::getInstance();
$hasQCReadonly = $permissionUtil->hasQCReadonly();
$sessionUtil = SessionUtil::getInstance();
$loggedInUserSeq = $sessionUtil->getUserLoggedInSeq();
$userRoles = $userMgr->getUserRolesArr($loggedInUserSeq);
$requestLogMgr = RequestLogMgr::getInstance();
$isRequester = 0;
// $isRequester = in_array('request_management_requester',$userRoles);
$userRoles = $userMgr->getUserRolesArr($loggedInUserSeq);
$allReportingDataParameters = ReportingDataParameterType :: getAll();
if(in_array(Permissions::getName(Permissions::request_management_employee), $userRoles)){
	unset($allReportingDataParameters[ReportingDataParameterType::getName((ReportingDataParameterType::request_management_unassigned))]);
}

$userConfigurationMgr = UserConfigurationMgr::getInstance();
$userSeq = $sessionUtil->getUserLoggedInSeq();
$analyticsDivExpandedUserConfigKey = "AnalyticsRequestDivExpanded";
$isAnalyticsDivExpandedUserConfigValue = $userConfigurationMgr->getConfigurationValue($userSeq,$analyticsDivExpandedUserConfigKey,"1");
$analyticsDivState = "collapsed";
if($isAnalyticsDivExpandedUserConfigValue){
	$analyticsDivState = "";
}
$defaultFilterSelectionUserConfigKey = UserConfigurationType::getName("RequestManagementDefaultFilterSelection");
$defaultFilterSelectionReportDataType = $userConfigurationMgr->getConfigurationValue($userSeq,$defaultFilterSelectionUserConfigKey,"request_management_all_request");
$exportLimit =5000;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Projects Management</title>
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

.attachmentsMainOuter:hover .attachmentCrossBtn{
	visibility:visible;
}
.attachmentCrossBtn{
	position:absolute; right:-5px;top:-10px;font-size:20px;color:red;
	visibility: hidden;
}
.reportBlock{
    width:20%;
}
</style>
<script src="scripts/createRequest.js"></script>
<script src="scripts/UserConfigurations.js"></script>
<script src="scripts/GridDataByReportingParameter.js"></script>
</head>
<body>
	<?include "exportInclude.php"?>
	<input id="isAnalyticsDivExpandedUserConfigValue" class="isAnalyticsDivExpandedUserConfigValue" type="hidden" name="isAnalyticsDivExpandedUserConfigValue" value="<?php echo $isAnalyticsDivExpandedUserConfigValue;?>" />
    <input id="analyticsDivExpandedUserConfigKey" class="analyticsDivExpandedUserConfigKey" type="hidden" value="<?php echo $analyticsDivExpandedUserConfigKey; ?>" />
	<input id="defaultFilterSelectionUserConfigKey" class="defaultFilterSelectionUserConfigKey" type="hidden" value="<?php echo $defaultFilterSelectionUserConfigKey; ?>" />
    <input id="defaultFilterSelectionReportDataType" class="defaultFilterSelectionReportDataType" type="hidden" value="<?php echo $defaultFilterSelectionReportDataType; ?>" />
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
								<h5 class="pageTitle">Create Project</h5>
						</nav>
					</div>
					<div class="ibox-content" style="background-color:#fafafa;padding-bottom:0px;">
						<div class="ibox <?php echo $analyticsDivState ?>" style="border:1px #e7eaec solid">
							<div class="ibox-title">
								<h5>Project Management Analytics</h5>&nbsp;
								<div id="currentFiterAppliedNameDiv" style="display:inline;">
									&nbsp;Current Filter Applied : 
									<span id="currentFiterAppliedName"></span>
								</div>
								<div class="ibox-tools">
									<a class="collapse-link">
										<i class="fa fa-chevron-up" id="analyticsDivExpandedIcon"></i>
									</a>
								</div>
							</div>
							<div class="ibox-content" style="background-color:#fafafa;padding-bottom:0px;">
								<div class="row reportDataCountRow">
									<input id="gridId" type="hidden" name="gridId" value="requestGrid"/>
									<?php 
										foreach($allReportingDataParameters as $key => $value){
											if(strpos($key,'request_management_') !== false){
												?>
												
												<div class="col-lg-2 reportBlock" >
													<div class="ibox float-e-margins reportFilterBlock bg-white" id="<?php echo $key ?>">
														<div class="ibox-content text-center" id="<?php echo $key."_ibox_content"?>">
															<div class='reportFilterBlockTools floatRightTools'>
																<i title="Apply Filter" alt="Apply Filter" style="font-size:14px" class="fa fa-filter" id="<?php echo $key;?>" ></i>
																<!-- <	i title="Show Graph" alt="Show Graph" class="fa fa-bar-chart" id="<?php echo $key . "_show_graph";?>" ></> -->
																<i title="Export Data" alt="Export Data" style="font-size:14px" class="fa fa-file-excel-o filterExportDataIcon" id="<?php echo $key . "_export_date";?>" ></i>
															</div>
															
															<h1 class="no-margins" id='<?php echo $key ?>_current'></h1>
															<div class="col-lg-12 stat-percent font-bold text-info" id='<?php echo $key ?>_change_color' >
																<i class="fa" id='<?php echo $key ?>_change_arrow'></i>
																<span class="text-center" id='<?php echo $key ?>_diff'></span>
																<span id='<?php echo $key ?>_percent'></span>
															</div>
															<small id="analyticName" class="analyticName"><?php echo $value ?></small>
														</div>
													</div>
												</div>
												<?php 
											}
										} 
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="ibox-content">
						<div id="requestGrid">						
						</div>
						<form id="form1" name="form1" method="post" action="adminCreateUser.php">
							<input type="hidden" id="id" name="id"/>
						</form> 
						<div class="modal fade mt-lg-t" tabindex="-1" role="dialog" aria-hidden="true" id="requestFormDiv" style="margin: auto; max-width: 80%;overflow-x:hidden !important;overflow-y:auto !important">
							<input id="seq" type="hidden" name="seq" value=""/>
							<div class="bg-white p-xs outterDiv">
								<div class="form-group row">
									<lable class="col-lg-2 col-form-label bg-formLabelDarkSm">
										<b><span>Project Code</span> - <span id='code'></span></b>
									</label>
								</div>
								<?php if (in_array(Permissions::getName(Permissions::request_management_manager), $userRoles)){?>
    								<div class="form-group row" <?php if (!in_array(Permissions::getName(Permissions::request_management_manager), $userRoles)){}?>>
    									<label class="col-lg-2 col-form-label bg-formLabelPeach">Assigned By</label>
    									<div class="col-lg-4">
											<select id="assignedbyseq" class='form-control' required></select>
    									</div>
    									<label class="col-lg-2 col-form-label bg-formLabelPeach">Assigned To</label>
    									<div class="col-lg-4">
											<select id="assignedtoseq" class='form-control' required></select>
    									</div>
    								</div>
    							<?php }else{?>
									<input id="assignedbyseq" type="hidden" name="assignedbyseq"/>
									<input id="assignedtoseq" type="hidden" name="assignedtoseq"/>
									<?php }?>
								<div class="form-group row">
									<label class="col-lg-2 col-form-label bg-formLabelMauve">Department</label>
									<div class="col-lg-4">
										<?php
											$select = DropDownUtils::getRequestDepartments("department", 'onChangeDepartment(this.value)', '', true);
											echo $select;
										?>
									</div>
									<label class="col-lg-2 col-form-label bg-formLabelMauve">Project Type</label>
									<div class="col-lg-4">
										<select id="requesttypeseq" class='form-control' onchange="onRequestTypeChange(this)" required></select>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-2 col-form-label bg-formLabelMauve">Priority</label>
									<div class="col-lg-4">
										<?php 
											$select = DropDownUtils::getRequestPriority("priority", null,'',false,true);
											echo $select;
										?>
									</div>
									<label class="col-lg-2 col-form-label bg-formLabelMauve">Project Due Date</label>
									<div class="col-lg-4">
										<div class='input-group date' >
											<input type='text' id='duedate' name='
											' class='form-control dateControl datepicker' required>
											<span class='input-group-addon'><i class='fa fa-calendar'></i></span>
										</div>
									</div>
								</div>
								<?php if (in_array(Permissions::getName(Permissions::request_management_employee), $userRoles) || in_array(Permissions::getName(Permissions::request_management_manager), $userRoles)){?>
    								<div class="form-group row">
										<label class="col-lg-2 col-form-label bg-formLabelYellow">Status</label>
										<div class="col-lg-4">
											<select id="requeststatusseq" class="col-lg-4 form-control" name="requeststatusseq"></select>
										</div>
										
									</div>
								<?php }?>
							</div> 
							<form id="requestSpecsFieldsForm" method="post">
								<div class="bg-white p-xs outterDiv" style="background-color:rgb(236, 255, 237)">
									<div id="requestSpecsFields"></div>
								</div>
							</form>
							
							<div class="bg-white p-xs outterDiv">
								<?php if (in_array(Permissions::getName(Permissions::request_management_employee), $userRoles) || in_array(Permissions::getName(Permissions::request_management_manager), $userRoles)){?>
    								<div class="form-group row">
    									<label class="col-lg-2 col-form-label bg-formLabelYellow">Assignee Due Date</label>
    									<div class="col-lg-4">
    										<div class='input-group date' >
    											<input type='text' id='assigneeduedate' name='assigneeduedate' class='form-control dateControl datepicker' readonly>
    											<span class='input-group-addon'><i class='fa fa-calendar'></i></span>
    										</div>
    									</div>
    									<label class="col-lg-2 col-form-label bg-formLabelYellow">Estimated Hours</label>
    									<div class="col-lg-4">
    										<input id="estimatedhours" class="form-control" type="number" name="estimatedhours"/>
    									</div>
    								</div>
    								<div class="form-group row">
    									<label class="col-lg-2 col-form-label bg-formLabelYellow">Requires Manager Approvel</label>
    									<div class="col-lg-4">
    										<?php 
    											$select = DropDownUtils::getBooleanDropDown("isrequiredapprovalfrommanager", 'null','1',false,true);
    											echo $select;
    										?>
    									</div>
    									<label class="col-lg-2 col-form-label bg-formLabelYellow">Requires Requester's Approvel</label>
    									<div class="col-lg-4">
    										<?php 
    											$select = DropDownUtils::getBooleanDropDown("isrequiredapprovalfromrequester", null,'0',false,true);
    											echo $select;
    										?>
    									</div>
    								</div>
    								<div class="form-group row i-checks">
    									<label class="col-lg-2 col-form-label bg-formLabelYellow">Requires Robby's Approvel</label>
    									<div class="col-lg-4">
    										<?php 
    											$select = DropDownUtils::getBooleanDropDown("isrequiredapprovalfromrobby", null,'0',false,true);
    											echo $select;
    										?>
    									</div>
    									
    									<label class="col-lg-2 col-form-label bg-formLabel" style="background-color:#0d879d">Project Completed</label>
										<div class="col-lg-4">
											<input type="checkbox" class="i-checks form-control pull-left" id="iscompleted" name="iscompleted"/>
										</div>
    								</div>
    							<?php }?>
								<div class="bg-white p-xs">
									<div class="form-group row">
										<div class="col-lg-2 pull-right">
											<a class="btn btn-default" onclick="closeRequestForm()" type="button" style="width:85%">
												Close
											</a>
										</div>
										<div class="col-lg-2 pull-right">
											<button class="btn btn-primary" onclick="saveRequest(this)" type="button" style="width:85%">
												Save
											</button>
										</div>
										<div class="col-lg-2 pull-right">
											<button class="btn btn-primary" onclick="saveRequestAndClose(this)" type="button" style="width:85%">
												Save and Close
											</button>
										</div>
									</div>
								</div>
								<form action="Actions/RequestAction.php" class="dropzone" id="requestAttachmentDropzoneForm" enctype="multipart/form-data">
									<input type="hidden" name="call" value="saveRequestAttachment" />
									<input type="hidden" id="requestSeqForRequestAttachment" name="requestseq" value="" />
									<input type="hidden" id="requestTypeSeqForRequestAttachment" name="requesttypeseq" value="" />
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
													<input id="lastUpdatedHistorySeq" type="hidden" value="">
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
	<form id="exportLogsForm" name="exportLogsForm" method="post" action="Actions/RequestAction.php">
    	<input type="hidden" name="call" value="exportFilterData" />
    	<input type="hidden" name="filterId" id="filterId" />
    </form>
</body>
</html>
<script type="text/javascript">
var defaultFilterSelectionReportDataType = $("#defaultFilterSelectionReportDataType").val();
var defaultFilterSelectionUserConfigKey = $("#defaultFilterSelectionUserConfigKey").val();
var source ;
var selectedRows = [];
$(document).ready(function(){
	loadGrid();
	loadReportingData('request_management_');
	$('.dateControl').datetimepicker({
		timepicker:false,
		format:'m-d-Y',
		scrollMonth : false,
		scrollInput : false,
		minDate : 0,
		onSelectDate:function(ct,$i){
			//setDuration();
		}
	});
	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
	   	radioClass: 'iradio_square-green',
	});
	$(".filterExportDataIcon").click(function(){
		var filterId = $(this).attr('id');
		$("#exportLogsForm #filterId").val(filterId);
		$("#exportLogsForm").submit();
	});
	var gridId = $("#gridId").val();
	$(".fa-filter").click(function (){
		var reportingParameter = $(this).attr("id");
		var filterExportBtnId = $(this).parents(".reportFilterBlockTools").find(".filterExportDataIcon").attr("id");
		var currentFiterAppliedName = $("#" + reportingParameter).find("#analyticName").html();
		applyReportingFilterForRequestManagement(reportingParameter,gridId,currentFiterAppliedName,defaultFilterSelectionUserConfigKey);
		$(".get-grid-data-by-reporting-data, .ibox-content").removeClass("dataFilterBlockSelected");
		$("#"+reportingParameter +" .ibox-content").removeClass("bg-white");
		$("#"+reportingParameter + " .ibox-content").addClass("dataFilterBlockSelected");
		$("#exportFormForRequests input[name=filterId").val(filterExportBtnId);
	});
	if(defaultFilterSelectionReportDataType != ''){
		$("#" + defaultFilterSelectionReportDataType + " .ibox-content").addClass("dataFilterBlockSelected");
		$("#" + defaultFilterSelectionReportDataType +" .fa-filter").click();
	} 
	$("#exportBtnForRequests").click(function(e) {
		exportFinal(e, this);
	});
});
Dropzone.autoDiscover = false;
const requestAttachmentDropzone = new Dropzone('#requestAttachmentDropzoneForm', {
	autoProcessQueue : false,
	url : 'Actions/RequestAction.php?call=saveRequestAttachment',
	addRemoveLinks: true, 
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
		   loadHistory();
        });
	}
	
});
Dropzone.options.imageUpload = {
    maxFilesize:1,
    acceptedFiles: ".jpeg,.jpg,.png,.gif,.xls,.pdf,.xlsx,.csv"
  };
function loadGrid(){
	var actions = function(row, columnfield, value, defaulthtml, columnproperties) {
            data = $('#requestGrid').jqxGrid('getrowdata', row);
            var html = "<div style='text-align: center; margin-top:1px;font-size:18px'>";
            html += "<a href='javascript:editButtonClick(" + data['seq'] + ")' ><i class='fa fa-edit' title='Edit Requests Fields'></i></a>";
            html += "</div>";
            return html;
        }
	var cellsRenderer = function (row, column, value, rowData){
		data = $('#requestGrid').jqxGrid('getrowdata', row);
		if (data['assignedto.fullname'] == null){
            return '<span style="font-weight: 600;">' + rowData + '</span>';
        }else{
            return rowData;
        }
    };
	var priorityTypes = ["Highest", "High", "Medium", "Low", "Lowest"];
	var columns = [
		{ text: 'Edit',datafield: 'Actions',cellsrenderer: actions,width: '3%',sortable: false,filterable: false},
		{ text: 'id', datafield: 'seq' , hidden:true},
		{ text: 'Department', datafield: 'requests.department', width:"10%",cellsrenderer: cellsRenderer},
// 		{ text: 'Request Name', datafield: 'title', width:"12%"},	
		{ text: 'Project No', datafield: 'requests.code', width:"10%",cellsrenderer: cellsRenderer},
		{ text: 'Priority',datafield: 'requests.priority',width: "10%",hidden: false,filtertype: 'checkedlist',filteritems: priorityTypes,filtercondition: 'equal',sortable: false,cellsrenderer: cellsRenderer},
		{ text: 'Project Type', datafield: 'requesttypes.title',width:"10%",cellsrenderer: cellsRenderer}, 
		{ text: 'Requested By', datafield: 'createdby.fullname', width:"10%",cellsrenderer: cellsRenderer},
		{ text: 'Assigned By', datafield: 'assignedby.fullname', width:"12%",cellsrenderer: cellsRenderer},	
		{ text: 'Assigned To', datafield: 'assignedto.fullname', width:"10%",cellsrenderer: cellsRenderer},       
		{ text: 'Status', datafield: 'requeststatuses.title', width:"5%",cellsrenderer: cellsRenderer},
		{ text: 'Is Completed',datafield: 'requests.iscompleted', columntype: 'checkbox',width: "5%"},
		{ text: 'Last Modified', datafield: 'requests.lastmodifiedon',width:"11%",filtertype: 'date',cellsformat: 'M-d-yyyy hh:mm tt',cellsrenderer: cellsRenderer},
    ]
   
    source =
    {
        datatype: "json",
        id: 'id',
        pagesize: 20,
        sortcolumn: 'requests.lastmodifiedon',
        sortdirection: 'desc',
        datafields: [
			{ name: 'id', type: 'integer' },
			{ name: 'seq', type: 'integer' }, 
			{ name: 'requests.department', type: 'integer' },
			{ name: 'requests.code', type: 'string' },
			{ name: 'requests.priority', type: 'string' },
            { name: 'requesttypes.title', type: 'string' },
            { name: 'createdby.fullname', type: 'string'},
			{ name: 'assignedby.fullname', type: 'string'},  
			{ name: 'assignedto.fullname', type: 'string'},
			{ name: 'requests.iscompleted',type: 'boolean'},              
            { name: 'requests.lastmodifiedon', type: 'date' },
			{ name: 'requeststatuses.title', type: 'string'},
            { name: 'action', type: 'string' } 
        ],                          
        url: '',
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
		showfilterrow:true,
		rendergridrows: function (toolbar) {
          return dataAdapter.records;     
   		 },
        renderstatusbar: function (statusbar) {
            var container = $("<div style='overflow: hidden; position: relative; margin: 5px;height:30px'></div>");
            var addButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-plus-square'></i><span style='margin-left: 4px; position: relative;'>Add</span></div>");
            var editButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-edit'></i><span style='margin-left: 4px; position: relative;'>Edit</span></div>");
            var deleteButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-times-circle'></i><span style='margin-left: 4px; position: relative;'>Delete</span></div>");
			var exportButton = $("<div title='Export Data' alt='Export Data' style='float: left; margin-left: 5px;'><i class='fa fa-file-excel-o'></i><span style='margin-left: 4px; position: relative;'>Export</span></div>");
            var reloadButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-refresh'></i><span style='margin-left: 4px; position: relative;'>Reload</span></div>");
            container.append(addButton);
            container.append(exportButton);
            container.append(reloadButton);
            container.append(deleteButton);
            statusbar.append(container);
            editButton.jqxButton({  width: 65, height: 18 });
            addButton.jqxButton({  width: 65, height: 18 });
            deleteButton.jqxButton({  width: 65, height: 18 });
            reloadButton.jqxButton({  width: 70, height: 18 });
			exportButton.jqxButton({  width: 65, height: 18 });

			addButton.click(function (event) {
				$("#seq").val("");
				$(".commentsAndHistoryDiv").hide();
				$("#requestFormDiv #requestSpecsFields").html("<center><small>Select request type to display related fields</small></center>");
				$("#requestFormDiv #department").val("");
				$("#requestFormDiv #code").text("");
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
				$("#lastUpdatedHistorySeq").val('');
				// $("#requestAttachmentDropzoneForm").empty('');
				$('#requestFormDiv').modal('show');
				$("#loadHistory,#loadComments").html("");
    			$("#saveRequestLogComments").prop('disabled','true');
				$("#iscompleted").iCheck("uncheck")
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
			exportButton.click(function(event) {
				filterQstr = getFilterString("requestGrid");
				exportItemsConfirm(filterQstr);
			});
        }
    });
	$('#requestGrid').on('rowselect', function(event) {
		var args = event.args;
		var rowBoundIndex = args.rowindex;
		var rowData = args.row;
		selectedRows[rowBoundIndex] = rowData;
	});
	$('#requestGrid').on('rowunselect', function(event) {
		var args = event.args;
		var rowBoundIndex = args.rowindex;
		delete selectedRows[rowBoundIndex];
	});
}
function exportItemsConfirm(filterString) {
	var selectedRowIndexes = $("#requestGrid").jqxGrid('selectedrowindexes');
	$('#exportModalFormForRequests').modal('show');
	$("#queryStringForRequests").val(filterString);
}
function exportFinal(e, btn) {
	var exportOption = $('input[name=exportOptionForRequests]:checked').val()
	var rowscount = 0;
	var limit = <?php echo $exportLimit ?>;
	if (exportOption == "selectedRows") {
		var selectedRowIndexes = $("#requestGrid").jqxGrid('selectedrowindexes');
		if (selectedRowIndexes.length > 0) {} else {
			noRowSelectedAlert();
			return;
		}
		rowscount = selectedRowIndexes.length;
		if (rowscount > limit) {
			bootbox.alert("Cannot export more than <?php echo $exportLimit ?> rows!", function() {});
			return;
		}
		var ids = [];
		$.each(selectedRowIndexes, function(index, value) {
			if (value != -1) {
				var dataRow = selectedRows[value];
				ids.push(dataRow.seq);
			}
		});
		$("#requestSeqs").val(ids);
	} else {
		// var datainformation = $('#reuqestGrid').jqxGrid('getdatainformation');
		// rowscount = datainformation.rowscount;
		$("#requestSeqs").val("");
	}
	e.preventDefault();
	var l = Ladda.create(btn);
	l.start();
	$('#exportFormForRequests').submit();
	l.stop();
	$('#exportFormForRequests').modal('hide');
	$('#requestGrid').jqxGrid('clearselection');
}

</script>