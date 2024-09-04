<?php
/**
 * Created by PhpStorm.
 * User: Poizon
 * Date: 23/09/2015
 * Time: 12:03
 */

namespace Projet\Database;


use Projet\Model\Table;

class Employe extends Table{

    protected static $table = 'employe';

    public static function all(){
        $sql = self::selectString() . ' ORDER BY created_at DESC';
        return self::query($sql,null);
    }
    public static function allLimit(){
        $sql = self::selectString() . ' ORDER BY created_at DESC LIMIT 6';
        return self::query($sql,null);
    }

    public static function save($nom,$fonction,$image,$email,$facebook,$twitter,$id=null){
        $sql = "";
        $param = [];
        if(isset($id)){
            $sql = 'UPDATE '.self::getTable().' SET email = :email,facebook = :facebook,twitter = :twitter,nom = :titre, fonction = :contenu, image = :image, WHERE id = :id';
            $param = [':twitter'=>($twitter),':facebook'=>($facebook),':email'=>($email),':titre'=>($nom),':contenu'=>$fonction,':image'=>($image),':id'=>($id)];
        }else{
            $sql = 'INSERT INTO  '.self::getTable().' SET email = :email,facebook = :facebook,twitter = :twitter,nom = :titre, fonction = :contenu, image = :image';
            $param = [':twitter'=>($twitter),':facebook'=>($facebook),':email'=>($email),':titre'=>($nom),':contenu'=>$fonction,':image'=>($image)];
        }
        return self::query($sql,$param,true,true);
    }

    public static function setImage($image,$id){
        $sql = 'UPDATE '.self::getTable().' SET image = :image WHERE id = :id';
        $param = [':image'=>htmlentities($image),':id'=>htmlentities($id)];
        return self::query($sql,$param,true,true);
    }

    public static function countBySearchType($search=null,$debut=null,$fin=null){
        $count = 'SELECT COUNT(*) AS Total FROM '.self::getTable();
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($search)){
            $tsearch = ' AND (nom LIKE :search OR fonction LIKE :search)';
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
            $tsearch = ' AND (nom LIKE :search OR fonction LIKE :search)';
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