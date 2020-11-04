<?php require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/CustomerSpringQuestion.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerSpringQuestionMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/BuyerCategoryType.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/SeasonShowNameType.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DropdownUtil.php");
$customerSeq = $_REQUEST["customerseq"];
$seq = $_REQUEST["seq"];
$id = $seq;
$isadded = !empty($_GET["isadded"]);
$islast = !empty($_GET["islast"]);
if($isadded){
    $id = 0;
}

$customerSpringQuestion = new CustomerSpringQuestion();
$buyerCategoriesSpringQues = BuyerCategoryType::getAll();
$selectedCategory = array();
$selectedCategoriesSpringQues = array();
$tradeshowsaregoingto = array();
$isAllChecked = "checked";
if(!empty($seq) && !$isadded){
    $seq = $seq;
    $customerSpringQuestionMgr= CustomerSpringQuestionMgr::getInstance();
    $customerSpringQuestion = $customerSpringQuestionMgr->findbySeq($seq);
    if(!empty($customerSpringQuestion->getCategoriesShouldSellThem())){
        $selectedCategoriesSpringQues = explode(",",
            $customerSpringQuestion->getCategoriesShouldSellThem());
    }
    $selectedCategory = array();
    if(!empty($customerSpringQuestion->getCategory())){
        $selectedCategory = explode(",",
            $customerSpringQuestion->getCategory());
    }
    if(empty($customerSpringQuestion->getIsAllCategoriesSelected())){
    	$isAllChecked = "";
    }
    if(!empty($customerSpringQuestion->getTradeshowsAreGoingTo())){
        $tradeshowsaregoingto = explode(",",$customerSpringQuestion->getTradeshowsAreGoingTo());
    }
}


