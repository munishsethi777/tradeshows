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
							<div class="panel-group" id="accordion">
                                <div id="christmasQuesPanel"></div>
                                <a onclick="javascript:addChristmasQuestionForm(0,true,true)" class="pull-right">Add More</a>
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

	$(document).on('change','.isallcategoriesselected',function(){
		alert();
		id = this.id.replace('isallcategoriesselected','');
		handleCategorySelect(id,'spring');
		handleChristmasCategorySelect(id,'christmas');
	});
	loadSpringQuesForms();
	notesShowHide();
	loadChristmasQuesForm();
});

function loadChristmasQuesForm(){
	$.getJSON("Actions/CustomerChristmasQuestionAction.php?call=getByCustomerSeq&customerseq=" + customerSeq, (response)=>{
		var christmasQuesArr = response.data;
		var length = christmasQuesArr.length;
		if(length > 0){
   	   		$i = 1;
   	   		isLast = 0;
   	   		
       		$.each(christmasQuesArr,function(key,value){
           		if($i == length){
           			isLast = true;
           		}               		
       			addChristmasQuestionForm(value.seq,0,isLast);
       			$i++;
       		});
   		}else{
   			addChristmasQuestionForm(0,true,true);
   		}
	});
}
function loadSpringQuesForms(){
	$.get("Actions/CustomerSpringQuestionAction.php?call=getByCustomerSeq&customerseq="+customerSeq, function(data){
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
function addChristmasQuestionDiv(selectedChristmasQuesSeq){
	var divName = "ChristmasQuesDiv" + selectedChristmasQuesSeq;
	if (document.getElementById(divName)) {
	  alert('New form already added!');
	  return false;
	} else {
		var christmasQuesDiv = "<div id='christmasQuesDiv" + selectedChristmasQuesSeq  +"'></div>";
		$('#christmasQuesPanel').append(christmasQuesDiv);
		return true;
	}	
}
function addChristmasQuestionForm(seq,isAdded,isLast){
	index++;
	if(isAdded){
		seq = index;
	}
	var flag = addChristmasQuestionDiv(seq);
	if(flag == true){
    	$.ajax({
    	  	url: "createCustomerQuestionaireChristmasForm.php?seq="+seq+"&customerseq="+customerSeq+"&isadded="+isAdded+"&index="+index+"&islast="+isLast,    	  
    	}).done(function(data) { // data what is sent back by the php page 
    		collapseAll("",'christmas',isAdded);       	
    	  	$('#christmasQuesDiv' + seq).html(data); // display data
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
    		
			$('#christmasCategory' + seq).on('change', function (e) {
        		var selectedValues = $(this).select2('data');
        		setCategoriesOnHeader(selectedValues,seq,'christmas')
    	 	});
			handleChristmasCategorySelect(seq,'christmas');
    		if(!isAdded){
    			var selectedValues = $('#christmasCategory' + seq).select2('data');
    			setCategoriesOnHeader(selectedValues,seq,'christmas');
    		}
    		// handleCategorySelect(seq);
    		$("#createChristmasQuesForm"+seq).dirrty().on("dirty", function(){
		
				$("#saveChristmasQuesBtn"+seq).removeAttr("disabled");
    		}).on("clean", function(){
    			$("#saveChristmasQuesBtn"+seq).attr("disabled", "disabled");
    		});
			$("#isVisitCustomerDuring2ndqtr"+seq+" #isvisitcustomerduring2ndqtr").change(()=>{
				var val = $("#isVisitCustomerDuring2ndqtr"+seq+" #isvisitcustomerduring2ndqtr").val();
				if(val == 'yes'){
					$("#christmasDiv"+seq).show();
				}else{
					$("#christmasDiv"+seq).hide();
				}
			});
			onChangeIsCustomerGoingToSelectSpringItems(seq);
			springNotesShowHide(seq);
			onChangeIsCustomerGoingToSelectHolidayItems(seq);
    	});	
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
    		collapseAll("",'spring',isAdded);       	
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
        		setCategoriesOnHeader(selectedValues,seq,'spring');
    	 	});
    		if(!isAdded){
    			var selectedValues = $('#springCategory' + seq).select2('data');
    			setCategoriesOnHeader(selectedValues,seq,'spring');
    		}
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
			handleCategorySelect(seq,'spring');
			onChangeIsCustomerGoingToSelectSpringItems(seq);
			springNotesShowHide(seq);
    	});	
	}
}
function calculateTyVsLyForSpringQuestionaire(seq){
	var itemsPurchasedLastYear = $("#itemspurchasedlastyear" + seq).val();
	var itemsSelectionFinalized = $("#itemselectionfinalized" + seq).val();
	$("#finalizedtyvsly" + seq).val(Math.abs(itemsPurchasedLastYear - itemsSelectionFinalized));
}
function handleCategorySelect(seq,isFor){
	var flag  = $("#isallcategoriesselected" + seq).is(':checked');
	var selectedValues = [{text:"All"}];
	if(flag){
		$('#springCategory' + seq).attr("disabled","disabled");
		$('#springCategory' + seq).next(".select2-container").hide();	
	}else{
		$('#springCategory' + seq).removeAttr("disabled")
		$('#springCategory' + seq).next(".select2-container").show();
		selectedValues = $('#springCategory' + seq).select2('data');
	}
	setCategoriesOnHeader(selectedValues,seq,isFor)
}
function handleChristmasCategorySelect(id,isFor){
	var flag  = $("#isallcategoriesselected" + id).is(':checked');
	var selectedValues = [{text:"All"}];
	if(flag){
		$('#christmasCategory' + id).attr("disabled","disabled");
		$('#christmasCategory' + id).next(".select2-container").hide();
	}else{
		$('#christmasCategory' + id).removeAttr("disabled")
		$('#christmasCategory' + id).next(".select2-container").show();
		selectedValues = $('#christmasCategory' + id).select2('data');	
	}
	setCategoriesOnHeader(selectedValues,id,isFor)
}
function setCategoriesOnHeader(selectedValues,seq,isFor){
	var textArr =[];
	$.each(selectedValues,function(key,value){
		textArr.push(value.text);
	});
	var textStr = textArr.join(", ")
	$("." + isFor + "QuestionsPanelHeading"+seq).text(textStr);
}

