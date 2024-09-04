<?php

use Projet\Model\App;
use Projet\Model\Paginator;
use Projet\Model\StringHelper;

App::setTitle("Mon compte");
App::addScript("assets/js/pages/message.js",true);
App::addScript("assets/js/pages/chart.js",true);
App::addStyle("assets/plugins/morris-js/morris.min.css",true);
App::addScript("assets/plugins/morris-js/morris.min.js",true);
App::addScript("assets/plugins/morris-js/raphael-js/raphael.min.js",true);
App::addScript("assets/plugins/sparkline/jquery.sparkline.min.js",true);
App::addScript("assets/plugins/flot-charts/jquery.flot.min.js",true);
?>
<div class="ui-hero hero-sm bg-dark-gray hero-svg-layer-4">
    <div class="container">
        <h1 class="heading">
            Tableau de bord
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
                            <?php require 'side_bar.php'; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require 'modal_sms.php'; ?>