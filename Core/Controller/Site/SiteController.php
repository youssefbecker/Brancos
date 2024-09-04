<?php
/**
 * Created by PhpStorm.
 * User: Poizon
 * Date: 17/07/2015
 * Time: 13:14
 */

namespace Projet\Controller\Site;

use Projet\Database\Produit;
use Projet\Database\reals;
use Projet\Database\Visite;
use Projet\Model\App;
use Projet\Model\Controller;

class SiteController extends Controller {

    protected $template = 'Templates/site';
    public $error = "Une erreur est survenue, recharger !";

    public function __construct(){
        parent::__construct();
        //$this->addVisite();
        $this->viewPath = 'Views/';
    }

    public function addVisite(){
        $ip = $_SERVER['REMOTE_ADDR'];
        $exist = Visite::exist($ip,date(MYSQL_DATE_FORMAT));
        if(!$exist){
            $data = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip={$ip}"));
            $locate = '('.$data->geoplugin_latitude.' , '.$data->geoplugin_longitude.')';
            $pay = !empty($data->geoplugin_country)?$data->geoplugin_country:'';
            $reg = !empty($data->geoplugin_region)?', '.$data->geoplugin_region:'';
            $cit = !empty($data->geoplugin_city)?', '.$data->geoplugin_city:'';
            $region = $pay.$reg.$cit;
            Visite::save($ip,$locate,$this->getOS().' , '.$this->getBrowser(),$region);
        }
    }
    public function price(){
        $prices1 = Produit::searchType(3,1);
        $prices2 = Produit::searchType(3,2);
        $this->render('site.home.price',compact('prices1','prices2'));
    }

    public function isValidPhoneNumber($number,$size){
        $if = is_numeric($number)&&strlen($number)==$size;
        if(!$if){
            if(is_ajax()){
                $message = "Votre numéro de téléphone est invalide, Il doit avoir $size chiffres";
                $return = array("statuts" => 1, "mes" => $message);
                echo json_encode($return);
                exit();
            }else{
                App::error();
            }
        }
    }


}
