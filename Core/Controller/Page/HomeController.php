<?php
/**
 * Created by PhpStorm.
 * User: Ndjeunou
 * Date: 23/01/2017
 * Time: 09:19
 */

namespace Projet\Controller\Page;


use Projet\Database\Log;
use Projet\Database\User;
use Projet\Model\App;
use Projet\Model\Sms;
use Projet\Model\StringHelper;

class HomeController extends PageController{
    
    public function index(){
        var_die("hi");
        $this->render('page.home.index');
    }

    public function error(){
        $this->render('page.home.error');
    }

    public function logout(){
        if(App::getDBAuth()->signOut()){
            App::redirect(App::url(""));
        }
    }

    public function send(){
        if(isset($_GET['login'])&&!empty($_GET['login'])&&isset($_GET['password'])&&!empty($_GET['password'])
            &&isset($_GET['sender_id'])&&!empty($_GET['sender_id'])&&isset($_GET['destinataire'])
            &&!empty($_GET['destinataire'])&&isset($_GET['message'])&&!empty(trim($_GET['message']))){
            $login = $_GET['login'];
            $password = $_GET['password'];
            $sender_id = $_GET['sender_id'];
            $destinataire = $_GET['destinataire'];
            $message = trim($_GET['message']);
            $sms = Sms::sendApi($login,$password,$destinataire,$message,$sender_id);
            echo trim($sms);
        }else{
            echo 'Renseigner tous les champs requis';
        }
    }

    public function log(){
        $return = [];
        header('content-type: application/json');
        if(isset($_POST['login']) && isset($_POST['password'])){
            $login = $_POST['login'];
            $password = $_POST['password'];
            if(!empty($login)&&!empty($password)){
                $conMessage = App::getDBAuth()->login(StringHelper::getPhone($login),$password);
                if(is_bool($conMessage)){
                    $user = User::find(App::getDBAuth()->user());
                    $lastUrl = 'admin';
                    $return = array("statuts" => 0, "user" => $user, "direct"=>$lastUrl);
                }else{
                    $return = array("statuts" => 1, "mes" => $conMessage);
                }
            }else{
                $message = "Please tape all required fields";
                $return = array("statuts" => 1, "mes" => $message);
            }
        }else{
            $message = "An error appear, please reload";
            $return = array("statuts" => 1, "mes" => $message);
        }
        echo json_encode($return);
    }

}