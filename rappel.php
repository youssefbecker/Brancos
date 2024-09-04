<?php
define('MYSQL_DATE_FORMAT','Y-m-d');
require 'Core/Autoloader.php';
\Projet\Autoloader::register();

use Projet\Database\Client;
use Projet\Database\Contact_Evenement;
use Projet\Database\Envoye;
use Projet\Database\Evenement;
use Projet\Database\Rappel;
use Projet\Model\Sms;

function build($nom,$message){
    $nom = \Projet\Model\StringHelper::abbreviate(explode(' ',$nom)[0],15);
    return "Hi $nom, $message";
}

$rappels = Rappel::rappeler(date(MYSQL_DATE_FORMAT));
foreach ($rappels as $rappel) {
    if($rappel->etat==0){
        $evenement = Evenement::find($rappel->idEvenement);
        $client = Client::find($rappel->idClient);
        if($evenement&&$client&&$client->etat==1){
            $i = 0;
            $contacts = Contact_Evenement::searchType(null,null,null,$rappel->idEvenement);
            foreach ($contacts as $contact) {
                $sms = build($contact->nom,$rappel->message);
                Sms::resultSms($contact->numero,$sms,$rappel->entete);
                Envoye::save($client->id,$rappel->idEvenement,$rappel->id,$contact->numero,$sms);
                $i++;
            }
            Rappel::setEtat(1,$rappel->id);
        }
    }
}