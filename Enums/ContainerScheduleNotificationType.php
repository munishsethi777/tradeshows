<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class ContainerScheduleNotificationType extends BasicEnum{
    const send_eta_report_weekly = "Send ETA Report (Weekly)";
    const empty_return_date_past_empty_lFD_report_weekly = "Empty Return Date Past Empty LFD Report (Weekly)";
    const pending_schedule_delivery_date_for_today_report_daily = "Pending Schedule Delivery Date for Today Report (Daily)";
    const empty_alpine_notication_pickup_date_daily = "Empty Alpine Notication Pickup Date (Daily)";
    const missing_id_report_daily = "Missing ID Report (Daily)";
    const missing_terminal_appointment_date_daily = "Missing Terminal Appointment Date (Daily)";
    const missing_schedule_delivery_date_daily = "Missing Schedule Delivery Date (Daily)";
    const missing_confirm_delivery_date_daily = "Missing Confirmed Delivery Date (Daily)";
    const missing_received_dates_in_wms_daily = "Missing Received Dates in WMS (Daily)";
    const missing_received_dates_in_oms_daily = "Missing Received Dates in OMS (Daily)";
    const send_alpine_picking_date_change_instant = "Send Alpine Picking Date Change (Instant)";
    const terminal_appointment_date_change_instant = "Terminal Appointment Date Change (Instant)";
    const requested_delivery_date_change_instant = "Requested Delivery Date Change (Instant)";
    const eta_notes_updated_instant = "ETA Notes Updated (Instant)";
    const eta_updated_instant = "ETA Updated (Instant)";
    const empty_return_notes_updated_instant = "Empty Return Notes Updated (Instant)";
    const alpine_pickup_notes_updated_instant = "Alpine Pickup Notes Updated (Instant)";
    const charge_back_weekly = "Charge Back (Weekly)";
    const update_warehouse_from_alpine_instant = "Update Warehouse from Alpine (Instant)";
}