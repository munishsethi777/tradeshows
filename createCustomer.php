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
if(isset($_POST["id"])){
    $seq = $_POST["id"];
    $customer = $customerMgr->findByCustomerSeq($seq);
    if(!empty($customer->getIsStore())){
        $storeChecked = "checked";
        $storeDisplay = "block";
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
.buyers input,.buyers select{
	font-size:12px;
	padding:4px;
	height:25px;
}
.buyers textarea{
	font-size:12px;
	padding:4px;
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
                        	<div class="form-group row i-checks">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Store </label>
	                        	<div class="col-lg-4">
	                        		<input type="checkbox" name="isstore" <?php echo $storeChecked?> class="isstore"/>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Priority </label>
	                        	<div class="col-lg-4">
	                        		<?php 
    										$select = DropDownUtils::getPriorityTypes("priority", null, $customer->getPriority(),false);
    			                            echo $select;
	                             	?>
	                        	</div>
	                         </div>
	                         <div class="form-group row storeDetailsDiv" style="display:<?php echo $storeDisplay?>">
	                         	<div class="form-group row no-margins" style="margin-bottom:15px !important">
		                         	<label class="col-lg-2 col-form-label bg-formLabel">Customer Name</label>
		                        	<div class="col-lg-10">
		                        		<select name="fullNameSelect" onchange="setCustomerId(this.value)" id="customerSelect" class="fullNameSelect form-control">
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
                        	 <div class="form-group row customerNameTextDiv">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Customer Name</label>
	                        	<div class="col-lg-10">
	                        		<input type="text" required maxLength="250" value="<?php echo $customer->getFullName()?>" id="fullname" name="fullname" class="form-control">
	                            </div>
	                        </div>
	                        
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Customer ID</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" required  maxLength="250" value="<?php echo $customer->getCustomerId()?>" name="customerid" id="customerid" class="form-control">
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">BusinessType</label>
	                        	<div class="col-lg-4">
<!-- 	                        		<select name="businesstype" class="form-control"> -->
<!-- 	                        			<option>Direct</option> -->
<!-- 	                        			<option>Domesitc</option> -->
<!-- 	                        			<option>DotCom</option> -->
<!-- 	                        		</select> -->
										<?php 
    										$select = DropDownUtils::getBusinessTypes("businesstype", null, $customer->getBusinessType(),false);
    			                            echo $select;
	                             		?>
	                            </div>
	                       </div>
	                       <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Salesperson Name</label>
	                        	<div class="col-lg-4">
	                            	<input type="text"  maxLength="250" value="<?php echo $customer->getSalesPersonName()?>" name="salespersonname" class="form-control">
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Salesperson ID</label>
	                        	<div class="col-lg-4">
	                        		<input type="text"  maxLength="250" value="<?php echo $customer->getSalesPersonId()?>" name="salespersonid" class="form-control">
	                            </div>
	                       </div>
	                       
	                       <div class="form-group row m-b-xs">
	                       	<label class="col-lg-12 m-xxs txt-primary" >Add Buyers to the Customer</label>
	                       </div>
	                       <div class="form-group row m-b-xs">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">First Name</label>
	                        	<label class="col-lg-2 col-form-label bg-formLabel">Last Name</label>
	                        	<label class="col-lg-2 col-form-label bg-formLabel">Email</label>
	                        	<label class="col-lg-2 col-form-label bg-formLabel">Phone</label>
	                        	<label class="col-lg-2 col-form-label bg-formLabel">CellPhone</label>
	                        	<label class="col-lg-2 col-form-label bg-formLabel">Category</label>
	                       </div>
	                       <div id="buyers" class="buyers">
	                       </div>
	                        <div class="col-lg-12 pull-right">
	                       		<div class="col-lg-1 pull-right">
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
		$(".storeDetailsDiv").slideDown();
		$(".customerNameTextDiv").hide();
		$("#fullname").attr("disabled","disabled");
		$("#customerSelect").removeAttr("disabled");
	}else{
		$(".storeDetailsDiv").slideUp();
		$(".customerNameTextDiv").show();
		$("#customerSelect").attr("disabled","disabled");
		$("#fullname").removeAttr("disabled");	
	}
}
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