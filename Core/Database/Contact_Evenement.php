<?php
/**
 * Created by PhpStorm.
 * User: nkaurelien
 * Date: 10/01/2018
 * Time: 10:29
 */

namespace Projet\Database;


use Projet\Model\Table;

class Contact_Evenement extends  Table
{
    protected static $table = 'contact_evenement';

    public static function save($idContact,$idEvenement,$id=null){
        $sql = 'INSERT INTO ';
        $baseSql = self::getTable().' SET idContact = :idContact,idEvenement = :idEvenement';
        $baseParam = [':idEvenement' => $idEvenement,':idContact' => $idContact];
        if(isset($id)){
            $sql = 'UPDATE ';
            $baseSql .= ' WHERE id = :id';
            $baseParam [':id'] = $id;
        }

        return self::query($sql.$baseSql, $baseParam, true, true);
    }

    public static function isExist($idContact,$idEvenement){
        $sql = self::selectString() . ' WHERE idContact = :idContact AND idEvenement = :idEvenement';
        $param = [':idEvenement' => $idEvenement,':idContact' => $idContact];
        return self::query($sql, $param,true);
    }

    public static function countBySearchType($idContact=null,$idEvenement=null){
        $count = 'SELECT COUNT(*) AS Total FROM '.self::getTable();
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($idContact)){
            $tidContact = ' AND idContact = :idContact';
            $tab[':idContact'] = $idContact;
        }else{
            $tidContact = '';
        }
        if(isset($idEvenement)){
            $tidEvenement = ' AND idEvenement = :idEvenement';
            $tab[':idEvenement'] = $idEvenement;
        }else{
            $tidEvenement = '';
        }
        return self::query($count.$where.$tidContact.$tidEvenement,$tab,true);
    }

    public static function searchType($nbreParPage=null,$pageCourante=null,$idContact=null,$idEvenement=null){
        $limit = ' ORDER BY created_at DESC';
        $limit .= (isset($nbreParPage)&&isset($pageCourante))?' LIMIT '.(($pageCourante-1)*$nbreParPage).','.$nbreParPage:'';
        $where = ' LEFT JOIN contact ON contact.id = contact_evenement.idContact WHERE 1 = 1';
        $tab = [];
        if(isset($idContact)){
            $tidContact = ' AND idContact = :idContact';
            $tab[':idContact'] = $idContact;
        }else{
            $tidContact = '';
        }
        if(isset($idEvenement)){
            $tidEvenement = ' AND idEvenement = :idEvenement';
            $tab[':idEvenement'] = $idEvenement;
        }else{
            $tidEvenement = '';
        }
        $sql = 'SELECT contact_evenement.*, contact.nom,contact.numero,contact.email FROM '.self::getTable();
        return self::query($sql.$where.$tidContact.$tidEvenement.$limit,$tab);
    }

}