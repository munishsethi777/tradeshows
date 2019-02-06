<?php
 $docroot = $_SERVER["DOCUMENT_ROOT"];
  $ConstantsArray = array('dbServerUrl' => $docroot .'/tradeshows/'
    ,'imagefolderpath' => $docroot .'/tradeshows/images/'
    ,'docspath' => $docroot .'/tradeshows/docs/'
    ,'ImagePath' => $docroot .'/tradeshows/Images/menuImages/')
  ;
  $ConstantsArray['ApplicationURL'] = "http://localhost/tradeshows/";

  //$ConstantsArray = array('dbServerUrl' => '/home/satyain/public_html/giftcard/');
  //Logger::configure($ConstantsArray['dbServerUrl'] .'log4php/log4php.xml');
  $ConstantsArray['ApplicationURL'] = "http://localhost/tradeshows";
  $Log4PHP_MyDBLogger = "myDBLogger";
  $Log4PHP_MyMailerLogger = "myMailerLogger";
  $Log4PHP_MyFileLogger = "myFileLogger";
  $CUSTOM_FIELD_PREFIX = "cus_"

?>