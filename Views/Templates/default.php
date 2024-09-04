<?php

use Projet\Model\App;
use Projet\Model\FileHelper;
use Projet\Model\Session;

$auth = App::getDBAuth();
$page = substr(explode('?',$_SERVER["REQUEST_URI"])[0],1);
$session = Session::getInstance();
?>
<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- SITE TITLE -->
    <title><?= App::getTitle(); ?></title>
    <!-- Favicon Icon -->
    <link rel="shortcut icon" type="text/css" href="<?= FileHelper::url('assets/assets/images/favicon.png') ?>" />
    <!-- Animation CSS -->
    <link rel="stylesheet" type="text/css" href="<?= FileHelper::url('assets/assets/css/animate.css') ?>" />
    <!-- Latest Bootstrap min CSS -->
    <link rel="stylesheet" type="text/css" href="<?= FileHelper::url('assets/assets/bootstrap/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= FileHelper::url('') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= FileHelper::url('') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= FileHelper::url('') ?>" />

    <!-- Icon Font CSS -->
    <link rel="stylesheet" type="text/css" href="<?= FileHelper::url('assets/assets/css/all.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= FileHelper::url('assets/assets/css/ionicons.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= FileHelper::url('assets/assets/css/themify-icons.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= FileHelper::url('assets/assets/css/linearicons.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= FileHelper::url('assets/assets/css/flaticon.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= FileHelper::url('assets/assets/css/simple-line-icons.css') ?>" />


    <!--- owl carousel CSS-->
    <link rel="stylesheet" type="text/css" href="<?= FileHelper::url('assets/assets/owlcarousel/css/owl.carousel.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= FileHelper::url('assets/assets/owlcarousel/css/owl.theme.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= FileHelper::url('assets/assets/owlcarousel/css/owl.theme.default.min.css') ?>" />

    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" type="text/css" href="<?= FileHelper::url('assets/assets/css/magnific-popup.css') ?>" />
    <!-- jquery-ui CSS -->
    <link rel="stylesheet" type="text/css" href="<?= FileHelper::url('assets/assets/css/jquery-ui.css') ?>" />
    <!-- Slick CSS -->
    <link rel="stylesheet" type="text/css" href="<?= FileHelper::url('assets/assets/css/slick.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= FileHelper::url('assets/assets/css/slick-theme.css') ?>" />


</head>
<body >

<div >
    <?= $content; ?>
</div>
<!-- Latest jQuery -->
<script type="text/javascript" src="<?= FileHelper::url('assets/assets/js/jquery-1.12.4.min.js') ?>"></script>
<!-- jquery-ui -->
<script type="text/javascript" src="<?= FileHelper::url('assets/assets/js/jquery-ui.js') ?>"></script>
<!-- popper min js -->
<script type="text/javascript" src="<?= FileHelper::url('assets/assets/js/popper.min.js') ?>"></script>
<!-- Latest compiled and minified Bootstrap -->
<script type="text/javascript" src="<?= FileHelper::url('assets/assets/bootstrap/js/bootstrap.min.js') ?>"></script>
<!-- owl-carousel min js  -->
<script type="text/javascript" src="<?= FileHelper::url('assets/assets/owlcarousel/js/owl.carousel.min.js') ?>"></script>
<!-- magnific-popup min js  -->
<script type="text/javascript" src="<?= FileHelper::url('assets/assets/js/magnific-popup.min.js') ?>"></script>
<!-- waypoints min js  -->
<script type="text/javascript" src="<?= FileHelper::url('assets/assets/js/waypoints.min.js') ?>"></script>
<!-- parallax js  -->
<script type="text/javascript" src="<?= FileHelper::url('assets/assets/js/parallax.js') ?>"></script>
<!-- countdown js  -->
<script type="text/javascript" src="<?= FileHelper::url('assets/assets/js/jquery.countdown.min.js') ?>"></script>
<!-- fit video  -->
<script type="text/javascript" src="<?= FileHelper::url('assets/assets/js/Hoverparallax.min.js') ?>"></script>
<!-- jquery.countTo js  -->
<script type="text/javascript" src="<?= FileHelper::url('assets/assets/js/jquery.countTo.js') ?>"></script>
<!-- imagesloaded js -->
<script type="text/javascript" src="<?= FileHelper::url('assets/assets/js/imagesloaded.pkgd.min.js') ?>"></script>
<!-- isotope min js -->
<script type="text/javascript" src="<?= FileHelper::url('assets/assets/js/isotope.min.js') ?>"></script>
<!-- jquery.appear js  -->
<script type="text/javascript" src="<?= FileHelper::url('assets/assets/js/jquery.appear.js') ?>"></script>
<!-- jquery.parallax-scroll js -->
<script type="text/javascript" src="<?= FileHelper::url('assets/assets/js/jquery.parallax-scroll.js') ?>"></script>
<!-- jquery.dd.min js -->
<script type="text/javascript" src="<?= FileHelper::url('assets/assets/js/jquery.dd.min.js') ?>"></script>
<!-- slick js -->
<script type="text/javascript" src="<?= FileHelper::url('assets/assets/js/slick.min.js') ?>"></script>
<!-- elevatezoom js -->
<script type="text/javascript" src="<?= FileHelper::url('assets/js/jquery.elevatezoom.js') ?>"></script>
<!-- scripts js -->


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