?>
<div id="panelMainDiv<?echo $seq?>" class="panel panel-default">
    <div class="panel-heading">
        <h5 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" 
            	href="#collapse<?echo $seq?>" onclick="collapseAll('collapse<?php echo $seq?>')">Spring Questions for Category(s) - 
            	<label class="springQuestionsPanelHeading<?echo $seq?>"></label></a>
                <span style="font-size: 18px;"><a title="Delete" id="deletePanel<?echo $seq?>" onclick="removePanel('<?echo $seq?>')" class="pull-right m-l-sm"><i class="fa fa-times"></i></a></span>
                <span style="font-size: 18px;"><a title="Save" onclick="saveQuestionnaire('createSpringQuesForm<?echo $seq?>')" class="pull-right"><i class="fa fa-save"></i></a></span>
        </h5>
    </div>
    	<?php if($isadded || $islast){?>
			<div id="collapse<?php echo $seq?>" class="panel-collapse collapse in" style="" aria-expanded="true">
		<?php }else{?>
			<div id="collapse<?php echo $seq?>" class="panel-collapse collapse" style="" >
		<?php }?>
        <div class="panel-body">
            <form id="createSpringQuesForm<?echo $seq?>" method="post"
            	action="Actions/CustomerSpringQuestionAction.php" class="m-t-sm">
            	<input type="hidden" id="call" name="call" value="saveSpringQuestion" />
            	<input type="hidden" id="customerseq" name="customerseq" value="<?php echo $customerSeq?>" />
            	<input type="hidden" id="seq" name="seq" value="<?php echo $id?>" />
            	<input type="hidden" id="isaddNew" name="isaddNew" value="<?php echo $isadded?>" />
            	<div class="springMainDiv">
            		<div class="row">
            			<div class="col-lg-10">
            				<div class="form-group">
            					<div class="row m-b-xxs">
            						<label class="col-lg-8 col-form-label bg-formLabel">Select Category(s)</label>
            						<div class="col-lg-4">
            							<div>
	            							<input type="checkbox" class="i-checks form-control pull-left"
	            								id="isallcategoriesselected<?echo $seq?>" name="isallcategoriesselected"
	            								<?php echo $isAllChecked?> /> <label>All</label>
	            						</div>
	            						<div class="m-t-sm">
	            							<select id="springCategory<?echo $seq?>" class="formCategories form-control"
	            								name="category[]" multiple>
	            							<?php
	            								foreach ( $buyerCategoriesSpringQues as $key => $value ) {
	            									$selected = "";
	            									if (in_array ( $key, $selectedCategory )) {
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
            					<div class="row m-b-xxs">
            						<label class="col-lg-8 col-form-label bg-formLabel">Data Saving
            							for Year</label>
            						<div class="col-lg-4">
                                    	<?php
            								$select = DropDownUtils::getYearDD ( "year", null, $customerSpringQuestion->getYear (), false, false );
            								echo $select;
            							?>
                                    </div>
            					</div>
            				</div>
            				<div class="form-group">
            					<div class="row m-b-xxs">
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							Date you sent them Spring catalog link?
            						</label>
            						<div class="col-lg-4">
            							
											<?php
 	                        		    				$select = DropDownUtils::getBooleanDropDown("issentcataloglink", null, $customerSpringQuestion->getIsSentCatalogLink(), false, false);
    			                        				echo $select;
	                             			?>
            						</div>
            						<label
            							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">If
            							Yes, Date?</label>
            						<div class="col-lg-4">
            							<div class="input-group date">
            								<input type="text" name="springcataloglinkdate"
            									value="<?php echo $customerSpringQuestion->getSpringCatalogLinkDate()?>"
            									id="springcataloglinkdata"
            									class="form-control  dateControl"> <span
            									class="input-group-addon"><i class="fa fa-calendar"></i></span>
            							</div>
            						</div>
            					</div>
<!--             					<div class="row m-b-xxs m-r-xxs"> -->
<!--             						<div class="panel panel-mauve m-b-none"> -->
<!--             							<div class="panel-heading">Notes</div> -->
<!--             							<div class="panel-body"> -->
<!--             								<textarea style="font-size: 12px" id="sentcataloglinknotes" -->
<!--             									name="sentcataloglinknotes" class="form-control" -->
<!--             									maxLength="1000"><?php echo $customerSpringQuestion->getSentCatalogLinkNotes()?></textarea> -->
<!--             							</div> -->
<!--             						</div> -->
<!--             					</div> -->
            				</div>
            				<div class="form-group">
            					<div class="row m-b-xxs">
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							What trade shows are they going to in 2021?
									</label>
            						<div class="col-lg-4">
            							<select id="tradeshowsaregoingto<?echo $seq?>" class="formCategories form-control"
            								name="tradeshowsaregoingto[]" multiple>
            							<?php
            								foreach ( $buyerCategoriesSpringQues as $key => $value ) {
            									$selected = "";
            									if (in_array ( $key, $tradeshowsaregoingto )) {
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
            					<div class="row m-b-xxs">
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							Have you made an appointment or dinner appt with them?
            						</label>
            						<div class="col-lg-4">
            							
											<?php
 	                        		    				$select = DropDownUtils::getBooleanDropDown("isdinnerappt", null, $customerSpringQuestion->getIsDinnerAppt(), false, false);
    			                        				echo $select;
	                             					?>
            						</div>
            					</div>
            					<div class="row m-b-xxs">
            						<label
            							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">If
            							Yes, Place?</label>
            						<div class="col-lg-4">
            							
            								<input type="text" name="dinnerapptplace"
            									value="<?php echo $customerSpringQuestion->getDinnerApptPlace()?>"
            									id="dinnerapptplace"
            									class="form-control"> 
            							
            						</div>
            					</div>
            				</div>
            				<div class="form-group">
            					<div class="row m-b-xxs">
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							Have you told them that you want to be their main vendor of Holiday and Decor? And your customers are vendor consolidating?
            						</label>
            						<div class="col-lg-4">
											<?php
													$select = DropDownUtils::getBooleanDropDown("ispitchmainvendor", null, $customerSpringQuestion->getIsPitchMainVendor(), false, false);
													echo $select;
	                             			?>
            						</div>
            					</div>
<!--             					<div class="row m-b-xxs m-r-xxs"> -->
<!--             						<div class="panel panel-mauve m-b-none"> -->
<!--             							<div class="panel-heading">Notes</div> -->
<!--             							<div class="panel-body"> -->
<!--             								<textarea style="font-size: 12px" id="pitchmainvendornotes"-->
<!--             									name="pitchmainvendornotes" class="form-control" -->
<!--             									maxLength="1000"><?php echo $customerSpringQuestion->getPitchMainVendorNotes()?></textarea>-->
<!--             							</div> -->
<!--             						</div> -->
<!--             					</div> -->
            				</div>
            				<div class="form-group">
            					<div class="row m-b-xxs">
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							Are there more buyers in other categories? Or does this buyer handle all of Alpine categories?  If there are more, who are they and start all questions to each buyer.
            						</label>
            						<div class="col-lg-4">
											<?php
 	                        		    				$select = DropDownUtils::getBooleanDropDown("isvisitcustomerduring2ndqtr", null, $customerSpringQuestion->getIsVisitCustomerDuring2ndQtr(), false, false);
    			                        				echo $select;
	                             					?>
            						</div>
            					</div>
            				</div>
            				<div class="form-group">
            					<div class="row m-b-xxs">
            						<label
            							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Have
            							you sent them any Spring sample?</label>
            						<div class="col-lg-4">
            							
											<?php
 	                        		    				$select = DropDownUtils::getBooleanDropDown("issentsample", null, $customerSpringQuestion->getIsSentSample(), false, false);
    			                        				echo $select;
	                             					?>
            						</div>
            					</div>
<!--             					<div class="row m-b-xxs"> -->
<!--             						<label -->
<!--             							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">If -->
<!--             							Yes, Date?</label> -->
<!--             						<div class="col-lg-4"> -->
<!--             							<div class="input-group date"> -->
<!--             								<input type="text" name="strategicplanningmeetingdate" -->
<!--             									value="<?php echo $customerSpringQuestion->getSpringSampleDate()?>" -->
<!--             									id="strategicplanningmeetingdate" -->
<!--             									class="form-control  dateControl"> <span -->
<!--             									class="input-group-addon"><i class="fa fa-calendar"></i></span> -->
<!--             							</div> -->
<!--             						</div> -->
<!--             					</div> -->
            				</div>
            				<div class="form-group">
            					<div class="row m-b-xxs">
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							Have a made a appt for a strategic planning meeting?
            						</label>
            						<div class="col-lg-4">
            							
											<?php
 	                        		    				$select = DropDownUtils::getBooleanDropDown("isstrategicplanningmeeting", null, $customerSpringQuestion->getIsStrategicPlanningMeeting(), false, false);
    			                        				echo $select;
	                             					?>
            						</div>
            					</div>
<!--             					<div class="row m-b-xxs"> -->
<!--             						<label -->
<!--             							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">If -->
<!--             							Yes, Date?</label> -->
<!--             						<div class="col-lg-4"> -->
<!--             							<div class="input-group date"> -->
<!--             								<input type="text" name="strategicplanningmeetingdate" -->
            									<!-- value="<?php echo $customerSpringQuestion->getStrategicPlanningMeetingDate()?>" -->
<!--             									id="strategicplanningmeetingdate" -->
<!--             									class="form-control  dateControl"> <span -->
<!--             									class="input-group-addon"><i class="fa fa-calendar"></i></span> -->
<!--             							</div> -->
<!--             						</div> -->
<!--             					</div> -->
            				</div>
            				<div class="form-group">
            					<div class="row m-b-xxs">
            						<label
            							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">What
            							categories have they not bought That I should sell them?<br>
            						<small>Example Bistro Sets</small>
            						</label>
            						<div class="col-lg-4">
            							<select class="categoriesshouldsellthem form-control"
            								name="categoriesshouldsellthem[]" multiple>
            							<?php
            								foreach ( $buyerCategoriesSpringQues as $key => $value ) {
            									$selected = "";
            									if (in_array ( $key, $selectedCategoriesSpringQues )) {
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
            					<div class="row m-b-xxs">
            						<label
            							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Have
            							you invited them to Alpine's Spring showroom?</label>
            						<div class="col-lg-4">
            							
											<?php
 	                        		    				$select = DropDownUtils::getBooleanDropDown("isinvitedtospringshowroom", null, $customerSpringQuestion->getIsinvitedtospringshowroom(), false, false);
    			                        				echo $select;
	                             					?>
            						</div>
            					</div>
<!--             					<div class="row m-b-xxs"> -->
<!--             						<label -->
<!--             							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">If -->
<!--             							Yes, Date?</label> -->
<!--             						<div class="col-lg-4"> -->
<!--             							<div class="input-group date"> -->
<!--             								<input type="text" name="invitedtospringshowroomdate" -->
<!--             									value="<?php echo $customerSpringQuestion->getInvitedToSpringShowroomDate()?>" -->
<!--             									id="invitedtospringshowroomdate" -->
<!--             									class="form-control  dateControl"> <span -->
<!--             									class="input-group-addon"><i class="fa fa-calendar"></i></span> -->
<!--             							</div> -->
<!--             						</div> -->
<!--             					</div> -->
<!--             					<div class="row m-b-xxs"> -->
<!--             						<label -->
<!--             							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">If -->
<!--             							No, Reminder Date?</label> -->
<!--             						<div class="col-lg-4"> -->
<!--             							<div class="input-group date"> -->
<!--             								<input type="text" name="invitedtospringshowroomreminderdate" -->
<!--             									id="invitedtospringshowroomreminderdate" -->
<!--             									value="<?php echo $customerSpringQuestion->getInvitedToSpringShowroomReminderDate()?>" -->
<!--             									class="form-control  dateControl"> <span -->
<!--             									class="input-group-addon"><i class="fa fa-calendar"></i></span> -->
<!--             							</div> -->
<!--             						</div> -->
<!--             					</div> -->
            				</div>
            				<div class="form-group">
            					<div class="row m-b-xxs">
            						<label
            							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">When
            							are they reviewing spring 2022?</label>
            						<div class="col-lg-4">
            							<div class="input-group date">
            								<input type="text" name="springreviewingdate"
            									value="<?php echo $customerSpringQuestion->getSpringReviewingDate()?>"
            									id="springreviewingdate"
            									class="form-control  dateControl"> <span
            									class="input-group-addon"><i class="fa fa-calendar"></i></span>
            							</div>
            						</div>
            					</div>
            					
            				</div>
            				<div class="form-group">
            					<div class="row m-b-xxs">
            						<label
            							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							Are we receiving sell thrus if they bought last year?
            						</label>
            						<div class="col-lg-4">
            							
											<?php
 	                        		    				$select = DropDownUtils::getBooleanDropDown("issellthrough", null, $customerSpringQuestion->getIsSellThrough(), false, false);
    			                        				echo $select;
	                             					?>
            						</div>
            					</div>
            				</div>
            				<div class="form-group">
            					<div class="row m-b-xxs">
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							If they bought Christmas spring last year, have you reviewed the sell thru?
            						</label>
            						<div class="col-lg-4">
											<?php
 	                        		    				$select = DropDownUtils::getBooleanDropDown("isreviewedsellthru", null, $customerSpringQuestion->getIsReviewedSellThru(), false, false);
    			                        				echo $select;
	                             					?>
            						</div>
            					</div>
            				</div>
            				<div class="form-group">
            					<div class="row m-b-xxs">
            						<label
            							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Should
            							we visit this customer during the 2ND qtr to comp shop their
            							spring items?</label>
            						<div class="col-lg-4">
            							
											<?php
 	                        		    				$select = DropDownUtils::getBooleanDropDown("isvisitcustomer2qtr", null, $customerSpringQuestion->getIsvisitcustomer2qtr(), false, false);
    			                        				echo $select;
	                             					?>
            						</div>
            					</div>
            				</div>
            				<div class="form-group">
            					<div class="row m-b-xxs">
            						<label
            							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Where
            							is the customer going to select the Spring items?<br>
            							example - Is he going to select from catalog and circle items, am I going there to make a presentation and take samples, is he coming to our showroom, is he meeting me in Atlanta
           							</label>
            						<div class="col-lg-4">
            							<input type="text" name="customerselectingspringitemsfrom"
            								value="<?php echo $customerSpringQuestion->getCustomerSelectingSpringItemsFrom()?>"
            								id="customerselectingspringitemsfrom" class="form-control">
            						</div>
            					</div>
            				</div>
            				<div class="form-group">
            					<div class="row m-b-xxs">
            						<label
            							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							Spring 2021 Comp Shop Completion Date?
            							</label>
            						<div class="col-lg-4">
            							<div class="input-group date">
            								<input type="text" name="compshopcompletiondate"
            									value="<?php echo $customerSpringQuestion->getCompShopCompletionDate()?>"
            									id="compshopcompletiondata"
            									class="form-control  dateControl"> <span
            									class="input-group-addon"><i class="fa fa-calendar"></i></span>
            							</div>
            						</div>
            					</div>
            				</div>
            				<div class="form-group">
            					
            					<div class="row m-b-xxs">
            						<label
            							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Spring
            							2020 Comp Shop Summary Email sent to SA Team and Robby?</label>
            						<div class="col-lg-4">
            							
											<?php
 	                        		    				$select = DropDownUtils::getBooleanDropDown("iscompshopsummaryemailsent", null, $customerSpringQuestion->getIsCompShopSummaryEmailSent(), false, false);
    			                        				echo $select;
	                             					?>
            						</div>
            						<label
            							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">If
            							Yes, Date?</label>
            						<div class="col-lg-4">
            							<div class="input-group date">
            								<input type="text" name="compshopsummeryemailsentdate"
            									value="<?php echo $customerSpringQuestion->getCompShopSummeryEmailSentDate()?>"
            									id="compshopsummeryemailsentdate"
            									class="form-control  dateControl"> <span
            									class="input-group-addon"><i class="fa fa-calendar"></i></span>
            							</div>
            						</div>
            					</div>
            				</div>
            				
            				<div class="form-group">
            					<div class="row m-b-xxs">
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							Have we quoted for Spring 2022?
            						</label>
            						<div class="col-lg-4">
											<?php
 	                        		    				$select = DropDownUtils::getBooleanDropDown("isquotedforspring", null, $customerSpringQuestion->getIsQuotedForSpring(), false, false);
    			                        				echo $select;
	                             					?>
            						</div>
            					</div>
            				</div>
            				<div class="form-group">
            					<div class="row m-b-xxs">
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							Have they finalized their selections, if so how many items?
           							</label>
            						<div class="col-lg-4">
            							<input type="text" name="itemselectionfinalized"
            								value="<?php echo $customerSpringQuestion->getItemSelectionFinalized()?>"
            								id="itemselectionfinalized" class="form-control">
            						</div>
            					</div>
            				</div>
            				<div class="form-group">
            					<div class="row m-b-xxs">
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							How many items did they purchase last year?
           							</label>
            						<div class="col-lg-4">
            							<input type="text" name="itemspurchasedlastyear"
            								value="<?php echo $customerSpringQuestion->getItemsPurchasedLastYear()?>"
            								id="itemspurchasedlastyear" class="form-control">
            						</div>
            					</div>
            				</div>
            				<div class="form-group">
            					<div class="row m-b-xxs">
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							If they finalized, how many were TY vs LY?
           							</label>
            						<div class="col-lg-4">
            							<input type="text" name="finalizedtyvsly"
            								value="<?php echo $customerSpringQuestion->getFinalizedTyVsLy()?>"
            								id="finalizedtyvsly" class="form-control">
            						</div>
            					</div>
            				</div>
            				<div class="form-group">
            					<div class="row m-b-xxs">
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            						Are we expecting a PO ?
            							</label>
            						<div class="col-lg-4">
            							
											<?php
											$select = DropDownUtils::getIsPoExpecting("arepoexpecting", null, $customerSpringQuestion->getArePoExpecting(), false, false);
    											echo $select;
	                             			?>
            						</div>
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							When are we expecting PO?
            						</label>
            						<div class="col-lg-4">
            							<div class="input-group date">
            								<input type="text" name="expectingpodate"
            									value="<?php echo $customerSpringQuestion->getExpectingPoDate()?>"
            									id="expectingpodate"
            									class="form-control  dateControl"> <span
            									class="input-group-addon"><i class="fa fa-calendar"></i></span>
            							</div>
            						</div>
            					</div>
            				</div>
            				<div class="form-group">
            					<div class="row m-b-xxs">
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							Have we sent them opportunities buys? If so, what is the last date you sent to them.
            						</label>
            						<div class="col-lg-4">
            							
											<?php
 	                        		    				$select = DropDownUtils::getBooleanDropDown("isopportunitiessent", null, $customerSpringQuestion->getIsOpportunitiesSent(), false, false);
    			                        				echo $select;
	                             					?>
            						</div>
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							If so, what is the last date you sent to them.
            						</label>
            						<div class="col-lg-4">
            							<div class="input-group date">
            								<input type="text" name="opportunitiessentdate"
            									value="<?php echo $customerSpringQuestion->getOpportunitiesSentDate()?>"
            									id="opportunitiessentdate"
            									class="form-control  dateControl"> <span
            									class="input-group-addon"><i class="fa fa-calendar"></i></span>
            							</div>
            						</div>
            					</div>
            				</div>
            				
            				
            
            
            			</div>
            			<div class="col-lg-10">
            				
            				
            
<!--             				<div class="form-group"> -->
<!--             					<div class="row m-b-xxs"> -->
<!--             						<label -->
<!--             							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Have -->
<!--             							Robby Reviewed Sell through?</label> -->
<!--             						<div class="col-lg-4"> -->
            						
											<?php
//  	                        		    				$select = DropDownUtils::getBooleanDropDown("isrobbyreviewedsellthrough", null, $customerSpringQuestion->getIsRobbyReviewedSellThrough(), false, false);
//     			                        				echo $select;
// 	                             					?>
<!--             						</div> -->
<!--             					</div> -->
<!--             				</div> -->
            				
<!--             				<div class="form-group"> -->
<!--             					<div class="row m-b-xxs"> -->
<!--             						<label -->
<!--             							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">When -->
<!--             							do we need to quote you christmas by?</label> -->
<!--             						<div class="col-lg-4"> -->
<!--             							<div class="input-group date"> -->
<!--             								<input type="text" name="christmasquotebydate" -->
<!--            									value="<?php echo $customerSpringQuestion->getChristmasQuoteByDate()?>" -->
<!--             									id="christmasquotebydate" class="form-control  dateControl"> <span -->
<!--             									class="input-group-addon"><i class="fa fa-calendar"></i></span> -->
<!--             							</div> -->
<!--             						</div> -->
<!--             					</div> -->
<!--             				</div> -->
<!--             				<div class="form-group"> -->
<!--             					<div class="row m-b-xxs"> -->
<!--             						<label -->
<!--             							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Should -->
<!--             							we visit this customer during the 2ND qtr to comp shop their -->
<!--             							spring items?</label> -->
<!--             						<div class="col-lg-4"> -->
            							
											<?php
//  	                        		    				$select = DropDownUtils::getBooleanDropDown("isvisitcustomerduring2ndqtr", null, $customerSpringQuestion->getIsVisitCustomerDuring2ndQtr(), false, false);
//     			                        				echo $select;
// 	                             					?>
<!--             						</div> -->
<!--             					</div> -->
<!--             				</div> -->
<!--             				<div class="form-group"> -->
<!--             					<div class="row m-b-xxs"> -->
<!--             						<label -->
<!--             							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">When -->
<!--             							do we need to qote you Spring by?</label> -->
<!--             						<div class="col-lg-4"> -->
<!--             							<div class="input-group date"> -->
<!--             								<input type="text" name="quotespringbydate" -->
<!--             									id="quotespringbydate" -->
 <!--           									value="<?php echo $customerSpringQuestion->getQuoteSpringByDate()?>" -->
<!--             									class="form-control  dateControl"> <span -->
<!--             									class="input-group-addon"><i class="fa fa-calendar"></i></span> -->
<!--             							</div> -->
<!--             						</div> -->
<!--             					</div> -->
<!--             				</div> -->
            				
            				
            				
<!--             				<div class="form-group"> -->
<!--             					<div class="row m-b-xxs"> -->
<!--             						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve"> -->
<!--             							Spring 2021 Comp Shop Completion Date? -->
<!--             						</label> -->
<!--             						<div class="col-lg-4"> -->
<!--             							<div class="input-group date"> -->
<!--             								<input type="text" name="compshopcompletiondate" -->
<!--             									id="compshopcompletiondate" -->
            									<!-- value="<?php echo $customerSpringQuestion->getCompShopCompletionDate()?>" -->
<!--             									class="form-control  dateControl"> <span -->
<!--             									class="input-group-addon"><i class="fa fa-calendar"></i></span> -->
<!--             							</div> -->
<!--             						</div> -->
<!--             					</div> -->
<!--             				</div> -->
            				
            				
            				
            				
            				
            			</div>
            		</div>
            		<div class="form-group row buttonsDiv">
            			<div class="col-lg-2">
            				<button disabled id="saveSpringQuesBtn<?echo $seq?>" class="btn bg-formLabelMauve"
            					onclick="saveQuestionnaire('createSpringQuesForm<?echo $seq?>')" type="button"
            					style="width: 85%">Save</button>
            			</div>
            			
            		</div>
            	</div>
            </form>
    	</div>
    </div>
</div>
</script>

