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
	const DUE_TRANS_MODAL = "ALPINE BI Containers | Financial Impact To Trans Modal";
	
	
	
	//Graphic Log Report
	const PROJECT_DUE_REPORT = "ALPINE BI Graphics | Projects due this Week";
	const PROJECT_DUE_REPORT_NAME = "Projects due this Week";
	const PROJECT_OVERDUE_REPORT = "ALPINE BI Graphics | Projects OverDue";
	const PROJECT_OVERDUE_REPORT_NAME = "Projects overdue";
	const PROJECT_COMPLETED_PREVIOUS_REPORT = "ALPINE BI Graphics | Projects Completed Last week";
	const PROJECT_COMPLETED_PREVIOUS_REPORT_NAME = "Projects completed previous week";
	const PROJECT_IN_BUYER_REVIEW_REPORT = "ALPINE BI Graphics | Projects in Buyer's Review";
	const PROJECT_IN_BUYER_REVIEW_REPORT_NAME = "Projects in buyers review";
	const PROJECT_IN_MANAGER_REVIEW_REPORT = "ALPINE BI Graphics | Projects in Manager's Review";
	const PROJECT_IN_MANAGER_REVIEW_REPORT_NAME = "Projects in manager review";
	const PROJECT_IN_ROBBY_REVIEW_REPORT = "ALPINE BI Graphics | Projects in Robby's Review";
	const PROJECT_IN_ROBBY_REVIEW_REPORT_NAME = "Projects in Robby review";
	const PROJECT_IN_MISSING_INFO_FROM_CHINA_REPORT = "ALPINE BI Graphics | Projects with Pending Info from China Team";
	const PROJECT_IN_MISSING_INFO_FROM_CHINA_REPORT_NAME = "Projects with pending information from buyers(China)";
	const PROJECT_DUE_TODAY_REPORT = "ALPINE BI Graphics | Projects Due for the Day";
	const PROJECT_DUE_TODAY_REPORT_NAME = "Projects due for the day";
	const PROJECT_DUE_LESS_THAN_20_FROM_ENTRY_DATE_REPORT = "ALPINE BI Graphics | Projects Due in less than 20 days from China Entry Date";
	const PROJECT_DUE_LESS_THAN_20_FROM_ENTRY_DATE_REPORT_NAME = "Due in Less than 20 Days from China Entry Date";
	const PROJECT_DUE_LESS_THAN_20_FROM_TODAY_REPORT = "ALPINE BI Graphics | Projects Due in less than 20 days";
	const PROJECT_DUE_LESS_THAN_20_FROM_TODAY_REPORT_NAME = "Projects entered that day that is due in less than 20 days";
	const PROJECT_MISSING_INFO_FROM_CHINA_DAILY = "ALPINE BI Graphics | Projects with Pending Info from China Team (Daily)";
	const PROJECT_PAST_DUE_IN_MISSING_INFO_FROM_CHINA_REPORT = "ALPINE BI Graphics | Projects Past Due with Pending Info from China Team";
	const PROJECT_PAST_DUE_IN_MISSING_INFO_FROM_CHINA_REPORT_NAME = "Projects past due because we don't have information to complete";
	
	
	// USER ACTION STRING CONSTANT
	const WEB_PORTAL_LINK = "http://www.alpinebi.com";
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
	const CONTAINER_NOT_EMPTY = "Container can not be empty";
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
	const TEAM_UPDATE_SUCCESSFULLY   = "Team updated successfully";
	
	//CUSTOMER ACTION STRING
	const CUSTOMER_SAVED_SUCCESSFULLY    = "Customer saved successfully.";
	const CUSTOMERS_DELETE_SUCCESSFULLY  = "Customers Deleted successfully";
	const CUSTOMER_UPDATE_SUCCESSFULLY   = "Customer updated successfully";
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
	const DEVELOPER_EMAIL_IDS  = "baljeetgaheer@gmail.com";
	
	//ALPINE SPECIAL PROGRAM
	const ALPINE_PROG_SAVED_SUCCESSFULLY    = "Alpine Program saved successfully.";
	const ALPINE_PROG_UPDATED_SUCCESSFULLY   = "Alpine Program updated successfully";
	
	const SAVED_SUCCESSFULLY    = "Saved successfully.";
	const UPDATED_SUCCESSFULLY   = "Updated successfully";
	
	
}