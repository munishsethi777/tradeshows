<html>
<head>
<title>User | Forgot Password</title>
<?include "ScriptsInclude.php"?>
<body class="gray-bg">
        <div class="middle-box loginscreen animated fadeInDown" style="width:425px">
            <div class="ibox-content mainDiv"> 
                <div class="row">                 
                     <div class="col-sm-12">                                                           
                        <div class="col-sm-12"><h3 class="m-t-none m-b">Forgot Password</h3> 
                            <form role="form" method="post" id="forgotPasswordForm" action = "Actions/UserAction.php">
                                <input type="hidden" id ="call" name="call" value="forgotPassword"/>
                                <div class="form-group"><label>Enter User Name</label> 
                                    <input type="text" id="username" name="username" class="form-control">
                                </div>
                                <div>
                                     <button class="btn btn-primary ladda-button" data-style="expand-right" id="retreiveBtn" type="button">
                                        <span class="ladda-label">Retrieve</span>
                                    </button>
                                    <p class="text-mute m-t-sm">
                                    	Enter your valid username and click retrieve button. We will email you further details on your registered email id to reset your password. 
                                    </p>
                               </div>  
                               
                            </form>
                        </div>                        
                     </div>
                </div>
            </div>
        </div>        
</body>
</html>
<script src="scripts/FormValidators/forgotPasswordValidations.js"></script> 
<script type="text/javascript">
$(document).ready(function(){ 
    $("#retreiveBtn").click(function(e){
        var btn = this;
        var validationResult = function (isValid) {
            if (isValid) {
                forgotPassword(e,btn);
            }
        }
        $('#forgotPasswordForm').jqxValidator('validate', validationResult);   
    })
});
function forgotPassword(e,btn){
    e.preventDefault();
    var l = Ladda.create(btn);
    l.start();
    $('#forgotPasswordForm').ajaxSubmit(function( data ){
        l.stop();
        showResponseToastr(data,null,"forgotPasswordForm","mainDiv");
    })
} 
</script>
