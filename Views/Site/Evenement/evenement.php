<?php
/**
 * Created by PhpStorm.
 * User: Ross
 * Date: 8/23/2018
 * Time: 5:45 AM
 */

use Projet\Database\Contact_Evenement;
use Projet\Database\Envoye;
use Projet\Database\Groupe_Contact;
use Projet\Database\Rappel;
use Projet\Model\App;
use Projet\Model\DateParser;
use Projet\Model\StringHelper;

App::addScript("assets/js/pages/addCampagne.js", true, true);
App::setTitle("Mes campagnes");
App::addScript("assets/js/pages/message.js", true, true);
$url = substr(explode('?', $_SERVER["REQUEST_URI"])[0], 1);
$laPage = isset($_GET['page']) ? $_GET['page'] : 1;
$paginator = new \Projet\Model\Paginator($url, $laPage, $nbrePages, $_GET, $_GET);
?>
<div class="ui-hero hero-sm bg-dark-gray hero-svg-layer-4">
    <div class="container">
        <h1 class="heading">
            Mes campagnes
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
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="heading">Mes campagnes <small>(<?= thousand($nbre->Total); ?>)</small></h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="actions text-right mb-3">
                                        <a href="#modalContact" data-toggle="modal" class="btn btn-success text-white"><i class="fa fa-plus"></i> Nouvelle Campagne</a>
                                    </div>
                                </div>
                            </div>
                            <table class="col-md-12 table table-striped table-hover table-responsive">
                                <thead>
                                <tr>
                                    <th class="text-left">Titre</th>
                                    <th class="text-center">Ajout</th>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Concernés</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($evenements) {
                                    foreach ($evenements as $evenement) {
                                        $nbreRappels = Rappel::countBySearchType($evenement->id);
                                        $nbreEnvoyes = Envoye::countBySearchType($evenement->id);
                                        $nbreContacts = Contact_Evenement::countBySearchType(null,$evenement->id);
                                        $valAction = '
                                                  <li>
                                                      <a href="#addGroupeModal" data-toggle="modal" data-id="'.$evenement->id.'" class="addGroupeButton">Ajouter un groupe de contacts</a>
                                                  </li>
                                                  <li>
                                                      <a href="'.App::url('campagnes/rappels?id='.$evenement->id).'" >Rappels ('.thousand($nbreRappels->Total).')</a>
                                                  </li>
                                                  <li>
                                                      <a href="'.App::url('campagnes/contacts?id='.$evenement->id).'" >Contacts ('.thousand($nbreContacts->Total).')</a>
                                                  </li>
                                                  <li>
                                                      <a href="'.App::url('campagnes/messages?id='.$evenement->id).'" >Messages ('.thousand($nbreEnvoyes->Total).')</a>
                                                  </li>';
                                        echo '
                                              <tr>
                                                  <td class="text-left">' . $evenement->nom . '</td>
                                                  <td class="text-center">' .DateParser::DateShort($evenement->created_at,1) . '</td> 
                                                  <td class="text-center">
                                                      <div class="btn-group">
                                                          <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                          Actions
                                                          </button>
                                                          <ul class="dropdown-menu" role="menu">
                                                          <li>
                                                          <a href="#modalEditContact" data-toggle="modal" data-nom="'.$evenement->nom.'" data-id="' . $evenement->id . '" class="editButton">Modifier</a>
                                                          </li>
                                                          ' . $valAction . '      
                                                          </ul>
                                                      </div>
                                                  </td>
                                                  <td class="text-center ">' .thousand($nbreContacts->Total). '</td>
                                              </tr>
                                              ';
                                        }} else {
                                    echo ' <tr class=" mt-5"> <td colspan="4" class="text-center text-danger pt-4">Liste des campagnes vide</td></tr>';
                                    }
                                    ?>
                                </tbody>
                                <?php if (!empty($evenements)) { ?>
                                    <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-right">
                                            <?php $paginator->paginateTwo(); ?>
                                        </td>
                                    </tr>
                                    </tfoot>
                                <?php } ?>
                            </table>
                        </div>
                    </div><!-- .row -->

                </div><!-- .card-body -->
            </div><!-- .ui-card -->

        </div><!-- .container -->
    </div><!-- #ui-api-docs -->
</div>
    <div class="modal fade" id="modalContact" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h1 class="modal-title">Ajouter une campagne</h1>
                </div>
                <div class="modal-body p-4">
                    <form action="<?= App::url("campagnes/add") ?>" method="post" id="addContactForm">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nom" placeholder="Titre" required>
                        </div>
                        <button class="btn btn-dark btn-block" id="submit_add_contact" type="submit">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditContact" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h1 class="modal-title">Modifier une campagne</h1>
                </div>
                <div class="modal-body p-4">
                    <form action="<?= App::url("campagnes/add") ?>" method="post" id="editContactForm">
                        <div class="form-group">
                            <input type="hidden" value="" name="id" id="idContact">
                            <input type="text" class="form-control" name="nom" id="editNom" required placeholder="Titre">
                        </div>
                        <button class="btn btn-dark btn-block" id="submit_edit_contact" type="submit">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addGroupeModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h1>Sélectionner les groupes de contacts à ajouter</h1>
                </div>
                <div class="modal-body p-4">
                    <form action="<?= App::url("campagnes/groupe/add") ?>" method="post" id="addContactEvenementForm">
                        <input type="hidden" name="evenementId" id="evenementId">
                        <input type="hidden" name="idsEvenement" id="idsEvenement">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="text-center"><input type="checkbox" style="height: 20px !important" class="form-control" id="selectAllEvenement"></th>
                                <th class="text-left">Nom du groupe</th>
                                <th class="text-center">#</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($groupes) {
                                foreach ($groupes as $groupe) {
                                    $nbreC = Groupe_Contact::countBySearchType($groupe->id);
                                    echo '
                                <tr>
                                    <td class="text-center"><input type="checkbox" style="height: 20px !important" value="' . $groupe->id . '" class="form-control idEvenement selectedEvenement"></td>
                                    <td class="text-left">' . $groupe->nom . '</td>
                                    <td class="text-center"> Contacts (' . thousand($nbreC->Total) . ')</td>
                                </tr>
                                ';
                                }
                            } else {
                                echo ' <tr class=" mt-5"> <td colspan="2" class="text-center text-danger pt-4">Liste des groupes vide</td></tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                        <button class="btn btn-dark btn-block" id="addEvenement" type="submit">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require 'Views/Site/Home/modal_sms.php'; ?>