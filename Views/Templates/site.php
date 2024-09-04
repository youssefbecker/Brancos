<?php

use Projet\Database\Service;
use Projet\Database\Settings;
use Projet\Model\App;
use Projet\Model\FileHelper;
use Projet\Model\StringHelper;
use Projet\Model\Session;

$page = substr(explode('?',$_SERVER["REQUEST_URI"])[0],1);
$class = 'error404-page';
$classNav = ' navbar-dark bg-indigo';
$classOthers = ' navbar-center';
if($page!='error'){
    $class = 'ui-transparent-nav';
    $classNav = ' transparent navbar-dark bg-dark-gray';
}
if($page==''){
    $classOthers = ' navbar-center';
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="title" content="<?= App::getTitle(); ?>">
        <meta name="robots" content="index" />
        <meta name="robots" content="follow" />

        <link rel="icon" type="image/png" href="Public\assets\images\logo.png">

        <title><?= App::getTitle(); ?></title>

        <link rel="shortcut icon" href="<?= FileHelper::url($setting->photo); ?>" />

        <link href="<?= FileHelper::url('assets\css\animate.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?= FileHelper::url('assets\css\font-awesome.min.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?= FileHelper::url('assets\css\fontello.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?= FileHelper::url('assets\css\jquery-ui.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?= FileHelper::url('assets\css\lnr-icon.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?= FileHelper::url('assets\css\alertify.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?= FileHelper::url('assets\css\trumbowyg.min.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?= FileHelper::url('assets\css\bootstrap\bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?= FileHelper::url('assets\css\owl.carousel.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?= App::url('error')?>" rel="stylesheet" type="text/css">
        <link href="<?= FileHelper::url('assets\css\waitMe.min.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?= FileHelper::url('assets\style.css') ?>" rel="stylesheet" type="text/css">
        <?php
        if(!empty(App::getStyles()['default'])){
            foreach (App::getStyles()['default'] as $default) {
                echo $default.PHP_EOL;
            }
        }
        if(!empty(App::getStyles()['source'])){
            foreach (App::getStyles()['source'] as $source) {
                echo $source.PHP_EOL;
            }
        }
        if(!empty(App::getStyles()['script'])){
            foreach (App::getStyles()['script'] as $script) {
                echo $script.PHP_EOL;
            }
        }
        ?>
    </head>

    <body class="home1 mutlti-vendor">

    <div class="menu-area">
        <div class="top-menu-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-6 v_middle">
                        <div class="logo">
                            <a href="https://www.afrikfid.com">
                                <a href="<?= App::url('index') ?>" class="navbar-brand"><img id="logo" src="<?= FileHelper::url('assets/assets/images/icon3.png'); ?>" alt="logo"></a>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 offset-lg-1 col-md-9 col-6 v_middle">
                        <div class="author-area">
                            <a href="marchand\register.html" class="author-area__seller-btn inline"><i class="lnr lnr-users"></i> Boutiques</a>
                            <div class="author__notification_area">
                                <ul>
                                    <li class="has_dropdown">
                                        <div class="icon_wrap">
                                            <span class="lnr lnr-alarm"></span>
                                            <span class="notification_count noti">0</span>
                                        </div>

                                        <div class="dropdown notification--dropdown">

                                            <div class="dropdown_module_header">
                                                <h4>Notifications</h4>
                                                <a href="login.html">Voir tout</a>
                                            </div>

                                            <div class="notifications_module">

                                            </div>
                                        </div>
                                    </li>

                                    <li class="has_dropdown">
                                        <div class="icon_wrap">
                                            <span class="lnr lnr-cart"></span>
                                            <span class="notification_count purch absolute">0</span>
                                        </div>
                                        <div class="dropdown dropdown--cart">
                                            <div class="cart_area" id="contenuCard">

                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="author-author__info inline has_dropdown">
                                <div class="author__avatar">
                                    <img src="<?= FileHelper::url('assets/assets/images/usr_avatar.png'); ?>" alt="user avatar">
                                </div>
                                <div class="autor__info">
                                    <p class="name">Invité</p>
                                    <p class="ammount">Bonsoir</p>
                                </div>

                                <div class="dropdown dropdown--author">
                                    <ul>
                                        <li>
                                            <a href="<?= App::url('login') ?>">
                                                <span class="lnr lnr-lock"></span>Se connecter</a>
                                        </li>
                                        <li>
                                            <a href="<?= App::url('login') ?>">
                                                <span class="lnr lnr-user"></span>Créer son Compte</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="mobile_content">
                            <span class="lnr lnr-user menu_icon"></span>
                            <div class="offcanvas-menu closed">
                                <span class="lnr lnr-cross close_menu"></span>
                                <div class="author-author__info">
                                    <div class="author__avatar v_middle">
                                        <img src="<?= FileHelper::url('assets/assets/images/usr_avatar.png'); ?>" alt="user avatar">
                                    </div>
                                    <div class="autor__info v_middle">
                                        <p class="name">Invité</p>
                                        <p class="ammount">Bonsoir</p>
                                    </div>
                                </div>
                                <!--end /.author-author__info-->

                                <div class="author__notification_area">
                                    <ul>
                                        <li>
                                            <a href="login.html">
                                                <div class="icon_wrap">
                                                    <span class="lnr lnr-alarm"></span>
                                                    <span class="notification_count noti">0</span>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="https://www.brancos/cart/checkout">
                                                <div class="icon_wrap">
                                                    <span class="lnr lnr-cart"></span>
                                                    <span class="notification_count purch absolute">0</span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!--start .author__notification_area -->

                                <div class="dropdown dropdown--author">
                                    <ul>
                                        <li>
                                            <a href="<?= App::url('login') ?>"">
                                                <span class="lnr lnr-lock"></span>Se connecter</a>
                                        </li>
                                        <li>
                                            <a href="<?= App::url('login') ?>"">
                                                <span class="lnr lnr-user"></span>Créer son Compte</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="text-center">
                                    <a href="<?= App::url('login') ?>" class="author-area__seller-btn inline">Devenez un marchand</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mainmenu">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="navbar-header">
                            <div class="mainmenu__search">
                                <form action="https://www.afrikfid.boutique/search" method='get'>
                                    <div class="searc-wrap">
                                        <input type="text" name="q" placeholder="Chercher un produit">
                                        <button type="submit" class="search-wrap__btn">
                                            <span class="lnr lnr-magnifier"></span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <nav class="navbar navbar-expand-md navbar-light mainmenu__menu">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav">
                                    <li<?= $page==''?' class="active"':''; ?>>
                                        <a href="<?= App::url('') ?>">Accueil</a>
                                    </li>
                                    <li class="has_megamenu">
                                        <a href="#">Catégories</a>
                                        <div class="dropdown_megamenu contained">
                                            <div class="megamnu_module">
                                                <div class="menu_items">
                                                    <div class="menu_column"><ul>
                                                            <li><a title="Bien être et Paramédical" href="sante.html">Cosmetiques</a></li>
                                                            <li><a title="Bien être et Paramédical" href="sante.html">Electro-menagers</a></li>
                                                            <li><a title="Culture et Divertissement" href="culture_et_divertissement.html">Electro-menagers</a></li>
                                                            <li><a title="Informatiques, Smartphones Objets connect" href="equipements_electriques__composants_et_telecoms.html">Vetements </a>
                                                            </li><li><a title="Maison et Décoration" href="la_maison__lumieres_et_construction.html">Accesoires d'occasion</a></li></ul>
                                                    </div>
                                        </div>
                                    </li>
                                    <li class="active" <?= $page=='contact'?' class="active"':''; ?>>
                                        <a href="<?= App::url('boutique') ?>">Boutiques</a>
                                    </li>
                                    <li class="active" class="dropdown" <?= $page=='about'?' class="active"':''; ?>>
                                        <a class="nav-link nav_item" href="<?= App::url('about') ?>">A propos</a>
                                    </li>
                                    <li class="active" <?= $page=='contact'?' class="active"':''; ?>>
                                        <a href="<?= App::url('contact') ?>">Nous contacter</a>
                                    </li>
                                    <?php
                                    if($auth->isLogged()){
                                        echo
                                            ' <li class="active"><a href="'. App::url('logout').'">Deconnexion</a></li>
                                               ';
                                    }else{
                                        echo '<li class="active"><a href="'.App::url("login").'" >Connexion</a></li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $content; ?>

    <?php if (!isset($isAuthentificationView)){ ?>
        <!-- START FOOTER -->
        <footer class="footer-area">
            <div class="footer-big section--padding">
                <!-- start .container -->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-6">
                            <div class="info-footer">
                                <div class="info__logo">
                                    <a href="<?= App::url('index') ?>" class="navbar-brand"><img id="logo" src="<?= FileHelper::url('assets/assets/images/icon3.png'); ?>" alt="logo"></a>
                                </div>
                                <ul class="info-contact mt-1">
                                    <li>
                                        <span class="lnr lnr-phone info-icon"></span>
                                        <span class="info">Tel: +237 694 408 247</span>
                                    </li>
                                    <li>
                                        <span class="lnr lnr-envelope info-icon"></span>
                                        <span class="info">info@brancos.boutique</span>
                                    </li>
                                    <li>
                                        <span class="lnr lnr-map-marker info-icon"></span>
                                        <span class="info">Akwa rue Cadtelnau Douala Cameroun</span>
                                    </li>
                                </ul>
                            </div>
                            <!-- end /.info-footer -->
                        </div>
                        <!-- end /.col-md-3 -->

                        <div class="col-lg-3 col-md-6 forPhone">

                            <div class="footer-menu forPhone" style="width: 100%">
                                <h4 class="footer-widget-title text--white">Service Client</h4>
                                <ul>
                                    <li>
                                        <a href="<?= App::url('login') ?>">Mon compte</a>
                                    </li>
                                    <li>
                                        <a href="<?= App::url('about') ?>">A propos de nous</a>
                                    </li>
                                    <li>
                                        <a href="<?= App::url('contact') ?>">Nous contacter</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end /.footer-menu -->
                        </div>
                        <!-- end /.col-md-5 -->

                        <div class="col-lg-4 col-md-12">
                            <div class="newsletter">
                                <h4 class="footer-widget-title text--white">Newsletter</h4>
                                <p class="mb-0" style="font-size: 14px;">Abonnez-vous pour obtenir les dernières nouvelles.</p>
                                <div class="newsletter__form">
                                    <form action="https://www.afrikfid.boutique/email/save" id="addEmailForm" method="post">
                                        <div class="field-wrapper" style="margin-top: 10px;margin-bottom: 10px">
                                            <input id="emailNews" class="relative-field rounded" type="email" required="" placeholder="Adresse Email">
                                            <button class="btn btn--round" id="btnNews" type="submit">S'inscrire</button>
                                        </div>
                                    </form>
                                </div>

                                <!-- start .social -->
                                <div class="social social--color--filled">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <span class="fa fa-facebook"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="fa fa-twitter"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="fa fa-google-plus"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="fa fa-linkedin"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="fa fa-youtube"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mini-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright-text">
                                <p>Copyright &copy; 2020
                                    <a href="#">Brancos</a> par
                                    <a href="mailto:ousmanou@uisolution.com">Baba Oumarou & Ousmanou Youssouf</a>
                                </p>
                            </div>

                            <div class="go_top">
                                <span class="lnr lnr-chevron-up"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>        <!-- END FOOTER -->
    <?php } ?>
    <script type="text/javascript" src="<?= FileHelper::url('assets\js\vendor\jquery\jquery-1.12.3.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets\js\vendor\jquery\uikit.min.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets\js\vendor\jquery\popper.min.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets\js\vendor\bootstrap.min.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets\js\vendor\chart.bundle.min.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets\js\vendor\grid.min.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets\js\vendor\jquery-ui.min.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets\js\vendor\jquery.barrating.min.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets\js\vendor\jquery.countdown.min.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets\js\vendor\jquery.counterup.min.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets\js\vendor\owl.carousel.min.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets\js\vendor\slick.min.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets\js\vendor\jquery.easing1.3.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets\js\vendor\tether.min.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets\js\vendor\trumbowyg.min.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets\js\vendor\waypoints.min.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets\js\dashboard.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets\js\waitMe.min.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets\js\alertify.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets\js\main.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets\js\inits.js') ?>"></script>
    <script src="<?= FileHelper::url('assets\js\responsiveslides.min.js') ?>" type="text/javascript"></script>

    <script type="text/javascript">$(document).ready(function(){
            $('#slider3').responsiveSlides({
                auto: true,
                speed: 3000
            });
        });</script>

    <?php
    if(!empty(App::getScripts()['default'])){
        foreach (App::getScripts()['default'] as $default) {
            echo $default.PHP_EOL;
        }
    }
    if(!empty(App::getScripts()['source'])){
        foreach (App::getScripts()['source'] as $source) {
            echo $source.PHP_EOL;
        }
    }
    if(!empty(App::getScripts()['script'])){
        foreach (App::getScripts()['script'] as $script) {
            echo $script.PHP_EOL;
        }
    }
    ?>

    </body>

</html>