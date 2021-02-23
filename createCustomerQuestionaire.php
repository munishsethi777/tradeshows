<?include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/CustomerChristmasQuestion.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerChristmasQuestionMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/CustomerOppurtunityBuy.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerOppurtunityBuyMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/CustomerSpringQuestion.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerSpringQuestionMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/BuyerCategoryType.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/SeasonShowNameType.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DropdownUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Customer.php");

$customerMgr = CustomerMgr::getInstance();
$customer = new Customer();

$customerChristmasQuestionMgr = CustomerChristmasQuestionMgr::getInstance();
$customerChristmasQuestion = new CustomerChristmasQuestion();

$customerOppurtunityBuyMgr = CustomerOppurtunityBuyMgr::getInstance();
$customerOppurtunityBuy = new CustomerOppurtunityBuy();

$customerSpringQuestionMgr= CustomerSpringQuestionMgr::getInstance();
$customerSpringQuestion = new CustomerSpringQuestion();

$customerFullName = "";
$customerSeq = 0;
$isAllChecked = "checked";
$buyerCategoriesSpringQues = BuyerCategoryType::getAll();
$tradeShowsTypeOppBuy = SeasonShowNameType::getAll();
$selectedCategoriesSpringQues = array();
$selectedTradeShowsTypeOppBuy = array();
$categoriesShouldSellThem = array();
$christmasCategories = array();
$tradeshowsaregoingto = array();
if(isset($_POST["customerSeq"])){
	$customerSeq = $_POST["customerSeq"];
	$customer = $customerMgr->findByCustomerSeq($customerSeq);
	$customerFullName = $customer->getFullName();
	$customerChristmasQuestion = $customerChristmasQuestionMgr->findByCustomerSeq($customerSeq);
    if(empty($customerChristmasQuestion)){
        $customerChristmasQuestion = new CustomerChristmasQuestion();
    }
    $customerOppurtunityBuy = $customerOppurtunityBuyMgr->findByCustomerSeq($customerSeq);
    if(empty($customerOppurtunityBuy)){
        $customerOppurtunityBuy = new CustomerOppurtunityBuy();
    }
    if(!empty($customerOppurtunityBuy->getTradeshowsGoingTo())){
        $selectedTradeShowsTypeOppBuy = explode(",",
            $customerOppurtunityBuy->getTradeshowsGoingTo());
    }
    $customerSpringQuestion = $customerSpringQuestionMgr->findByCustomerSeq($customerSeq);
    if(empty($customerSpringQuestion)){
        $customerSpringQuestion = new CustomerSpringQuestion();
    }
    if(!empty($customerSpringQuestion->getCategoriesShouldSellThem())){
        $selectedCategoriesSpringQues = explode(",", 
            $customerSpringQuestion->getCategoriesShouldSellThem());
    }
    if(!empty($customerChristmasQuestion->getTradeshowsAreGoingTo())){
        $tradeshowsaregoingto = explode(",",$customerChristmasQuestion->getTradeshowsAreGoingTo());
    }
    if(!empty($customerChristmasQuestion->getCategoriesShouldSellThem())){
        $categoriesShouldSellThem = explode(",",$customerChristmasQuestion->getCategoriesShouldSellThem());
	}
	if(!empty($customerChristmasQuestion->getCategory())){
        $christmasCategories = explode(",",$customerChristmasQuestion->getCategory());
	}
	if(empty($customerChristmasQuestion->getIsAllCategoriesSelected())){
    	$isAllChecked = "";
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
	height:30px;
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
#customerselectxmasitemsfrom,#year{
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
textarea .form-control{
	height:auto !important;
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
					<div class="form-group row">
						<div class="col-lg-12">
							<span class="d-flex bg-formLabelCyan
							 "><?php echo $customerFullName; ?></span>
						</div>
					</div>
                 	<ul class="nav nav-tabs" role="tablist">
		            	<li class="primaryLI active"><a class="nav-link" data-toggle="tab" href="#tab-1"> HOLIDAYS QUESTIONS</a></li>
<!-- 						<li class="darkLI"><a class="nav-link" data-toggle="tab" href="#tab-2">OPPURTUNITY BUYS</a></li> -->
						<li class="mauveLI"><a class="nav-link" data-toggle="tab" href="#tab-3">SPRING QUESTIONS</a></li>
					</ul>
					<div class="tab-content">
						<div role="tabpanel" id="tab-1" class="tab-pane active">
							<div class="panel-group"> 
								<div id="panelMainDiv<?echo $seq?>" class="panel panel-default">
    								<div class="panel-heading">
                                        <h5 class="panel-title" style="padding:5px">
                                            <a  data-parent="#accordion" >Holiday Questions</a>
                                        </h5>
                                    </div> 
                                    <div class="panel-body">               			
                             		<form id="createChristmasQuestionForm" method="post" action="Actions/CustomerChristmasQuestionAction.php" class="m-t-sm">
                                 		<input type="hidden" id ="call" name="call"  value="savechristmasQuestion"/>
                                    	<input type="hidden" id ="customerseq" name="customerseq"  value="<?php echo $customerSeq?>"/>
                                    	
                                    	<div class="christmasMainDiv">
            		                        <div class="row">
            									<div class="col-lg-10">
            										<div class="form-group">
            											<div class="row ">
            												<label class="col-lg-8 col-form-label bg-formLabel">Select Category(s)</label>
            												<div class="col-lg-4">
            													<div>
            														<input type="checkbox" class="i-checks form-control pull-left isallcategoriesselected"
            															id="isallcategoriesselected<?echo $customerSeq?>" name="isallcategoriesselected"
            															<?php echo $isAllChecked?> /> <label>All</label>
            													</div>
            													<div class="m-t-sm">
            														<select id="christmasCategory<?echo $customerSeq?>" class="formCategories form-control"
            															name="category[]" multiple>
            														<?php
            															foreach ( $buyerCategoriesSpringQues as $key => $value ) {
            																$selected = "";
            																if (in_array ( $key, $christmasCategories )) {
            																	$selected = "selected";
            																}
            																echo ('<option ' . $selected . ' value="' . $key . '">' . $value . '</option>');
            															}
            														?>
            														</select>
            													</div>
            													
            												</div>
            											</div>
            										</div>
            										<div class="form-group">
            											<div class="row ">
            												<label class="col-lg-8 col-form-label bg-formLabel">Data Saving
            													for Year</label>
            												<div class="col-lg-4">
            													<?php
            														$select = DropDownUtils::getYearDD ( "year", null, $customerChristmasQuestion->getYear (), false, false );
            														echo $select;
            													?>
            												</div>
            											</div>
            										</div>
            										<div class="form-group">
            											<div class="row ">
            					                       		<label class="col-lg-8 col-form-label bg-formLabel">Are you Interested in Holiday ?</label>
            					                        	<div class="col-lg-4">
            													<?php 
             	                        		    				$select = DropDownUtils::getBooleanDropDown("isinterested", null, $customerChristmasQuestion->getIsInterested(),false,true,'N/A');
                			                        				echo $select;
            	                             					?>
            					                        	</div>
            				                        	</div>
            										</div>
            										<div class="form-group">
            											<div class="row ">
             						                    	<label class="col-lg-8 col-form-label bg-formLabel">Date you sent them holiday catalog link?</label>
             					                        	<div class="col-lg-4">
            													<?php
              	                        						    $select = DropDownUtils::getBooleanDropDown("iscataloglinksent", null, $customerChristmasQuestion->getIsCatalogLinkSent(),false,true,'N/A');
                 			                    				    echo $select;
             	                             					?>
             					                        	</div>
             					                        </div>
            											<div class="row ">
            					                        	<label class="col-lg-8 col-form-label bg-formLabel">If Yes, Date</label>
            					                        	<div class="col-lg-4">
            					                        		<div class="input-group date">
                					                        		<input type="text" value="<?php echo $customerChristmasQuestion->getCataloglinkDate()?>" name="cataloglinkdate" id="cataloglinkdate" class="form-control dateControl">
                					                        		<span class="input-group-addon">
                					                        			<i class="fa fa-calendar"></i>
                                        							</span>
                                        						</div>
            					                        	</div>
            					                        </div>
            										</div>
            										<div class="form-group">
                                    					<div class="row ">
                                    						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
                                    							What trade shows are they going to in 2021?
                        									</label>
                                    						<div class="col-lg-4">
                                    							<!-- <select id="tradeshowsaregoingto" class="formCategories form-control"
                                    								name="tradeshowsaregoingto[]" multiple> -->
                                    							<?php
                                    								// foreach ( $buyerCategoriesSpringQues as $key => $value ) {
                                    								// 	$selected = "";
                                    								// 	if (in_array ( $key, $tradeshowsaregoingto )) {
                                    								// 		$selected = "selected";
                                    								// 	}
                                    								// 	echo ('<option ' . $selected . ' value="' . $key . '">' . $value . '</option>');
                                    								// }
                                    							?>
                                        					    <!-- </select> -->
            													<input class="form-control" id="tradeshowsaregoingto" type="text" name="tradeshowsaregoingto" value="<?php echo $customerChristmasQuestion->getTradeshowsAreGoingTo()?>"/>
                                        					</div>
                                    					</div>
                                    				</div>
                                    				<div class="form-group">
                                    					<div class="row ">
                                    						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
                                    							Have you made an appointment or dinner appt with them?
                                    						</label>
                                    						<div class="col-lg-4">
                                    							
                        											<?php
                        											$select = DropDownUtils::getBooleanDropDown("isdinnerappt", null, $customerChristmasQuestion->getIsDinnerAppt(), false, true,'N/A');
                            			                        				echo $select;
                        	                             					?>
                                    						</div>
                                    					</div>
                                    					<div class="row ">
                                    						<label
                                    							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">If
                                    							Yes, Place?</label>
                                    						<div class="col-lg-4">
                                    							
                                    								<input type="text" name="dinnerapptplace"
                                    									value="<?php echo $customerChristmasQuestion->getDinnerApptPlace()?>"
                                    									id="dinnerapptplace" class="form-control">
                                    							
                                    						</div>
                                    					</div>
                                    				</div>
                                    				<div class="form-group">
                                    					<div class="row ">
                                    						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
                                    							Have you told them that you want to be their main vendor of Holiday and Decor? And your customers are vendor consolidating?
                                    						</label>
                                    						<div class="col-lg-4">
                        											<?php
                        											$select = DropDownUtils::getBooleanDropDown("ispitchmainvendor", null, $customerChristmasQuestion->getIsPitchMainVendor(), false, true,'N/A');
                        													echo $select;
                        	                             			?>
                                    						</div>
                                    					</div>
                                    				</div>
                                    				<div class="form-group">
                                    					<div class="row ">
                                    						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
                                    							Are there more buyers in other categories? Or does this buyer handle all of Holiday categories?  If there are more buyers, who are they and ask all questions to each buyer.
                                    						</label>
                                    						<div class="col-lg-4">
                        											<?php
                        											$select = DropDownUtils::getBooleanDropDown("istheremorebuyers", "notesShowHide()", $customerChristmasQuestion->getIsThereMoreBuyers(), false, true,'N/A');
                            			                        				echo $select;
                        	                             					?>
                                    						</div>
                                    					</div>
                                    					<div class="panel panel-primary" id="christmasNotesDiv">
            												<div class="panel-heading">Notes</div>
            												<div class="panel-body">
            													<textarea  tabindex="" class="form-control h-auto" maxLength="1000" name="buyerhasmorecategorynotes" ><?php echo $customerChristmasQuestion->getBuyerHasMoreCategoryNotes() ?></textarea>
            												</div>												
            											</div>
            										</div>
                                    				<div class="form-group">
                                    					<div class="row ">
                                    						<label
                                    							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Have
                                    							we sent them any Holiday sample?</label>
                                    						<div class="col-lg-4">
                                    							
                        											<?php
                        											$select = DropDownUtils::getBooleanDropDown("isxmassamplessent", null, $customerChristmasQuestion->getIsXmasSamplesSent(), false, true,'N/A');
                            			                        				echo $select;
                        	                             					?>
                                    						</div>
                                    					</div>
                                     					<div class="row "> 
                                   						<label 
                                     							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">If 
                                     							Yes, Date?</label> 
                                     						<div class="col-lg-4"> 
                                     							<div class="input-group date"> 
                                     								<input type="text" name="xmassamplesentdate" 
                                     									value="<?php echo $customerChristmasQuestion->getXmasSampleSentDate()?>"
                                     									id="xmassamplesentdate"
                                     									class="form-control  dateControl"> <span
                                     									class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                                     							</div> 
                                     						</div> 
                                    					</div> 
                                    				</div>
                                    				<div class="form-group">
                                    					<div class="row ">
                                    						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
                                    							Have we made an appointment for a strategic planning meeting?
                                    						</label>
                                    						<div class="col-lg-4">
                                    							
                        											<?php
                        											$select = DropDownUtils::getBooleanDropDown("isstrategicplanningmeetingappointment", null, $customerChristmasQuestion->getIsStrategicPlanningMeetingAppointment(),false,true,'N/A');
            															echo $select;
            														?>
                                    						</div>
                                    					</div>
                                     					<div class="row "> 
                                     						<label
                                     							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">If 
                                     							Yes, Date?</label> 
                                     						<div class="col-lg-4"> 
                                     							<div class="input-group date"> 
                                     								<input type="text" name="strategicplanningmeetdate" 
                                    									 value="<?php echo $customerChristmasQuestion->getStrategicPlanningMeetDate()?>" 
                                     									id="strategicplanningmeetdate"
                                    									class="form-control  dateControl"> <span 
                                     									class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                                     							</div> 
                                     						</div> 
                                     					</div> 
                                    				</div>
                                    				<div class="form-group">
                                    					<div class="row ">
                                    						<label
                                    							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">What
                                    							categories have they not bought that we should sell them?
                                    						</label>
                                    						<div class="col-lg-4">
                                    							<select class="categoriesshouldsellthem form-control"
                                    								name="categoriesshouldsellthem[]" multiple>
                                    							<?php
                                    								foreach ( $buyerCategoriesSpringQues as $key => $value ) {
                                    									$selected = "";
                                    									if (in_array ( $key, $categoriesShouldSellThem )) {
                                    										$selected = "selected";
                                    									}
                                    										echo ('<option ' . $selected . ' value="' . $key . '">' . $value . '</option>');
                                    									}
                                    							?>
                                        					    </select>
                                    						</div>
                                    					</div>
                                    				</div>
                                    				<div class="form-group">
                                    					<div class="row ">
                                    						<label
                                    							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Have
                                    							you invited them to Alpine's holiday showroom?</label>
                                    						<div class="col-lg-4">
                                    							
                        											<?php
                        											$select = DropDownUtils::getBooleanDropDown("isinvitedtoxmasshowroom", null,$customerChristmasQuestion->getIsInvitedToXmasShowroom(),false,true,'N/A');
                            			                        				echo $select;
                        	                             					?>
                                    						</div>
                                    					</div>
                                    				</div>
                                    				<div class="form-group">
                                    					<div class="row ">
                                    						<label
                                    							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">When
                                    							are they reviewing holiday 2021 ?</label>
                                    						<div class="col-lg-4">
                                    							<div class="input-group date">
                                    								<input type="text" name="christmas2020reviewingdate"
                                    									value="<?php echo $customerChristmasQuestion->getChristmas2020ReviewingDate()?>"
                                    									id="christmas2020reviewingdate"
                                    									class="form-control  dateControl"> <span
                                    									class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    							</div>
                                    						</div>
                                    					</div>
                                    					
                                    				</div>
                                    				<div class="form-group">
                                    					<div class="row ">
                                    						<label
                                    							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
                                    							Are we receiving sell thrus if they bought last year?
                                    						</label>
                                    						<div class="col-lg-4">
                                    							
                        											<?php
                        											$select = DropDownUtils::getBooleanDropDown("isreceivingsellthru", null, $customerChristmasQuestion->getIsReceivingSellThru(),false,true,'N/A');
                            			                        				echo $select;
                        	                             					?>
                                    						</div>
                                    					</div>
                                    				</div>
                                    				<div class="form-group">
                                    					<div class="row ">
                                    						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
                                    							If they bought holiday last year, have you reviewed the sell thru?
                                    						</label>
                                    						<div class="col-lg-4">
                        											<?php
                        											$select = DropDownUtils::getBooleanDropDown("isreviewedsellthru", null, $customerChristmasQuestion->getIsReviewedSellThru(), false, true,'N/A');
                            			                        				echo $select;
                        	                             					?>
                                    						</div>
                                    					</div>
                                    				</div>
                                    				<div class="form-group">
                                    					<div class="row ">
                                    						<label
                                    							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Should
                                    							we visit this customer during the 4th qtr to comp shop their
                                    							holiday items?</label>
                                    						<div class="col-lg-4">
                                    							
                        											<?php
                        											$select = DropDownUtils::getBooleanDropDown("isvisitcustomerin4qtr", null, $customerChristmasQuestion->getIsVisitCustomerIn4Qtr(),false,true,'N/A');
                            			                        				echo $select;
                        	                             					?>
                                    						</div>
                                    					</div>
                                    				</div>
                                    				<div class="form-group">
                                    					<div class="row ">
             						                    	<label class="col-lg-8 col-form-label bg-formLabel">Where
                                    							is the customer going to select the holiday items?</label>
             					                        	<div class="col-lg-4">
            					                        		<?php 
             					                        		    $select = DropDownUtils::getXmasItemFromDD("customerselectxmasitemsfrom", "onChangeIsCustomerGoingToSelectHolidayItems(this.value)", $customerChristmasQuestion->getCustomerSelectXmasItemsFrom(),false,true,'N/A');
                                 			                        echo $select;
                             	                             	?>
             					                        	</div>
             					                        </div>
                                    				</div>
            										<div class="form-group" id="customerIsGoingToSelectHolidayItemsTextBoxRow">
            											<div class="panel panel-primary">
            												<div class="panel-heading">Other</div>
            												<div class="panel-body">
            													<input  class="form-control h-auto" name="wherecustomerselectholidayitems" value="<?php echo $customerChristmasQuestion->getWhereCustomerSelectHolidayItems();?>" />
            												</div>
            											</div>
            										</div>
                                    				<div class="form-group">
                        					
                                    					<div class="row ">
                                    						<label class="col-lg-8 col-form-label bg-formLabel">Holiday 2020 Comp Shop Completed?</label>
             					                        	<div class="col-lg-4">
            												 	<div class="input-group date">
                                    								<input type="text" name="compshopcompleteddate"
                                    									value="<?php echo $customerChristmasQuestion->getCompShopCompletedDate()?>"
                                    									id="compshopcompleteddate"
                                    									class="form-control  dateControl"> <span
                                    									class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    							</div>
             					                        	</div>
                                    					</div>
                                    				</div>
                                    				<div class="form-group">
                        					
                                    					<div class="row ">
                                    						<label class="col-lg-8 col-form-label bg-formLabel">Holiday 2020 Comp Shop Summary Email sent to SA Team and Robby?</label>
             					                        	<div class="col-lg-4">
            													<?php
              	                        		  				  	$select = DropDownUtils::getBooleanDropDown("isholidayshopcomsummaryemailsent", null, $customerChristmasQuestion->getIsHolidayShopComSummaryEmailSent(),false,true,'N/A');
                 			                       					echo $select;
             	                             					?>
             					                        	</div>
                                    						<label
                                    							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">If
                                    							Yes, Date?</label>
                                    						<div class="col-lg-4">
                                    							<div class="input-group date">
                                    								<input type="text" name="compshopsummaryemailsentdate"
                                    									value="<?php echo $customerChristmasQuestion->getCompShopSummaryEmailSentDate()?>"
                                    									id="compshopsummaryemailsentdate"
                                    									class="form-control  dateControl"> <span
                                    									class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    							</div>
                                    						</div>
                                    					</div>
                                    				</div>
                                    				<div class="form-group">
                                    					<div class="row ">
                                    						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
                                    							Have we quoted for holiday 2021?
                                    						</label>
                                    						<div class="col-lg-4">
                        											<?php
                        											$select = DropDownUtils::getBooleanDropDown("isquotedforxmas", null, $customerChristmasQuestion->getIsQuotedForXmas(), false, true,'N/A');
                            			                        				echo $select;
                        	                             					?>
                                    						</div>
                                    					</div>
                                    				</div>
                                    				<div class="form-group">
                                    					<div class="row ">
                                    						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
                                    							Have they finalized their selections, if so how many items?
                                   							</label>
                                    						<div class="col-lg-4">
                                    							<input type="number" name="itemselectionfinalized"
                                    								value="<?php echo $customerChristmasQuestion->getItemSelectionFinalized()?>"
                                    								id="itemselectionfinalized" class="form-control" oninput="calculateTyVsLyForHolidayQuestionaire()">
                                    						</div>
                                    					</div>
                                    				</div>
                                    				<div class="form-group">
                                    					<div class="row ">
                                    						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
                                    							How many holiday items did they purchase last year ?
                                   							</label>
                                    						<div class="col-lg-4">
                                    							<input type="number" name="itemspurchasedlastyear"
                                    								value="<?php echo $customerChristmasQuestion->getItemsPurchasedLastYear()?>"
                                    								id="itemspurchasedlastyear" class="form-control" oninput="calculateTyVsLyForHolidayQuestionaire()">
                                    						</div>
                                    					</div>
                                    				</div>
                                    				<div class="form-group">
                                    					<div class="row ">
                                    						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
                                    							If they finalized, how many were TY vs LY?
                                   							</label>
                                    						<div class="col-lg-4">
                                    							<input type="number" name="finalizedtyvsly"
                                    								value="<?php echo $customerChristmasQuestion->getFinalizedTyVsLy()?>"
                                    								id="finalizedtyvsly" class="form-control" readonly>
                                    						</div>
                                    					</div>
                                    				</div>
                                    				<div class="form-group">
                                    					<div class="row ">
                                    						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
                                    						Are we expecting a PO ?
                                    							</label>
                                    						<div class="col-lg-4">
                                    							
                        											<?php
                        											$select = DropDownUtils::getIsPoExpecting("arepoexpecting", null, $customerChristmasQuestion->getArePoExpecting(), false, true, "N/A");
                            			                        				echo $select;
                        	                             					?>
                                    						</div>
                                    						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
                                    							When are we expecting PO?
                                    						</label>
                                    						<div class="col-lg-4">
                                    							<div class="input-group date">
                                    								<input type="text" name="expectingpodate"
                                    									value="<?php echo $customerChristmasQuestion->getExpectingPoDate()?>"
                                    									id="expectingpodate"
                                    									class="form-control  dateControl"> <span
                                    									class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    							</div>
                                    						</div>
                                    					</div>
                                    				</div>
                                    				<div class="form-group">
                                    					<div class="row ">
                                    						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
                                    							Have we sent them opportunities buys?
                                    						</label>
                                    						<div class="col-lg-4">
                                    							
                        											<?php
                        											$select = DropDownUtils::getBooleanDropDown("isopportunitiessent", null, $customerChristmasQuestion->getIsOpportunitiesSent(), false, true,'N/A');
                            			                        				echo $select;
                        	                             					?>
                                    						</div>
                                    						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
                                    							If so, what is the last date you sent to them.
                                    						</label>
                                    						<div class="col-lg-4">
                                    							<div class="input-group date">
                                    								<input type="text" name="opportunitiessentdate"
                                    									value="<?php echo $customerChristmasQuestion->getOpportunitiesSentDate()?>"
                                    									id="opportunitiessentdate"
                                    									class="form-control  dateControl"> <span
                                    									class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    							</div>
                                    						</div>
                                    					</div>
                                    				</div>
                                    				
            <!--             							<div class="form-group"> -->
            <!-- 				                        	<div class="row "> -->
            <!-- 					                       		<label class="col-lg-8 col-form-label bg-formLabel">Data Saving for Year</label> -->
            <!-- 					                        	<div class="col-lg-4"> -->
            					                        		<?php 
            // 					                        		    $select = DropDownUtils::getYearDD("year", null, $customerChristmasQuestion->getYear(),false,false);
            //                     			                        echo $select;
            //                 	                             	?>
            <!-- 					                        	</div> -->
            <!-- 					                        </div> -->
            <!-- 					                    </div> -->
            <!-- 				                       <div class="form-group"> -->
            				                       		
            <!-- 				                        	<div class="row "> -->
            <!-- 						                    	<label class="col-lg-8 col-form-label bg-formLabel">Have you sent them xmas catalog link?</label> -->
            <!-- 					                        	<div class="col-lg-4"> -->
            													<?php
            //  	                        						    $select = DropDownUtils::getBooleanDropDown("iscataloglinksent", null, $customerChristmasQuestion->getIsCatalogLinkSent(),false,false);
            //     			                    				    echo $select;
            // 	                             					?>
            <!-- 					                        	</div> -->
            <!-- 					                        </div> -->
            <!-- 				                        	<div class="row m-r-xxs"> -->
            <!-- 				                        		<div class="panel panel-primary m-b-none"> -->
            <!-- 													<div class="panel-heading">Catalog Link to send</div> -->
            <!-- 													<div class="panel-body"> -->
            <!-- 					                                   	<textarea class="form-control" maxLength="1000" name="cataloglinksentnotes" id="cataloglinksentnotes"><?php echo $customerChristmasQuestion->getCatalogLinkSentNotes()?></textarea> -->
            <!-- 													</div> -->
            <!-- 						                     	</div> -->
            <!-- 				                        	</div> -->
            <!-- 				                        </div> -->
            				                        
            <!-- 				                        <div class="form-group"> -->
            <!-- 				                        	<div class="row "> -->
            <!-- 					                       		<label class="col-lg-8 col-form-label bg-formLabel">Have we sent them Any xmas sample?</label> -->
            <!-- 					                        	<div class="col-lg-4"> -->
            													<?php
            //  	                        		    				$select = DropDownUtils::getBooleanDropDown("isxmassamplessent", null, $customerChristmasQuestion->getIsXmasSamplesSent(),false,false);
            //     			                        				echo $select;
            // 	                             					?>
            <!-- 					                        	</div> -->
            <!-- 					                        </div> -->
            <!-- 					                    </div> -->
            <!-- 				                    	<div class="form-group"> -->
            <!-- 				                    		<div class="row "> -->
            <!-- 					                       		<label class="col-lg-8 col-form-label bg-formLabel">Have we made an appt for a stragetic planning meeting?</label> -->
            <!-- 					                        	<div class="col-lg-4"> -->
            													<?php
            //  	                        		    				$select = DropDownUtils::getBooleanDropDown("isstrategicplanningmeetingappointment", null, $customerChristmasQuestion->getIsStrategicPlanningMeetingAppointment(),false,false);
            //     			                        				echo $select;
            // 	                             					?>
            <!-- 					                        	</div> -->
            <!-- 				                        	</div> -->
            <!-- 				                        	<div class="row "> -->
            <!-- 					                        	<label class="col-lg-8 col-form-label bg-formLabel text-right">If Yes, Date?</label> -->
            <!-- 					                        	<div class="col-lg-4"> -->
            <!-- 					                        		<input type="text" value="<?php echo $customerChristmasQuestion->getStrategicPlanningMeetDate()?>" name="strategicplanningmeetdate" id="strategicplanningmeetdate" class="form-control dateControl">-->
            <!-- 					                        	</div> -->
            <!-- 					                        </div> -->
            <!-- 					                        <div class="row m-t-sm"> -->
            <!-- 					                        	<label class="col-lg-8 col-form-label bg-formLabel">Have we invited them to xmas showroom?</label> -->
            <!-- 					                        	<div class="col-lg-4"> -->
            													<?php
            //  	                        		  				  $select = DropDownUtils::getBooleanDropDown("isinvitedtoxmasshowroom", null,$customerChristmasQuestion->getIsInvitedToXmasShowroom(),false,false);
            //     			                      				  echo $select;
            // 	                             					?>
            <!-- 					                        	</div> -->
            <!-- 				                        	</div> -->
            <!-- 				                        	<div class="row "> -->
            <!-- 				                        		<label class="col-lg-8 col-form-label bg-formLabel text-right">Yes, Date?</label> -->
            <!-- 					                        	<div class="col-lg-4"> -->
            <!-- 					                        		<input type="text" value="<?php echo $customerChristmasQuestion->getInvitedtoXmasShowRoomDate()?>" name="invitedtoxmasshowroomdate" id="invitedtoxmasshowroomdate" class="form-control dateControl" />-->
            <!-- 					                        	</div> -->
            <!-- 					                        </div> -->
            <!-- 					                        <div class="row "> -->
            <!-- 					                        	<label class="col-lg-8 col-form-label bg-formLabel text-right">No, Reminder Date?</label> -->
            <!-- 					                        	<div class="col-lg-4"> -->
            <!-- 					                        		<input type="text" value="<?php echo $customerChristmasQuestion->getInvitedToxMasShowroomReminderDate()?>" name="invitedtoxmasshowroomreminderdate" id="invitedtoxmasshowroomreminderdate" class="form-control dateControl">-->
            <!-- 					                        	</div> -->
            <!-- 				                        	</div> -->
            <!-- 				                        	<div class="row  m-t-sm"> -->
            <!-- 					                        	<label class="col-lg-8 col-form-label bg-formLabel">Holiday 2019 Comp Shop Completed?</label> -->
            <!-- 					                        	<div class="col-lg-4"> -->
            													<?php
            													
            // 				 	                        		    $select = DropDownUtils::getBooleanDropDown("isholidayshopcompleted", null, $customerChristmasQuestion->getIsHolidayShopCompleted(),false,false);
            // 				    			                        echo $select;
            // 					                             	?>
            <!-- 					                        	</div> -->
            <!-- 				                        	</div> -->
            <!-- 				                        	<div class="row "> -->
            <!-- 					                        	<label class="col-lg-8 col-form-label bg-formLabel">Holiday 2019 Comp Shop Summary Email sent to SA Team and Robby?</label> -->
            <!-- 					                        	<div class="col-lg-4"> -->
            													<?php
            //  	                        		  				  	$select = DropDownUtils::getBooleanDropDown("isholidayshopcomsummaryemailsent", null, $customerChristmasQuestion->getIsHolidayShopComSummaryEmailSent(),false,false);
            //     			                       					echo $select;
            // 	                             					?>
            <!-- 					                        	</div> -->
            <!-- 				                        	</div> -->
            <!-- 					                    </div> -->
            <!-- 					                    <div class="form-group"> -->
            <!-- 				                       		<div class="row "> -->
            <!-- 					                       		<label class="col-lg-8 m-t-sm col-form-label bg-formLabel">When are you reviewing christmas 2020</label> -->
            <!-- 					                        	<div class="col-lg-4"> -->
            <!-- 					                        		<input type="text" value="<?php echo $customerChristmasQuestion->getChristmas2020ReviewingDate()?>" name="christmas2020reviewingdate" id="christmas2020reviewingdate" class="form-control dateControl">-->
            <!-- 					                        	</div> -->
            <!-- 				                        	</div> -->
            <!-- 				                        	<div class="row "> -->
            <!-- 						                    	<label class="col-lg-8 col-form-label bg-formLabel">Where is the customer going to select the xmas items?</label> -->
            <!-- 					                        	<div class="col-lg-4"> -->
            					                        		<?php 
            // 					                        		    $select = DropDownUtils::getXmasItemFromDD("customerselectxmasitemsfrom", null, $customerChristmasQuestion->getCustomerSelectXmasItemsFrom(),false,true);
            //                     			                        echo $select;
            //                 	                             	?>
            <!-- 					                        	</div> -->
            <!-- 					                        </div> -->
            <!-- 				                        </div> -->
            <!-- 				                   </div>  -->
            				                    
            				                    
            				                    
            				                    
            				                    
            <!-- 				                    <div class="col-lg-10"> -->
            <!-- 				                    	<div class="form-group"> -->
            <!-- 					                    	<div class="row "> -->
            <!-- 					                        	<label class="col-lg-8 col-form-label bg-formLabel">Did we pitch that we want to be your main vendor of Holiday and Décor? -->
            <!-- 		 And my customers are vendor consolidating?</label> -->
            <!-- 					                        	<div class="col-lg-4"> -->
            													<?php
            //  	                        		    				$select = DropDownUtils::getBooleanDropDown("ismainvendor", null, $customerChristmasQuestion->getIsMainVendor(),false,false);
            //     			                        				echo $select;
            // 	                             					?>
            <!-- 					                        	</div> -->
            <!-- 				                        	</div> -->
            <!-- 				                        	<div class="row "> -->
            <!-- 					                        	<div class="panel panel-primary m-b-none"> -->
            <!-- 													<div class="panel-heading">Notes</div> -->
            <!-- 													<div class="panel-body"> -->
            <!-- 					                                   	<textarea class="form-control" maxLength="1000" name="mainvendornotes"><?php echo $customerChristmasQuestion->getMainVendorNotes()?></textarea>-->
            <!-- 													</div> -->
            <!-- 						                     	</div> -->
            <!-- 						                     </div> -->
            <!-- 										</div> -->
            <!-- 										<div class="form-group"> -->
            <!-- 						                     <div class="row "> -->
            <!-- 						                     	<label class="col-lg-8 col-form-label bg-formLabel">Did they buy xmas last year?</label> -->
            <!-- 					                        	<div class="col-lg-4 "> -->
            					                        	
            												<?php
            //  	                        		    			$select = DropDownUtils::getBooleanDropDown("isxmasbuylastyear", null, $customerChristmasQuestion->getIsXmasBuyLastYear(),false,false);
            //     			                        			echo $select;
            // 	                             				?>
            <!-- 	                             				</div> -->
            <!-- 					                        </div> -->
            <!-- 					                        <div class="row "> -->
            <!-- 					                        	<label class="col-lg-8 col-form-label bg-formLabel text-right">If Yes, How Much?</label> -->
            <!-- 					                        	<div class="col-lg-4"> -->
            <!-- 					                        		<input type="text" name="xmasbuylastyearamount" value="<?php echo $customerChristmasQuestion->getXmasBuyLastYearAmount()?>" id="xmasbuylastyearamount" class="form-control">-->
            <!-- 					                        	</div> -->
            <!-- 					                        </div> -->
            <!-- 										</div> -->
            <!-- 										<div class="form-group"> -->
            <!-- 					                        <div class="row "> -->
            <!-- 					                        	<label class="col-lg-8 col-form-label bg-formLabel">Are we receiving sell thru if they bought last year?</label> -->
            <!-- 					                        	<div class="col-lg-4"> -->
            													<?php
            //  	                        		    				$select = DropDownUtils::getBooleanDropDown("isreceivingsellthru", null, $customerChristmasQuestion->getIsReceivingSellThru(),false,false);
            //     			                        				echo $select;
            // 	                             					?>
            <!-- 					                        	</div> -->
            <!-- 					                        </div> -->
            <!-- 					                        <div class="row "> -->
            <!-- 					                        	<label class="col-lg-8 col-form-label bg-formLabel">Have Robby Reviewed Sell through?</label> -->
            <!-- 					                        	<div class="col-lg-4"> -->
            													<?php
            //  	                        		    				$select = DropDownUtils::getBooleanDropDown("isrobbyreviewedsellthrough", null, $customerChristmasQuestion->getIsRobbyReviewedSellThrough(),false,false);
            //     			                        				echo $select;
            // 	                             					?>
            <!-- 					                        	</div> -->
            <!-- 				                        	</div> -->
            <!-- 										</div> -->
            <!-- 										<div class="form-group"> -->
            <!-- 											 <div class="row "> -->
            <!-- 					                        	<label class="col-lg-8 col-form-label bg-formLabel">Should i visit this customer during the 4th qtr to comp shop their xmas items?</label> -->
            <!-- 					                        	<div class="col-lg-4"> -->
            													<?php
            //  	                        		    				$select = DropDownUtils::getBooleanDropDown("isvisitcustomerin4qtr", null, $customerChristmasQuestion->getIsVisitCustomerIn4Qtr(),false,false);
            //     			                        				echo $select;
            // 	                             					?>
            <!-- 					                        	</div> -->
            <!-- 				                        	</div> -->
            <!-- 										</div> -->
            <!-- 		                        		<div class="form-group"> -->
            <!-- 											 <div class="row "> -->
            <!-- 					                        	<label class="col-lg-8 col-form-label bg-formLabel">When do we need to quote you christmas by?</label> -->
            <!-- 					                        	<div class="col-lg-4"> -->
            <!-- 					                        		<input type="text" value="<?php echo $customerChristmasQuestion->getChristMasquoteByDate()?>" name="christmasquotebydate" id="christmasquotebydate" class="form-control dateControl">-->
            <!-- 					                        	</div> -->
            <!-- 				                        	</div> -->
            <!-- 										</div> -->
            		                        	
            				                    	</div>
            				                	</div>
            				                <div class="form-group row buttonsDiv">
            		                       		<div class="col-lg-2">
            			                        	<button class="btn btn-primary" onclick="saveQuestionnaire('createChristmasQuestionForm')" type="button" style="width:85%">Save</button>
            			                        </div>
            			                      
            			                    </div>
            							</div>
            	                   </form>
            	                   </div>
            	                   </div>
    	                   </div>
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
				                        	<div class="row ">
					                       		<label class="col-lg-8 col-form-label bg-formLabel">Data Saving for Year</label>
					                        	<div class="col-lg-4">
					                        		<?php 
					                        		$select = DropDownUtils::getYearDD("year", null, $customerOppurtunityBuy->getYear(),false,false);
                    			                        echo $select;
                	                             	?>
					                        	</div>
					                        </div>
					                    </div>
				                       <div class="form-group">
				                       		<div class="row ">
					                       		<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelDark">What trade shows are they going to in 2021?</label>
					                        	<div class="col-lg-4">
					                        		<select class="tradeshowsgoingto form-control" name="tradeshowsgoingto[]" multiple  >
    					                   		     		<?php 
    					                   		     		foreach($tradeShowsTypeOppBuy as $key=>$value){
    					                   		     		    $selected = "";
    					                   		     		    if(in_array($key,$selectedTradeShowsTypeOppBuy)){
    					                   		     		        $selected = "selected";
    					                   		     		    }
    					                   		     		    echo ('<option '.$selected.' value="'.$key.'">'.$value.'</option>');
        					                   		       }?>
    					                   		       </select>
					                        	</div>
				                        	</div>
				                        	<div class="row ">
						                    	<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelDark">Have you sent them holiday catalog link?</label>
					                        	<div class="col-lg-4">
													<?php
 	                        		    				$select = DropDownUtils::getBooleanDropDown("isxmascateloglinksent", null, $customerOppurtunityBuy->getIsXmasCatelogLinkSent(),false,true,'N/A');
    			                        				echo $select;
	                             					?>
					                        	</div>
					                        </div>
				                        </div>
				                   	</div> 
				                    <div class="col-lg-10">
				                    	<div class="form-group">
					                    	<div class="row ">
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
			                        
			                    </div>
		                    </div>
	                   </form> 
	                   </div>
	             		<div role="tabpanel" id="tab-3" class="tab-pane">
							<div class="panel-group" id="accordion">
                                <div id="springQuesPanel"></div>
                                <a onclick="javascript:addSpringQuestionForm(0,true,true)" class="pull-right">Add More</a>
                            </div>
	                   		
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
var index = 0;
$(document).ready(function(){
	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		notesShowHide();
	});
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
	});
	$('#christmasCategory' + customerSeq).select2({companies: true,width:245,placeholder: "Select Categories",});
	$('.categoriesshouldsellthem').select2({companies: true,width:245,placeholder: "Select Categories",});
	$('.formCategories').select2({companies: true,width:245,placeholder: "Select Categories",});
	$('.tradeshowsgoingto').select2({companies: true,width:245,placeholder: "Select Shows",});
	
// 	$('.formCategories').on('select2:select', function (e) {
// 		$("#first").val(); 
// 	    var data = e.params.data;
// 	    $(".springQuestionsPanelHeading1").append(data.text);
// 	});
	loadSpringQuesForms();
	handleChristmasCategorySelect(customerSeq);
	notesShowHide();
	onChangeIsCustomerGoingToSelectHolidayItems("<?php echo $customerChristmasQuestion->getCustomerSelectXmasItemsFrom()?>");
});
function loadSpringQuesForms(){
	$.get("Actions/CustomerSpringQuestionAction.php?call=getByCustoimerSeq&customerseq="+customerSeq, function(data){
   		var jsonData = $.parseJSON(data);
   		var springQuesArr = $.parseJSON(jsonData.data);
   		var length = springQuesArr.length;	
   		if(length > 0){
   	   		$i = 1;
   	   		isLast = 0;
   	   		
       		$.each(springQuesArr,function(key,value){
           		if($i == length){
           			isLast = true;
           		}               		
       			addSpringQuestionForm(value.seq,0,isLast);
       			$i++;
       		});
   		}else{
   			addSpringQuestionForm(0,true,true);
   		}
	});	
}

