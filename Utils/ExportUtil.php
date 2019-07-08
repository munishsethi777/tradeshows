<?php
class ExportUtil{
	public static function exportCustomers($customers){
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("Admin")
		->setLastModifiedBy("Admin")
		->setTitle("Customers")
		->setSubject("Customers")
		->setDescription("Customers")
		->setKeywords("office 2007 openxml php")
		->setCategory("Report");
		$alphas = range('A', 'Z');
		$rowCount = 1;
		$count = 1;
		$i = 0;
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "customerid");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "name");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "phone");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "address");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "address1");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "city");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "st");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "zip");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "email");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "attention");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "fax");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "terms");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "sales1");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "sales2");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "sales3");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "sales4");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "createdate");
		$count = 2;
		$i = 0;
		foreach($customers as $customer){
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getCustomerId());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getCustomerName());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getPhone());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getAddress());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$customer->getAddress1());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getCity());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getState());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getZip());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getEmail());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getAttention());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getFax());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getTerms());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getSales1());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getSales2());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getSales3());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getSales4());
			
			$createdDate = DateUtil::StringToDateByGivenFormat("Y-m-d", $customer->getCreateDate());
			$colName = $alphas[$i++]. $count;
			$createdDateStr = $createdDate->format("m/d/y"); 
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $createdDateStr);
			
			$count++;
			$i = 0;
		}
		$objPHPExcel->getActiveSheet()->setTitle("Report");
		 
		 
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		 
		 
		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Customers.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		 
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		ob_end_clean();
		$objWriter->save('php://output');
	}
	
	
	public static function exportOrders($orders){
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("Admin")
		->setLastModifiedBy("Admin")
		->setTitle("Orders")
		->setSubject("Orders")
		->setDescription("Orders")
		->setKeywords("office 2007 openxml php")
		->setCategory("Report");
		$alphas = range('A', 'Z');
		$rowCount = 1;
		$count = 1;
		$i = 0;
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Date");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Customer ID #");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Cus. Name");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Sales Rep");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Sales Order Number");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "SO Type");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Item#");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Description");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "WareHouse");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Qty Ordered");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Price");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "S/O Amt");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "ShipDt");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Cust. PO#");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Item Note");
		$count = 2;
		$i = 0;
		foreach($orders as $order){
			$colName = $alphas[$i++]. $count;
			$date = $order["orderdate"];
			$dateObj = DateUtil::StringToDateByGivenFormat("Y-m-d", $date);
			$dateStr = $dateObj->format("n/j/y");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $dateStr);
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $order["customerid"]);
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $order["customername"]);
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $order["salerep"]);
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$order["salesordernumber"]);
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $order["sotype"]);
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $order["itemno"]);
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $order["description"]);
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $order["warehouse"]);
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $order["quantity"]);
	
			$colName = $alphas[$i++]. $count;
			
			$objPHPExcel->setActiveSheetIndex(0)->getStyle($colName)->getNumberFormat()->setFormatCode("$ #,##0.00");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $order["price"]);
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->getStyle($colName)->getNumberFormat()->setFormatCode("$ #,##0.00");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $order["soamount"]);
				
			$shipDate = $order["shipdt"];
			$shipDateObj = DateUtil::StringToDateByGivenFormat("Y-m-d", $shipDate);
			$shipDateStr = $shipDateObj->format("n/d/Y");
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $shipDateStr);
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $order["custpo"]);
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $order["itemnote"]);
			$count++;
			$i = 0;
		}
		$objPHPExcel->getActiveSheet()->setTitle("Orders");
			
			
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
			
			
		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="TradeShowOrders.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
			
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		ob_end_clean();
		$objWriter->save('php://output');
	}
	
	
	public static function exportQCSchedules($qcSchedules){
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("Admin")
		->setLastModifiedBy("Admin")
		->setTitle("QCSchedules")
		->setSubject("QCSchedules")
		->setDescription("QCSchedules")
		->setKeywords("office 2007 openxml php")
		->setCategory("Report");
		$alphas = range('A', 'Z');
		$rowCount = 1;
		$count = 1;
		$i = 0;
		
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Scheduled");
		$objPHPExcel->setActiveSheetIndex(0)->getStyle($colName)->getAlignment()->applyFromArray(
				array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
				);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue("M1", "Actual");
		$objPHPExcel->setActiveSheetIndex(0)->getStyle("M1")->getAlignment()->applyFromArray(
				array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
				);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue("S1", "Review");
		$count = 2;
		$i = 0;
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "QC");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Class Code");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "PO#");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "PO Type");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Item No");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Ship Date");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Ready Date");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Final \nInspection Date");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Middle \nInspection Date");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "First \nInspection Date");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Production \nStart Date");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Graphics Receive \nDate");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Ready Date");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Final Inspection Date");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Middle Inspection Date");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "First Inspection Date");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Production Start Date");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Graphics Receive Date");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Notes");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
		$count = 3;
		$i = 0;
		foreach($qcSchedules as $qcSchedule){
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $qcSchedule["qccode"]);
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $qcSchedule["classcode"]);
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $qcSchedule["po"]);
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $qcSchedule["potype"]);
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$qcSchedule["itemnumbers"]);
	
			$shipDate = $qcSchedule["shipdate"];
			if(!empty($shipDate)){
				$shipDate = self::getDateStr($shipDate);
			}else{
				$shipDate = "N/A";
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $shipDate);
			
			$scReadyDate = $qcSchedule["screadydate"];
			if(!empty($scReadyDate)){
				$scReadyDate = self::getDateStr($scReadyDate);
			}else{
				$scReadyDate = "N/A";
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $scReadyDate);
			
			$scFinalInspectionDate = $qcSchedule["scfinalinspectiondate"];
			if(!empty($scFinalInspectionDate)){
				$scFinalInspectionDate = self::getDateStr($scFinalInspectionDate);
			}else{
				$scFinalInspectionDate = "N/A";
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $scFinalInspectionDate);
			
			
			$scMiddleInspectionDate = $qcSchedule["scmiddleinspectiondate"];
			if(!empty($scMiddleInspectionDate)){
				$scMiddleInspectionDate = self::getDateStr($scMiddleInspectionDate);
			}else{
				$scMiddleInspectionDate = "N/A";
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $scMiddleInspectionDate);
			
			$scFirstInspectionDate = $qcSchedule["scfirstinspectiondate"];
			if(!empty($scFirstInspectionDate)){
				$scFirstInspectionDate = self::getDateStr($scFirstInspectionDate);
			}else{
				$scFirstInspectionDate = "N/A";
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $scFirstInspectionDate);

			$scProductionStartDate = $qcSchedule["scproductionstartdate"];
			if(!empty($scProductionStartDate)){
				$scProductionStartDate = self::getDateStr($scProductionStartDate);
			}else{
				$scProductionStartDate = "N/A";
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $scProductionStartDate);
			
			$scGraphicReceiveDate = $qcSchedule["scgraphicsreceivedate"];
			if(!empty($scGraphicReceiveDate)){
				$scGraphicReceiveDate = self::getDateStr($scGraphicReceiveDate);
			}else{
				$scGraphicReceiveDate = "N/A";
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $scGraphicReceiveDate);
			
			$acReadyDate = $qcSchedule["acreadydate"];
			if(!empty($acReadyDate)){
				$acReadyDate = self::getDateStr($acReadyDate);
			}else{
				$acReadyDate = "N/A";
			}
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $acReadyDate);
			
			$acFinalInspectionDate = $qcSchedule["acfinalinspectiondate"];
			if(!empty($acFinalInspectionDate)){
				$acFinalInspectionDate = self::getDateStr($acFinalInspectionDate);
			}else{
				$acFinalInspectionDate = "N/A";
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $acFinalInspectionDate);
			
			$acMiddleInspectionDate = $qcSchedule["acmiddleinspectiondate"];
			if(!empty($acFinalInspectionDate)){
				$acMiddleInspectionDate = self::getDateStr($acMiddleInspectionDate);
			}else{
				$acMiddleInspectionDate = "N/A";
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $acMiddleInspectionDate);
			
			$acFirstInspectionDate = $qcSchedule["acfirstinspectiondate"];
			if(!empty($acFinalInspectionDate)){
				$acFirstInspectionDate = self::getDateStr($acFirstInspectionDate);
			}else{
				$acFirstInspectionDate = "N/A";
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $acFirstInspectionDate);
			
			$acProductionStartDate = $qcSchedule["acproductionstartdate"];
			if(!empty($acProductionStartDate)){
				$acProductionStartDate = self::getDateStr($acProductionStartDate);
			}else{
				$acProductionStartDate = "N/A";
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $acProductionStartDate);
			
			$acGraphicReceiveDate = $qcSchedule["acgraphicsreceivedate"];
			if(!empty($acGraphicReceiveDate)){
				$acGraphicReceiveDate = self::getDateStr($acGraphicReceiveDate);
			}else{
				$acGraphicReceiveDate = "N/A";
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $acGraphicReceiveDate);
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $qcSchedule["notes"]);
			$count++;
			$i = 0;
		}
		$objPHPExcel->getActiveSheet()->setTitle("QCSchedules");
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:L1')
		->getFill()
		->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
		->getStartColor()
		->setRGB('FFFF99');
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A2:L2')
		->getFill()
		->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
		->getStartColor()
		->setRGB('FFFF99');
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('M1:R1')
		->getFill()
		->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
		->getStartColor()
		->setRGB('D3D3D3');
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('M2:R2')
		->getFill()
		->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
		->getStartColor()
		->setRGB('D3D3D3');
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('S1:S2')
		->getFill()
		->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
		->getStartColor()
		->setRGB('FF0000');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:L1');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('M1:R1');
		
		
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
			
			
		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="QCSchedules.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
			
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		ob_end_clean();
		$objWriter->save('php://output');
	}
	
	
	public static function exportGraphicLogs($graphicLogs){
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("Admin")
		->setLastModifiedBy("Admin")
		->setTitle("Graphic Logs")
		->setSubject("Graphic Logs")
		->setDescription("Graphic Logs")
		->setKeywords("office 2007 openxml php")
		->setCategory("Report");
		$alphas = range('A', 'Z');
		$alphas = ExportUtil::createColumnsArray("AA");
		$rowCount = 1;
		$count = 1;
		$i = 0;
	
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "USA OFFICE ENTRY DATE");
		$objPHPExcel->setActiveSheetIndex(0)->getStyle($colName)->getAlignment()->applyFromArray(
				array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
				);
	  	$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "PO #");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "ESTIMATED P/O \nSHIP DATE");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "CLASS CODE");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "SKU #");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Type Of Graphic");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Custom \nHangtag \nNeeded");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Custom \nWraptag \nNeeded");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Customer Name");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "PRIVATE \nLABEL (Y/N)");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "USA NOTES TO GRAPHICS");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Estimated GRAPHICS DUE DATE");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "CHINA OFFICE ENTRY DATE");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "CONFIRMED P/O SHIP DATE");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Ship Dates In Jeopardy");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "LENGTH");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "WIDTH");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "HEIGHT");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "NOTES FROM CHINA OFFICE");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "FINAL GRAPHICS DUE DATE");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "NOTES FROM GRAPHICS TO CHINA OFFICE");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "APPROX. DATE GRAPHICS \nWILL BE SENT TO CHINA FOR PRINT");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "GRAPHIC STATUS");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "GRAPHIC ARTIST \nWORKING ON PROJECT");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "GRAPHIC ARTIST \nSTART DATE");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "DATE COMPLETION OF GRAPHICS");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "DURATION (# OF DAYS)");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("AA")->setAutoSize(true);
		$count = 2;
		$i = 0;
		$classCodeMgr = ClassCodeMgr::getInstance();
		foreach($graphicLogs as $graphicLog){
			//$graphicLog = new GraphicsLog();
			$USAOfficeEntryDate = $graphicLog->getUSAOfficeEntryDate();
			if(!empty($USAOfficeEntryDate)){
				$USAOfficeEntryDate = self::getDateStr($USAOfficeEntryDate);
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $USAOfficeEntryDate);
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $graphicLog->getPO());
			
			$estimatedShipDate =  $graphicLog->getEstimatedShipDate();
			if(!empty($estimatedShipDate)){
				$estimatedShipDate = self::getDateStr($estimatedShipDate);
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $estimatedShipDate);
			
			$classCodeObj = $classCodeMgr->findBySeq($graphicLog->getClassCodeSeq());
			$classCode = "";
			if(!empty($classCodeObj)){
				$classCode = $classCodeObj->getClassCode();
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $classCode);
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $graphicLog->getSKU());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$graphicLog->getGraphicType());
			
			$customHangTagNeeded = "No";
			if(!empty($graphicLog->getIsCustomHangTagNeeded())){
				$customHangTagNeeded = "Yes";
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$customHangTagNeeded);
			
			
			$customWrapTagNeeded = "No";
			if(!empty($graphicLog->getIsCustomWrapTagNeeded())){
				$customWrapTagNeeded = "Yes";
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$customWrapTagNeeded);
			
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$graphicLog->getCustomerName());
			
			$privateLabel = "No";
			if(!empty($graphicLog->getIsPrivateLabel())){
				$privateLabel = "Yes";
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$privateLabel);
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$graphicLog->getUSANotes());
			
			$estimatedGraphicDate = $graphicLog->getEstimatedGraphicsDate();
			if(!empty($estimatedGraphicDate)){
				$estimatedGraphicDate = self::getDateStr($estimatedGraphicDate);
			}
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $estimatedGraphicDate);
				
			$chinaOfficeEntryDate = $graphicLog->getChinaOfficeEntryDate();
			if(!empty($chinaOfficeEntryDate)){
				$chinaOfficeEntryDate = self::getDateStr($chinaOfficeEntryDate);
			}
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $chinaOfficeEntryDate);
				
			$confirmedPOShipDate = $graphicLog->getConfirmedPOShipDate();
			if(!empty($confirmedPOShipDate)){
				$confirmedPOShipDate = self::getDateStr($confirmedPOShipDate);
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $confirmedPOShipDate);
				
				
			$jeopardyDate = $graphicLog->getJeopardyDate();
			if(!empty($jeopardyDate)){
				$jeopardyDate = self::getDateStr($jeopardyDate);
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $jeopardyDate);
				
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $graphicLog->getGraphicLength());
			
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $graphicLog->getGraphicWidth());
			
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $graphicLog->getGraphicHeight());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $graphicLog->getChinaNotes());
			
			$finalGraphicsDueDate = $graphicLog->getFinalGraphicsDueDate();
			if(!empty($finalGraphicsDueDate)){
				$finalGraphicsDueDate = self::getDateStr($finalGraphicsDueDate);
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $finalGraphicsDueDate);
			
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $graphicLog->getGraphicsToChinaNotes());
	
			$approxGraphicsChinaSentDate = $graphicLog->getApproxGraphicsChinaSentDate();
			if(!empty($approxGraphicsChinaSentDate)){
				$approxGraphicsChinaSentDate = self::getDateStr($approxGraphicsChinaSentDate);
			}
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $approxGraphicsChinaSentDate);
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $graphicLog->getGraphicStatus());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $graphicLog->getGraphicArtist());
				
			$graphicArtistStartDate = $graphicLog->getGraphicArtistStartDate();
			if(!empty($graphicArtistStartDate)){
				$graphicArtistStartDate = self::getDateStr($graphicArtistStartDate);
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $graphicArtistStartDate);
				
			$graphicCompletionDate = $graphicLog->getGraphicCompletionDate();
			if(!empty($graphicCompletionDate)){
				$graphicCompletionDate = self::getDateStr($graphicCompletionDate);
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $graphicCompletionDate);
			
 			$colName = $alphas[$i++]. $count;
 			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$graphicLog->getDuration());
			$count++;
			$i = 0;
		}
		$objPHPExcel->getActiveSheet()->setTitle("Graphic Logs");
		
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
			
			
		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="GraphicLogs.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
			
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		ob_end_clean();
		$objWriter->save('php://output');
	}
	
	
	public static function exportItems($items){
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("Admin")
		->setLastModifiedBy("Admin")
		->setTitle("customers")
		->setSubject("Items")
		->setDescription("Items")
		->setKeywords("office 2007 openxml php")
		->setCategory("Report");
		$alphas = range('A', 'Z');
		$rowCount = 1;
		$count = 1;
		$i = 0;
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Item No");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Description");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Class");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Dept#");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Status ( Color )");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Unit");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Pc/Cs");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Disc.");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "In Stock Qty");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Alloc. Qty");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "S/O Qty");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "A/V Qty");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "P/O Qty");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "OW Qty");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Proj.Qty");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "YTD Sold Qty");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Last Year Sold Qty");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, ".Com D Ship");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "ShowSpecial");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Distributor");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "DealerPrice");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Crzy Dis Sp");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Qty Wt");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "MIn Stk");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Item Cost");
	
		$count = 2;
		$i = 0;
		foreach($items as $item){
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getItemNo());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getDescription());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getClass());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getDept());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$item->getStatus());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getUnit());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getPccs());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getDisc());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getInStockQty());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getAllocQty());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getSoQty());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getAvQty());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getPoQty());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getOwQty());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getProjQty());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getYtdSoldQty());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getLastYearSoldQty());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getComdShip());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getShowSpecial());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getDistributor());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getDealerPrice());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getCrzyDissp());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getQtyWt());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getMinStk());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getItemCost());
			$count++;
			$i = 0;
		}
		$objPHPExcel->getActiveSheet()->setTitle("Report");
			
			
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
			
			
		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="items.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
			
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		ob_end_clean();
		$objWriter->save('php://output');
	}
	
	
	public static function exportItemSpecifications($itemSpecifications){
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("Admin")
		->setLastModifiedBy("Admin")
		->setTitle("customers")
		->setSubject("ItemSpecifications")
		->setDescription("ItemSpecifications")
		->setKeywords("office 2007 openxml php")
		->setCategory("Report");
		$alphas = range('A', 'Z');
		$alphas = ExportUtil::createColumnsArray("CV");
		$rowCount = 1;
		$count = 1;
		$i = 0;
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Item #");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, " ");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Item #1 Description (example - MOD102A - Bistro Set - Table is item#1)(if not 2 pieces or more, use MAIN)");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Length");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Width");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Height");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Item #2 Description (example - MOD102A- Bistro Set - Item#2 is chair)");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Length");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Width");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Height");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Item #3 Description");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Length");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Width");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Height");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Length");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Width");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Height");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Length");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Width");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Height");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "MS Description (copy, no editing)");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Port");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Country of Orgin");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Material 1");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "%");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Material 2");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "%");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Material 3");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "%");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Material 4");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "%");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Material 5");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "%");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Material % Total");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Does it Have a Light? If Yes, put type of light (LED or Halogen)");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "# of Lumens");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Does the Item Contain Battery?");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Battery Qty.");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Battery Type");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Does this item use electricity? (Y/N)");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "If uses electricity, is it battery operated or cord connected?");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "If powered by cord, how long is the cord? (in feet)");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Assembly Required? (Y/N)");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Instruction Manual PDF Path");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Part 1 (Pump Replacement Part #)");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Part 2 (Light Replacement Part #)");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Part 3 (Transformer Replacement Part #)");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Part 4 (Battery Replacement Part #)");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Part 5 (Misc. Part)");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Light Cord Length (M.)");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Pump Wattage");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Pump Volts");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Pump Cord Length (Ft.)");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Transformer Wattage");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Transformer Volts");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Transformer Cord Length (ft.)");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Water Capacity (Liters)");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Feature 1 (This is the most important feature)");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Feature 2");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Feature 3");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Feature 4");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Feature 5");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Feature 6");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Feature 7 - # of Assortments");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Reviewed/Updated By?");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, " ");
		$count = 2;
		$i = 0;
		foreach($itemSpecifications as $item){
			//$item = new ItemSpecification();
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getItemNo());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getOms());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getItem1Description());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getItem1Length());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$item->getItem1Width());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getItem1Height());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getItem2Description());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getItem2Length());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getItem2Width());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getItem2Height());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getItem3Description());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getItem3Length());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getItem2Width());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getItem3Height());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getMasterCarton1Length());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getMasterCarton1Width());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getMasterCarton1Height());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getMasterCarton2Length());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getMasterCarton2Width());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getMasterCarton2Height());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getMSDescription());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getPort());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getCountryOfOrigin());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getMaterial1());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getMaterial1Percent());
			
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getMaterial2());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getMaterial2Percent());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getMaterial3());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$item->getMaterial3Percent());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getMaterial4());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getMaterial4Percent());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getMaterial5());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getMaterial5Percent());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getMaterialTotalPercent());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getLightType());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getTotalLumens());
			
			$colName = $alphas[$i++]. $count;
			$containBattery = "N";
			if(!empty($item->getHasBattery())){
				$containBattery = 'Y';
			}
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $containBattery);
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getBatteryQuantity());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getBatteryType());
			$containElec = "N";
			if(!empty($item->getHasElectricity())){
				$containElec = 'Y';
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $containElec);
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getElectricityType());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getCordLengthFeet());
			
			$assemblyRequired = "N";
			if(!empty($item->getHasAssembly())){
				$assemblyRequired = 'Y';
			}
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $assemblyRequired);
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getManualPath());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getPart1());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getPart2());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getPart3());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getPart4());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getPart5());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getCordLengthMeter());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getPumpWattage());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getPumpVolts());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getPumpCordLength());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getTransformerWattage());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getTransformerVolts());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getTransformerCordLength());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getWaterCapacity());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getFeature1());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getFeature2());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getFeature3());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getFeature4());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getFeature5());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getFeature6());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getFeature7());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getUpdatedBy());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getTroy());
			
			$count++;
			$i = 0;
		}
		$objPHPExcel->getActiveSheet()->setTitle("Report");
			
			
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
			
			
		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="itemSpecifications.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
			
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		ob_end_clean();
		$objWriter->save('php://output');
	}
	
