<?php
class StringConstants{
	const UPCOMING_INSPECTION_SCHEDULE = "ALPINE BI | Upcoming Inspection Schedules";
	const UPCOMING_INSPECTIONS = "ALPINE BI | Upcoming Inspections";
	const UPCOMING_INSPECTION_APPOITMENT = "ALPINE BI | Upcoming Inspection Appointments";
	const MISSING_INSPECTION_APPOINTMENT = "ALPINE BI | Missing Inspection Appointments";
	const PENDING_QC_APPROVALS = "ALPINE BI | Pending QC Approvals";
	const INCOMPLETED_SCHEDULES = "ALPINE BI | Late Inspection Report";
	const QC_PLANNER = "ALPINE BI | QC Planner";
	const APPROVAL_RESPONSE_NOTIFICATION = "ALPINE BI | PO Approval Response Notification";
	const CONTAINER_SCHEDULE_DATES_CHANGE_NOTIFICATION = "ALPINE BI | Container Schedule Dates Change Notification";
	const CONTAINER_SCHEDULE_CHANGE_TERMINAL_APPOINTMENT_DATE = "ALPINE BI | Container Schedule Change Terminal Appointment Date";
	
	//Containder Schedule Report
	const ETA_REPORT = "ALPINE BI Containers | ETA Report";
	const ETA_REPORT_NAME = "ETA Report";
	const EMPTY_RETURN = "ALPINE BI Containers | Empty Return Date past Empty LFD Report";
	const EMPTY_RETURN_REPORT_NAME = "Empty Return Date past Empty LFD Report";
	const DAILY_SCHEDULE_REPORT = "ALPINE BI Containers | Daily Schedule Report";
	const DAILY_SCHEDULE_REPORT_NAME = "Daily Schedule Report";
	const MISSING_ALPINE_NOTIFICATION_PICKUP_DATE = "ALPINE BI Containers | Missing Alpine Notification Pickup dates Report";
	const MISSING_ALPINE_NOTIFICATION_PICKUP_DATE_REPORT_NAME = "Missing Alpine Notification Pickup dates Report";
	
	const MISSING_IDS = "ALPINE BI Containers | Missing IDs Report";
	const MISSING_IDS_REPORT_NAME = "Missing IDs Report";
	const MISSING_TERMINAL_APPT_DATE = "ALPINE BI Containers | Missing Terminal Appointment Dates Report";
	const MISSING_TERMINAL_APPT_DATE_REPORT_NAME = "Missing Terminal Appointment Dates Report";
	const MISSING_SCHEDULE_DELIVERY_DATE = "ALPINE BI Containers | Missing Scheduled Delivery Dates Report";
	const MISSING_SCHEDULE_DELIVERY_DATE_REPORT_NAME = "Missing Scheduled Delivery Dates Report";
	const MISSING_CONFIRM_DELIVERY_DATE = "ALPINE BI Containers | Missing Confirmed Delivery Dates Report";
	const MISSING_CONFIRM_DELIVERY_DATE_REPORT_NAME = "Missing Confirmed Delivery Dates Report";
	const EMPTY_WMS_DATES = "ALPINE BI Containers | Missing Received Dates in WMS Report";
	const EMPTY_WMS_DATES_REPORT_NAME = "Missing Received Dates in WMS Report";
	const EMPTY_OMS_DATES = "ALPINE BI Containers | Missing Received Dates in OMS Report";
	const EMPTY_OMS_DATES_REPORT_NAME = "Missing Received Dates in OMS Report";
	
	
	// USER ACTION STRING CONSTANT
	const WEB_PORTAL_LINK = "localhost";
	const PERMISSION_AllOW = "No Permission is Allow";
	const SERVER_ERROR = "Server Error!";
	const USER_DOES_NOT_EXITS_WITH_THIS_USER_NAME = "User does not exists with this user name";
	const FORGET_MESSAGE_SUCCESS  = "Forgot password request submitted successfully. Pls check your email for further details.";
	const NEW_PASSWORD_CONFIRM_PASSWORD_MATCH = "New password and Confirm password should match!";
	const ERROR_RESET_PASSWORD_FAILED = "Error - Reset password Failed.";
	const ERROR_INVALID_RESET_PASSWORD_URL= "Error - Invalid reset password url!";
	const PASSWORD_CHANGEED_SUCCESSFULLY = "Your password changed successfully!";
	const USER_SAVED_SUCCESSFULLY = "User saved successfully.";
	const USER_UPDATE_SUCCCESSFULLY = "User updated successfully.";
	const INCORRECT_USERNAME_PASSWORD = "Incorrect Username or Password";
	const PASSWORD_UPDATE_SUCCESSFULLY  = "Password Updated Successfully";
	const INCORRECT_CURRENT_PASSWORD = "Incorrect Current Password!";
	const USER_DELETE_SUCCESSFULLY = "Users Deleted successfully";
	const LOGIN_SUCCESSFULLY = "Login successfully";
	