function addSpringQuestionDiv(selectedSpringQuesSeq){
	var divName = "springQuesDiv" + selectedSpringQuesSeq;
	if (document.getElementById(divName)) {
	  alert('New form already added!');
	  return false;
	} else {
		var springQuesDiv = "<div id='springQuesDiv" + selectedSpringQuesSeq  +"'></div>";
		$('#springQuesPanel').append(springQuesDiv);
		return true;
	}	
}

function addSpringQuestionForm(seq,isAdded,isLast){
	index++;
	if(isAdded){
		seq = index;
	}
	var flag = addSpringQuestionDiv(seq);
	if(flag == true){
    	$.ajax({
    	  	url: "createCustomerQuestionaireSpringForm.php?seq="+seq+"&customerseq="+customerSeq+"&isadded="+isAdded+"&index="+index+"&islast="+isLast,    	  
    	}).done(function(data) { // data what is sent back by the php page 
    		collapseAll("",isAdded);       	
    	  	$('#springQuesDiv' + seq).html(data); // display data
    	  	$('.categoriesshouldsellthem').select2({companies: true,width:245,placeholder: "Select Categories",});
    		$('.formCategories').select2({companies: true,width:245,placeholder: "Select Categories",});
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
    			}
    		});
    		$('#springCategory' + seq).on('change', function (e) {
        		var selectedValues = $(this).select2('data');
        		setCategoriesOnHeader(selectedValues,seq)
    	 	});
			$('#christmasCategory' + seq).on('change', function (e) {
        		var selectedValues = $(this).select2('data');
        		setCategoriesOnHeader(selectedValues,seq)
    	 	});
    	 	$(".isallcategoriesselected").on('ifChanged', function(event){
				id = this.id.replace('isallcategoriesselected','');
				handleCategorySelect(id);
				handleChristmasCategorySelect(id);

  			});
    		if(!isAdded){
    			var selectedValues = $('#springCategory' + seq).select2('data');
    			setCategoriesOnHeader(selectedValues,seq);
    			
    		}
    		handleCategorySelect(seq)
    		$("#createSpringQuesForm"+seq).dirrty().on("dirty", function(){
		
				$("#saveSpringQuesBtn"+seq).removeAttr("disabled");
    		}).on("clean", function(){
    			$("#saveSpringQuesBtn"+seq).attr("disabled", "disabled");
    		});
			$("#isVisitCustomerDuring2ndqtr"+seq+" #isvisitcustomerduring2ndqtr").change(()=>{
				var val = $("#isVisitCustomerDuring2ndqtr"+seq+" #isvisitcustomerduring2ndqtr").val();
				if(val == 'yes'){
					$("#springDiv"+seq).show();
				}else{
					$("#springDiv"+seq).hide();
				}
			});
			onChangeIsCustomerGoingToSelectSpringItems(seq);
			springNotesShowHide(seq);
			// alert($("#customerSelectingSpringItemsFromRow"+seq+" input").val());
    	});	
	}
}
function calculateTyVsLyForSpringQuestionaire(seq){
	var itemsPurchasedLastYear = $("#itemspurchasedlastyear" + seq).val();
	var itemsSelectionFinalized = $("#itemselectionfinalized" + seq).val();
	$("#finalizedtyvsly" + seq).val(Math.abs(itemsPurchasedLastYear - itemsSelectionFinalized));
}
function handleCategorySelect(seq){
	var flag  = $("#isallcategoriesselected" + seq).is(':checked');
	var selectedValues = [{text:"All"}];
	if(flag){
		$('#springCategory' + seq).next(".select2-container").hide();	
		$('#springCategory' + seq).attr("disabled","disabled");
	}else{
		$('#springCategory' + seq).removeAttr("disabled")
		$('#springCategory' + seq).next(".select2-container").show();
		selectedValues = $('#springCategory' + seq).select2('data');
	}
	setCategoriesOnHeader(selectedValues,seq)
}

