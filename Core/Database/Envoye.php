<?php
/**
 * Created by PhpStorm.
 * Eleve: le marcelo
 * Date: 28/02/2017
 * Time: 12:32
 */

namespace Projet\Database;


use Projet\Model\Table;


class Envoye extends Table{

    protected static $table = 'envoye';

    public static function save($idClient,$idEvenement,$idRappel,$numero,$message,$id=null){
        $sql = 'INSERT INTO ';
        $baseSql = self::getTable().' SET idRappel = :idRappel,idClient = :idClient,numero = :numero,message = :message,idEvenement = :idEvenement';
        $baseParam = [':message' => $message,':idRappel' => $idRappel,':idClient' => $idClient,':numero' => $numero,':idEvenement' => $idEvenement];
        if(isset($id)){
            $sql = 'UPDATE ';
            $baseSql .= ' WHERE id = :id';
            $baseParam [':id'] = $id;
        }
        return self::query($sql.$baseSql, $baseParam, true, true);
    }

    public static function countBySearchType($idEvenement=null,$idClient=null,$idRappel=null,$debut=null,$fin=null){
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
        if(isset($idRappel)){
            $tidRappel = ' AND idRappel = :idRappel';
            $tab[':idRappel'] = $idRappel;
        }else{
            $tidRappel = '';
        }
        if(isset($debut)){
            $tDebut = ' AND DATE(created_at) >= :debut';
            $tab[':debut'] = $debut;
        }else{
            $tDebut = '';
        }
        if(isset($fin)){
            $tFin = ' AND DATE(created_at) <= :fin';
            $tab[':fin'] = $fin;
        }else{
            $tFin = '';
        }
        return self::query($count.$where.$tidEvenement.$tidClient.$tidRappel.$tFin.$tDebut,$tab,true);
    }


    public static function searchType($nbreParPage=null,$pageCourante=null,$idEvenement=null,$idClient=null,$idRappel=null,$debut=null,$fin=null){
        $limit = ' ORDER BY created_at DESC';
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
        if(isset($idRappel)){
            $tidRappel = ' AND idRappel = :idRappel';
            $tab[':idRappel'] = $idRappel;
        }else{
            $tidRappel = '';
        }
        if(isset($debut)){
            $tDebut = ' AND DATE(created_at) >= :debut';
            $tab[':debut'] = $debut;
        }else{
            $tDebut = '';
        }
        if(isset($fin)){
            $tFin = ' AND DATE(created_at) <= :fin';
            $tab[':fin'] = $fin;
        }else{
            $tFin = '';
        }
        return self::query(self::selectString().$where.$tidEvenement.$tidClient.$tidRappel.$tFin.$tDebut.$limit,$tab);
    }

}