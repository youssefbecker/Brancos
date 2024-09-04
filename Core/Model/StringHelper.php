<?php
/**
 * Created by PhpStorm.
 * User: Poizon
 * Date: 18/11/2015
 * Time: 14:02
 */

namespace Projet\Model;


class StringHelper {

    public static $tabState = [
        'DELIVRE' => '<span class="label label-success">Réçu</span>',
        'DELIVERED' => '<span class="label label-success">Réçu</span>',
        'SENT' => '<span class="label label-primary">Envoyé</span>',
        'SENDING FAILED' => '<span class="label label-danger">Non Envoyé</span>',
        'UNDELIVERED' => '<span class="label label-warning">Non Réçu</span>',
        'EXPIRED' => '<span class="label label-warning">Expiré</span>',
        'ENVOYÉ' => '<span class="label label-primary">Envoyé</span>'
    ];

    public static $tabStateCommande = [
        3 => '<span class="label label-danger">Annulée</span>',
        2 => '<span class="label label-success">Traitée</span>',
        1 => '<span class="label label-warning">En cours</span>',
        0 => '<span class="label label-noTraite">Non Traitée</span>'
    ];

    public static $tabStateRappel = [
        1 => '<span class="label label-success">Activé</span>',
        2 => '<span class="label label-danger">Désactivé</span>'
    ];
    public static $tabType = [
        1 => '<span class="uk-badge uk-badge-success">Credit deposit</span>',
        2 => '<span class="uk-badge uk-badge-danger">Withdrawal</span>'
    ];

    public static function isEmpty($string,$isEmail=null){
        if(!empty($string)){
            return $isEmail?$string:ucfirst($string);
        }
        return '<span class="text-danger">Non renseigné</span>';
    }

    public static function getShortName($nom,$prenom){
        $expF = explode(' ',$nom);
        $expS = explode(' ',$prenom);
        return $expF[0].' '.$expS[0];
    }

    public static function decodeMessage($message){
        $message = str_replace("Ã©",'é',$message);
        $message = str_replace("Ã¨",'è',$message);
        return $message;
    }

    public static function getRefTransaction($type){
        $tabTypeSolde = [
            1 => '<i class="uk-icon-thumbs-o-up uk-text-success"></i>',
            2 => '<i class="uk-icon-thumbs-o-down uk-text-danger"></i>'
        ];
        return '<span class="uk-badge" style="width: 50px;background-color: whitesmoke !important">'.$tabTypeSolde[$type].'</span>';
    }

    public static function str_without_accents($str, $charset='utf-8'){
        $str = htmlentities($str, ENT_NOQUOTES, $charset);
        $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
        $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
        $str = preg_replace('#&[^;]+;#', '', $str);
        return mb_strtolower($str);
    }

    public static function cutString($string, $start, $length, $endStr = ' [...]'){
        if( strlen( $string ) <= $length ) return $string;
        $str = mb_substr( $string, $start, $length - strlen( $endStr ) + 1, 'UTF-8');
        return substr( $str, 0, strrpos( $str,' ') ).$endStr;
    }

    public static function getPhone($number){
        $first = substr($number,0,1);
        $code1 = substr($number,1,3);
        $code2 = substr($number,2,3);
        $plus = substr($number,0,2);
        $result = "";
        if($first == "6" && strlen($number) == 9){
            $result = "237".$number;
        }elseif ($first == "+" && $code1 == "237"){
            $result = substr($number,1);
        }elseif($plus == "00" && $code2 == "237"){
            $result = substr($number,2);
        }elseif($first == "+"){
            $result = substr($number,1);
        }else{
            $result = $number;
        }
        return $result;
    }

    public static function abbreviate($text,$max) {
        if (strlen($text)<=$max)
            return $text;
        return substr($text, 0, $max-3).'...';
    }


    public static function showComments($commentaires) {
        if(!empty($commentaires)){
            $contenu = "";
            foreach ($commentaires as $commentaire) {
                $contenu .=
                    '
                        <div class="chat_message_wrapper">
                            <div class="chat_user_avatar">
                                <img class="md-user-image" src="'.FileHelper::url('assets/img/user.png').'" alt="">
                            </div>
                            <ul class="chat_message">
                                <li>
                                    <p><a href="#" style="text-transform: capitalize">'.$commentaire->nom.'</a></p>
                                    <p> '.$commentaire->message.'.<span class="chat_message_time" style="text-transform: initial">'.DateParser::relativeTime($commentaire->created_at).'</span> </p>
                                </li>
                            </ul>
                        </div>
                        ';
            }
            echo $contenu;
        }else{
            echo '<div class="uk-alert uk-alert-danger uk-text-center" data-uk-alert="">La liste des commentaires est vide...</div>';
        }
    }
    public static function etatType ($type){
        $tabs = [
           'mobile' => '<span class="badge bg-dark-gray btn-block">Application Mobile</span><br>',
           'desktop' => '<span class="badge bg-dark-gray btn-block">Application pour Desktop</span><br>',
           'web' => '<span class="badge bg-dark-gray btn-block">Application Web</span><br>',
           'hebergement' => '<span class="badge bg-dark-gray btn-block">Hébergement</span><br>',
           'domaine' => '<span class="badge bg-dark-gray btn-block">Nom de domaine</span><br>',
           'site' => '<span class="badge bg-dark-gray btn-block">Site Web Classique</span>'];
        if ($type != '') {
            return $tabs[$type];
        }
        return '';
    }
    public static function etatTypeSimple ($type){
        $tabs = [
           'mobile' => 'Application Mobile,&nbsp;',
           'desktop' => 'Application pour Desktop,&nbsp;',
           'web' => 'Application Web,&nbsp;',
           'hebergement' => 'Hébergement,&nbsp;',
           'domaine' => 'Nom de domaine,&nbsp;',
           'site' => 'Site Web Classique'];
        if ($type != '') {
            return $tabs[$type];
        }
        return '';
    }

    public static function getLoader (){
        echo '<img src="'.FileHelper::url('assets/img/load.gif') .'" style="height: 20px;" >';
    }

}