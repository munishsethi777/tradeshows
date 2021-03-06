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
$isQuestionnaireCompletedChecked = "";
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
	$isQuestionnaireCompletedChecked = $customerSpringQuestion->getIsQuestionnaireCompleted() ? 'checked' : '';
}
$hideIfNo = "style='display:none'";
?>
<div id="panelMainDiv<?echo $seq?>" class="panel panel-default">
    <div class="panel-heading">
        <h5 class="panel-title row" style="display:flex;align-items:center">
            <a class='col-lg-11' data-toggle="collapse" data-parent="#accordion" 
            	href="#collapse<?echo $seq?>" onclick="collapseAll('collapse<?php echo $seq?>','spring')">Spring Questions for Category(s) - 
            	<label class="springQuestionsPanelHeading<?echo $seq?>"></label>
			</a>
			<div class='col-lg-1'>
				<span class='col-lg-6' style="font-size: 18px;"><a title="Save" onclick="saveQuestionnaire('createSpringQuesForm<?echo $seq?>')" class="pull-right"><i class="fa fa-save"></i></a></span>
				<span class='col-lg-6' style="font-size: 18px;"><a title="Delete" id="deletePanel<?echo $seq?>" onclick="removePanel('<?echo $seq?>','Spring')" class="pull-right m-l-sm"><i class="fa fa-times"></i></a></span>
			</div>
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
            					<div class="row ">
            						<label class="col-lg-8 col-form-label bg-formLabel">Select Category(s)</label>
            						<div class="col-lg-4">
            							<div>
	            							<input type="checkbox" class="i-checks form-control pull-left isallcategoriesselectedspring"
	            								id="isallcategoriesselected<?echo $seq?>" name="isallcategoriesselected"
	            								<?php echo $isAllChecked?> /> <label>All</label>
	            						</div>
	            						<div class="m-t-sm">
	            							<select id="springCategory<?echo $seq?>" class="formCategories form-control col-lg-4"
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
            					<div class="row ">
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
            				<div class="form-group booleanSelect">
            					<div class="row ">
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							Date you sent them Spring catalog link?
            						</label>
            						<div class="col-lg-4">
            							
											<?php
 	                        		    				$select = DropDownUtils::getBooleanDropDown("issentcataloglink", null, $customerSpringQuestion->getIsSentCatalogLink(), false, true,"N/A");
    			                        				echo $select;
	                             			?>
            						</div>
								</div>
								<div class="row hideIfNo" <?php if($customerSpringQuestion->getIsSentCatalogLink() != '1'){echo $hideIfNo;} ?>>
            						<label
            							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">If
            							Yes, Date?</label>
            						<div class="col-lg-4">
            							<div class="input-group date ">
            								<input type="text" name="springcataloglinkdate"
            									value="<?php echo $customerSpringQuestion->getSpringCatalogLinkDate()?>"
            									id="springcataloglinkdata"
            									class="form-control  dateControl"> <span
            									class="input-group-addon"><i class="fa fa-calendar"></i></span>
            							</div>
            						</div>
            					</div>
<!--             					<div class="row  m-r-xxs"> -->
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
            					<div class="row ">
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							What trade shows are they going to in 2021?
									</label>
            						<div class="col-lg-4">
										<input class="form-control" id="tradeshowsaregoingto" type="text" name="tradeshowsaregoingto" value="<?php echo $customerSpringQuestion->getTradeshowsAreGoingTo() ?>"/>
                					</div>
            					</div>
            				</div>
            				<div class="form-group booleanSelect">
            					<div class="row ">
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							Have you made an appointment or dinner appt with them?
            						</label>
            						<div class="col-lg-4">
            							
											<?php
 	                        		    				$select = DropDownUtils::getBooleanDropDown("isdinnerappt", null, $customerSpringQuestion->getIsDinnerAppt(), false, true,"N/A");
    			                        				echo $select;
	                             					?>
            						</div>
            					</div>
            					<div class="row hideIfNo" <?php if($customerSpringQuestion->getIsDinnerAppt() != '1'){echo $hideIfNo;} ?>>
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
            					<div class="row ">
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							Have you told them that you want to be their main vendor of Holiday and Decor? And your customers are vendor consolidating?
            						</label>
            						<div class="col-lg-4">
											<?php
													$select = DropDownUtils::getBooleanDropDown("ispitchmainvendor", null, $customerSpringQuestion->getIsPitchMainVendor(), false, true,"N/A");
													echo $select;
	                             			?>
            						</div>
            					</div>
