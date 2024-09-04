<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 22/05/2017
 * Time: 11:07
 */

namespace Projet\Database;


use Projet\Model\Table;

class Gallery extends Table{

    protected static $table = 'gallery';

    public static function save($path,$nom){
        $sql = 'INSERT INTO '.self::getTable().' SET path = :path,nom = :nom';
        $param = [':path'=>$path,':nom'=>$nom];

        return self::query($sql,$param,true,true);
    }

    public static function searchType($nbreParPage=null,$pageCourante=null){
        $limit = ' ORDER BY path DESC';
        $limit .= (isset($nbreParPage)&&isset($pageCourante))?' LIMIT '.(($pageCourante-1)*$nbreParPage).','.$nbreParPage:'';
        return self::query(self::selectString().$limit);
    }

}