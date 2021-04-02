<?php require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] . "BusinessObjects/CustomerChristmasQuestion.php");
require_once($ConstantsArray['dbServerUrl'] . "Managers/CustomerChristmasQuestionMgr.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/BuyerCategoryType.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/SeasonShowNameType.php");
require_once($ConstantsArray['dbServerUrl'] . "Utils/DropdownUtil.php");
$customerSeq = $_REQUEST["customerseq"];
$seq = $_REQUEST["seq"];
$id = $seq;
$isadded = !empty($_GET["isadded"]);
$islast = !empty($_GET["islast"]);
if ($isadded) {
    $id = 0;
}

$customerChristmasQuestion = new CustomerChristmasQuestion();
$buyerCategoriesChristmasQues = BuyerCategoryType::getAll();
$selectedCategory = array();
$selectedCategoriesChristmasQues = array();
$tradeshowsaregoingto = array();
$isAllChecked = "checked";
$isQuestionnaireCompletedChecked = "";
if (!empty($seq) && !$isadded) {
    $seq = $seq;
    $customerChristmasQuestionMgr = CustomerChristmasQuestionMgr::getInstance();
    $customerChristmasQuestion = $customerChristmasQuestionMgr->findbySeq($seq);
    if (!empty($customerChristmasQuestion->getCategoriesShouldSellThem())) {
        $selectedCategoriesChristmasQues = explode(
            ",",
            $customerChristmasQuestion->getCategoriesShouldSellThem()
        );
    }
    $selectedCategory = array();
    if (!empty($customerChristmasQuestion->getCategory())) {
        $selectedCategory = explode(
            ",",
            $customerChristmasQuestion->getCategory()
        );
    }
    if (empty($customerChristmasQuestion->getIsAllCategoriesSelected())) {
        $isAllChecked = "";
    }
    if (!empty($customerChristmasQuestion->getTradeshowsAreGoingTo())) {
        $tradeshowsaregoingto = explode(",", $customerChristmasQuestion->getTradeshowsAreGoingTo());
    }
    $isQuestionnaireCompletedChecked = $customerChristmasQuestion->getIsQuestionnaireCompleted() ? 'checked' : '';
}
$hideIfNo = "style='display:none'";

