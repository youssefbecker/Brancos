<?php
/**
 * Created by PhpStorm.
 * User: Ross
 * Date: 8/17/2018
 * Time: 4:39 PM
 */

use Projet\Model\App;
use Projet\Model\FileHelper;

App::setTitle("Authnetification");
App::addScript("assets/js/pages/login.js",true,true);
App::addScript("assets/js/pages/register.js",true,true);
$isAuthentificationView = true;
?>
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

    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <ul>
                            <li>
                                <a href="<?= App::url('') ?>">Accueil</a>
                            </li>
                            <li class="active">
                                <a href="<?= App::url('login') ?>">Authentification</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Accéder à son compte</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="login_area section--padding2">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <form action="<?= App::url('login/log') ?>" method="post" id="loginForm">
                        <div class="cardify login">
                            <div class="login--header">
                                <h3>Déjà enregistré?</h3>
                                <p>Vous pouvez vous connecter en toute sécurité</p>
                            </div>

                            <div class="login--form">
                                <div class="form-group">
                                    <input id="logins" type="text" class="text_field"  name="login"  required="required" placeholder="Numéro de téléphone *" maxlength="70">
                                </div>

                                <div class="form-group">
                                    <input id="passwords" type="password" class="text_field"  name="password" required="required" placeholder="Mot de passe *" maxlength="70"">
                                </div>

                                <button class="btn btn--md btn--round sendBtns" type="submit" id="submit_login"><i class="lnr lnr-lock"></i> Se connecter</button>

                                <div class="login_assist">
                                    <p class="recover">Vous avez perdu votre
                                        <a href="javascript:void(0)">login</a> ou
                                        <a href="javascript:void(0)">mot de passe</a>?</p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-7">
                    <form action="<?= App::url('login/register') ?>" method="post" id="registerForm">
                        <div class="cardify signup_form">
                            <div class="login--header">
                                <h3>Créer un compte</h3>
                                <p>Veuillez remplir les champs suivants avec les informations appropriées pour enregistrer un nouveau compte Afrik Fid.</p>
                            </div>

                            <p class="mainColor text-right">* Champs obligatoires</p>
                            <div class="login--form row">

                                <div class="form-group col-md-12">
                                    <input id="nom" type="text" class="text_field" required="required"  name="nom"  placeholder="Votre nom" maxlength="70">
                                </div>

                                <div class="form-group col-md-6">
                                    <input id="numero" class="text_field" required="required" type="tel" name="numero"  placeholder="Numéro de téléphone *" maxlength="70">
                                </div>

                                <div class="form-group col-md-6">
                                    <input id="email" type="email" name="email" class="text_field" placeholder="Votre adresse email">
                                </div>
                                <div class="form-group col-md-6">
                                    <input id="pass"  class="text_field" required="required" type="password" name="pass" placeholder="Mot de passe *"maxlength="70">
                                </div>

                                <div class="form-group col-md-6">
                                    <input id="confirm" type="password" class="text_field" required="required" placeholder="Confirmer le mot de passe *" name="confirm" maxlength="70">
                                </div>

                                <div class="custom-radio col-md-12 divCheck mb-3">
                                    <input id="opt" name="filter_opt" value="1" type="checkbox">
                                    <label for="opt">
                                        <span class="circle"></span>En cliquant sur le bouton ci-dessous, vous acceptez les <a href="#">Conditions générales d'utilisation</a> et
                                        la <a href="#">Politique de confidentialité</a> de Brancos</label>
                                </div>

                                <div class="col-md-12">
                                    <button class="btn btn--md btn--round register_btn sendBtn" type="submit" id="submit_register"><i class="lnr lnr-user"></i> Enregistrer</button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<div class="modal fade" id="modalReset">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" data-dismiss="modal">&times;</span>
                <h3 id="titleReset">Réinitialiser votre mot de passe</h3>
            </div>
            <div class="modal-body" id="containerReset">
                <form action="<?= App::url("login/reset")?>" method="post" id="resetForm">
                    <div class="form-group">
                        <input type="tel" name="numero" class="form-control" placeholder="votre numero" required/>
                    </div>
                    <button class="btn-dark btn btn-block" type="submit" id="submit_password">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</div>
