<?include("SessionCheck.php");
require_once('IConstants.inc');?>
<!DOCTYPE html>
<html>
<?php
    $shippinglogseq = "";
    if(isset($_REQUEST["seq"])){
        $shippinglogseq = $_REQUEST["seq"];
    }
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Graphic Log</title>
    <?include "ScriptsInclude.php"?>
    <script src="scripts/shippinglog.vue"></script>
    <style>
        .col-form-label {
            font-weight: 400 !important;
            line-height: 1.2 !important;
        }
        .invisible_block{
            display:none;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <?php include("adminmenuInclude.php") ?>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                                <h5 class="pageTitle">Create/Edit Shipping Log</h5>
                            </nav>
                        </div>
                        <div class="ibox-content" id="ibox-content">
                            <form id="createShippingLogForm" action="Actions/ShippinglogAction.php" method="post">
                                <input type="hidden" name="call" value="saveShippinglog">
                                <input type="hidden" name="seq" v-model="seq">
                                <div class="bg-white1 p-xs outterDiv" style="position: relative;" id="usadiv">
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label bg-formLabelYellow">Order Issue Date :</label>
                                        <div class="col-lg-4">
                                            <div class="input-group date">
                                                <input type="text" name="orderissuedate" id="orderIssueDate" class="form-control  currentdatepicker" v-model="orderIssueDate">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                        <label class="col-lg-2 col-form-label bg-formLabelYellow">Entered By :</label>
                                        <div class="col-lg-4">
                                            <input tabindex="" type="text" maxLength="25" value="" name="enteredby" class="form-control" v-model="enteredBy">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label bg-formLabelYellow">Customer Name :</label>
                                        <div class="col-lg-4">
                                            <input tabindex="" type="text" maxLength="250" value="" name="customername" id="customerName" class="form-control" v-model="customerName">
                                        </div>
                                        <label class="col-lg-2 col-form-label bg-formLabelYellow">Business :</label>
                                        <div class="col-lg-4">
                                            <select v-model="business_chosen" class="form-control" v-on:change="business_change" name="business">
                                                <option v-for="option in business" :value="option.toLowerCase()">{{option}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label bg-formLabelYellow">Batch Number :</label>
                                        <div class="col-lg-4">
                                            <input tabindex="" type="text" maxLength="250" value="" name="batchno" id="batchNumber" class="form-control" v-model="batchNumber">
                                        </div>
                                        <label class="col-lg-2 col-form-label bg-formLabelYellow">IS EDI :</label>
                                        <div class="col-lg-4">
                                            <div class="i-checks isEdi">
                                                <input type="checkbox" name="isedi" v-model="isEdi">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php include('adminCreateShippingLogDomestic.php'); ?>
                                <?php include('adminCreateShippingLogInternetMaster.php'); ?>
                                <button type="button" class="btn btn-primary" onclick="saveShippinglog()">Save Shippinglog</button>
                                <button type="button" class="btn btn-primary" onclick="goback()">Go Back</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    seq = <?php echo $shippinglogseq!=""?$shippinglogseq:"\"\"";?>; 
    function saveShippinglog(){
        $.ajax({
            type: "POST",
            url:"Actions/ShippinglogAction.php",
            data: $("#createShippingLogForm").serialize(),
            dataType: "json",
            success:()=>{
                location.href = ("adminManageShippinglog.php");
            }
        });
    }
    function goback(){
        location.href = ("adminManageShippinglog.php");
    }
</script>