?>
<div id="panelMainDiv<?echo $seq?>" class="panel panel-default">
    <div class="panel-heading">
        <h5 class="panel-title row" style="display:flex;align-items:center">
            <a class='col-lg-11' data-toggle="collapse" data-parent="#accordion" 
            	href="#collapse<?echo $seq?>" onclick="collapseAll('collapse<?php echo $seq?>','christmas')">Holiday Questions for Category(s) - 
            	<label class="christmasQuestionsPanelHeading<?echo $seq?>"></label>
            </a>
            <div class='col-lg-1'>
                <span class='col-lg-6' style="font-size: 18px;"><a title="Save" onclick="saveQuestionnaire('createChristmasQuesForm<?echo $seq?>')" class="pull-right"><i class="fa fa-save"></i></a></span>
                <span class='col-lg-6' style="font-size: 18px;"><a title="Delete" id="deletePanel<?echo $seq?>" onclick="removePanel('<?echo $seq?>','Christmas')" class="pull-right m-l-sm"><i class="fa fa-times"></i></a></span>
            </div>
        </h5>
    </div>
    	<?php if($isadded || $islast){?>
			<div id="collapse<?php echo $seq?>" class="panel-collapse collapse in" style="" aria-expanded="true">
		<?php }else{?>
			<div id="collapse<?php echo $seq?>" class="panel-collapse collapse" style="" >
		<?php }?>
    <div class="panel-body">
        <form id="createChristmasQuesForm<?echo $seq?>" method="post" action="Actions/CustomerChristmasQuestionAction.php" class="m-t-sm">
            <input type="hidden" id="call" name="call" value="saveChristmasQuestion" />
            <input type="hidden" id="customerseq" name="customerseq" value="<?php echo $customerSeq ?>" />
            <input type="hidden" id="seq" name="seq" value="<?php echo $id?>" />
            <input type="hidden" id="isaddNew" name="isaddNew" value="<?php echo $isadded?>" />
            <div class="christmasMainDiv">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="form-group">
                            <div class="row ">
                                <label class="col-lg-8 col-form-label bg-formLabel">Select Category(s)</label>
                                <div class="col-lg-4">
                                    <div>
                                        <input type="checkbox" class="i-checks form-control pull-left isallcategoriesselectedchristmas" id="isallcategoriesselected<?echo $seq ?>" name="isallcategoriesselected" <?php echo $isAllChecked ?> /> <label>All</label>
                                    </div>
                                    <div class="m-t-sm">
                                        <select id="christmasCategory<?echo $seq?>" class="formCategories form-control category " name="category[]" multiple>
                                            <?php
                                            foreach ($buyerCategoriesChristmasQues as $key => $value) {
                                                $selected = "";
                                                if (in_array($key, $selectedCategory)) {
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
                                    $select = DropDownUtils::getYearDD("year", null, $customerChristmasQuestion->getYear(), false, false);
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
                                    $select = DropDownUtils::getBooleanDropDown("isinterested", null, $customerChristmasQuestion->getIsInterested(), false, true, 'N/A');
                                    echo $select;
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group booleanSelect">
                            <div class="row">
                                <label class="col-lg-8 col-form-label bg-formLabel">Date you sent them holiday catalog link?</label>
                                <div class="col-lg-4">
                                    <?php
                                    $select = DropDownUtils::getBooleanDropDown("iscataloglinksent", null, $customerChristmasQuestion->getIsCatalogLinkSent(), false, true, 'N/A');
                                    echo $select;
                                    ?>
                                </div>
                            </div>
                            <div class="row hideIfNo" <?php if($customerChristmasQuestion->getIsCatalogLinkSent() != '1'){echo $hideIfNo;} ?>>
                                <label class="col-lg-8 col-form-label bg-formLabel">If Yes, Date</label>
                                <div class="col-lg-4">
                                    <div class="input-group date">
                                        <input type="text" value="<?php echo $customerChristmasQuestion->getCataloglinkDate() ?>" name="cataloglinkdate" id="cataloglinkdate" class="form-control dateControl">
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
                                    <input class="form-control" id="tradeshowsaregoingto" type="text" name="tradeshowsaregoingto" value="<?php echo $customerChristmasQuestion->getTradeshowsAreGoingTo() ?>" />
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
                                    $select = DropDownUtils::getBooleanDropDown("isdinnerappt", null, $customerChristmasQuestion->getIsDinnerAppt(), false, true, 'N/A');
                                    echo $select;
                                    ?>
                                </div>
                            </div>
                            <div class="row hideIfNo" <?php if($customerChristmasQuestion->getIsDinnerAppt() != '1'){echo $hideIfNo;} ?>>
                                <label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">If
                                    Yes, Place?</label>
                                <div class="col-lg-4 ">

                                    <input type="text" name="dinnerapptplace" value="<?php echo $customerChristmasQuestion->getDinnerApptPlace() ?>" id="dinnerapptplace" class="form-control">

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
                                    $select = DropDownUtils::getBooleanDropDown("ispitchmainvendor", null, $customerChristmasQuestion->getIsPitchMainVendor(), false, true, 'N/A');
                                    echo $select;
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group booleanSelect">
                            <div class="row ">
                                <label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
                                    Are there more buyers in other categories? Or does this buyer handle all of Holiday categories? If there are more buyers, who are they and ask all questions to each buyer.
                                </label>
                                <div class="col-lg-4">
                                    <?php
                                    $select = DropDownUtils::getBooleanDropDown("istheremorebuyers", "", $customerChristmasQuestion->getIsThereMoreBuyers(), false, true, 'N/A');
                                    echo $select;
                                    ?>
                                </div>
                            </div>
                            <div class="panel panel-primary hideIfNo" id="christmasNotesDiv" <?php if($customerChristmasQuestion->getIsThereMoreBuyers() != '1'){echo $hideIfNo;} ?>>
                                <div class="panel-heading">Notes</div>
                                <div class="panel-body">
                                    <textarea tabindex="" class="form-control h-auto" maxLength="1000" name="buyerhasmorecategorynotes"><?php echo $customerChristmasQuestion->getBuyerHasMoreCategoryNotes() ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group booleanSelect">
                            <div class="row ">
                                <label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Have
                                    we sent them any Holiday sample?</label>
                                <div class="col-lg-4">

                                    <?php
                                    $select = DropDownUtils::getBooleanDropDown("isxmassamplessent", null, $customerChristmasQuestion->getIsXmasSamplesSent(), false, true, 'N/A');
                                    echo $select;
                                    ?>
                                </div>
                            </div>
                            <div class="row hideIfNo" <?php if($customerChristmasQuestion->getIsXmasSamplesSent() != '1'){echo $hideIfNo;} ?>>
                                <label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">If
                                    Yes, Date?</label>
                                <div class="col-lg-4">
                                    <div class="input-group date">
                                        <input type="text" name="xmassamplesentdate" value="<?php echo $customerChristmasQuestion->getXmasSampleSentDate() ?>" id="xmassamplesentdate" class="form-control  dateControl"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group booleanSelect">
                            <div class="row ">
                                <label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
                                    Have we made an appointment for a strategic planning meeting?
                                </label>
                                <div class="col-lg-4">

                                    <?php
                                    $select = DropDownUtils::getBooleanDropDown("isstrategicplanningmeetingappointment", null, $customerChristmasQuestion->getIsStrategicPlanningMeetingAppointment(), false, true, 'N/A');
                                    echo $select;
                                    ?>
                                </div>
                            </div>
                            <div class="row hideIfNo" <?php if($customerChristmasQuestion->getIsStrategicPlanningMeetingAppointment() != '1'){echo $hideIfNo;} ?>>
                                <label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">If
                                    Yes, Date?</label>
                                <div class="col-lg-4">
                                    <div class="input-group date">
                                        <input type="text" name="strategicplanningmeetdate" value="<?php echo $customerChristmasQuestion->getStrategicPlanningMeetDate() ?>" id="strategicplanningmeetdate" class="form-control  dateControl"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row ">
                                <label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">What
                                    categories have they not bought that we should sell them?
                                </label>
                                <div class="col-lg-4">
                                    <input type="text" name="categoriesshouldsellthem" value="<?php echo $customerChristmasQuestion->getCategoriesShouldSellThem() ?>" id="categoriesshouldsellthem" class="form-control" placeholder="Enter Category"> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row ">
                                <label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Have
                                    you invited them to Alpine's holiday showroom?</label>
                                <div class="col-lg-4">

                                    <?php
                                    $select = DropDownUtils::getBooleanDropDown("isinvitedtoxmasshowroom", null, $customerChristmasQuestion->getIsInvitedToXmasShowroom(), false, true, 'N/A');
                                    echo $select;
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row ">
                                <label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">When
                                    are they reviewing holiday 2021 ?</label>
                                <div class="col-lg-4">
                                    <div class="input-group date">
                                        <input type="text" name="christmas2020reviewingdate" value="<?php echo $customerChristmasQuestion->getChristmas2020ReviewingDate() ?>" id="christmas2020reviewingdate" class="form-control  dateControl"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="row ">
                                <label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
                                    Are we receiving sell thrus if they bought last year?
                                </label>
                                <div class="col-lg-4">

                                    <?php
                                    $select = DropDownUtils::getBooleanDropDown("isreceivingsellthru", null, $customerChristmasQuestion->getIsReceivingSellThru(), false, true, 'N/A');
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
                                    $select = DropDownUtils::getBooleanDropDown("isreviewedsellthru", null, $customerChristmasQuestion->getIsReviewedSellThru(), false, true, 'N/A');
                                    echo $select;
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row ">
                                <label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Should
                                    we visit this customer during the 4th qtr to comp shop their
                                    holiday items?</label>
                                <div class="col-lg-4">

                                    <?php
                                    $select = DropDownUtils::getBooleanDropDown("isvisitcustomerin4qtr", null, $customerChristmasQuestion->getIsVisitCustomerIn4Qtr(), false, true, 'N/A');
                                    echo $select;
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="customerSelectingHolidayItemsFromRow<?php echo $seq;?>">
                            <div class="row ">
                                <label class="col-lg-8 col-form-label bg-formLabel">Where
                                    is the customer going to select the holiday items?</label>
                                <div class="col-lg-4">
                                    <?php
                                    $select = DropDownUtils::getXmasItemFromDD("customerselectxmasitemsfrom", "onChangeIsCustomerGoingToSelectHolidayItems(".$seq.")", $customerChristmasQuestion->getCustomerSelectXmasItemsFrom(), false, true, 'N/A');
                                    echo $select;
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="customerIsGoingToSelectHolidayItemsTextBoxRow<?php echo $seq;?>">
                            <div class="panel panel-primary">
                                <div class="panel-heading">Other</div>
                                <div class="panel-body">
                                    <input class="form-control h-auto" name="wherecustomerselectholidayitems" value="<?php echo $customerChristmasQuestion->getWhereCustomerSelectHolidayItems(); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="row ">
                                <label class="col-lg-8 col-form-label bg-formLabel">Holiday 2020 Comp Shop Completed?</label>
                                <div class="col-lg-4">
                                    <div class="input-group date">
                                        <input type="text" name="compshopcompleteddate" value="<?php echo $customerChristmasQuestion->getCompShopCompletedDate() ?>" id="compshopcompleteddate" class="form-control  dateControl"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group booleanSelect">
                            <div class="row ">
                                <label class="col-lg-8 col-form-label bg-formLabel">Holiday 2020 Comp Shop Summary Email sent to SA Team and Robby?</label>
                                <div class="col-lg-4">
                                    <?php
                                    $select = DropDownUtils::getBooleanDropDown("isholidayshopcomsummaryemailsent", null, $customerChristmasQuestion->getIsHolidayShopComSummaryEmailSent(), false, true, 'N/A');
                                    echo $select;
                                    ?>
                                </div>
                            </div>
                            <div class="row hideIfNo" <?php if($customerChristmasQuestion->getIsHolidayShopComSummaryEmailSent() != '1'){echo $hideIfNo;} ?>>
                                <label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">If
                                    Yes, Date?</label>
                                <div class="col-lg-4">
                                    <div class="input-group date ">
                                        <input type="text" name="compshopsummaryemailsentdate" value="<?php echo $customerChristmasQuestion->getCompShopSummaryEmailSentDate() ?>" id="compshopsummaryemailsentdate" class="form-control  dateControl"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
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
                                    $select = DropDownUtils::getBooleanDropDown("isquotedforxmas", null, $customerChristmasQuestion->getIsQuotedForXmas(), false, true, 'N/A');
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
                                    <input type="number" name="itemselectionfinalized" value="<?php echo $customerChristmasQuestion->getItemSelectionFinalized() ?>" min='0' id="itemselectionfinalized<?php echo $seq;?>" class="form-control" oninput="calculateTyVsLy(<?php echo $seq;?>,'Christmas')">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row ">
                                <label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
                                    How many holiday items did they purchase last year ?
                                </label>
                                <div class="col-lg-4">
                                    <input type="number" name="itemspurchasedlastyear" value="<?php echo $customerChristmasQuestion->getItemsPurchasedLastYear() ?>" min='0' id="itemspurchasedlastyear<?php echo $seq;?>" class="form-control" oninput="calculateTyVsLy(<?php echo $seq;?>,'Christmas')">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row ">
                                <label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
                                    If they finalized, how many were TY vs LY?
                                </label>
                                <div class="col-lg-4">
                                    <input type="text" name="finalizedtyvsly" value="<?php echo $customerChristmasQuestion->getFinalizedTyVsLy() ?>" min='0' id="finalizedtyvsly<?php echo $seq;?>" class="form-control" >
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
                                    $select = DropDownUtils::getIsPoExpecting("arepoexpecting", null, $customerChristmasQuestion->getArePoExpecting(), false, true, "N/A");
                                    echo $select;
                                    ?>
                                </div>
                            </div>
                            <div class="row hideIfNo" <?php if($customerChristmasQuestion->getArePoExpecting() != 'yes'){echo $hideIfNo;} ?>>
                                <label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
                                    When are we expecting PO?
                                </label>
                                <div class="col-lg-4">
                                    <div class="input-group date ">
                                        <input type="text" name="expectingpodate" value="<?php echo $customerChristmasQuestion->getExpectingPoDate() ?>" id="expectingpodate" class="form-control  dateControl"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
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
                                    $select = DropDownUtils::getBooleanDropDown("isopportunitiessent", null, $customerChristmasQuestion->getIsOpportunitiesSent(), false, true, 'N/A');
                                    echo $select;
                                    ?>
                                </div>
                            </div>
                            <div class="row hideIfNo" <?php if($customerChristmasQuestion->getIsOpportunitiesSent() != '1'){echo $hideIfNo;} ?>>
                                <label class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">
                                    If so, what is the last date you sent to them.
                                </label>
                                <div class="col-lg-4">
                                    <div class="input-group date ">
                                        <input type="text" name="opportunitiessentdate" value="<?php echo $customerChristmasQuestion->getOpportunitiesSentDate() ?>" id="opportunitiessentdate" class="form-control  dateControl"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
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
                                    <input type="checkbox" class="i-checks form-control pull-left ischristmasquestionnairecompleted" id="ischristmasquestionnairecompleted<?echo $id ?>" name="isquestionnairecompleted" <?php echo $isQuestionnaireCompletedChecked ?> />
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
                        //                 	                             	
                        ?>
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
                        // 	                             					
                        ?>
                        <!-- 					                        	</div> -->
                        <!-- 					                        </div> -->
                        <!-- 				                        	<div class="row m-r-xxs"> -->
                        <!-- 				                        		<div class="panel panel-primary m-b-none"> -->
                        <!-- 													<div class="panel-heading">Catalog Link to send</div> -->
                        <!-- 													<div class="panel-body"> -->
                        <!-- 					                                   	<textarea class="form-control" maxLength="1000" name="cataloglinksentnotes" id="cataloglinksentnotes"><?php echo $customerChristmasQuestion->getCatalogLinkSentNotes() ?></textarea> -->
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
                        // 	                             					
                        ?>
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
                        // 	                             					
                        ?>
                        <!-- 					                        	</div> -->
                        <!-- 				                        	</div> -->
                        <!-- 				                        	<div class="row "> -->
                        <!-- 					                        	<label class="col-lg-8 col-form-label bg-formLabel text-right">If Yes, Date?</label> -->
                        <!-- 					                        	<div class="col-lg-4"> -->
                        <!-- 					                        		<input type="text" value="<?php echo $customerChristmasQuestion->getStrategicPlanningMeetDate() ?>" name="strategicplanningmeetdate" id="strategicplanningmeetdate" class="form-control dateControl">-->
                        <!-- 					                        	</div> -->
                        <!-- 					                        </div> -->
                        <!-- 					                        <div class="row m-t-sm"> -->
                        <!-- 					                        	<label class="col-lg-8 col-form-label bg-formLabel">Have we invited them to xmas showroom?</label> -->
                        <!-- 					                        	<div class="col-lg-4"> -->
                        <?php
                        //  	                        		  				  $select = DropDownUtils::getBooleanDropDown("isinvitedtoxmasshowroom", null,$customerChristmasQuestion->getIsInvitedToXmasShowroom(),false,false);
                        //     			                      				  echo $select;
                        // 	                             					
                        ?>
                        <!-- 					                        	</div> -->
                        <!-- 				                        	</div> -->
                        <!-- 				                        	<div class="row "> -->
                        <!-- 				                        		<label class="col-lg-8 col-form-label bg-formLabel text-right">Yes, Date?</label> -->
                        <!-- 					                        	<div class="col-lg-4"> -->
                        <!-- 					                        		<input type="text" value="<?php echo $customerChristmasQuestion->getInvitedtoXmasShowRoomDate() ?>" name="invitedtoxmasshowroomdate" id="invitedtoxmasshowroomdate" class="form-control dateControl" />-->
                        <!-- 					                        	</div> -->
                        <!-- 					                        </div> -->
                        <!-- 					                        <div class="row "> -->
                        <!-- 					                        	<label class="col-lg-8 col-form-label bg-formLabel text-right">No, Reminder Date?</label> -->
                        <!-- 					                        	<div class="col-lg-4"> -->
                        <!-- 					                        		<input type="text" value="<?php echo $customerChristmasQuestion->getInvitedToxMasShowroomReminderDate() ?>" name="invitedtoxmasshowroomreminderdate" id="invitedtoxmasshowroomreminderdate" class="form-control dateControl">-->
                        <!-- 					                        	</div> -->
                        <!-- 				                        	</div> -->
                        <!-- 				                        	<div class="row  m-t-sm"> -->
                        <!-- 					                        	<label class="col-lg-8 col-form-label bg-formLabel">Holiday 2019 Comp Shop Completed?</label> -->
                        <!-- 					                        	<div class="col-lg-4"> -->
                        <?php

                        // 				 	                        		    $select = DropDownUtils::getBooleanDropDown("isholidayshopcompleted", null, $customerChristmasQuestion->getIsHolidayShopCompleted(),false,false);
                        // 				    			                        echo $select;
                        // 					                             	
                        ?>
                        <!-- 					                        	</div> -->
                        <!-- 				                        	</div> -->
                        <!-- 				                        	<div class="row "> -->
                        <!-- 					                        	<label class="col-lg-8 col-form-label bg-formLabel">Holiday 2019 Comp Shop Summary Email sent to SA Team and Robby?</label> -->
                        <!-- 					                        	<div class="col-lg-4"> -->
                        <?php
                        //  	                        		  				  	$select = DropDownUtils::getBooleanDropDown("isholidayshopcomsummaryemailsent", null, $customerChristmasQuestion->getIsHolidayShopComSummaryEmailSent(),false,false);
                        //     			                       					echo $select;
                        // 	                             					
                        ?>
                        <!-- 					                        	</div> -->
                        <!-- 				                        	</div> -->
                        <!-- 					                    </div> -->
                        <!-- 					                    <div class="form-group"> -->
                        <!-- 				                       		<div class="row "> -->
                        <!-- 					                       		<label class="col-lg-8 m-t-sm col-form-label bg-formLabel">When are you reviewing christmas 2020</label> -->
                        <!-- 					                        	<div class="col-lg-4"> -->
                        <!-- 					                        		<input type="text" value="<?php echo $customerChristmasQuestion->getChristmas2020ReviewingDate() ?>" name="christmas2020reviewingdate" id="christmas2020reviewingdate" class="form-control dateControl">-->
                        <!-- 					                        	</div> -->
                        <!-- 				                        	</div> -->
                        <!-- 				                        	<div class="row "> -->
                        <!-- 						                    	<label class="col-lg-8 col-form-label bg-formLabel">Where is the customer going to select the xmas items?</label> -->
                        <!-- 					                        	<div class="col-lg-4"> -->
                        <?php
                        // 					                        		    $select = DropDownUtils::getXmasItemFromDD("customerselectxmasitemsfrom", null, $customerChristmasQuestion->getCustomerSelectXmasItemsFrom(),false,true);
                        //                     			                        echo $select;
                        //                 	                             	
                        ?>
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
                        // 	                             					
                        ?>
                        <!-- 					                        	</div> -->
                        <!-- 				                        	</div> -->
                        <!-- 				                        	<div class="row "> -->
                        <!-- 					                        	<div class="panel panel-primary m-b-none"> -->
                        <!-- 													<div class="panel-heading">Notes</div> -->
                        <!-- 													<div class="panel-body"> -->
                        <!-- 					                                   	<textarea class="form-control" maxLength="1000" name="mainvendornotes"><?php echo $customerChristmasQuestion->getMainVendorNotes() ?></textarea>-->
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
                        // 	                             				
                        ?>
                        <!-- 	                             				</div> -->
                        <!-- 					                        </div> -->
                        <!-- 					                        <div class="row "> -->
                        <!-- 					                        	<label class="col-lg-8 col-form-label bg-formLabel text-right">If Yes, How Much?</label> -->
                        <!-- 					                        	<div class="col-lg-4"> -->
                        <!-- 					                        		<input type="text" name="xmasbuylastyearamount" value="<?php echo $customerChristmasQuestion->getXmasBuyLastYearAmount() ?>" id="xmasbuylastyearamount" class="form-control">-->
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
                        // 	                             					
                        ?>
                        <!-- 					                        	</div> -->
                        <!-- 					                        </div> -->
                        <!-- 					                        <div class="row "> -->
                        <!-- 					                        	<label class="col-lg-8 col-form-label bg-formLabel">Have Robby Reviewed Sell through?</label> -->
                        <!-- 					                        	<div class="col-lg-4"> -->
                        <?php
                        //  	                        		    				$select = DropDownUtils::getBooleanDropDown("isrobbyreviewedsellthrough", null, $customerChristmasQuestion->getIsRobbyReviewedSellThrough(),false,false);
                        //     			                        				echo $select;
                        // 	                             					
                        ?>
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
                        // 	                             					
                        ?>
                        <!-- 					                        	</div> -->
                        <!-- 				                        	</div> -->
                        <!-- 										</div> -->
                        <!-- 		                        		<div class="form-group"> -->
                        <!-- 											 <div class="row "> -->
                        <!-- 					                        	<label class="col-lg-8 col-form-label bg-formLabel">When do we need to quote you christmas by?</label> -->
                        <!-- 					                        	<div class="col-lg-4"> -->
                        <!-- 					                        		<input type="text" value="<?php echo $customerChristmasQuestion->getChristMasquoteByDate() ?>" name="christmasquotebydate" id="christmasquotebydate" class="form-control dateControl">-->
                        <!-- 					                        	</div> -->
                        <!-- 				                        	</div> -->
                        <!-- 										</div> -->

                    </div>
                </div>
                <div class="form-group row buttonsDiv">
                    <div class="col-lg-2">
                        <button disabled class="btn btn-primary" id="saveChristmasQuesBtn<?echo $seq?>" onclick="saveQuestionnaire('createChristmasQuesForm<?echo $seq?>')" type="button" style="width:85%">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</script>