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
use Projet\Model\Encrypt;

App::addScript("assets/js/pages/account.js",true,true);
App::setTitle("Mon compte");
$laPage = isset($_GET['page'])?$_GET['page']:1;
   // $paginator = new \Projet\Model\Paginator($url,$laPage,$nbrePages,$_GET,$_GET);
?>
<div class="ui-hero hero-sm bg-dark-gray hero-svg-layer-4">
    <div class="container">
        <h1 class="heading">
            <?= App::salutation().ucfirst($user->nom); ?>
        </h1>
        <p class="paragraph">

        </p>
    </div>
</div>
<div class="main" role="main">
    <?php
    if (isset($_SESSION['success'])) {
        echo '<div class="alert alert-success col-md-12 text-center alert-dismissible" id="alertSuccess"><button  class="close" data-dismiss="alert">&times;</button><span>' . $session->read('success') . '</span></div>';
        $session->delete('success');
    }
    if (isset($_SESSION['warning'])) {
        echo '<div class="alert alert-warning col-md-12 text-center alert-dismissible" id="alertDanger"><button  class="close" data-dismiss="alert">&times;</button><span>' . $session->read('warning') . '</span></div>';
        $session->delete('warning');
    }
    ?>
    <div class="section contact-section">

        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="ui-card form-card shadow-xl bg-indigo">
                        <div class="card-header pb-0">
                            <h3 class="heading">Modifier Mon Mot De Passe</h3>
                        </div>
                        <div class="card-body">
                            <form autocomplete="on" action="<?=App::url('login/changePass?id='.Encrypt::crypter($user->id))?>" method="POST" id="registerForm">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input type="password" class="form-control" id="passCourant"   placeholder="Mot de passe courant *">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control" id="newPass"   placeholder="Nouveau mot de passe *" >
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control" id="newPassC"    placeholder="Confirmer *">
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-dark btn-block" type="submit" id="submit_btn">Modifier le mot de passe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



  



