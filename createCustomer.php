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
                        	<div class="row i-checks">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Chain Store </label>
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
	                         <div class="row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Customer ID</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" <?php echo $customerIdDisabled?> required  maxLength="250" value="<?php echo $customer->getCustomerId()?>" name="customerid" id="customerid" class="form-control">
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Business Type</label>
	                        	<div class="col-lg-4">
 	                        		<?php 
    									$select = DropDownUtils::getBusinessTypes("businesstype", null, $customer->getBusinessType(),false,true);
    			                        echo $select;
	                             	?>
	                            </div>
	                       </div>
                        
	                         <div class="form-group row storeDetailsDiv" style="display:<?php echo $storeDisplay?>">
	                         	<div class="form-group row no-margins" style="margin-bottom:15px !important">
		                         	<label class="col-lg-2 col-form-label bg-formLabel">Customer Name</label>
		                        	<div class="col-lg-10">
		                        		<select name="fullNameSelect" <?php echo $customerSelectDisabled?> onchange="setCustomerId(this.value)" id="customerSelect" class="fullNameSelect form-control">
		                        			<?php if($seq > 0){
		                        			    echo ('<option selected value="'.$seq.'">'.$customer->getFullName().'</option>');
		                        			}?>
		                        		</select>
		                            </div>
	                            </div>
	                            <div class="form-group row no-margins">
			                       	<label class="col-lg-2 col-form-label bg-formLabel">Store Name</label>
			                        <div class="col-lg-4">
			                        	<input type="text"  maxLength="250" value="<?php echo $customer->getStoreName()?>" name="storename" class="form-control">
			                        </div>
			                        <label class="col-lg-2 col-form-label bg-formLabel">Store ID</label>
			                        <div class="col-lg-4">
			                        	<input type="text"  maxLength="250" value="<?php echo $customer->getStoreId()?>" name="storeid" class="form-control">
			                        </div>
			                    </div>
	                       	</div>
                        	<div class="form-group row customerNameTextDiv" style="display:<?php echo $customerTextDisplay?>">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Customer Name</label>
	                        	<div class="col-lg-10">
	                        		<input type="text" required maxLength="250" value="<?php echo $customer->getFullName()?>" id="fullname" name="fullname" class="form-control">
	                            </div>
	                        </div>
	                        
	                        <div class="form-group row">
	                        	<label class="col-lg-2 col-form-label bg-formLabel">Customer Type</label>
	                        	<div class="col-lg-4">
 	                        		<?php 
	                        		    $select = DropDownUtils::getBusinessCategoryTypes("customertype", null, $customer->getCustomerType(),false,true);
    			                        echo $select;
	                             	?>
	                            </div>
		                        
	                        </div>
	                        <div class="form-group row">
	                        	<label class="col-lg-2 col-form-label bg-formLabel">Inside Account Manager Email</label>
		                        <div class="col-lg-4">
		                        	<input type="email"  maxLength="250" value="<?php echo $customer->getInsideAccountManager()?>" name="insideaccountmanager" class="form-control">
		                        </div>
		                        <label class="col-lg-2 col-form-label bg-formLabel">Chain Store Sales Admin Email</label>
		                        <div class="col-lg-4">
		                        	<input type="email"  maxLength="250" value="<?php echo $customer->getChainStoreSalesAdmin()?>" name="chainstoresalesadmin" class="form-control">
		                        </div>
	                        </div>
	                        <div class="form-group row">
	                        	<label class="col-lg-2 col-form-label bg-formLabel">Sales Admin Lead Email</label>
		                        <div class="col-lg-4">
		                        	<input type="email"  maxLength="250" value="<?php echo $customer->getSalesAdminLead()?>" name="salesadminlead" class="form-control">
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
	                       	<label class="col-lg-12 m-xxs txt-primary" >Internal Support</label>
	                       	</div>
	                       	<div class="form-group row m-b-xs">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">First Name</label>
	                        	<label class="col-lg-2 col-form-label bg-formLabel">Last Name</label>
	                        	<label class="col-lg-2 col-form-label bg-formLabel">Email</label>
	                        	<label class="col-lg-1 col-form-label bg-formLabel">Phone</label>
	                        	<label class="col-lg-1 col-form-label bg-formLabel">EXT.</label>
	                        	<label class="col-lg-1 col-form-label bg-formLabel">CellPhone</label>
								<label class="col-lg-1 col-form-label bg-formLabel">Skype Id</label>
	                        	<label class="col-lg-2 col-form-label bg-formLabel">Category</label>
	                       	</div>
	                       	<div id="internalSupport" class="internalSupport">
	                       	</div>
	                        <div class="col-lg-12 pull-right ">
	                       		<div class="col-lg-1 pull-right addButtonDiv">
	                        		<button class="btn btn-xs btn-success" id="addInternalSupportBtn" onclick="addInternalSupport()" type="button">
	                        		<i class="fa fa-plus"></i> Internal Support</button>
	                        	</div>
	                        </div>
							
							<div class="form-group row m-b-xs">
	                       		<label class="col-lg-12 m-xxs txt-primary" >Sales Rep</label>
	                       	</div>
	                       	<div class="form-group row m-b-xs">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">First Name</label>
	                        	<label class="col-lg-2 col-form-label bg-formLabel">Last Name</label>
	                        	<label class="col-lg-2 col-form-label bg-formLabel">Email</label>
	                        	<label class="col-lg-1 col-form-label bg-formLabel">Phone</label>
	                        	<label class="col-lg-1 col-form-label bg-formLabel">EXT.</label>
	                        	<label class="col-lg-2 col-form-label bg-formLabel">CellPhone</label>
	                        	<label class="col-lg-2 col-form-label bg-formLabel">Responsibility</label>
	                       	</div>
	                       	<div id="salesRep" class="salesRep">
	                       	</div>
	                        <div class="col-lg-12 pull-right ">
	                       		<div class="col-lg-1 pull-right addButtonDiv">
	                        		<button class="btn btn-xs btn-success" id="addSalesRepBtn" onclick="addSalesRep()" type="button">
	                        		<i class="fa fa-plus"></i> Sales Rep</button>
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
	                        	<label class="col-lg-2 col-form-label bg-formLabel">CellPhone</label>
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
							
							
							

	                        <div class="form-group row">
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
	//$(".fullNameSelect").chosen({ width: '100%' });
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
	
});
function showHideStoreFields(){
	var flag  = $(".isstore").is(':checked');
	if(flag){
		$("#customerid").attr("readonly","readonly");
		$(".storeDetailsDiv").slideDown();
		$(".customerNameTextDiv").hide();
		$("#fullname").attr("disabled","disabled");
		$("#customerSelect").removeAttr("disabled");
	}else{
		$("#customerid").removeAttr("readonly");
		$(".storeDetailsDiv").slideUp();
		$(".customerNameTextDiv").show();
		$("#customerSelect").attr("disabled","disabled");
		$("#fullname").removeAttr("disabled");	
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
	var category  = "";
	var ext       = "";
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
		category = buyer.category;
		id = buyer.seq
	}
	var ddId =  'categorySelectDiv'+id;
	var html = '<div class="buyerDiv">';
   		html += '<div class="form-group row m-b-xs">';
		html += `<div class="col-lg-2 p-xxs no-margins">
					<input type="text" required maxLength="250" value="${firstName}" id="firstName${id}" name="buyer_firstname[]" class="form-control" placeholder="firstname">
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
		html += '<div class="col-lg-2 p-xxs no-margins">';
		html += '<input type="text"  maxLength="250" value="'+cellPhone+'" name="buyer_cellphone[]" class="form-control" placeholder="cellphone">';
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
		
		populateBuyerCategories(category,ddId);
}

function addSalesRep(isDefaultRow,salesRep){
	var firstName     = "";
	var lastName      = "";
	var phone         = "";
	var emailid       = "";
	var cellPhone     = "";
	var note          = "";
	var responsiblity = "";
	var ext           = "";
	index++;
	var id = index;
	if(typeof salesRep !== "undefined"){
		if(salesRep.firstname != null){
			firstName = salesRep.firstname;
		}
		if(salesRep.lastname != null){
			lastName = salesRep.lastname;
		}
		if(salesRep.email != null){
			emailid = salesRep.email;
		}
		if(salesRep.officephone != null){
			phone = salesRep.officephone;
		}
		if(salesRep.officephoneext != null){
			ext = salesRep.officephoneext;
		}
		if(salesRep.cellphone != null){
			cellPhone = salesRep.cellphone;
		}
		if(salesRep.notes != null){
			note = salesRep.notes;
		}
		if(salesRep.responsibility != null){
			console.log(salesRep.responsibility);
			responsiblity = salesRep.responsibility;
		}
		id = salesRep.seq;
	}
	var ddId = 'responsibilitySelectDiv'+id;
	var html = '<div class="salesRepDiv">';
   		html += '<div class="form-group row m-b-xs">';
		html += `<div class="col-lg-2 p-xxs no-margins">
					<input type="text" id="firstName${id}" required maxLength="250" value="${firstName}" name="salesRep_firstname[]" class="form-control" placeholder="firstname">
				</div>
				<div class="col-lg-2 p-xxs no-margins">
					<input type="text" id="lastName${id}"  maxLength="250" value="${lastName}" name="salesRep_lastname[]" class="form-control" placeholder="lastname">
				</div>`;
		html += '<div class="col-lg-2 p-xxs no-margins">';
		html += '<input type="text"  maxLength="250" value="'+emailid+'" name="salesRep_emailid[]" class="form-control" placeholder="emailid">';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input type="text"  maxLength="250" value="'+phone+'" name="salesRep_phone[]" class="form-control" placeholder="phone">';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input type="text"  maxLength="250" value="'+ext+'" name="salesRep_phoneext[]" class="form-control" placeholder="ext.">';
		html += '</div>';
		html += '<div class="col-lg-2 p-xxs no-margins">';
		html += '<input type="text"  maxLength="250" value="'+cellPhone+'" name="salesRep_cellphone[]" class="form-control" placeholder="cellphone">';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<div id="'+ddId+'"><select name="salesRep_responsibility[]" class="form-control">';
		html += '</select></div>';
		html += '</div>';
		
		if (typeof isDefaultRow === "undefined" || isDefaultRow == false) {
			html += '<div class="col-lg-1 pull-right"><div class="row"><div class="col-sm-6">';
			html += `<a onclick="showNotes('${id}')" title="Notes" alt="Notes"><h2><i class="fa fa-clipboard text-primary"></i></h2></a>`;
			html += '</div><div class="col-sm-6">'
			html += '<a onclick="deleteSalesRep(this)" title="Delete" alt="Delete"><h2><i class="fa fa-remove text-danger"></i></h2></a>';
			html += '</div></div></div>';
		}else{
			html += '<div class="col-lg-1 pull-right">';
			html += `<a onclick="showNotes('${id}')" title="Notes" alt="Notes"><h2><i class="fa fa-clipboard text-primary"></i></h2></a>`;
			html += '</div>';
		}
		html += '</div>';
		html += '<!--<div class="form-group row">';
		html += '<div class="col-lg-11 p-xxs">-->';
 		html += `<input type="hidden" id="NotesText${id}" name="salesRep_notes[]" placeholder="notes" class="form-control" value="${note}"></input>`;
		html += '<!--</div>-->';
		html += '<!--<div class="col-lg-12 p-xxs" style="border-bottom: 1px silver dashed;"></div>';
		html += '</div></div>-->';
		$("#salesRep").append(html);
		populateSalesRepResponsibilities(responsiblity,ddId);
		//populateSalesRepCategories(responsibility,ddId);
}

function addInternalSupport(isDefaultRow,internalSupport){
	var firstName     = "";
	var lastName      = "";
	var phone         = "";
	var emailid       = "";
	var cellPhone     = "";
	var note          = "";
	var skypePersonId = "";
	var category      = "";
	var ext           = "";
	index++;
	var id = index;
	if(typeof internalSupport !== "undefined"){
		if(internalSupport.firstname != null){
			firstName = internalSupport.firstname;
		}
		if(internalSupport.lastname != null){
			lastName = internalSupport.lastname;
		}
		if(internalSupport.email != null){
			emailid = internalSupport.email;
		}
		if(internalSupport.officephone != null){
			phone = internalSupport.officephone;
		}
		if(internalSupport.officephoneext != null){
			ext = internalSupport.officephoneext;
		}
		if(internalSupport.cellphone != null){
			cellPhone = internalSupport.cellphone;
		}
		if(internalSupport.notes != null){
			note = internalSupport.notes;
		}
		if(internalSupport.skypeid != null){
			skypePersonId = internalSupport.skypeid;
		}
		category = internalSupport.category;
		id = internalSupport.seq;
	}
	var ddId = 'categoryInternalSupportSelectDiv'+id;
	var html = '<div class="internalSupportDiv">';
   		html += '<div class="form-group row m-b-xs">';
		html += `<div class="col-lg-2 p-xxs no-margins">
					<input type="text" id="firstName${id}" required maxLength="250" value="${firstName}" name="internalSupport_firstname[]" class="form-control" placeholder="firstname">
				</div>
				<div class="col-lg-2 p-xxs no-margins">
					<input type="text" id="lastName${id}" maxLength="250" value="${lastName}" name="internalSupport_lastname[]" class="form-control" placeholder="lastname">
				</div>`;
		html += '<div class="col-lg-2 p-xxs no-margins">';
		html += '<input type="text"  maxLength="250" value="'+emailid+'" name="internalSupport_emailid[]" class="form-control" placeholder="emailid">';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input type="text"  maxLength="250" value="'+phone+'" name="internalSupport_phone[]" class="form-control" placeholder="phone">';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input type="text"  maxLength="250" value="'+ext+'" name="internalSupport_phoneext[]" class="form-control" placeholder="ext.">';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input type="text"  maxLength="250" value="'+cellPhone+'" name="internalSupport_cellphone[]" class="form-control" placeholder="cellphone">';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<input type="text" maxLength="250" value="' + skypePersonId + '" name="internalSupport_skypePersonId[]" class="form-control" placeholder="Skype Person Id">';
		html += '</div>';
		html += '<div class="col-lg-1 p-xxs no-margins">';
		html += '<div id="'+ddId+'"><select name="internalSupport_category[]" class="form-control">';
		html += '</select></div>';
		html += '</div>';
		
		if (typeof isDefaultRow === "undefined" || isDefaultRow == false) {
			html += '<div class="col-lg-1 pull-right"><div class="row"><div class="col-sm-6">';
			html += `<a onclick="showNotes(${id})" title="Notes" alt="Notes"><h2><i class="fa fa-clipboard text-primary"></i></h2></a>`;
			html += '</div><div class="col-sm-6">'
    		html += '<a onclick="deleteInternalSupport(this)" title="Delete" alt="Delete"><h2><i class="fa fa-remove text-danger"></i></h2></a>'
    		html += '</div></div></div>';
		}else{
			html += '<div class="col-lg-1 pull-right">';
			html += `<a onclick="showNotes('${id}')" title="Notes" alt="Notes"><h2><i class="fa fa-clipboard text-primary"></i></h2></a>`;
			html += '</div>';
		}
		
		html += '</div>';
		html += '<!--<div class="form-group row">';
		html += '<div class="col-lg-11 p-xxs">-->';
		html += `<input type="hidden" id="NotesText${id}" name="internalSupport_notes[]" placeholder="notes" class="form-control" value="${note}"></input>`;
		html +='<!--</div>-->';
		html += '<!--<div class="col-lg-12 p-xxs" style="border-bottom: 1px silver dashed;"></div>';
		html += '</div></div>-->';
		$("#internalSupport").append(html);
		populateInternalSupportRepCategories(category,ddId);
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

function populateSalesRep(selected, selectDivId){
	$.get("Actions/CustomerAction.php?call=getBuyerCategories&selected="+selected, (data) =>{
		var jsonData = $.parseJSON(data);
		var ddhtml = jsonData.categoryDD;
		ddhtml = ddhtml.replace("name='category[]'","name=\"salesRep_category[]\"");
		$("#"+selectDivId).html(ddhtml);
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
</script>