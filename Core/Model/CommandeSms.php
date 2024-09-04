<?php
/**
 * Created by PhpStorm.
 * User: Ross
 * Date: 8/31/2018
 * Time: 4:45 PM
 */

namespace Projet\Model;


class CommandeSms extends Table
{
    public static function save($idUser,$quantite){
        $sql = 'INSERT INTO  '.self::getTable().' SET id_entreprise = :id_entreprise, quantite = :quantite';
        $param = [':id_entreprise'=>$idUser,':quantite'=>$quantite];
        return self::query($sql, $param, true, true);
    }
}