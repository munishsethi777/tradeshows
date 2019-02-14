<?include("sessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ShowMgr.php");
$showMgr = ShowMgr::getInstance();
$shows = $showMgr->getAllShows();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin | Import Items</title>
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
							<h5 class="pageTitle">Import Orders</h5>
					</nav>
                 </div>
                 <div class="ibox-content">
                 	<?include "progress.php"?>
                 	 <form id="importItemForm" method="post" action="Actions/TradeShowOrderAction.php" class="m-t-lg">
                     	<input type="hidden" id ="call" name="call"  value="importOrders"/>
                     	<input type="hidden" id ="updateIds" name="updateIds"/>
                     	<input type="hidden" id ="isupdate" name="isupdate"  value="0"/>
                      	<div class="form-group row">
                       		<label class="col-lg-2 col-form-label">Select Tradeshow</label>
                        	<div class="col-lg-4">
                            	<select name="tradeshowseq" id="showSeq" class="showSelect form-control">
                                    	<?php 
                                    		foreach($shows as $show){
                                    			$html = "<option value='". $show->getSeq()  ."'>".$show->getTitle()."</option>";
                                    			echo($html);
                                    		}
                                    	?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2 col-form-label">Select file to import</label>
                        	<div class="col-lg-6">
                            	<input type="file" id="title" name="file" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2 col-form-label"></label>
                        	<div class="col-lg-2">
	                        	<button class="btn btn-primary" onclick="saveOrders()" type="button" style="width:85%">
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
function saveOrders(){
	if($("#importItemForm")[0].checkValidity()) {
		showHideProgress()
		$('#importItemForm').ajaxSubmit(function( data ){
		   $("#isupdate").val(0);
		   $("#updateIds").val("");
		   showHideProgress();
		   var jsonData = $.parseJSON(data);
		   if(jsonData.itemalreadyexists > 0){
			   $("#updateIds").val(jsonData.existingItemIds);
			   var importedItemsCount = jsonData.savedItemCount;
			   var message = jsonData.itemalreadyexists + " items already exists in database! Do you want to update these items with new values?";
			   if(importedItemsCount > 0){
				   message = importedItemsCount + " items imported successfully.<br>" + message;			   
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
							saveOrders(); 
					    }else{
					    	 $("#isupdate").val(0);
							 $("#updateIds").val(""); 
					    }
				    }
				});
		   }else{
			   var flag = showResponseToastr(data,null,"importItemForm","ibox");
			   if(flag){
				  window.setTimeout(function(){window.location.href = "adminManageOrders.php"},500);
			   }   
		   }
		   $("#isupdate").val(0);
	    })	
	}else{
		$("#importItemForm")[0].reportValidity();
	}
}
</script>