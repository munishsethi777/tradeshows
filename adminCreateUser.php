<?include("sessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/GraphicsLog.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/GraphicLogMgr.php");

require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/User.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");

require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Department.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/DepartmentMgr.php");

require_once($ConstantsArray['dbServerUrl'] ."Enums/UserType.php");

$userTypes = UserType::getAll();
$departmentMgr = DepartmentMgr::getInstance();
$departments = $departmentMgr->getAll();
$user = new User();
$userMgr = UserMgr::getInstance();

$graphicLog = new GraphicsLog(); 
$graphicLogMgr = GraphicLogMgr::getInstance();
$readOnlyPO = "";
$showQCDiv = "none";
$isEnabled = "";
$isSendNotifications = "";
if(isset($_POST["id"])){
	$seq = $_POST["id"];
	$user = $userMgr->findBySeq($seq);
	//if($user->getUserType() == "QC"){
		//$showQCDiv = "block";
	//}
	if($user->getIsEnabled() == 1){
		$isEnabled = "checked";
	}
	if($user->getIsSendNotifications() == 1){
		$isSendNotifications = "checked";
	}
}
$userDepartments = $departmentMgr->getUserDepartments($user->getSeq());
$userRoles = $userMgr->getUserRoles($user->getSeq());
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin | Create User</title>
<?include "ScriptsInclude.php"?>
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
							<h5 class="pageTitle">Create/Edit User</h5>
					</nav>
                 </div>
                 <div class="ibox-content">
                 	<?include "progress.php"?>
                 	 <form id="createUserForm" method="post" action="Actions/UserAction.php" class="m-t-lg">
                     	<input type="hidden" id ="call" name="call"  value="saveUser"/>
                        <input type="hidden" id ="seq" name="seq"  value="<?php echo $user->getSeq()?>"/>
                        <div class="p-xs outterDiv">
                        	 <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Email Id:</label>
	                        	<div class="col-lg-4">
	                            	<input type="email" required  maxLength="250" value="<?php echo $user->getEmail()?>" name="email" class="form-control">
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Password:</label>
	                        	<div class="col-lg-4">
	                        		<input type="text" required maxLength="250" value="<?php echo $user->getPassword()?>" name="password" class="form-control">
	                            </div>
	                        </div>
	                        
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Full Name:</label>
	                        	<div class="col-lg-4">
	                            	<input type="text"  maxLength="250" value="<?php echo $user->getFullName()?>" name="fullname" class="form-control">
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Mobile:</label>
	                        	<div class="col-lg-4">
	                        		<input type="text" maxLength="250" value="<?php echo $user->getMobile()?>" name="mobile" class="form-control">
	                            </div>
	                       </div>
	                        
	                        <div class="form-group row i-checks">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Enabled :</label>
	                        	<div class="col-lg-4">
	                        		<input type="checkbox" <?php echo $isEnabled?> name="isenabled"/>
	                            </div>
	                            
	                            <label class="col-lg-2 col-form-label bg-formLabel">Send Notifications :</label>
	                        	<div class="col-lg-4">
	                        		<input type="checkbox" <?php echo $isSendNotifications?> name="issendnotifications"/>
	                            </div>
	                        </div>
	                        <div class="form-group row m-t-xl">
	                       		<label class="col-lg-3 col-form-label bg-primary">Select Roles</label>
	                        </div>
	                        <div class="form-group row i-checks">
	                    		<?php foreach($userTypes as $key => $userType){
	                    				$roleChecked = "";
	                    				foreach($userRoles as $userRole){
	                    					if($userRole->getRole() == $key){
	                    						$roleChecked = "checked";
	                    					}
	                    				}
	                    				if($key =="ADMIN"){
	                    					continue;
	                    				}
	                    		?>
		                       		<label class="col-lg-2 col-form-label bg-formLabel"><?php echo $userType;?></label>
		                        	<div class="col-lg-2">
		                        		<input type="checkbox" name="utype<?php echo $key;?>" <?php echo $roleChecked?>/>
		                            </div>
	                            <?php }?>
	                        </div>    
	                        <div class="qcDIV form-group row" style="display:<?php echo "block"?>">
	                            <label class="col-lg-2 col-form-label bg-formLabel">QC Code :</label>
	                        	<div class="col-lg-2">
	                            	<input type="text" maxLength="250" value="<?php echo $user->getQCCode()?>" name="qccode" class="form-control">
	                            </div>
	                        </div>
		                        
		                        
	                    	<div class="form-group row m-t-xl">
	                       		<label class="col-lg-3 col-form-label bg-primary">Select Departments</label>
	                        </div>
	                    	<div class="form-group row i-checks">
	                    		<?php foreach($departments as $department){
	                    				$checked = "";
	                    				foreach($userDepartments as $userDepartment){
	                    					if($userDepartment->getDepartmentSeq() == $department->getSeq()){
	                    						$checked = "checked";
	                    					}
	                    				}
	                    				?>
		                       		<label class="col-lg-2 col-form-label bg-formLabel"><?php echo $department->getTitle();?></label>
		                        	<div class="col-lg-2">
		                        		<input type="checkbox" name="dep<?php echo $department->getSeq();?>" <?php echo $checked?>/>
		                            </div>
	                            <?php }?>
	                        </div>    
	                 	 
	                    
                        <div class="bg-white p-xs">
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label"></label>
	                        	<div class="col-lg-2">
		                        	<button class="btn btn-primary" onclick="saveUser()" type="button" style="width:85%">
	                                	Save
		                          	</button>
		                        </div>
		                        <div class="col-lg-2">
		                          	<a class="btn btn-default" href="adminManageUsers.php" type="button" style="width:85%">
	                                	Cancel
		                          	</a>
		                        </div>
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
	
	
	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
	   	radioClass: 'iradio_square-green',
	});

	$('.userTypeDD').change(function(event){
		if(this.value == "QC"){
			$(".qcDIV").show();
		}else{
			$(".qcDIV").hide();
		}
	});
	<?php if(!empty($user->getUserType())){?>	
		$(".userTypeDD").val("<?php echo $user->getUserType()?>");
	<?php }?>
	$('#utypeQC').on('ifChanged', function(event){
		var flag  = $("#utypeQC").is(':checked');
		if(flag){
			$("#qccode").attr("required","required");
		}else{
			$("#qccode").removeAttr("required");
		}
  	});
});

function saveUser(){
	if($("#createUserForm")[0].checkValidity()) {
		showHideProgress()
		$('#createUserForm').ajaxSubmit(function( data ){
		   showHideProgress();
		   var flag = showResponseToastr(data,null,null,"ibox");
		   if(flag){
			   window.setTimeout(function(){window.location.href = "adminManageUsers.php"},100);
		   }
	    })	
	}else{
		$("#createUserForm")[0].reportValidity();
	}
}
</script>