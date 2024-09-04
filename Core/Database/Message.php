<?php
/**
 * Created by PhpStorm.
 * User: Ross
 * Date: 8/24/2018
 * Time: 8:11 AM
 */

namespace Projet\Database;


use Projet\Model\Table;

class Message extends Table
{

    protected static $table = 'message';

    //enregistre un contact
    public static function save($message,$idClient, $numero){
        $sql = 'INSERT INTO  '.self::getTable().' SET message = :message, id_entreprise = :id_entreprise, numero = :numero';
        $param = [':message'=>$message,':id_entreprise'=>$idClient,':numero'=>$numero];
        return self::query($sql,$param,true,true);
    }

    public static function countBySearchType($search=null,$debut=null,$fin=null){
        $count = 'SELECT COUNT(*) AS Total FROM '.self::getTable();
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($search)){
            $tsearch = ' AND (nom LIKE :search OR email LIKE :search OR sujet LIKE :search)';
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
            $tsearch = ' AND (nom LIKE :search OR email LIKE :search OR sujet LIKE :search)';
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