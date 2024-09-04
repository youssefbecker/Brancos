<?php
/**
 * Created by PhpStorm.
 * User: yousseph
 * Date: 21/05/2020
 * Time: 23:49
 */

namespace Projet\Database;


use Projet\Model\Table;

class Payement extends  Table
{
    protected static $table = 'payement';

    public static function save($nom_affilie, $nom_projet, $mobile_client, $email_client,
                                $commentaire, $montant, $id = null)
    {
        $sql = 'INSERT INTO ';
        $baseSql = self::getTable() . ' SET nom_affilie = :nom_affilie,nom_projet = :nom_projet,
                                        mobile_client = :mobile_client,email_client = :email_client,
                                        commentaire = :commentaire,montant = :montant';
        $baseParam = [':nom_affilie' => $nom_affilie, ':nom_projet' => $nom_projet, ':mobile_client' => $mobile_client,
            ':email_client' => $email_client, ':commentaire' => $commentaire, ':montant' => $montant];
        if (isset($id)) {
            $sql = 'UPDATE ';
            $baseSql .= ' WHERE id = :id';
            $baseParam [':id'] = $id;
        }
        return self::query($sql . $baseSql, $baseParam, true, true);
    }


    public static function setDetail($nom_affilie,$nom_projet,$mobile_client,$email_client,$commentaire,$montant,$id){
        $sql = 'UPDATE '.self::getTable().' SET coupon_code = :coupon_code,description = :description,discount = :discount,start_date = :start_date,end_date = :end_date WHERE id = :id';
        $param = [':nom_affilie' => $nom_affilie,':nom_projet' => $nom_projet,':mobile_client'=> $mobile_client,
            ':email_client'=> $email_client,':commentaire'=> $commentaire,':montant'=> $montant,':id'=>($id)];
        return self::query($sql,$param,true,true);
    }



    public static function countBySearchType($nom_affilie = null,$nom_projet = null){
        $count = 'SELECT COUNT(id) AS Total FROM '.self::getTable();
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($nom_affilie)){
            $tnom_affilie = ' AND nom_affilie LIKE :nom_affilie';
            $tab[':nom_affilie'] = '%'.$nom_affilie.'%';
        }else{
            $tnom_affilie = '';
        }
        if(isset($nom_projet)){
            $tnom_projet = ' AND nom_projet LIKE :nom_projet';
            $tab[':nom_projet'] = '%'.$nom_projet.'%';
        }else{
            $tnom_projet = '';
        }


        return self::query($count.$where.$tnom_affilie.$tnom_projet,$tab,true);
    }

    public static function searchType($nbreParPage=null,$pageCourante=null,$nom_affilie = null,$nom_projet = null){
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
        if(isset($nom_projet)){
            $tnom_projet = ' AND nom_projet LIKE :nom_projet';
            $tab[':nom_projet'] = '%'.$nom_projet.'%';
        }else{
            $tnom_projet = '';
        }

        return self::query(self::selectString().$where.$tnom_affilie.$tnom_projet.$limit,$tab);
    }

}