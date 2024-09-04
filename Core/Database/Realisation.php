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

class Realisation extends Table
{
    protected static $table = 'realisation';

    public static function all(){
        $sql = self::selectString() . ' ORDER BY created_at DESC';
        return self::query($sql,null);
    }
    public static function allLimit(){
        $sql = self::selectString() . ' ORDER BY created_at DESC LIMIT 6';
        return self::query($sql,null);
    }

    public static function alls($id){
        $sql = self::selectString() . ' WHERE id != :id ORDER BY created_at DESC LIMIT 10';
        return self::query($sql,[':id'=>$id]);
    }

    public static function save($intitule,$type,$description,$linke,$id=null){
        $sql = "";
        $param = [];
        if(!isset($id)){
            $sql = 'INSERT INTO '.self::getTable().' SET type = :type, intitule = :intitule, description = :description, linke = :linke WHERE id= :id ';
            $param = [':description'=>($description),':type'=>($type),':intitule'=>($intitule),':linke'=>htmlentities($linke)];
        }else{
            $sql = 'UPDATE '.self::getTable().' SET type = :type, intitule = :intitule , description = :description, , linke = :linke WHERE id= :id';
            $param = [':intitule'=>($intitule),':type'=>($type),':description'=>($description),':id'=>($id),':linke'=>htmlentities($linke)];
        }
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
    public static function setLiked($liked,$id){
        $sql = 'UPDATE '.self::getTable().' SET liked = :liked WHERE id= :id';
        $param = [':liked'=>$liked,':id'=>($id)];
        return self::query($sql,$param,true,true);
    }
    public static function setImage($image,$id){
        $sql = 'UPDATE  '.self::getTable().' SET image = :fichier WHERE id = :id';
        $param = [':fichier'=>$image,':id'=>$id];
        return self::query($sql,$param,true,true);
    }
    public static function countBySearchType($search=null,$debut=null,$fin=null){
        $count = 'SELECT COUNT(realisation.id) AS Total, SUM(liked) AS Somme FROM '.self::getTable();
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
    public static function countByLiked(){
        $count = 'SELECT SUM(liked) AS Total FROM '.self::getTable();
        $tab = [];
        return self::query($count,$tab,true);
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