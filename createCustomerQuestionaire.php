<?include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/CustomerChristmasQuestion.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerChristmasQuestionMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/CustomerOppurtunityBuy.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerOppurtunityBuyMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/CustomerSpringQuestion.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerSpringQuestionMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DropdownUtil.php");
$customerChristmasQuestionMgr = CustomerChristmasQuestionMgr::getInstance();
$customerChristmasQuestion = new CustomerChristmasQuestion();

$customerOppurtunityBuyMgr = CustomerOppurtunityBuyMgr::getInstance();
$customerOppurtunityBuy = new CustomerOppurtunityBuy();

$customerSpringQuestionMgr= CustomerSpringQuestionMgr::getInstance();
$customerSpringQuestion = new CustomerSpringQuestion();

$customerSeq = 0;
if(isset($_POST["customerSeq"])){
    $customerSeq = $_POST["customerSeq"];
    $customerChristmasQuestion = $customerChristmasQuestionMgr->findByCustomerSeq($customerSeq);
    if(empty($customerChristmasQuestion)){
        $customerChristmasQuestion = new CustomerChristmasQuestion();
    }
    $customerOppurtunityBuy = $customerOppurtunityBuyMgr->findByCustomerSeq($customerSeq);
    if(empty($customerOppurtunityBuy)){
        $customerOppurtunityBuy = new CustomerOppurtunityBuy();
    }
    $customerSpringQuestion = $customerSpringQuestionMgr->findByCustomerSeq($customerSeq);
    if(empty($customerSpringQuestion)){
        $customerSpringQuestion = new CustomerSpringQuestion();
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
#customerselectxmasitemsfrom{
	margin-bottom:0px !important;
}
.bg-formLabel,
.panel-primary > .panel-heading,
.panel-mauve > .panel-heading{
	background-color:#f3f3f4 !important;
	border-color:rgba(236, 236, 236, 1) !important;
	color:#676a6c;
}
.panel-primary,
.panel-mauve{
	border-color:rgba(236, 236, 236, 1) !important;
}
.primaryLI{
	background-color:#1ab394 !important;
	border-radius:4px 4px 0px 0px;
}
.mauveLI{
	background-color:#A4C2F4 !important;
	border-radius:4px 4px 0px 0px;
}
.darkLI{
	background-color:rgba(0, 0, 0, 0.6) !important;
	border-radius:4px 4px 0px 0px;
}
.nav-tabs > li > a{
	color:grey;
}
.nav > li.active a{
	color:white !important;
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
                 	<ul class="nav nav-tabs" role="tablist">
		            	<li class="primaryLI active"><a class="nav-link" data-toggle="tab" href="#tab-1"> CHRISTMAS QUESTIONS</a></li>
						<li class="darkLI"><a class="nav-link" data-toggle="tab" href="#tab-2">OPPURTUNITY BUYS</a></li>
						<li class="mauveLI"><a class="nav-link" data-toggle="tab" href="#tab-3">SPRING QUESTIONS</a></li>
					</ul>
					<div class="tab-content">
						<div role="tabpanel" id="tab-1" class="tab-pane active">
                 		<form id="createChristmasQuestionForm" method="post" action="Actions/CustomerChristmasQuestionAction.php" class="m-t-sm">
                     		<input type="hidden" id ="call" name="call"  value="savechristmasQuestion"/>
                        	<input type="hidden" id ="customerseq" name="customerseq"  value="<?php echo $customerSeq?>"/>
                        	
                        	<div class="christmasMainDiv">
<!-- 	                        	<div class="form-group row"> -->
<!-- 		                       		<label class="col-lg-4 col-form-label bg-primary"><h2>CHRISTMAS QUESTIONS</h2></label> -->
<!-- 		                        </div> -->
		                        
		                        <div class="row">
									<div class="col-lg-10">
										<div class="form-group">
				                        	<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel">Data Saving for Year</label>
					                        	<div class="col-lg-4">
					                        		<select class="form-control">
					                        			<option>2020</option>
					                        			<option>2021</option>
					                        		</select>
					                        	</div>
					                        </div>
					                    </div>
				                       <div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel">Are you Interested in Christmas?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isinterested" name="isinterested"  <?php echo !empty($customerChristmasQuestion->getIsInterested())? "checked" : ""?>/>
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
						                    	<label class="col-lg-8 col-form-label bg-formLabel">Have you sent them xmas catalog link?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="iscataloglinksent" name="iscataloglinksent" <?php echo !empty($customerChristmasQuestion->getIsCatalogLinkSent())?"checked":"" ?>/>
					                        	</div>
					                        </div>
				                        	<div class="row m-r-xxs">
				                        		<div class="panel panel-primary m-b-none">
													<div class="panel-heading">Notes</div>
													<div class="panel-body">
					                                   	<textarea class="form-control" maxLength="1000" name="cataloglinksentnotes" id="cataloglinksentnotes"><?php echo $customerChristmasQuestion->getCatalogLinkSentNotes()?></textarea>
													</div>
						                     	</div>
				                        	</div>
				                        </div>
				                        
				                        <div class="form-group">
				                        	<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel">Have we sent them Any xmas sample?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" va class="i-checks form-control" id="isxmassamplessent" name="isxmassamplessent" <?php echo !empty($customerChristmasQuestion->getIsXmasSamplesSent())?"checked":""?>//>
					                        	</div>
					                        </div>
					                    </div>
				                    	<div class="form-group">
				                    		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel">Have we made an appt for a stragetic planning meeting?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isstrategicplanningmeetingappointment" name="isstrategicplanningmeetingappointment" <?php echo !empty($customerChristmasQuestion->getIsStrategicPlanningMeetingAppointment())?"checked":""?>//>
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel text-right">If Yes, Date?</label>
					                        	<div class="col-lg-4">
					                        		<input type="text" value="<?php echo $customerChristmasQuestion->getStrategicPlanningMeetDate()?>" name="strategicplanningmeetdate" id="strategicplanningmeetdate" class="form-control dateControl">
					                        	</div>
					                        </div>
					                        <div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel">Have we invited them to xmas showroom?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isinvitedtoxmasshowroom" name="isinvitedtoxmasshowroom" <?php echo !empty($customerChristmasQuestion->getIsInvitedToXmasShowroom())?"checked":""?>/>
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
				                        		<label class="col-lg-8 col-form-label bg-formLabel text-right">Yes, Date?</label>
					                        	<div class="col-lg-4">
					                        		<input type="text" value="<?php echo $customerChristmasQuestion->getInvitedtoXmasShowRoomDate()?>" name="invitedtoxmasshowroomdate" id="invitedtoxmasshowroomdate" class="form-control dateControl" />
					                        	</div>
					                        </div>
					                        <div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel text-right">No, Reminder Date?</label>
					                        	<div class="col-lg-4">
					                        		<input type="text" value="<?php echo $customerChristmasQuestion->getInvitedToxMasShowroomReminderDate()?>" name="invitedtoxmasshowroomreminderdate" id="invitedtoxmasshowroomreminderdate" class="form-control dateControl">
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel">Holiday 2019 Comp Shop Completed?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isholidayshopcompleted" name="isholidayshopcompleted" <?php echo !empty($customerChristmasQuestion->getIsHolidayShopCompleted())?"checked":"" ?>/>
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel">Holiday 2019 Comp Shop Summary Email sent to SA Team and Robby?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="$isholidayshopcomsummaryemailsent" name="isholidayshopcomsummaryemailsent" <?php echo !empty($customerChristmasQuestion->getIsHolidayShopComSummaryEmailSent())?"checked":""?>/>
					                        	</div>
				                        	</div>
					                    </div>
					                    <div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel">When are you reviewing christmas 2020</label>
					                        	<div class="col-lg-4">
					                        		<input type="text" value="<?php echo $customerChristmasQuestion->getChristmas2020ReviewingDate()?>" name="christmas2020reviewingdate" id="christmas2020reviewingdate" class="form-control dateControl">
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
						                    	<label class="col-lg-8 col-form-label bg-formLabel">Where is the customer going to select the xmas items?</label>
					                        	<div class="col-lg-4">
					                        		<?php 
					                        		    $select = DropDownUtils::getXmasItemFromDD("customerselectxmasitemsfrom", null, $customerChristmasQuestion->getCustomerSelectXmasItemsFrom(),false,true);
                    			                        echo $select;
                	                             	?>
					                        	</div>
					                        </div>
				                        </div>
				                   </div> 
				                    
				                    
				                    
				                    
				                    
				                    <div class="col-lg-10">
				                    	<div class="form-group">
					                    	<div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel">Did we pitch that we want to be your main vendor of Holiday and Décor?
		 And my customers are vendor consolidating?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="ismainvendor" name="ismainvendor" <?php echo !empty($customerChristmasQuestion->getIsMainVendor())?"checked":"" ?> />
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
					                        	<div class="panel panel-primary m-b-none">
													<div class="panel-heading">Notes</div>
													<div class="panel-body">
					                                   	<textarea class="form-control" maxLength="1000" name="mainvendornotes"><?php echo $customerChristmasQuestion->getMainVendorNotes()?></textarea>
													</div>
						                     	</div>
						                     </div>
										</div>
										<div class="form-group">
						                     <div class="row m-b-xxs">
						                     	<label class="col-lg-8 col-form-label bg-formLabel">Did they buy xmas last year?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isxmasbuylastyear" name="isxmasbuylastyear" <?php echo !empty($customerChristmasQuestion->getIsXmasBuyLastYear())?"checked":""?>/>
					                        	</div>
					                        </div>
					                        <div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel">If Yes, How Much?</label>
					                        	<div class="col-lg-4">
					                        		<input type="text" name="xmasbuylastyearamount" value="<?php echo $customerChristmasQuestion->getXmasBuyLastYearAmount()?>" id="xmasbuylastyearamount" class="form-control">
					                        	</div>
					                        </div>
										</div>
										<div class="form-group">
					                        <div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel">Are we receiving sell thru if they bought last year?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isreceivingsellthru" name="isreceivingsellthru" <?php echo !empty($customerChristmasQuestion->getIsReceivingSellThru())?"checked":"" ?>/>
					                        	</div>
					                        </div>
					                        <div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel">Have Robby Reviewed Sell through?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isrobbyreviewedsellthrough" name="isrobbyreviewedsellthrough" <?php echo !empty($customerChristmasQuestion->getIsRobbyReviewedSellThrough())?"checked":""?>/>
					                        	</div>
				                        	</div>
										</div>
										<div class="form-group">
											 <div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel">Should i visit this customer during the 4th qtr to comp shop their xmas items?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isvisitcustomerin4qtr" name="isvisitcustomerin4qtr" <?php echo !empty($customerChristmasQuestion->getIsVisitCustomerIn4Qtr())?"checked":""?>/>
					                        	</div>
				                        	</div>
										</div>
		                        		<div class="form-group">
											 <div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel">When do we need to quote you christmas by?</label>
					                        	<div class="col-lg-4">
					                        		<input type="text" value="<?php echo $customerChristmasQuestion->getInvitedToxMasShowroomReminderDate()?>" name="invitedtoxmasshowroomreminderdate" id="invitedtoxmasshowroomreminderdate" class="form-control dateControl">
					                        	</div>
				                        	</div>
										</div>
		                        	
				                    	</div>
				                	</div>
				                <div class="form-group row buttonsDiv">
		                       		<div class="col-lg-2">
			                        	<button class="btn btn-primary" onclick="saveQuestionnaire('createChristmasQuestionForm')" type="button" style="width:85%">Save</button>
			                        </div>
			                        <div class="col-lg-2">
			                          	<a class="btn btn-default" href="manageCustomers.php" type="button" style="width:85%">Cancel</a>
			                        </div>
			                    </div>
							</div>
	                   </form>
	                   </div>
		                <div role="tabpanel" id="tab-2" class="tab-pane">
		                   <form id="createOppurtunityBuyForm" method="post" action="Actions/CustomerOppurtunityBuyAction.php" class="m-t-sm">
                     		<input type="hidden" id ="call" name="call"  value="saveOppurtunityBuy"/>
                        	<input type="hidden" id ="customerseq" name="customerseq"  value="<?php echo $customerSeq?>"/>
                        	<div class="oppurtunityMainDiv">
<!-- 	                        	<div class="form-group row"> -->
<!-- 		                       		<label class="col-lg-4 col-form-label bg-formLabelDark"><h2>OPPORTUNITY BUYS</h2></label> -->
<!-- 		                        </div> -->
		                        <div class="row">
									<div class="col-lg-10">
										<div class="form-group">
				                        	<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel">Data Saving for Year</label>
					                        	<div class="col-lg-4">
					                        		<select class="form-control">
					                        			<option>2020</option>
					                        			<option>2021</option>
					                        		</select>
					                        	</div>
					                        </div>
					                    </div>
				                       <div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelDark">What trade shows are they going to in 2021?</label>
					                        	<div class="col-lg-4">
					                        		<input type="text" name="tradeshowsgoingto" value="<?php echo $customerOppurtunityBuy->getTradeshowsGoingTo()?>" id="tradeshowsgoingto" class="form-control">
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
						                    	<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelDark">Have you sent them xmas catalog link?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isxmascateloglinksent" name="isxmascateloglinksent" <?php echo !empty($customerOppurtunityBuy->getIsXmasCatelogLinkSent())?"checked":""?>/>
					                        	</div>
					                        </div>
				                        </div>
				                   	</div> 
				                    <div class="col-lg-10">
				                    	<div class="form-group">
					                    	<div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelDark">Closeout and left over List Sent Date : <br><small>(Give them every day items and Amazing prices to keep conversatin alive all the time)</small></label>
					                        	<div class="col-lg-4">
					                        		<div class="input-group date">
					                               		<input type="text" name="closeoutleftoversincedate" value="<?php echo $customerOppurtunityBuy->getCloseOutleftOverSinceDate()?>" id="closeoutleftoversincedate" class="form-control  dateControl">
					                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					                            	</div>
					                        	</div>
				                        	</div>
										</div>
			                    	</div>
		                		</div>
		                        <div class="form-group row buttonsDiv">
		                       		<div class="col-lg-2">
			                        	<button class="btn bg-formLabelDark" onclick="saveQuestionnaire('createOppurtunityBuyForm')" type="button" style="width:85%">Save</button>
			                        </div>
			                        <div class="col-lg-2">
			                          	<a class="btn btn-default" href="manageCustomers.php" type="button" style="width:85%">Cancel</a>
			                        </div>
			                    </div>
		                    </div>
	                   </form> 
	                   </div>
	                   
	                   
	                   
	                   
	                   <div role="tabpanel" id="tab-3" class="tab-pane">
	                   <form id="createSpringQuesForm" method="post" action="Actions/CustomerSpringQuestionAction.php" class="m-t-sm">
                     		<input type="hidden" id ="call" name="call"  value="saveSpringQuestion"/>
                        	<input type="hidden" id ="customerseq" name="customerseq"  value="<?php echo $customerSeq?>"/>
                        	<div class="springMainDiv">
<!-- 	                        	<div class="form-group row"> -->
<!-- 		                       		<label class="col-lg-4 col-form-label bg-formLabelMauve"><h2>SPRING QUESTIONS</h2> -->
<!-- 		                       			<br><small>(Questions for Each buyer if handling different categories)</small> -->
<!-- 		                       		</label> -->
<!-- 		                        </div> -->
		                        <div class="row">
									<div class="col-lg-10">
										<div class="form-group">
				                        	<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel">Data Saving for Year</label>
					                        	<div class="col-lg-4">
					                        		<select class="form-control">
					                        			<option>2020</option>
					                        			<option>2021</option>
					                        		</select>
					                        	</div>
					                        </div>
					                    </div>
				                       <div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Have you sent them Spring catalog link?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="issentcataloglink" name="issentcataloglink" <?php echo !empty($customerSpringQuestion->getIsSentCatalogLink())?"checked":""?>/>
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs m-r-xxs">
				                        		<div class="panel panel-mauve m-b-none">
													<div class="panel-heading">Notes</div>
				                                    <div class="panel-body">
					                                    	<textarea  style="font-size:12px" id="sentcataloglinknotes" name="sentcataloglinknotes" class="form-control"
					                                			maxLength="1000"><?php echo $customerSpringQuestion->getSentCatalogLinkNotes()?></textarea>
				                                    </div>
				                                </div> 
				                        	</div>
				                        </div>
				                        <div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Have we sent them any Spring sample?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="issentsample" name="issentsample" <?php echo !empty($customerSpringQuestion->getIsSentSample())?"checked":""?>/>
					                        	</div>
				                        	</div>
				                        </div>
				                        <div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Have we made an appointment for a stragetic planning meeting?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isstrategicplanningmeeting" name="isstrategicplanningmeeting" <?php echo !empty($customerSpringQuestion->getIsStrategicPlanningMeeting())?"checked":""?>/>
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">If Yes, Date?</label>
					                        	<div class="col-lg-4">
					                        		<div class="input-group date">
					                               		<input type="text" name="strategicplanningmeetingdate" value="<?php echo $customerSpringQuestion->getStrategicPlanningMeetingDate()?>" id="strategicplanningmeetingdate" class="form-control  dateControl">
					                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					                            	</div>
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Have we invited them to Spring showroom?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isinvitedtospringshowroom" name="isinvitedtospringshowroom" <?php echo !empty($customerSpringQuestion->getIsinvitedtospringshowroom())?"checked":""?>/>
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">If Yes, Date?</label>
					                        	<div class="col-lg-4">
					                        		<div class="input-group date">
					                               		<input type="text" name="invitedtospringshowroomdate" value="<?php echo $customerSpringQuestion->getInvitedToSpringShowroomDate()?>" id="invitedtospringshowroomdate" class="form-control  dateControl">
					                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					                            	</div>
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">If No, Reminder Date?</label>
					                        	<div class="col-lg-4">
					                        		<div class="input-group date">
					                               		<input type="text" name="invitedtospringshowroomreminderdate" id="invitedtospringshowroomreminderdate" value="<?php echo $customerSpringQuestion->getInvitedToSpringShowroomReminderDate()?>"  class="form-control  dateControl">
					                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					                            	</div>
					                        	</div>
				                        	</div>
				                        </div>
				                        <div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Is Spring 2020 Comp Shop Completed?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="iscomposhopcompleted"  name="iscomposhopcompleted" <?php echo !empty($customerSpringQuestion->getIsCompoShopCompleted())?"checked":""?>/>
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Spring 2020 Comp Shop Summary Email sent to SA Team and Robby?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="iscompshopsummaryemailsent" name="iscompshopsummaryemailsent" <?php echo !empty($customerSpringQuestion->getIsCompShopSummaryEmailSent())?"checked":""?> />
					                        	</div>
				                        	</div>
				                        </div>
				                        <div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">When are you reviewing spring 2021?</label>
					                        	<div class="col-lg-4">
					                        			<input type="text" name="springreviewingdate" value="<?php echo $customerSpringQuestion->getSpringReviewingDate()?>" id="springreviewingdate" class="form-control  dateControl">
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Where is the customer going to select the Spring items?</label>
					                        	<div class="col-lg-4">
					                        		<input type="text" name="customerselectingspringitemsfrom" value="<?php echo $customerSpringQuestion->getCustomerSelectingSpringItemsFrom()?>" id="customerselectingspringitemsfrom" class="form-control">
					                        	</div>
				                        	</div>
				                        </div>
				                        
				                        
				                   	</div> 
				                    <div class="col-lg-10">
				                    	<div class="form-group">
					                    	<div class="row m-b-xxs">
					                        	<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Did we pitch that we want to be your main vendor of Holiday and Décor?<br>And my customers are vendor consolidating?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="ispitchmainvendor" name="ispitchmainvendor" <?php echo !empty($customerSpringQuestion->getIsPitchMainVendor())?"checked":""?>/>
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs m-r-xxs">
				                        		<div class="panel panel-mauve m-b-none">
													<div class="panel-heading">Notes</div>
				                                    <div class="panel-body">
					                                    	<textarea  style="font-size:12px" id="pitchmainvendornotes" name="pitchmainvendornotes" class="form-control"
					                                			maxLength="1000"><?php echo $customerSpringQuestion->getPitchMainVendorNotes()?></textarea>
				                                    </div>
				                                </div> 
				                        	</div>
										</div>
										<div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">What categories have they not bought That I should sell them?<br><small>Example Bistro Sets</small></label>
					                        	<div class="col-lg-4">
					                   		     		<input type="text" name="categoriesshouldsellthem" value="<?php echo $customerSpringQuestion->getCategoriesShouldSellThem()?>" id="categoriesshouldsellthem" class="form-control">
					                        	</div>
				                        	</div>
				                        </div>
										
										<div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Are we receiving sell thru if they bought last year?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="issellthrough" name="issellthrough" <?php echo !empty($customerSpringQuestion->getIsSellThrough())?"checked":""?>/>
					                        	</div>
				                        	</div>
				                        	<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Have Robby Reviewed Sell through?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isrobbyreviewedsellthrough" name="isrobbyreviewedsellthrough" <?php echo !empty($customerSpringQuestion->getIsRobbyReviewedSellThrough())?"checked":""?>/>
					                        	</div>
				                        	</div>
				                        </div>
										<div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Should I visit this customer during the 2ND qtr to comp shop their spring items?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isvisitcustomer2qtr" name="isvisitcustomer2qtr" <?php echo !empty($customerSpringQuestion->getIsvisitcustomer2qtr())?"checked":""?>/>
					                        	</div>
				                        	</div>
				                        </div>
				                        <div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">When do we need to quote you christmas by?</label>
					                        	<div class="col-lg-4">
					                        		<div class="input-group date">
					                               		<input type="text" name="christmasquotebydate" value="<?php echo $customerSpringQuestion->getChristmasQuoteByDate()?>" id="christmasquotebydate" class="form-control  dateControl">
					                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					                            	</div>
					                        	</div>
				                        	</div>
				                        </div>
				                        <div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Should I visit this customer during the 2ND qtr to comp shop their spring items?</label>
					                        	<div class="col-lg-4">
					                        		<input type="checkbox" class="i-checks form-control" id="isvisitcustomerduring2ndqtr" name="isvisitcustomerduring2ndqtr" <?php echo !empty($customerSpringQuestion->getIsVisitCustomerDuring2ndQtr())?"checked":""?>/>
					                        	</div>
				                        	</div>
				                        </div>
				                        <div class="form-group">
				                       		<div class="row m-b-xxs">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">When do we need to qote you Spring by?</label>
					                        	<div class="col-lg-4">
					                        		<div class="input-group date">
					                               		<input type="text" name="quotespringbydate" id="quotespringbydate" value="<?php echo $customerSpringQuestion->getQuoteSpringByDate()?>" class="form-control  dateControl">
					                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					                            	</div>
					                        	</div>
				                        	</div>
				                        </div>
										
			                    	</div>
		                		</div>
		                        <div class="form-group row buttonsDiv">
		                       		<div class="col-lg-2">
			                        	<button class="btn bg-formLabelMauve" onclick="saveQuestionnaire('createSpringQuesForm')" type="button" style="width:85%">Save</button>
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
    </div>
    </div>
</body>
</html>
<script type="text/javascript">
var customerSeq = "<?php echo $customerSeq ?>";
$(document).ready(function(){
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
function saveQuestionnaire(formName){
	formName = "#" + formName;
	if($(formName)[0].checkValidity()) {
		showHideProgress()
		$(formName).ajaxSubmit(function( data ){
		   showHideProgress();
		   var flag = showResponseToastr(data,null,null,"ibox");
		   if(flag){
			   window.setTimeout(function(){window.location.href = "manageCustomers.php"},100);
		   }
	    })	
	}else{
		$(formName)[0].reportValidity();
	}
}
</script>