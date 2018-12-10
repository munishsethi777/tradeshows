<?include("sessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Task.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/TaskMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/TaskCategoryMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/TaskAssigneeMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
$task = new Task();
$taskCategoryMgr = TaskCategoryMgr::getInstance();
$taskCategories = $taskCategoryMgr->findAll();
$userMgr = UserMgr::getInstance();
$users = $userMgr->getAllUsers();
$selectedAssignees = array();
$taskMgr = TaskMgr::getInstance();
$tasks = $taskMgr->findAll();
$taskAssigneeMgr = TaskAssigneeMgr::getInstance();
if(isset($_POST["id"])){
	$seq = $_POST["id"];
	$task = $taskMgr->findBySeq($seq);
	$selectedAssignees = $taskAssigneeMgr->getAssignedUsersByTaskSeq($seq);
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin | Create Task</title>
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
							<h5 class="pageTitle">Create Task</h5>
					</nav>
                 </div>
                 <div class="ibox-content">
                 	<?include "progress.php"?>
                 	 <form id="taskForm" method="post" action="Actions/TaskAction.php" class="m-t-lg">
                     	<input type="hidden" id ="call" name="call"  value="saveTask"/>
                        <input type="hidden" id ="seq" name="seq"  value="<?php echo $task->getSeq()?>"/>
                        <div id="assigneesDiv">
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2 col-form-label">Title</label>
                        	<div class="col-lg-8">
                            	<input type="text" id="title" maxLength="250" value="<?php echo $task->getTitle()?>" name="title" required placeholder="Title" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2 col-form-label">Description</label>
                        	<div class="col-lg-8">
                            	<input type="text" id="desription" maxLength="250" value="<?php echo $task->getDescription()?>" name="description"  placeholder="Description" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row i-checks">
                       		<label class="col-lg-2 col-form-label">Select Category</label>
                            	<div class="col-lg-4">
                                	<select class="form-control" required id="categoryDD" name="taskcategoryseq">
										<?php foreach ($taskCategories as $taskCategory){
											$taskSeq = $taskCategory->getSeq();
											$selected = "";
											if($taskSeq == $task->getTaskCategorySeq()){
												$selected = "selected";
											}?>
											<option <?php echo $selected ?> value="<?php echo $taskSeq?>"><?php echo $taskCategory->getTitle()?></option>
										<?php }?>
									</select> <label class="jqx-validator-error-label" id="lpError"></label>
						 		</div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2 col-form-label">Days Required</label>
                        	<div class="col-lg-4">
                            	<input type="text" id="title" maxLength="250" value="<?php echo $task->getDaysRequired()?>" name="daysrequired" required placeholder="Days Required" class="form-control touchspin3">
                            </div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2 col-form-label">Select Assignee</label>
                        	<div class="col-lg-8">
                            	<select class="form-control chosen-select" required id="assignees" name="assignees[]" multiple>
									<?php foreach ($users as $user){
									$userSeq = $user->getSeq();
									$selected = "";
									if(in_array($userSeq,$selectedAssignees)){
										$selected = "selected";
									}?>
									<option <?php echo $selected ?> value="<?php echo $userSeq?>"><?php echo $user->getFullName()?></option>
									<?php }?>
								</select> <label class="jqx-validator-error-label" id="lpError"></label>
                            </div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2 col-form-label">Start Reference Days</label>
                        	<div class="col-lg-4">
                            	<input type="text" id="title"  value="<?php echo $task->getStartDateReferenceDays()?>" name="startdatereferencedays" required placeholder="Start Reference Days" class="form-control touchspin3">
                            </div>
                        </div>
                         <div class="form-group row i-checks">
                       		<label class="col-lg-2 col-form-label">Select Parent Task</label>
                            	<div class="col-lg-4">
                                	<select class="form-control chosen-select" required id="parentTask" name="parenttaskseq" multiple>
										<?php foreach ($tasks as $pTask){
											$taskSeq = $pTask->getSeq();
											$selected = "";
											if($taskSeq == $task->getParentTaskSeq()){
												$selected = "selected";
											}?>
											<option <?php echo $selected ?> value="<?php echo $taskSeq?>"><?php echo $pTask->getTitle()?></option>
										<?php }?>
									</select> <label class="jqx-validator-error-label" id="lpError"></label>
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
$(document).ready(function(){
	$(".chosen-select").chosen({width:"100%"});
	 $(".touchspin3").TouchSpin({
         verticalbuttons: true,
         max: 1000000000,
         buttondown_class: 'btn btn-white',
         buttonup_class: 'btn btn-white'
     });
});
function saveTaskCategory(){
	if($("#taskForm")[0].checkValidity()) {
		showHideProgress()
		$('#taskForm').ajaxSubmit(function( data ){
		   showHideProgress();
		   var flag = showResponseToastr(data,null,null,"ibox");
		   if(flag){
			   window.setTimeout(function(){window.location.href = "adminShowTaskList.php"},100);
		   }
	    })	
	}else{
		$("#taskForm")[0].reportValidity();
	}
}
</script>