<?php
include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Manage Users</title>
    <?include "ScriptsInclude.php"?>
</head>
<body>
   <div id="wrapper">
   		<?php include("adminmenuInclude.php")?>
   		 <div id="page-wrapper" class="gray-bg">
	        <div class="row border-bottom">
	        	<div class="row">
		            <div class="col-lg-12">
		            	<div class="ibox">
		                    <div class="ibox-title">
		                    	 <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
									<a class="navbar-minimalize minimalize-styl-2 btn btn-primary "
										href="#"><i class="fa fa-bars"></i> </a>
										<h4 class="p-h-sm font-normal">Manage users</h4>
								 </nav>
		                     </div>
		                     <div class="ibox-content">
		                     	<div id="usersGrid"></div>
		                     </div>
	                    </div>	
		            </div>
	            </div>
	        </div>
	     </div>
   </div>
   <form id="form1" name="form1" method="post" action="adminCreateUser.php">
     	<input type="hidden" id="id" name="id"/>
   	</form> 
    <div class="modal inmodal bs-example-modal-lg" id="containerDetailModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content animated fadeInRight">
				<div class="modal-body itemDetailsModalDiv mainDiv">
					<div class="ibox">
						<div class="ibox-content">  
							<div class="row">
								<div class="col-sm-12">
                                        <h3>User Details</h3>
                                        <div class="form-group row m-t-sm">
                                            <label class="col-sm-2 lblTitle bg-formLabelDarkSm">Email:</label>
                                            <div class="col-sm-3"><label class="email text-primary "></label></div>
                                            <label class="col-sm-2 lblTitle bg-formLabelDarkSm">Password:</label>
                                            <div class="col-sm-3"><label class="password text-primary"></label></div>
                                        </div>
                                        <div class="form-group row m-t-sm">    
                                            <label class="col-sm-2 lblTitle bg-formLabelDarkSm">Full Name:</label>
                                            <div class="col-sm-3"><label class="fullname text-primary"></label></div> 
                                            <label class="col-sm-2 lblTitle bg-formLabelDarkSm">Mobile:</label>
                                            <div class="col-sm-3"><label class="mobile text-primary"></label></div>
                                        </div>   
                                        <div class="form-group row m-t-sm">
                                            <label class="col-sm-2 lblTitle bg-formLabelDarkSm">Time Zone:</label>
                                            <div class="col-sm-3"><label class="usertimezone text-primary"></label></div>
                                            <label class="col-sm-2 lblTitle bg-formLabelDarkSm">User Type:</label>
                                            <div class="col-sm-3"><label class="usertype text-primary"></label></div>
                                        </div>
                                </div>
                               
                                <div class="form-group row i-checks m-t-xl" id="checkboxes">
										<div class="col-lg-12"><h3>Departments</h3>
											<div class="panel panel-primary">
                                                <div class="panel-heading">
													<div class="pull-left m-r-sm" style="pointer-events: none;">
														<input type="checkbox" class="i-checks"
															 value="1"
															id="qcDepartment" name="departments[]" />
													</div>
													QC Schedules
												</div>

												<div id="qcPermissionsDiv" class="panel-body i-checks" style="pointer-events: none;"    >
													<label class="col-lg-3 col-form-label"> <input
														type="checkbox"  value="qc"
														id="qcpermission" name="permissions[]" /> Quality
														Controller
													</label> 
                                                    <label class="col-lg-3 col-form-label"> <input
														type="checkbox" value="po_incharge" id="poinchargepermission"
														name="permissions[]" /> PO Incharge
													</label> 
                                                    <label class="col-lg-3 col-form-label "> <input
														type="checkbox" value="class_code" id="classcodepermission"
														name="permissions[]" /> Class Code
													</label> 
                                                    <label class="col-lg-3 col-form-label"> <input
														type="checkbox" 
														value="weekly_mail_button" id="weeklymailbuttonpermission"
														name="permissions[]" /> Weekly Mail Button
													</label> 
                                                    <label class="col-lg-3 col-form-label"> <input
														type="checkbox" value="qc_planner_button" id="qcplannerbuttonpermission"
														name="permissions[]" /> Qc Planner Button
													</label> 
                                                    <label class="col-lg-3 col-form-label"> <input
														type="checkbox" value="approved_reject_notification"
														id="qcapprovalrejectpermission" name="permissions[]" />
														Approved/Reject Notification
													</label>
                                                    <label class="col-lg-3 col-form-label">QC/PO Incharge Code :</label>
													    <div class="col-lg-2 col-form-label"><b><span style="text-transform:uppercase" class="qccode">
                                                        </span></b></div>
													<label class="col-lg-12 col-form-label"> <input
														type="checkbox" value="qc_isreadonly" id="qcreadonlypermission"
														name="permissions[]" /> QC Readonly (<small>Removed
															Add/Save/Import/Notifications/Approve buttons</small>)
													</label>
					                            </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="panel panel-primary">
												<div class="panel-heading">
													<div class="pull-left m-r-sm" style="pointer-events: none;">
                                                            <input type="checkbox" value="2" id="graphicDepartment" name="departments[]" />
                                                    </div>
                                                    Graphic Logs
                                                </div>
                                                    <div id="graphicPermissionsDiv" class="panel-body i-checks" style="pointer-events: none;"   >
                                                        <label class="col-lg-3 col-form-label"> <input type="checkbox" value="usa_team" id="usaTeamPermission"
                                                            name="permissions[]" /> USA Team
                                                                    </label> 
                                                        <label class="col-lg-3 col-form-label"> <input type="checkbox" value="china_team" id="chinaTeamPermission"
                                                            name="permissions[]" /> China Team
                                                                    </label> 
                                                        <label class="col-lg-3 col-form-label"> <input type="checkbox" value="graphic_designer" id="graphicDesignerPermission"
                                                            name="permissions[]" /> Graphic Designer
                                                                    </label>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">     
                                            <div class="panel panel-primary">
												<div class="panel-heading">
													<div class="pull-left m-r-sm" style="pointer-events: none;">
														<input type="checkbox" value="4" id="containerDepartment" name="departments[]"/>
													</div>
													Container Schedule
												</div>
												<div id='containerPermissionsDiv' class="panel-body i-checks" style="pointer-events: none;" >
													<label class="col-lg-3 col-form-label bg-formLabelDark m-r-sm"><input type="checkbox" value="container_information" id="containerpermission"
														name="permissions[]" /> Container Information
													    </label> 
                                                    <label class="col-lg-3 col-form-label bg-formLabelMauve m-r-sm"><input type="checkbox" value="container_delivery_information" id="containerdevilerypermission" 
                                                        name="permissions[]" />  Delivery Information 
                                                        </label> 
                                                    <label class="col-lg-3 col-form-label bg-formLabelBrown"><input type="checkbox" value="container_office_information" id="containerofficepermission" 
                                                        name="permissions[]" /> Office Information
													    </label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-12">
											<div class="panel panel-primary">
												<div class="panel-heading">
													<div class="pull-left m-r-sm" style="pointer-events: none;">
														<input type="checkbox" value="10" id="instructionManualDepartment" name="departments[]" />
													</div>
													Instruction Manual Logs
												</div>
												<div id='instructionManualPermissionsDiv'
													class="panel-body i-checks" style="pointer-events: none;"   >
													<label class="col-lg-3 col-form-label bg-formLabelPeach m-r-sm"><input type="checkbox" value="instruction_manual_usa_team" id="instructionmanualusateampermission"
														name="permissions[]" /> USA Team
													        </label> 
                                                    <label class="col-lg-3 col-form-label bg-formLabelYellow m-r-sm"><input type="checkbox" value="instruction_manual_china_team" id="instructionmanualchinateampermission" 
                                                        name="permissions[]" />	China Team
													        </label> 
                                                    <label class="col-lg-3 col-form-label bg-formLabelMauve"><input type="checkbox" value="instruction_manual_technical_team" id="instructionmanualtechnicalteampermission" 
                                                        name="permissions[]" readonly="readonly" />	Technical Team
													    </label> 
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="col-lg-12">
											<div class="panel panel-primary">
												<div class="panel-heading">
													<div class="pull-left m-r-sm" style="pointer-events: none;">
														<input type="checkbox" value="10" id="requestManagementDepartment" name="departments[]" />
													</div>
													Request Management
												</div>
												<div id='requestManagementPermissionsDiv'
													class="panel-body i-checks" style="pointer-events: none;"   >
													<label class="col-lg-3 col-form-label bg-formLabelPeach m-r-sm"><input type="checkbox" value="request_management_manager" id="requestmanagerpermission"
														name="permissions[]" /> Manager
													        </label> 
                                                    <label class="col-lg-3 col-form-label bg-formLabelYellow m-r-sm"><input type="checkbox" value="request_management_assignee" id="requestassigneepermission" 
                                                        name="permissions[]" />	Assignee
													        </label> 
                                                    <label class="col-lg-3 col-form-label bg-formLabelMauve"><input type="checkbox" value="request_management_requester" id="requestrequesterpermission" 
                                                        name="permissions[]" readonly="readonly" />	Requester
													    </label> 
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="col-lg-12">
											<div class="panel panel-primary">
												<div class="panel-heading">
													<div class="pull-left m-r-sm" style="pointer-events: none;">
														<input type="checkbox" value="9" id="shippingDepartment" name = "departments[]">
													</div>
													Shipping Logs 
												</div>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="panel panel-primary">
												<div class="panel-heading">
													<div class="pull-left m-r-sm" style="pointer-events: none;">
														<input type="checkbox" value="7" id="customerDepartment" name="departments[]" />
													</div>
													Customer Management
												</div>
											</div>
                                        </div>
											<div class="col-lg-12">
												<div class="panel panel-primary">
													<div class="panel-heading">
														<div class="pull-left m-r-sm" style="pointer-events: none;">
															<input type="checkbox" value="5" id="userDepartment" name="departments[]" />
														</div>
														User Management
													</div>
												</div>
                                            </div>
												<div class="col-lg-12">
													<div class="panel panel-primary">
														<div class="panel-heading">
															<div class="pull-left m-r-sm" style="pointer-events: none;">
																<input type="checkbox" id="emailDepartment" name="departments[]" />
															</div>
															Email Logs Management
														</div>
													</div>
                                                </div>
													<div class="col-lg-12">
														<div class="panel panel-primary">
															<div class="panel-heading">
																<div class="pull-left m-r-sm" style="pointer-events: none;">
																	<input type="checkbox" value="3" id="itemSpecificsDepartment" name="departments[]" />
																</div>
																Item Specifications
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
            </div>
        </div>
    </div>     
