<?php
/**
 * Created by PhpStorm.
 * User: youssef
 * Date: 20/05/2020
 * Time: 12:03
 */

namespace Projet\Database;


use Projet\Model\Table;

class terms extends Table {

    protected static $table = 'terms';

    public static function all(){
        $sql = self::selectString() . ' ORDER BY date DESC';
        return self::query($sql,null);
    }
    public static function allLimit(){
        $sql = self::selectString() . ' ORDER BY date DESC LIMIT 6';
        return self::query($sql,null);
    }

    public static function save($titre,$contenu,$id=null){
        $sql = "";
        $param = [];
        if(isset($id)){
            $sql = 'UPDATE '.self::getTable().' SET titre = :titre, contenu = :contenu, WHERE id = :id';
            $param = [':titre'=>($titre),':contenu'=>$contenu,':id'=>htmlentities($id)];
        }else{
            $sql = 'INSERT INTO  '.self::getTable().' SET titre = :titre, contenu = :contenu';
            $param = [':titre'=>($titre),':contenu'=>$contenu];
        }
        return self::query($sql,$param,true,true);
    }

    public static function setVues($nbre,$id){
        $sql = 'UPDATE  '.self::getTable().' SET vues = :nbre WHERE id = :id';
        $param = [':nbre'=>$nbre,':id'=>$id];
        return self::query($sql,$param,true,true);
    }


    public static function countBySearchType($debut=null,$fin=null){
        $count = 'SELECT COUNT(*) AS Total FROM '.self::getTable();
        $where = ' WHERE 1 = 1';
        $tab = [];

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
        return self::query($count.$where.$ttitre.$tDebut.$tFin,$tab,true);
    }

    public static function searchType($nbreParPage=null,$pageCourante=null,$debut=null,$fin=null){
        $limit = ' ORDER BY created_at DESC';
        $limit .= (isset($nbreParPage)&&isset($pageCourante))?' LIMIT '.(($pageCourante-1)*$nbreParPage).','.$nbreParPage:'';
        $where = ' WHERE 1 = 1';
        $tab = [];

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
        return self::query(self::selectString().$where.$tDebut.$tFin.$limit,$tab);
    }

}