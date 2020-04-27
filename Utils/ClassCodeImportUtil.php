<?php   
class ClassCodeImportUtil{
    private static $ccImportUtil;
    private $fieldNames;
    
    public static function getInstance(){
        if(!self::$ccImportUtil){
            self::$ccImportUtil = new ClassCodeImportUtil();
        }
        return self::$ccImportUtil;
    }
    public function importClassCodes($file){
        
        $inputFileName = $file['tmp_name'];
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        $sheet = $objPHPExcel->getActiveSheet();
        $maxCell = $sheet->getHighestRowAndColumn();
        $sheetData = $sheet->rangeToArray('A1:' . $maxCell['column'] . $maxCell['row'],null,true,false,false);
        try{
            return $this->validateAndSaveFile($sheetData);
        }catch(Exception $e){
            throw $e;
        }
    }
    public function validateAndSaveFile($sheetData){
        $labels = array();
        $messages = "";
        $success = 1;
        $importedDataArray = array();
        $ommited_updating_fields = array("createdon","classcode","isenabled");
        foreach($sheetData as $key => $data){
            if($key == 0){
                $labels = $data;
                continue;
            }
            $row = $key+2;
            try{
                $importedData = $this->getImportedData($data,$labels);
                array_push($importedDataArray,$importedData);
            } catch(Exception $e){
                $messages .= "Error on row no $row - " .
                $e->getMessage() . "<br>";
                $success = 0;
            }
            if(empty($importedData)){
                continue;
            }
        }
        $response = array();
        $response["message"] = $messages;
        $response["success"] = $success;
        $i = 0;
        if(!empty($importedDataArray)){
            foreach($importedDataArray as $importedData){
                $classCodeMgr = ClassCodeMgr::getInstance();
                $classCodeMgr->saveOrUpdateArr($importedData,$ommited_updating_fields);
            }
        }
        return $response;

    } public function getImportedData($data,$labels){
        $customcodearr = array();
        $customcodearr['vendorid'] = "'" .$data[array_search("Vendor Id",$labels)] . "'";
        $customcodearr['vendorname'] = "'".$data[array_search("Vendor Name",$labels)]."'";
        $customcodearr['classcode'] = "'".$data[array_search("Class Code",$labels)]."'";
        $customcodearr['email'] = "'".$data[array_search("Email",$labels)]."'";
        $customcodearr['contactname'] = "'".$data[array_search("Contact Name",$labels)]."'";
        $customcodearr['port'] = "'".$data[array_search("Port",$labels)]."'";
        $customcodearr['buyername'] = "'".$data[array_search("Buyers name",$labels)]."'";
        $customcodearr['buyeremail'] = "'".$data[array_search("Buyers email",$labels)]."'";
        $customcodearr['assistantbuyer'] = "'".$data[array_search("Assistant Buyer",$labels)]."'";
        $customcodearr['assistantbuyeremail'] = "'".$data[array_search("Assistant Buyer Email",$labels)]."'";
        $customcodearr['chinarepname'] = "'".$data[array_search("China Rep Name",$labels)]."'";
        $customcodearr['chinarepemail'] = "'".$data[array_search("China Rep Email",$labels)]."'";
        $newTime = new DateTime();
        $customcodearr['lastmodifiedon'] = $newTime->format('Y-m-d H:i:s');
        if(empty($data[array_search("Created On",$labels)])){
            $customcodearr['createdon'] = $newTime->format('Y-m-d H:i:s');
        }
        $customcodearr['isenabled'] = 1;
        return $customcodearr;


    }
    
}