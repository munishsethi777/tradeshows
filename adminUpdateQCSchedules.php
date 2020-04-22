<?include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
$isCompleted = 0;
if(isset($_REQUEST["isCompleted"])){
    $isCompleted  = $_REQUEST["isCompleted"];
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin | Update Items</title>
<?include "ScriptsInclude.php"?>
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
							<h5 class="pageTitle">Update Item QC Schedules</h5>
					</nav>
                 </div>
                 <div class="ibox-content">
                 	<?include "progress.php"?>
                 	 <form id="updateQCScheduleForm" method="post" action="Actions/QCScheduleAction.php" class="m-t-lg">
                     	<input type="hidden" id ="call" name="call"  value="updateQCSchedules"/>
                     	<input type="hidden" id ="updateIds" name="updateIds"/>
                     	<input type="hidden" id ="password" name="password"/>
                     	<input type="hidden" id ="isupdate" name="isupdate"  value="0"/>
                     	<input type="hidden" id ="iscompleted" name="iscompleted"  value="<?php echo $isCompleted?>"/>
                     	<div class="form-group row">
                       		<label class="col-lg-2 col-form-label">Select file to update</label>
                        	<div class="col-lg-8">
                            	<input type="file" id="title" name="file" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2 col-form-label"></label>
                        	<div class="col-lg-2">
	                        	<button class="btn btn-primary" onclick="updateAction()" type="button" style="width:85%">
                                	Submit
	                          	</button>
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
       <div id="createNewModalForm" class="modal fade" data-backdrop="static"  aria-hidden="true">
	        <div class="modal-dialog" >
	            <div class="modal-content">
	                <div class="modal-header">
	                	<h4 class="modal-title">Update QCSchedules</h4>
	                </div>
	                <div class="modal-body mainDiv">
	                    <div class="row" >
	                        <div class="col-sm-12">
	                            <form role="form" class="form-horizontal">
	                               <div id="message"></div>
	                               <div class="form-group">
	                                </div>
	                                <div class="modal-footer">
										<button class="btn btn-success ladda-button" onclick="close()">
	                                        <span class="ladda-label">CLOSE</span>
	                                    </button>
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

var updateYesBtn;
function close(){
	location.href = ("localhost/tradeshows/adminManageQCSchedules.php");
}
function updateAction(){
	if($("#updateQCScheduleForm")[0].checkValidity()) {
		showHideProgress()
		$('#updateQCScheduleForm').ajaxSubmit(function( data ){
		//    if(updateYesBtn != undefined){
		// 	   $("#noBtn").removeAttr("disabled");
		//    }
		showHideProgress();
		var jsonData = $.parseJSON(data);
		$("#isupdate").val(0);
		$("#updateIds").val("");
		var jsonData = $.parseJSON(data);
		if(jsonData.success == 1){
			var updatedItemsCount = jsonData.updatedItemCount;
			if(updatedItemsCount > 0){
				var message = "<p>" + updatedItemsCount + " QC Schedules imported successfully.</p><br>";		
			}
			$("#message").html(message);
			$('#createNewModalForm').modal('show'); 
		}
		});
			
	}else{
		$("#updateQCScheduleForm")[0].reportValidity();
	}
}

</script>'