function collapseAll(id,isFor,isAdded){
	$("#" + isFor + "QuesPanel .panel-collapse").each(function() {
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
function removePanel(seq,quesType){
	bootbox.confirm("Do you realy want to delete this " + quesType + " questionnaire?", function(result) {
        if(result){
        	formName = "#create" + quesType + "QuesForm" + seq;
        	id = $(formName + " #seq").val();
        	isAddedNew =  $(formName + " #isaddNew").val();
        	var mainPanelId = "panelMainDiv" + seq;
        	if(isAddedNew == ''){
        		$.get("Actions/Customer" + quesType + "QuestionAction.php?call=deleteBySeq&seq="+id, function(data){
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
function onChangeIsCustomerGoingToSelectHolidayItems(seq){
	var selectedValue = $("#customerSelectingHolidayItemsFromRow"+seq+" select[name='customerselectxmasitemsfrom']").val();
	if(selectedValue == "other"){
		$("#customerIsGoingToSelectHolidayItemsTextBoxRow"+seq).show();
	}else{
		$("#customerIsGoingToSelectHolidayItemsTextBoxRow"+seq).hide();
		$("#customerIsGoingToSelectHolidayItemsTextBoxRow" + seq + " input[name='wherecustomerselectholidayitems']").val("");
	}
}
function calculateTyVsLy(seq,isFor){
	var itemsPurchasedLastYear = $("#create" + isFor + "QuesForm" + seq + " #itemspurchasedlastyear" + seq).val();
	var itemsSelectionFinalized = $("#create" + isFor + "QuesForm" + seq + " #itemselectionfinalized" + seq).val();
	$("#create" + isFor + "QuesForm" + seq + " #finalizedtyvsly" + seq).val(Math.abs(itemsPurchasedLastYear - itemsSelectionFinalized));
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