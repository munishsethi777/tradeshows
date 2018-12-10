<?include("sessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/TaskCategory.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/TaskCategoryMgr.php");
$taskCategory = new TaskCategory();
if(isset($_POST["id"])){
	$seq = $_POST["id"];
	$taskCategoryMgr = TaskCategoryMgr::getInstance();
	$taskCategory = $taskCategoryMgr->findBySeq($seq);
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin | Create Task Category</title>
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
							<h5 class="pageTitle">Create Task Category</h5>
					</nav>
                 </div>
                 <div class="ibox-content">
                 	<?include "progress.php"?>
                 	 <form id="taskCategoryForm" method="post" action="Actions/TaskCategoryAction.php" class="m-t-lg">
                     	<input type="hidden" id ="call" name="call"  value="saveTaskCategory"/>
                        <input type="hidden" id ="seq" name="seq"  value="<?php echo $taskCategory->getSeq()?>"/>
                        <div id="assigneesDiv">
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2 col-form-label">Title</label>
                        	<div class="col-lg-8">
                            	<input type="text" id="title" maxLength="250" value="<?php echo $taskCategory->getTitle()?>" name="title" required placeholder="Title" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2 col-form-label">Description</label>
                        	<div class="col-lg-8">
                            	<input type="text" id="title" maxLength="250" value="<?php echo $taskCategory->getDescription()?>" name="description" required placeholder="Description" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2 col-form-label"></label>
                        	<div class="col-lg-2">
	                        	<button class="btn btn-primary" onclick="saveTaskCategory()" type="button" style="width:85%">
                                	Save
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
	if($("#taskCategoryForm")[0].checkValidity()) {
		showHideProgress()
		$('#taskCategoryForm').ajaxSubmit(function( data ){
		   showHideProgress();
		   var flag = showResponseToastr(data,null,"taskCategoryForm","ibox");
		   if(flag){
			   window.setTimeout(function(){window.location.href = "adminShowTaskCategory.php"},500);
		   }
	    })	
	}else{
		$("#taskCategoryForm")[0].reportValidity();
	}
}
</script>