private static function createColumnsArray($end_column, $first_letters = '')
{
  $columns = array();
  $length = strlen($end_column);
  $letters = range('A', 'Z');

  // Iterate over 26 letters.
  foreach ($letters as $letter) {
      // Paste the $first_letters before the next.
      $column = $first_letters . $letter;

      // Add the column to the final array.
      $columns[] = $column;

      // If it was the end column that was added, return the columns.
      if ($column == $end_column)
          return $columns;
  }

  // Add the column children.
  foreach ($columns as $column) {
      // Don't itterate if the $end_column was already set in a previous itteration.
      // Stop iterating if you've reached the maximum character length.
      if (!in_array($end_column, $columns) && strlen($column) < $length) {
          $new_columns = self::createColumnsArray($end_column, $column);
          // Merge the new columns which were created with the final columns array.
          $columns = array_merge($columns, $new_columns);
      }
  }

  return $columns;
}

private static function getDateStr($date){
	$format = 'Y-m-d';
	if(!empty($date)){
		$date = DateUtil::StringToDateByGivenFormat($format, $date);
		$date = $date->format("n/j/y");
	}
	return $date;
}

public static function exportQcWeeklyReport($pendingSchedules,$notificationName,$isEmail){
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("Admin")
		->setLastModifiedBy("Admin")
		->setTitle("QCSchedules")
		->setSubject("QCSchedules")
		->setDescription("QCSchedules")
		->setKeywords("office 2007 openxml php")
		->setCategory("Report");
		$alphas = range('A', 'Z');
		$rowCount = 1;
		$count = 1;
		$i = 0;
		$fromDate = new DateTime();
		$fromDate->modify("+1 days");
		$toDate = new DateTime();
		$toDate->modify("+7 days");
		$fromDateStr = $fromDate->format("n/j/y");
		$toDateStr = $toDate->format("n/j/y");
		foreach($pendingSchedules as $notificationType=>$qcSchedules){
			$colval = "$notificationType due in next 7 days ($fromDateStr to $toDateStr)";
			if($notificationName == StringConstants::MISSING_INSPECTION_APPOINTMENT){
				$colval = "Missing $notificationType";
			}else if($notificationName == StringConstants::INCOMPLETED_SCHEDULES){
				$colval = "Incompleted $notificationType";
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $colval);
			$objPHPExcel->setActiveSheetIndex(0)->getStyle($colName)->getAlignment()->applyFromArray(
					array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
					);
			$objPHPExcel->getActiveSheet()->getStyle($colName)->getFont()->setBold(true);
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells($colName . ":I" .$count);
			$count = $count + 2;
			$i=0;
			$colName = $alphas[$i++]. $count;
			$firstRowColName = $colName;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Sr.");
			$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
			$objPHPExcel->setActiveSheetIndex(0)->getStyle($colName)->getAlignment()->applyFromArray(
					array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,)
					);
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "QC");
			$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Class");
			$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,"PO");
			$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "PO Type");
			$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Item Number");
			$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "ShipDate");
			//$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
			
			$apNotificationTitle = str_replace("Scheduled", "Appointment", $notificationType);
			$notificationTitle = $notificationType;
			if($notificationName != StringConstants::UPCOMING_INSPECTION_SCHEDULE ){
				$notificationTitle = str_replace("Appointment", "Scheduled", $notificationType);
			}
			if($notificationName == StringConstants::INCOMPLETED_SCHEDULES ){
				$notificationTitle = "Scheduled " . $notificationTitle;
				$apNotificationTitle = "Appointment " . $apNotificationTitle;
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $notificationTitle);
			//$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $apNotificationTitle);
			//$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
			$lastRowColName = $colName;
			$objPHPExcel->getActiveSheet()->getStyle($firstRowColName.":" . $lastRowColName)->getFont()->setBold(true);
			$objPHPExcel->setActiveSheetIndex(0)->getStyle($firstRowColName.":" . $lastRowColName)
			->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
			->getStartColor()
			->setRGB('D3D3D3');
			$i = 0;
			$count++;
			$srNo = 1;
			if(!empty($qcSchedules)){
				foreach ($qcSchedules as $qcSchedule){
					//$qcSchedule = new QCSchedule();
					$colName = $alphas[$i++]. $count;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $srNo);
					
					$colName = $alphas[$i++]. $count;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $qcSchedule->getQC());
					
					$colName = $alphas[$i++]. $count;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $qcSchedule->classcode);
					
					$colName = $alphas[$i++]. $count;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$qcSchedule->getPO());
					
					$colName = $alphas[$i++]. $count;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $qcSchedule->getPOType());
					
					$colName = $alphas[$i++]. $count;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $qcSchedule->getItemNumbers());
					
					$shipDate = DateUtil::StringToDateByGivenFormat("Y-m-d", $qcSchedule->getShipDate());
					$colName = $alphas[$i++]. $count;
					$shipDateStr = $shipDate->format("n/j/y");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$shipDateStr);
					$dates = QCNotificationsUtil::getScheduleNotificationDate($qcSchedule, $notificationType);
					$colName = $alphas[$i++]. $count;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $dates["scdate"]);
					
					$colName = $alphas[$i++]. $count;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $dates["apdate"]);
					$count++;
					$i = 0;
					$srNo++; 
				}
			}else{
				$colName = $alphas[$i++]. $count;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "No Rows Found");
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells($colName . ":I" .$count);
			}
			$count++;
			$i = 0;
		}
		$objPHPExcel->getActiveSheet()->setTitle("Report");
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getStyle('H1:H'.$objPHPExcel->getActiveSheet()->getHighestRow())
		->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getStyle('I1:I'.$objPHPExcel->getActiveSheet()->getHighestRow())
		->getAlignment()->setWrapText(true);
		
		if($isEmail){
			ob_start();
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
			$excelOutput = ob_get_contents();
			ob_end_clean();
			return $excelOutput;
		}
		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="QC_Weekly.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
			
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		ob_end_clean();
		$objWriter->save('php://output');
}

