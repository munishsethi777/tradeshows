<?php
  include("resize-class.php");
  class ImageUtil{
    public static function uploadImage($path,$imgSource,$orgImageSource,$seq){
        $img = $imgSource;
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $pos  = strpos($imgSource, ';');
        $type = explode(':image/', substr($imgSource, 0, $pos))[1];
        $imageName = $seq . ".$type";
        $file = $path . $imageName; 
        $uploaded = file_put_contents($file, $data);
        if(!empty($orgImageSource)){            
	        $img = $orgImageSource;
	        $img = str_replace('data:image/', '', $img);
	        $ext  = strtok($img, ';');
	        $img = str_replace($ext . ';base64,', '', $img);
	        $img = str_replace(' ', '+', $img);
	        $data = base64_decode($img);
	        $file = $path . $seq . "_org" . ".$type" ; 
	        $uploaded = file_put_contents($file, $data);
        }
        return  $imageName;
    }
    public static function uploadUserImage($file,$userSeq,$uploaddir){
	    	$filename = $userSeq .".png";
	    	$source = $uploaddir . $filename;
	    	$fileName = FileUtil::uploadImageFiles($file,$uploaddir,$filename);
	    	$fileName = ImageUtil::resizeImageAndUpload($source, $userSeq, $uploaddir);
	    	return $fileName;
    }
    
    public static function resizeImageAndUpload($sourcePath,$userSeq,$uploaddir){
    	// *** 1) Initialise / load image
	    	$resizeObj = new resize($sourcePath);
	    	
	    	// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
	    	$resizeObj -> resizeImage(300, 300, 'crop');
	    	
	    	// *** 3) Save image
	    	$filename = $userSeq .".png";
	    	$source = $uploaddir . $filename;
	    	$resizeObj -> saveImage($source);
	    	return $filename;
    }
    public static function getUserImagePath($userSeq){
    	$path = StringConstants::ROOT_PATH."images/UserImages/" . $userSeq . ".png";
    	if(!file_exists ($path)){
    		$path = "images/dummy.jpg";
    	}else{
    		$path = "images/UserImages/" . $userSeq . ".png";
    	}
    	return $path;
    }
    public static function getAdminImagePath($adminSeq){
    	$path = StringConstants::ROOT_PATH."images/AdminImages/" . $adminSeq . ".png";
    	if(!file_exists ($path)){
    		$path = "images/dummy.jpg";
    	}else{
    		$path = "images/AdminImages/" . $adminSeq . ".png";
    	}
    	return $path;
    }
    public static function getModuleImagePath($moduleSeq){
    	$imagePath = StringConstants::ROOT_PATH."images/modules/" . $moduleSeq. ".jpg";
    	if(!file_exists ($imagePath)){
    		return "images/modules/dummy.jpg";
    	}else{
    		return "images/modules/" . $moduleSeq. ".jpg";
    	}
    	
    }
    
    public static function getModuleImageName($imageName){
    	$imagePath = StringConstants::ROOT_PATH."images/modules/" . $imageName;
    	if(file_exists ($imagePath)){
    		return $imageName;
    	}else{
    		return "";
    	}
    }
    
    public static function getEventImagePath($eventSeq){
    	$imagePath = "../images/eventimages/" . $eventSeq. ".jpg";
    	if(!file_exists ($imagePath)){
    		return "images/eventimages/dummy.jpg";
    	}else{
    		return "images/eventimages/" . $eventSeq. ".jpg";
    	}
    	 
    }
    
    public static function downloadJpg($empName,$empCode,$moduleName,$dataofPlay){
          // Create a blank image and add some text
          $text = 'Baljeet singh';
          //Set the Content Type
          header('Content-type: image/jpeg');
          $fileName = 'D:\\projects\\ezae\\httpdocs\\Images\\certificateDummy.jpg';
          $newfileName = 'D:\\projects\\ezae\\httpdocs\\Images\\certificate.jpg';
          // Create Image From Existing File
          $jpg_image = imagecreatefromjpeg($fileName);

          // Allocate A Color For The Text
          $white = imagecolorallocate($jpg_image, 0, 0, 0);

          // Set Path to Font File
          $font_path = 'D:\\projects\\ezae\\httpdocs\\verdana.ttf';

          // Set Text to Be Printed On Image
          $text = "This is to certify that $empName with employee $empCode has completed ";
          $text2 = "the training on $moduleName . ";
          $my_date = date('d/m/y H:i:s', strtotime($dataofPlay));
          $text3 = " Dated - $my_date";

          // Print Text On Image
          imagettftext($jpg_image, 15, 0, 75, 350, $white, $font_path, $text);
          imagettftext($jpg_image, 15, 0, 75, 400, $white, $font_path, $text2);
          imagettftext($jpg_image, 15, 0, 500, 570, $white, $font_path, $text3);
          
          
          // Send Image to Browser
          imagejpeg($jpg_image,$newfileName);

          // Clear Memory
          imagedestroy($jpg_image);
          if(file_exists($newfileName)){
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.urlencode("Certificate.jpg"));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($newfileName));
            ob_clean(); // not necessary
            flush();  // not necessary
            echo file_get_contents($newfileName); // or just use readfile($filename);
            
            exit;
        }
    }
    
    
    public  static function pdfToImage($fromPdfFilePath,$toImgFilePath,$format){
    	$im = new imagick($fromPdfFilePath);
    	$im->setImageFormat( $format );
    	$im->setSize(800,600);
    	$im->writeImage($toImgFilePath);
    	$im->clear();
    	$im->destroy();
    }
    
  }
?>