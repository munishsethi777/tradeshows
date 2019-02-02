<?include("sessionCheck.php");?>
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
							<h5 class="pageTitle">Import Items</h5>
					</nav>
                 </div>
                 <div class="ibox-content">
                 	<?include "progress.php"?>
                 	 <form id="importItemForm" method="post" action="Actions/ItemAction.php" class="m-t-lg">
                     	<input type="hidden" id ="call" name="call"  value="importItems"/>
                        <div class="form-group row">
                       		<label class="col-lg-2 col-form-label">Select file to import</label>
                        	<div class="col-lg-8">
                            	<input type="file" id="title" name="file" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2 col-form-label"></label>
                        	<div class="col-lg-2">
	                        	<button class="btn btn-primary" onclick="saveTaskCategory()" type="button" style="width:85%">
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
function saveTaskCategory(){
	if($("#importItemForm")[0].checkValidity()) {
		showHideProgress()
		$('#importItemForm').ajaxSubmit(function( data ){
		   showHideProgress();
		   var flag = showResponseToastr(data,null,"importItemForm","ibox");
		   if(flag){
			   window.setTimeout(function(){window.location.href = "adminShowItems.php"},500);
		   }
	    })	
	}else{
		$("#importItemForm")[0].reportValidity();
	}
}
</script>