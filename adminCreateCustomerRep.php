<?include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/CustomerRep.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerRepMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DropdownUtil.php");

$customerRepMgr = CustomerRepMgr::getInstance();
$customerRep = new CustomerRep();

$seq="";
if(isset($_POST["id"])){
    $seq = $_POST["id"];
    $customerRep = $customerRepMgr->findBySeq($seq);
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
        .panel-body {
            padding: 15px !important;
        }

        .col-form-label {
            font-weight: 400 !important;
        }

        .areaTitle {
            margin: 0px 0px 0px 15px !important;
            color: #1ab394;
            font-size: 15px;
        }

        .bg-white {
            background-color: rgb(252, 252, 252);
        }

        .bg-muted {}

        .outterDiv {
            border-bottom: 1px silver dashed;
            padding: 20px 10px;
        }

        .col-form-label {
            line-height: 1;
        }

        .buyers input,
        .buyers select,
        .internalSupport input,
        .internalSupport select,
        .salesRep input,
        .salesRep select {
            font-size: 12px;
            padding: 4px;
            height: 25px;
        }

        .buyers textarea {
            font-size: 12px;
            padding: 4px;
        }

        #category {
            margin-bottom: 0px !important;
        }

        .fa {
            font-size: 17px;
        }

        .addButtonDiv {
            display: flex;
            justify-content: flex-end;
        }
    </style>
    <script></script>
</head>

