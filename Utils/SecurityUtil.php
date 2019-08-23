<?php
  class SecurityUtil{

    private static $secretPass ="Munish#3525";
    
    public static function Decode($data){
        $decoded =  self::Encoder(self::hex2bin($data),self::$secretPass);
        return $decoded;
    }
    //passs real text and get back an ecoded string
    public static function Encode($data){
        $encoded = bin2hex(self::Encoder($data,self::$secretPass));
        return $encoded;
    }
    
    private static function Encoder($data,$pwd)
    {
        
        $pwd_length = strlen($pwd);
        for ($i = 0; $i < 255; $i++) {
            $key[$i] = ord(substr($pwd, ($i % $pwd_length)+1, 1));
            $counter[$i] = $i;
        }
        $x = 0;
        for ($i = 0; $i < 255; $i++) {
            $x = ($x + $counter[$i] + $key[$i]) % 256;
            $temp_swap = $counter[$i];
            $counter[$i] = $counter[$x];
            $counter[$x] = $temp_swap;
        }
        $a = 0;
        $j = 0;
        $Zcrypt = "";
        for ($i = 0; $i < strlen($data); $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $counter[$a]) % 256;
            $temp = $counter[$a];
            $counter[$a] = $counter[$j];
            $counter[$j] = $temp;
            $k = $counter[(($counter[$a] + $counter[$j]) % 256)];
            $Zcipher = ord(substr($data, $i, 1)) ^ $k;
            $Zcrypt .= chr($Zcipher);
        }
        return $Zcrypt;
    }
    
    private static function hex2bin($hexdata) {
        $bindata = "";
        for  ($i=0;$i<strlen($hexdata);$i+=2) {
            $bindata.=chr(hexdec(substr($hexdata,$i,2)));
        }
        return $bindata;
    }
    public static function encrypt( $q ) {
    	$cryptKey  = self::$secretPass;
    	$qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    	return( $qEncoded );
    }
    
    public static function decrypt( $q ) {
    	$cryptKey  = self::$secretPass;
    	$qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    	return( $qDecoded );
    }

  }
?>
