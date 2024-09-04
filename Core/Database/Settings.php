<?php
/**
 * Created by PhpStorm.
 * User: le marcelo
 * Date: 27/02/2017
 * Time: 17:07
 */

namespace Projet\Database;


use Projet\Model\Table;

class Settings extends Table{
    
    protected static $table = 'settings';
    
    public static function save($photo=null,$slogan,$petiteDecription,$grandeDescription=null,$numero1,$numero2,$email1,$email2,$adresse,$bp,$id=null){
        if(isset($id)){
            $sql = 'UPDATE '.self::getTable().' SET numero1 = :numero1, numero2 = :numero2,email1 = :email1,email2 = :email2,boite_postale =:bp,adresse = :adresse,photo = :photo, slogan = :slogan,petiteDescription = :petite, grandeDescription =:grande WHERE id = :id';
            $param = [':numero1'=>$numero1,':numero2'=>$numero2,':email1'=>$email1,':email2'=>$email2,':adresse'=>$adresse,':bp'=>$bp,':photo'=>$photo,':slogan'=>$slogan,':petite'=>$petiteDecription,':grande'=>$grandeDescription,':id'=>$id];
        }else{
            $sql = 'INSERT INTO '.self::getTable().' SET  numero1 = :numero1, numero2 = :numero2,email1 = :email1 ,email2 = :email2,boite_postale =:bp,adresse = :adresse,photo = :photo, slogan = :slogan,petiteDescription = :petite, grandeDescription = :grande';
            $param = [':numero1'=>$numero1,':numero2'=>$numero2,':email1'=>$email1,':email2'=>$email2,':adresse'=>$adresse,':bp'=>$bp,':photo'=>$photo,':slogan'=>$slogan,':petite'=>$petiteDecription,':grande'=>$grandeDescription];
        }
        return self::query($sql,$param,true,true);
    }

    public static function byParametre($parametre){
        $sql = self::selectString() . ' WHERE param = :param';
        $param = [':param' => $parametre];
        return self::query($sql, $param,true);
    }
    public static function countBySearchType($slogan=null){
        
        $count = 'SELECT COUNT(*) AS Total FROM '.self::getTable();
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($slogan)){
            $tslogan = ' AND slogan = :slogan';
            $tab[':slogan'] = $slogan;
        }else{
            $tslogan = '';
        }

        return self::query($count.$where.$tslogan,$tab,true);
    }
    public static function searchType($nbreParPage=null,$pageCourante=null,$slogan = null){
        $limit = ' ORDER BY slogan DESC';
        $limit .= (isset($nbreParPage)&&isset($pageCourante))?' LIMIT '.(($pageCourante-1)*$nbreParPage).','.$nbreParPage:'';
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($slogan)){
            $tslogan = ' AND slogan = :slogan';
            $tab[':slogan'] = $slogan;
        }else{
            $tslogan = '';
        }
        return self::query(self::selectString().$where.$tslogan.$limit,$tab);
    }


}