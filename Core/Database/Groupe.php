<?php
/**
 * Created by PhpStorm.
 * Eleve: le marcelo
 * Date: 28/02/2017
 * Time: 12:32
 */

namespace Projet\Database;


use Projet\Model\Table;


class Groupe extends Table{

    protected static $table = 'groupe';

    public static function save($nom,$idClient,$id=null){
        $sql = 'INSERT INTO ';
        $baseSql = self::getTable().' SET idClient = :idClient,nom = :nom';
        $baseParam = [':idClient' => $idClient,':nom' => $nom];
        if(isset($id)){
            $sql = 'UPDATE ';
            $baseSql .= ' WHERE id = :id';
            $baseParam [':id'] = $id;
        }
        return self::query($sql.$baseSql, $baseParam, true, true);
    }

    public static function byNom($nom,$idClient){
        $sql = self::selectString() . ' WHERE nom = :nom AND idClient = :idClient';
        $param = [':nom' => $nom,':idClient' => $idClient];
        return self::query($sql, $param,true);
    }

    public static function countBySearch($idClient=null,$search=null){
        $count = 'SELECT COUNT(*) AS Total FROM '.self::getTable();
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($search)){
            $tDebut = ' AND nom like :nom';
            $tab[':nom'] = "%".$search."%";
        }else{
            $tDebut = '';
        }
        if(isset($idClient)){
            $tidClient = ' AND idClient = :idClient';
            $tab[':idClient'] = $idClient;
        }else{
            $tidClient = '';
        }
        return self::query($count.$where.$tDebut.$tidClient,$tab,true);
    }

    public static function search($nbreParPage=null,$pageCourante=null,$idClient=null,$search=null){
        $limit = ' ORDER BY nom ASC,created_at DESC';
        $limit .= (isset($nbreParPage)&&isset($pageCourante))?' LIMIT '.(($pageCourante-1)*$nbreParPage).','.$nbreParPage:'';
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($search)){
            $tDebut = ' AND nom like :nom';
            $tab[':nom'] = "%".$search."%";
        }else{
            $tDebut = '';
        }
        if(isset($idClient)){
            $tidClient = ' AND idClient = :idClient';
            $tab[':idClient'] = $idClient;
        }else{
            $tidClient = '';
        }
        $q = self::selectString().$where.$tDebut.$tidClient.$limit;
        return self::query($q,$tab);
    }

}