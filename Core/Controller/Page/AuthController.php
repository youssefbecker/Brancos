<?php
/**
 * Created by PhpStorm.
 * User: Ndjeunou
 * Date: 23/01/2017
 * Time: 09:21
 */

namespace Projet\Controller\Page;


use Projet\Controller\Site\SiteController;
use Projet\Database\Notification;
use Projet\Database\Preference;
use Projet\Database\Settings;
use Projet\Database\Verification;
use Projet\Model\App;

class AuthController extends SiteController {

    public function middleware(){
        if(App::getDBAuth()->isLogged()){
            App::redirect(App::url("sms_api/account"));
            $this->session->write("danger","Cette ressource est indisponible en mode connexion");
        }
    }

    public function login(){
        $setting = Settings::find(1);
        $this->middleware();
        $this->render('site.home.login', compact('setting'));
    }

    public function register(){
        $this->middleware();
        $this->render('home.page.register');
    }

}