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

App::addScript("assets/js/pages/addRappel.js", true, true);
App::setTitle("Lignes de rappel de $campagne->nom");
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
                                <h4 class="heading">Lignes de rappel <small>(<?= thousand($nbre->Total); ?>)</small></h4>
                            </div>
                            <div class="col-md-6">
                                <div class="actions text-right mb-3">
                                    <a href="#modalContact" data-toggle="modal" class="btn btn-success text-white"><i class="fa fa-plus"></i> Nouveau rappel</a>
                                </div>
                            </div>
                            <table class="col-md-12 table table-striped table-hover table-responsive">
                                <thead>
                                <tr>
                                    <th class="">Date</th>
                                    <th class="">Entete</th>
                                    <th class="">Message</th>
                                    <th class="text-center">#</th>
                                    <th class="text-center">statut</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($rappels) {
                                    foreach ($rappels as $rappel) {
                                        $nbreEnvoye = Envoye::countBySearchType(null,null,$rappel->id);
                                        $tAction = $rappel->etat == 1 ? 'Désactiver' : 'Activer';
                                        $valAction = '
                                                  <li>
                                                      <a href="#" data-url="'.App::url('campagnes/rappels/delete').'" data-etat="'.$rappel->etat.'" data-id="'.$rappel->id.'" class="deleteCommande">'.$tAction.'</a>
                                                  </li>';
                                        echo '
                                              <tr>
                                                  <td class=""><small>' .DateParser::DateShort($rappel->created_at,1) . '</small></td> 
                                                  <td class=""><small>' .$rappel->entete . '</small></td> 
                                                  <td class=""><small>' . $rappel->message . '</small></td>
                                                  <td class="text-center">
                                                      <div class="btn-group">
                                                          <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                          Action ('.thousand($nbreEnvoye->Total).')
                                                          </button>
                                                          <ul class="dropdown-menu" role="menu">
                                                          <li>
                                                          <a href="#modalEditContact" data-toggle="modal" data-message="'.$rappel->message.'" data-entete="' . $rappel->entete . '" data-id="' . $rappel->id . '" data-date="' . date(DATE_FORMAT,strtotime($rappel->date)) . '" class="editButton">Modifier</a>
                                                          </li>
                                                          ' . $valAction . '      
                                                          </ul>
                                                      </div>
                                                  </td>
                                                  <td class="text-center ">' . StringHelper::$tabStateRappel[$rappel->etat] . '</td>
                                              </tr>
                                              ';
                                        }} else {
                                    echo ' <tr class=" mt-5"> <td colspan="5" class="text-center text-danger pt-4">Liste des rappels vide</td></tr>';
                                    }
                                    ?>
                                </tbody>
                                <?php if (!empty($rappels)) { ?>
                                    <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-right">
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
                    <h1 class="modal-title">Ajouter un rappel</h1>
                </div>
                <div class="modal-body p-4">
                    <form action="<?= App::url("campagnes/rappels/add?id=".$campagne->id) ?>" method="post" id="addContactForm">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" class="form-control leEntete" maxlength="10" name="entete" placeholder="Entete">
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" class="form-control laDate" name="date" placeholder="Date d'envoi">
                            </div>
                            <div class="col-md-12 form-group">
                                <textarea name="contenu" class="form-control leContenu" data-length=140 placeholder="Votre message ici *" rows="2" required></textarea>
                                <h6 class="text-warning m-t-xxs"><span class="char-count">140 caractères restants</span></h6>
                            </div>
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
                    <h1 class="modal-title">Modifier le rappel</h1>
                </div>
                <div class="modal-body p-4">
                    <form action="<?= App::url("campagnes/rappels/add?id=".$campagne->id) ?>" method="post" id="editContactForm">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" class="form-control leEntete" maxlength="10" name="entete" id="editEntete" placeholder="Entete">
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" class="form-control laDate" name="date" id="editDate" placeholder="Date d'envoi">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="hidden" value="" name="id" id="idContact">
                                <textarea name="contenu" class="form-control leContenu" id="editContenu" data-length=140 placeholder="Votre message ici *" rows="2" required></textarea>
                                <h6 class="text-warning m-t-xxs"><span class="char-count">140 caractères restants</span></h6>
                            </div>
                        </div>
                        <button class="btn btn-dark btn-block" id="submit_edit_contact" type="submit">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require 'Views/Site/Home/modal_sms.php'; ?>