function setCategoriesOnHeader(selectedValues,seq){
	var textArr =[];
	$.each(selectedValues,function(key,value){
		textArr.push(value.text);
	});
	var textStr = textArr.join(", ")
	$(".springQuestionsPanelHeading"+seq).text(textStr);
}

function collapseAll(id,isAdded){
	$("#springQuesPanel .panel-collapse").each(function() {
		if(id != this.id || isAdded == true){
			$(this).attr("class","panel-collapse collapse");
		}
	});
}

function saveQuestionnaire(formName){
	formName = "#" + formName;
	if($(formName)[0].checkValidity()) {
		showHideProgress()
		$(formName).ajaxSubmit(function( data ){
		   showHideProgress();
		   var flag = showResponseToastr(data,null,null,"ibox");
		   if(flag){
			   var obj = $.parseJSON(data);
			   $(formName + " #seq").val(obj.seq);
			   $(formName + " #isaddNew").val('');
			   //$("#deletePanel" + seq).removeAttr("onclick");
			   //$(formName + " #deletePanel").attr("onclick","removePanel("+obj.seq+",'')");
		   }
		   $('html, body').animate({scrollTop:$(document).height()}, 'slow');
	    })	
	}else{
		$(formName)[0].reportValidity();
	}
}
function removePanel(seq){
	bootbox.confirm("Do you realy want to delete this spring questionnaire?", function(result) {
        if(result){
        	formName = "#createSpringQuesForm" + seq;
        	id = $(formName + " #seq").val();
        	isAddedNew =  $(formName + " #isaddNew").val();
        	var mainPanelId = "panelMainDiv" + seq;
        	if(isAddedNew == ''){
        		$.get("Actions/CustomerSpringQuestionAction.php?call=deleteBySeq&seq="+id, function(data){
        			showResponseToastr(data,null,null,"ibox");	
        			$( "div" ).remove( "#"+mainPanelId );		
        		});
        	}else{
        		$( "div" ).remove( "#"+mainPanelId );	
        	}
        }
	});
}
function SomethingChanged(control){
    if( control.value != control.InitVal )
         control.IsDirty = true;
    else
         control.IsDirty = false;
    alert(control.IsDirty);
}
function handleChristmasCategorySelect(customerSeq){
	var flag  = $("#isallcategoriesselected" + customerSeq).is(':checked');
	var selectedValues = [{text:"All"}];
	if(flag){
		$('#christmasCategory' + customerSeq).attr("disabled","disabled");
		$('#christmasCategory' + customerSeq).next(".select2-container").hide();
	}else{
		$('#christmasCategory' + customerSeq).removeAttr("disabled")
		$('#christmasCategory' + customerSeq).next(".select2-container").show();
		selectedValues = $('#christmasCategory' + customerSeq).select2('data');	
	}
	setCategoriesOnHeader(selectedValues,customerSeq)
}
function notesShowHide(){
	isYes = $("#istheremorebuyers :selected").val();
	if( isYes == "yes"){
		$("#christmasNotesDiv").slideDown();
	}else{
		$("#christmasNotesDiv").slideUp();
		$("#christmasNotesDiv textarea").val("");
	}
	isYes = $("#isvisitcustomerduring2ndqtr :selected").val();
	if( isYes == "yes"){
		$("#springNotesDiv").slideDown();
	}else{
		$("#springNotesDiv").slideUp();
		$("#springNotesDiv textarea").val("");
	}
}
function showHideSpringSampleDateField(currentValue){
	var val = $(currentValue).val();
	// alert(val);
	if(val == 'yes'){
		$("#springsampledateDiv").show();
	}else{
		$("#springsampledateDiv").hide();
	}
}
function onChangeIsCustomerGoingToSelectSpringItems(seq){
	var selectedValue = $("#customerSelectingSpringItemsFromRow"+seq+" select[name='customerselectingspringitemsfrom']").val();
	if(selectedValue == "other"){
		$("#customerIsGoingToSelectSpringItemsTextBoxRow"+seq).show();
	}else{
		$("#customerIsGoingToSelectSpringItemsTextBoxRow"+seq).hide();
		$("#customerIsGoingToSelectSpringItemsTextBoxRow"+ seq + " input[name='wherecustomerselectspringitems']").val("");
	}
}
function onChangeIsCustomerGoingToSelectHolidayItems(selectedValue){
	if(selectedValue == "other"){
		$("#customerIsGoingToSelectHolidayItemsTextBoxRow").show();
	}else{
		$("#customerIsGoingToSelectHolidayItemsTextBoxRow").hide();
		$("#customerIsGoingToSelectHolidayItemsTextBoxRow input[name='wherecustomerselectholidayitems']").val("");
	}
}
function calculateTyVsLyForHolidayQuestionaire(){
	var itemsPurchasedLastYear = $("#itemspurchasedlastyear").val();
	var itemsSelectionFinalized = $("#itemselectionfinalized").val();
	$("#finalizedtyvsly").val(Math.abs(itemsPurchasedLastYear - itemsSelectionFinalized));
}
function springNotesShowHide(seq){
	var val = $("#isVisitCustomerDuring2ndqtr"+seq+" #isvisitcustomerduring2ndqtr").val();
	if(val == 'yes'){
		$("#springNotesDiv"+seq).show();
	}else{
		$("#springNotesDiv"+seq).hide();
		$("#springNotesDiv"+seq+" textarea").val("");
	}
}
</script>