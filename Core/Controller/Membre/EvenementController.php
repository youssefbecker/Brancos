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
use Projet\Database\Contact;
use Projet\Database\Contact_Evenement;
use Projet\Database\Evenement;
use Projet\Database\Groupe;
use Projet\Database\Groupe_Contact;
use Projet\Database\Rappel;
use Projet\Model\App;

class EvenementController extends MembreController {

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
                $this->render('site.evenement.rappels',compact('user', 'rappels', 'contactsMessage', 'campagne', 'nbrePages', 'nbre'));
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
        $groupes = Groupe::search();
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
        $this->render('site.evenement.evenement',compact('groupes','user', 'contactsMessage','evenements', 'nbreParPage', 'nbrePages', 'nbre'));
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

    public function addGroupe(){
        $user = $this->user;
        header('content-type: application/json');
        if (isset($_POST['idsEvenement'])&&!empty($_POST['idsEvenement'])&&isset($_POST['evenementId'])&&!empty($_POST['evenementId'])){
            $idEvenement = $_POST['evenementId'];
            $explodes = explode(',',$_POST['idsEvenement']);
            $evenement = Evenement::find($idEvenement);
            if($evenement){
                $pdo = App::getDb()->getPDO();
                try{
                    $pdo->beginTransaction();
                    $i = 0;
                    foreach ($explodes as $explode) {
                        $groupe = Groupe::find($explode);
                        if($groupe){
                            $contacts = Groupe_Contact::searchType(null,null,$groupe->id);
                            foreach ($contacts as $contact) {
                                if(!Contact_Evenement::isExist($contact->idContact,$idEvenement)){
                                    Contact_Evenement::save($contact->idContact,$idEvenement);
                                    $i++;
                                }
                            }
                        }
                    }
                    if($i>0){
                        $message = "Groupes de contacts ajoutés avec succès à la campagne";
                        $pdo->commit();
                        $this->session->write("success", $message);
                        $return = array("statuts"=>0,"mes"=>$message);
                    }else{
                        $return = array("statuts"=>1,"mes"=>"Aucun contact ajouté !");
                    }
                }catch(Exception $e){
                    $pdo->rollBack();
                    $return = array("statuts"=>1,"mes"=>$this->error);
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

    public function addContact(){
        $user = $this->user;
        header('content-type: application/json');
        if (isset($_POST['ids'])&&!empty($_POST['ids'])&&isset($_GET['id'])&&!empty($_GET['id'])){
            $idEvenement = $_GET['id'];
            $explodes = explode(',',$_POST['ids']);
            $evenement = Evenement::find($idEvenement);
            if($evenement){
                $pdo = App::getDb()->getPDO();
                try{
                    $pdo->beginTransaction();
                    $i = 0;
                    foreach ($explodes as $explode) {
                        if(Contact::find($explode)){
                            if(!Contact_Evenement::isExist($explode,$idEvenement)){
                                Contact_Evenement::save($explode,$idEvenement);
                                $i++;
                            }
                        }
                    }
                    if($i>0){
                        $message = "Contacts ajoutés avec succès à la campagne";
                        $pdo->commit();
                        $this->session->write("success", $message);
                        $return = array("statuts"=>0,"mes"=>$message);
                    }else{
                        $return = array("statuts"=>1,"mes"=>"Aucun contact ajouté !");
                    }
                }catch(Exception $e){
                    $pdo->rollBack();
                    $return = array("statuts"=>1,"mes"=>$this->error);
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

    public function deleteContact(){
        header('content-type: application/json');
        $return = [];
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $id = $_GET['id'];
            $contact = Contact_Evenement::find($id);
            if($contact){
                $pdo = App::getDb()->getPDO();
                try{
                    $pdo->beginTransaction();
                    Contact_Evenement::delete($id);
                    $message = "Le contact a été supprimé de la campagne avec succès";
                    $this->session->write('success',$message);
                    $pdo->commit();
                    $return = array("statuts" => 0, "mes" => $message);
                }catch (Exception $e){
                    $pdo->rollBack();
                    $message = "Une erreur est survenue, recharger et réessayer";
                    $return = array("statuts" => 1, "mes" => $message);
                }
            }else{
                $return = array("statuts" => 1, "mes" => $this->error);
            }
        }else{
            $message = "Une erreur est survenue, recharger et réessayer";
            $return = array("statuts" => 1, "mes" => $message);
        }
        echo json_encode($return);
    }

    public function contacts(){
        if(isset($_GET['id'])&&!empty($_GET['id'])){
            $id = $_GET['id'];
            $campagne = Evenement::find($id);
            if($campagne){
                $user = $this->user;
                $contactsMessage = Contact::searchType($user->id);
                $user = $this->user;
                $nbreParPage = 200;
                $nbre = Contact_Evenement::countBySearchType(null,$id);
                $nbrePages = ceil($nbre->Total / $nbreParPage);
                if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbrePages) {
                    $pageCourante = $_GET['page'];
                } else {
                    $pageCourante = 1;
                    $params['page'] = $pageCourante;
                }
                $contacts = Contact_Evenement::searchType($nbreParPage,$pageCourante,null,$id);
                $this->render('site.evenement.contacts',compact('contactsMessage','campagne','user','nbre','nbrePages','contacts'));
            }else{
                App::error();
            }
        }else{
            App::error();
        }
    }

}