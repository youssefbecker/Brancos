<?php
/**
 * Created by PhpStorm.
 * User: Ross
 * Date: 8/17/2018
 * Time: 3:47 PM
 */

namespace Projet\Controller\Membre;


use Projet\Controller\Site\SiteController;
use Projet\Database\Entreprise;
use Projet\Model\App;
use Projet\Model\Router;

class MembreController extends SiteController {

    protected $user;
    public $error = "Soucis lors de l'execution de la requête, recharger et réessayer";
    public $empty = "SVP renseigner correctement tous les champs requis";

    public function __construct(){
        parent::__construct();
        $auth = App::getDBAuth();
        if($auth->isLogged()){
            $user = Entreprise::find($auth->user()->id);
            $this->user = $user;
        }else{
            $this->session->write('lastUrlAsked',App::url(Router::getRoute()));
            $this->session->write('warning',"Vous devrez d'abord vous inscrire ou vous connecter");
            App::interdit();
        }
    }

}