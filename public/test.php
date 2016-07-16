<?php
class Security2 {
    public static function encrypt($input, $key) {

        //#Gm2014$06$30@97
        $size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
        $input = Security2::pkcs5_pad2($input, $size);
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_ECB, '');
        $iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        mcrypt_generic_init($td, $key, $iv);
        $data = mcrypt_generic($td, $input);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $data = base64_encode($data);
        return $data;
    }

    private static function pkcs5_pad2 ($text, $blocksize) {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    public static function decrypt($sStr, $sKey) {
        $decrypted= mcrypt_decrypt(
            MCRYPT_RIJNDAEL_128,
            $sKey,
            base64_decode($sStr),
            MCRYPT_MODE_ECB
        );
        $dec_s = strlen($decrypted);
        $padding = ord($decrypted[$dec_s-1]);
        $decrypted = substr($decrypted, 0, -$padding);
        return $decrypted;
    }
}



$datedata =  $_GET["value"];
$MEASecEncoe = new Security2();
// . substr($datedata, -4,2). ((int)substr($datedata, -8, 4)) + 543;

$newDate = substr($datedata, -2) . substr($datedata, -4,2) . (( (int)substr($datedata, -8, 4) )+543) ;
//$ecPass =  $MEASecEncoe->encrypt($newDate,"#Gm2014$06$30@97");






echo  $newDate;

//var_dump($output);
//$output = shell_exec("/backend/md5/md5.bat -e ss 2>&1");
////$output = shell_exec("./backend/md5/md5.sh -e ss 2>&1");
//////echo passthru("md5.bat");
//var_dump($output);
?>