<?php
/**
 * Created by PhpStorm.
 * User: Youssef
 * Date: 14/05/2020
 * Time: 03:08
 */

namespace Projet\Database;


use Projet\Model\Table;


class Meeting extends  Table
{
    protected static $table = 'meeting';

    public static function save($nom_affilie, $nom_client, $mode_meeting, $date_metting,
                                $duree_meeting, $statut, $id = null)
    {
        $sql = 'INSERT INTO ';
        $baseSql = self::getTable() . ' SET nom_affilie = :nom_affilie,nom_client = :nom_client,
                                        mode_meeting = :mode_meeting,date_metting = :date_metting,statut = :statut';
        $baseParam = [':nom_affilie' => $nom_affilie, ':nom_client' => $nom_client, ':mode_meeting' => $mode_meeting,
            ':date_metting' => $date_metting, ':durée_meeting' => $duree_meeting, ':statut' => $statut];
        if (isset($id)) {
            $sql = 'UPDATE ';
            $baseSql .= ' WHERE id = :id';
            $baseParam [':id'] = $id;
        }
        return self::query($sql . $baseSql, $baseParam, true, true);
    }


    public static function countBySearchType($nom_affilie = null,$nom_client = null,$mode_meeting = null,$statut = null){
        $count = 'SELECT COUNT(id) AS Total FROM '.self::getTable();
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($nom_affilie)){
            $tnom_affilie = ' AND nom_affilie LIKE :nom_affilie';
            $tab[':nom_affilie'] = '%'.$nom_affilie.'%';
        }else{
            $tnom_affilie = '';
        }
        if(isset($nom_client)){
            $tnom_client = ' AND nom_client LIKE :nom_client';
            $tab[':nom_client'] = '%'.$nom_client.'%';
        }else{
            $tnom_client = '';
        }
        if(isset($mode_meeting)){
            $tmode_meeting = ' AND mode_meeting LIKE :mode_meeting';
            $tab[':mode_meeting'] = '%'.$mode_meeting.'%';
        }else{
            $tmode_meeting = '';
        }
        if(isset($statut)){
            $tstatut = ' AND statut LIKE :statut';
            $tab[':statut'] = '%'.$statut.'%';
        }else{
            $tstatut = '';
        }

        return self::query($count.$where.$tnom_affilie.$tnom_client.$tmode_meeting.$tstatut,$tab,true);
    }

    public static function searchType($nbreParPage=null,$pageCourante=null,$nom_affilie = null,$nom_client = null,$mode_meeting = null,$statut = null){
        $limit = ' ORDER BY id DESC';
        $limit .= (isset($nbreParPage)&&isset($pageCourante))?' LIMIT '.(($pageCourante-1)*$nbreParPage).','.$nbreParPage:'';
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($nom_affilie)){
            $tnom_affilie = ' AND nom_affilie LIKE :nom_affilie';
            $tab[':nom_affilie'] = '%'.$nom_affilie.'%';
        }else{
            $tnom_affilie = '';
        }
        if(isset($nom_client)){
            $tnom_client = ' AND nom_client LIKE :nom_client';
            $tab[':nom_client'] = '%'.$nom_client.'%';
        }else{
            $tnom_client = '';
        }
        if(isset($mode_meeting)){
            $tmode_meeting = ' AND mode_meeting LIKE :mode_meeting';
            $tab[':mode_meeting'] = '%'.$mode_meeting.'%';
        }else{
            $tmode_meeting = '';
        }
        if(isset($statut)){
            $tstatut = ' AND statut LIKE :statut';
            $tab[':statut'] = '%'.$statut.'%';
        }else{
            $tstatut = '';
        }
        return self::query(self::selectString().$where.$tnom_affilie.$tnom_client.$tmode_meeting.$tstatut.$limit,$tab);
    }

}