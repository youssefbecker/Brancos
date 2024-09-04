<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 30/05/2017
 * Time: 09:36
 */

namespace Projet\Database;


use Projet\Model\Table;

class Devis extends Table {

    protected static $table = 'devis';

    public static function save($nom,$numero,$email,$entreprise,$bp,$adresse,$service,$format,$nbre,$support,$detail){
        $sql = 'INSERT INTO ' . self::getTable() . ' SET nom = :nom,numero = :numero,email = :email,bp = :bp,adresse = :adresse,
        service = :service,format = :format,nbre = :nbre,support = :support,entreprise = :entreprise,detail = :detail';
        $param = [':nom' =>$nom,':numero' =>$numero,':email' =>$email,':bp' =>$bp,':adresse' =>$adresse,':service' =>$service,
            ':format' =>$format,':nbre' =>$nbre,':support' =>$support,':entreprise' => ($entreprise), ':detail' => ($detail)];
        return self::query($sql, $param, true, true);
    }

    public static function countBySearchType($search=null,$debut=null,$fin=null){
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
        if(isset($search)){
            $tsearch = ' AND (nom LIKE :search OR email LIKE :search OR numero LIKE :search OR sujet LIKE :search)';
            $tab[':search'] = '%'.$search.'%';
        }else{
            $tsearch = '';
        }

        return self::query($count.$where.$tsearch.$tDebut.$tFin,$tab,true);
    }

    public static function searchType($nbreParPage=null,$pageCourante=null,$search=null,$debut=null,$fin=null){
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
        if(isset($search)){
            $tsearch = ' AND (nom LIKE :search OR email LIKE :search OR numero LIKE :search OR service LIKE :search)';
            $tab[':search'] = '%'.$search.'%';
        }else{
            $tsearch = '';
        }

        return self::query(self::selectString().$where.$tsearch.$tDebut.$tFin.$limit,$tab);
    }

    public function setEtat($id,$etat){
        $sql = 'UPDATE ' . self::getTable() . ' SET etat = :etat WHERE id = :id';
        $param = [':id' => ($id), ':etat' => ($etat)];
        return self::query($sql, $param, true, true);
    }

}