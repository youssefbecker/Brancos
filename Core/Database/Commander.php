<?php
/**
 * Created by PhpStorm.
 * User: Poizon
 * Date: 20/10/2015
 * Time: 20:20
 */

namespace Projet\Database;


use Projet\Model\Table;

class Commander extends Table{
    protected static $table = 'commander';

    public static function save($id_entreprise,$nom,$numero,$email,$description,$reference, $charge = null,$web=null,$desktop=null,$domaine=null,$site=null,$hebergement=null,$mobile=null,$id=null){
        $sql = 'INSERT INTO ';
        $baseSql = self::getTable().' SET id_entreprise = :id_entreprise, nom = :nom, email = :email, description = :description,desktop = :desktop, domaine = :domaine, numero = :numero, web = :web,reference = :reference, charge = :charge, site = :site, hebergement = :hebergement, mobile = :mobile';
        $param = [':id_entreprise'=>$id_entreprise,':nom'=>$nom,':email'=>$email, ':description'=>$description,
            ':desktop'=>$desktop,':domaine'=>$domaine, ':numero'=>$numero, ':web'=>$web, ':reference'=>$reference, ':charge'=>$charge, ':site'=>$site, ':hebergement'=>$hebergement, ':mobile'=>$mobile];
        if(isset($id)){
            $sql = 'UPDATE ';
            $baseSql .= ' WHERE id = :id';
            $param [':id'] = $id;
        }
        return self::query($sql.$baseSql,$param,true,true);
    }

    public static function saveFirst($id_entreprise,$description,$reference, $idBesoins,$besoins){
        $sql = 'INSERT INTO '.self::getTable().' SET id_entreprise = :id_entreprise, idBesoins = :idBesoins, besoins = :besoins, description = :description, reference = :reference';
        $param = [':id_entreprise'=>$id_entreprise,':idBesoins'=>$idBesoins,':besoins'=>$besoins, ':description'=>$description, ':reference'=>$reference];
        return self::query($sql,$param,true,true);
    }

    public static function setCahierDeCharge($path,$id){
        return self::query('UPDATE '.self::getTable().' SET charge = :path WHERE id = :id', [':path'=>$path,':id'=>$id], true, true);
    }

    public static function countBySearchType($id, $search=null,$debut=null,$fin=null){
        $count = 'SELECT COUNT(*) AS Total FROM '.self::getTable();
        $where = ' WHERE id_entreprise = :id';
        $tab = [];
        $tab[':id'] = $id;
        if(isset($search)){
            $tsearch = ' AND (nom LIKE :search OR email LIKE :search OR description LIKE :search)';
            $tab[':search'] = '%'.$search.'%';
        }else{
            $tsearch = '';
        }
        if(isset($debut)){
            $tDebut = ' AND DATE(date) >= :debut';
            $tab[':debut'] = $debut;
        }else{
            $tDebut = '';
        }
        if(isset($fin)){
            $tFin = ' AND DATE(date) <= :fin';
            $tab[':fin'] = $fin;
        }else{
            $tFin = '';
        }
        return self::query($count.$where.$tsearch.$tDebut.$tFin,$tab,true);
    }

    public static function searchType($id, $nbreParPage=null,$pageCourante=null,$search=null,$debut=null,$fin=null){
        $limit = ' ORDER BY created_at DESC';
        $limit .= (isset($nbreParPage)&&isset($pageCourante))?' LIMIT '.(($pageCourante-1)*$nbreParPage).','.$nbreParPage:'';
        $where = ' WHERE id_entreprise = :id';
        $tab = [];
        $tab[':id'] = $id;
        if(isset($search)){
            $tsearch = ' AND (nom LIKE :search OR email LIKE :search OR description LIKE :search)';
            $tab[':search'] = '%'.$search.'%';
        }else{
            $tsearch = '';
        }
        if(isset($debut)){
            $tDebut = ' AND DATE(date) >= :debut';
            $tab[':debut'] = $debut;
        }else{
            $tDebut = '';
        }
        if(isset($fin)){
            $tFin = ' AND DATE(date) <= :fin';
            $tab[':fin'] = $fin;
        }else{
            $tFin = '';
        }
        return self::query(self::selectString().$where.$tsearch.$tDebut.$tFin.$limit,$tab);
    }

    public static function  isDevis($id){
        return self::query("SELECT etat FROM ".self::$table."  WHERE id = :id ", ["id"=>$id], true, false);
    }

    public static function  getReference($id){
        return self::query("SELECT reference FROM ".self::$table."  WHERE id = :id ", ["id"=>$id], true, false);
    }

    public static function byId($id,$idClient){
        $param = [':id' => ($id), ':id_entreprise' => ($idClient)];
        return self::query(self::selectString()." WHERE id = :id AND id_entreprise = :id_entreprise", $param, true, false);
    }

    public static function deleteCommande($id){
        $param = [':id' => $id];
        return self::query("UPDATE ".self::getTable()." SET etat=3 WHERE id = :id ", $param, true, true);
    }

}