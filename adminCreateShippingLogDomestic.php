<div v-if="business_chosen == 'Domestic'" class="bg-white1 p-xs outterDiv" style="position:relative" id="business_domestic">
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Order No/ Pick Ticket :</label>
        <div class="col-lg-4">
            <input tabindex="" type="text" maxLength="250" value="" name="orderNumber" id="orderNumber" class="form-control">
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Allocated Full :</label>
        <div class="col-lg-4">
            <input type="checkbox" name="isAllocatedFull" class="form-control i-checks" id="isAllocatedFull">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Pk No# :</label>
        <div class="col-lg-4">
            <input tabindex="" type="text" maxLength="250" value="" name="pkNumber" id="pkNumber" class="form-control">
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Total So Qty :</label>
        <div class="col-lg-4">
            <input tabindex="" type="text" maxLength="250" value="" name="totalSoQty" id="totalSoQty" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelMauve">PO # :</label>
        <div class="col-lg-4">
            <input tabindex="" type="text" maxLength="250" value="" name="poNumber" id="poNumber" class="form-control">
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Total Cases :</label>
        <div class="col-lg-4">
            <input tabindex="" type="text" maxLength="250" value="" name="totalCases" id="totalCases" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Order Ship Date :</label>
        <div class="col-lg-4">
            <div class="input-group date">
                <input tabindex="" type="text" maxLength="250" value="" name="orderShipDate" id="orderShipDate" class="form-control currentdatepicker">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Total Actual Open Order :</label>
        <div class="col-lg-4">
            <input tabindex="" type="text" maxLength="250" value="" name="totalActualOpenOrder" id="totalActualOpenOrder" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Order Must Arrive By :</label>
        <div class="col-lg-4">
            <div class="input-group date">
                <input tabindex="" type="text" maxLength="250" value="" name="orderMustArriveBy" id="orderMustArriveBy" class="form-control currentdatepicker">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Total Actual Open Order :</label>
        <div class="col-lg-4">
            <input tabindex="" type="text" maxLength="250" value="" name="totalActualOpenOrder" id="totalActualOpenOrder" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Cancel Date:</label>
        <div class="col-lg-4">
            <div class="input-group date">
                <input tabindex="" tabindex="" type="text" maxLength="250" value="" name="cancelDate" id="cancelDate" class="form-control currentdatepicker">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Ship Service Level :</label>
        <div class="col-lg-4">
            <select class="form-control" v-model="ship_service_level_chosen" name="shipServiceLevel" id="shipServiceLevel">
                <option v-for="option in ship_service_level" :value="option">{{option}}</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-6">
            <div class="panel panel-mauve">
                <div class="panel-heading">CS Notes:</div>
                <div class="panel-body">
                    <textarea name="csNotes" id="csNotes" class="form-control"></textarea>
                    <div class="row">
                        <ul class="list-group"></ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-beige">
                <div class="panel-heading">Warehouse Notes:</div>
                <div class="panel-body">
                    <textarea name="warehouseNotes" id="warehouseNotes" class="form-control"></textarea>
                    <div class="row">
                        <ul class="list-group"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelBeige">Logistic Name :</label>
        <div class="col-lg-4">
            <input type="text" name="logisticName" id="logisticName" class="form-control">
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelBeige">Status of Order :</label>
        <div class="col-lg-4">
            <select name="statusOfOrder" id="statusOfOrder" class="form-control" v-model="status_of_order_chosen">
                <option v-for="option in status_of_order" :value="option">{{option}}</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelBeige">Pick Up Type :</label>
        <div class="col-lg-4">
            <select name="pickUpType" id="pickUpType" class="form-control" v-model="pick_up_type_chosen">
                <option v-for="option in pick_up_type" :value="option">{{option}}</option>
            </select>
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelBeige">Carrier :</label>
        <div class="col-lg-4">
            <input type="text" name="carrier" id="carrier" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelBeige">Pick Up Reference :</label>
        <div class="col-lg-4">
            <input type="text" name="pickUpReference" id="pickUpReference" class="form-control">
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelBeige">Confirm Pickup Date :</label>
        <div class="col-lg-4">
            <div class="input-group date">
                <input type="text" name="confirmPickupDate" id="confirmPickupDate" class="form-control currentdatepicker">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelBeige">Confirm Pickup Time :</label>
        <div class="col-lg-4">
            <div class="input-group time">
                <input type="text" name="confirmPickupTime" id="confirmPickupTime" class="form-control currenttimepicker">
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
            </div>
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelBeige">Number of Pallets :</label>
        <div class="col-lg-4">
            <input type="text" name="numberOfPallets" id="numberOfPallets" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <div class="panel panel-beige">
            <div class="panel-heading">Logistic Team Internal Notes:</div>
            <div class="panel-body">
                <textarea name="logisticTeamInternalNotes" id="logisticTeamInternalNotes" class="form-control"></textarea>
                <div class="row">
                    <ul class="list-group" style="padding: 10px 10px 0px 10px"></ul>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelBeige">Date Logistical Handed PT to ALma :</label>
        <div class="col-lg-4">
            <div class="input-group date">
                <input type="text" name="dateLogisticalHandedPtToAlma" id="numberOfPallets" class="form-control currentdatepicker">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelBeige">"Invoiced</label>
        <div class="col-lg-4">
            <input type="checkbox" class="form-control i-checks" name="isInvoiced" id="isInvoiced">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelRustic">Pick Date :</label>
        <div class="col-lg-4">
            <div class="input-group date">
                <input type="text" id="pickDate" name="pickDate" class="form-control currentdatepicker">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelRustic">Frieght Location in Warehouse</label>
        <div class="col-lg-4">
            <input type="text" name="frieghtLocationInWarehouse" id="frieghtLocationInWarehouse" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelRustic">Pro #:</label>
        <div class="col-lg-4">
            <input type="text" id="proNumber" name="proNumber" class="form-control">
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelRustic">Date Frieght Picked up:</label>
        <div class="col-lg-4">
            <div class="input-group date">
                <input type="text" name="dateFrieghtPickedup" id="datefrieghtPickedup" class="form-control currentdatepicker">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="panel panel-rustic">
            <div class="panel-heading">Notes to Logistic Team from Warehouse:</div>
            <div class="panel-body">
                <textarea name="notesToLogisticTeamFromWarehouse" id="notesToLogisticTeamFromWarehouse" class="form-control"></textarea>
                <div class="row">
                    <ul class="list-group" style="padding: 10px 10px 0px 10px"></ul>
                </div>
            </div>
        </div>
    </div>
</div>