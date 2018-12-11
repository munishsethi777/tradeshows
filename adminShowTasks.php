<?include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ShowMgr.php");
$showSeq = $_POST["showSeq"];
$showMgr = ShowMgr::getInstance();
$show = $showMgr->findBySeq($showSeq);

// $session = SessionUtil::getInstance();
// $userSeq = $session->getUserLoggedInSeq();
// $showMgr = ShowMgr::getInstance();
// $shows = $showMgr->getUpcomingShowsByUser($userSeq);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Show Tasks Management</title>
    <?include "ScriptsInclude.php"?>
</head>
<body>
<div id="wrapper">
<?php include("adminmenuInclude.php")?>  
	<div id="page-wrapper" class="gray-bg">
		<div class="row border-bottom"></div>
        <div class="row">
			<div class="col-lg-12">
	        	<div class="ibox">
					<div class="ibox-title">
						<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
								<a class="navbar-minimalize minimalize-styl-2 btn btn-primary "
									href="#"><i class="fa fa-bars"></i> </a>
									<h4 class="p-h-sm font-normal"> Tradeshow Tasks</h4>
						</nav>
						
					</div>
					<div class="ibox-content">
		                     	<div class="row">
									<h4> Various Tasks assigned for tradeshow : "<?php echo $show->getTitle();?>"</h4>
								</div>
		                     	<div class="row">
		                     		<div id="showGrid"></div>
		                     		
		                     		<a class="m-t-s button btn btn-primary btn-sm" href="adminShowList.php">Show all TradeShows</a>
		                     	</div>
		                     </div>
	                    </div>	
		            </div>
	            </div>
	        </div>
	     </div>

<!-- Modal Box for update comments and status -->  
<div class="modal inmodal bs-example-modal-md" id="taskDetailsModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
    	<div class="modal-content animated fadeInRight">
          <div class="modal-body productDetailModalDiv mainDiv">
            <div class="ibox">
             <div class="ibox-content">
             	<?php include 'progress.php';?>
                <div class="row">
                    <div class="col-sm-12">
                    <h3>Task Details</h3>
                    <small>You can update task details with comments and status</small>
                    <form id="updateShowTaskDetailsForm" enctype="multipart/form-data" method="post" action="Actions/TaskAction.php" class="m-t-lg">
                        <input type="hidden" id ="call" name="call" value="updateShowTaskDetails"/>
                        <input type="hidden" id ="showTaskSeq" name="seq"/>
                        <div class="form-group row">
                       		<label class="col-lg-2 col-form-label">Task</label>
                           	<div class="col-lg-10">
                            	<input type="text" disabled="disabled" class="form-control taskDetailsTitle">
                           </div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2 col-form-label">Description</label>
                           	<div class="col-lg-10">
                            	<input type="text" disabled="disabled" class="form-control taskDetailsDescription">
                           </div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2 col-form-label">Starts On</label>
                           	<div class="col-lg-10">
                            	<input type="text" disabled="disabled" class="form-control taskDetailsStartsOn">
                           </div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2 col-form-label">Ends On</label>
                           	<div class="col-lg-10">
                            	<input type="text" disabled="disabled" class="form-control taskDetailsEndsOn">
                           </div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2 col-form-label">Comments</label>
                           	<div class="col-lg-10">
                            	<textarea name="comments" maxLength="500" class="form-control taskDetailsComments"></textarea>
                           </div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2 col-form-label">Status</label>
                           	<div class="col-lg-10">
                            	<select name="status" class="form-control taskDetailsStatus">
                            		<option value="pending">Pending</option>
                            		<option value="inprocess">In Process</option>
                            		<option value="completed">Completed</option>
                            		
                            	</select>
                           </div>
                        </div>
                        
                        <div class="form-group row">
	                        <div >
	                        	<label class="col-lg-2 col-form-label">Uploaded Files</label>
	                        	<div id="selectedFilesDiv" class="col-lg-10">
	                        		
	                        	</div>
	                        </div>
                        </div>
                        
                         <div class="form-group row fileUpload">
                       		<label class="col-lg-2 col-form-label">New File</label>
                       		<div class="col-lg-6">
	                           	<div class="form-control">
	                            	<input name="files[]" type="file">
	                           </div>
	                       </div>
	                        <label class="col-lg-2 col-form-label">
	                        	<input name="ispublic[]" type="checkbox"> Public
	                       </label>
				        </div>
	                    <div class="fileUplaodRow">
	                    		
	                    </div>
                        <div class="row">
                     		<label class="col-lg-12 text-right"><button type="button" class="btn btn-white btn-xs addMore" > + More File</button></label>
                     	</div>
                     </form>
                    </div>
                </div>
                </div>
                </div>
           	</div>
            <div class="modal-footer">
            	<button type="button" class="btn btn-primary saveTaskDetails" >Save</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
   
