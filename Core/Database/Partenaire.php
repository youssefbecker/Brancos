<?php
/**
 * Created by PhpStorm.
 * User: Poizon
 * Date: 02/09/2015
 * Time: 07:49
 */

namespace Projet\Database;


use Projet\Model\Table;

class Partenaire extends Table{
    protected static $table = 'partenaire';

    public static function all(){
        $sql = self::selectString() . ' ORDER BY created_at DESC';
        return self::query($sql,null);
    }
    public static function allLimit(){
        $sql = self::selectString() . ' ORDER BY created_at DESC LIMIT 6';
        return self::query($sql,null);
    }

    //enregistre ou modifie un Partenaire
    public static function save($image,$nom,$description,$lien,$id=null){
        $sql = "";
        $param = [];
        if(isset($id)){
            $sql = 'UPDATE '.self::getTable().' SET lien = :site, description = :description, image = :logo ,nom =:nom WHERE id = :id';
            $param = [':site'=>$lien,':logo'=>$image,':id'=>$id,':nom'=>$nom,':description'=>$description];
        }else{
            $sql = 'INSERT INTO '.self::getTable().' SET lien = :site, description = :description, image = :logo, nom =:nom';
            $param = [':site'=>$lien,':logo'=>$image,':nom'=>$nom,':description'=>$description];
        }
        return self::query($sql,$param,true,true);
    }

    public static function setImage($image,$id){
        $sql = 'UPDATE  '.self::getTable().' SET image = :fichier WHERE id = :id';
        $param = [':fichier'=>$image,':id'=>$id];
        return self::query($sql,$param,true,true);
    }

    public static function countBySearchType($search=null,$debut=null,$fin=null){
        $count = 'SELECT COUNT(*) AS Total FROM '.self::getTable();
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($search)){
            $tsearch = ' AND lien LIKE :search';
            $tab[':search'] = '%'.$search.'%';
        }else{
            $tsearch = '';
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
        return self::query($count.$where.$tsearch.$tDebut.$tFin,$tab,true);
    }

    public static function searchType($nbreParPage=null,$pageCourante=null,$search=null,$debut=null,$fin=null){
        $limit = ' ORDER BY created_at DESC';
        $limit .= (isset($nbreParPage)&&isset($pageCourante))?' LIMIT '.(($pageCourante-1)*$nbreParPage).','.$nbreParPage:'';
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($search)){
            $tsearch = ' AND lien LIKE :search';
            $tab[':search'] = '%'.$search.'%';
        }else{
            $tsearch = '';
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
        return self::query(self::selectString().$where.$tsearch.$tDebut.$tFin.$limit,$tab);
    }

}