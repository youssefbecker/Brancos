<?php
/**
 * Created by PhpStorm.
 * User: Ndjeunou
 * Date: 23/01/2017
 * Time: 09:19
 */

namespace Projet\Controller\Membre;


use Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Projet\Database\Contact;
use Projet\Database\Contact_Evenement;
use Projet\Database\Groupe_Contact;
use Projet\Model\App;

class ContactController extends MembreController {

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
        $this->render('site.contact.contacts',compact('user', 'contacts', 'contactsMessage', 'nbreParPage', 'nbrePages', 'nbre'));
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

    public function excell(){
        header('content-type: application/json');
        $user = $this->user;
        if(isset($_FILES['client']['tmp_name']) && !empty($_FILES['client']['tmp_name'])){
            if($_FILES['client']['error'] == 0){
                $extensions_valides = array('xls','xlsx','csOv');
                $extension_uploadClient = strtolower(  substr(  strrchr($_FILES['client']['name'], '.')  ,1));
                if(in_array($extension_uploadClient,$extensions_valides)){
                    if($_FILES['client']['size']<=5000000){
                        $pdo = App::getDb()->getPDO();
                        try{
                            $pdo->beginTransaction();
                            $inputFileTypeCli = IOFactory::identify($_FILES['client']['tmp_name']);
                            $readerCli = IOFactory::createReader($inputFileTypeCli);
                            $spreadsheetCli = $readerCli->load($_FILES['client']['tmp_name']);
                            $sheetCli = $spreadsheetCli->getSheet(0);
                            $highestRowCli = $sheetCli->getHighestRow();
                            $highestColumnCli = $sheetCli->getHighestColumn();
                            for ($rowCli = 1; $rowCli <= $highestRowCli; $rowCli++){
                                $rowDataCli = $sheetCli->rangeToArray('A' . $rowCli . ':' . $highestColumnCli . $rowCli, NULL, TRUE, FALSE);
                                $nom = trim($rowDataCli[0][0]);
                                $numero = str_replace(' ','',trim($rowDataCli[0][1]));
                                $email = count($rowDataCli[0])==3 ? trim($rowDataCli[0][2]) : '';
                                if(!empty($numero)&&strlen($numero)==9){
                                    if(!Contact::byNumero($numero,$user->id)){
                                        Contact::save($nom,$numero,$email,$user->id);
                                    }
                                }
                            }
                            $pdo->commit();
                            $message = "Contacts importés avec succès";
                            $this->session->write('success',$message);
                            $return = array("statuts" => 0, "mes" => $message);
                        }catch (Exception $e){
                            $pdo->rollBack();
                            $message = $this->error;
                            $return = array("statuts" => 1, "mes" => $message);
                        }
                    }else{
                        $message = "Le fichier doit avoir une taille inférieure ou égale à 5M";
                        $return = array("statuts" => 1, "mes" => $message);
                    }
                }else{
                    $message = "Le fichier doit être d'extension xls ou xlsx ou csv";
                    $return = array("statuts" => 1, "mes" => $message);
                }
            }else{
                $message = "Une erreur est survenue lors de l'upload du fichier";
                $return = array("statuts" => 1, "mes" => $message);
            }
        }else{
            $message = $this->empty;
            $return = array("statuts" => 1, "mes" => $message);
        }
        echo json_encode($return);
    }

    public function deleteContact(){
        $user = $this->user;
        header('content-type: application/json');
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $id = $_GET['id'];
            $contact = Contact::find($id);
            if($contact){
                $nbre = Contact_Evenement::countBySearchType($id);
                if($nbre->Total==0){
                    $nbre = Groupe_Contact::countBySearchType(null,$id);
                    if($nbre->Total==0){
                        $pdo = App::getDb()->getPDO();
                        try{
                            $pdo->beginTransaction();
                            Contact::delete($id);
                            $message = "Le contact a été supprimé avec succès";
                            $this->session->write('success',$message);
                            $pdo->commit();
                            $return = array("statuts" => 0, "mes" => $message);
                        }catch (Exception $e){
                            $pdo->rollBack();
                            $message = "Une erreur est survenue, recharger et réessayer";
                            $return = array("statuts" => 1, "mes" => $message);
                        }
                    }else{
                        $message = "Ce contact ne peut être supprimé car il est dans un groupe de contacts";
                        $return = array("statuts" => 1, "mes" => $message);
                    }
                }else{
                    $message = "Ce contact ne peut être supprimé car il a une activité";
                    $return = array("statuts" => 1, "mes" => $message);
                }
            }else{
                $return = array("statuts"=>1, "mes"=>"une erreur est survenue");
            }
        }else{
            $return = array("statuts"=>1, "mes"=>"une erreur est survenue");
        }
        echo json_encode($return);
    }

}