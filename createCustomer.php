<?include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/GraphicsLog.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DropdownUtil.php");
$customerMgr = CustomerMgr::getInstance();
$customer = new Customer();
$customerSeq = 0;
$storeChecked = "";
$isQuestionnaireRequiredChecked = "";
$storeDisplay = "none";
$customerTextDisplay = "";
$customerSelectDisabled = "disabled";
$customerIdDisabled = "";
$seq="";
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
	$isQuestionnaireRequiredChecked = $customer->getIsQuestionnaireRequired() ? 'checked' : "";
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin | Create Customer</title>
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
.buyers input,.buyers select,.internalSupport input,.internalSupport select,.salesRep input,.salesRep select{
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
.fa{
    font-size:17px;
}
.addButtonDiv{
    display: flex;
    justify-content: flex-end;
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
							<h5 class="pageTitle">Create/Edit Customer</h5>
					</nav>
                 </div>
                 <div class="ibox-content">
                 	<?include "progress.php"?>
                 	 <form id="createCustomerForm" method="post" action="Actions/CustomerAction.php" class="m-t-sm">
                     		<input type="hidden" id ="call" name="call"  value="saveCustomer"/>
							<input type="hidden" id ="seq" name="seq"  value="<?php echo $customerSeq?>"/>
							<div class="form-group row">
								<div class="col-lg-8">
								</div>
	                       		<div class="col-lg-2">
		                        	<button class="btn btn-primary" onclick="saveCustomer()" type="button" style="width:85%">
	                                	Save
		                          	</button>
		                        </div>
		                        <div class="col-lg-2">
		                          	<a class="btn btn-default" href="manageCustomers.php" type="button" style="width:85%">
	                                	Cancel
		                          	</a>
		                        </div>
		                    </div>	   
							<div class="row form-group">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Customer ID</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" <?php echo $customerIdDisabled?> required  maxLength="250" value="<?php echo $customer->getCustomerId()?>" name="customerid" id="customerid" class="form-control">
	                            </div>
								<div class="row i-checks">
									<label class="col-lg-2 col-form-label bg-formLabelMauve">Is Questionnaire Required</label>
									<div class="col-lg-4">
										<input type="checkbox" name="isquestionnairerequired" <?php echo $isQuestionnaireRequiredChecked?> class="isquestionnairerequired"/>
									</div>
								</div>
							</div>                       
	                         <div class="form-group row storeDetailsDiv" style="display:<?php echo $storeDisplay?>">
		                         	<label class="col-lg-2 col-form-label bg-formLabel">Customer Name</label>
		                        	<div class="col-lg-4">
		                        		<select name="fullNameSelect" <?php echo $customerSelectDisabled?> onchange="setCustomerId(this.value)" id="customerSelect" class="fullNameSelect form-control" required>
		                        			<?php if($seq > 0){
		                        			    echo ('<option selected value="'.$seq.'">'.$customer->getFullName().'</option>');
		                        			}?>
		                        		</select>
		                            </div>
	                       	</div>
                        	<div class="form-group row customerNameTextDiv" style="display:<?php echo $customerTextDisplay?>">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Customer Name</label>
	                        	<div class="col-lg-4">
	                        		<input type="text" maxLength="250" value="<?php echo $customer->getFullName()?>" id="fullname" name="fullname" class="form-control" required>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                        	<label class="col-lg-2 col-form-label bg-formLabel">Customer Type</label>
	                        	<div class="col-lg-4">
 	                        		<?php 
	                        		    $select = DropDownUtils::getBusinessCategoryTypes("customertype", null, $customer->getCustomerType(),true,true);
    			                        echo $select;
	                             	?>
								</div>
								<div class="row i-checks">
									<label class="col-lg-2 col-form-label bg-formLabelMauve">Chain Store </label>
									<div class="col-lg-4">
										<input type="checkbox" name="isstore" <?php echo $storeChecked?> class="isstore"/>
									</div>
	                            <!-- <label class="col-lg-2 col-form-label bg-formLabel">Priority </label>
	                        	<div class="col-lg-4">
	                        		<?php 
//     										$select = DropDownUtils::getPriorityTypes("priority", null, $customer->getPriority(),false);
//     			                            echo $select;
	                             	?>
	                        	</div>-->
								</div>
	                        </div>
							<div class="form-group row ">
								<label class="col-lg-2 col-form-label bg-formLabel">Business Type</label>
	                        	<div class="col-lg-4">
 	                        		<?php 
    									$select = DropDownUtils::getBusinessTypes("businesstype","showInternalSupportFields()", $customer->getBusinessType(),true,true);
    			                        echo $select;
	                             	?>
								</div>
								<div class="col-lg-6">
									<div class="form-group row storeDetailsDiv" style="display:<?php echo $storeDisplay?>">
									<label class="col-lg-4 col-form-label bg-formLabelMauve">Store ID</label>
										<div class="col-lg-8">
											<input id="storeId" type="text"  maxLength="250" value="<?php echo $customer->getStoreId()?>" name="storeid" class="form-control">
										</div>
									</div>
								</div>
							</div>
	                        <div class="form-group row">
	                        	<label class="col-lg-2 col-form-label bg-formLabel">Inside Account Manager Name</label>
		                        <div class="col-lg-4">
		                        	<!-- <input type="email"  maxLength="250" value="<?php echo $customer->getInsideAccountManager()?>" name="insideaccountmanager" class="form-control"> -->
									<?php 
    									$select = DropDownUtils::getCustomerInsideAccountManagerNameTypes("insideaccountmanager","", $customer->getInsideAccountManager(),true,true);
    			                        echo $select;
	                             	?>
								</div>
								<div class="col-lg-6">
									<div class="form-group row storeDetailsDiv" style="display:<?php echo $storeDisplay?>">
										<label class="col-lg-4 col-form-label bg-formLabelMauve">Store Name</label>
										<div class="col-lg-8">
											<input id="storeName" type="text"  maxLength="250" value="<?php echo $customer->getStoreName()?>" name="storename" class="form-control">
										</div>
									</div>
								</div>
								
	                        </div>
	                        <div class="form-group row">
	                        	<label class="col-lg-2 col-form-label bg-formLabel">Sales Admin Lead</label>
		                        <div class="col-lg-4">
		                        	<!-- <input type="text"  maxLength="250" value="<?php echo $customer->getSalesAdminLead()?>" name="salesadminlead" class="form-control"> -->
									<?php 
    									$select = DropDownUtils::getCustomerSalesAdminNameTypes("salesadminlead","", $customer->getSalesAdminLead(),true,true);
    			                        echo $select;
	                             	?>
								</div>
								<label class="col-lg-2 col-form-label bg-formLabelMauve">Chain Store Sales Admin</label>
		                        <div class="col-lg-4">
		                        	<input type="text"  maxLength="250" value="<?php echo $customer->getChainStoreSalesAdmin()?>" name="chainstoresalesadmin" class="form-control">
		                        </div>
	                        </div>
	                        
<!-- 	                       <div class="form-group row"> -->
<!-- 	                       		<label class="col-lg-2 col-form-label bg-formLabel">Salesperson Name</label> -->
<!-- 	                        	<div class="col-lg-4"> -->
	                            	<!-- <input type="text"  maxLength="250" value="<?php //echo $customer->getSalesPersonName()?>" name="salespersonname" class="form-control">
<!-- 									 -->
									<?php 
//  	                        		    $select = DropDownUtils::getCustomerSalesPersonName("salespersonname", null, $customer->getSalesPersonName(),false,true);
//     			                        echo $select;
	                             	?>	
<!-- 								</div> -->
<!-- 	                            <label class="col-lg-2 col-form-label bg-formLabel">Salesperson ID</label> -->
<!-- 	                        	<div class="col-lg-4"> -->
	                        		<!-- <input type="text"  maxLength="250" value="<?php //echo $customer->getSalesPersonId()?>" name="salespersonid" class="form-control">
<!-- 									 -->
									<?php 
//  	                        		    $select = DropDownUtils::getCustomerSalesPersonId("salespersonid", null, $customer->getSalesPersonId(),false,true);
//     			                        echo $select;
// 	                             	?>
<!-- 								</div> -->
<!-- 						   </div> -->

<!-- 						   <div class="form-group row"> -->
<!-- 	                       		<label class="col-lg-2 col-form-label bg-formLabel">Salesperson Name 2</label> -->
<!-- 	                        	<div class="col-lg-4"> -->
	                            	<!-- <input type="text"  maxLength="250" value="<?php //echo $customer->getSalesPersonName()?>" name="salespersonname" class="form-control">
<!-- 									 -->
									<?php 
//  	                        		    $select = DropDownUtils::getCustomerSalesPersonName("salespersonname2", null, $customer->getSalesPersonName2(),false,true);
//     			                        echo $select;
	                             	?>	
<!-- 								</div> -->
<!-- 	                            <label class="col-lg-2 col-form-label bg-formLabel">Salesperson ID 2</label> -->
<!-- 	                        	<div class="col-lg-4"> -->
	                        		<!-- <input type="text"  maxLength="250" value="<?php //echo $customer->getSalesPersonId()?>" name="salespersonid" class="form-control">
<!-- 									 -->
									<?php 
//  	                        		    $select = DropDownUtils::getCustomerSalesPersonId("salespersonid2", null, $customer->getSalesPersonId2(),false,true);
//     			                        echo $select;
// 	                             	?>
<!-- 								</div> -->
<!-- 						   </div> -->

<!-- 						   <div class="form-group row"> -->
<!-- 	                       		<label class="col-lg-2 col-form-label bg-formLabel">Salesperson Name 3</label> -->
<!-- 	                        	<div class="col-lg-4"> -->
	                            	<!-- <input type="text"  maxLength="250" value="<?php //echo $customer->getSalesPersonName()?>" name="salespersonname" class="form-control">
<!-- 									 -->
									<?php 
//  	                        		    $select = DropDownUtils::getCustomerSalesPersonName("salespersonname3", null, $customer->getSalesPersonName3(),false,true);
//     			                        echo $select;
	                             	?>	
<!-- 								</div> -->
<!-- 	                            <label class="col-lg-2 col-form-label bg-formLabel">Salesperson ID 3</label> -->
<!-- 	                        	<div class="col-lg-4"> -->
	                        		<!-- <input type="text"  maxLength="250" value="<?php //echo $customer->getSalesPersonId()?>" name="salespersonid" class="form-control">
<!-- 									 -->
									<?php 
//  	                        		    $select = DropDownUtils::getCustomerSalesPersonId("salespersonid3", null, $customer->getSalesPersonId3(),false,true);
//     			                        echo $select;
// 	                             	?>
<!-- 								</div> -->
<!-- 						   </div> -->

<!-- 						   <div class="form-group row"> -->
<!-- 	                       		<label class="col-lg-2 col-form-label bg-formLabel">Salesperson Name 4</label> -->
<!-- 	                        	<div class="col-lg-4"> -->
	                            	<!-- <input type="text"  maxLength="250" value="<?php //echo $customer->getSalesPersonName()?>" name="salespersonname" class="form-control">
<!-- 									 -->
									<?php 
//  	                        		    $select = DropDownUtils::getCustomerSalesPersonName("salespersonname4", null, $customer->getSalesPersonName4(),false,true);
//     			                        echo $select;
	                             	?>	
<!-- 								</div> -->
<!-- 	                            <label class="col-lg-2 col-form-label bg-formLabel">Salesperson ID 4</label> -->
<!-- 	                        	<div class="col-lg-4"> -->
	                        		<!-- <input type="text"  maxLength="250" value="<?php //echo $customer->getSalesPersonId()?>" name="salespersonid" class="form-control">
<!-- 									 -->
									<?php 
//  	                        		    $select = DropDownUtils::getCustomerSalesPersonId("salespersonid4", null, $customer->getSalesPersonId4(),false,true);
//     			                        echo $select;
// 	                             	?>
<!-- 								</div> -->
<!-- 						   </div> -->

							<div class="form-group row m-b-xs">
	                       		<label class="col-lg-12 m-xxs txt-primary" >Sales Rep</label>
	                       	</div>
	                       	<div class="form-group row m-b-xs">
							   	<label class="col-lg-2 col-form-label bg-formLabel">Full Name</label>
	                        	<label class="col-lg-2 col-form-label bg-formLabel">Email</label>
	                        	<label class="col-lg-1 col-form-label bg-formLabel">Phone</label>
	                        	<label class="col-lg-1 col-form-label bg-formLabel">EXT.</label>
	                        	<label class="col-lg-1 col-form-label bg-formLabel">CellPhone</label>
								<label class="col-lg-1 col-form-label bg-formLabel">Position</label>
	                        	<label class="col-lg-2 col-form-label bg-formLabel">Category</label>
								<label class="col-lg-2 col-form-label bg-formLabel">Rep Number</label>
								<label class="col-lg-2 col-form-label bg-formLabel">OMS Cust Id</label>
								<label class="col-lg-2 col-form-label bg-formLabel">Territory</label>
								<label class="col-lg-2 col-form-label bg-formLabel">Company Name</label>
								<label class="col-lg-2 col-form-label bg-formLabel">Ship To Address</label>
								<label class="col-lg-2 col-form-label bg-formLabel">City</label>
								<label class="col-lg-2 col-form-label bg-formLabel">State</label>
								<label class="col-lg-2 col-form-label bg-formLabel">Zip</label>
								<label class="col-lg-2 col-form-label bg-formLabel">Commission</label>
								<label class="col-lg-2 col-form-label bg-formLabel">Is Receives Monthly Sales Report</label>
								<label class="col-lg-2 col-form-label bg-formLabel">Pricing Tier</label>
								<label class="col-lg-2 col-form-label bg-formLabel">Senior Rep Handling Account</label>
								<label class="col-lg-2 col-form-label bg-formLabel">Sales Admin assigned</label>
	                       	</div>
	                       	<div id="salesRep" class="salesRep">
	                       	</div>
	                        <div class="col-lg-12 pull-right ">
	                       		<div class="col-lg-1 pull-right addButtonDiv">
	                        		<button class="btn btn-xs btn-success" id="addSalesRepBtn" onclick="addSalesRep()" type="button">
	                        		<i class="fa fa-plus"></i> Sales Rep</button>
	                        	</div>
	                        </div>
							<div id="internalSupportMainDiv">
								<div class="form-group row m-b-xs">
									<label class="col-lg-12 m-xxs txt-primary" >Internal Support</label>
								</div>
								<div class="form-group row m-b-xs">
									<label class="col-lg-2 col-form-label bg-formLabel">Full Name</label>
									<label class="col-lg-2 col-form-label bg-formLabel">Email</label>
									<label class="col-lg-1 col-form-label bg-formLabel">Phone</label>
									<label class="col-lg-1 col-form-label bg-formLabel">EXT.</label>
									<label class="col-lg-1 col-form-label bg-formLabel">CellPhone</label>
									<label class="col-lg-1 col-form-label bg-formLabel">Position</label>
									<label class="col-lg-2 col-form-label bg-formLabel">Category</label>
									<label class="col-lg-2 col-form-label bg-formLabel">Rep Number</label>
									<label class="col-lg-2 col-form-label bg-formLabel">OMS Cust Id</label>
									<label class="col-lg-2 col-form-label bg-formLabel">Territory</label>
									<label class="col-lg-2 col-form-label bg-formLabel">Company Name</label>
									<label class="col-lg-2 col-form-label bg-formLabel">Ship To Address</label>
									<label class="col-lg-2 col-form-label bg-formLabel">City</label>
									<label class="col-lg-2 col-form-label bg-formLabel">State</label>
									<label class="col-lg-2 col-form-label bg-formLabel">Zip</label>
									<label class="col-lg-2 col-form-label bg-formLabel">Commission</label>
									<label class="col-lg-2 col-form-label bg-formLabel">Is Receives Monthly Sales Report</label>
									<label class="col-lg-2 col-form-label bg-formLabel">Pricing Tier</label>
									<label class="col-lg-2 col-form-label bg-formLabel">Senior Rep Handling Account</label>
									<label class="col-lg-2 col-form-label bg-formLabel">Sales Admin assigned</label>
								</div>
								<div id="internalSupport" class="internalSupport">
								</div>
								<div class="col-lg-12 pull-right ">
									<div class="col-lg-1 pull-right addButtonDiv">
										<button class="btn btn-xs btn-success" id="addInternalSupportBtn" onclick="addInternalSupport()" type="button">
										<i class="fa fa-plus"></i> Internal Support</button>
									</div>
								</div>
							</div>
							<div class="form-group row m-b-xs">
    	                       	<label class="col-lg-12 m-xxs txt-primary" >Buyers</label>
							</div>
	                       <div class="form-group row m-b-xs">
						  		<label class="col-lg-2 col-form-label bg-formLabel">First Name</label>
	                        	<label class="col-lg-2 col-form-label bg-formLabel">Last Name</label>
	                        	<label class="col-lg-2 col-form-label bg-formLabel">Email</label>
	                        	<label class="col-lg-1 col-form-label bg-formLabel">Phone</label>
	                        	<label class="col-lg-1 col-form-label bg-formLabel">EXT.</label>
	                        	<label class="col-lg-1 col-form-label bg-formLabel">CellPhone</label>
								<label class="col-lg-1 col-form-label bg-formLabel">Position</label>
	                        	<label class="col-lg-2 col-form-label bg-formLabel">Category</label>
	                       </div>
	                       <div id="buyers" class="buyers">
	                       </div>
	                       <div class="col-lg-12 pull-right ">
	                       		<div class="col-lg-1 pull-right addButtonDiv">
	                        		<button class="btn btn-xs btn-success" id="addBuyerBtn" onclick="addBuyer()" type="button">
	                        		<i class="fa fa-plus"></i> Buyer</button>
	                        	</div>
	                       </div>
	                   </form>      
	         	</div>
	    	</div>
       	
     </div>   	
    </div>
    </div>
	<div class="modal inmodal bs-example-modal-lg" id="NotesModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content animated fadeInRight">
				<div class="modal-body itemDetailsModalDiv mainDiv">
					<div class="ibox">
						<div class="ibox-content" style="height:115px;">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group row m-t-sm">
										<label class="col-sm-4 lblTitle bg-formLabel" id="NotesModalLabel">Enter Notes For ${firstName} ${lastName}</label>
										<div class="col-sm-4">
											<label class="containerreceivedinwmsdate lblDesc text-primary"></label>
										</div>
										<input type="hidden" id="NotesId" value="${id}">
										<textarea id="NotesModalText" name="notes" placeholder="notes" class="form-control">${note}</textarea>
										<div class="col-sm-4">
											<label class="samplesreceivedinwmsdate lblDesc text-primary"></label>
										</div>
									</div>
								</div>        
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" onclick="setNote()" id="setBtn" class="btn btn-white">Continue</button>
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
var customerSeq = "<?php echo $customerSeq ?>";
$(document).ready(function(){
	setInterval(function () {
		$.post('Actions/UserAction.php?call=refreshSession',function(data){
			//alert(data);
			if(data == 0){
				location.href = "userLogin.php";
			}
		});
    },6000);
    
	showInternalSupportFields();
	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
	   	radioClass: 'iradio_square-green',
	});

	$('.userTypeDD').change(function(event){
		if(this.value == "QC"){
			$(".qcDIV").show();
		}else{
			$(".qcDIV").hide();
		}
	});

	$('.delete').click(function() {
		deleteBuyer(this);	
	});
	$('.isstore').on('ifChanged', function(event){
		showHideStoreFields();
  	});
	populateCustomerBuyers();
	loadCustomers();
	$('#salesadminlead').select2();
	$('#insideaccountmanager').select2();
	populateCustomerReps();
});
function showHideStoreFields(){
	var flag  = $(".isstore").is(':checked');
	if(flag){
		// $("#customerid").attr("readonly","readonly");
		$(".storeDetailsDiv").slideDown();
		$(".customerNameTextDiv").hide();
		$("#fullname").attr("disabled","disabled");
		$("#customerSelect").removeAttr("disabled");
	}else{
		// $("#customerid").removeAttr("readonly");
		$(".storeDetailsDiv").slideUp();
		$(".customerNameTextDiv").show();
		$("#customerSelect").attr("disabled","disabled");
		$("#fullname").removeAttr("disabled");
		$("#storeId,#storeName,#fullname").val("");
	}
}
var index = 0;
function addBuyer(isDefaultRow,buyer){
	var firstName = "";
	var lastName  = "";
	var emailid   = "";
	var phone     = "";
	var cellPhone = "";
	var note      = "";
	var skypePersonId = "";
	var position = "";
	var category = "";
	var ext      = "";
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
		if(buyer.officephoneext != null){
			ext = buyer.officephoneext;
		}
		if(buyer.cellphone != null){
			cellPhone = buyer.cellphone;
		}
		if(buyer.notes != null){
			note = buyer.notes;
		}
		if(buyer.skypeid != null){
			skypePersonId = buyer.skypeid;
		}
		if(buyer.position != null){
			position = buyer.position;
		}
		category = buyer.category;
		id = buyer.seq
	}
	var ddId =  'categorySelectDiv'+id;
	var html = '<div class="buyerDiv">';
   		html += "<div class='form-group row m-b-xs salesRepRow' id='buyerRep" + id +"'>";
		html += `<div class="col-lg-2 p-xxs no-margins">
					<input type="text"  maxLength="250" value="${firstName}" id="firstName${id}" name="buyer_firstname[]" class="form-control" placeholder="firstname">
				</div>
				<div class="col-lg-2 p-xxs no-margins">
					<input type="text"  maxLength="250" value="${lastName}" id="lastName${id}" name="buyer_lastname[]" class="form-control" placeholder="lastname">
				</div>`;
		html += '<div class="col-lg-2 p-xxs no-margins">';
		html += '<input type="text"  maxLength="250" value="'+emailid+'" name="buyer_emailid[]" class="form-control" placeholder="emailid">';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input type="text"  maxLength="250" value="'+phone+'" name="buyer_phone[]" class="form-control" placeholder="phone">';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input type="text"  maxLength="250" value="'+ext+'" name="buyer_phoneext[]" class="form-control" placeholder="ext.">';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input type="text"  maxLength="250" value="'+cellPhone+'" name="buyer_cellphone[]" class="form-control" placeholder="cellphone">';
		html += '</div>';
		// html += '<div class="col-lg-1 p-xxs no-margins">';
		// html += '<input type="text" maxLength="250" value="' + skypePersonId + '" name="buyer_skypePersonId[]" class="form-control" placeholder="Skype Person Id">';
		// html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += "<?php $select = DropDownUtils::getCustomerPostions('buyer_position[]', null, '1', false, true); echo $select;?>";
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<div id="'+ddId+'"><select name="buyer_category[]" class="form-control">';
		html += '</select></div>';
		html += '</div>';
		if (typeof isDefaultRow === "undefined" || isDefaultRow == false) {
			html += '<div class="col-lg-1 pull-right"><div class="row"><div class="col-sm-6">';
			html += `<a onclick="showNotes('${id}')" title="Notes" alt="Notes"><h2><i class="fa fa-clipboard text-primary"></i></h2></a>`;
			html += '</div><div class="col-sm-6">'
    		html += '<a onclick="deleteBuyer(this)" title="Delete" alt="Delete"><h2><i class="fa fa-remove text-danger"></i></h2></a>'
    		html += '</div></div></div>';
		}else{
			html += '<div class="col-lg-1 pull-right">';
			html += `<a onclick="showNotes('${id}')" title="Notes" alt="Notes"><h2><i class="fa fa-clipboard text-primary"></i></h2></a>`;
			html += '</div>';
		}
		html += '</div>';
		html += '<!--<div class="form-group row">';
		html += '<div class="col-lg-11 p-xxs">-->';
 		html += `<input type="hidden" name="buyer_notes[]" id="NotesText${id}" placeholder="notes" class="form-control" value="${note}"></input>`;
		html +='<!--</div>-->';
		html += '<!--<div class="col-lg-12 p-xxs" style="border-bottom: 1px silver dashed;"></div>';
		html += '</div></div>-->';
		$("#buyers").append(html);
		$("#buyerRep"+ id +" #buyer_position").val(position);
		
		populateBuyerCategories(category,ddId);
}