<body>
    <div id="wrapper">
        <?php include("adminmenuInclude.php") ?>
        <div id="page-wrapper" class="gray-bg">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                                <h5 class="pageTitle">Create/Edit Customer Rep</h5>
                            </nav>
                        </div>
                        <div class="ibox-content">
                            <?include "progress.php"?>
                            <form id="createCustomerRepForm" method="post" action="Actions/CustomerRepAction.php" class="m-t-sm">
                                <input type="hidden" id="call" name="call" value="saveCustomerRep" />
                                <input type="hidden" id="seq" name="seq" value="<?php echo $customerRep->getSeq() ?>" />
                                <div class="row form-group">
                                    <label class="col-lg-2 col-form-label bg-formLabel">Full Name</label>
                                    <div class="col-lg-4">
                                        <input type="text" required maxLength="250" value="<?php echo $customerRep->getFullName() ?>" name="fullname" id="fullname" class="form-control" placeholder="Enter fullname" />
                                    </div>
                                    <label class="col-lg-2 col-form-label bg-formLabel">Email</label>
                                    <div class="col-lg-4">
                                        <input type="text" required maxLength="250" value="<?php echo $customerRep->getEmail() ?>" name="email" id="email" class="form-control" placeholder="Enter email"/>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-lg-2 col-form-label bg-formLabel">Ext</label>
                                    <div class="col-lg-4">
                                        <input type="text" required maxLength="250" value="<?php echo $customerRep->getExt() ?>" name="ext" id="ext" class="form-control" placeholder="Enter ext" />
                                    </div>
                                    <label class="col-lg-2 col-form-label bg-formLabel">Cellphone</label>
                                    <div class="col-lg-4">
                                        <input type="text" required maxLength="250" value="<?php echo $customerRep->getFullName() ?>" name="cellphone" id="cellphone" class="form-control" placeholder="Enter cellphone"/>
                                    </div>
                                    
                                </div>
                                <div class="row form-group">
                                    <label class="col-lg-2 col-form-label bg-formLabel">Position</label>
                                    <div class="col-lg-4">
                                    <?php 
                                            $select = DropDownUtils::getCustomerPostions("position","",$customerRep->getPosition(),false,true);
                                            echo $select;
                                        ?>
                                    </div>
                                    <label class="col-lg-2 col-form-label bg-formLabel">Category</label>
                                    <div class="col-lg-4">
                                        <?php 
                                            $select = DropDownUtils::getBuyerCategories("category","",$customerRep->getCategory(),false,true);
                                            echo $select;
                                        ?>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-lg-2 col-form-label bg-formLabel">SkypeId</label>
                                    <div class="col-lg-4">
                                        <input type="text" required maxLength="250" value="<?php echo $customerRep->getSkypeId() ?>" name="skypeid" id="skypeid" class="form-control" placeholder="Enter skypeid">
                                    </div>
                                    <label class="col-lg-2 col-form-label bg-formLabel">Customer Rep Type</label>
                                    <div class="col-lg-4">
                                        <?php 
                                            $select = DropDownUtils::getCustomerRepTypesForDD("customerreptype","",$customerRep->getCustomerRepType(),false,true);
                                            echo $select;
                                        ?>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-lg-2 col-form-label bg-formLabel">Rep Number</label>
                                    <div class="col-lg-4">
                                        <input type="text" required maxLength="250" value="<?php echo $customerRep->getRepNumber() ?>" name="repnumber" id="repnumber" class="form-control" placeholder="Enter Rep Number">
                                    </div>
                                    <label class="col-lg-2 col-form-label bg-formLabel">OMS Cust Id</label>
                                    <div class="col-lg-4">
                                        <input type="text" required maxLength="250" value="<?php echo $customerRep->getOmsCustId() ?>" name="omscustid" id="omscustid" class="form-control" placeholder="Enter OMS Cust Id">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-lg-2 col-form-label bg-formLabel">Territory</label>
                                    <div class="col-lg-4">
                                        <input type="text" required maxLength="250" value="<?php echo $customerRep->getTerritory() ?>" name="territory" id="territory" class="form-control" placeholder="Enter Territory">
                                    </div>
                                    <label class="col-lg-2 col-form-label bg-formLabel">Company name</label>
                                    <div class="col-lg-4">
                                        <input type="text" required maxLength="250" value="<?php echo $customerRep->getCompanyName() ?>" name="companyname" id="companyname" class="form-control" placeholder="Enter Company Name">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-lg-2 col-form-label bg-formLabel">Ship to address</label>
                                    <div class="col-lg-4">
                                        <input type="text" required maxLength="250" value="<?php echo $customerRep->getShipToAddress() ?>" name="shiptoaddress" id="shiptoaddress" class="form-control" placeholder="Enter Ship To Address">
                                    </div>
                                    <label class="col-lg-2 col-form-label bg-formLabel">City</label>
                                    <div class="col-lg-4">
                                        <input type="text" required maxLength="250" value="<?php echo $customerRep->getCity() ?>" name="city" id="city" class="form-control" placeholder="Enter City">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-lg-2 col-form-label bg-formLabel">State</label>
                                    <div class="col-lg-4">
                                        <input type="text" required maxLength="250" value="<?php echo $customerRep->getState() ?>" name="state" id="state" class="form-control" placeholder="Enter State">
                                    </div>
                                    <label class="col-lg-2 col-form-label bg-formLabel">Zip</label>
                                    <div class="col-lg-4">
                                        <input type="text" required maxLength="250" value="<?php echo $customerRep->getZip() ?>" name="zip" id="zip" class="form-control" placeholder="Enter Zip">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-lg-2 col-form-label bg-formLabel">Commission</label>
                                    <div class="col-lg-4">
                                        <input type="text" required maxLength="250" value="<?php echo $customerRep->getCommission() ?>" name="commission" id="commission" class="form-control" placeholder="Enter Commission">
                                    </div>
                                    <label class="col-lg-2 col-form-label bg-formLabel">Is Receives Monthly Sales Report</label>
                                    <div class="col-lg-4">
                                        <?php
                                            $select = DropDownUtils::getBooleanDropDown("isreceivesmonthlysalesreport","",$customerRep->getIsReceivesMonthlySalesReport(),false);
                                            echo $select;
                                        ?>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-lg-2 col-form-label bg-formLabel">Pricing Tier</label>
                                    <div class="col-lg-4">
                                        <input type="text" required maxLength="250" value="<?php echo $customerRep->getPricingTier() ?>" name="pricingtier" id="pricingtier" class="form-control" placeholder="Enter Pricing Tier">
                                    </div>
                                    <label class="col-lg-2 col-form-label bg-formLabel">Senior Rep Handling Account</label>
                                    <div class="col-lg-4">
                                        <input type="text" required maxLength="250" value="<?php echo $customerRep->getSeniorRepHandlingAccount() ?>" name="seniorrephandlingaccount" id="seniorrephandlingaccount" class="form-control" placeholder="Enter Senior Rep Handling Account">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-lg-2 col-form-label bg-formLabel">Sales Admin Assigned</label>
                                    <div class="col-lg-4">
                                        <input type="text" required maxLength="250" value="<?php echo $customerRep->getSalesAdminAssigned() ?>" name="salesadminassigned" id="salesadminassigned" class="form-control" placeholder="Enter Sales Admin Assigned">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8">
                                    </div>
                                    <div class="col-lg-2">
                                        <button class="btn btn-primary" onclick="saveCustomerRep()" type="button" style="width:85%">
                                            Save
                                        </button>
                                    </div>
                                    <div class="col-lg-2">
                                        <a class="btn btn-default" href="#" type="button" style="width:85%">
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
    function saveCustomerRep(){
	    formName = "#createCustomerRepForm";
        if($(formName)[0].checkValidity()) {
            showHideProgress()
            $(formName).ajaxSubmit(function( data ){
            showHideProgress();
            var flag = showResponseToastr(data,null,null,"ibox");
            if(flag){
                $(formName).find("input[type=text], select").val("");
            }
            $('html, body').animate({scrollTop:$(document).height()}, 'slow');
            })	
        }else{
            $(formName)[0].reportValidity();
        }
    }
</script>