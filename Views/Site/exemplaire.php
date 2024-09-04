<?php
/**
 * Created by PhpStorm.
 * User: yousseph
 * Date: 10/09/2020
 * Time: 15:41
 */


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
        <title><?= App::getTitle(); ?></title>

        <meta charset="utf-8">
        <meta content="Anil z" name="author">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Brancos is eCommerce Website for sell Fashion Products, Shoes, Bags, Cosmetics, Clothes, Sunglasses, Furniture, Kids Products, Electronics, Stationery Products and Sporting Goods.">
        <meta name="keywords" content="ecommerce, electronics store, Fashion store, furniture store,  bootstrap 4, clean, minimal, modern, online store, responsive, retail, shopping, ecommerce store">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!--<meta http-equiv="Content-Security-Policy" content="script-src 'self'">-->
        <meta name="title" content="<?= App::getTitle(); ?>">
        <meta name="robots" content="index" />
        <meta name="robots" content="follow" />

        <link rel="shortcut icon" href="<?= FileHelper::url($setting->photo); ?>" />
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
        <!-- Style CSS -->
        <link rel="stylesheet" type="text/css" href="<?= FileHelper::url('assets/assets/css/style.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= FileHelper::url('assets/assets/css/responsive.css') ?>" />

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

    <body >

    <!-- START HEADER -->
    <header class="header_wrap">

        <div class="middle-header dark_skin">
            <div class="container">
                <div class="nav_block">
                    <!-- start logo -->
                    <a href="<?= App::url('index') ?>" class="navbar-brand"><img id="logo" src="<?= FileHelper::url('assets/assets/images/icon3.png'); ?>" alt="logo"></a>
                    <!-- end logo -->
                    <div class="product_search_form radius_input search_form_btn">
                        <form>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="custom_select">
                                        <select class="first_null not_chosen">
                                            <option value="">All Category</option>
                                            <option value="Dresses">Dresses</option>
                                            <option value="Shirt-Tops">Shirt &amp; Tops</option>
                                            <option value="T-Shirt">T-Shirt</option>
                                            <option value="Pents">Pents</option>
                                            <option value="Jeans">Jeans</option>
                                        </select>
                                    </div>
                                </div>
                                <input class="form-control" placeholder="Search Product..." required="" type="text">
                                <button type="submit" class="search_btn3">Search</button>
                            </div>
                        </form>
                    </div>
                    <ul class="navbar-nav attr-nav align-items-center">
                        <li><a href="#" class="nav-link"><i class="linearicons-user"></i></a></li>
                        <li><a href="#" class="nav-link"><i class="linearicons-heart"></i><span class="wishlist_count">0</span></a></li>
                        <li class="dropdown cart_dropdown"><a class="nav-link cart_trigger" href="#" data-toggle="dropdown"><i class="linearicons-bag2"></i><span class="cart_count">2</span><span class="amount"><span class="currency_symbol">$</span>159.00</span></a>
                            <div class="cart_box cart_right dropdown-menu dropdown-menu-right">
                                <ul class="cart_list">
                                    <li>
                                        <a href="#" class="item_remove"><i class="ion-close"></i></a>
                                        <a href="#"><img src="assets\images\cart_thamb1.jpg" alt="cart_thumb1">Variable product 001</a>
                                        <span class="cart_quantity"> 1 x <span class="cart_amount"> <span class="price_symbole">$</span></span>78.00</span>
                                    </li>
                                    <li>
                                        <a href="#" class="item_remove"><i class="ion-close"></i></a>
                                        <a href="#"><img src="assets\images\cart_thamb2.jpg" alt="cart_thumb2">Ornare sed consequat</a>
                                        <span class="cart_quantity"> 1 x <span class="cart_amount"> <span class="price_symbole">$</span></span>81.00</span>
                                    </li>
                                </ul>
                                <div class="cart_footer">
                                    <p class="cart_total"><strong>Subtotal:</strong> <span class="cart_price"> <span class="price_symbole">$</span></span>159.00</p>
                                    <p class="cart_buttons"><a href="#" class="btn btn-fill-line view-cart">View Cart</a><a href="#" class="btn btn-fill-out checkout">Checkout</a></p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bottom_header dark_skin main_menu_uppercase border-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-md-9 col-sm-7 col-12">
                        <nav class="navbar navbar-expand-lg">
                            <button class="navbar-toggler side_navbar_toggler" type="button" data-toggle="collapse" data-target="#navbarSidetoggle" aria-expanded="false">
                                <span class="ion-android-menu"></span>
                            </button>
                            <div class="pr_search_icon">
                                <a href="javascript:void(0);" class="nav-link pr_search_trigger"><i class="linearicons-magnifier"></i></a>
                            </div>
                            <div class="collapse navbar-collapse mobile_side_menu" id="navbarSidetoggle">
                                <ul class="navbar-nav">
                                    <li <?= $page==''?' class="active"':''; ?>>
                                    <a class="nav-link  active" href="<?= App::url('') ?>">Acceuil</a>
                                    </li>
                                    <li class="dropdown" <?= $page=='about'?' class="active"':''; ?>>
                                        <a class="dropdown-toggle nav-link" href="<?= App::url('') ?>" data-toggle="dropdown">Categories</a>
                                        <div class="dropdown-menu">
                                            <ul>
                                                <li><a class="dropdown-item nav-link nav_item" href="about.html">Vetements</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="contact.html">Cosmetiques</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="faq.html">Electro-menagers</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="404.html">Electroniques</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="login.html">Accessoires d'Occasions</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="dropdown dropdown-mega-menu" <?= $page=='about'?' class="active"':''; ?>>
                                        <a class="dropdown-toggle nav-link" href="<?= App::url('') ?>" data-toggle="dropdown">Articles</a>
                                        <div class="dropdown-menu">
                                            <ul class="mega-menu d-lg-flex">
                                                <li class="mega-menu-col col-lg-3">
                                                    <ul>
                                                        <li class="dropdown-header">Femme</li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-three-columns.html">Vestibulum sed</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-four-columns.html">Donec porttitor</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-grid-view.html">Donec vitae facilisis</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-list-view.html">Curabitur tempus</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-left-sidebar.html">Vivamus in tortor</a></li>
                                                    </ul>
                                                </li>
                                                <li class="mega-menu-col col-lg-3">
                                                    <ul>
                                                        <li class="dropdown-header">Homme</li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-cart.html">Donec vitae ante ante</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="checkout.html">Etiam ac rutrum</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="wishlist.html">Quisque condimentum</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="compare.html">Curabitur laoreet</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="cart-empty.html">Vivamus in tortor</a></li>
                                                    </ul>
                                                </li>
                                                <li class="mega-menu-col col-lg-3">
                                                    <ul>
                                                        <li class="dropdown-header">Enfant</li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail.html">Donec vitae facilisis</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-left-sidebar.html">Quisque condimentum</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-right-sidebar.html">Etiam ac rutrum</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-thumbnails-left.html">Donec vitae ante ante</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-accordion-style.html">Donec porttitor</a></li>
                                                    </ul>
                                                </li>
                                                <li class="mega-menu-col col-lg-3">
                                                    <ul>
                                                        <li class="dropdown-header">Accessores</li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail.html">Curabitur tempus</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-left-sidebar.html">Quisque condimentum</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-right-sidebar.html">Vivamus in tortor</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-thumbnails-left.html">Donec vitae facilisis</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-accordion-style.html">Donec porttitor</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>

                                    <li class="dropdown dropdown-mega-menu" <?= $page=='realisation'?' class="active"':''; ?>>
                                        <a class=" nav-link" href="<?= App::url('realisation') ?>" data-toggle="dropdown">Boutique</a>
                                    </li>
                                    <li <?= $page=='contact'?' class="active"':''; ?>>
                                        <a class="nav-link nav_item" href="<?= App::url('contact') ?>">Contactez-Nous</a></li>
                                    <li <?= $page=='contact'?' class="active"':''; ?>>
                                        <a class="nav-link nav_item" href="<?= App::url('about') ?>">A propos </a></li>
                                    <?php
                                    if($auth->isLogged()){
                                        echo
                                            ' <li ><a class=" nav-link" href="'. App::url('logout').'">Deconnexion</a></li>
                                               ';
                                    }else{
                                        echo '<li><a class=" nav-link" href="'.App::url("login").'" >Connexion</a></li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="contact_phone contact_support">
                                <i class="linearicons-phone-wave"></i>
                                <span>00237 694-408-247</span>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- END HEADER -->

    <?= $content; ?>

    <?php if (!isset($isAuthentificationView)){ ?>
        <!-- START FOOTER -->
        <footer class="footer_dark">
            <div class="footer_top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="widget">
                                <div class="footer_logo">
                                    <a href="#"><img id="logo" src="<?= FileHelper::url('assets/assets/images/icon3.png'); ?>"</a>
                                </div>
                                <p>If you are going to use of Lorem Ipsum need to be sure there isn't hidden of text</p>
                            </div>
                            <div class="widget">
                                <ul class="social_icons social_white">
                                    <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                    <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                    <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                                    <li><a href="#"><i class="ion-social-youtube-outline"></i></a></li>
                                    <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-6">
                            <div class="widget">
                                <h6 class="widget_title">Useful Links</h6>
                                <ul class="widget_links">
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">FAQ</a></li>
                                    <li><a href="#">Location</a></li>
                                    <li><a href="#">Affiliates</a></li>
                                    <li><a href="#">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-6">
                            <div class="widget">
                                <h6 class="widget_title">Category</h6>
                                <ul class="widget_links">
                                    <li><a href="#">Vetements</a></li>
                                    <li><a href="#">Cosmetiques</a></li>
                                    <li><a href="#">Electro-menagers</a></li>
                                    <li><a href="#">Electroniques</a></li>
                                    <li><a href="#">Accessoires d'Occasions</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="widget">
                                <h6 class="widget_title">My Account</h6>
                                <ul class="widget_links">
                                    <li><a href="#">My Account</a></li>
                                    <li><a href="#">Discount</a></li>
                                    <li><a href="#">Returns</a></li>
                                    <li><a href="#">Orders History</a></li>
                                    <li><a href="#">Order Tracking</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="widget">
                                <h6 class="widget_title">Contact Info</h6>
                                <ul class="contact_info contact_info_light">
                                    <li>
                                        <i class="ti-location-pin"></i>
                                        <p>123 Street, Old Trafford, LT Douala , CM</p>
                                    </li>
                                    <li>
                                        <i class="ti-email"></i>
                                        <a href="mailto:ousmanou@uisolution.net">ousmanou@uisolution.net</a>
                                    </li>
                                    <li>
                                        <i class="ti-mobile"></i>
                                        <p>00237 694 408 247</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom_footer border-top-tran">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-md-0 text-center text-md-left">© 2020 All Rights Reserved by Bestwebcreator</p>
                        </div>
                        <div class="col-md-6">
                            <ul class="footer_payment text-center text-lg-right">
                                <li><a href="#"><img src="<?= FileHelper::url('assets/assets/images/visa.png'); ?>" alt="visa"></a></li>
                                <li><a href="#"><img src="<?= FileHelper::url('assets/assets/images/discover.png'); ?>" alt="discover"></a></li>
                                <li><a href="#"><img src="<?= FileHelper::url('assets/assets/images/master_card.png'); ?>" alt="master_card"></a></li>
                                <li><a href="#"><img src="<?= FileHelper::url('assets/assets/images/paypal.png'); ?>" alt="paypal"></a></li>
                                <li><a href="#"><img src="<?= FileHelper::url('assets/assets/images/amarican_express.png'); ?>" alt="amarican_express"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- END FOOTER -->
    <?php } ?>
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