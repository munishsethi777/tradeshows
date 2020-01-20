<?include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/GraphicsLog.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DropdownUtil.php");
$customerMgr = CustomerMgr::getInstance();
$customer = new Customer();
$customerSeq = 0;
$storeChecked = "";
$storeDisplay = "none";
$customerTextDisplay = "";
$customerSelectDisabled = "disabled";
$customerIdDisabled = "";
if(isset($_POST["id"])){
    $seq = $_POST["id"];
    $customer = $customerMgr->findByCustomerSeq($seq);
    if(!empty($customer->getIsStore())){
        $storeChecked = "checked";
        $storeDisplay = "block";
        $customerSelectDisabled = "";
        $customerTextDisplay = "none";
        $customerIdDisabled = "readonly";
    }
    $customerSeq = $customer->getSeq();
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
.outterDiv{
	border-bottom:1px silver dashed;
	padding:20px 10px;
}
.col-form-label{
	line-height:1;
}

.form-control{
	height:30px !important;
}
.icheckbox_square-green{
	margin-top:4px;
}
.form-group{
	margin-left:-15px !important;
}
.row{
	margin-left:0px !important;
}
.oppurtunityMainDiv .form-group{
	border-left:3px black solid;
}
.christmasMainDiv .form-group{
	border-left:3px #037d36 solid;
}
.springMainDiv .form-group{
	border-left:3px #29659e solid
}
.buttonsDiv{
	border-left:none !important;
}
.panel,.panel-heading{
	border-radius:0px;
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
							<h5 class="pageTitle">Create/Edit Customer Questionaire Information</h5>
					</nav>
                 </div>
                 <div class="ibox-content">
                 	<?include "progress.php"?>
                 	 <form id="createCustomerForm" method="post" action="Actions/CustomerAction.php" class="m-t-sm">
                     		<input type="hidden" id ="call" name="call"  value="saveCustomer"/>
                        	<input type="hidden" id ="seq" name="seq"  value="<?php echo $customerSeq?>"/>
                        	
                        	<div class="christmasMainDiv">
	                        	<div class="form-group row">
		                       		<label class="col-lg-4 col-form-label bg-primary"><h2>CHRISTMAS QUESTIONS</h2></label>
		                        </div>
		                        
		                        <div class="row">
									<div class="col-lg-6">
				                       <div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel">Are you Interested in Christmas?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isprivatelabel" name="isprivatelabel"/>
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
						                    	<label class="col-lg-8 col-form-label bg-formLabel">Have you sent them xmas catalog link?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isprivatelabel" name="isprivatelabel"/>
					                        	</div>
					                        </div>
				                        	<div class="row m-r-xxs">
				                        		<div class="panel panel-primary m-b-none">
													<div class="panel-heading">Notes</div>
													<div class="panel-body">
					                                   	<textarea class="form-control" maxLength="1000" name="usanotes" ></textarea>
													</div>
						                     	</div>
				                        	</div>
				                        </div>
				                        
				                        <div class="form-group">
				                        	<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel">Have we sent them Any xmas sample?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isprivatelabel" name="isprivatelabel"/>
					                        	</div>
					                        </div>
					                    </div>
				                    	<div class="form-group">
				                    		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel">Have we made an appt for a stragetic planning meeting?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isprivatelabel" name="isprivatelabel"/>
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel text-right">If Yes, Date?</label>
					                        	<div class="col-lg-4">
					                        		<input type="text" name="emptyreturndate" id="emptyreturndate" class="form-control dateControl">
					                        	</div>
					                        </div>
					                        <div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel">Have we invited them to xmas showroom?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isprivatelabel" name="isprivatelabel"/>
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
				                        		<label class="col-lg-8 col-form-label bg-formLabel text-right">Yes, Date?</label>
					                        	<div class="col-lg-4">
					                        		<input type="text" name="emptyreturndate" id="emptyreturndate" class="form-control dateControl">
					                        	</div>
					                        </div>
					                        <div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel text-right">No, Date?</label>
					                        	<div class="col-lg-4">
					                        		<input type="text" name="emptyreturndate" id="emptyreturndate" class="form-control dateControl">
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel">Holiday 2019 Comp Shop Completed?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isprivatelabel" name="isprivatelabel"/>
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel">Holiday 2019 Comp Shop Summary Email sent to SA Team and Robby?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isprivatelabel" name="isprivatelabel"/>
					                        	</div>
				                        	</div>
					                    </div>
					                    <div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel">When are you reviewing christmas 2020</label>
					                        	<div class="col-lg-4">
					                        		<input type="text" name="emptyreturndate" id="emptyreturndate" class="form-control dateControl">
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
						                    	<label class="col-lg-8 col-form-label bg-formLabel">Where is the customer going to select the xmas items?</label>
					                        	<div class="col-lg-4">
					                        		<select class="form-control">
					                        			<option>Will Select from Catalog</option>
					                        			<option>Need to make Presentation</option>
					                        			<option>Coming to our Showroom</option>
					                        			<option>Meeting in Atlanta</option>
					                        		</select>
					                        	</div>
					                        </div>
				                        </div>
				                   </div> 
				                    
				                    
				                    
				                    
				                    
				                    <div class="col-lg-6">
				                    	<div class="form-group">
					                    	<div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel">Did we pitch that we want to be your main vendor of Holiday and Décor?
		 And my customers are vendor consolidating?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isprivatelabel" name="isprivatelabel"/>
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
					                        	<div class="panel panel-primary m-b-none">
													<div class="panel-heading">Notes</div>
													<div class="panel-body">
					                                   	<textarea class="form-control" maxLength="1000" name="usanotes"></textarea>
													</div>
						                     	</div>
						                     </div>
										</div>
										<div class="form-group">
						                     <div class="row m-b-xxs">
						                     	<label class="col-lg-8 col-form-label bg-formLabel">Did they buy xmas last year?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isprivatelabel" name="isprivatelabel"/>
					                        	</div>
					                        </div>
					                        <div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel">If Yes, How Much?</label>
					                        	<div class="col-lg-4">
					                        		<input type="text" name="emptyreturndate" id="emptyreturndate" class="form-control dateControl">
					                        	</div>
					                        </div>
										</div>
										<div class="form-group">
					                        <div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel">Are we receiving sell thru if they bought last year?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isprivatelabel" name="isprivatelabel"/>
					                        	</div>
					                        </div>
					                        <div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel">Have Robby Reviewed Sell through?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isprivatelabel" name="isprivatelabel"/>
					                        	</div>
				                        	</div>
										</div>
										<div class="form-group">
											 <div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel">Should i visit this customer during the 4th qtr to comp shop their xmas items?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isprivatelabel" name="isprivatelabel"/>
					                        	</div>
				                        	</div>
										</div>
		                        		<div class="form-group">
											 <div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel">When do we need to quote you christmas by?</label>
					                        	<div class="col-lg-4">
					                        		<input type="text" name="emptyreturndate" id="emptyreturndate" class="form-control dateControl">
					                        	</div>
				                        	</div>
										</div>
		                        	
				                    	</div>
				                	</div>
				                
				                
				                
				                
				                
		                       
		                       
		                        <div class="form-group row buttonsDiv">
		                       		<div class="col-lg-2">
			                        	<button class="btn btn-primary" onclick="saveCustomer()" type="button" style="width:85%">Save</button>
			                        </div>
			                        <div class="col-lg-2">
			                          	<a class="btn btn-default" href="manageCustomers.php" type="button" style="width:85%">Cancel</a>
			                        </div>
			                    </div>
							</div>
	                   </form>
	                   
	                   <form id="createCustomerForm" method="post" action="Actions/CustomerAction.php" class="m-t-xl">
                     		<input type="hidden" id ="call" name="call"  value="saveCustomer"/>
                        	<input type="hidden" id ="seq" name="seq"  value="<?php echo $customerSeq?>"/>
                        	<div class="oppurtunityMainDiv">
	                        	<div class="form-group row">
		                       		<label class="col-lg-4 col-form-label bg-formLabelDark"><h2>OPPORTUNITY BUYS</h2></label>
		                        </div>
		                        <div class="row">
									<div class="col-lg-6">
				                       <div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelDark">What trade shows are they going to in 2021?</label>
					                        	<div class="col-lg-4">
					                        		<select class="form-control">
					                        			<option>Select any</option>
					                        		</select>
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
						                    	<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelDark">Have you sent them xmas catalog link?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isprivatelabel" name="isprivatelabel"/>
					                        	</div>
					                        </div>
				                        </div>
				                   	</div> 
				                    <div class="col-lg-6">
				                    	<div class="form-group">
					                    	<div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelDark">Closeout and left over List Sent Date : <br><small>(Give them every day items and Amazing prices to keep conversatin alive all the time)</small></label>
					                        	<div class="col-lg-4">
					                        		<div class="input-group date">
					                               		<input type="text" name="emptylfddate" id="emptylfddate" class="form-control  dateControl">
					                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					                            	</div>
					                        	</div>
				                        	</div>
										</div>
			                    	</div>
		                		</div>
		                        <div class="form-group row buttonsDiv">
		                       		<div class="col-lg-2">
			                        	<button class="btn bg-formLabelDark" onclick="saveCustomer()" type="button" style="width:85%">Save</button>
			                        </div>
			                        <div class="col-lg-2">
			                          	<a class="btn btn-default" href="manageCustomers.php" type="button" style="width:85%">Cancel</a>
			                        </div>
			                    </div>
		                    </div>
	                   </form> 
	                   
	                   
	                   
	                   
	                   
	                   
	                   <form id="createCustomerForm" method="post" action="Actions/CustomerAction.php" class="m-t-xl">
                     		<input type="hidden" id ="call" name="call"  value="saveCustomer"/>
                        	<input type="hidden" id ="seq" name="seq"  value="<?php echo $customerSeq?>"/>
                        	<div class="springMainDiv">
	                        	<div class="form-group row">
		                       		<label class="col-lg-4 col-form-label bg-formLabelMauve"><h2>SPRING QUESTIONS</h2>
		                       			<br><small>(Questions for Each buyer if handling different categories)</small>
		                       		</label>
		                        </div>
		                        <div class="row">
									<div class="col-lg-6">
				                       <div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Have you sent them Spring catalog link?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isprivatelabel" name="isprivatelabel"/>
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs m-r-xxs">
				                        		<div class="panel panel-mauve m-b-none">
													<div class="panel-heading">Notes</div>
				                                    <div class="panel-body">
					                                    	<textarea  style="font-size:12px" id="notificationnotes" name="notificationnotes" class="form-control"
					                                			maxLength="1000"></textarea>
				                                    </div>
				                                </div> 
				                        	</div>
				                        </div>
				                        <div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Have we sent them any Spring sample?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isprivatelabel" name="isprivatelabel"/>
					                        	</div>
				                        	</div>
				                        </div>
				                        <div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Have we made an appointment for a stragetic planning meeting?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isprivatelabel" name="isprivatelabel"/>
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">If Yes, Date?</label>
					                        	<div class="col-lg-4">
					                        		<div class="input-group date">
					                               		<input type="text" name="emptylfddate" id="emptylfddate" class="form-control  dateControl">
					                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					                            	</div>
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Have we invited them to Spring showroom?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isprivatelabel" name="isprivatelabel"/>
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">If Yes, Date?</label>
					                        	<div class="col-lg-4">
					                        		<div class="input-group date">
					                               		<input type="text" name="emptylfddate" id="emptylfddate" class="form-control  dateControl">
					                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					                            	</div>
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">If No, Reminder Date?</label>
					                        	<div class="col-lg-4">
					                        		<div class="input-group date">
					                               		<input type="text" name="emptylfddate" id="emptylfddate" class="form-control  dateControl">
					                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					                            	</div>
					                        	</div>
				                        	</div>
				                        </div>
				                        <div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Is Spring 2020 Comp Shop Completed?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isprivatelabel" name="isprivatelabel"/>
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Spring 2020 Comp Shop Summary Email sent to SA Team and Robby?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isprivatelabel" name="isprivatelabel"/>
					                        	</div>
				                        	</div>
				                        </div>
				                        <div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">When are you reviewing spring 2021?</label>
					                        	<div class="col-lg-4">
					                        		<select class="form-control">
					                        			<option>Select any</option>
					                        		</select>
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Where is the customer going to select the Spring items?</label>
					                        	<div class="col-lg-4">
					                        		<select class="form-control">
					                        			<option>Select any</option>
					                        		</select>
					                        	</div>
				                        	</div>
				                        </div>
				                        
				                        
				                   	</div> 
				                    <div class="col-lg-6">
				                    	<div class="form-group">
					                    	<div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Did we pitch that we want to be your main vendor of Holiday and Décor?<br>And my customers are vendor consolidating?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isprivatelabel" name="isprivatelabel"/>
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs m-r-xxs">
				                        		<div class="panel panel-mauve m-b-none">
													<div class="panel-heading">Notes</div>
				                                    <div class="panel-body">
					                                    	<textarea  style="font-size:12px" id="notificationnotes" name="notificationnotes" class="form-control"
					                                			maxLength="1000"></textarea>
				                                    </div>
				                                </div> 
				                        	</div>
										</div>
										<div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">What categories have they not bought That I should sell them?<br><small>Example Bistro Sets</small></label>
					                        	<div class="col-lg-4">
					                        		<select class="form-control">
					                        			<option>Select any</option>
					                        		</select>
					                        	</div>
				                        	</div>
				                        </div>
										
										<div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Are we receiving sell thru if they bought last year?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isprivatelabel" name="isprivatelabel"/>
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Have Robby Reviewed Sell through?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isprivatelabel" name="isprivatelabel"/>
					                        	</div>
				                        	</div>
				                        </div>
										<div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Should I visit this customer during the 2ND qtr to comp shop their spring items?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isprivatelabel" name="isprivatelabel"/>
					                        	</div>
				                        	</div>
				                        </div>
				                        <div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">When do we need to quote you christmas by?</label>
					                        	<div class="col-lg-4">
					                        		<div class="input-group date">
					                               		<input type="text" name="emptylfddate" id="emptylfddate" class="form-control  dateControl">
					                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					                            	</div>
					                        	</div>
				                        	</div>
				                        </div>
				                        <div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Should I visit this customer during the 2ND qtr to comp shop their spring items?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isprivatelabel" name="isprivatelabel"/>
					                        	</div>
				                        	</div>
				                        </div>
				                        <div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">When do we need to qote you Spring by?</label>
					                        	<div class="col-lg-4">
					                        		<div class="input-group date">
					                               		<input type="text" name="emptylfddate" id="emptylfddate" class="form-control  dateControl">
					                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					                            	</div>
					                        	</div>
				                        	</div>
				                        </div>
										
			                    	</div>
		                		</div>
		                        <div class="form-group row buttonsDiv">
		                       		<div class="col-lg-2">
			                        	<button class="btn bg-formLabelMauve" onclick="saveCustomer()" type="button" style="width:85%">Save</button>
			                        </div>
			                        <div class="col-lg-2">
			                          	<a class="btn btn-default" href="manageCustomers.php" type="button" style="width:85%">Cancel</a>
			                        </div>
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

	$('.delete').click(function() {
		deleteBuyer(this);	
	});
	
});