<!--             					<div class="row  m-r-xxs"> -->
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
            				<div class="form-group booleanSelect" id="isVisitCustomerDuring2ndqtr<?php echo $seq;?>">
            					<div class="row ">
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							Are there more buyers in other categories? Or does this buyer handle all of Alpine categories?  If there are more, who are they and start all questions to each buyer.
            						</label>
            						<div class="col-lg-4">
											<?php
												$select = DropDownUtils::getBooleanDropDown("isvisitcustomerduring2ndqtr","", $customerSpringQuestion->getIsVisitCustomerDuring2ndQtr(), false, true,"N/A");
												echo $select;
											?>
            						</div>
            					</div>
	                        	<div class="panel panel-primary hideIfNo" id="springNotesDiv<?php echo $seq;?>" <?php if($customerSpringQuestion->getIsVisitCustomerDuring2ndQtr() != '1'){echo $hideIfNo;} ?>>
									<div class="panel-heading">Notes</div>
									<div class="panel-body">
	                                   		<textarea  tabindex="" class="form-control h-auto" maxLength="1000" name="buyerhasmorecategorynotes" ><?php echo $customerSpringQuestion->getBuyerHasMoreCategoryNotes() ?></textarea>
									</div>
		                     	</div>
	                        </div>
            				<div class="form-group booleanSelect">
            					<div class="row">
            						<label
            							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
										Have you sent them a Spring sample?</label>
            						<div class="col-lg-4">
										<?php
											$select = DropDownUtils::getBooleanDropDown("issentsample", "showHideSpringSampleDateField(this)", $customerSpringQuestion->getIsSentSample(), "", true,"N/A");
											echo $select;
										?>
            						</div>
            					</div>
            					<div class="row hideIfNo" id="springsampledateDiv" <?php if($customerSpringQuestion->getIsSentSample() != '1'){echo $hideIfNo;} ?>>
            						<label
            							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">If
            							Yes, Date?</label>
            						<div class="col-lg-4" id="">
            							<div class="input-group date">
            								<input type="text" name="springsampledate"
            									value="<?php echo $customerSpringQuestion->getSpringSampleDate()?>"
            									id="springsampledate"
            									class="form-control  dateControl"> <span
            									class="input-group-addon"><i class="fa fa-calendar"></i></span>
            							</div>
            						</div>
            					</div>
            				</div>
            				<div class="form-group booleanSelect">
            					<div class="row ">
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							Have you made an appointment for a strategic planning meeting?
            						</label>
            						<div class="col-lg-4">
										<?php
											$select = DropDownUtils::getBooleanDropDown("isstrategicplanningmeeting", null, $customerSpringQuestion->getIsStrategicPlanningMeeting(), false, true,"N/A");
											echo $select;
										?>
            						</div>
            					</div>
            					<div class="row hideIfNo" <?php if($customerSpringQuestion->getIsStrategicPlanningMeeting() != '1'){echo $hideIfNo;} ?>>
            						<label
            							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">If
            							Yes, Date?</label>
            						<div class="col-lg-4">
            							<div class="input-group date">
            								<input type="text" name="strategicplanningmeetingdate"
            									value="<?php echo $customerSpringQuestion->getStrategicPlanningMeetingDate()?>"
            									id="strategicplanningmeetingdate"
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
										What categories have they not bought that we should sell them?
            						</label>
            						<div class="col-lg-4">
										<input type="text" name="categoriesshouldsellthem" value="<?php echo $customerSpringQuestion->getCategoriesShouldSellThem() ?>" id="categoriesshouldsellthem" class="form-control" placeholder="Enter Category">
            						</div>
            					</div>
            				<!--</div>
            				
            				<div class="form-group">
            					<div class="row ">
            						<label
            							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Have
            							you invited them to Alpine's Spring showroom?</label>
            						<div class="col-lg-4">
            							
											<?php
 	                        		    				$select = DropDownUtils::getBooleanDropDown("isinvitedtospringshowroom", null, $customerSpringQuestion->getIsinvitedtospringshowroom(), false, true,"N/A");
    			                        				echo $select;
	                             					?>
            						</div>
            					</div>
