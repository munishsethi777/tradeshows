<?php
require_once($ConstantsArray['dbServerUrl'] ."Utils/MailUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SecurityUtil.php");
class ForgotPasswordUtil{
    
    public static function sendForgotPasswordEmail($user){
        $email = $user->getEmail();
        $encryptedEmail = SecurityUtil::Encode($email);
       // $url = "http://localhost/tradeshows/resetPassword.php?$encryptedEmail";
        $url = StringConstants::WEB_PORTAL_LINK . "/resetPassword.php?id=$encryptedEmail";
        $phValuesArr = array("FOGOT_PASSWORD_LINK"=>$url);
        $content = file_get_contents("../ForgotPasswordEmailTemplate.php");
        $content = self::replacePlaceHolders($phValuesArr, $content);
        $subject = "ALPINE BI | Recover Password";
        return MailUtil::sendSmtpMail($subject, $content, array($email), true);
    }
    
    private static function replacePlaceHolders($placeHolders,$body){
        foreach ($placeHolders as $key=>$value){
            $placeHolder = "{".$key."}";
            $body = str_replace($placeHolder, $value, $body);
        }
        return $body;
    }
}