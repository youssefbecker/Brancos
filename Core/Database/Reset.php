<?php
/**
 * Created by PhpStorm.
 * User: Ndjeunou
 * Date: 23/01/2017
 * Time: 10:15
 */

namespace Projet\Database;


use Projet\Model\Table;

class Reset extends Table{

    protected static $table = 'reset';

    public static function save($email,$token){
        $sql = 'INSERT INTO '.self::getTable().' SET email = :email, token = :token';
        $param = [':email'=>$email,':token'=>$token];
        return self::query($sql,$param,true,true);
    }

    public static function isExist($email){
        return self::query(self::selectString().' WHERE email= :email',[':email'=>$email],true);
    }

    public static function update($email,$token,$date){
        $sql = 'UPDATE '.self::getTable().' SET token = :token,created_at = :date WHERE email = :email';
        $param = [':email'=>$email,':token'=>$token,':date'=>$date];
        return self::query($sql,$param,true,true);
    }


}