	//CLASS CODE ACTION STRING CONSTANT 
	const CLASS_CODE_SAVED_SUCCESSFULLY  = "Class Code saved successfully.";
	const CLASS_CODE_UPDATE_SUCCESSFULLY = "Class Code Updated successfully.";
	const CLASS_CODE_ALREADY_EXISTS = "Class code already exists !";
	const CLASS_CODE_DELETED_SUCCESSFULLY ="Class Codes Deleted successfully";
	const CLASS_CODE_CANNOT_DELETED = "Class code cannot be deleted because it is already in use !";
	
	//CONTAINER SCHEDULE ACTION STRING CONSTANT
	const CONTAINER_SCHEDULE_SAVED_SUCCESSFULLY  = "Container Schedule saved successfully!";
	const CONTAINER_SCHEDULE_UPDATE_SUCCESSFULLY = "Container Schedule updated successfully!";
	const CONTAINER_SCHEDULE_DELETE_SUCCESSFULLY = "Container Schedule(s) Deleted successfully";
	const AWU_REFERENCE_NOT_EMPTY = "AWU Reference can not be empty";
	const INCORRECT_PASSWORD  = "Incorrect Password!";
	
	//GRAPHIC LOG ACTION STRING CONSTANT
	const GRAPHIC_LOG_SAVED_SUCCESSFULLY   = "Graphic Log saved successfully!";
	const GRAPHIC_LOG_UPDATED_SUCCESSFULLY = "Graphic Log updated successfully!";
	const GRAPHIC_LOG_DELETE_SUCCESSFULLY  = "Graphic Log Deleted successfully";
	const USA_DATE_NOT_EMPTY = "USA Office Date Entered can not be empty";
	const ITEM_ID_NOT_EMPTY  = "Item Id can not be empty";
	const START_DATE_LESS_APPX_DATE = "Start Date should be less than Appx Completion Date";
	
	//ITEM SPECIFICATION ACTION STRING CONSTANT
	const ITEM_SPECIFICATION_SAVED_SUCCESSFULLY  = "Item Specifications saved successfully.";
	const ITEM_SPECIFICATION_UPDATE_SUCCESSFULLY = "Item Specifications updated successfully.";
	const ITEM_SPECIFICATION_DELETE_SUCCESSFULLY = "Item Specifications Deleted successfully";
	
	//QC SCHEDULE ACTION STRING CONSTANT
	const QC_SCHEDULE_SAVED_SUCCESSFULLY  = "QC Schedule saved successfully!";
	const QC_SCHEDULE_UPDATE_SUCCESSFULLY = "QC Schedule updated successfully!";
	const QC_SCHEDULE_DELETE_SUCCESSFULLY = "QC Schedules Deleted successfully";
	const ACTUAL_FINAL_INSPECTION_DATE_PAST_SUBMIT_APPROVAL     = "Actual final inspection date should be in past for submit approval";
	const ACTUAL_FINAL_INSPECTION_DATE_REQUIRED_SUBMIT_APPROVAL = "Actual final inspection date is required for submit approval";
	const SHIP_DATE_IS_IN_PAST     = "Ship date should not be in past !";
	
	//QC SCHEDULE APPROVAL ACTION STRING CONSTANT
	const QC_SCHEDULE_STATUS_UPDATE = "QC Schedule status update successfully!";
	
	//TEAM ACTION STRING
	const TEAM_SAVED_SUCCESSFULLY    = "Team saved successfully.";
	const TEAMS_DELETE_SUCCESSFULLY  = "Teams Deleted successfully";
	const TEAM_UPDATE_SUCCESSFULLY   = "Team update successfully";
	
	//CUSTOMER MANAGER STRING CONSTANT
	const IMPORT_CORRECT_FILE = "Please import the correct file";
	const CUSTOMER_IMPORTED_SUCCESSFULLY = "Customers Imported Successfully!";
		
	//GRAPHICLOG MANAGER STRING CONSTANT
	const GRAPHIC_LOGS_IMPORTED_SUCCESSFULLY = "Graphic Logs Imported Successfully!";
	
	//ITEM MANAGER STRING CONSTANT
	const ITEMS_IMPORTED_SUCCESSFULLY = "Items Imported Successfully!";
	
	//QC SCHEDULE MANAGER STRING CONSTANT
	const QC_SCHEDULES_IMPORTED_SUCCESSFULLY  = "Qc Schedules Imported Successfully!";
	
	//SHOW TASK FILE MANAGER STRING CONSTANT
	const TRADESHOWS_DOCUMENTS = "/tradeshows/documents/";
	
	//TRADESHOW ORDER MANAGER STRING CONSTANT
	const TRADESHOW_ORDERS_IMPORTED_SUCCESSFULLY = "Tradeshow orders Imported Successfully!";
	
	//MAIL UTIL STRING CONSTANT
	const IS_DEVELOPER_MODE = "1";
	const DEVELOPER_EMAIL_IDS  = "baljeetgaheer@gmail.com,munishsethi777@gmail.com";
	
	
}