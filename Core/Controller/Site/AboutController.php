<?php
/**
 * Created by PhpStorm.
 * User: Ndjeunou
 * Date: 23/01/2017
 * Time: 09:19
 */

namespace Projet\Controller\Site;


use Exception;
use Projet\Database\Devis;
use Projet\Database\Email;
use Projet\Database\Employe;
use Projet\Database\Gallery;
use Projet\Database\Partenaire;
use Projet\Database\Settings;
use Projet\Database\Suggestion;
use Projet\Database\Temoignage;
use Projet\Model\App;

class AboutController extends SiteController{
    
    public function index(){
        $partenaires = Partenaire::all();
        $clients = Temoignage::searchType();
        $setting = Settings::find(1);
        $this->render('site.home.apropos',compact('clients','setting','partenaires'));
    }

    public function contact(){
        $setting = Settings::find(1);
        $user = $this->auth->user();
        if ($user){
            $isEmptyEmail = $user->email?'hidden':'';
            $valEmail =  '<div class="col-sm-6  '.$isEmptyEmail.' ">
                              <input class="input form-control"type="email" id="email" placeholder="Adresse email *" value="'.$user->email.'">
                           </div>';
            $valTel =  '<div class="col-sm-6" hidden>
                            <input autocomplete="tel" class="input form-control" type="text" id="numero" placeholder="Numéro de téléphone *" value="'.$user->numero.'">
                        </div>';
            $valNom =  '<div class="row">
                            <div class="col-sm-12" hidden>
                               <input autocomplete="name" class="input form-control" type="text" id="name" placeholder="Nom complet *" value="'.$user->nom.'">
                            </div>
                         </div>';
        }
        else{
            $valEmail= '<div class="col-sm-6 ">
                              <input class="input form-control"type="email" id="email" placeholder="Adresse email *">
                           </div>';
            $valTel =  '<div class="col-sm-6">
                            <input autocomplete="tel" class="input form-control" type="text" id="numero" placeholder="Numéro de téléphone *">
                        </div>';
            $valNom =  '<div class="row pt-3">
                            <div class="col-sm-12">
                               <input autocomplete="name" class="input form-control" type="text" id="name" placeholder="Nom complet *">
                            </div>
                         </div>';
        }
        $this->render('site.home.contact',compact('setting','valEmail','valTel','valNom'));
    }

    public function boutique(){
        $setting = Settings::find(1);
        $this->render('site.home.boutique',compact('setting'));
    }

    public function login(){
        $this->render('user.page.login');
    }

    public function register(){
        $setting = Settings::find(1);
        $this->render('site.user.register',compact('setting'));
    }


    public function team(){
        $setting = Settings::find(1);
        $employes = Employe::all();
        $this->render('site.about.team',compact('setting','employes'));
    }

    public function equipments(){
        $setting = Settings::find(1);
        $galeries = Gallery::all();
        $this->render('site.about.equipements',compact('setting','galeries'));
    }

    public function subscribe(){
        header('content-type: application/json');
        if (isset($_POST['email'])&&!empty($_POST['email'])){
            $email = $_POST['email'];
            $pdo = App::getDb()->getPDO();
            try{
                $pdo->beginTransaction();
                Email::save($email);
                $message = "$email a été abonné avec succès à notre Newsletter, vous recevrez régulièrement les bons plans et informations";
                $pdo->commit();
                $return = array("statuts"=>0,"mes"=>$message);
            }catch(Exception $e){
                $pdo->rollBack();
                $message = "Une erreur est survenue";
                $return = array("statuts"=>1,"mes"=>$message);
            }
        }else{
            $message = "Veuillez renseigner l'adresse email";
            $return = array("statuts"=>1,"mes"=>$message);
        }
        echo json_encode($return);
    }

    public function save(){
        header('content-type: application/json');
        if ((isset($_POST['name'])&&!empty($_POST['name']))&&isset($_POST['email'])&&(isset($_POST['numero'])&&!empty($_POST['numero']))
            &&(isset($_POST['sujet'])&&!empty($_POST['sujet']))&&(isset($_POST['message'])&&!empty($_POST['message']))){
            $nom = $_POST['name'];
            $numero = $_POST['numero'];
            $email = $_POST['email'];
            $sujet = $_POST['sujet'];
            $message = $_POST['message'];
            $pdo = App::getDb()->getPDO();
            try{
                $pdo->beginTransaction();
                Suggestion::save($nom,$numero,$email,$sujet,$message);
                $message = "$nom, votre suggestion a été transmise avec succès, on vous répondra dans de brefs délais";
                $pdo->commit();
                $return = array("statuts"=>0,"mes"=>$message);
            }catch(Exception $e){
                $pdo->rollBack();
                $message = "Une erreur est survenue";
                $return = array("statuts"=>1,"mes"=>$message);
            }
        }else{
            $message = "Veuillez renseigner tous les champs requis";
            $return = array("statuts"=>1,"mes"=>$message);
        }
        echo json_encode($return);
    }

    public function command(){
        header('content-type: application/json');
        if ((isset($_POST['nom'])&&!empty($_POST['nom']))&&(isset($_POST['prenom'])&&!empty($_POST['prenom']))
            &&isset($_POST['email'])&&isset($_POST['bp'])&&isset($_POST['support'])&&isset($_POST['entreprise'])&&isset($_POST['nbre'])&&isset($_POST['format'])&&isset($_POST['service'])
            &&(isset($_POST['numero'])&&!empty($_POST['numero']))&&(isset($_POST['adresse'])&&!empty($_POST['adresse']))&&(isset($_POST['message'])&&!empty($_POST['message']))){
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $bp = $_POST['bp'];
            $adresse = $_POST['adresse'];
            $entreprise = $_POST['entreprise'];
            $service = $_POST['service'];
            $support = $_POST['support'];
            $nbre = $_POST['nbre'];
            $format = $_POST['format'];
            $numero = $_POST['numero'];
            $email = $_POST['email'];
            $message = $_POST['message'];
            $pdo = App::getDb()->getPDO();
            try{
                $pdo->beginTransaction();
                Devis::save($nom.' '.$prenom,$numero,$email,$entreprise,$bp,$adresse,$service,$format,$nbre,$support,$message);
                $message = "$nom, votre commande a été transmise avec succès, nous vous répondrons dans de brefs délais";
                $pdo->commit();
                $return = array("statuts"=>0,"mes"=>$message);
            }catch(Exception $e){
                $pdo->rollBack();
                $message = "Une erreur est survenue";
                $return = array("statuts"=>1,"mes"=>$message);
            }
        }else{
            $message = "Veuillez renseigner tous les champs requis";
            $return = array("statuts"=>1,"mes"=>$message);
        }
        echo json_encode($return);
    }

}