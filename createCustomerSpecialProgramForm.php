<?include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/AlpineSpecialProgram.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/AlpineSpecialProgramMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DropdownUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
$alpineSpecialProgMgr = AlpineSpecialProgramMgr::getInstance();
$alpineSpecialProg = new AlpineSpecialProgram();
$customerSeq = 0;
$isediCustomerchecked = "";
$defectiveAllowancesignedChecked = "";
$IsBackOrderAcceptedchecked = "";
$startDate = null;
$endDate = null;
if(isset($_POST["customerSeq"])){
    $customerSeq = $_POST["customerSeq"];
    $alpineSpecialProg = $alpineSpecialProgMgr->findByCustomerSeq($customerSeq);
    if(empty($alpineSpecialProg)){
        $alpineSpecialProg = new AlpineSpecialProgram();
    }
    if(!empty($alpineSpecialProg->getIsEDICustomer())){
        $isediCustomerchecked = "checked";
    }
    if(!empty($alpineSpecialProg->getIsDefectiveAllowancesigned())){
        $defectiveAllowancesignedChecked = "checked";
    }
    if(!empty($alpineSpecialProg->getIsBackOrderAccepted())){
        $IsBackOrderAcceptedchecked = "checked";
    }
    if(!empty($alpineSpecialProg->getStartDate())){
        $startDate = DateUtil::convertDateToFormat($alpineSpecialProg->getStartDate(), "Y-m-d", "m-d-Y") ;
    }
    if(!empty($alpineSpecialProg->getEndDate())){
        $endDate = DateUtil::convertDateToFormat($alpineSpecialProg->getEndDate(), "Y-m-d", "m-d-Y") ;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin | Create Special Program</title>
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
.buyers input,.buyers select{
	font-size:12px;
	padding:4px;
	height:25px;
}
.buyers textarea{
	font-size:12px;
	padding:4px;
}
#category{
	margin-bottom:0px !important;
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
							<h5 class="pageTitle">Create/Edit Customer Special Program Information</h5>
					</nav>
                 </div>
                 <div class="ibox-content">
                 	<?include "progress.php"?>
                 	 <form id="createAlpineProgForm" method="post" action="Actions/AlpineSpecialProgramAction.php" class="m-t-sm">
                     	<input type="hidden" id ="call" name="call"  value="saveAlpineProg"/>
                        	<input type="hidden" id ="customerseq" name="customerseq"  value="<?php echo $customerSeq?>"/>
                        	
                        	
                        	<div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Start Date</label>
	                        	<div class="col-lg-4">
	                        		<div class="input-group date">
                                		<input type="text" required  maxLength="250" value="<?php echo $startDate?>" name="startdate" id="startdate" class="form-control dateControl">
	                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                            	</div>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">End Date</label>
	                        	<div class="col-lg-4">
	                        		<div class="input-group date">
                                		<input type="text" required  maxLength="250" value="<?php echo $endDate?>" name="enddate" id="enddate" class="form-control dateControl">
	                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                            	</div>
	                            </div>
	                       	</div>
	                       	
                        	<div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Price Program </label>
	                        	<div class="col-lg-4">
	                        		<input type="text" required  maxLength="250" value="<?php echo $alpineSpecialProg->getPriceProgram()?>" name="priceprogram" id="priceprogram" class="form-control">
	                        	</div>
	                        </div>
                        	<div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Regular Terms</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" required  maxLength="250" value="<?php echo $alpineSpecialProg->getRegularTerms()?>" name="regularterms" id="regularterms" class="form-control">
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">InSeason Terms</label>
	                        	<div class="col-lg-4">
 	                        		<input type="text" required  maxLength="250" value="<?php echo $alpineSpecialProg->getInseasonTerms()?>" name="inseasonterms" id="inseasonterms" class="form-control">
	                            </div>
	                       	</div>
                        	
                        	<div class="form-group row i-checks">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Freight</label>
	                        	<div class="col-lg-4">
	                        		<?php 
	                        		    $select = DropDownUtils::getFreightTypes("freight", null, $alpineSpecialProg->getFreight(),false,true);
    			                        echo $select;
	                             	?>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">EDI Customer</label>
	                        	<div class="col-lg-4">
 	                        		<input type="checkbox" name="isedicustomer" <?php echo $isediCustomerchecked?> class="form-control"/>
	                            </div>
	                       	</div>
                        	
                        	<div class="form-group row i-checks">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Defective Allowance</label>
	                        	<div class="col-lg-4">
	                        		<input type="checkbox" name="isdefectiveallowancesigned" <?php echo $defectiveAllowancesignedChecked?> class="form-control"/>
	                        	</div>
	                        	
	                        	<label class="col-lg-2 col-form-label bg-formLabel">Rebate Program<br> <small>and method of payment</small></label>
	                        	<div class="col-lg-4">
	                        		<input type="text" required  maxLength="250" value="<?php echo $alpineSpecialProg->getRebateProgramAndPaymentMethod()?>" name="rebateprogramandpaymentmethod" id="rebateprogramandpaymentMethod" class="form-control">
	                        	</div>
	                        </div>
                        	<div class="form-group row i-checks">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Defective %</label>
	                        	<div class="col-lg-4">
	                        		<input type="text" required  maxLength="250" value="<?php echo $alpineSpecialProg->getDefectivePercent()?>" name="defectivepercent" id="defectivepercent" class="form-control">
	                        	</div>
	                        	<label class="col-lg-2 col-form-label bg-formLabel">Paying back to customer</label>
	                        	<div class="col-lg-4">
	                        		<input type="text" required  maxLength="250" value="<?php echo $alpineSpecialProg->getHowPayingBackCustomer()?>" name="howpayingbackcustomer" id="howpayingbackcustomer" class="form-control">
	                        	</div>
	                        </div>
                        	<div class="form-group row i-checks">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Defective Allowance Deductions</label>
	                        	<div class="col-lg-4">
	                        		<?php 
	                        		    $select = DropDownUtils::getDefectiveAllowanceDeductionsTypes("howdefectiveallowancededucted", null, $alpineSpecialProg->getHowDefectiveAllowanceDeducted(),false,true);
    			                        echo $select;
	                             	?>
	                        	</div>
	                        </div>
                        	
                        	<div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Promotional Allowance<br> <small>and method of payment</small></label>
	                        	<div class="col-lg-10">
	                        		<input type="text" required  maxLength="250" value="<?php echo $alpineSpecialProg->getPromotionalAllowance()?>" name="promotionalallowance" id="promotionalallowance" class="form-control">
	                        	</div>
	                        </div>
	                       	<div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Other Allowances<br> <small>and method of payment</small></label>
	                        	<div class="col-lg-10">
	                        		<input type="text" required  maxLength="250" value="<?php echo $alpineSpecialProg->getOtherAllowance()?>" name="otherallowance" id="otherallowance" class="form-control">
	                        	</div>
	                        </div>
	                       	<div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Additional Remarks</label>
	                        	<div class="col-lg-10">
	                        		<input type="text" required  maxLength="250" value="<?php echo $alpineSpecialProg->getAdditionalRemarks()?>" name="additionalremarks" id="additionalremarks" class="form-control">
	                        	</div>
	                        </div>
	                       	<div class="form-group row i-checks">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Is back Order Accepted?</label>
	                        	<div class="col-lg-4">
	                        		<input type="checkbox" name="isbackorderaccepted" <?php echo $IsBackOrderAcceptedchecked?> class="form-control"/>
	                        	</div>
	                        </div>
	                        
	                        <div class="form-group row">
	                       		<div class="col-lg-2">
		                        	<button class="btn btn-primary" onclick="saveAlpinProg()" type="button" style="width:85%">
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
var customerSeq = "<?php echo $customerSeq ?>";
$(document).ready(function(){
	//$(".fullNameSelect").chosen({ width: '100%' });
	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
	   	radioClass: 'iradio_square-green',
	});
	$('.dateControl').datetimepicker({
	    timepicker:false,
	    format:'m-d-Y',
	    scrollMonth : false,
		scrollInput : false,
		onSelectDate:function(ct,$i){
			//setDuration();
		}
	})
});

var index = 0;
function saveAlpinProg(){
	if($("#createAlpineProgForm")[0].checkValidity()) {
		showHideProgress()
		$('#createAlpineProgForm').ajaxSubmit(function( data ){
		   showHideProgress();
		   var flag = showResponseToastr(data,null,null,"ibox");
		   if(flag){
			   window.setTimeout(function(){window.location.href = "manageCustomers.php"},100);
		   }
	    })	
	}else{
		$("#createAlpineProgForm")[0].reportValidity();
	}
}
</script>