function addSalesRep(isDefaultRow,salesRep){
	var seq           = ""
	var firstName     = "";
	var lastName      = "";
	var phone         = "";
	var emailid       = "";
	var cellPhone     = "";
	var note          = "";
	var responsiblity = "";
	var skypePersonId = "";
	var position = "";
	var category      = "";
	var ext           = "";
	var repnumber     = "";
	var omscustid     = "";
	var territory     = "";
	var companyname   = "";
	var shiptoaddress = "";
	var city     	  = "";
	var state     	  = "";
	var zip     	  = "";
	var commission    = "";
	var isreceivesmonthlysalesreport = "";
	var pricingtier   = "";
	var seniorrephandlingaccount     = "";
	var salesadminassigned = "";
	index++;
	var id = index;
	if(typeof salesRep !== "undefined"){
		if(salesRep.customerrepseq != null){
			seq = salesRep.customerrepseq;
		}
		if(salesRep.fullname != null){
			firstName = salesRep.firstname;
		}
		if(salesRep.email != null){
			emailid = salesRep.email;
		}
		if(salesRep.ext != null){
			ext = salesRep.ext;
		}
		if(salesRep.cellphone != null){
			cellPhone = salesRep.cellphone;
		}
		if(salesRep.position != null){
			position = salesRep.position;
		}
		if(salesRep.category != null){
			category = salesRep.category;
		}
		if(salesRep.skypeid != null){
			skypePersonId = salesRep.skypeid;
		}
		if(salesRep.repnumber != null){
			repnumber = salesRep.repnumber;
		}
		if(salesRep.omscustid != null){
			omscustid = salesRep.omscustid;
		}
		if(salesRep.territory != null){
			territory = salesRep.territory;
		}
		if(salesRep.companyname != null){
			companyname = salesRep.companyname;
		}
		if(salesRep.shiptoaddress != null){
			shiptoaddress = salesRep.shiptoaddress;
		}
		if(salesRep.city != null){
			city = salesRep.city;
		}
		if(salesRep.state != null){
			state = salesRep.state;
		}
		if(salesRep.zip != null){
			zip = salesRep.zip;
		}
		if(salesRep.commission != null){
			commission = salesRep.commission;
		}
		if(salesRep.isreceivesmonthlysalesreport != null){
			isreceivesmonthlysalesreport = salesRep.isreceivesmonthlysalesreport;
		}
		if(salesRep.pricingtier != null){
			pricingtier = salesRep.pricingtier;
		}
		if(salesRep.seniorrephandlingaccount != null){
			seniorrephandlingaccount = salesRep.seniorrephandlingaccount;
		}
		if(salesRep.salesadminassigned != null){
			salesadminassigned = salesRep.salesadminassigned;
		}
		// id = salesRep.customerrepallotmentseq;
	}
	var ddId = 'categorySalesRepSelectDiv'+id;
	// var ddId = 'responsibilitySelectDiv'+id;
	var html = '<div class="salesRepDiv">';
   		html += "<div class='form-group row m-b-xs salesRepRow' id='salesRep" + id + "'>";
		html += "<div class='col-lg-2 p-xxs no-margins'>";
		html += '<input id="seq" type="hidden"  value="'+ seq +'" name="salesRep_seq[]" class="form-control"/>';
		html += "<select class='saledRep_name' id='saledRep_name" + id + "' name='salesRep_name[]'></select>";
		html += '<a onclick="deleteSalesRep(this)" title="Delete" alt="Delete"><h2><i class="fa fa-remove text-danger"></i></h2></a>';
		html += "</div>";
		html += '<div class="col-lg-2 p-xxs no-margins">';
		html += '<input id="email" type="text"  maxLength="250" value="'+emailid+'" name="salesRep_emailid[]" class="form-control" placeholder="emailid" readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="phone" type="text"  maxLength="250" value="'+phone+'" name="salesRep_phone[]" class="form-control" placeholder="phone" readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="ext" type="text"  maxLength="250" value="'+ext+'" name="salesRep_phoneext[]" class="form-control" placeholder="ext." readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="cellphone" type="text"  maxLength="250" value="'+cellPhone+'" name="salesRep_cellphone[]" class="form-control" placeholder="cellphone" readonly>';
		html += '</div>';
		// html += '<div class="col-lg-1 p-xxs no-margins">'; 
		// html += '<input type="text" maxLength="250" value="' + skypePersonId + '" name="salesRep_skypePersonId[]" class="form-control" placeholder="Skype Person Id" readonly>';
		// html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += "<?php $select = DropDownUtils::getCustomerPostions('salesRep_position[]', null, '1', false, true); echo $select;?>";
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<div id="'+ddId+'"><select name="salesRep_category[]" class="form-control" >';
		html += '</select></div>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="repnumber" type="text"  maxLength="250" value="'+ repnumber +'" name="salesRep_repNumber[]" class="form-control" placeholder="Rep number." readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="omscustid" type="text"  maxLength="250" value="'+ omscustid +'" name="salesRep_omsCustid[]" class="form-control" placeholder="OMS Cust Id." readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="territory" type="text"  maxLength="250" value="'+ territory +'" name="salesRep_territory[]" class="form-control" placeholder="territory." readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="companyname" type="text"  maxLength="250" value="'+ companyname +'" name="salesRep_companyName[]" class="form-control" placeholder="Company Name." readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="shiptoaddress" type="text"  maxLength="250" value="'+ shiptoaddress +'" name="salesRep_shipToAddress[]" class="form-control" placeholder="Ship To Address." readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="city" type="text"  maxLength="250" value="'+ city +'" name="salesRep_city[]" class="form-control" placeholder="City." readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="state" type="text"  maxLength="250" value="'+ state +'" name="salesRep_state[]" class="form-control" placeholder="State." readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="zip" type="text"  maxLength="250" value="'+ zip +'" name="salesRep_zip[]" class="form-control" placeholder="Zip." readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="commission" type="text"  maxLength="250" value="'+ commission +'" name="salesRep_commission[]" class="form-control" placeholder="Commission." readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="isreceivesmonthlysalesreport" type="text"  maxLength="250" value="'+ isreceivesmonthlysalesreport +'" name="salesRep_isReceivesMonthlySalesReport[]" class="form-control" placeholder="Is Receives Monthly Salses Rep Report" readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="pricingtier" type="text"  maxLength="250" value="' + pricingtier + '" name="salesRep_pricingTier[]" class="form-control" placeholder="Pricing Tier" readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="seniorrephandlingaccount" type="text"  maxLength="250" value="'+ seniorrephandlingaccount +'" name="salesRep_seniorRepHandlingAccount[]" class="form-control" placeholder="Senior Rep Handling Account" readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="salesadminassigned" type="text"  maxLength="250" value="'+ salesadminassigned +'" name="salesRep_salesAdminAssigned[]" class="form-control" placeholder="Sales Admin Assigned" readonly>';
		html += '</div>';
		// html += '<div class="col-lg-1 p-xxs no-margins">';
		// html += '<div id="'+ddId+'"><select name="salesRep_responsibility[]" class="form-control">';
		// html += '</select></div>';
		// html += '</div>';
		
		// if (typeof isDefaultRow === "undefined" || isDefaultRow == false) {
			html += '<div class="col-lg-1 pull-right"><div class="row"><div class="col-sm-6">';
			html += `<a onclick="showNotes('${id}')" title="Notes" alt="Notes"><h2><i class="fa fa-clipboard text-primary"></i></h2></a>`;
			html += '</div>'
			html += '</div></div>';
		// }
		html += '</div>';
		html += '<!--<div class="form-group row">';
		html += '<div class="col-lg-11 p-xxs">-->';
 		html += `<input type="hidden" id="NotesText${id}" name="salesRep_notes[]" placeholder="notes" class="form-control" value="${note}"></input>`;
		html += '<!--</div>-->';
		html += '<!--<div class="col-lg-12 p-xxs" style="border-bottom: 1px silver dashed;"></div>';
		html += '</div></div>-->';
		$("#salesRep").append(html);
		$("#salesRep" + id + " #salesRep_position").val(position);
		$("#salesRep" + id + " #salesRep_position").attr('disabled','true');
		$("#saledRep_name" + id).select2({
			ajax: {
				url: "Actions/CustomerAction.php?call=searchCustomerRep&customerRepType=salesrep",
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
		}).on('select2:select', function(event) {
			// This is how I got ahold of the data
			var data = event.params.data;
			$.each(data,function(index,value){
				$('#salesRep' + id + ' #' + index).val(value);
			});
		});
		populateSalesRepCategories(category,ddId);
		if(typeof salesRep !== "undefined"){
			var newOption = new Option(salesRep.fullname, salesRep.customerrepseq, true, true);
			// Append it to the select2
			$('#saledRep_name' + id).append(newOption).trigger('change');
		}
		// $("#saledRep_name" + id).select2().val(customerRepSeq).trigger('change');
		// populateSalesRepResponsibilities(responsiblity,ddId);
		//populateSalesRepCategories(responsibility,ddId);
}
function addInternalSupport(isDefaultRow,internalSupport){
	var seq           = ""
	var firstName     = "";
	var lastName      = "";
	var phone         = "";
	var emailid       = "";
	var cellPhone     = "";
	var note          = "";
	var responsiblity = "";
	var skypePersonId = "";
	var position = "";
	var category      = "";
	var ext           = "";
	var repnumber     = "";
	var omscustid     = "";
	var territory     = "";
	var companyname   = "";
	var shiptoaddress = "";
	var city     	  = "";
	var state     	  = "";
	var zip     	  = "";
	var commission    = "";
	var isreceivesmonthlysalesreport = "";
	var pricingtier   = "";
	var seniorrephandlingaccount     = "";
	var salesadminassigned = "";
	index++;
	var id = index;
	if(typeof internalSupport !== "undefined"){
		if(internalSupport.customerrepseq != null){
			seq = internalSupport.customerrepseq;
		}
		if(internalSupport.fullname != null){
			firstName = internalSupport.firstname;
		}
		if(internalSupport.email != null){
			emailid = internalSupport.email;
		}
		if(internalSupport.ext != null){
			ext = internalSupport.ext;
		}
		if(internalSupport.cellphone != null){
			cellPhone = internalSupport.cellphone;
		}
		if(internalSupport.position != null){
			position = internalSupport.position;
		}
		if(internalSupport.category != null){
			category = internalSupport.category;
		}
		if(internalSupport.skypeid != null){
			skypePersonId = internalSupport.skypeid;
		}
		if(internalSupport.repnumber != null){
			repnumber = internalSupport.repnumber;
		}
		if(internalSupport.omscustid != null){
			omscustid = internalSupport.omscustid;
		}
		if(internalSupport.territory != null){
			territory = internalSupport.territory;
		}
		if(internalSupport.companyname != null){
			companyname = internalSupport.companyname;
		}
		if(internalSupport.shiptoaddress != null){
			shiptoaddress = internalSupport.shiptoaddress;
		}
		if(internalSupport.city != null){
			city = internalSupport.city;
		}
		if(internalSupport.state != null){
			state = internalSupport.state;
		}
		if(internalSupport.zip != null){
			zip = internalSupport.zip;
		}
		if(internalSupport.commission != null){
			commission = internalSupport.commission;
		}
		if(internalSupport.isreceivesmonthlysalesreport != null){
			isreceivesmonthlysalesreport = internalSupport.isreceivesmonthlysalesreport;
		}
		if(internalSupport.pricingtier != null){
			pricingtier = internalSupport.pricingtier;
		}
		if(internalSupport.seniorrephandlingaccount != null){
			seniorrephandlingaccount = internalSupport.seniorrephandlingaccount;
		}
		if(internalSupport.salesadminassigned != null){
			salesadminassigned = internalSupport.salesadminassigned;
		}
		// id = salesRep.customerrepallotmentseq;
	}
	var ddId = 'categorySalesRepSelectDiv'+id;
	// var ddId = 'responsibilitySelectDiv'+id;
	var html = '<div class="internalSupportDiv">';
   		html += "<div class='form-group row m-b-xs internalSupportRow' id='internalSupport" + id + "'>";
		html += "<div class='col-lg-2 p-xxs no-margins'>";
		html += '<input id="seq" type="hidden"  value="'+ seq +'" name="internalSupport_seq[]" class="form-control"/>';
		html += "<select class='internalSupport_name' id='internalSupport_name" + id + "' name='internalSupport_name[]'></select>";
		html += '<a onclick="deleteInternalSupport(this)" title="Delete" alt="Delete"><h2><i class="fa fa-remove text-danger"></i></h2></a>';
		html += "</div>";
		html += '<div class="col-lg-2 p-xxs no-margins">';
		html += '<input id="email" type="text"  maxLength="250" value="'+emailid+'" name="internalSupport_emailid[]" class="form-control" placeholder="emailid" readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="phone" type="text"  maxLength="250" value="'+phone+'" name="internalSupport_phone[]" class="form-control" placeholder="phone" readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="ext" type="text"  maxLength="250" value="'+ext+'" name="internalSupport_phoneext[]" class="form-control" placeholder="ext." readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="cellphone" type="text"  maxLength="250" value="'+cellPhone+'" name="internalSupport_cellphone[]" class="form-control" placeholder="cellphone" readonly>';
		html += '</div>';
		// html += '<div class="col-lg-1 p-xxs no-margins">'; 
		// html += '<input type="text" maxLength="250" value="' + skypePersonId + '" name="internalSupport_skypePersonId[]" class="form-control" placeholder="Skype Person Id" readonly>';
		// html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += "<?php $select = DropDownUtils::getCustomerPostions('internalSupport_position[]', null, '1', false, true); echo $select;?>";
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<div id="'+ddId+'"><select name="internalSupport_category[]" class="form-control" >';
		html += '</select></div>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="repnumber" type="text"  maxLength="250" value="'+ repnumber +'" name="internalSupport_repNumber[]" class="form-control" placeholder="Rep number." readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="omscustid" type="text"  maxLength="250" value="'+ omscustid +'" name="internalSupport_omsCustid[]" class="form-control" placeholder="OMS Cust Id." readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="territory" type="text"  maxLength="250" value="'+ territory +'" name="internalSupport_territory[]" class="form-control" placeholder="territory." readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="companyname" type="text"  maxLength="250" value="'+ companyname +'" name="internalSupport_companyName[]" class="form-control" placeholder="Company Name." readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="shiptoaddress" type="text"  maxLength="250" value="'+ shiptoaddress +'" name="internalSupport_shipToAddress[]" class="form-control" placeholder="Ship To Address." readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="city" type="text"  maxLength="250" value="'+ city +'" name="internalSupport_city[]" class="form-control" placeholder="City." readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="state" type="text"  maxLength="250" value="'+ state +'" name="internalSupport_state[]" class="form-control" placeholder="State." readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="zip" type="text"  maxLength="250" value="'+ zip +'" name="internalSupport_zip[]" class="form-control" placeholder="Zip." readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="commission" type="text"  maxLength="250" value="'+ commission +'" name="internalSupport_commission[]" class="form-control" placeholder="Commission." readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="isreceivesmonthlysalesreport" type="text"  maxLength="250" value="'+ isreceivesmonthlysalesreport +'" name="internalSupport_isReceivesMonthlySalesReport[]" class="form-control" placeholder="Is Receives Monthly Salses Rep Report" readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="pricingtier" type="text"  maxLength="250" value="' + pricingtier + '" name="internalSupport_pricingTier[]" class="form-control" placeholder="Pricing Tier" readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="seniorrephandlingaccount" type="text"  maxLength="250" value="'+ seniorrephandlingaccount +'" name="internalSupport_seniorRepHandlingAccount[]" class="form-control" placeholder="Senior Rep Handling Account" readonly>';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input id="salesadminassigned" type="text"  maxLength="250" value="'+ salesadminassigned +'" name="internalSupport_salesAdminAssigned[]" class="form-control" placeholder="Sales Admin Assigned" readonly>';
		html += '</div>';
		// html += '<div class="col-lg-1 p-xxs no-margins">';
		// html += '<div id="'+ddId+'"><select name="salesRep_responsibility[]" class="form-control">';
		// html += '</select></div>';
		// html += '</div>';
		
		// if (typeof isDefaultRow === "undefined" || isDefaultRow == false) {
			html += '<div class="col-lg-1 pull-right"><div class="row"><div class="col-sm-6">';
			html += `<a onclick="showNotes('${id}')" title="Notes" alt="Notes"><h2><i class="fa fa-clipboard text-primary"></i></h2></a>`;
			html += '</div>'
			html += '</div></div>';
		// }
		html += '</div>';
		html += '<!--<div class="form-group row">';
		html += '<div class="col-lg-11 p-xxs">-->';
 		html += `<input type="hidden" id="NotesText${id}" name="internalSupport_notes[]" placeholder="notes" class="form-control" value="${note}"></input>`;
		html += '<!--</div>-->';
		html += '<!--<div class="col-lg-12 p-xxs" style="border-bottom: 1px silver dashed;"></div>';
		html += '</div></div>-->';
		$("#internalSupport").append(html);
		$("#internalSupport" + id + " #internalSupport_position").val(position);
		$("#internalSupport" + id + " #internalSupport_position").attr('disabled','true');
		$("#internalSupport_name" + id).select2({
			ajax: {
				url: "Actions/CustomerAction.php?call=searchCustomerRep&customerRepType=internalsupport",
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
		}).on('select2:select', function(event) {
			// This is how I got ahold of the data
			var data = event.params.data;
			$.each(data,function(index,value){
				$('#internalSupport' + id + ' #' + index).val(value);
			});
		});
		populateSalesRepCategories(category,ddId);
		if(typeof internalSupport !== "undefined"){
			var newOption = new Option(internalSupport.fullname, internalSupport.customerrepseq, true, true);
			// Append it to the select2
			$('#internalSupport_name' + id).append(newOption).trigger('change');
		}
		// $("#saledRep_name" + id).select2().val(customerRepSeq).trigger('change');
		// populateSalesRepResponsibilities(responsiblity,ddId);
		//populateSalesRepCategories(responsibility,ddId);
}

function populateCustomerBuyers(){
	if(customerSeq != 0){
    	$.get("Actions/CustomerAction.php?call=getCustomerBuyers&id=<?php echo $customerSeq ?>", function(data){
       		var jsonData = $.parseJSON(data);
       		var buyers = jsonData.buyers;
			   var i = 0;
			   var buyerCount = false;
			   var salesRepCount = false;
			   var internalSupportCount = false;
       		$.each( buyers, function( index, buyer ){
           		if(i == 0){
					  
					if(buyer.buyertype == "buyer"){
						   addBuyer(true,buyer);
						   buyerCount = true;
					}else if(buyer.buyertype == "salesrep"){
						addSalesRep(true, buyer);
						salesRepCount = true;
					}else if(buyer.buyertype == "internalsupport"){
						addInternalSupport(true,buyer);
						internalSupportCount = true;
					}
           		}else{
					if(buyer.buyertype == "buyer"){
						if(!buyerCount){
							addBuyer(true, buyer);
							buyerCount = true;
						}else{
						   addBuyer(false, buyer);
						}
					}else if(buyer.buyertype == "salesrep"){
						if(!salesRepCount){
							addSalesRep(true, buyer);
							salesRepCount = true;
						}else{
							addSalesRep(false, buyer);
						}
					}else if(buyer.buyertype == "internalsupport"){
						if(!internalSupportCount){
							addInternalSupport(true, buyer);
							internalSupportCount = true;
						}else{
							addInternalSupport(false, buyer);
						}
					}
           		} 
           		i++;
       		});
       		
		});
	}else{
		addBuyer(true)
		addSalesRep(true);
		addInternalSupport(true);
	}
}
function populateCustomerReps(){
	if(customerSeq != 0){
		$.getJSON("Actions/CustomerAction.php?call=getCustomerRepAllotmentsByCustomerSeq&customerseq=" + customerSeq , (response)=>{
			$.each(response.data,function(index,value){
				if(value.customerreptype == 'salesrep'){
					addSalesRep(true,value);
				}else if(value.customerreptype == 'internalsupport'){
					addInternalSupport(true,value);
				}
			});
		});
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
		ddhtml = ddhtml.replace("name='category[]'","name=\"buyer_category[]\"");	
   		$("#"+selectDivId).html(ddhtml);
	});
}

function populateSalesRepCategories(selected, selectDivId){
	$.get("Actions/CustomerAction.php?call=getBuyerCategories&selected="+selected, (data) =>{
		var jsonData = $.parseJSON(data);
		var ddhtml = jsonData.categoryDD;
		ddhtml = ddhtml.replace("name='category[]'","name=\"salesRep_category[]\"");
		$("#"+selectDivId).html(ddhtml);
		$("#"+selectDivId+" select").attr('disabled','true');
	});
}

function populateSalesRepResponsibilities(selected, selectDivId){
	$.get("Actions/CustomerAction.php?call=getSellerResponsibilitiesType&selected="+selected, (data)=>{
		var jsonData = $.parseJSON(data);
		var ddhtml = jsonData.responsibilityDD;
		ddhtml = ddhtml.replace("name='responsibility[]'","name=\"salesRep_responsibility[]\"");
		$("#"+selectDivId).html(ddhtml);
	});
}

function populateInternalSupportRepCategories(selected, selectDivId){
	$.get("Actions/CustomerAction.php?call=getBuyerCategories&selected="+selected, (data) => {
		var jsonData = $.parseJSON(data);
		var ddhtml = jsonData.categoryDD;
		ddhtml = ddhtml.replace("name='category[]'","name=\"internalSupport_category[]\"");
		$("#"+selectDivId).html(ddhtml);
	});
}

function deleteBuyer(btn){
	$(btn).closest('.buyerDiv').remove();
// 	if(index > 0){
// 		index--;
// 	}
}

function deleteSalesRep(btn){
	$(btn).closest('.salesRepDiv').remove();
}

function deleteInternalSupport(btn){
	$(btn).closest('.internalSupportDiv').remove();
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
function showNotes(id){
	// Set the TextArea
	$(`#NotesModalText`).val($(`#NotesText${id}`).val());
	// Set The Label
	html = `Enter Notes For ` + $(`#firstName${id}`).val() + ` ` + $(`#lastName${id}`).val();
	$(`#NotesModalLabel`).html(html);
	// set id
	$("#NotesId").val(id);
	// Open the modal
	$(`#NotesModal`).modal("show");
}
function setNote(){
	// get id
	id = $("#NotesId").val();
	// Set hidden Value from text area
	$(`#NotesText${id}`).val($(`#NotesModalText`).val());
	// Close Modal
	$(`#NotesModal`).modal("hide");
}
function showInternalSupportFields(){
	var businessTypeSelectedValue = $("#businesstype :selected").val();
	if(businessTypeSelectedValue == 'ecomm'){
		$("#internalSupportMainDiv").slideDown();
		$("#internalSupportMainDiv").show();
	}else{
		$("#internalSupportMainDiv").slideUp();
		$("#internalSupportMainDiv input,#internalSupportMainDiv select").val("");
		$("#internalSupportMainDiv").hide();
	}
}
</script>