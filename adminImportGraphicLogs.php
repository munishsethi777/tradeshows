<?include("sessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin | Import Graphic Logs</title>
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
							<h5 class="pageTitle">Import Item Graphic Logs</h5>
					</nav>
                 </div>
                 <div class="ibox-content">
                 	<?include "progress.php"?>
                 	 <form id="importGraphicLogForm" method="post" action="Actions/GraphicLogAction.php" class="m-t-lg">
                     	<input type="hidden" id ="call" name="call"  value="importGraphicLogs"/>
                     	<input type="hidden" id ="updateIds" name="updateIds"/>
                     	<input type="hidden" id ="password" name="password"/>
                     	<input type="hidden" id ="isupdate" name="isupdate"  value="0"/>
                     	<div class="form-group row">
                       		<label class="col-lg-2 col-form-label">Select file to import</label>
                        	<div class="col-lg-8">
                            	<input type="file" id="title" name="file" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2 col-form-label"></label>
                        	<div class="col-lg-2">
	                        	<button class="btn btn-primary" onclick="saveAction()" type="button" style="width:85%">
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
	                	<h4 class="modal-title">Import QCSchedules</h4>
	                </div>
	                <div class="modal-body mainDiv">
	                    <div class="row" >
	                        <div class="col-sm-12">
	                            <form role="form" class="form-horizontal">
	                               <div id="message"></div>
	                               <div class="form-group">
	                                    <div class="col-sm-9">
	                                        <input type="password" id="qcpassword" name="qcpassword"  class="form-control">
	                                    </div>
	                                </div>
	                                <div class="modal-footer">
	                                     <button class="btn btn-success ladda-button" onclick="yes(this)" data-style="expand-right" id="saveBtn" type="button">
	                                        <span class="ladda-label">Yes</span>
	                                    </button>
	                                     <button type="button" id="noBtn" class="btn btn-danger" onclick="no(this)" data-dismiss="modal">No</button>
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
function yes(btn){
	updateYesBtn = Ladda.create(btn);
	updateYesBtn.start();
	var password = $("#qcpassword").val();
	if(password != ""){
		$("#isupdate").val(1);
		$("#password").val(password);
		saveAction();
		$("#noBtn").attr("disabled", true); 	
	}else{
		alert("Please enter password to continue!")
	}
}
function no(){
	 $("#isupdate").val(0);
	 $("#updateIds").val(""); 	
	 $('#createNewModalForm').modal('hide');
}
function saveAction(){
	if($("#importGraphicLogForm")[0].checkValidity()) {
		showHideProgress()
		$('#importGraphicLogForm').ajaxSubmit(function( data ){
		   if(updateYesBtn != undefined){
			   updateYesBtn.stop();
			   $("#noBtn").removeAttr("disabled");
		   }
		   showHideProgress();
		   var jsonData = $.parseJSON(data);
		   $("#isupdate").val(0);
		   $("#updateIds").val("");
		   var jsonData = $.parseJSON(data);
		   if(jsonData.itemalreadyexists > 0){
			   $("#updateIds").val(jsonData.existingItemIds);
			   var importedItemsCount = jsonData.savedItemCount;
			   var message = jsonData.itemalreadyexists + " QC Schedules already exists in database! Do you want to update these items with new values?";
			   message += "<br>If you want to update please enter the password :- <br>";
			   if(importedItemsCount > 0){
				   message = importedItemsCount + " QC Schedules imported successfully.<br>" + message;		
			   }
			   $("#message").html(message);
			   $('#createNewModalForm').modal('show');
		   }else{
			   if(jsonData.incorrectPassword == 1){
				   alert(jsonData.message);
			   }else{
				   $('#createNewModalForm').modal('hide');
				   var flag = showResponseToastr(data,null,"importGraphicLogForm","ibox");
				   if(flag){
					  window.setTimeout(function(){window.location.href = "adminManageQCSchedules.php"},500);
				   }   
			   }
		   }
		   $("#isupdate").val(0); 
		});
			
	}else{
		$("#importGraphicLogForm")[0].reportValidity();
	}
}
</script>'