<?php
/**
 * Created by PhpStorm.
 * User: DIKLA
 * Date: 08/06/2020
 * Time: 17:30
 */

namespace Projet\Database;


use Projet\Model\Table;

class Entreprise extends    Table
{
    protected static $table = 'entreprise';

    public static function save($nom, $numero, $password, $email, $id=null){
        $sql = 'INSERT INTO ';
        $baseSql = self::getTable().' SET nom = :nom, numero = :numero, password = :password,email = :email,';
        $baseParam = [':nom'=>(ucwords($nom)),':password'=>($password),':email'=>($email),':numero'=>($numero)];
        if(isset($id)){
            $sql = 'UPDATE ';
            $baseSql .= ' WHERE id = :id';
            $baseParam [':id'] = $id;
        }
        return self::query($sql.$baseSql, $baseParam, true, true);
    }

    public static function setPassword($password,$id){
        $sql = 'UPDATE '.self::getTable().' SET password = :password WHERE id = :id';
        $param = [':password'=>($password),':id'=>($id)];
        return self::query($sql,$param,true,true);
    }

    public static function byEmail($email){
        $sql = self::selectString() . ' WHERE email = :email';
        $param = [':email' => $email];
        return self::query($sql, $param,true);
    }

    public static function byCode($code){
        $sql = self::selectString() . ' WHERE code = :code';
        $param = [':code' => $code];
        return self::query($sql, $param,true);
    }

    public static function byNumero($numero){
        $sql = self::selectString() . ' WHERE numero = :numero';
        $param = [':numero' => $numero];
        return self::query($sql, $param,true);
    }

    public static function setNumero($numero,$id){
        $sql = 'UPDATE '.self::getTable().' SET numero = :numero WHERE id = :id ';
        $param = [':numero'=>($numero),':id'=>($id)];
        return self::query($sql,$param,true,true);
    }

    public static function setEtat($etat,$id){
        $sql = 'UPDATE '.self::getTable().' SET etat = :etat WHERE id = :id ';
        $param = [':etat'=>($etat),':id'=>($id)];
        return self::query($sql,$param,true,true);
    }

    public static function setCode($code, $date,$id){
        $sql = 'UPDATE '.self::getTable().' SET code = :code, dateCode = :date WHERE id = :id ';
        $param = [':code'=>($code), ':date'=>$date,':id'=>($id)];
        return self::query($sql,$param,true,true);
    }

    public static function countBySearchType($isPersonnel=null,$search=null,$roles=null,$sexe=null,$etat=null,$debut=null,$fin=null){
        $count = 'SELECT COUNT(user.id) AS Total FROM '.self::getTable();
        $where = isset($isPersonnel)?' WHERE user.id = p.idUser':' WHERE 1 = 1';
        $left = isset($isPersonnel)?' LEFT JOIN personnel p ON p.idUser = user.id':'';
        $tab = [];
        if(isset($etat)){
            $tetat = ' AND user.etat = :etat';
            $tab[':etat'] = $etat;
        }else{
            $tetat ='';
        }
        if(isset($roles)){
            $troles = ' AND roles = :roles';
            $tab[':roles'] = $roles;
        }else{
            $troles ='';
        }
        if(isset($sexe)){
            $tsexe = ' AND sexe = :sexe';
            $tab[':sexe'] = $sexe;
        }else{
            $tsexe ='';
        }
        if(isset($search)){
            $tsearch = ' AND (nom LIKE :search OR prenom LIKE :search OR numero LIKE :search OR email LIKE :search
                                OR login LIKE :search OR adresse LIKE :search';
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

        return self::query($count.$left.$where.$tsearch.$tDebut.$tFin.$troles.$tsexe.$tetat,$tab,true);
    }

    public static function searchType($nbreParPage=null,$pageCourante=null,$isPersonnel=null,$search=null,$roles=null,$sexe=null,$etat=null,$debut=null,$fin=null){
        $is = isset($isPersonnel)?",p.specialite,p.grade":"";
        $sql = "SELECT user.* $is FROM ".self::getTable();
        $limit = ' ORDER BY created_at DESC';
        $limit .= (isset($nbreParPage)&&isset($pageCourante))?' LIMIT '.(($pageCourante-1)*$nbreParPage).','.$nbreParPage:'';
        $where = isset($isPersonnel)?' WHERE user.id = p.idUser':' WHERE 1 = 1';
        $left = isset($isPersonnel)?' LEFT JOIN personnel p ON p.idUser = user.id':'';
        $tab = [];
        if(isset($etat)){
            $tetat = ' AND etat = :etat';
            $tab[':etat'] = $etat;
        }else{
            $tetat ='';
        }
        if(isset($roles)){
            $troles = ' AND roles = :roles';
            $tab[':roles'] = $roles;
        }
        else{
            $troles ='';
        }

        if(isset($sexe)){
            $tsexe = ' AND sexe = :sexe';
            $tab[':sexe'] = $sexe;
        }
        else{
            $tsexe ='';
        }
        if(isset($search)){
            $tsearch = ' AND (nom LIKE :search OR prenom LIKE :search OR numero LIKE :search OR email LIKE :search
                                OR login LIKE :search OR adresse LIKE :search';
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

        return self::query($sql.$left.$where.$tsearch.$troles.$tsexe.$tetat.$tDebut.$tFin.$limit,$tab);
    }

}