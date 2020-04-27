<?include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ClassCode.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ClassCodeMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
$classCode = new ClassCode();
$isEnabled = "checked";
$classCodeMgr = ClassCodeMgr::getInstance();
if(isset($_POST["id"])){
	$seq = $_POST["id"];
	$classCode = $classCodeMgr->findBySeq($seq);
	if($classCode->getIsEnabled() == 1){
		$isEnabled = "checked";
	}else{
		$isEnabled = "";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create Class Code</title>
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
							<h5 class="pageTitle">Create/Edit Class Code</h5>
					</nav>
                 </div>
                 <div class="ibox-content">
                 	<?include "progress.php"?>
                 	 <form id="createUserForm" method="post" action="Actions/ClassCodeAction.php" class="m-t-lg">
                     	<input type="hidden" id ="call" name="call"  value="saveClassCode"/>
                        <input type="hidden" id ="seq" name="seq"  value="<?php echo $classCode->getSeq()?>"/>
                        <div class="p-xs outterDiv">
                        	 <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Class Code:</label>
	                        	<div class="col-lg-4">
	                            	<input type="text"  required maxLength="25" value="<?php echo $classCode->getClassCode()?>" name="classcode" class="form-control">
	                            </div>
							 </div>
							 <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Vendor Id:</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" maxLength="50" value="<?php echo $classCode->getVendorId()?>" name="vendorid" class="form-control">
	                            </div>
							 </div>
							 <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Vendor Name:</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" maxLength="100" value="<?php echo $classCode->getVendorName()?>" name="vendorname" class="form-control">
	                            </div>
							 </div>
							 <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Email:</label>
	                        	<div class="col-lg-4">
	                            	<input type="email"   maxLength="50" value="<?php echo $classCode->getEmail()?>" name="email" class="form-control">
	                            </div>
							 </div>
							 <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Contact Name:</label>
	                        	<div class="col-lg-4">
	                            	<input type="text"   maxLength="50" value="<?php echo $classCode->getContactName()?>" name="contactname" class="form-control">
	                            </div>
							 </div>
							 <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Port:</label>
	                        	<div class="col-lg-4">
	                            	<input type="text"  maxLength="50" value="<?php echo $classCode->getPort()?>" name="port" class="form-control">
	                            </div>
							 </div>
							 <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Buyer Name:</label>
	                        	<div class="col-lg-4">
	                            	<input type="text"   maxLength="100" value="<?php echo $classCode->getBuyerName()?>" name="buyername" class="form-control">
	                            </div>
							 </div>
							 <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Buyer Email:</label>
	                        	<div class="col-lg-4">
	                            	<input type="email"  maxLength="50" value="<?php echo $classCode->getBuyerEmail()?>" name="buyeremail" class="form-control">
	                            </div>
							 </div>
							 <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Assistant Buyer:</label>
	                        	<div class="col-lg-4">
	                            	<input type="text"  maxLength="100" value="<?php echo $classCode->getAssistantBuyer()?>" class="form-control" name="assistantbuyer" class="form-control">
	                            </div>
							 </div>
							 <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Assistant Buyer Email:</label>
	                        	<div class="col-lg-4">
	                            	<input type="email"  maxLength="50" value="<?php echo $classCode->getAssistantBuyerEmail()?>" name="assistantbuyeremail" class="form-control">
	                            </div>
							 </div>
							 <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">China Rep Name:</label>
	                        	<div class="col-lg-4">
	                            	<input type="text"  maxLength="100" value="<?php echo $classCode->getChinaRepName()?>" name="chinarepname" class="form-control">
	                            </div>
							 </div>
							 <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">China Rep Email:</label>
	                        	<div class="col-lg-4">
	                            	<input type="email"  maxLength="50" value="<?php echo $classCode->getChinaRepEmail()?>" name="chinarepemail" class="form-control">
	                            </div>
							 </div>
							 
	                         <div class="form-group row i-checks">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Enabled :</label>
	                        	<div class="col-lg-4">
	                        		<input type="checkbox" <?php echo $isEnabled?> name="isenabled"/>
	                            </div>
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
			                        	<button class="btn btn-primary" onclick="saveUserContinue()" type="button" style="width:85%">
		                                	Save And New
			                          	</button>
			                        </div>
			                        <div class="col-lg-2">
			                          	<a class="btn btn-default" href="manageClassCodes.php" type="button" style="width:85%">
		                                	Cancel
			                          	</a>
			                        </div>
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
});

function saveUser(){
	if($("#createUserForm")[0].checkValidity()) {
		showHideProgress()
		$('#createUserForm').ajaxSubmit(function( data ){
		   showHideProgress();
		   var flag = showResponseToastr(data,null,null,"ibox");
		   if(flag){
			   window.setTimeout(function(){window.location.href = "manageClassCodes.php"},100);
		   }
	    })	
	}else{
		$("#createUserForm")[0].reportValidity();
	}
}
function saveUserContinue(){
	if($("#createUserForm")[0].checkValidity()) {
		showHideProgress()
		$('#createUserForm').ajaxSubmit(function( data ){
		   showHideProgress();
		   var flag = showResponseToastr(data,null,null,"ibox");
		   $(".form-control").val("");
	    })	
	}else{
		$("#createUserForm")[0].reportValidity();
	}
}
</script>