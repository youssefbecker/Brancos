<?php
/**
 * Created by PhpStorm.
 * User: Ross
 * Date: 8/23/2018
 * Time: 5:45 AM
 */

use Projet\Database\Envoye;
use Projet\Model\App;
use Projet\Model\DateParser;
use Projet\Model\FileHelper;
use Projet\Model\StringHelper;

App::addScript("assets/js/pages/addEvenementContact.js", true, true);
App::setTitle("Contacts de $campagne->nom");
App::addScript("assets/js/pages/message.js", true, true);
App::addScript("assets/js/pages/commandes.js", true, true);
App::addScript("assets/js/pages/sweetalert.min.js", true, true);
$url = substr(explode('?', $_SERVER["REQUEST_URI"])[0], 1);
$laPage = isset($_GET['page']) ? $_GET['page'] : 1;
$paginator = new \Projet\Model\Paginator($url, $laPage, $nbrePages, $_GET, $_GET);
?>
<div class="ui-hero hero-sm bg-dark-gray hero-svg-layer-4">
    <div class="container">
        <h1 class="heading">
            <?= $campagne->nom; ?>
        </h1>
        <p class="paragraph">

        </p>
    </div>
</div>

<?php
if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success text-center alert-dismissible" id="alertSuccess"><button  class="close" data-dismiss="alert">&times;</button><span>' . $session->read('success') . '</span></div>';
    $session->delete('success');
}
?>

<div class="main" role="main">


    <div id="ui-api-docs" class="section bg-light" style="padding: 1em 0">
        <div class="container">

            <div class="ui-card">
                <div class="card-body">
                    <div class="row">
                        <div class="docs-sidebar col-md-3">
                            <?php require 'Views/Site/Home/side_bar.php'; ?>
                        </div>

                        <div class="col-md-9">
                            <div class="col-md-6">
                                <h4 class="heading"><?= $campagne->nom; ?> <small>(<?= thousand($nbre->Total); ?>)</small></h4>
                            </div>
                            <div class="col-md-6">
                                <div class="actions text-right mb-3">
                                    <a href="#groupeListModal" data-toggle="modal" class="btn btn-success text-white"><i class="fa fa-plus"></i> Ajouter des contacts</a>
                                </div>
                            </div>
                            <table class="col-md-12 table table-striped table-hover table-responsive">
                                <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Numero</th>
                                    <th>Email</th>
                                    <th class="text-center">Date d'ajout</th>
                                    <th class="text-center">#</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($contacts){
                                    foreach ($contacts as $contact){
                                        echo '
                                                <tr>
                                                    <td>'. StringHelper::isEmpty($contact->nom).'</td>
                                                    <td>'.$contact->numero.'</td>
                                                    <td>'. StringHelper::isEmpty($contact->email,1).'</td>
                                                    <td class="text-center">'. DateParser::DateShort($contact->created_at,1).'</td> 
                                                    <td class="text-center">
                                                        <a href="#" data-id="'.$contact->id.'" data-numero="'.$contact->numero.'" class="deleteButton">
                                                            <i class="fa fa-trash text-danger" style="font-size: 2em"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            ';
                                    }
                                }else{
                                    echo ' <tr class=" mt-5"> <td colspan="5" class="text-center text-danger pt-4">Liste de contacts vide</td></tr>';
                                }
                                ?>
                                </tbody>
                                <?php if(!empty($contacts)){ ?>
                                    <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-right">
                                            <?php $paginator->paginateTwo(); ?>
                                        </td>
                                    </tr>
                                    </tfoot>
                                <?php }?>
                            </table>
                        </div>
                    </div><!-- .row -->

                </div><!-- .card-body -->
            </div><!-- .ui-card -->

        </div><!-- .container -->
    </div><!-- #ui-api-docs -->
</div>

<?php require 'Views/Site/Home/modal_sms.php'; ?>

<div class="modal fade" id="groupeListModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h1>Sélectionner les contacts à ajouter</h1>
            </div>
            <div class="modal-body p-4">
                <form action="<?= App::url("campagnes/contact/add?id=".$campagne->id) ?>" method="post" id="addContactForm">
                    <input type="hidden" name="ids" id="ids">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="text-center"><input type="checkbox" style="height: 20px !important" class="form-control" id="selectAllGroupe"></th>
                            <th class="text-left">Nom</th>
                            <th class="text-left">Numéro</th>
                            <th class="text-left">Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($contactsMessage) {
                            foreach ($contactsMessage as $contact) {
                                echo '
                                <tr>
                                    <td class="text-center"><input type="checkbox" style="height: 20px !important" value="' . $contact->id . '" class="form-control idGroupe selectedGroupe"></td>
                                    <td class="text-left">' . StringHelper::isEmpty($contact->nom) . '</td>
                                    <td class="text-left">' . $contact->numero . '</td>
                                    <td class="text-left">' . StringHelper::isEmpty($contact->email,1) . '</td>
                                </tr>
                                ';
                            }
                        } else {
                            echo ' <tr class=" mt-5"> <td colspan="3" class="text-center text-danger pt-4">Liste de contact vide</td></tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                    <button class="btn btn-dark btn-block" id="submit_add_contact" type="submit">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>
