<?php
/**
 * Created by PhpStorm.
 * User: DIKLA
 * Date: 14/05/2020
 * Time: 07:02
 */

namespace Projet\Database;

use Projet\Model\Table;

class Councils extends  Table
{
    protected static $table = 'council';

    public static function save( $userid,$title,$media_type,$status,$id=null){
        $sql = 'INSERT INTO ';
        $baseSql = self::getTable().'SET userid= :userid,title= :title,media_type= :media_type,status= :status';
        $baseParam = ['userid'=>$userid,'title'=>$title,'media_type'=>$media_type,'status'=>$status];
        if(isset($id)){
            $sql = 'UPDATE ';
            $baseSql .= ' WHERE id = :id';
            $baseParam [':id'] = $id;
        }
        return self::query($sql.$baseSql, $baseParam, true, true);
    }

    public static function setStatus($status,$id){
        $sql = 'UPDATE '.self::getTable().' SET status = :status WHERE id = :id';
        $param = [':status'=>($status),':id'=>($id)];
        return self::query($sql,$param,true,true);
    }
    public static function countBySearchType($userid=null,$status=null,$media_type=null,$debut=null,$fin=null){
        $count = 'SELECT COUNT(*) AS Total FROM '.self::getTable();
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($userid)){
            $tuserid = ' AND userid = :userid';
            $tab[':userid'] = $userid;
        }else{
            $tuserid = '';
        }
        if(isset($status)){
            $tstatus = ' AND status LIKE :status';
            $tab[':status'] = '%'.$status.'%';
        }else{
            $tstatus = '';
        }
        if(isset($media_type)){
            $tmedia_type = ' AND media_type LIKE :media_type';
            $tab[':media_type'] = '%'.$media_type.'%';
        }else{
            $tmedia_type = '';
        }
        if(isset($debut)){
            $tDebut = ' AND DATE(created_on) >= :debut';
            $tab[':debut'] = $debut;
        }else{
            $tDebut = '';
        }
        if(isset($fin)){
            $tFin = ' AND DATE(created_on) <= :fin';
            $tab[':fin'] = $fin;
        }else{
            $tFin = '';
        }
        return self::query($count.$where.$tuserid.$tstatus.$tmedia_type.$tFin.$tDebut,$tab,true);
    }
    public static function searchType($nbreParPage=null,$pageCourante=null,$userid=null,$status=null,$media_type=null,$debut=null,$fin=null){
        $limit = ' ORDER BY created_on DESC';
        $limit .= (isset($nbreParPage)&&isset($pageCourante))?' LIMIT '.(($pageCourante-1)*$nbreParPage).','.$nbreParPage:'';
        $where = ' WHERE 1 = 1';
        $tab = [];

        if(isset($userid)){
            $tuserid = ' AND userid = :userid';
            $tab[':userid'] = $userid;
        }else{
            $tuserid = '';
        }
        if(isset($status)){
            $tstatus = ' AND status LIKE :status';
            $tab[':status'] = '%'.$status.'%';
        }else{
            $tstatus = '';
        }
        if(isset($media_type)){
            $tmedia_type = ' AND media_type LIKE :media_type';
            $tab[':media_type'] = '%'.$media_type.'%';
        }else{
            $tmedia_type = '';
        }
        if(isset($debut)){
            $tDebut = ' AND DATE(created_on) >= :debut';
            $tab[':debut'] = $debut;
        }else{
            $tDebut = '';
        }
        if(isset($fin)){
            $tFin = ' AND DATE(created_on) <= :fin';
            $tab[':fin'] = $fin;
        }else{
            $tFin = '';
        }
        return self::query(self::selectString().$where.$tuserid.$tstatus.$tmedia_type.$tFin.$tDebut.$limit,$tab);
    }
}