</body>
<script type="text/javascript">
$(document).ready(function(){
	//$.get("Actions/TaskCategoryAction.php?call=getAllTaskCategories", function(data){
    	loadGrid()
	//});
});

function editShow(seq){
	$("#id").val(seq);                        
    $("#form1").submit();
}
isSelectAll = false;  
function showUserDetails(seq, rowId){
    currentRowId = rowId;
    showHideProgress();
    $.getJSON("Actions/UserAction.php?call=getUserDetails&seq=" + seq ,function(data){
        showHideProgress();
        var item = data.user;  
        var dept = data.userDepartments;    
        var userRoles = data.userRoles;
        var Qcdept = dept.includes("QC Schedules");
        var Graphicsdept = dept.includes("Graphics Logs");
        var Containerdept = dept.includes("Container Schedules");
        var InstructionManualdept = dept.includes("Instruction Manual");
        var RequestManagementdept = dept.includes("Request Management "); 
        var ShippingLogsdept = dept.includes("Shipping Logs");
        var CustomerMagmtdept = dept.includes("Manage Customers");
        var UserMgmtdept = dept.includes("Users");
        var EmailLogsMgmtdept = dept.includes("Email Logs");
        var ItemSpecdept = dept.includes("Item Specs");

        $('#containerDetailModal').modal('show'); 
            $.each(item, function(key, val){

                    $("." + key).html(val);
                });   
        $('#qcPermissionsDiv').iCheck('uncheck')
        $('#qcDepartment').iCheck('uncheck') 
        $('#graphicPermissionsDiv').iCheck('uncheck')
        $('#graphicDepartment').iCheck('uncheck') 
        $('#containerPermissionsDiv').iCheck('uncheck')
        $('#containerDepartment').iCheck('uncheck') 
        $('#instructionManualPermissionsDiv').iCheck('uncheck')
        $('#instructionManualDepartment').iCheck('uncheck')   
        $('#requestManagementPermissionsDiv').iCheck('uncheck')
        $('#requestManagementDepartment').iCheck('uncheck')   
        $('#shippingDepartment').iCheck('uncheck')  
        $('#customerDepartment').iCheck('uncheck')  
        $('#userDepartment').iCheck('uncheck')  
        $('#emailDepartment').iCheck('uncheck')  
        $('#itemSpecificsDepartment').iCheck('uncheck')            
        if(Qcdept){
            $('#qcDepartment').prop('checked', true);
        }if(userRoles.includes("QC")){
            $("#qcpermission").prop('checked', true);
        }if(userRoles.includes("PO Incharge")){
            $("#poinchargepermission").prop('checked', true);
        }if(userRoles.includes("Class Code")){
            $("#classcodepermission").prop('checked', true);  
        }if(userRoles.includes("Weekly Mail Button")){
            $("#weeklymailbuttonpermission").prop('checked', true);
        }if(userRoles.includes("Qc Planner Button")){
            $("#qcplannerbuttonpermission").prop('checked', true);
        }if(userRoles.includes("Approved/Reject Notification")){
            $("#qcapprovalrejectpermission").prop('checked', true);
        }if(userRoles.includes("Readonly")){
            $("#qcreadonlypermission").prop('checked', true);
        }if(Graphicsdept){
            $("#graphicDepartment").prop('checked', true);
        }if(userRoles.includes("USA Team")){    
            $("#usaTeamPermission").prop('checked', true);
        }if(userRoles.includes("China Team")){  
            $("#chinaTeamPermission").prop('checked', true);  
        }if(userRoles.includes("Graphic Designer")){
            $("#graphicDesignerPermission").prop('checked', true);
        }if(Containerdept){
            $('#containerDepartment').prop('checked', true);
        }if(userRoles.includes("Container Information")){ 
            $("#containerpermission").prop('checked', true);
        }if(userRoles.includes("Container Delivery Information")){    
            $("#containerdevilerypermission").prop('checked', true);
        }if(userRoles.includes("Container Office Information")){
		    $("#containerofficepermission").prop('checked', true);
        }if(InstructionManualdept){
            $("#instructionManualDepartment").prop('checked', true);   
        }if(userRoles.includes("Instruction Manual USA Team")){    
            $("#instructionmanualusateampermission").prop('checked', true);
        }if(userRoles.includes("Instruction Manual China Team")){    
            $("#instructionmanualchinateampermission").prop('checked', true);
        }if(userRoles.includes("Instruction Manual Technical Team")){    
            $("#instructionmanualtechnicalteampermission").prop('checked', true);  
        }if(RequestManagementdept){
            $("#requestManagementDepartment").prop('checked', true);   
        }if(userRoles.includes("Manager")){    
            $("#requestmanagerpermission").prop('checked', true);
        }if(userRoles.includes("Assignee")){    
            $("#requestassigneepermission").prop('checked', true);
        }if(userRoles.includes("Requester")){    
            $("#requestrequesterpermission").prop('checked', true);  
        }if(ShippingLogsdept){
            $("#shippingDepartment").prop('checked',true);
        }if(CustomerMagmtdept){
            $("#customerDepartment").prop('checked',true);
        }if(UserMgmtdept){
            $("#userDepartment").prop('checked',true);
        }if(EmailLogsMgmtdept){
            $("#emailDepartment").prop('checked',true);
        }if(ItemSpecdept){
            $("#itemSpecificsDepartment").prop('checked',true);
        }
        $('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
	   	radioClass: 'iradio_square-green',
        });
        
    });           
}; 



