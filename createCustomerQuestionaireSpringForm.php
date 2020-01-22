<form id="createSpringQuesForm" method="post"
	action="Actions/CustomerSpringQuestionAction.php" class="m-t-sm">
	<input type="hidden" id="call" name="call" value="saveSpringQuestion" />
	<input type="hidden" id="customerseq" name="customerseq"
		value="<?php echo $customerSeq?>" />
	<div class="springMainDiv">

		<div class="row">
			<div class="col-lg-10">
				<div class="form-group">
					<div class="row m-b-xxs">
						<label class="col-lg-8 col-form-label bg-formLabel">Select Category(s)</label>
						<div class="col-lg-4">
                        	<select class="formCategories form-control"
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
						<label
							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Have
							you sent them Spring catalog link?</label>
						<div class="col-lg-4">
							<input type="checkbox" class="i-checks form-control"
								id="issentcataloglink" name="issentcataloglink"
								<?php echo !empty($customerSpringQuestion->getIsSentCatalogLink())?"checked":""?> />
						</div>
					</div>
					<div class="row m-b-xxs m-r-xxs">
						<div class="panel panel-mauve m-b-none">
							<div class="panel-heading">Notes</div>
							<div class="panel-body">
								<textarea style="font-size: 12px" id="sentcataloglinknotes"
									name="sentcataloglinknotes" class="form-control"
									maxLength="1000"><?php echo $customerSpringQuestion->getSentCatalogLinkNotes()?></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row m-b-xxs">
						<label
							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Have
							we sent them any Spring sample?</label>
						<div class="col-lg-4">
							<input type="checkbox" class="i-checks form-control"
								id="issentsample" name="issentsample"
								<?php echo !empty($customerSpringQuestion->getIsSentSample())?"checked":""?> />
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row m-b-xxs">
						<label
							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Have
							we made an appointment for a stragetic planning meeting?</label>
						<div class="col-lg-4">
							<input type="checkbox" class="i-checks form-control"
								id="isstrategicplanningmeeting"
								name="isstrategicplanningmeeting"
								<?php echo !empty($customerSpringQuestion->getIsStrategicPlanningMeeting())?"checked":""?> />
						</div>
					</div>
					<div class="row m-b-xxs">
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
					<div class="row m-b-xxs">
						<label
							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Have
							we invited them to Spring showroom?</label>
						<div class="col-lg-4">
							<input type="checkbox" class="i-checks form-control"
								id="isinvitedtospringshowroom" name="isinvitedtospringshowroom"
								<?php echo !empty($customerSpringQuestion->getIsinvitedtospringshowroom())?"checked":""?> />
						</div>
					</div>
					<div class="row m-b-xxs">
						<label
							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">If
							Yes, Date?</label>
						<div class="col-lg-4">
							<div class="input-group date">
								<input type="text" name="invitedtospringshowroomdate"
									value="<?php echo $customerSpringQuestion->getInvitedToSpringShowroomDate()?>"
									id="invitedtospringshowroomdate"
									class="form-control  dateControl"> <span
									class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="row m-b-xxs">
						<label
							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">If
							No, Reminder Date?</label>
						<div class="col-lg-4">
							<div class="input-group date">
								<input type="text" name="invitedtospringshowroomreminderdate"
									id="invitedtospringshowroomreminderdate"
									value="<?php echo $customerSpringQuestion->getInvitedToSpringShowroomReminderDate()?>"
									class="form-control  dateControl"> <span
									class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row m-b-xxs">
						<label
							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Is
							Spring 2020 Comp Shop Completed?</label>
						<div class="col-lg-4">
							<input type="checkbox" class="i-checks form-control"
								id="iscomposhopcompleted" name="iscomposhopcompleted"
								<?php echo !empty($customerSpringQuestion->getIsCompoShopCompleted())?"checked":""?> />
						</div>
					</div>
					<div class="row m-b-xxs">
						<label
							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Spring
							2020 Comp Shop Summary Email sent to SA Team and Robby?</label>
						<div class="col-lg-4">
							<input type="checkbox" class="i-checks form-control"
								id="iscompshopsummaryemailsent"
								name="iscompshopsummaryemailsent"
								<?php echo !empty($customerSpringQuestion->getIsCompShopSummaryEmailSent())?"checked":""?> />
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row m-b-xxs">
						<label
							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">When
							are you reviewing spring 2021?</label>
						<div class="col-lg-4">
							<input type="text" name="springreviewingdate"
								value="<?php echo $customerSpringQuestion->getSpringReviewingDate()?>"
								id="springreviewingdate" class="form-control  dateControl">
						</div>
					</div>
					<div class="row m-b-xxs">
						<label
							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Where
							is the customer going to select the Spring items?</label>
						<div class="col-lg-4">
							<input type="text" name="customerselectingspringitemsfrom"
								value="<?php echo $customerSpringQuestion->getCustomerSelectingSpringItemsFrom()?>"
								id="customerselectingspringitemsfrom" class="form-control">
						</div>
					</div>
				</div>


			</div>
			<div class="col-lg-10">
				<div class="form-group">
					<div class="row m-b-xxs">
						<label
							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Did
							we pitch that we want to be your main vendor of Holiday and
							Décor?<br>And my customers are vendor consolidating?
						</label>
						<div class="col-lg-4">
							<input type="checkbox" class="i-checks form-control"
								id="ispitchmainvendor" name="ispitchmainvendor"
								<?php echo !empty($customerSpringQuestion->getIsPitchMainVendor())?"checked":""?> />
						</div>
					</div>
					<div class="row m-b-xxs m-r-xxs">
						<div class="panel panel-mauve m-b-none">
							<div class="panel-heading">Notes</div>
							<div class="panel-body">
								<textarea style="font-size: 12px" id="pitchmainvendornotes"
									name="pitchmainvendornotes" class="form-control"
									maxLength="1000"><?php echo $customerSpringQuestion->getPitchMainVendorNotes()?></textarea>
							</div>
						</div>
					</div>
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
							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Are
							we receiving sell thru if they bought last year?</label>
						<div class="col-lg-4">
							<input type="checkbox" class="i-checks form-control"
								id="issellthrough" name="issellthrough"
								<?php echo !empty($customerSpringQuestion->getIsSellThrough())?"checked":""?> />
						</div>
					</div>
					<div class="row m-b-xxs">
						<label
							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Have
							Robby Reviewed Sell through?</label>
						<div class="col-lg-4">
							<input type="checkbox" class="i-checks form-control"
								id="isrobbyreviewedsellthrough"
								name="isrobbyreviewedsellthrough"
								<?php echo !empty($customerSpringQuestion->getIsRobbyReviewedSellThrough())?"checked":""?> />
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row m-b-xxs">
						<label
							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Should
							I visit this customer during the 2ND qtr to comp shop their
							spring items?</label>
						<div class="col-lg-4">
							<input type="checkbox" class="i-checks form-control"
								id="isvisitcustomer2qtr" name="isvisitcustomer2qtr"
								<?php echo !empty($customerSpringQuestion->getIsvisitcustomer2qtr())?"checked":""?> />
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row m-b-xxs">
						<label
							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">When
							do we need to quote you christmas by?</label>
						<div class="col-lg-4">
							<div class="input-group date">
								<input type="text" name="christmasquotebydate"
									value="<?php echo $customerSpringQuestion->getChristmasQuoteByDate()?>"
									id="christmasquotebydate" class="form-control  dateControl"> <span
									class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row m-b-xxs">
						<label
							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">Should
							I visit this customer during the 2ND qtr to comp shop their
							spring items?</label>
						<div class="col-lg-4">
							<input type="checkbox" class="i-checks form-control"
								id="isvisitcustomerduring2ndqtr"
								name="isvisitcustomerduring2ndqtr"
								<?php echo !empty($customerSpringQuestion->getIsVisitCustomerDuring2ndQtr())?"checked":""?> />
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row m-b-xxs">
						<label
							class="col-lg-8 col-form-label bg-formLabel bg-formLabelMauve">When
							do we need to qote you Spring by?</label>
						<div class="col-lg-4">
							<div class="input-group date">
								<input type="text" name="quotespringbydate"
									id="quotespringbydate"
									value="<?php echo $customerSpringQuestion->getQuoteSpringByDate()?>"
									class="form-control  dateControl"> <span
									class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
		<div class="form-group row buttonsDiv">
			<div class="col-lg-2">
				<button class="btn bg-formLabelMauve"
					onclick="saveQuestionnaire('createSpringQuesForm')" type="button"
					style="width: 85%">Save</button>
			</div>
			<div class="col-lg-2">
				<a class="btn btn-default" href="manageCustomers.php" type="button"
					style="width: 85%">Cancel</a>
			</div>
		</div>
	</div>
</form>