<!--             					<div class="row "> -->
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
<!--             					<div class="row "> -->
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
            					<div class="row ">
            						<label
            							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">When
            							are they reviewing Spring 2022?</label>
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
            					<div class="row ">
            						<label
            							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							Are we receiving sell thrus if they bought last year?
            						</label>
            						<div class="col-lg-4">
										<?php
											$select = DropDownUtils::getBooleanDropDown("issellthrough", null, $customerSpringQuestion->getIsSellThrough(), false, true,"N/A");
											echo $select;
										?>
            						</div>
            					</div>
            				</div>
            				<div class="form-group">
            					<div class="row ">
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							If they bought Spring last year, have you reviewed the sell thru?
            						</label>
            						<div class="col-lg-4">
										<?php
											$select = DropDownUtils::getBooleanDropDown("isreviewedsellthru", null, $customerSpringQuestion->getIsReviewedSellThru(), false, true,"N/A");
											echo $select;
										?>
            						</div>
            					</div>
            				</div>
            				<div class="form-group">
            					<div class="row ">
            						<label
            							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Should
            							we visit this customer during the 2nd qtr to comp shop their
            							Spring items?</label>
            						<div class="col-lg-4">
            							<?php
											$select = DropDownUtils::getBooleanDropDown("isvisitcustomer2qtr", null, $customerSpringQuestion->getIsvisitcustomer2qtr(), false, true,"N/A");
											echo $select;
										?>
            						</div>
            					</div>
            				</div>
            				<div class="form-group" id="customerSelectingSpringItemsFromRow<?php echo $seq;?>">
            					<div class="row ">
            						<label
            							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Where
            							is the customer going to select the Spring items?
           							</label>
            						<div class="col-lg-4">
            							<?php 
		                        		    $select = DropDownUtils::getXmasItemFromDD("customerselectingspringitemsfrom", "onChangeIsCustomerGoingToSelectSpringItems(".$seq.")", $customerSpringQuestion->getCustomerSelectingSpringItemsFrom(),false,true);
         			                        echo $select;
     	                             	?>
            						</div>
            					</div>
            				</div>
							<div class="form-group" id="customerIsGoingToSelectSpringItemsTextBoxRow<?php echo $seq;?>">
								<div class="panel panel-primary">
									<div class="panel-heading">Other</div>
									<div class="panel-body">
										<input  class="form-control h-auto" name="wherecustomerselectspringitems" value="<?php echo $customerSpringQuestion->getWhereCustomerSelectSpringItems()?>" />
									</div>
								</div>
            				</div>
            				<div class="form-group">
            					<div class="row ">
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
            				<div class="form-group booleanSelect">
            					
            					<div class="row ">
            						<label
            							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Spring
            							2021 Comp Shop Summary Email sent to SA Team and Robby?</label>
            						<div class="col-lg-4">
										<?php
											$select = DropDownUtils::getBooleanDropDown("iscompshopsummaryemailsent", null, $customerSpringQuestion->getIsCompShopSummaryEmailSent(), false, true,"N/A");
											echo $select;
										?>
            						</div>
								</div>
								<div class="row hideIfNo" <?php if($customerSpringQuestion->getIsCompShopSummaryEmailSent() != '1'){echo $hideIfNo;} ?>>
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
            					<div class="row ">
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							Have we quoted for Spring 2022?
            						</label>
            						<div class="col-lg-4">
										<?php
											$select = DropDownUtils::getBooleanDropDown("isquotedforspring", null, $customerSpringQuestion->getIsQuotedForSpring(), false, true,"N/A");
											echo $select;
										?>
            						</div>
            					</div>
            				</div>
            				<div class="form-group" id="itemselectionfinalizedrow<?php echo $seq?>">
            					<div class="row ">
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							Have they finalized their selections, if so how many items?
           							</label>
            						<div class="col-lg-4">
            							<input type="number" name="itemselectionfinalized" min='0'
            								value="<?php echo $customerSpringQuestion->getItemSelectionFinalized()?>"
            								id="itemselectionfinalized<?php echo $seq?>" class="form-control" oninput="calculateTyVsLy(<?php echo $seq;?>,'Spring')">
            						</div>
            					</div>
            				</div>
            				<div class="form-group" id="itemspurchasedlastyearrow<?php echo $seq;?>">
            					<div class="row ">
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							How many items did they purchase last year?
           							</label>
            						<div class="col-lg-4">
            							<input type="number" name="itemspurchasedlastyear" min='0' 
            								value="<?php echo $customerSpringQuestion->getItemsPurchasedLastYear()?>"
            								id="itemspurchasedlastyear<?php echo $seq?>" class="form-control"  oninput="calculateTyVsLy(<?php echo $seq;?>,'Spring')">
            						</div>
            					</div>
            				</div>
            				<div class="form-group" id="finalizedtyvslyrow<?php echo $seq?>">
            					<div class="row ">
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							If they finalized, how many were TY vs LY?
           							</label>
            						<div class="col-lg-4">
            							<input type="text" name="finalizedtyvsly" min='0' 
            								value="<?php echo $customerSpringQuestion->getFinalizedTyVsLy()?>"
            								id="finalizedtyvsly<?php echo $seq?>" class="form-control">
            						</div>
            					</div>
            				</div>
            				<div class="form-group booleanSelect">
            					<div class="row ">
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            						Are we expecting a PO ?
            							</label>
            						<div class="col-lg-4">
            							
											<?php
											$select = DropDownUtils::getIsPoExpecting("arepoexpecting", null, $customerSpringQuestion->getArePoExpecting(), false, true, "N/A");
    											echo $select;
	                             			?>
            						</div>
								</div>
								<div class="row hideIfNo" <?php if($customerSpringQuestion->getArePoExpecting() != 'yes'){echo $hideIfNo;} ?>>
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
            				<div class="form-group booleanSelect">
            					<div class="row ">
            						<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
            							Have we sent them opportunities buys?
            						</label>
            						<div class="col-lg-4">
            							
											<?php
 	                        		    				$select = DropDownUtils::getBooleanDropDown("isopportunitiessent", null, $customerSpringQuestion->getIsOpportunitiesSent(), false, true,"N/A");
    			                        				echo $select;
	                             					?>
            						</div>
								</div>
								<div class="row hideIfNo" <?php if($customerSpringQuestion->getIsOpportunitiesSent() != '1'){echo $hideIfNo;} ?>>
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
							<div class="form-group">
								<div class="row ">
									<label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
										Is Questionnaire Completed.
									</label>
									<div class="col-lg-4">
										<input type="checkbox" class="i-checks form-control pull-left isspringquestionnairecompleted" id="isspringquestionnairecompleted<?echo $id ?>" name="isspringquestionnairecompleted" <?php echo $isQuestionnaireCompletedChecked ?> />
									</div>
								</div>
                        	</div>
            			</div>
            			<div class="col-lg-10">
