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
use Projet\Model\Paginator;
use Projet\Model\StringHelper;

App::addScript("assets/js/pages/addContact.js", true, true);
App::setTitle("Mes licenses");
App::addScript("assets/js/pages/message.js", true, true);
App::addScript("assets/js/pages/license.js", true, true);
$url = substr(explode('?', $_SERVER["REQUEST_URI"])[0], 1);
$laPage = isset($_GET['page']) ? $_GET['page'] : 1;
$paginator = new Paginator($url, $laPage, $nbrePages, $_GET, $_GET);
?>
<div class="ui-hero hero-sm bg-dark-gray hero-svg-layer-4">
    <div class="container">
        <h1 class="heading">
            Mes licenses
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
                                    <h4 class="heading">Mes licenses <small>(<?= thousand($nbre->Total); ?>)</small></h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="actions text-right mb-3">
                                        <a href="<?= App::url('price') ?>" class="btn btn-success text-white"><i class="fa fa-plus"></i> Nouvele license</a>
                                    </div>
                                </div>
                            </div>
                            <table class="col-md-12 table table-striped table-hover table-responsive">
                                <thead>
                                <tr>
                                    <th class="text-left">Type</th>
                                    <th class="text-left">Clé</th>
                                    <th class="text-left">Date</th>
                                    <th class="text-center">Statut</th>
                                    <th class="text-center">#</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($licenses) {
                                    foreach ($licenses as $license) {
                                        echo '
                                              <tr>
                                                  <th class="text-left">'.$license->type.'</th>
                                                  <td class="text-left">'.$license->cle.'</td>
                                                  <td class="text-left">Du '.DateParser::DateConviviale($license->debut).' au '.DateParser::DateConviviale($license->fin).'</td>
                                                  <td class="text-center">'.StringHelper::$tabLicense[$license->etat].'</td> 
                                                  <td>
                                                    <a href="#modalDetail" data-toggle="modal" data-url="'.App::url("licenses/details").'" data-id="'.$license->id .'" title="Detail" class="details">
                                                        <i class="fa fa-info fa-2x"></i>
                                                    </a>
                                                  </td>
                                              </tr>
                                              ';
                                        }} else {
                                    echo ' <tr class="mt-5"> <td colspan="5" class="text-center text-danger">Liste des licenses vide</td></tr>';
                                    }
                                    ?>
                                </tbody>
                                <?php if (!empty($licenses)) { ?>
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