var index = 0;
function addBuyer(isDefaultRow,buyer){
	var firstName = "";
	var lastName = "";
	var emailid = "";
	var phone = "";
	var cellPhone = "";
	var note = "";
	var category = "";
	index++;
	var id = index;
	if (typeof buyer !== "undefined"){
		if(buyer.firstname != null){
			firstName = buyer.firstname;
		}
		if(buyer.lastname != null){
			lastName = buyer.lastname;
		}
		if(buyer.email != null){
			emailid = buyer.email;
		}
		if(buyer.officephone != null){
			phone = buyer.officephone;
		}
		if(buyer.cellphone != null){
			cellPhone = buyer.cellphone;
		}
		if(buyer.notes != null){
			note = buyer.notes;
		}
		category = buyer.category;
		id = buyer.seq
	}
	var ddId =  'categorySelectDiv'+id;
	var html = '<div class="buyerDiv">';
   		html += '<div class="form-group row m-b-xs">';
		html += '<div class="col-lg-2 p-xxs no-margins">';
		html += '<input type="text" required maxLength="250" value="'+firstName+'" name="firstname[]" class="form-control" placeholder="firstname">';
		html += '</div>'
		html += '<div class="col-lg-2 p-xxs no-margins">';
		html += '<input type="text"  maxLength="250" value="'+lastName+'" name="lastname[]" class="form-control" placeholder="lastname">';
		html += '</div>';
		html += '<div class="col-lg-2 p-xxs no-margins">';
		html += '<input type="text"  maxLength="250" value="'+emailid+'" name="emailid[]" class="form-control" placeholder="emailid">';
		html += '</div>';
		html += '<div class="col-lg-2 p-xxs no-margins">';
		html += '<input type="text"  maxLength="250" value="'+phone+'" name="phone[]" class="form-control" placeholder="phone">';
		html += '</div>';
		html += '<div class="col-lg-2 p-xxs no-margins">';
		html += '<input type="text"  maxLength="250" value="'+cellPhone+'" name="cellphone[]" class="form-control" placeholder="cellphone">';
		html += '</div>';
		html += '<div class="col-lg-2 p-xxs no-margins">';
		html += '<div id="'+ddId+'"><select name="category[]" class="form-control">';
		html += '</select></div>';
		html += '</div>';
		html += '</div>';
		html += '<div class="form-group row">';
		html += '<div class="col-lg-11 p-xxs">';
		html += '<textarea name="notes[]" placeholder="notes" class="form-control">'+note+'</textarea>';
		html +='</div>';
		if (typeof isDefaultRow === "undefined" || isDefaultRow == false) {
    		html += '<div class="col-lg-1 pull-right">';
    		html += '<a onclick="deleteBuyer(this)" title="Delete" alt="Delete"><h2><i class="fa fa-remove text-danger"></i></h2></a>'
    		html += '</div>';
		}
		html += '<div class="col-lg-12 p-xxs" style="border-bottom: 1px silver dashed;"></div>';
		html += '</div></div>';
		$("#buyers").append(html);
		
		populateBuyerCategories(category,ddId);
}

