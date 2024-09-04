<?php
/**
 * Created by PhpStorm.
 * User: DIKLA
 * Date: 20/05/2020
 * Time: 07:30
 */


namespace Projet\Database;

use Projet\Model\Table;

class Privacypolicy extends  Table
{
    protected static $table = 'privacypolicy';

    public static function save( $titre,$contenu,$id=null){
        $sql = 'INSERT INTO ';
        $baseSql = self::getTable().' SET titre = :titre,contenu = :contenu';
        $baseParam = [':titre' => $titre,':contenu' => $contenu];
        if(isset($id)){
            $sql = 'UPDATE ';
            $baseSql .= ' WHERE id = :id';
            $baseParam [':id'] = $id;
        }
        return self::query($sql.$baseSql, $baseParam, true, true);
    }

    public static function countBySearchType($titre=null,$debut=null,$fin=null){
        $count = 'SELECT COUNT(*) AS Total FROM '.self::getTable();
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($titre)){
            $ttitre = ' AND titre LIKE :titre';
            $tab[':titre'] = '%'.$titre.'%';
        }else{
            $ttitre = '';
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
        return self::query($count.$where.$ttitre.$tFin.$tDebut,$tab,true);
    }

    public static function searchType($nbreParPage=null,$pageCourante=null,$titre=null,$debut=null,$fin=null){
        $limit = ' ORDER BY date DESC';
        $limit .= (isset($nbreParPage)&&isset($pageCourante))?' LIMIT '.(($pageCourante-1)*$nbreParPage).','.$nbreParPage:'';
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($titre)){
            $ttitre = ' AND titre LIKE :titre';
            $tab[':titre'] = '%'.$titre.'%';
        }else{
            $ttitre = '';
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
        return self::query(self::selectString().$where.$ttitre.$tFin.$tDebut.$limit,$tab);
    }
}