</body>
<script type="text/javascript">
$(document).ready(function(){
	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green',
	});
	$('.showSelect').on('change', function() {
		loadGridWithStatusMenu(this.value);
	});
    //loadGrid($('.showSelect').val());
	loadGridWithStatusMenu(<?php echo $showSeq?>);
	//$.get("Actions/TaskAction.php?call=getShowTasks&showSeq=4", function(taskDetails){
		//alert(taskDetails);
	//});
    $('.saveTaskDetails').on('click', function() {
    	showHideProgress();
        $('#updateShowTaskDetailsForm').ajaxSubmit(function( data ){
        	showHideProgress();
            showResponseToastr(data,null,"updateShowTaskDetailsForm","mainDiv");
            $("#showGrid").jqxGrid("updatebounddata");
            $('#taskDetailsModal').modal('hide');
        })
  	});
    $('.addMore').on('click', function() {
    	addFileUploadRow();
    });
});
function removeRow(btn){
	$(btn).closest(".fileUpload").remove();
}
function addFileUploadRow(){
 	html = '<div class="form-group row fileUpload">';
   	html += '<label class="col-lg-2 col-form-label"></label>';
   	html += '<div class="col-lg-6">';
    html += '<div class="form-control">';
    html += '<input name="files[]" type="file">';
    html += '</div></div>';
    html += '<label class="col-lg-2 col-form-label">';
    html += '<input type="checkbox"> Public</input>';
    html += '</label>';
	html += '<label class="col-lg-1 col-form-label">';
	html += '<a onClick="removeRow(this)" href="#"><i class="fa fa-times"></i></a>';	
	html += '</label></div>';
	$(".fileUplaodRow").append(html);
	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green',
	});
}
function loadGridWithStatusMenu(showSeq){
	$.getJSON("Actions/ShowTaskAction.php?call=getAllShowTaskStatus",function( statusMenus ){
	  	loadGrid(showSeq,statusMenus);
	});
}
function editTask(showTaskSeq){
	removeMessagesDivs();
	$('input[type=file]').val('');
	$("#selectedFilesDiv").html("");
	$('input[type=checkbox]').prop('checked',false);
	$.getJSON("Actions/TaskAction.php?call=getShowTaskDetails&showTaskSeq="+showTaskSeq, function(taskDetails){
		$('#taskDetailsModal').modal('show');
		data = taskDetails.taskDetails[0];
		files = taskDetails.showTaskFiles;
		$("#showTaskSeq").val(data.seq);
		$(".taskDetailsTitle").val(data.title);
		$(".taskDetailsDescription").val(data.description);
		$(".taskDetailsStartsOn").val(data.startdate);
		$(".taskDetailsEndsOn").val(data.enddate);
		$(".taskDetailsComments").val(data.comments);
		$(".taskDetailsStatus").val(data.status);
		loadFiles(files);
    });
}

function loadFiles(files){
	 $.each( files, function( key, val ) {
		 var html = '<div id="imageDiv"><input type="hidden" id ="selectedFileSeqs" name="selectedFileSeqs[]" value="'+val.seq+'"/>';
		 	 html += '<div class="col-lg-4 text-center p-sm bg-info m-xs">';
 			 html += '<i class="fa fa-file-image-o fa-2x"></i><br>';
			 html +=  val.title + '<br><a href"#" onclick="remove(this)"><i class="fa fa-trash"></i></a>';
			 html += '</div></div>';
			 $("#selectedFilesDiv").append(html);	 
	 });
}

function remove(btn){
	$(btn).closest("#imageDiv").remove();
}

