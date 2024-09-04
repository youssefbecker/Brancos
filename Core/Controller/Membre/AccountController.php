<?php
/**
 * Created by PhpStorm.
 * User: Ndjeunou
 * Date: 23/01/2017
 * Time: 09:19
 */

namespace Projet\Controller\Membre;


use DateTime;
use Exception;
use Projet\Database\Besoin;
use Projet\Database\Besoin_Commander;
use Projet\Database\Commander;
use Projet\Database\Contact;
use Projet\Database\Evenement;
use Projet\Database\Rappel;
use Projet\Database\Settings;
use Projet\Model\App;
use Projet\Model\CommandeSms;
use Projet\Model\DateParser;
use Projet\Model\FileHelper;
use Projet\Model\Random;

class AccountController extends MembreController {

    public function commander(){
        $user = $this->user;
        $setting = Settings::find(1);
        $this->render('site.home.commander',compact('setting','user'));
    }

    public function commandes(){
        $user = $this->user;
        $setting = Settings::find(1);
        $contactsMessage = Contact::searchType($user->id);
        $nbreParPage = 5;
        if(isset($_GET['search'])){
            $search = (!empty($_GET['search'])) ? $_GET['search'] : null;
            $nbre = Commander::countBySearchType($user->id, $search);
            $nbrePages = ceil($nbre->Total / $nbreParPage);
            if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbrePages) {
                $pageCourante = $_GET['page'];
            } else {
                $pageCourante = 1;
                $params['page'] = $pageCourante;
            }
            $commandes = Commander::searchType($user->id, $nbreParPage, $pageCourante, $search);
        }else{
            $nbre = Commander::countBySearchType($user->id);
            $nbrePages = ceil($nbre->Total / $nbreParPage);
            if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbrePages) {
                $pageCourante = $_GET['page'];
            } else {
                $pageCourante = 1;
                $params['page'] = $pageCourante;
            }
            $commandes = Commander::searchType($user->id, $nbreParPage, $pageCourante);
        }
        $this->render('site.home.commandes',compact('setting','user','commandes', 'nbre', 'nbrePages', 'contactsMessage'));
    }

    public function showDevis(){
        header("content-type: application/json");
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $id = $_GET['id'];
            $etat = Commander::isDevis($id,$this->user->id);
            if($etat->etat == 1){
                $commande = Commander::byId($id, $this->user->id);
                $message = '
                          <div class="container text-secondary">
                                <div class="row mb-2">
                                    <div class="col-md-12"><b><u>'.DateParser::DateConviviale($commande->dateDevis).'</u></b></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"><b>Type:</b> '.$commande->type.'</div>
                                    <div class="col-md-6"><b>Description:</b> '.$commande->description.'</div>
                                </div>
                                <div class="row mt-5">
                                      <div class="col-md-12"><b>Explication: </b>'.$commande->explication.'</div>
                                      <div class="col-md-12 m-3">
                                        <a href="'.$commande->devis.'" download="download" title="télécharger la fiche du devis" style="font-size: 1.5em">
                                            <i class="fa fa-print"></i>Télécharger la fiche du devis:
                                       </a>
                                     </div>
                                      <div class="col-md-12 border-dark border text-right">Côut: <b>'.$commande->cout.'</b></div>
                                </div>
                          </div>
                ';
                $return = array("statuts"=>0, "mes"=>$message);
            }else{
                $message = "<div class='row text-danger justify-content-center'><b>Le devis n'a pas encore été éffectué</b></div>";
                $return = array("statuts"=>0, "mes"=>$message);
            }
        }else{
            $message = "<div class='row text-danger justify-content-center'><b>Une erreur est survenue</b></div>";
            $return = array("statuts"=>0, "mes"=>$message);
        }

        echo json_encode($return);
    }

    public function saveCommande(){
        header('content-type: application/json');
        $return = [];
        $user = $this->user;

        /*$webApp = array("web"=>"Site Web", "gestion"=>"Application de Gestion", "planification"=>"Application de plannification");
        $smartphone = array("android"=>"Application Android", "ios"=>"Application IOS", "windows"=>"Application Windows Phone");
        $desktop = array("java"=>"application en java", "python"=>"application en python", "c++"=>" application en c++");
        $descriptions = array_merge($webApp, $smartphone, $desktop);
        $types = array("web"=>"Application web","desktop"=>"Application desktop","smartphone"=>"Application smartphone");
        $whats = array(""=>"","domaine"=>"Un nom de domaine", "local"=>"Un reseau local pour deployer", "serveur-web-domaine"=>"Un serveur Web et un nom de domaine","serveur-web"=>"Un serveur Web sur internet");
        $correspond = array("web"=>$webApp,"smartphone"=>$smartphone,"desktop"=>$desktop);
        */
        if (isset($_POST['besoin']) && isset($_POST['description'])){
            $besoins = $_POST['besoin'];
            $description = $_POST['description'];
            $reference = Random::referenceCommande();
            $idBesoins = $lesbesoins = "";
            $bool = true;
            $i = 0;
            foreach ($besoins as $besoin) {
                $item = Besoin::find($besoin);
                if($item){
                    $idBesoins .= $i == 0 ? $item->id : ", $item->id";
                    $lesbesoins .= $i == 0 ? $item->intitule : ", $item->intitule";
                    $i++;
                }else{
                    $bool = false;
                }
            }
            if($bool){
                $pdo = App::getDb()->getPDO();
                try{
                    $pdo->beginTransaction();
                    Commander::saveFirst($this->user->id,$description,$reference,$idBesoins,$lesbesoins);
                    $lastId = Commander::lastId();
                    foreach ($besoins as $besoin) {
                        Besoin_Commander::save($besoin,$lastId);
                    }
                    $boolCharge = true;
                    if(isset($_FILES['charge']['name']) && !empty($_FILES['charge']['name'])){
                        $extensions_valides = array('pdf', 'doc','docx');
                        $extension_upload = strtolower(  substr(  strrchr($_FILES['charge']['name'], '.')  ,1)  );
                        if(in_array($extension_upload,$extensions_valides) && in_array($extension_upload,$extensions_valides) ){
                            if($_FILES['charge']['size'] <= 10000000){
                                $root = FileHelper::moveImage($_FILES['charge']['tmp_name'],"charges",$extension_upload,"",true);
                                if($root){
                                    Commander::setCahierDeCharge($root,$lastId);
                                }else{
                                    $boolCharge = "Une erreur est survenue lors de l'envoie du fichier";
                                }
                            }else{
                                $boolCharge = "Ce fichier est très lourd. Ajoutez un fichier de taille inferieure à  \"10 Mo\"";
                            }
                        }else{
                            $boolCharge = "L'image doit être un fichier PDF ou WORD";
                        }
                    }
                    if(is_bool($boolCharge)){
                        $message = $user->nom.", Votre commande a été mise à jour avec succès, vous recevrez un dévis dans au plus 24 heures";
                        $pdo->commit();
                        $this->session->write('success', $message);
                        $return = array("statuts"=>0,"mes"=>$message);
                    }else{
                        $pdo->rollBack();
                        $return = array("statuts"=>1,"mes"=>$boolCharge);
                    }
                }catch(Exception $e){
                    $pdo->rollBack();
                    $message = "Une erreur est survenue";
                    $return = array("statuts"=>1,"mes"=>$message);
                }
            }else{
                $return = array("statuts"=>1,"mes"=>"Une erreur est survenue, veuillez rechargez et reessayez");
            }
        }else{
            $message = "Veuillez renseigner tous les champs requis!!";
            $return = array("statuts"=>1,"mes"=>$message);
        }
        echo json_encode($return);
    }

    public function detailsCommande(){
        header('content-type: application/json');
        $return = [];
        if(isset($_POST['id'])&&!empty($_POST['id'])){
            $id = $_POST['id'];
            $command = Commander::find($id);
            if ($command){
                $etat = Commander::isDevis($id);
                $entete = 'Détails de la commande '.$command->reference;
                $valDevis = ($etat->etat!=0)?'
                                <tr>
                                    <td class="text-left">Devis</td>
                                    <td class="text-center"><a href="'.FileHelper::url($command->devis).'" class="">Visualiser</a></td>
                                </tr>':'';
                $content = '
                    <div class="panel">
                        <div class="panel-body">
                            <table class="table table-hover table-bordered table-striped m-t-sm">
                                <tboody>
                                <tr>
                                    <td class="text-left">Type du Besoin</td>
                                    <td class="text-center">'.$command->besoins.'</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Description du besoin</td>
                                    <td class="text-center">'.$command->description.'</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Etablie le</td>
                                    <td class="text-center">'.DateParser::DateConviviale($command->created_at).'</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Cahier de charges</td>
                                    <td class="text-center"><a href="'.FileHelper::url($command->charge).'" class="">Visualiser</a></td>
                                </tr>
                                '.$valDevis.'
                                </tboody>
                            </table>
                        </div>
                    </div>
                            
                    ';
                $return = array("entete"=>$entete,"content"=>$content);
            }else{

            }
        }
        echo json_encode($return);
    }

    public function updateCommande(){
        header('content-type: application/json');
        $return = [];
        if(isset($_POST['id'])&&!empty($_POST['id'])){
            $id = $_POST['id'];
            $command = Commander::find($id);
            if ($command){
                $etat = Commander::isDevis($id);
                if ($etat->etat == 0) {
                    $titre = 'MODIFIER LA COMMANDE  '.$command->reference;
                    $description = $command->description;
                    $idCommande = $command->id;
                    $besoin = str_replace(' ','',trim($command->idBesoins));
                    $return = array("titre"=>$titre,"description"=>$description,"idCommande"=>$idCommande,"besoins"=>$besoin);
                } else {
                    # code...
                }
            }else{

            }
        }
        echo json_encode($return);
    }

    public function account(){
        $user = $this->user;
        $contactsMessage = Contact::searchType($user->id);
        $nbreParPage = 20;
        if(isset($_GET['search'])){
            $search = (!empty($_GET['search'])) ? $_GET['search'] : null;
            $nbre = Contact::countBySearchType($user->id, $search);
            $nbrePages = ceil($nbre->Total / $nbreParPage);
            if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbrePages) {
                $pageCourante = $_GET['page'];
            } else {
                $pageCourante = 1;
                $params['page'] = $pageCourante;
            }
            $contacts = Contact::searchType($user->id, $nbreParPage, $pageCourante, $search);
        }else{
            $nbre = Contact::countBySearchType($user->id);
            $nbrePages = ceil($nbre->Total / $nbreParPage);
            if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbrePages) {
                $pageCourante = $_GET['page'];
            } else {
                $pageCourante = 1;
                $params['page'] = $pageCourante;
            }
            $contacts = Contact::searchType($user->id, $nbreParPage, $pageCourante);

        }
        $this->render('site.home.account',compact('user', 'contacts', 'contactsMessage', 'nbreParPage', 'nbrePages', 'nbre'));
    }

    public function contact(){
        $user = $this->user;
        $contactsMessage = Contact::searchType($user->id);
        $nbreParPage = 20;
        $search = (isset($_GET['search'])&&!empty($_GET['search'])) ? $_GET['search'] : null;
        $nbre = Contact::countBySearchType($user->id, $search);
        $nbrePages = ceil($nbre->Total / $nbreParPage);
        if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbrePages) {
            $pageCourante = $_GET['page'];
        } else {
            $pageCourante = 1;
            $params['page'] = $pageCourante;
        }
        $contacts = Contact::searchType($user->id, $nbreParPage, $pageCourante, $search);
        $this->render('site.home.contacts',compact('user', 'contacts', 'contactsMessage', 'nbreParPage', 'nbrePages', 'nbre'));
    }

    public function rappels(){
        $user = $this->user;
        if(isset($_GET['id'])&&!empty($_GET['id'])){
            $id = $_GET['id'];
            $campagne = Evenement::find($id);
            if($campagne){
                $contactsMessage = Contact::searchType($user->id);
                $nbreParPage = 20;
                $nbre = Rappel::countBySearchType($id,$user->id);
                $nbrePages = ceil($nbre->Total / $nbreParPage);
                if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbrePages) {
                    $pageCourante = $_GET['page'];
                } else {
                    $pageCourante = 1;
                    $params['page'] = $pageCourante;
                }
                $rappels = Rappel::searchType($nbreParPage, $pageCourante, $id,$user->id);
                $this->render('site.home.rappels',compact('user', 'rappels', 'contactsMessage', 'campagne', 'nbrePages', 'nbre'));
            }else{
                App::error();
            }
        }else{
            App::error();
        }
    }

    public function evenement(){
        $user = $this->user;
        $contactsMessage = Contact::searchType($user->id);
        $nbreParPage = 10;
        $search = (isset($_GET['search'])&&!empty($_GET['search'])) ? $_GET['search'] : null;
        $nbre = Evenement::countBySearchType($user->id, $search);
        $nbrePages = ceil($nbre->Total / $nbreParPage);
        if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbrePages) {
            $pageCourante = $_GET['page'];
        } else {
            $pageCourante = 1;
            $params['page'] = $pageCourante;
        }
        $evenements = Evenement::searchType($nbreParPage, $pageCourante,$user->id, $search);
        $this->render('site.home.evenement',compact('user', 'contactsMessage','evenements', 'nbreParPage', 'nbrePages', 'nbre'));
    }

    public function history(){
        $user = $this->user;
        $contactsMessage = Contact::searchType($user->id);
        $this->render('site.home.history', compact('user', 'contactsMessage'));
    }

    public function message(){
        $user = $this->user;
        $setting = Settings::find(1);
        $this->render('site.home.message', compact('setting', 'user'));
    }

    public function addContact(){
        $user = $this->user;
        header('content-type: application/json');
        if (isset($_POST['nom'])&&isset($_POST['email'])&&isset($_POST['numero'])&&!empty($_POST['numero'])){
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $numero = $_POST['numero'];
            $this->isValidPhoneNumber($numero,9);
            if(isset($_POST['id'])){
                $id = $_POST['id'];
                $item = Contact::find($id);
                if($item&&$item->id_entreprise==$user->id){
                    $bool = true;
                    if($item->numero!=$numero && Contact::byNumero($numero,$user->id)){
                        $bool = false;
                    }
                    if($bool){
                        $pdo = App::getDb()->getPDO();
                        try{
                            $pdo->beginTransaction();
                            Contact::save($nom, $numero,$email, $user->id, $id);
                            $message = "Contact modifié avec succès";
                            $pdo->commit();
                            $this->session->write("success", $message);
                            $return = array("statuts"=>0,"mes"=>$message);
                        }catch(Exception $e){
                            $pdo->rollBack();
                            $return = array("statuts"=>1,"mes"=>$this->error);
                        }
                    }else{
                        $message = "Ce groupe existe déjà";
                        $return = array("statuts" => 1, "mes" => $message);
                    }
                }else{
                    $return = array("statuts"=>1,"mes"=>$this->error);
                }
            }else{
                if(!Contact::byNumero($numero,$user->id)){
                    $pdo = App::getDb()->getPDO();
                    try{
                        $pdo->beginTransaction();
                        Contact::save($nom,$numero,$email,$user->id);
                        $message = "Contact ajouté avec succès";
                        $pdo->commit();
                        $this->session->write("success", $message);
                        $return = array("statuts"=>0,"mes"=>$message);
                    }catch(Exception $e){
                        $pdo->rollBack();
                        $return = array("statuts"=>1,"mes"=>$this->error);
                    }
                }else{
                    $message = "Ce contact existe déjà";
                    $return = array("statuts" => 1, "mes" => $message);
                }
            }

        }else{
            $message = "Veuillez renseigner tous les champs requis";
            $return = array("statuts"=>1,"mes"=>$message);
        }
        echo json_encode($return);
    }

    public function addRappel(){
        $user = $this->user;
        header('content-type: application/json');
        if (isset($_POST['date'])&&!empty($_POST['date'])&&isset($_POST['contenu'])&&!empty($_POST['contenu'])
            &&isset($_GET['id'])&&!empty($_GET['id'])){
            $idEvenement = $_GET['id'];
            $date = new DateTime($_POST['date']);
            $contenu = $_POST['contenu'];
            $evenement = Evenement::find($idEvenement);
            if($evenement){
                if(isset($_POST['id'])){
                    $id = $_POST['id'];
                    $item = Rappel::find($id);
                    if($item&&$item->idClient==$user->id){
                        $pdo = App::getDb()->getPDO();
                        try{
                            $pdo->beginTransaction();
                            Rappel::save($user->id,$idEvenement,$date->format(MYSQL_DATETIME_FORMAT),$contenu,$evenement->nom,$id);
                            $message = "Ligne de rappel modifiée avec succès";
                            $pdo->commit();
                            $this->session->write("success", $message);
                            $return = array("statuts"=>0,"mes"=>$message);
                        }catch(Exception $e){
                            $pdo->rollBack();
                            $return = array("statuts"=>1,"mes"=>$this->error);
                        }
                    }else{
                        $return = array("statuts"=>1,"mes"=>$this->error);
                    }
                }else{
                    $pdo = App::getDb()->getPDO();
                    try{
                        $pdo->beginTransaction();
                        Rappel::save($user->id,$idEvenement,$date->format(MYSQL_DATETIME_FORMAT),$contenu,$evenement->nom);
                        $message = "Ligne de rappel ajoutée avec succès";
                        $pdo->commit();
                        $this->session->write("success", $message);
                        $return = array("statuts"=>0,"mes"=>$message);
                    }catch(Exception $e){
                        $pdo->rollBack();
                        $return = array("statuts"=>1,"mes"=>$this->error);
                    }
                }
            }else{
                $return = array("statuts"=>1,"mes"=>$this->error);
            }
        }else{
            $message = "Veuillez renseigner tous les champs requis";
            $return = array("statuts"=>1,"mes"=>$message);
        }
        echo json_encode($return);
    }

    public function addEvenement(){
        $user = $this->user;
        header('content-type: application/json');
        if (isset($_POST['nom'])&&!empty($_POST['nom'])){
            $nom = $_POST['nom'];
            if(isset($_POST['id'])){
                $id = $_POST['id'];
                $item = Evenement::find($id);
                if($item&&$item->idClient==$user->id){
                    $bool = true;
                    if($item->nom!=$nom && Evenement::byNom($nom,$user->id)){
                        $bool = false;
                    }
                    if($bool){
                        $pdo = App::getDb()->getPDO();
                        try{
                            $pdo->beginTransaction();
                            Evenement::save($nom, $user->id, $id);
                            $message = "Campagne modifiée avec succès";
                            $pdo->commit();
                            $this->session->write("success", $message);
                            $return = array("statuts"=>0,"mes"=>$message);
                        }catch(Exception $e){
                            $pdo->rollBack();
                            $return = array("statuts"=>1,"mes"=>$this->error);
                        }
                    }else{
                        $message = "Cette campagne existe déjà";
                        $return = array("statuts" => 1, "mes" => $message);
                    }
                }else{
                    $return = array("statuts"=>1,"mes"=>$this->error);
                }
            }else{
                if(!Evenement::byNom($nom,$user->id)){
                    $pdo = App::getDb()->getPDO();
                    try{
                        $pdo->beginTransaction();
                        Evenement::save($nom,$user->id);
                        $message = "Campagne ajoutée avec succès";
                        $pdo->commit();
                        $this->session->write("success", $message);
                        $return = array("statuts"=>0,"mes"=>$message);
                    }catch(Exception $e){
                        $pdo->rollBack();
                        $return = array("statuts"=>1,"mes"=>$this->error);
                    }
                }else{
                    $message = "Cette campagne existe déjà";
                    $return = array("statuts" => 1, "mes" => $message);
                }
            }

        }else{
            $message = "Veuillez renseigner tous les champs requis";
            $return = array("statuts"=>1,"mes"=>$message);
        }
        echo json_encode($return);
    }

    public function deleteContact(){
        $user = $this->user;
        header('content-type: application/json');
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $id = $_GET['id'];
            $contact = Contact::remove($id, $user->id);
            if($contact){
                $return = array("statuts"=>0, "mes"=>"good", "url"=>App::url("account"));
                $this->session->write("success", "Contact supprimé avec succès");
            }else{
                $return = array("statuts"=>1, "mes"=>"une erreur est survenue");
            }
        }else{
            $return = array("statuts"=>1, "mes"=>"une erreur est survenue");
        }
        echo json_encode($return);
    }

    public function deleteCommande(){
        $user = $this->user;
        header('content-type: application/json');
        if(isset($_POST['id']) && !empty($_POST['id'])){
            $id = $_POST['id'];
            $commande = Commander::find($id);
            if($commande){
                    $reference = $commande->reference;
                    Commander::deleteCommande($id);
                    $message = "La commande ".$reference." a été annulée avec succès";
                    $return = array("statuts"=>0, "mes"=>$message);
                    $this->session->write("success", $message);

            }else{
                    $message = "La commande $commande->reference est déjà en cours de traitement ou a déjà été traitée !!!";
                    $return = array("statuts"=>1    , "mes"=>$message);
                    $this->session->write("error", $message);
            }
        }else{
            $return = array("statuts"=>1, "mes"=>"une erreur est survenue");
        }
        echo json_encode($return);
    }

    public function commandeSms(){
        if(isset($_POST['quantite']) && !empty($_POST['quantite'])){
            $quantite = $_POST['quantite'];
            CommandeSms::save($this->user->id, $quantite);
            $this->session->write('success',"Votre commande de ".$quantite." SMS a été effectuée avec succès");
            App::redirect( App::url("account"));
        }else{
            $this->session->write('danger',"Entrez le nombre d'SMS");
            //App::redirect( App::url($_SERVER['REQUEST_URI']));
        }
    }

    public function uploadCharges(){
        header('content-type: application/json');
        $return = [];
        if (isset($_FILES['charge']['name'])) {
            $idCommande = $_POST['idCommande'];
            if (isset($_FILES['charge']['tmp_name']) && !empty($_FILES['charge']['tmp_name']) && !is_null($idCommande)) {
                $commander = Commander::find($idCommande);
                if ($commander){
                    $pdo = App::getDb()->getPDO();
                    try{
                        $pdo->beginTransaction();
                        if(isset($_FILES['charge']['name']) && !empty($_FILES['charge']['name'])){
                            $extensions_valides = array('pdf', 'doc','docx');
                            $extension_upload = strtolower(  substr(  strrchr($_FILES['charge']['name'], '.')  ,1)  );
                            if(in_array($extension_upload,$extensions_valides) && in_array($extension_upload,$extensions_valides) ){
                                if($_FILES['charge']['size'] <= 10000000){
                                    $root = FileHelper::moveImage($_FILES['charge']['tmp_name'],"charges",$extension_upload,"",true);
                                    /*if (!empty($commander->charge) && strpos($commander->charge, 'img') === false) {
                                        FileHelper::deleteImage('Public/charges/' . $commander->charge);
                                    }*/
                                    if($root){
                                        Commander::setCahierDeCharge($root,$idCommande);
                                        $message = "Votre cahier de charge a été uploadé avec success";
                                        $pdo->commit();
                                        $this->session->write('success', $message);
                                        $return = array("statuts"=>0,"mes"=>$message);
                                    }else{
                                        $message = "Une erreur est survenue lors de l'envoie du fichier";
                                        $return = array("statuts"=>1,"mes"=>$message);
                                    }
                                }else{
                                    $message = "Ce fichier est très lourd. Ajoutez un fichier de taille inferieure à  \"10 Mo\"";
                                    $return = array("statuts"=>1,"mes"=>$message);
                                }
                            }else{
                                $message = "L'image doit être un fichier PDF ou WORD";
                                $return = array("statuts"=>1,"mes"=>$message);
                            }
                        }
                    }
                    catch(Exception $e){
                        $pdo->rollBack();
                        $message = "Une erreur est survenue";
                        $return = array("statuts"=>1,"mes"=>$message);
                    }
                }else{
                    $message = $this->error;
                    $return = array("statuts" => 1, "mes" => $message);
                }
            } else {
                $message = "Vous devez uploader un fichier";
                $return = array("statuts" => 1, "mes" => $message);
            }
        } else {
            $message = $this->error;
            $return = array("statuts" => 1, "mes" => $message);
        }
        echo json_encode($return);
    }

}