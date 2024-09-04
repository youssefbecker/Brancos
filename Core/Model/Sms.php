<?php
/**
 * Created by PhpStorm.
 * User: Poizon
 * Date: 27/07/2015
 * Time: 12:12
 */

namespace Projet\Model;


class Sms {

    private static $login = '693381374';
    private static $password = 'BRIDGE';
    private static $adminLogin = '695688207';
    private static $adminPassword = '123';

    public static function sendSms($number,$message,$sender){
        $message = urlencode($message);
        $sender = urlencode($sender);
        $url = 'https://sms.etech-keys.com/ss/api.php?login='.self::$login.'&password='.self::$password.'&sender_id='.$sender.'&destinataire='.$number.'&message='.$message;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $return = curl_exec($ch);
        curl_close($ch);
        return $return;
    }

    public static function newCustomer($nom,$numero,$password,$email){
        $nom = urlencode($nom);
        $numero = urlencode($numero);
        $password = urlencode($password);
        $email = urlencode($email);
        $url = 'http://sms.etech-keys.com/ss/api_creation_utilisateur.php?adminlogin='.self::$adminLogin.'&adminpassword='.self::$adminLogin.'&username=compte'.$nom.'&userlogin='.$numero.'&userpassword='.$password.'&mail='.$email;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $return = curl_exec($ch);
        curl_close($ch);
        return $return;
    }

    public static function getHistorique($numero,$password,$nbre){
        $numero = urlencode($numero);
        $password = urlencode($password);
        $nbre = urlencode($nbre);
        $url = 'https://sms.etech-keys.com/ss/api_transaction.php?login='.$numero.'&password='.$password.'&qte='.$nbre;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $return = curl_exec($ch);
        curl_close($ch);
        return $return;
    }

    public static function getSolde($numero,$password){
        $numero = urlencode($numero);
        $password = urlencode($password);
        $url = 'https://sms.etech-keys.com/ss/api_credit.php?login='.$numero.'&password='.$password;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $return = curl_exec($ch);
        curl_close($ch);
        return $return;
    }

    public static function resultSms($number,$message,$sender){
        return is_numeric(self::sendSms($number,$message,$sender));
    }

    public static function sendApi($login,$password,$number,$message,$sender){
        $message = urlencode($message);
        $sender = urlencode($sender);
        $url = 'https://sms.etech-keys.com/ss/api.php?login='.$login.'&password='.$password.'&sender_id='.$sender.'&destinataire='.$number.'&message='.$message;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $return = curl_exec($ch);
        curl_close($ch);
        return $return;
    }

    public static function resultSmsApi($login,$password,$number,$message,$sender){
        return is_numeric(self::sendApi($login,$password,$number,$message,$sender));
    }

    public static function resultApi($login,$password,$number,$message,$sender){
        return is_numeric(self::sendApi($login,$password,$number,$message,$sender));
    }

}