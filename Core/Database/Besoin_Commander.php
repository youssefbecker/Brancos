<?php
/**
 * Created by PhpStorm.
 * User: Poizon
 * Date: 20/10/2015
 * Time: 20:20
 */

namespace Projet\Database;


use Projet\Model\Table;

class Besoin_Commander extends Table{
    protected static $table = 'besoin_commander';

    public static function save($idBesoin,$idCommander){
        $sql = 'INSERT INTO ';
        $baseSql = self::getTable().' SET idBesoin = :idBesoin, idCommander = :idCommander';
        $param = [':idBesoin'=>$idBesoin,':idCommander'=>$idCommander];
        return self::query($sql.$baseSql,$param,true,true);
    }

}