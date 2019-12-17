<?include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/GraphicsLog.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/GraphicLogMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/User.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Department.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/DepartmentMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/UserType.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DropdownUtil.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin | Create Customer</title>
<?include "ScriptsInclude.php"?>
<style type="text/css">
.panel-body{
	padding:15px !important;
}
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
.col-form-label{
	line-height:1;
}
.buyers input{
	font-size:12px;
	padding:4px;
	height:25px;
}
.buyers textarea{
	font-size:12px;
	padding:4px;
}
</style>
</head>
<body>
    <div id="wrapper">
    <?php include("adminmenuInclude.php")?>  
    <div id="page-wrapper" class="gray-bg">
	    <div class="row">
	    	<div class="col-lg-12">
	         <div class="ibox">
	         	<div class="ibox-title">
                   	 <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
						<a class="navbar-minimalize minimalize-styl-2 btn btn-primary "
							href="#"><i class="fa fa-bars"></i> </a>
							<h5 class="pageTitle">Create/Edit Customer</h5>
					</nav>
                 </div>
                 <div class="ibox-content">
                 	<?include "progress.php"?>
                 	 <form id="createUserForm" method="post" action="Actions/CustomerAction.php" class="m-t-sm">
                     		<input type="hidden" id ="call" name="call"  value="saveUser"/>
                        	<input type="hidden" id ="seq" name="seq"  value=""/>
                        
                        	 <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Customer Name</label>
	                        	<div class="col-lg-10">
	                        		<input type="text" required maxLength="250" value="" name="password" class="form-control">
	                            </div>
	                        </div>
	                        
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">ID</label>
	                        	<div class="col-lg-4">
	                            	<input type="text"  maxLength="250" value="" name="fullname" class="form-control">
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">BusinessType</label>
	                        	<div class="col-lg-4">
	                        		<select class="form-control">
	                        			<option>Direct</option>
	                        			<option>Domesitc</option>
	                        			<option>DotCom</option>
	                        		</select>
	                            </div>
	                       </div>
	                       <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Salesperson Name</label>
	                        	<div class="col-lg-4">
	                            	<input type="text"  maxLength="250" value="" name="fullname" class="form-control">
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Salesperson ID</label>
	                        	<div class="col-lg-4">
	                        		<input type="text"  maxLength="250" value="" name="fullname" class="form-control">
	                            </div>
	                       </div>
	                       <div class="form-group row m-b-xs">
	                       	<label class="col-lg-12 m-xxs txt-primary" >Add Buyers to the Customer</label>
	                       </div>
	                       <div class="form-group row m-b-xs">
	                       		<label class="col-lg-2 col-form-label bg-formLabel m-xxs">First Name</label>
	                        	<label class="col-lg-2 col-form-label bg-formLabel m-xxs">Last Name</label>
	                        	<label class="col-lg-3 col-form-label bg-formLabel m-xxs">Email</label>
	                        	<label class="col-lg-2 col-form-label bg-formLabel m-xxs">Phone</label>
	                        	<label class="col-lg-2 col-form-label bg-formLabel m-xxs">CellPhone</label>
	                       </div>
	                       
	                       <div class="buyers">
	                       	
		                       <div class="form-group row m-b-xs">
		                       		<div class="col-lg-2 m-xxs no-padding">
		                            	<input type="text" maxLength="250" value="" name="firstname" class="form-control" placeholder="firstname">
		                            </div>
		                            <div class="col-lg-2 m-xxs no-padding">
		                        		<input type="text" maxLength="250" value="" name="lastname" class="form-control" placeholder="lastname">
		                            </div>
		                            <div class="col-lg-3 m-xxs no-padding">
		                        		<input type="text" maxLength="250" value="" name="emailid" class="form-control" placeholder="emailid">
		                            </div>
		                            <div class="col-lg-2 m-xxs no-padding">
		                        		<input type="text" maxLength="250" value="" name="phone" class="form-control" placeholder="phone">
		                            </div>
		                            <div class="col-lg-2 m-xxs no-padding">
		                        		<input type="text" maxLength="250" value="" name="cellphone" class="form-control" placeholder="cellphone">
		                            </div>
		                       </div>
		                       <div class="form-group row">
		                       		<div class="col-lg-11 p-xxs">
		                            	<textarea placeholder="notes" class="form-control"></textarea>
		                            </div>
		                            <div class="col-lg-1 pull-right">
		                        		<a href="" title="Delete" alt="Delete"><h2><i class="fa fa-remove text-danger"></i></h2></a>
		                            </div>
		                            
		                            <div class="col-lg-12 p-xxs" style="border-bottom: 1px silver dashed;"></div>
		                            
		                       </div>
		                       
		                       <div class="form-group row m-b-xs">
		                       		<div class="col-lg-2 m-xxs no-padding">
		                            	<input type="text" maxLength="250" value="" name="firstname" class="form-control" placeholder="firstname">
		                            </div>
		                            <div class="col-lg-2 m-xxs no-padding">
		                        		<input type="text" maxLength="250" value="" name="lastname" class="form-control" placeholder="lastname">
		                            </div>
		                            <div class="col-lg-3 m-xxs no-padding">
		                        		<input type="text" maxLength="250" value="" name="emailid" class="form-control" placeholder="emailid">
		                            </div>
		                            <div class="col-lg-2 m-xxs no-padding">
		                        		<input type="text" maxLength="250" value="" name="phone" class="form-control" placeholder="phone">
		                            </div>
		                            <div class="col-lg-2 m-xxs no-padding">
		                        		<input type="text" maxLength="250" value="" name="cellphone" class="form-control" placeholder="cellphone">
		                            </div>
		                       </div>
		                       <div class="form-group row">
		                       		<div class="col-lg-11 p-xxs">
		                            	<textarea placeholder="notes" class="form-control"></textarea>
		                            </div>
		                            <div class="col-lg-1 pull-right">
		                        		<a href="" title="Delete" alt="Delete"><h2><i class="fa fa-remove text-danger"></i></h2></a>
		                            </div>
		                       </div>
		                       
		                       <div class="col-lg-12 pull-right">
		                       		<div class="col-lg-1 pull-right">
		                        		<button class="btn btn-xs btn-success" onclick="addBuyer()" type="button">
		                        		<i class="fa fa-plus"></i> Buyer</button>
		                        	</div>
		                        </div>
	                       </div>
	                       
	                       
	                        <div class="form-group row">
	                       		<div class="col-lg-2">
		                        	<button class="btn btn-primary" onclick="saveUser()" type="button" style="width:85%">
	                                	Save
		                          	</button>
		                        </div>
		                        <div class="col-lg-2">
		                          	<a class="btn btn-default" href="manageCustomers.php" type="button" style="width:85%">
	                                	Cancel
		                          	</a>
		                        </div>
		                    </div>
	                   </form>      
	         	</div>
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