function populateCustomerBuyers(){
	if(customerSeq != 0){
    	$.get("Actions/CustomerAction.php?call=getCustomerBuyers&id=<?php echo $customerSeq ?>", function(data){
       		var jsonData = $.parseJSON(data);
       		var buyers = jsonData.buyers;
       		var i = 0;
       		$.each( buyers, function( index, buyer ){
           		if(i == 0){
       				addBuyer(true,buyer);
           		}else{
           			addBuyer(false,buyer);
           		} 
           		i++;
       		});
       		
		});
	}else{
		addBuyer(true)
	}
}
function setCustomerId(seq){
	$.get("Actions/CustomerAction.php?call=getCustomerIdBySeq&seq="+seq, function(data){
   		var jsonData = $.parseJSON(data);
   		var customerId = jsonData.customerid;	
   		$("#customerid").val(customerId);
	});
}
function loadCustomers(){		
    $(".fullNameSelect").select2({
        ajax: {
        url: "Actions/CustomerAction.php?call=searchCustomer",
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
            q: params.term, // search term
            page: params.page
          };
        },
        processResults: function (data, page) {
          return data;
        },
        cache: true
      },
      minimumInputLength: 1,
      width: '100%'
    });
    var selectedSeqs = "<?echo $seq?>";
    if(selectedSeqs.length > 0){
    	$(".fullNameSelect").val(selectedSeqs).trigger('change', [{flag:true}]);
    } 
    
}

function populateBuyerCategories(selected,selectDivId){
	$.get("Actions/CustomerAction.php?call=getBuyerCategories&selected="+selected, function(data){
   		var jsonData = $.parseJSON(data);
   		var ddhtml = jsonData.categoryDD;	
   		$("#"+selectDivId).html(ddhtml);
	});
}

function deleteBuyer(btn){
	$(btn).closest('.buyerDiv').remove();
// 	if(index > 0){
// 		index--;
// 	}
}

function saveCustomer(){
	if($("#createCustomerForm")[0].checkValidity()) {
		showHideProgress()
		$('#createCustomerForm').ajaxSubmit(function( data ){
		   showHideProgress();
		   var flag = showResponseToastr(data,null,null,"ibox");
		   if(flag){
			   window.setTimeout(function(){window.location.href = "manageCustomers.php"},100);
		   }
	    })	
	}else{
		$("#createCustomerForm")[0].reportValidity();
	}
}
</script>