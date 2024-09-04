<?php
/**
 * Created by PhpStorm.
 * User: Ndjeunou
 * Date: 04/09/2018
 * Time: 17:51
 */

namespace Projet\Controller\Membre;


use Projet\Database\Commander;
use Projet\Database\Contact;
use Projet\Model\DateParser;
use Projet\Model\Sms;
use Projet\Model\StringHelper;

class ApiController extends MembreController {

    public function getSolde(){
        header('content-type: application/json');
        $solde = Sms::getSolde($this->user->numero,$this->user->password);
        $contact = Contact::countBySearchType($this->user->id);
        $commande = Commander::countBySearchType($this->user->id);
        echo json_encode(['statuts'=>0,"solde"=>thousand($solde),"contact"=>thousand($contact->Total),"commande"=>thousand($commande->Total)]);
    }

    public function historique(){
        header('content-type: application/json');
        $historiques = Sms::getHistorique($this->user->numero,$this->user->password,4000);
        $historiques = json_decode($historiques,true);
        $contenu = "";
        if(!empty($historiques['root_detail_transaction'])){
            foreach ($historiques['root_detail_transaction'] as $historique) {
                $contenu .= '<tr>
                                <td class="text-center"><small><b>'.DateParser::DateShort($historique['date_envoie'],1).'</b></small></td>   
                                <td class="text-center"><small><b>'.$historique['sender'].'</b></small></td>   
                                <td class="text-center"><small>'.$historique['destinataire'].'</small> <i class="badge badge-dark">'.$historique['nombre_sms'].'</i></td>   
                                <td><small>'.StringHelper::decodeMessage($historique['message']).'</small></td>   
                                <td class="text-center">'.StringHelper::$tabState[$historique['libelle']].'</td>   
                            </tr>';
            }
        }else{
            $contenu .= '<tr>
                            <td colspan="5" class="text-center text-danger"><i class="fa fa-warning"></i> Aucun historique de SMS</td>   
                        </tr>';
        }
        echo json_encode(['statuts'=>0,"contenu"=>$contenu]);
    }

    public function sendSMS(){
        header('content-type: application/json');
        if (isset($_POST['numero'])&&!empty($_POST['numero']) && isset($_POST['message']) && !empty($_POST['message']) ){
            $message = trim($_POST['message']);
            $user = $this->user;
            $numeros = explode(',', str_replace(' ','',trim($_POST['numero'])));
            $success = $echec = 0;
            foreach ($numeros as $numero){
                if(!empty($numero)&&is_numeric($numero)&&strlen($numero)==9){
                    $sms = Sms::resultSmsApi($user->numero,$user->password,$numero,$message,$user->entete);
                    if($sms)
                        $success++;
                    else
                        $echec++;
                }else{
                    $echec++;
                }
            }
            $textSucces = $success>1?" * $success messages envoyés":"$success message envoyé";
            $textSucces = $success==0?"":$textSucces;
            $textEchec = $echec>1?" * $echec messages non envoyés":"$echec message non envoyé";
            $textEchec = $echec==0?"":$textEchec;
            $return = array("statuts"=>0, "mes"=>$textSucces.$textEchec);
        }else{
            $return = array("statuts"=>1,"mes"=>"Veuillez renseigner tous les champs requis");
        }
        echo json_encode($return);
    }

}