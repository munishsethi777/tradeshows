<?include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
$isCompleted = 0;
if(isset($_REQUEST["isCompleted"])){
    $isCompleted  = $_REQUEST["isCompleted"];
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin | Import Class Codes</title>
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
							<h5 cl
	public function saveOrUpdateArr($colValuePair,$ommitFieldsWhileUpdateArr){
		$sql = "INSERT INTO classcodes(";
		$inserter = array();
		$conditioner = array();
		$dupilcator = array();
		foreach($colValuePair as $key => $value){
			if(!empty($value)){
				array_push($inserter,$key);
			}
		}
		foreach($colValuePair as $key => $value){
			if(!empty($value)){
				array_push($conditioner,$value);
			}
		}
		foreach($colValuePair as $key => $value){
			if(!empty($value) and !(in_array($key,$ommitFieldsWhileUpdateArr))){
				array_push($duplicator,$key . "=" . $value);
			}
		}
		$sql .= implode(",",$inserter) . ") values(" . implode(",",$conditioner) . ") ON DUPLICATE KEY UPDATE " . implode(",",$dupilcator);
		$classCode = self::$dataStore->executeQuery($sql);
		return $classCode;

	}ass="pageTitle">Import Item Class Codes</h5>
					</nav>
                 </div>
                 <div class="ibox-content">
                 	<?include "progress.php"?>
                 	 <form id="importClassCodesForm" method="post" action="Actions/ClassCodeAction.php" class="m-t-lg">
                     	<input type="hidden" id ="call" name="call"  value="importClassCode"/>
                     	<div class="form-group row">
                       		<label class="col-lg-2 col-form-label">Select file to import</label>
                        	<div class="col-lg-8">
                            	<input type="file" id="title" name="file" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2 col-form-label"></label>
                        	<div class="col-lg-2">
	                        	<button class="btn btn-primary" onclick="saveAction()" type="button" style="width:85%">
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
       <div id="createNewModalForm" class="modal fade" data-backdrop="static"  aria-hidden="true">
	        <div class="modal-dialog" >
	            <div class="modal-content">
	                <div class="modal-header">
	                	<h4 class="modal-title">Import ClassCodes</h4>
	                </div>
	                <div class="modal-body mainDiv">
	                    <div class="row" >
	                        <div class="col-sm-12">
	                            <form role="form" class="form-horizontal">
	                               <div id="message"></div>
	                                <div class="modal-footer">
	                                     <button class="btn btn-success ladda-button" onclick="yes(this)" data-style="expand-right" id="saveBtn" type="button">
	                                        <span class="ladda-label">Yes</span>
	                                    </button>
	                                     <button type="button" id="noBtn" class="btn btn-danger" onclick="no(this)" data-dismiss="modal">No</button>
	                                </div>
	                            </form>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
        </div>
</body>
</html>
<script type="text/javascript">
var updateYesBtn;
function yes(){
    location.href = ('manageClassCodes.php');
}
function no(){
	 $("#isupdate").val(0);
	 $("#updateIds").val(""); 	
	 $('#createNewModalForm').modal('hide');
}
function saveAction(){
		$("#importClassCodesForm").ajaxSubmit(function (data){
            var json_data = $.parseJSON(data);
            var success= json_data.success;
            var message=json_data.message;
            if(success == 1){
                var response = "Total Success in importing data";
                $("#message").html(response);
                $('#createNewModalForm').modal('show');
            }else{
				   $('#createNewModalForm').modal('hide');
                   var flag = showResponseToastr(data,null,"importQCScheduleForm","ibox");
				   if(flag){
					  window.setTimeout(function(){window.location.href = "manageClassCodes.php"},500);
				   }  
			   }
        });
}
</script>'