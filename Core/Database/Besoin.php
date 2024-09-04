<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 22/05/2017
 * Time: 11:07
 */

namespace Projet\Database;


use Projet\Model\Table;

class Besoin extends Table{

    protected static $table = 'besoin';

    public static function searchType($nbreParPage=null,$pageCourante=null){
        $limit = ' ORDER BY intitule';
        $limit .= (isset($nbreParPage)&&isset($pageCourante))?' LIMIT '.(($pageCourante-1)*$nbreParPage).','.$nbreParPage:'';
        return self::query(self::selectString().$limit);
    }

}