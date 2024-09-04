<?php
/**
 * Created by PhpStorm.
 * Eleve: le marcelo
 * Date: 28/02/2017
 * Time: 12:32
 */

namespace Projet\Database;


use Projet\Model\Table;


class Rappel extends Table{

    protected static $table = 'rappel';

    public static function save($idClient,$idEvenement,$date,$message,$nom,$id=null){
        $sql = 'INSERT INTO ';
        $baseSql = self::getTable().' SET nom = :nom,idEvenement = :idEvenement,date = :date,message = :message,idClient = :idClient';
        $baseParam = [':nom' => $nom,':idEvenement' => $idEvenement,':message' => $message,':date' => $date,':idClient' => $idClient];
        if(isset($id)){
            $sql = 'UPDATE ';
            $baseSql .= ' WHERE id = :id';
            $baseParam [':id'] = $id;
        }
        return self::query($sql.$baseSql, $baseParam, true, true);
    }

    public static function alls($id){
        $sql = self::selectString() . ' WHERE idEvenement = :id ORDER BY date ASC';
        $param = [':id' => $id];
        return self::query($sql, $param);
    }

    public static function rappeler($date){
        $sql = self::selectString() . ' WHERE date = :date ORDER BY date ASC';
        $param = [':date' => $date];
        return self::query($sql, $param);
    }

    public static function setEtat($etat,$id){
        $sql = 'UPDATE '.self::getTable().' SET etat = :etat WHERE id = :id';
        $param = [':etat'=>($etat),':id'=>($id)];
        return self::query($sql,$param,true,true);
    }

    public static function countBySearchType($idEvenement=null,$idClient=null,$debut=null,$fin=null){
        $count = 'SELECT COUNT(*) AS Total FROM '.self::getTable();
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($idEvenement)){
            $tidEvenement = ' AND idEvenement = :idEvenement';
            $tab[':idEvenement'] = $idEvenement;
        }else{
            $tidEvenement = '';
        }
        if(isset($idClient)){
            $tidClient = ' AND idClient = :idClient';
            $tab[':idClient'] = $idClient;
        }else{
            $tidClient = '';
        }
        if(isset($debut)){
            $tDebut = ' AND date >= :debut';
            $tab[':debut'] = $debut;
        }else{
            $tDebut = '';
        }
        if(isset($fin)){
            $tFin = ' AND date <= :fin';
            $tab[':fin'] = $fin;
        }else{
            $tFin = '';
        }
        return self::query($count.$where.$tidEvenement.$tidClient.$tFin.$tDebut,$tab,true);
    }

    public static function searchType($nbreParPage=null,$pageCourante=null,$idEvenement=null,$idClient=null,$debut=null,$fin=null){
        $limit = ' ORDER BY date ASC,created_at DESC';
        $limit .= (isset($nbreParPage)&&isset($pageCourante))?' LIMIT '.(($pageCourante-1)*$nbreParPage).','.$nbreParPage:'';
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($idEvenement)){
            $tidEvenement = ' AND idEvenement = :idEvenement';
            $tab[':idEvenement'] = $idEvenement;
        }else{
            $tidEvenement = '';
        }
        if(isset($idClient)){
            $tidClient = ' AND idClient = :idClient';
            $tab[':idClient'] = $idClient;
        }else{
            $tidClient = '';
        }
        if(isset($debut)){
            $tDebut = ' AND date >= :debut';
            $tab[':debut'] = $debut;
        }else{
            $tDebut = '';
        }
        if(isset($fin)){
            $tFin = ' AND date <= :fin';
            $tab[':fin'] = $fin;
        }else{
            $tFin = '';
        }
        return self::query(self::selectString().$where.$tidEvenement.$tidClient.$tFin.$tDebut.$limit,$tab);
    }

}