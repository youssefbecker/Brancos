<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 05/06/2017
 * Time: 11:13
 */

namespace Projet\Database;


use Projet\Model\Database;
use Projet\Model\Table;

class Produit extends Table
{
    protected static $table = 'produit';

    public static function all(){
        $sql = self::selectString() . ' ORDER BY created_at DESC';
        return self::query($sql,null);
    }
    public static function allLimit(){
        $sql = self::selectString() . ' ORDER BY created_at DESC LIMIT 6';
        return self::query($sql,null);
    }

    public static function save($intitule,$description,$id=null){
        $sql = "";
        $param = [];
        if(!isset($id)){
            $sql = 'INSERT INTO '.self::getTable().' SET intitule = :intitule, description = :description';
            $param = [':description'=>($description),':intitule'=>($intitule)];
        }else{
            $sql = 'UPDATE '.self::getTable().' SET intitule = :intitule , description = :description WHERE id= :id';
            $param = [':intitule'=>($intitule),':description'=>($description),':id'=>($id)];
        }
        return self::query($sql,$param,true,true);
    }
    public static function setCout($cout,$id){
        $sql = 'UPDATE '.self::getTable().' SET cout = :cout WHERE id= :id';
        $param = [':cout'=>$cout,':id'=>($id)];
        return self::query($sql,$param,true,true);
    }
    public static function setEtat($etat,$id){
        $sql = 'UPDATE '.self::getTable().' SET etat = :etat WHERE id= :id';
        $param = [':etat'=>$etat,':id'=>($id)];
        return self::query($sql,$param,true,true);
    }
    public static function setVues($vues,$id){
        $sql = 'UPDATE '.self::getTable().' SET vues = :vues WHERE id= :id';
        $param = [':vues'=>$vues,':id'=>($id)];
        return self::query($sql,$param,true,true);
    }
    public static function countBySearchType($search=null,$debut=null,$fin=null){
        $count = 'SELECT COUNT(produit.id) AS Total FROM '.self::getTable();
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($search)){
            $tsearch = ' AND intitule LIKE :search';
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
        $limit = ' ORDER BY created_at ASC';
        $limit .= (isset($nbreParPage)&&isset($pageCourante))?' LIMIT '.(($pageCourante-1)*$nbreParPage).','.$nbreParPage:'';
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($search)){
            $tsearch = ' AND intitule LIKE :search';
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
?>