<?php
/**
 * Created by PhpStorm.
 * User: nkaurelien
 * Date: 10/01/2018
 * Time: 10:29
 */

namespace Projet\Database;


use Projet\Model\Table;

class Groupe_Contact extends  Table
{
    protected static $table = 'groupe_contact';

    public static function save($idGroupe,$idContact,$id=null){
        $sql = 'INSERT INTO ';
        $baseSql = self::getTable().' SET idGroupe = :idGroupe,idContact = :idContact';
        $baseParam = [':idContact' => $idContact,':idGroupe' => $idGroupe];
        if(isset($id)){
            $sql = 'UPDATE ';
            $baseSql .= ' WHERE id = :id';
            $baseParam [':id'] = $id;
        }

        return self::query($sql.$baseSql, $baseParam, true, true);
    }

    public static function isExist($idGroupe,$idContact){
        $sql = self::selectString() . ' WHERE idGroupe = :idGroupe AND idContact = :idContact';
        $param = [':idContact' => $idContact,':idGroupe' => $idGroupe];
        return self::query($sql, $param,true);
    }

    public static function countBySearchType($idGroupe=null,$idContact=null){
        $count = 'SELECT COUNT(*) AS Total FROM '.self::getTable();
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($idGroupe)){
            $tidGroupe = ' AND idGroupe = :idGroupe';
            $tab[':idGroupe'] = $idGroupe;
        }else{
            $tidGroupe = '';
        }
        if(isset($idContact)){
            $tidContact = ' AND idContact = :idContact';
            $tab[':idContact'] = $idContact;
        }else{
            $tidContact = '';
        }
        return self::query($count.$where.$tidGroupe.$tidContact,$tab,true);
    }

    public static function searchType($nbreParPage=null,$pageCourante=null,$idGroupe=null,$idContact=null){
        $limit = ' ORDER BY contact.nom ASC,created_at DESC';
        $limit .= (isset($nbreParPage)&&isset($pageCourante))?' LIMIT '.(($pageCourante-1)*$nbreParPage).','.$nbreParPage:'';
        $where = ' LEFT JOIN contact ON contact.id = groupe_contact.idContact WHERE 1 = 1';
        $tab = [];
        if(isset($idGroupe)){
            $tidGroupe = ' AND idGroupe = :idGroupe';
            $tab[':idGroupe'] = $idGroupe;
        }else{
            $tidGroupe = '';
        }
        if(isset($idContact)){
            $tidContact = ' AND idContact = :idContact';
            $tab[':idContact'] = $idContact;
        }else{
            $tidContact = '';
        }
        $sql = 'SELECT groupe_contact.*, contact.nom,contact.numero,contact.email FROM '.self::getTable();
        return self::query($sql.$where.$tidGroupe.$tidContact.$limit,$tab);
    }

}