function loadGrid(showSeq,statusMenus){
	var actions = function (row, columnfield, value, defaulthtml, columnproperties) {
        data = $('#showGrid').jqxGrid('getrowdata', row);
        var html = "<div style='text-align: center; margin-top:1px;font-size:18px'><a href='javascript:editTask("+ data['seq'] + ")' ><i class='fa fa-pencil-square-o' title='Edit'></i></a>";
            html += "</div>";     
        return html;
    }

	var statusrenderer = function (row, columnfield, value, defaulthtml, columnproperties) {
        data = $('#showGrid').jqxGrid('getrowdata', row);
        style = "label-warning";
        if(data['status'] == "In Process"){
			style="label-info";
        }else if(data['status'] == "Completed"){
			style="label-primary";
        }else if(data['status'] == "Delay"){
			style="label-danger";
        }
		var html = "<center><div><span class='label "+style+"' style='line-height:24px'>"+data['status']+"</span></div></center>";
        return html;
    }
    
    var columns = [
      { text: 'id', datafield: 'seq' , hidden:true},
      { text: 'Status', datafield: 'status',cellsrenderer:statusrenderer,filtertype: 'checkedlist',align:'center',width:"11%",filteritems:statusMenus},
      { text: 'Task', datafield: 'title', width:"52%"},
      { text: 'Start On', datafield: 'startdate',filtertype: 'date',cellsformat: 'M-d-yyyy',width:"14%"},
      { text: 'End On', datafield: 'enddate',filtertype: 'date',cellsformat: 'M-d-yyyy',width:"14%"},
      { text: 'Action', datafield: 'action',cellsrenderer:actions,width:'9%',filterable:false}
    ]
   
    var source =
    {
        datatype: "json",
        id: 'id',
        pagesize: 20,
        sortcolumn: 'startdate',
        sortdirection: 'asc',
        datafields: [{ name: 'seq', type: 'integer' },
                     { name: 'status', type: 'string' },  
                    { name: 'title', type: 'string' }, 
                    { name: 'startdate', type: 'date' },
                    { name: 'enddate', type: 'date' },
                    { name: 'action', type: 'string' } 
                    ],                          
        url: 'Actions/TaskAction.php?call=getShowTasks&showSeq='+showSeq,
        root: 'Rows',
        cache: false,
        beforeprocessing: function(data)
        {        
            source.totalrecords = data.TotalRows;
        },
        filter: function()
        {
            $("#showGrid").jqxGrid('updatebounddata', 'filter');
        },
        sort: function()
        {
            $("#showGrid").jqxGrid('updatebounddata', 'sort');
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
    $("#showGrid").jqxGrid(
    {
    	width: '100%',
		height: '75%',
		source: dataAdapter,
		filterable: true,
		sortable: true,
		showfilterrow: true,
		autoshowfiltericon: true,
		columns: columns,
		pageable: true,
		altrows: true,
		enabletooltips: true,
		columnsresize: true,
		columnsreorder: true,
		showstatusbar: true,
		virtualmode: true,
		rendergridrows: function (toolbar) {
          return dataAdapter.records;     
   		},
        renderstatusbar: function (statusbar) {
            var container = $("<div style='overflow: hidden; position: relative; margin: 5px;height:30px'></div>");
            var reloadButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-refresh'></i><span style='margin-left: 4px; position: relative;'>Reload</span></div>");
            container.append(reloadButton);
            statusbar.append(container);
            reloadButton.jqxButton({  width: 70, height: 18 });
             $("#showGrid").bind('rowselect', function (event) {
                 var selectedRowIndex = event.args.rowindex;
                  var pageSize = event.args.owner.rows.records.length - 1;                       
                 if($.isArray(selectedRowIndex)){           
                     if(isSelectAll){
                         isSelectAll = false;    
                     } else{
                         isSelectAll = true;
                     }                                                                     
                     $('#showGrid').jqxGrid('clearselection');
                     if(isSelectAll){
                         for (i = 0; i <= pageSize; i++) {
                             var index = $('#showGrid').jqxGrid('getrowboundindex', i);
                             $('#showGrid').jqxGrid('selectrow', index);
                         }    
                     }
                 }                        
            });
            // reload grid data.
            reloadButton.click(function (event) {
                $("#showGrid").jqxGrid({ source: dataAdapter });
            });
        }
    });

}
</script>
