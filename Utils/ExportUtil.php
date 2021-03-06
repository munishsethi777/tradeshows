<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BusinessCategoryType.php");
class ExportUtil{
	private static $VERTICAL = "vertical";
	private static $HORIZONTAL = "horizontal";
	public static $EXPORT_ROW_LIMIT = 5000;
	public static function exportCustomers($data){
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("Admin")
		->setLastModifiedBy("Admin")
		->setTitle("Customers")
		->setSubject("Customers")
		->setDescription("Customers")
		->setKeywords("office 2007 openxml php")
		->setCategory("Report");
		$alphas = ExportUtil::createColumnsArray("ZZ");;
		$rowCount = 1;
		$count = 1;
		$i = 0;
		$salesRepStartsFromColIndex = 9;
		$internalSupportRepStartsFromColIndex = ($data['allrepheadingcountarr']['salesrep'] * 5) + $salesRepStartsFromColIndex;
		$buyerRepStartsFromColIndex = ($data['allrepheadingcountarr']['internalsupport'] * 5)  + $internalSupportRepStartsFromColIndex;
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "CUS_ID_NUM");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "CUS_NAME");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "STORE_ID");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "CHAIN_STORE_NAME");
		$colName = $alphas[$i++]. $count;
		// $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Priority");
		// $colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Customer Type");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Inside Account Manager");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "SALES Admin Lead");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Chain Store Sales Admin Lead");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Business Type");
		foreach($data['customerrepsheading'] as $heading){
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $heading);
		}

		// $colName = $alphas[$i++]. $count;
		// $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Category");
		// $colName = $alphas[$i++]. $count;
		// $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Key");
		$count = 2;
		$i = 0;
		$array = array();
		$index = 0;
		foreach($data['customers'] as $customer){
		    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
			$colName = $alphas[$i++]. $count;
		    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer["customerid"]);
			$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer["customerfullname"]);
			$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer["storeid"]);
			$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer["storename"]);
			$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, BusinessCategoryType::getValue($customer["customertype"]));
			$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer["insideaccountmanager"]);
			$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer["salesadminlead"]);
			$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer["chainstoresalesadminname"]);
			$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
			$businessType = $customer["businesstype"];
			if(!empty($businessType)){
			    $businessType = CustomerBusinessType::getValue($businessType);
			}
			$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $businessType);
			$customerReps = $customer["customerreps"];
			for ($j = 0; $j < $data['maxrepcount']; $j++) {
				if(isset($customerReps[$j])){
					if($customerReps[$j]['customerreptype'] == 'internalsupport' && $i < $internalSupportRepStartsFromColIndex){
						$i = $internalSupportRepStartsFromColIndex;
					}else if($customerReps[$j]['customerreptype'] == 'buyer' && $i < $buyerRepStartsFromColIndex){
						$i = $buyerRepStartsFromColIndex;
					}
					$colName = $alphas[$i++]. $count;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customerReps[$j]["fullname"]);
					$colName = $alphas[$i++]. $count;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customerReps[$j]["email"]);
					$colName = $alphas[$i++]. $count;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customerReps[$j]["cellphone"]);
					$colName = $alphas[$i++]. $count;
					$category = $customerReps[$j]["category"];
					if(!empty($category)){
						$category = BuyerCategoryType::getValue($category);
					}
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customerReps[$j]["category"]);
					$colName = $alphas[$i++]. $count;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customerReps[$j]["notes"]);
				}
			}
			$index++;
			$count++;
			$i = 0;
			array_push($array,$customer["customerseq"]);
		}
		$objPHPExcel->getActiveSheet()->getStyle("A1:I1")->getFill()
		->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
		->getStartColor()
		->setRGB('CCE5FF');
		$salesRepStartsFromColIndex = 9;
		$internalSupportRepStartsFromColIndex = ($data['allrepheadingcountarr']['salesrep'] * 5) + $salesRepStartsFromColIndex;
		$buyerRepStartsFromColIndex = ($data['allrepheadingcountarr']['internalsupport'] * 5)  + $internalSupportRepStartsFromColIndex;
		$objPHPExcel->getActiveSheet()->getStyle($alphas[$salesRepStartsFromColIndex]."1:". $alphas[$internalSupportRepStartsFromColIndex-1] ."1")->getFill()
		->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
		->getStartColor()
		->setRGB('f8cbad');
		$objPHPExcel->getActiveSheet()->getStyle($alphas[$internalSupportRepStartsFromColIndex]."1:". $alphas[$buyerRepStartsFromColIndex-1] ."1")->getFill()
		->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
		->getStartColor()
		->setRGB('cfddaf');
		$objPHPExcel->getActiveSheet()->getStyle($alphas[$buyerRepStartsFromColIndex]."1:". $alphas[(($data['maxrepcount'] * 5) + 9)-1] . "1")->getFill()
		->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
		->getStartColor()
		->setRGB('ddced8');
		$firstRow = 'A1:'.$objPHPExcel->getActiveSheet()->getHighestColumn().'1';
		$objPHPExcel->getActiveSheet()
		->getStyle($firstRow)
		->getFont()
		->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle($firstRow)->applyFromArray(ExportUtil::$default_style);
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
	private static $colors = array();
	
	private static function getRandomColor(){
	    self::$colors = array("ebdddd","e9ebdd","ddebea","dfddeb","ebddea");
	    shuffle(self::$colors);
	    return self::$colors[0];
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
	
	//Discarding this Method, Use PHPExcelUtils for the new method
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
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "ID");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "QC");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "PoIncharge");
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
		    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $qcSchedule["scheduleseq"]);
		    
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $qcSchedule["qccode"]);
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $qcSchedule["poqccode"]);

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
			
			$notes = strip_tags($qcSchedule["notes"]);
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $notes);
			$count++;
			$i = 0;
		}
		$objPHPExcel->getActiveSheet()->setTitle("QCSchedules");
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:M1')
		->getFill()
		->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
		->getStartColor()
		->setRGB('FFFF99');
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A2:M2')
		->getFill()
		->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
		->getStartColor()
		->setRGB('FFFF99');
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('N1:S1')
		->getFill()
		->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
		->getStartColor()
		->setRGB('D3D3D3');
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('N2:S2')
		->getFill()
		->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
		->getStartColor()
		->setRGB('D3D3D3');
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('T1:T2')
		->getFill()
		->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
		->getStartColor()
		->setRGB('FF0000');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:M1');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('N1:S1');
		
		
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
	
	
	public static function exportGraphicLogs($graphicLogs,$fileName,$isEmail = false){
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("Admin")
		->setLastModifiedBy("Admin")
		->setTitle("Graphic Logs")
		->setSubject("Graphic Logs")
		->setDescription("Graphic Logs")
		->setKeywords("office 2007 openxml php")
		->setCategory("Report");
		$alphas = range('A', 'Z');
		$alphas = ExportUtil::createColumnsArray("AF");
		$count = 1;
		$i = 0;
		$top_vertical = PHPExcel_Style_Alignment::VERTICAL_CENTER;
		$colName = $alphas[$i++]. $count;
		$sheet = $objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "FILLED BY USA OFFICE");
		$objPHPExcel->setActiveSheetIndex(0)->getStyle($colName)->getAlignment()->applyFromArray(
		    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
		    );
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($colName . ":L" .$count);
		
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue("M".$count, "FILLED BY CHINA TEAM");
		$objPHPExcel->setActiveSheetIndex(0)->getStyle("M".$count)->getAlignment()->applyFromArray(
		    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
		    );
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("M".$count . ":T" .$count);
		
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue("U".$count, "FILLED BY GRAPHICS TEAM USA");
		$objPHPExcel->setActiveSheetIndex(0)->getStyle("U".$count)->getAlignment()->applyFromArray(
		    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
		    );
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("U".$count . ":AF" .$count);
		$count = 2;
		$i = 0;
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "USA OFFICE ENTRY DATE");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		
	  	$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "PO #");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "DUE DATE");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "ESTIMATED P/O \nSHIP DATE");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "CLASS CODE");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "ESTIMATED GRAPHICS \nDUE DATE");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "SKU #");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Type Of Graphic");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Type of Tag");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Customer Name");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "PRIVATE \nLABEL (Y/N)");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "USA NOTES TO GRAPHICS");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "CHINA OFFICE ENTRY DATE");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "FINAL GRAPHICS DUE DATE");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "CONFIRMED P/O SHIP DATE");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "CREATED BY");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "ENTERED BY");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "LENGTH");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "WIDTH");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "HEIGHT");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "NOTES FROM CHINA \nTO US OFFICE");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "ASSIGNED DESIGNER");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "START DATE");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "GRAPHIC STATUS");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "SUBMITTED TO \nCHINA DATE");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "APPROX COMPLETION \nDATE");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "DURATION (# OF DAYS)");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "DRAFT DATE");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "BUYER REVIEW \nRETURN DATE");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "MANAGER’S REVIEW \nRETURN DATE");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "ROBBY’S REVIEW \nRETURN DATE");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$colName = $alphas[$i]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "NOTES FROM GRAPHICS TO \nCHINA OFFICE");
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
		self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
		$count = 3;
		$i = 0;
		
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
			
			
			$colName = $alphas[$i++]. $count;
			$dueDate = $graphicLog->getFinalGraphicsDueDate();
			if(empty($dueDate) && !empty($graphicLog->getEstimatedShipDate())){
			    $dueDate = $graphicLog->getEstimatedShipDate();
			    $objPHPExcel->getActiveSheet()->getStyle($colName)->getFont()
			    ->getColor()->setRGB('#1ab394');
			}
			$dueDate = self::getDateStr($dueDate);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $dueDate);
			
			
			$estimatedShipDate =  $graphicLog->getEstimatedShipDate();
			if(!empty($estimatedShipDate)){
				$estimatedShipDate = self::getDateStr($estimatedShipDate);
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $estimatedShipDate);
			
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $graphicLog->classcode);
			
			$estimatedGraphicDate =  $graphicLog->getEstimatedGraphicsDate();
			if(!empty($estimatedGraphicDate)){
			    $estimatedGraphicDate = self::getDateStr($estimatedGraphicDate);
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $estimatedGraphicDate);
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $graphicLog->getSKU());
	
			$graphicType = $graphicLog->getGraphicType();
			if(!empty($graphicType)){
			    $graphicType = GraphicType::getValue($graphicType);
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$graphicType);
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$graphicLog->getTagType());
				
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
			
				
			$chinaOfficeEntryDate = $graphicLog->getChinaOfficeEntryDate();
			if(!empty($chinaOfficeEntryDate)){
				$chinaOfficeEntryDate = self::getDateStr($chinaOfficeEntryDate);
			}
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $chinaOfficeEntryDate);
			
			
			$finalGraphicsDueDate = $graphicLog->getFinalGraphicsDueDate();
			if(!empty($finalGraphicsDueDate)){
			    $finalGraphicsDueDate = self::getDateStr($finalGraphicsDueDate);
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $finalGraphicsDueDate);
				
			$confirmedPOShipDate = $graphicLog->getConfirmedPOShipDate();
			if(!empty($confirmedPOShipDate)){
				$confirmedPOShipDate = self::getDateStr($confirmedPOShipDate);
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $confirmedPOShipDate);
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $graphicLog->createdbyfullname);

			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $graphicLog->enteredbyfullname);
				
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $graphicLog->getGraphicLength());
			
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $graphicLog->getGraphicWidth());
			
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $graphicLog->getGraphicHeight());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $graphicLog->getChinaNotes());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $graphicLog->graphicartistfullname);
			
			$graphicArtistStartDate = $graphicLog->getGraphicArtistStartDate();
			if(!empty($graphicArtistStartDate)){
			    $graphicArtistStartDate = self::getDateStr($graphicArtistStartDate);
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $graphicArtistStartDate);
			
			$graphicStatus = $graphicLog->getGraphicStatus();
			if(!empty($graphicStatus)){
			    $graphicStatus = GraphicStatusType::getValue($graphicStatus);
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $graphicStatus);
			
			$graphicCompletionDate = $graphicLog->getGraphicCompletionDate();
			if(!empty($graphicCompletionDate)){
			    $graphicCompletionDate = self::getDateStr($graphicCompletionDate);
			}
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $graphicCompletionDate);
			
			$approxGraphicsChinaSentDate = $graphicLog->getApproxGraphicsChinaSentDate();
			if(!empty($approxGraphicsChinaSentDate)){
			    $approxGraphicsChinaSentDate = self::getDateStr($approxGraphicsChinaSentDate);
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $approxGraphicsChinaSentDate);
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$graphicLog->getDuration());
			$draftDate = $graphicLog->getDraftDate();
			if(!empty($draftDate)){
			    $draftDate = self::getDateStr($draftDate);
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $draftDate);
			
			$buyerReviewDate = $graphicLog->getBuyerReviewReturnDate();
			if(!empty($buyerReviewDate)){
			    $buyerReviewDate = self::getDateStr($buyerReviewDate);
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $buyerReviewDate);
			
			$managerReviewDate = $graphicLog->getManagerReviewReturnDate();
			if(!empty($managerReviewDate)){
			    $managerReviewDate = self::getDateStr($managerReviewDate);
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $managerReviewDate);
			
			$robbyReviewReturnDate = $graphicLog->getRobbyReviewDate();
			if(!empty($robbyReviewReturnDate)){
			    $robbyReviewReturnDate = self::getDateStr($robbyReviewReturnDate);
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $robbyReviewReturnDate);
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $graphicLog->getGraphicsToChinaNotes());
	
			$count++;
			$i = 0;
		}
		$objPHPExcel->getActiveSheet()->setTitle("Graphic Logs");
		$objPHPExcel->setActiveSheetIndex(0)->getStyle("A1:L1")
		->getFill()
		->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
		->getStartColor()
		->setRGB('b3f0ff');
		$objPHPExcel->getActiveSheet()->setTitle("Graphic Logs");
		$objPHPExcel->setActiveSheetIndex(0)->getStyle("A2:L2")
		->getFill()
		->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
		->getStartColor()
		->setRGB('b3f0ff');
		$objPHPExcel->setActiveSheetIndex(0)->getStyle("M1:T1")
		->getFill()
		->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
		->getStartColor()
		->setRGB('ffbf80');
		$objPHPExcel->getActiveSheet()->setTitle("Graphic Logs");
		$objPHPExcel->setActiveSheetIndex(0)->getStyle("M2:T2")
		->getFill()
		->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
		->getStartColor()
		->setRGB('ffbf80');
		$objPHPExcel->setActiveSheetIndex(0)->getStyle("U1:AF1")
		->getFill()
		->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
		->getStartColor()
		->setRGB('e6b3b3');
		$objPHPExcel->getActiveSheet()->setTitle("Graphic Logs");
		$objPHPExcel->setActiveSheetIndex(0)->getStyle("U2:AF2")
		->getFill()
		->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
		->getStartColor()
		->setRGB('e6b3b3');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
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
		header("Content-Disposition: attachment;filename=".$fileName.".xls");
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
		$toDate->modify("+14 days");
		$fromDateStr = $fromDate->format("n/j/y");
		$toDateStr = $toDate->format("n/j/y");
		foreach($pendingSchedules as $notificationType=>$qcSchedules){
		    $notificationTypeTitle = $notificationType;
		    if($notificationName == StringConstants::UPCOMING_INSPECTIONS){
		        $notificationTypeTitle = str_replace("Scheduled", "", $notificationTypeTitle);
		    }
			$colval = "$notificationTypeTitle due in next 14 days ($fromDateStr to $toDateStr)";
			if($notificationName == StringConstants::MISSING_INSPECTION_APPOINTMENT){
				$colval = "Missing $notificationType";
			}else if($notificationName == StringConstants::INCOMPLETED_SCHEDULES){
				$colval = "Late $notificationType PO Report";
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
					
			// $colName = $alphas[$i++]. $count;
			// $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "PO Incharge");
			// $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);

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
			if($notificationName != StringConstants::UPCOMING_INSPECTIONS ){
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
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $qcSchedule->qccode);
					
					// $colName = $alphas[$i++]. $count;
					// $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $qcSchedule->poqccode);

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

public static function exportEmailLogs($emailLogs){
    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getProperties()->setCreator("Admin")
    ->setLastModifiedBy("Admin")
    ->setTitle("EmailLogs")
    ->setSubject("EmailLogs")
    ->setDescription("EmailLogs")
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Report");
    $alphas = range('A', 'Z');
    $alphas = ExportUtil::createColumnsArray("AE");
    $count = 1;
    $i = 0;
    $colName = $alphas[$i++]. $count;
    $firstRowColName = $colName;
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "FullName");
    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
    
    $colName = $alphas[$i++]. $count;
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "LogType");
    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
    
    $colName = $alphas[$i++]. $count;
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,"Emailid");
    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
    
    $colName = $alphas[$i++]. $count;
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "SendOn");
    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
    
    $colName = $alphas[$i++]. $count;
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "SentOn");
    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
    
    $colName = $alphas[$i++]. $count;
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Failure Message");
    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
    
    $colName = $alphas[$i++]. $count;
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Attempts");
    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
    
    $fromformatWithTime = "Y-m-d H:i:s";
    $toFormatWithTime= "n/j/y h:i a";
    
    $fromformat = "Y-m-d";
    $toFormat = "n/j/y";
    
    
    $lastRowColName = $colName;
    $objPHPExcel->getActiveSheet()->getStyle($firstRowColName.":" . $lastRowColName)->getFont()->setBold(true);
    $styleArray = array(
        'font'  => array(
            'bold'  => true,
            'color' => array('rgb' => 'FFFFFFFF'),
        ));
    $objPHPExcel->setActiveSheetIndex(0)->getStyle("A1:N1")->applyFromArray($styleArray);
    
    $objPHPExcel->setActiveSheetIndex(0)->getStyle("A1:N1")
    ->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()
    ->setRGB('000000');
    
    $objPHPExcel->setActiveSheetIndex(0)->getStyle("O1:R1")
    ->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()
    ->setRGB('87cefa');
    
    $objPHPExcel->setActiveSheetIndex(0)->getStyle("S1:AE1")
    ->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()
    ->setRGB('daa520');
    $i = 0;
    $count++;
    $srNo = 1;
    $top_vertical = PHPExcel_Style_Alignment::VERTICAL_TOP;
    $sheet = $objPHPExcel->setActiveSheetIndex(0);
    $sheet->getRowDimension('1')->setRowHeight(32);
    $sheet->getStyle("A1:AE1")->getAlignment()->applyFromArray(
        array("vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER)
        );;
        
        if(!empty($emailLogs)){
            foreach ($emailLogs as $emailLog){
                //$containerSchedule = new ContainerSchedule();
                
                
                $colName = $alphas[$i++]. $count;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$emailLog['fullname']);
                self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
                
                
                $colName = $alphas[$i++]. $count;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$emailLog['logtype']);
                self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
                
                
                $colName = $alphas[$i++]. $count;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$emailLog['emailid']);
                self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
                
                $colName = $alphas[$i++]. $count;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$emailLog['sendon']);
                self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
                
                $colName = $alphas[$i++]. $count;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$emailLog['senton']);
                self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
              
                $colName = $alphas[$i++]. $count;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$emailLog['failuremsg']);
                self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
             
                $colName = $alphas[$i++]. $count;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$emailLog['attempts']);
                self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
                
                
        $count++;
        $i = 0;
        $srNo++;
      }
    }else{
            $colName = $alphas[$i++]. $count;
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "No Rows Found");
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells($colName . ":I" .$count);
        }
        $objPHPExcel->getActiveSheet()->setTitle("Email Logs");
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
        header('Content-Disposition: attachment;filename="EmailLogs.xls"');
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

 public static function exportContainerSchedules($containerSchedules,$fileName,$isEmail = false){
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("Admin")
	->setLastModifiedBy("Admin")
	->setTitle("ContainerSchedules")
	->setSubject("ContainerSchedules")
	->setDescription("ContainerSchedules")
	->setKeywords("office 2007 openxml php")
	->setCategory("Report");
	$alphas = range('A', 'Z');
	$alphas = ExportUtil::createColumnsArray("AJ");
	$count = 1;
	$i = 0;
	$colName = $alphas[$i++]. $count;
	$firstRowColName = $colName;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "AWU Ref");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);

	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Trucker Name");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);

	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,"Trans");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);

	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Container");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);

	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "ETA");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);

	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Terminal");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);

	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "ETA Notes");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Terminal Appointment");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "LFD Pickup");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Empty Scheduled Pickup Date");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Empty LFD");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Custom Exam Terminal");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Customer Exam Status");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Empty Return Date");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Empty Return Notes");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	//Blue Fields
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Scheduled Delivery");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Confirmed Delivery");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Delivery Gate");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Warehouse");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Hot Container");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Hot Container Notes");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Alpine Notif. Pickup Date");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Alpine Pickup Notes");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	//Yellow Fields
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Container Docs Path");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "IDs Complete");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Is Samples Received");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Sample Received Date");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "MSRF Created");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Is Container Received in OMS");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Container Received in OMS Date");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Is Sample Received in OMS");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Sample Received in OMS Date");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Is Container Received in WMS");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Container Received in WMS Date");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$colName = $alphas[$i++]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Is Sample Received in WMS");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$colName = $alphas[$i]. $count;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Sample Received in WMS Date");
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);
	
	$fromformatWithTime = "Y-m-d H:i:s";
	$toFormatWithTime= "n/j/y h:i a";
		
	$fromformat = "Y-m-d";
	$toFormat = "n/j/y";
		
	
	$lastRowColName = $colName;
	$objPHPExcel->getActiveSheet()->getStyle($firstRowColName.":" . $lastRowColName)->getFont()->setBold(true);
	$styleArray = array(
			'font'  => array(
					'bold'  => true,
					'color' => array('rgb' => 'FFFFFFFF'),
			));
	$objPHPExcel->setActiveSheetIndex(0)->getStyle("A1:O1")->applyFromArray($styleArray);
	
	$objPHPExcel->setActiveSheetIndex(0)->getStyle("A1:O1")
	->getFill()
	->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	->getStartColor()
	->setRGB('000000');
	
	$objPHPExcel->setActiveSheetIndex(0)->getStyle("P1:W1")
	->getFill()
	->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	->getStartColor()
	->setRGB('87cefa');
	
	$objPHPExcel->setActiveSheetIndex(0)->getStyle("X1:AJ1")
	->getFill()
	->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	->getStartColor()
	->setRGB('daa520');
	$i = 0;
	$count++;
	$srNo = 1;
	$top_vertical = PHPExcel_Style_Alignment::VERTICAL_TOP;
	$sheet = $objPHPExcel->setActiveSheetIndex(0);
	$sheet->getRowDimension('1')->setRowHeight(32);
	$sheet->getStyle("A1:AI1")->getAlignment()->applyFromArray(
			array("vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER)
			);;
	if(!empty($containerSchedules)){
		foreach ($containerSchedules as $containerSchedule){
			//$containerSchedule = new ContainerSchedule();
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $containerSchedule->getAWUReference());
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $containerSchedule->getTruckerName());
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$containerSchedule->getTrans());
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
					
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $containerSchedule->getContainer());
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$containerSchedule->getEtaDateTime());
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $containerSchedule->getTerminal());
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $containerSchedule->getETANotes());
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			$terminalAppointmentDate = DateUtil::convertDateToFormat($containerSchedule->getTerminalAppointmentDateTime(),$fromformatWithTime,$toFormatWithTime);
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$terminalAppointmentDate);
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			$pickUpDate = DateUtil::convertDateToFormat($containerSchedule->getLFDPickupDate(),$fromformat,$toFormat);
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$pickUpDate);
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			$scheduleDeliveryDate = DateUtil::convertDateToFormat($containerSchedule->getEmptyScheduledPickUpDate(),$fromformat,$toFormat);
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$scheduleDeliveryDate);
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			$emptyLFDDate = DateUtil::convertDateToFormat($containerSchedule->getEmptyLfdDate(),$fromformat,$toFormat);
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$emptyLFDDate);
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $containerSchedule->getCustomExamTerminal());
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			$customExamStatus = "";
			if(!empty($containerSchedule->getCustomExamStatus())){
			    $customExamStatus = $containerSchedule->getCustomExamStatus();
			    $customExamStatus = CustomExamStatusType::getValue($customExamStatus);
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customExamStatus);
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			$emptyReturnDate = DateUtil::convertDateToFormat($containerSchedule->getEmptyReturnDate(),$fromformat,$toFormat);
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$emptyReturnDate);
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $containerSchedule->getEmptyNotes());
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $containerSchedule->getScheduledDeliveryDateTime());
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$containerSchedule->getConfirmedDeliveryDateTime());
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$containerSchedule->getDeliveryGate());
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $containerSchedule->getWarehouse());
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			$hotContainer = "NO";
			if(!empty($containerSchedule->getIsHotContainer())){
			    $hotContainer = "YES";
			}
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $hotContainer);
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$containerSchedule->getHotNotes());
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);

			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$containerSchedule->getAlpineNotificatinPickupDateTime());
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$containerSchedule->getNotificationNotes());
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$containerSchedule->getContainerdocsPath());
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			$colName = $alphas[$i++]. $count;
			$idCompleted = "No";
			if(!empty($containerSchedule->getIsIdsComplete())){
				$idCompleted = "Yes";
			}
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$idCompleted);
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			$colName = $alphas[$i++]. $count;
			$sampleteReceived = "No";
			if(!empty($containerSchedule->getIsSamplesReceived())){
				$sampleteReceived = "Yes";
			}
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$sampleteReceived);
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			$sampleteReceivedDate = DateUtil::convertDateToFormat($containerSchedule->getSamplesReceivedDate(),$fromformat,$toFormat);
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$sampleteReceivedDate);
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			$smsrfCreatedDate = DateUtil::convertDateToFormat($containerSchedule->getMsrfCreatedDate(),$fromformat,$toFormat);
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$smsrfCreatedDate);
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			$colName = $alphas[$i++]. $count;
			$containerReceivedInOms = "No";
			if(!empty($containerSchedule->getIsContainerReceivedinOMS())){
				$containerReceivedInOms = "Yes";
			}
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$containerReceivedInOms);
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			$containerReceivedOmsDate = DateUtil::convertDateToFormat($containerSchedule->getContainerReceivedinOMSDate(),$fromformat,$toFormat);
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$containerReceivedOmsDate);
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			$colName = $alphas[$i++]. $count;
			$sampleReceivedInOms = "No";
			if(!empty($containerSchedule->getIssamplesReceivedinOMS())){
				$sampleReceivedInOms = "Yes";
			}
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$sampleReceivedInOms);
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
				
			$sampleReceivedOmsDate = DateUtil::convertDateToFormat($containerSchedule->getSamplesReceivedinOMSDate(),$fromformat,$toFormat);
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$sampleReceivedOmsDate);
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			
			$colName = $alphas[$i++]. $count;
			$containerReceivedInWms = "No";
			if(!empty($containerSchedule->getIsContainerReceivedinWMS())){
				$containerReceivedInWms = "Yes";
			}
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$containerReceivedInWms);
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
				
			$containerReceivedWmsDate = DateUtil::convertDateToFormat($containerSchedule->getContainerReceivedinWMSDate(),$fromformat,$toFormat);
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$containerReceivedWmsDate);
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
				
			$colName = $alphas[$i++]. $count;
			$sampleReceivedInWms = "No";
			if(!empty($containerSchedule->getIssamplesReceivedinWMS())){
				$sampleReceivedInWms = "Yes";
			}
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$sampleReceivedInWms);
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			$sampleReceivedWmsDate = DateUtil::convertDateToFormat($containerSchedule->getSamplesReceivedinWMSDate(),$fromformat,$toFormat);
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$sampleReceivedWmsDate);
			self::setCellAligment(self::$VERTICAL,$top_vertical,$sheet,$colName);
			
			$count++;
			$i = 0;
			$srNo++;
		}
	}else{
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "No Rows Found");
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($colName . ":I" .$count);
	}
	$objPHPExcel->getActiveSheet()->setTitle("ContainerSchedules");
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
	header("Content-Disposition: attachment;filename=" . $fileName . ".xls");
	header('Cache-Control: max-age=0');
	// If you're serving to IE 9, then the following may be needed
	header('Cache-Control: max-age=1');

	// If you're serving to IE over SSL, then the following may be needed
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: public'); // HTTP/1.0
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	if (ob_get_contents()) ob_end_clean();
	$objWriter->save('php://output');
}

