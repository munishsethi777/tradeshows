<?include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin | Import Customers</title>
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
							<h5 class="pageTitle">Import Customers</h5>
					</nav>
                 </div>
                 <div class="ibox-content">
                 	<?include "progress.php"?>
                 	 <form id="importCustomerForm" method="post" action="Actions/CustomerAction.php" class="m-t-lg">
                     	<input type="hidden" id ="call" name="call"  value="importCustomers"/>
                     	<input type="hidden" id ="isupdate" name="isupdate"  value="0"/>
                     	<input type="hidden" id ="updateIds" name="updateIds"/>
                        <div class="form-group row">
                       		<label class="col-lg-2 col-form-label">Select file to import</label>
                        	<div class="col-lg-8">
                            	<input type="file" id="title" name="file" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2 col-form-label"></label>
                        	<div class="col-lg-2">
	                        	<button class="btn btn-primary" onclick="importCustomers()" type="button" style="width:85%">
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
</body>
</html>
<script type="text/javascript">
function importCustomers(){
	if($("#importCustomerForm")[0].checkValidity()) {
		showHideProgress()
		$('#importCustomerForm').ajaxSubmit(function( data ){
		   $("#isupdate").val(0);
		   $("#updateIds").val("");
		   showHideProgress();
		   var jsonData = $.parseJSON(data);
		   if(jsonData.customerIdAlreadyExists > 0){
			   $("#updateIds").val(jsonData.existingCustomerIds);
			   var importedCustomersCount = jsonData.savedCustomersCount;
			   var message = jsonData.customerIdAlreadyExists + " customers already exists in database! Do you want to update these customers with new values?";
			   if(importedCustomersCount > 0){
				   message = importedCustomersCount + " customers imported successfully.<br>" + message;			   
			   }
			   bootbox.confirm({
				    message: message,
				    buttons: {
				        confirm: {
				            label: 'Yes',
				            className: 'btn-success'
				        },
				        cancel: {
				            label: 'No',
				            className: 'btn-danger'
				        }
				    },
				    callback: function (result) {
					    if(result){
							$("#isupdate").val(1);
							importCustomers(); 
					    }else{
					    	 $("#isupdate").val(0);
							 $("#updateIds").val(""); 
					    }
				    }
				});
		   }else{
			   var flag = showResponseToastr(data,null,"importCustomerForm","ibox");
			   if(flag){
				   window.setTimeout(function(){window.location.href = "adminManageCustomers.php"},500);
			   }   
		   }
		   $("#isupdate").val(0);
	    })	
	}else{
		$("#importCustomerForm")[0].reportValidity();
	}
}
</script>