public static function exportQcPendingForApprovals($qcSchedules,$notificationName,$isEmail){
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("Admin")
	->setLastModifiedBy("Admin")
	->setTitle("PendingQcSchedulesForApprovals")
	->setSubject("PendingQcSchedulesForApprovals")
	->setDescription("PendingQcSchedulesForApprovals")
	->setKeywords("office 2007 openxml php")
	->setCategory("Report");
	$alphas = range('A', 'Z');
	$count = 1;
	$i = 0;
	
		$colName = $alphas[$i++]. $count;
		$firstRowColName = $colName;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Sr.");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$objPHPExcel->setActiveSheetIndex(0)->getStyle($colName)->getAlignment()->applyFromArray(
				array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,)
				);

		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "QC");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);

		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Class");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);

		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,"PO");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);

		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "PO Type");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);

		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Item Number");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Final Inspection Date");

		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Applied On");
		
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Approval Status");
		
		$lastRowColName = $colName;
		$objPHPExcel->getActiveSheet()->getStyle($firstRowColName.":" . $lastRowColName)->getFont()->setBold(true);
		$objPHPExcel->setActiveSheetIndex(0)->getStyle($firstRowColName.":" . $lastRowColName)
		->getFill()
		->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
		->getStartColor()
		->setRGB('D3D3D3');
		$i = 0;
		$count++;
		$srNo = 1;
		if(!empty($qcSchedules)){
			foreach ($qcSchedules as $qcSchedule){
				//$qcSchedule = new QCSchedule();
				$colName = $alphas[$i++]. $count;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $srNo);
					
				$colName = $alphas[$i++]. $count;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $qcSchedule->getQC());
					
				$colName = $alphas[$i++]. $count;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $qcSchedule->classcode);
					
				$colName = $alphas[$i++]. $count;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$qcSchedule->getPO());
					
				$colName = $alphas[$i++]. $count;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $qcSchedule->getPOType());
					
				$colName = $alphas[$i++]. $count;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $qcSchedule->getItemNumbers());
				
				$finalInspectionDate = DateUtil::StringToDateByGivenFormat("Y-m-d", $qcSchedule->getACFinalInspectionDate());
				$colName = $alphas[$i++]. $count;
				$finalInspectionDateStr = $finalInspectionDate->format("n/j/y");
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$finalInspectionDateStr);
					
				$appliedOnDate = DateUtil::StringToDateByGivenFormat("Y-m-d H:i:s", $qcSchedule->appliedon);
				$colName = $alphas[$i++]. $count;
				$appliedOnDateStr = $appliedOnDate->format("n/j/y");
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$appliedOnDateStr);
		
				$colName = $alphas[$i++]. $count;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $qcSchedule->responsetype);
				$count++;
				$i = 0;
				$srNo++;
			}
		}else{
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "No Rows Found");
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells($colName . ":I" .$count);
		}
	$objPHPExcel->getActiveSheet()->setTitle("PendingQcSchedulesForApprovals");
	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getStyle('H1:H'.$objPHPExcel->getActiveSheet()->getHighestRow())
	->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getStyle('I1:I'.$objPHPExcel->getActiveSheet()->getHighestRow())
	->getAlignment()->setWrapText(true);

	if($isEmail){
		ob_start();
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		$excelOutput = ob_get_contents();
		ob_end_clean();
		return $excelOutput;
	}
	// Redirect output to a client’s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="QC_Weekly.xls"');
	header('Cache-Control: max-age=0');
	// If you're serving to IE 9, then the following may be needed
	header('Cache-Control: max-age=1');
		
	// If you're serving to IE over SSL, then the following may be needed
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: public'); // HTTP/1.0
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	ob_end_clean();
	$objWriter->save('php://output');
}

public static function exportHtmlToExcel($html){
	$filename = "DownloadReport";
	$table    = $html;
	 
	// save $table inside temporary file that will be deleted later
	$tmpfile = tempnam(sys_get_temp_dir(), 'html');
	file_put_contents($tmpfile, $table);
	 
	// insert $table into $objPHPExcel's Active Sheet through $excelHTMLReader
	$objPHPExcel     = new PHPExcel();
	$excelHTMLReader = PHPExcel_IOFactory::createReader('HTML');
	$excelHTMLReader->loadIntoExisting($tmpfile, $objPHPExcel);
	$objPHPExcel->getActiveSheet()->setTitle('any name you want'); // Change sheet's title if you want
	 
	unlink($tmpfile); // delete temporary file because it isn't needed anymore
	 
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); // header for .xlxs file
	header('Content-Disposition: attachment;filename='.$filename); // specify the download file name
	header('Cache-Control: max-age=0');
	 
	// Creates a writer to output the $objPHPExcel's content
	$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$writer->save('php://output');
	exit;
}
}