private static function setCellAligment($type,$aligmentDirection,$sheet,$colName){
	$sheet->getStyle($colName)->getAlignment()->applyFromArray(
			array($type => $aligmentDirection,)
			);
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
		
		// $colName = $alphas[$i++]. $count;
		// $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "PO Incharge");
		// $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alphas[$i])->setAutoSize(true);

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
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $qcSchedule->qccode);
				
				// $colName = $alphas[$i++]. $count;
				// $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $qcSchedule->poqccode);

				$colName = $alphas[$i++]. $count;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $qcSchedule->classcode);
					
				$colName = $alphas[$i++]. $count;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$qcSchedule->getPO());
					
				$colName = $alphas[$i++]. $count;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $qcSchedule->getPOType());
					
				$colName = $alphas[$i++]. $count;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $qcSchedule->getItemNumbers());
				$finalInspectionDateStr = $qcSchedule->getACFinalInspectionDate();
				if(!empty($finalInspectionDateStr)){
				    $finalInspectionDate = DateUtil::StringToDateByGivenFormat("Y-m-d", $qcSchedule->getACFinalInspectionDate());
				    $finalInspectionDateStr = $finalInspectionDate->format("n/j/y");
				}
				$colName = $alphas[$i++]. $count;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$finalInspectionDateStr);
				$appliedOnDateStr = $qcSchedule->appliedon;
				if(!empty($appliedOnDateStr)){
    				$appliedOnDate = DateUtil::StringToDateByGivenFormat("Y-m-d H:i:s", $qcSchedule->appliedon);
    				$appliedOnDateStr = $appliedOnDate->format("n/j/y");
				}
				$colName = $alphas[$i++]. $count;
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
private static $default_style = array(
   'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => 'AAAAAA')
        )
    )
);
public static function exportQcPlannerReport($data, $isEmail)
{
    $qcSchedules = $data["data"];
    $dates = $data["dates"];
    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getProperties()
    ->setCreator("Admin")
    ->setLastModifiedBy("Admin")
    ->setTitle("QCPlan")
    ->setSubject("QCPlan")
    ->setDescription("QCPlan")
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Report");
    $alphas = $alphas = ExportUtil::createColumnsArray("ZZ");
    ;
    $count = 1;
    $i = 0;
    $colName = $alphas[$i ++] . $count;
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "QC");
    $objPHPExcel->getActiveSheet()
    ->getStyle($colName)
    ->getFont()
    ->setBold(true);
    $c = 0;
    $grandTotal = 0;
    if(! empty($qcSchedules)) {
        foreach ($qcSchedules as $key => $qcScheduleArr) {
            $rowTotal = 0;
            $i = 1;
            foreach ($dates as $date){
                $al = $alphas[$i];
                if ($count == 1) {
                    $colName = $alphas[$i] . $count;
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, date("m/d/Y",$date));
                    $objPHPExcel->getActiveSheet()
                    ->getStyle($colName)
                    ->getFont()
                    ->setBold(true);
                    $objPHPExcel->setActiveSheetIndex(0)
                    ->getColumnDimension($al)
                    ->setAutoSize(true);
                }
                $value = "";
                $c = $count + 1;
                $countCol = $alphas[$i++] . $c;
                if (array_key_exists($date, $qcScheduleArr)) {
                    $value = $qcScheduleArr[$date];
                    $rowTotal += $value;
                }else{
                    $objPHPExcel->getActiveSheet(0)
                    ->getStyle($countCol)->applyFromArray(ExportUtil::$default_style);
                    $objPHPExcel->setActiveSheetIndex(0)
                    ->getStyle($countCol)
                    ->getFill()
                    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setRGB('FFFF99');
                }
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($countCol, $value);
                
            }
            if ($count == 1) {
                $colName = $alphas[$i] . $count;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Grand total");
                $objPHPExcel->getActiveSheet()
                ->getStyle($colName)
                ->getFont()
                ->setBold(true);
                $objPHPExcel->setActiveSheetIndex(0)
                ->getColumnDimension($alphas[$i])
                ->setAutoSize(true);
            }
            
            $countCol = $alphas[$i] . $c;
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($countCol, $rowTotal);
            $grandTotal += $rowTotal;
            //$i = 0;
            //$count ++;
            $colName = $alphas[0] . $c;
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $key);
            $count ++;
            //$i = 1;
        }
        $count++;
        $colName = $alphas[$i] . $count;
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $grandTotal);
        $i = 0;
        $objPHPExcel->setActiveSheetIndex(0)
        ->getColumnDimension($alphas[$i])
        ->setAutoSize(true);
        $objPHPExcel->getActiveSheet()
        ->getStyle($colName)
        ->getFont()
        ->setBold(true);
                    $colName = $alphas[$i++] . $count;
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Grand Total");
                    $objPHPExcel->getActiveSheet()
                    ->getStyle($colName)
                    ->getFont()
                    ->setBold(true);
                    ExportUtil::setSumOfColumns($alphas,$objPHPExcel->setActiveSheetIndex(0));
        
    } else {
        $colName = $alphas[$i ++] . $count;
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "No Rows Found");
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells($colName . ":I" . $count);
    }
    $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(32);
    $firstRow = 'A1:'.$objPHPExcel->getActiveSheet()->getHighestColumn().'1';
    $highestRow = $objPHPExcel->getActiveSheet()->getHighestRow();
    $lastRow = 'A'.$highestRow.':' .$objPHPExcel->getActiveSheet()->getHighestColumn().$highestRow;
    $objPHPExcel->getActiveSheet()->getStyle($firstRow)->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()
    ->setRGB('CCE5FF');
    $objPHPExcel->getActiveSheet()->getStyle($lastRow)->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()
    ->setRGB('D3D3D3');
    $objPHPExcel->getActiveSheet()
    ->getStyle($lastRow)
    ->getFont()
    ->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle($firstRow)->applyFromArray(ExportUtil::$default_style);
    $objPHPExcel->getActiveSheet();
    
    $objPHPExcel->getActiveSheet()->setTitle("QCPlan");
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()
    ->getColumnDimension('H')
    ->setWidth(20);
    $objPHPExcel->getActiveSheet()
    ->getStyle('H1:H' . $objPHPExcel->getActiveSheet()
        ->getHighestRow())
        ->getAlignment()
        ->setWrapText(true);
        $objPHPExcel->getActiveSheet()
        ->getColumnDimension('I')
        ->setWidth(20);
        $objPHPExcel->getActiveSheet()
        ->getStyle('I1:I' . $objPHPExcel->getActiveSheet()
            ->getHighestRow())
            ->getAlignment()
            ->setWrapText(true);
            
            if ($isEmail) {
                ob_start();
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                $objWriter->save('php://output');
                $excelOutput = ob_get_contents();
                ob_end_clean();
                return $excelOutput;
            }
            // Redirect output to a client’s web browser (Excel5)
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="QC_PLAN.xls"');
            header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');
            
            // If you're serving to IE over SSL, then the following may be needed
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            if (ob_get_contents()) ob_end_clean();
            $objWriter->save('php://output');
}


private static function setSumOfColumns($alphas,$sheet){
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        for ($col = 1; $col < $highestColumnIndex-1; ++ $col) {
            $val = [];
            for ($row = 2; $row <= $highestRow; ++ $row) {
                $cell = $sheet->getCellByColumnAndRow($col, $row);
                $val[] = $cell->getValue();
            }
        $colTotal = array_sum($val);
        $r = $row - 1;    
        $colName = $alphas[$col].$r;
        $sheet->setCellValue($colName, $colTotal);
    }
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