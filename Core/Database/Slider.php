<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 07/06/2017
 * Time: 12:46
 */

namespace Projet\Database;


use Projet\Model\Table;

class Slider extends Table
{
    protected static $table = 'slider';

    public static function save($photo,$text1,$text2,$id=null){
        if(isset($id)){
            $sql = 'UPDATE '.self::getTable().' SET text1 = :text1, text2 = :text2,image = :image WHERE id = :id';
            $param = [':text1'=>$text1,':text2'=>$text2,':image'=>$photo,':id'=>$id];

        }else{
            $sql = 'INSERT INTO '.self::getTable().' SET text1 = :text1, text2 = :text2,image = :image';
            $param = [':text1'=>$text1,':text2'=>$text2,':image'=>$photo];

        }
        return self::query($sql,$param,true,true);
    }
    public static function setImage($image,$id){
        $sql = 'UPDATE  '.self::getTable().' SET image = :fichier WHERE id = :id';
        $param = [':fichier'=>$image,':id'=>$id];
        return self::query($sql,$param,true,true);
    }

}