<?php
/**
 * Created by PhpStorm.
 * User: Poizon
 * Date: 30/07/2015
 * Time: 16:31
 */

namespace Projet\Model;


class Encrypt {

    private static $key = 'Projet';

    static function crypte($str_to_crypt) {
        /*$private_key = md5(self::$key);
        $letter = -1;
        $new_str = '';
        $strlen = strlen($str_to_crypt);

        for ($i = 0; $i < $strlen; $i++) {
            $letter++;
            if ($letter > 31) {
                $letter = 0;
            }
            $neword = ord($str_to_crypt{$i}) + ord($private_key{$letter});
            if ($neword > 255) {
                $neword -= 256;
            }
            $new_str .= chr($neword);
        }
        return urlencode(base64_encode($new_str));*/

        return $str_to_crypt;
    }

    static function decrypte($str_to_decrypt) {
        /*$private_key = md5(self::$key);
        $letter = -1;
        $new_str = '';
        $str_to_decrypt = base64_decode($str_to_decrypt);
        $strlen = strlen($str_to_decrypt);
        for ($i = 0; $i < $strlen; $i++) {
            $letter++;
            if ($letter > 31) {
                $letter = 0;
            }
            $neword = ord($str_to_decrypt{$i}) - ord($private_key{$letter});
            if ($neword < 1) {
                $neword += 256;
            }
            $new_str .= chr($neword);
        }
        return urldecode($new_str);*/
        return $str_to_decrypt;
    }

    static function GenerationCle($Texte,$CleDEncryptage)
    {
        $CleDEncryptage = md5($CleDEncryptage);
        $Compteur=0;
        $VariableTemp = "";
        for ($Ctr=0;$Ctr<strlen($Texte);$Ctr++)
        {
            if ($Compteur==strlen($CleDEncryptage))
                $Compteur=0;
            $VariableTemp.= substr($Texte,$Ctr,1) ^ substr($CleDEncryptage,$Compteur,1);
            $Compteur++;
        }
        return $VariableTemp;
    }
    static function crypter($Texte)
    {
        srand((double)microtime()*1000000);
        $CleDEncryptage = md5(rand(0,32000) );
        $Compteur=0;
        $VariableTemp = "";
        for ($Ctr=0;$Ctr<strlen($Texte);$Ctr++)
        {
            if ($Compteur==strlen($CleDEncryptage))
                $Compteur=0;
            $VariableTemp.= substr($CleDEncryptage,$Compteur,1).(substr($Texte,$Ctr,1) ^ substr($CleDEncryptage,$Compteur,1) );
            $Compteur++;
        }
        return base64_encode(self::GenerationCle($VariableTemp,self::$key) );
    }
    static function decrypter($Texte)
    {
        $Texte = self::GenerationCle(base64_decode($Texte),self::$key);
        $VariableTemp = "";
        for ($Ctr=0;$Ctr<strlen($Texte);$Ctr++)
        {
            $md5 = substr($Texte,$Ctr,1);
            $Ctr++;
            $VariableTemp.= (substr($Texte,$Ctr,1) ^ $md5);
        }
        return $VariableTemp;
    }

}