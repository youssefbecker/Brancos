<?php
/**
 * Created by PhpStorm.
 * User: Ndjeunou
 * Date: 23/01/2017
 * Time: 09:19
 */

namespace Projet\Controller\Site;


use Exception;
use Projet\Database\Client;
use Projet\Database\Contact;
use Projet\Database\Employe;
use Projet\Database\Entreprise;
use Projet\Database\Log;
use Projet\Database\Message;
use Projet\Database\News;
use Projet\Database\Realisation;
use Projet\Database\Settings;
use Projet\Database\Temoignage;
use Projet\Database\Visite;
use Projet\Model\App;
use Projet\Model\Random;
use Projet\Model\Sms;

class HomeController extends SiteController{
    
    public function index(){
        $temoignages = Temoignage::all();
        $employes = Employe::all();
        $countLikedRealisation = Realisation::countBySearchType();
        $countLikedNews = News::countBySearchType();
        $countClient = Entreprise::count();
        $countVisite = Visite::count();
        $this->render('site.home.index',compact('temoignages','employes','countLikedRealisation','countLikedNews','countClient','countVisite'));
    }

    public function error(){
        $this->render('site.home.error');
    }

    public function reset(){
        $this->render('page.home.reset');
    }

    public function get_date(){
        $return = [];
        header('content-type: application/json');
        if(isset($_GET['key'])&&!empty($_GET['key'])){
            $key = $_GET['key'];
            if($key=='Key_For_Get_Date_Comming_From_Digital_Stock_#@!&'){
                $return = array("statuts" => 0, "date" => date(MYSQL_DATE_FORMAT));
            }else{
                $return = array("statuts" => 1, "mes" => "Bad Key");
            }
        }else{
            $return = array("statuts" => 1, "mes" => "Empty Key");
        }
        echo json_encode($return);
    }

    public function resetAction(){
        $return = [];
        header('content-type: application/json');
        if(isset($_POST['email'])&&!empty($_POST['email'])){
            $email = $_POST['email'];
            $user = Entreprise::byEmail($email);
            if($user&&$user->roles==1){
                $reset = Reset::isExist($email);
                $token = Random::token();
                if($reset){
                    Reset::update($email,$token,DATE_COURANTE);
                }else{
                    Reset::save($email,$token);
                }
                $message = "Vous avez réçu un email à $email, contenant un lien de réinitialisation à cliquer. Ce lien a une validitée de 24 heures.";
                $lien = '<a href="'.App::url('new_password?email='.$email.'&token='.$token).'">créer un nouveau mot de passe</a>';
                $mesMail = "Hi $user->prenom $user->nom, Vous avez lancé la requête de réinitialisation de votre mot de passe; votre requête a été traitée et vous devez l'executer en cliquant sur le lien $lien, Ce lien a une durée de vie de 24 heures, après quoi il sera invalide.";
                $mesMail .= "  <br>Merci de votre confiance<br>L'équipe Littleshopp";
                $emailer = new \Projet\Model\Email($mesMail,$email,"Réinitialisation du mot de passe");
                $emailer->send();
                $mes = $message;
                $return = array("statuts" => 0, "mes" => $message, "mess" => $mes);
            }else{
                $message = "Aucun compte n'est associé à cette adresse email";
                $return = array("statuts" => 1, "mes" => $message);
            }
        }else{
            $message = "Veuillez renseigner votre adresse email";
            $return = array("statuts" => 1, "mes" => $message);
        }
        echo json_encode($return);
    }