function loadGrid(){
	var actions = function (row, columnfield, value, defaulthtml, columnproperties) {
        data = $('#usersGrid').jqxGrid('getrowdata', row);
        var html = "<div style='margin-top:5px;'><a href='javascript:showUserDetails(" + data['seq'] + ")'>";
            if(data["usertype"] == "SUPERVISOR"){
                html +=data["email"] + " <i class='fa fa-asterisk' title='Supervisor'></i>";
                html += "</div></a>";  
            }
                else{
                    html += data["email"];
                    html += "</div></a>";   
                }
	    return html;
    }
         

    var columns = [
      { text: 'id', datafield: 'seq' , hidden:true},
      { text: 'Email', datafield: 'email', width:"19%", cellsrenderer:actions},
      { text: 'User Type', datafield: 'usertype', width:"0%", hidden:true},
      { text: 'FullName', datafield: 'fullname',width:"12%"},
      { text: 'Roles', datafield: 'roles',width:"20%",filterable:false},
      { text: 'QC Code', datafield: 'qccode',width:"7%"},
      { text: 'Enabled', datafield: 'isenabled',width:"7%",columntype:"checkbox"},
      { text: 'Notifications', datafield: 'issendnotifications',width:"8%",columntype:"checkbox"},
      { text: 'Last Modified', datafield: 'lastmodifiedon',width:"12%",filtertype: 'date',cellsformat: 'M-dd-yyyy H:mm'},
      { text: 'Last LoggedIn', datafield: 'lastloggedindate',width:"12%",filtertype: 'date',cellsformat: 'M-dd-yyyy H:mm'}
    ]
   
    var source =
    {
        datatype: "json",
        id: 'id',
        pagesize: 20,
        sortcolumn: 'lastmodifiedon',
        sortdirection: 'desc',
        datafields: [{ name: 'seq', type: 'integer' }, 
                    { name: 'email', type: 'string' }, 
                    { name: 'usertype', type: 'string' },
                    { name: 'fullname', type: 'string' },
                    { name: 'roles', type: 'string' },
                    { name: 'isenabled', type: 'boolean' },
                    { name: 'issendnotifications', type: 'boolean' },
                    { name: 'qccode', type: 'string' },
                    { name: 'createdon', type: 'date' },
                    { name: 'lastmodifiedon', type: 'date' },
                    { name: 'lastloggedindate', type: 'date' },
                    { name: 'action', type: 'string' } 
                    ],                          
        url: 'Actions/UserAction.php?call=getAllUsers',
        root: 'Rows',
        cache: false,
        beforeprocessing: function(data)
        {        
            source.totalrecords = data.TotalRows;
        },
        filter: function()
        {
            // update the grid and send a request to the server.
            $("#usersGrid").jqxGrid('updatebounddata', 'filter');
        },
        sort: function()
        {
            // update the grid and send a request to the server.
            $("#usersGrid").jqxGrid('updatebounddata', 'sort');
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
    $("#usersGrid").jqxGrid(
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
            // create new row.
            addButton.click(function (event) {
                location.href = ("adminCreateUser.php");
            });
            deleteButton.click(function (event) {
            	deleteRows("usersGrid","Actions/UserAction.php?call=deleteUser");
           	});
            editButton.click(function (event){
            	var selectedrowindex = $("#usersGrid").jqxGrid('selectedrowindexes');
                var value = -1;
                indexes = selectedrowindex.filter(function(item) { 
                    return item !== value
                })
                if(indexes.length != 1){
                    bootbox.alert("Please Select single row for edit.", function() {});
                    return;    
                }
                var row = $('#usersGrid').jqxGrid('getrowdata', indexes);
                $("#id").val(row.seq);                        
                $("#form1").submit();    
            });
             $("#usersGrid").bind('rowselect', function (event) {
                 var selectedRowIndex = event.args.rowindex;
                  var pageSize = event.args.owner.rows.records.length - 1;                       
                 if($.isArray(selectedRowIndex)){           
                     if(isSelectAll){
                         isSelectAll = false;    
                     } else{
                         isSelectAll = true;
                     }                                                                     
                     $('#usersGrid').jqxGrid('clearselection');
                     if(isSelectAll){
                         for (i = 0; i <= pageSize; i++) {
                             var index = $('#usersGrid').jqxGrid('getrowboundindex', i);
                             $('#usersGrid').jqxGrid('selectrow', index);
                         }    
                     }
                 }                        
            });
            // reload grid data.
            reloadButton.click(function (event) {
                $("#usersGrid").jqxGrid({ source: dataAdapter });
            });
        }
    });
}
</script>