<!--             				<div class="form-group"> -->
<!--             					<div class="row "> -->
<!--             						<label -->
<!--             							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Have -->
<!--             							Robby Reviewed Sell through?</label> -->
<!--             						<div class="col-lg-4"> -->
            						
											<?php
//  	                        		    				$select = DropDownUtils::getBooleanDropDown("isrobbyreviewedsellthrough", null, $customerSpringQuestion->getIsRobbyReviewedSellThrough(), false, true,"N/A");
//     			                        				echo $select;
// 	                             					?>
<!--             						</div> -->
<!--             					</div> -->
<!--             				</div> -->
            				
<!--             				<div class="form-group"> -->
<!--             					<div class="row "> -->
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
<!--             					<div class="row "> -->
<!--             						<label -->
<!--             							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Should -->
<!--             							we visit this customer during the 2ND qtr to comp shop their -->
<!--             							spring items?</label> -->
<!--             						<div class="col-lg-4"> -->
            							
											<?php
//  	                        		    				$select = DropDownUtils::getBooleanDropDown("isvisitcustomerduring2ndqtr", null, $customerSpringQuestion->getIsVisitCustomerDuring2ndQtr(), false, true,"N/A");
//     			                        				echo $select;
// 	                             					?>
<!--             						</div> -->
<!--             					</div> -->
<!--             				</div> -->
<!--             				<div class="form-group"> -->
<!--             					<div class="row "> -->
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
<!--             					<div class="row "> -->
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