    public function resetPassword(){
        $return = [];
        header('content-type: application/json');
        if(isset($_POST['numero'])&&!empty($_POST['numero'])){
            $numero = $_POST['numero'];
            $user = Entreprise::byNumero($numero);
            if($user){
                $code = Random::number(6);
                Entreprise::setCode($code, DATE_COURANTE,$user->id);
                $message = "Vous avez réçu un SMS au $numero, contenant un code de réinitialisation. Ce code a une validité de 24 heures.";
                $emailer = Sms::resultSms($numero,"Hi $user->nom, $code est votre code de vérification pour la réinitialisation de votremot de passe.\n l'équipe Universalis", "Universalis Sarl");
                if(!$emailer){
                    $containForm = '
                                    <form action="'.App::url("login/confirmCode").'" method="post" id="confirmCodeForm">
                                            <div class="form-group">
                                                 <input type="hidden" name="id" value="'.$user->id.'">
                                                <input type="number" name="code" id="code" class="form-control" placeholder="code de confirmation">
                                            </div>
                                            <button class="btn btn-dark btn-block" type="submit" id="submit_code">Valider</button>
                                    </form>
                    ';
                    $return = array("statuts" => 0, "mes" => $message, "content"=>$containForm);
                }else{
                    $message = "Une erreur est survenue lors de l'envoie du message";
                    $return = array("statuts" => 1, "mes" => $message);
                }
            }else{
                $message = "Aucun compte n'est associé à ce numéro";
                $return = array("statuts" => 1, "mes" => $message);
            }
        }else{
            $message = "Veuillez renseigner votre numéro de téléphone";
            $return = array("statuts" => 1, "mes" => $message);
        }
        echo json_encode($return);
    }

    public function confirmCode(){
        header('content-type: application/json');
        if( isset($_POST['code']) && !empty($_POST['code']) && isset($_POST['id']) && !empty($_POST['id'])){
            $code = $_POST['code'];
            $id = $_POST['id'];
            $user = Entreprise::find($id);
            if($user && $user->code == $code){
                if(date(MYSQL_DATE_FORMAT,strtotime($user->dateCode.' +1 day'))>date(MYSQL_DATE_FORMAT)){
                    $content = '
                              <form action="'.App::url("login/newPassword").'" method="post" id="newPasswordForm">
                                      <div class="form-group">
                                            <input type="hidden" name="id" value="'.$user->id.'">
                                            <input type="password" name="password" class="form-control" placeholder="nouveau mot de passe" required>
                                       </div>
                                       <div class="form-group">
                                            <input type="password" name="confirm" class="form-control" placeholder="confirmation" required>
                                       </div>
                                       <button class="btn btn-dark btn-block" type="submit" id="submit_new_password">Valider</button>
                              </form>
                ';
                    $return = array("statuts"=>0, "content"=>$content);
                }else{
                    Entreprise::setCode(null, null, $user->id);
                    $return = array("statuts"=>1, "mes"=>"le code a expiré");
                }
            }else{
                $return = array("statuts"=>1, "mes"=>"code invalide");
            }
        }else{
            $return = array("statuts"=>1, "mes"=>"veuillez entrez le code");
        }
        echo json_encode($return);
    }

    public function newPassword(){
        header('content-type: application/json');
        if(isset($_POST['password'])&&!empty($_POST['password'])&& $_POST['password'] == $_POST['confirm'] && isset($_POST['id']) && !empty($_POST['id'])){
            $password = $_POST['password'];
            $id = $_POST['id'];
            $user = Entreprise::find($id);
            if($user && $user->code){
                Entreprise::setPassword(sha1($password), $id);
                Entreprise::setCode(null, null, $id);
                $isLog = App::getDBAuth()->login($user->numero, $password);
                if( $isLog){
                    $setting = Settings::find(1);
                    $return = array("statuts"=>0, "mes"=>"Succès de la réinitialisation", "url"=>App::url("account"));
                }
            }else{
                $return = array("statuts"=>1, "mes"=>"Une erreur est survenue");
            }
        }else{
            $return = array("statuts"=>1, "mes"=>"Les mots de passe ne correspondent pas");
        }
        echo json_encode($return);
    }

    public function new_password(){
        if(isset($_GET['email'])&&!empty($_GET['email'])&&isset($_GET['token'])&&!empty($_GET['token'])){
            $email = $_GET['email'];
            $token = $_GET['token'];
            $reset = Reset::isExist($email);
            if($reset){
                $valid = date(MYSQL_DATE_FORMAT,strtotime($reset->created_at.' +1 day'))>date(MYSQL_DATE_FORMAT)&&$reset->token==$token?"yes":"";
                $this->render('page.home.newpassword',compact('email','valid'));
            }else{
                App::error();
            }
        }else{
            App::error();
        }
    }

