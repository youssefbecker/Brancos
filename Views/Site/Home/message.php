<?php
/**
 * Created by PhpStorm.
 * User: Ross
 * Date: 8/23/2018
 * Time: 5:45 AM
 */
use Projet\Model\App;
App::setTitle("Ecrire message");
App::addScript("assets/js/pages/message.js",true,true);
?>
<div class="ui-hero hero-sm bg-dark-gray hero-svg-layer-4">
    <div class="container">
        <h1 class="heading">
            Ecrire un message
        </h1>
        <p class="paragraph">

        </p>
    </div>
</div>

<div class="main" role="main">


    <div id="ui-api-docs" class="section bg-light">
        <div class="container">

            <div class="ui-card">
                <div class="card-body">
                    <div class="row mb-5">
                        <a href="<?=App::url("logout")?>"><i class="fa fa-sign-out"></i>Se déconnecter</a>
                    </div>
                    <div class="row">
                        <!-- Docs Sidebar -->
                        <div class="docs-sidebar col-md-3">
                            <h6 class="heading">Admin Portal</h6>
                            <ul>
                                <li>
                                    <a href="<?=App::url("account")?>">
                                        <i class="icon icon-speedometer text-indigo"></i> Tableau de bord
                                    </a>
                                </li>
                                <li>
                                    <a href="#" id="sendSms">
                                        <i class="icon icon-envelope-letter text-lime"></i> Nouveau message
                                    </a>
                                </li>
                                <li>
                                    <a href="<?=App::url("archives")?>">
                                        <i class="icon icon-chart text-purple"></i> Archives
                                    </a>
                                </li>
                                <li>
                                    <a href="<?=App::url("logout")?>">
                                        <i class="icon icon-logout text-danger"></i> Déconnexion
                                    </a>
                                </li>
                            </ul>
                        </div>


                        <div class="docs-content col-md-9">
                            <form action="<?= App::url("messages/sent")?>" method="post" id="messageForm">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="tel" class="form-control input-group-prepend" name="numero" id="numero" required>
                                        <a type="button" class="btn btn-dark" data-target="#contactListModal" data-toggle="modal"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea name="message"  class="form-control" id="message" cols="30" rows="10" placeholder="Ecrivez un message" required></textarea>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-block btn-dark" id="submit_btn_message">Envoyer</button>
                                </div>
                            </form>
                        </div>
                    </div><!-- .row -->
                </div><!-- .card-body -->
            </div><!-- .ui-card -->

        </div><!-- .container -->
    </div><!-- #ui-api-docs -->

</div>

<div class="modal fade" id="contactListModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" data-dismmiss="modal">&times;</span>
                <h1>Ajouter un contact</h1>
            </div>
            <div class="modal-body">
                    <table class="table-responsive row m-2">
                        <tr class="border-bottom border-dark">
                            <th class="p-3">#</th>
                            <th class="p-3">Nom</th>
                            <th class="p-3">Numero</th>
                            <th class="p-3">Date d'ajout</th>
                        </tr>
                    <?php
                    if($contacts){
                        foreach ($contacts as $contact){
                            echo '
                                                <tr>
                                                    <td class="p-3"> <input type="checkbox" value="'.$contact->numero.'" class="form-control numero"></td>
                                                    <td class="p-3">'.$contact->nom.'</td>
                                                    <td class="p-3">'.$contact->numero.'</td>
                                                    <td class="p-3">'.date_format(new DateTime($contact->created_at), "d/m/y à h\h:i\m").'</td> 
                                                </tr>
                                            ';
                        }
                    }else{
                        echo ' <tr class=" mt-5"> <td colspan="4" class="text-center text-danger pt-4">Liste de contact vide</td></tr>';
                    }
                    ?>
                    </table>
                    <button class="btn btn-dark btn-block" id="submit_add_contact">Selectionner</button>
            </div>
        </div>
    </div>
</div>