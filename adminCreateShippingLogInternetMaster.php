<div v-if="business_chosen == 'internet'" class="bg-white1 p-xs outterDiv" style="position:relative" id="business_domestic">
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelCyan">Order Ship Date :</label>
        <div class="col-lg-4">
            <div class="input-group date">
                <input tabindex="" type="text" maxLength="250" value="" name="ordershipdate" id="orderShipDate2" class="form-control currentdatepicker" v-model="orderShipDate2">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelCyan">Allocation Time :</label>
        <div class="col-lg-4">
            <div class="input-group time">
                <input type="text" name="allocationtime" class="form-control currenttimepicker" id="allocationTime" v-model="allocationTime">
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelCyan">WH# :</label>
        <div class="col-lg-4">
            <input type="text" value="" name="whno" id="whNumber" class="form-control" v-model="whNumber">
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelCyan">Total Number of Pick Tickets for Batch from OMS Report :</label>
        <div class="col-lg-4">
            <input tabindex="" type="number" value="" name="totalnumberofpickticketsforbatchfromomsreport" id="totalNumerOfPickTicketsForBatchFromFromOMSReport" class="form-control" v-model="OMSReport">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelCyan">Total Number of Pick Tickets for RMA's (Type FR/RP) :</label>
        <div class="col-lg-4">
            <input tabindex="" type="number" value="" name="totalnumberofpickticketsforrma" id="totalNumberOfPickTicketsForRMAs" class="form-control" v-model="RMAReport">
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelCyan">Total Number of Pick Tickets for Pallet Orders(LTL Shipment) :</label>
        <div class="col-lg-4">
            <input tabindex="" type="number" value="" name="totalnumberofpickticketsforpalletorders" id="totalNumberOfPickTicketsForPalletOrders" class="form-control" v-model="detailedUsers" v-on:change="$forceUpdate()">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelCyan">Total Number of Parcel Pick Ticket :</label>
        <div class="col-lg-4">
            <input tabindex="" type="text" name="totalnumberofparcelpickticket" id="totalNumberOfParcelPickTicket" class="form-control" disabled :value="Number(OMSReport) - Number(detailedUsers) - Number(RMAReport)">
        </div>
    </div>
</div>
    <?php $i = 1; include("adminCreateShippingLogInternetDetail.php");
    ?>