<?php
/**
 * Created by PhpStorm.
 * User: Ross
 * Date: 8/23/2018
 * Time: 5:45 AM
 */

use Projet\Model\App;
use Projet\Model\DateParser;
use Projet\Model\FileHelper;
use Projet\Model\StringHelper;

App::addScript("assets/js/pages/addContact.js", true, true);
App::setTitle("Mes commandes");
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
            Mes commandes
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
                            <h4 class="heading">Mes commandes <small>(<?= thousand($nbre->Total); ?>)</small></h4>
                            <table class="col-md-12 table table-striped table-hover table-responsive">
                                <thead>
                                <tr>
                                    <th class="">Ref</th>
                                    <th class="">Besoins</th>
                                    <th class="">Date</th>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Statut</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($commandes) {
                                    foreach ($commandes as $commande) {
                                        $isCharges = $commande->charge?"Modifier":"Ajouter";
                                        /*<li>
                                              <a href="#newModal" data-toggle="modal" data-id="'. $commande->id . '"   data-url="'.App::url('commandes/update').'" class="updateCommande">Modifier</a>
                                              </li>*/
                                        $valAction = $commande->etat == 0 ? '
                                                  <li>
                                                      <a href="#" data-url="'.App::url('commandes/delete').'" data-id="'.$commande->id.'" class="deleteCommande">Annuler</a>
                                                  </li>
                                                  <li>
                                                      <a href="#chargeModal" data-toggle="modal" data-action="' .$isCharges . '" data-id="' . $commande->id . '" data-reference="' . $commande->reference . '" title="Cahier de charge" class="charge">'.$isCharges.' le cahier de charges</a>
                                                  </li> ' : '';
                                        echo '
                                              <tr>
                                                  <td class="">' . $commande->reference . '</td>
                                                  <td class="" title="'.$commande->besoins.'">' .StringHelper::abbreviate($commande->besoins,40). '</td> 
                                                  <td class="">' .DateParser::DateShort($commande->created_at,1) . '</td> 
                                                  <td class="text-center">
                                                      <div class="btn-group">
                                                          <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                          Actions
                                                          </button>
                                                          <ul class="dropdown-menu" role="menu">
                                                          <li>
                                                          <a href="#modalDetail" data-toggle="modal" data-url="'.App::url("commandes/details").'" data-id="' . $commande->id . '" title="Detail" class="details">Detail</a>
                                                          </li>
                                                          ' . $valAction . '      
                                                          </ul>
                                                      </div>
                                                  </td>
                                                  <td class="text-center ">' . StringHelper::$tabStateCommande[$commande->etat] . '</td>
                                              </tr>
                                              ';
                                        }} else {
                                    echo ' <tr class=" mt-5"> <td colspan="5" class="text-center text-danger">Liste des commandes vide</td></tr>';
                                    }
                                    ?>
                                </tbody>
                                <?php if (!empty($commandes)) { ?>
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
<?php require 'Views/Site/Home/modal_sms.php'; ?>

<div class="modal fade " id="modalDetail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h3 id="title"></h3>
            </div>
            <div class="modal-body p-4 bg-light">
                <div class="loader">
                    <p class="text-center m-t-lg"><img class="img-xs" src="<?= FileHelper::url('assets/img/load.gif') ?>" alt=""></p>
                </div>
                <div id="containerDetails"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade " id="chargeModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title titleCharge"></h3>
            </div>
            <form action="<?= App::url('commandes/uploadCharges') ?>" id="chargeForm" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="idCommande" name="idCommande">
                    <p class="mainColor text-right">* Champs obligatoires</p>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="charge">Cahier de charges (.pdf,.docx,.doc) <b>*</b></label>
                            <input type="file" class="form-control" id="charge" style="padding: 0 !important;" accept=".pdf,.doc,.docx" name="charge">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="chargeBtn btn btn-dark">Action</button>
                </div>
            </form>
        </div>
    </div>
</div>