<?php
/**
 * Created by PhpStorm.
 * Eleve: Ndjeunou
 * Date: 23/01/2017
 * Time: 09:19
 */

namespace Projet\Controller\Membre;

use Exception;
use Projet\Database\Client;
use Projet\Database\Contact;
use Projet\Database\Evenement;
use Projet\Database\Groupe;
use Projet\Database\Groupe_Contact;
use Projet\Database\Contact_Evenement;
use Projet\Model\App;

class GroupeController extends MembreController {

    public function index(){
        $user = $this->user;
        $nbreParPage = 20;
        $contactsMessage = Contact::searchType($user->id);
        $search = (isset($_GET['search'])&&!empty($_GET['search'])) ? $_GET['search'] : null;
        $nbre = Groupe::countBySearch($user->id,$search);

        $nbrePages = ceil($nbre->Total / $nbreParPage);
        if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbrePages) {
            $pageCourante = $_GET['page'];
        } else {
            $pageCourante = 1;
            $params['page'] = $pageCourante;
        }
        $groupes = Groupe::search($nbreParPage,$pageCourante,$user->id,$search);
        $this->render('site.groupe.groupe',compact('contactsMessage','groupes','user' , 'nbre','nbrePages'));
    }

    public function add(){
        $user = $this->user;
        header('content-type: application/json');
        if (isset($_POST['nom'])&&!empty($_POST['nom'])){
            $nom = $_POST['nom'];
            if(isset($_POST['id'])){
                $id = $_POST['id'];
                $item = Groupe::find($id);
                if($item&&$item->idClient==$user->id){
                    $bool = true;
                    if($item->nom!=$nom && Groupe::byNom($nom,$user->id)){
                        $bool = false;
                    }
                    if($bool){
                        $pdo = App::getDb()->getPDO();
                        try{
                            $pdo->beginTransaction();
                            Evenement::save($nom, $user->id, $id);
                            $message = "Groupe modifié avec succès";
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
                if(!Groupe::byNom($nom,$user->id)){
                    $pdo = App::getDb()->getPDO();
                    try{
                        $pdo->beginTransaction();
                        Groupe::save($nom,$user->id);
                        $message = "Groupe ajouté avec succès";
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
            $idGroupe = $_GET['id'];
            $explodes = explode(',',$_POST['ids']);
            $groupe = Groupe::find($idGroupe);
            if($groupe){
                $pdo = App::getDb()->getPDO();
                try{
                    $pdo->beginTransaction();
                    $i = 0;
                    foreach ($explodes as $explode) {
                        if(Contact::find($explode)){
                            if(!Groupe_Contact::isExist($idGroupe,$explode)){
                                Groupe_Contact::save($idGroupe,$explode);
                                $i++;
                            }
                        }
                    }
                    if($i>0){
                        $message = "Contacts ajoutés avec succès au groupe";
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

    public function delete(){
        header('content-type: application/json');
        $return = [];
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $id = $_GET['id'];
            $groupe = Groupe::find($id);
            $user = $this->user;
            if($groupe&&$groupe->idClient==$user->id){
                $pdo = App::getDb()->getPDO();
                try{
                    $pdo->beginTransaction();
                    $contacts = Groupe_Contact::searchType(null,null,$groupe->id);
                    foreach ($contacts as $contact) {
                        Groupe_Contact::delete($contact->id);
                    }
                    Groupe::delete($id);
                    $message = "Le groupe a été supprimé avec succès";
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

    public function deleteContact(){
        header('content-type: application/json');
        $return = [];
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $id = $_GET['id'];
            $contact = Groupe_Contact::find($id);
            if($contact){
                $user = $this->user;
                $groupe = Groupe::find($contact->idGroupe);
                if($groupe&&$groupe->idClient==$user->id){
                    $pdo = App::getDb()->getPDO();
                    try{
                        $pdo->beginTransaction();
                        Groupe_Contact::delete($id);
                        $message = "Le contact a été supprimé du groupe avec succès";
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
            $groupe = Groupe::find($id);
            if($groupe){
                $user = $this->user;
                $contactsMessage = Contact::searchType($user->id);
                $user = $this->user;
                $nbreParPage = 200;
                $nbre = Groupe_Contact::countBySearchType($id);
                $nbrePages = ceil($nbre->Total / $nbreParPage);
                if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbrePages) {
                    $pageCourante = $_GET['page'];
                } else {
                    $pageCourante = 1;
                    $params['page'] = $pageCourante;
                }
                $contacts = Groupe_Contact::searchType($nbreParPage,$pageCourante,$id);
                $this->render('site.groupe.contacts',compact('contactsMessage','groupe','user','nbre','nbrePages','contacts'));
            }else{
                App::error();
            }
        }else{
            App::error();
        }
    }

}