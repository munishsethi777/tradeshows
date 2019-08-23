<?php
$id = $_REQUEST["id"];
?>
<html>
<head>
<title>Administrator | Change Password</title>
<?include "ScriptsInclude.php"?>
<body class="gray-bg">
        <div class="middle-box loginscreen animated fadeInDown" style="width:425px">
            <div class="ibox-content mainDiv"> 
                <div class="row">                 
                     <div class="col-sm-12">                                                           
                        <div class="col-sm-12"><h3 class="m-t-none m-b text-center">Reset Password</h3> 
                            <form role="form" method="post" id="changePasswordForm" action = "Actions/UserAction.php">
                                <input type="hidden" id ="call" name="call" value="resetPassword"/>
                                <input type="hidden" id ="id" name="id" value="<?php echo $id?>"/>
                                <div class="form-group"><label>New Password</label> 
                                    <input type="password" maxlength="50" required id="newPassword" name="newPassword" class="form-control">
                                </div>
                                <div class="form-group"><label>Confirm Password</label>
                                    <input type="password" maxlength="50" required id="confirmPassword" name="confirmPassword" class="form-control">
                                </div>
                                 <div id="loginDiv" style="display: none"><label><a href="http://www.alpinebi.com">Click here</a> to login with new password.</label></div>
                                <div>
                                     <button class="btn btn-primary ladda-button" data-style="expand-right" id="saveBtn" type="button">
                                        <span class="ladda-label">Reset Password</span>
                                    </button>
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
    $("#saveBtn").click(function(e){
          changePassword(e,this);
    })
});
function changePassword(e,btn){
	if($("#changePasswordForm")[0].checkValidity()) {
        e.preventDefault();
        var l = Ladda.create(btn);
        l.start();
        $('#changePasswordForm').ajaxSubmit(function( data ){
            l.stop();
            showResponseToastr(data,null,"changePasswordForm","mainDiv");
			data = $.parseJSON(data);
			if(data.success == 1){
            	$("#loginDiv").show();
			}
        })
	}else{
		$("#changePasswordForm")[0].reportValidity();
	}
} 
</script>