    public function renewAction(){
        $return = [];
        header('content-type: application/json');
        if(isset($_POST['email'])&&!empty($_POST['email'])&&isset($_POST['password'])&&!empty($_POST['password'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            if(strlen($password) >= 6){
                $userEmail = Entreprise::byEmail($email);
                if($userEmail){
                    $pdo = App::getDb()->getPDO();
                    try{
                        $pdo->beginTransaction();
                        Entreprise::setPassword(sha1($password),$userEmail->id);
                        $message = "$userEmail->prenom, votre mot de passe a été réinitialisé avec succès";
                        $this->session->write('success', $message.", connecter à vous à votre compte");
                        $lien = App::url('login');
                        $pdo->commit();
                        $return = array("statuts" => 0, "mes" => $message.", redirection en cours...", "direct" => $lien);
                    }catch (Exception $e){
                        $pdo->rollBack();
                        $message = "Une erreur est survenue";
                        $return = array("statuts" => 1, "mes" => $message);
                    }
                }else{
                    $message = "Une erreur est survenue";
                    $return = array("statuts" => 1, "mes" => $message);
                }
            }else{
                $message = "Le mot de passe doit posséder au moins 6 caractères";
                $return = array("statuts" => 1, "mes" => $message);
            }
        }else{
            $message = "Une erreur est survenue";
            $return = array("statuts" => 1, "mes" => $message);
        }
        echo json_encode($return);
    }

    public function login(){
        $this->middleware();
        $this->render('page.home.login');
    }


    public function logout(){
        if(App::getDBAuth()->signOut()){
            App::redirect(App::url(""));
        }
    }

    public function log(){
        $return = [];
        header('content-type: application/json');
        if(isset($_POST['login']) && isset($_POST['password'])){
            $login = $_POST['login'];
            $password = $_POST['password'];
            if(!empty($login)&&!empty($password)){
                $conMessage = App::getDBAuth()->login($login,$password);
                if(is_bool($conMessage)){
                    $this->session->write('success',"Content de vous revoir");
                    $lien = empty($this->session->read('lastUrlAsked'))?App::url('account'):$this->session->read('lastUrlAsked');
                    $this->session->delete('lastUrlAsked');
                    $return = array("statuts" => 0, "direct"=>$lien);
                }else{
                    $return = array("statuts" => 1, "mes" => $conMessage);
                }
            }else{
                $message = "Renseignez tous les champs";
                $return = array("statuts" => 1, "mes" => $message);
            }
        }else{
            $message = "Renseignez tous les champs";
            $return = array("statuts" => 1, "mes" => $message);
        }
        echo json_encode($return);
    }

    public function register(){
        $return = [];
        header('content-type: application/json');
        if( isset($_POST['numero']) && isset($_POST['nom']) && !empty($_POST['numero']) && isset($_POST['pass'])
            && !empty($_POST['pass']) && isset($_POST['confirm']) && isset($_POST['email'])){
            $nom = !empty($_POST['nom']) ? $_POST['nom'] : "Invité";
            $password = $_POST['pass'];
            $email = $_POST['email'];
            $confirm = $_POST['confirm'];
            $numero = $_POST['numero'];
            $client = Entreprise::byNumero($numero);
            if($password == $confirm){
                if(!$client){
                    $this->isValidPhoneNumber($numero,9);
                    $pdo = App::getDb()->getPDO();
                    try{
                        $pdo->beginTransaction();
                        $api = Sms::newCustomer($nom,$numero,$password,$email);
                        if($api=="1"||$api==2){
                            Entreprise::save($nom,$numero,$password,$email);
                            //$idLast = Entreprise::lastId();
                            Sms::resultSms($numero,"Hi $nom, votre compte a été crée avec succès.\n Login: $numero\nMot de passe: $password.Merci de rejoindre notre communaute\nL'equipe Universalis","UNIVERSALIS");
                            $message = "Votre compte a été créé avec succès";
                            $this->session->write('success',$message);
                            $lien = empty($this->session->read('lastUrlAsked'))?App::url('account'):$this->session->read('lastUrlAsked');
                            $this->session->delete('lastUrlAsked');
                            $pdo->commit();
                            //$this->session->write('dbauth',$idLast);
                            App::getDBAuth()->login($numero, $password);
                            $return = array("statuts" => 0, "mes" => $message, "direct"=>$lien);
                        }else{
                            $pdo->rollBack();
                            $return = array("statuts" => 1, "mes" => $api);
                        }
                    }catch (Exception $e){
                        $pdo->rollBack();
                        $message = "Une erreur est survenue";
                        $return = array("statuts" => 1, "mes" => $message);
                    }
                }else{
                    $message = "Ce numéro de téléphone est déjà utilisé!";
                    $return = array("statuts" => 1, "mes" => $message);
                }
            }else{
                $message = "Les mots de passe doivent être identiques";
                $return = array("statuts" => 1, "mes" => $message);
            }
        }else{
            $message = "Svp renseignez correctement tous les champs obligatoires";
            $return = array("statuts" => 1, "mes" => $message);
        }
        echo json_encode($return);
    }

    public function middleware(){
        if(App::getDBAuth()->isLogged()){
            App::redirect(App::url("home"));
            $this->session->write("danger","Cette page est indisponible en mode connection");
        }
    }

    public function addContact(){
        $user = App::getDBAuth()->user();
        if(!$user){
            App::redirect(ROOT_URL."login");
        }

        header('content-type: application/json');
        if (isset($_POST['numero'])&&!empty($_POST['numero']) && is_numeric($_POST['numero'])){
            $nom = $_POST['nom'];
            $numero = $_POST['numero'];

            if( isset($_POST['id']) && !empty($_POST['id']) ){
                $id = $_POST['id'];
                $pdo = App::getDb()->getPDO();
                try{
                    $pdo->beginTransaction();
                    Contact::edit($nom,$numero, $id);
                    $message = "contact modifié avec succès";
                    $pdo->commit();
                    $return = array("statuts"=>0,"mes"=>$message);
                }catch(Exception $e){
                    $pdo->rollBack();
                    $message = "Une erreur est survenue ".$e->getMessage();
                    $return = array("statuts"=>1,"mes"=>$message);
                }
            }else{
                $id = App::getDBAuth()->user()->id;
                $pdo = App::getDb()->getPDO();
                try{
                    $pdo->beginTransaction();
                    Contact::save($nom,$numero, $id);
                    $message = "contact ajouté avec succès";
                    $pdo->commit();
                    $return = array("statuts"=>0,"mes"=>$message);
                }catch(Exception $e){
                    $pdo->rollBack();
                    $message = "Une erreur est survenue";
                    $return = array("statuts"=>1,"mes"=>$message);
                }
            }

        }else{
            $message = "Veuillez renseigner tous les champs requis";
            $return = array("statuts"=>1,"mes"=>$message);
        }
        echo json_encode($return);
    }

    public function sentMessage(){
        $user = App::getDBAuth()->user();
        if(!$user){
            App::redirect(ROOT_URL."login");
        }else{
            header('content-type: application/json');
            $error = "";
            if (isset($_POST['numero'])&&!empty($_POST['numero']) && isset($_POST['message']) && !empty($_POST['message']) ){
                $message = $_POST['message'];
                $user = App::getDBAuth()->user();
                $numeros = explode(';', $_POST['numero']);
                //faite une bloucle pour envoyer des sms à diff personnnes et ainsi à ecrire dans la BD
                foreach ($numeros as $numero){
                    if(is_numeric($numero)){
                        $sms = Sms::resultSms($user->numero, $message,$user->nom);
                        if(!$sms){
                            $id = $user->id;
                            $pdo = App::getDb()->getPDO();
                            try{
                                $pdo->beginTransaction();
                                Message::save($message,$id, $numero);
                                $message = "contact ajouter avec succès";
                                $pdo->commit();
                                $return = array("statuts"=>0,"mes"=>$message);
                            }catch(Exception $e){
                                $pdo->rollBack();
                                $return = array("statuts"=>1,"mes"=>"Une erreur est survenue");
                            }
                        }else{
                            $error .= $numero." ";
                        }
                    }else{
                        if( $numero != "" && $numero != " "){
                            $error .= $numero." ";
                        }
                    }
                }
                if($error == ""){
                    $return = array("statuts"=>0, "mes"=>"message envoyé avec succès");
                }else{
                    $return = array("statuts"=>2, "mes"=>"message envoyé avec succès", "error"=>"le message n'a pas été envoyé au(x) numéro(s): ".$error);
                }
            }else{
                $return = array("statuts"=>1,"mes"=>"Veuillez renseigner tous les champs requis");
            }
            echo json_encode($return);
        }
    }

}