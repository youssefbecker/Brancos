<?php
/**
 * Created by PhpStorm.
 * User: Ross
 * Date: 8/6/2018
 * Time: 11:24 AM
 */

namespace Projet\Database;


use Projet\Model\Table;

class Commentaire extends Table
{
    public static $table = "commentaire";


    public static function saveRealisation($idRealisation, $message, $name){
        $sql = "INSERT INTO ".self::$table." SET message = :message, nom = :nom,idRealisation = :idRealisation";
        $param = [":message"=>$message, "nom"=>$name,":idRealisation"=>$idRealisation];
        self::query($sql,$param,true,true);
    }

    public static function saveNews($idNews, $message, $name){
        $sql = "INSERT INTO ".self::$table." SET message = :message, nom = :nom,idNews = :idNews";
        $param = [":message"=>$message, "nom"=>$name,":idNews"=>$idNews];
        self::query($sql,$param,true,true);
    }

    public static function searchType($nbreParPage=null,$pageCourante=null,$idNews=null, $idRealisation=null, $search=null,$debut=null,$fin=null,$isActive=null,$idParent=null,$onlyParent=null){
        $limit = ' ORDER BY created_at ASC';
        $limit .= (isset($nbreParPage)&&isset($pageCourante))?' LIMIT '.(($pageCourante-1)*$nbreParPage).','.$nbreParPage:'';
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($idRealisation)){
            $tidRealisation = ' AND idRealisation = :idRealisation';
            $tab[':idRealisation'] = $idRealisation;
        }else{
            $tidRealisation = '';
        }
        if(isset($onlyParent)){
            $tonlyParent = ' AND (idParent = "" OR idParent IS NULL)';
        }else{
            $tonlyParent = ' AND (idParent != "" AND idParent IS NOT NULL)';
        }
        if(isset($idParent)){
            $tidParent = ' AND idParent = :idParent';
            $tab[':idParent'] = $idParent;
        }else{
            $tidParent = '';
        }
        if(isset($idNews)){
            $tidNews = ' AND idNews = :idNews';
            $tab[':idNews'] = $idNews;
        }else{
            $tidNews = '';
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
        if(isset($isActive)){
            $tIsActive = ' AND isActive = :isActive';
            $tab[':isActive'] = $isActive;
        }else{
            $tIsActive = '';
        }
        if(isset($search)){
            $tsearch = ' AND nom LIKE :search';
            $tab[':search'] = '%'.$search.'%';
        }else{
            $tsearch = '';
        }

        return self::query(self::selectString().$where.$tsearch.$tidNews.$tIsActive.$tidParent.$tonlyParent.$tidRealisation.$tDebut.$tFin.$limit,$tab);
    }

    public static function countBySearchType($idNews=null, $idRealisation=null, $search=null,$debut=null,$fin=null,$isActive=null,$idParent=null,$onlyParent=null){
        $count = 'SELECT COUNT(*) AS Total FROM '.self::getTable();
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($idRealisation)){
            $tidRealisation = ' AND idRealisation = :idRealisation';
            $tab[':idRealisation'] = $idRealisation;
        }else{
            $tidRealisation = '';
        }
        if(isset($onlyParent)){
            $tonlyParent = '';
        }else{
            $tonlyParent = ' AND (idParent != "" AND idParent IS NOT NULL)';
        }
        if(isset($idParent)){
            $tidParent = ' AND idParent = :idParent';
            $tab[':idParent'] = $idParent;
        }else{
            $tidParent = '';
        }
        if(isset($idNews)){
            $tidNews = ' AND idNews = :idNews';
            $tab[':idNews'] = $idNews;
        }else{
            $tidNews = '';
        }
        if(isset($search)){
            $tsearch = ' AND nom LIKE :search';
            $tab[':search'] = '%'.$search.'%';
        }else{
            $tsearch = '';
        }
        if(isset($isActive)){
            $tIsActive = ' AND isActive = :isActive';
            $tab[':isActive'] = $isActive;
        }else{
            $tIsActive = '';
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
        return self::query($count.$where.$tsearch.$tidNews.$tIsActive.$tonlyParent.$tidParent.$tidRealisation.$tDebut.$tFin,$tab,true);
    }

    public static function setIdParent($idParent, $id){
        $sql = "UPDATE ".self::$table." SET idParent = :idParent WHERE id = :id";
        $param = [":idParent"=>$idParent,":id"=>$id];
        self::query($sql,$param,true,true);
    }

}