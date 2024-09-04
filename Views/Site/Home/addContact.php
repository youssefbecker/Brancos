<?php
/**
 * Created by PhpStorm.
 * User: Ross
 * Date: 8/23/2018
 * Time: 5:45 AM
 */
use Projet\Model\App;
App::setTitle("Ajouter des contacts");
?>
<div class="ui-hero hero-sm bg-dark-gray hero-svg-layer-4">
    <div class="container">
        <h1 class="heading">
            Ajouter un des contact <?php echo $user->nom;?>
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
                            <ul>
                                <li>
                                    <a href="<?=App::url("sms_api/addContact")?>"><i class="fa fa-plus"></i> Ajouter un contact</a>
                                </li>
                                <li>
                                    <a href="<?=App::url("sms_api/account")?>"><i class="fa fa-phone"></i> Mes contacts</a>
                                </li>
                                <li>
                                    <a href="<?=App::url("sms_api/message")?>"><i class="fa fa-envelope"></i> Ecrire un message</a>
                                </li>
                                <li>
                                    <a href="<?=App::url("sms_api/history")?>"><i class="fa fa-history"></i> Historique</a>
                                </li>
                            </ul>
                        </div>


                        <div class="docs-content col-md-9">
                            <table class="col-md-12 table-responsive">
                                <tr>
                                    <th>Nom</th>
                                    <th>Numero</th>
                                    <th>Date d'ajout</th>
                                </tr>
                                <?php
                                if(isset($contacts) ){
                                    foreach ($contacts as $contact){
                                        echo '
                                                <tr>
                                                    <td>'.$contact->nom.'</td>
                                                    <td>'.$contact->numero.'</td>
                                                    <td>'.$contact->created_at.'</td> 
                                                </tr>
                                            ';
                                    }
                                }else{
                                    echo ' <tr class=" mt-5"> <td colspan="4" class="text-center text-danger pt-4">Liste de contact vide</td></tr>';
                                }
                                ?>
                            </table>
                        </div>
                    </div><!-- .row -->
                </div><!-- .card-body -->
            </div><!-- .ui-card -->

        </div><!-- .container -->
    </div><!-- #ui-api-docs -->

</div>