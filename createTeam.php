<?php 
include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/TeamMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Team.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DropdownUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/UserType.php");

$isEnable ="";
$supervisors ="";
$user = new User();
$team = new Team();
$userMgr = UserMgr::getInstance();
 $usertype = UserType::USER;
 $users = $userMgr->getAllUsersByType($usertype);
$teamMgr = TeamMgr::getInstance();
$id="";

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin | Create User Team</title>
<?include "ScriptsInclude.php";

    if (isset($_POST ["id"])){
        $id = $_POST ["id"];
        $team = $teamMgr->findBySeq($id);
        $selectedUsers  = $teamMgr->getUserSeqsByTeamSeq($id);
        if($team->getIsEnable() == 1){
            $isEnable = "checked";
        }else{
            $isEnable = "";
        }
       
    }
?>
<script>
function saveTeam(){
	if($("#TeamForm")[0].checkValidity()){
		showHideProgress();
		$('#TeamForm').ajaxSubmit(function(data){
		   showHideProgress();
		  // var obj = $.parseJSON(data);
		  // if(obj.success == 1){
			   var flag = showResponseToastr(data,null,null,"ibox");
			   if(flag){
			   window.setTimeout(function(){window.location.href = "manageTeams.php"},300);
		    }
		  // }
	    })	
	}else{
		$("#TeamForm")[0].reportValidity();
	}
	
}
</script>
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
	padding:20px 10px;
}
</style>
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
							<h5 class="pageTitle">Create/Edit Team</h5>
					</nav>
                 </div>
                 <div class="ibox-content">
                 	<?include "progress.php"?>
                 	 <form id="TeamForm" method="POST" action="Actions/TeamAction.php" class="m-t-lg">
                     	<input type="hidden" id ="call" name="call"  value="saveTeam"/>
                         <input type="hidden" name="seq" id="id" value="<?php echo $id ?>">
                        <div class="p-xs outterDiv">
                        	 <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Title:</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" required  maxLength="20" value="<?php echo $team->getTitle()?>" name="title" class="form-control">
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Description:</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" required  maxLength="20" value="<?php echo $team->getDescription()?>" name="description" class="form-control">
	                            </div>
	                         </div>
	                         
	                         <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Supervisor:</label>
	                        	<div class="col-lg-4">
	                               <?php  
	                               $select = DropDownUtils::getSupervisors("supervisoruserseq","",$team->getSupervisoruserseq(),true);
	                        		      echo $select;
                                    ?>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Users:</label>
	                        	<div class="col-lg-4">
	                               <select class="users form-control" name="users[]" multiple  >
	                               <?php
	                               foreach($users as $user){
	                                   $selected = "";
	                                   if(in_array($user->getSeq(),$selectedUsers)){
	                                       $selected = "selected";
	                                   }
	                                   echo ('<option '.$selected.' value="'.$user->getSeq().'">'.$user->getFullName().'</option>');
	                               }?>
                            	  </select>
	                            </div>
	                          </div>
	                          <div class="form-group row i-checks">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Enabled :</label>
	                        	<div class="col-lg-4">
	                        		<input type="checkbox" <?php echo $isEnable ?> name="isenable"/>
	                            </div>
	                         </div>
	                      </div>
		                  <div class="bg-white p-xs">
		                        <div class="form-group row">
		                       		<label class="col-lg-2 col-form-label"></label>
		                        	<div class="col-lg-2">
			                        	<button class="btn btn-primary" onclick="saveTeam()" type="button" style="width:85%">
		                                <span class="ladda-label">Save</span>
			                          	</button>
			                        </div>
			                        <div class="col-lg-2">
			                          	<a class="btn btn-default" href="manageTeams.php" type="button" style="width:85%">
		                                	Cancel
			                          	</a>
			                        </div>
			                    </div>
		                  </div>
	                    </form>
	                    </div>
                	 </div>           
	         	</div>
	    	</div>
       	<div class="row">
       	 	
        </div>
     </div>   	
    </div> 
</body>
</html>
<script>
$(document).ready(function(){
	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
	   	radioClass: 'iradio_square-green',
	});
	$('.users').select2({companies: true});
});
</script>                