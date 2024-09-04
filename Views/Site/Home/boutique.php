<?php

use Projet\Model\App;

use Projet\Model\FileHelper;
App::setTitle("Boutiques");
?>
<!doctype html>



<body class="home1 mutlti-vendor">

<div class="menu-area">
<section class="search-wrapper">
    <div class="search-area2 bgimage">
        <div class="bg_image_holder">
            <img src="Public\assets\images\search.jpg" alt="">
        </div>
        <div class="container content_above">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="search">
                        <div class="search__title">
                            <h3>
                                <span>32</span> résultats suivants trouvés                            </h3>
                        </div>
                        <div class="search__field">
                            <form action="https://www.afrikfid.boutique/marchands" method='get'>
                                <div class="field-wrapper">
                                    <input class="relative-field rounded" type="text" name="q" placeholder="Chercher un produit">
                                    <button class="btn btn--round" type="submit">Chercher</button>
                                </div>
                            </form>
                        </div>
                        <div class="breadcrumb">
                            <ul>
                                <li>
                                    <a href="index.htm">Accueil</a>
                                </li>
                                <li class="active">
                                    <a href="#">Les Boutiques</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="filter-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="filter-bar">
                    <div class="filter__option filter--dropdown">
                        <a href="#" id="drop1" class="dropdown-trigger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Secteurs d'activité
                            <span class="lnr lnr-chevron-down"></span>
                        </a>
                        <ul class="custom_dropdown custom_drop2 dropdown-menu" aria-labelledby="drop1">

                            <li>
                                <a href="marchands-1.html?q=commerce_negoce_distribution">Alimentation
                                    <span>3</span>
                                </a>
                            </li>

                            <li>
                                <a href="marchands-2.html?q=banque_assurance">Banques et Assurances
                                    <span>4</span>
                                </a>
                            </li>

                            <li>
                                <a href="marchands-3.html?q=commerce_generale">Commerce Général
                                    <span>3</span>
                                </a>
                            </li>

                            <li>
                                <a href="marchands-4.html?q=culture_et_divertissement">Culture et Divertissement
                                    <span>2</span>
                                </a>
                            </li>

                            <li>
                                <a href="marchands-5.html?q=hotels">Hôtels
                                    <span>1</span>
                                </a>
                            </li>

                            <li>
                                <a href="marchands-6.html?q=informatique_telecoms">Informatique et Telephonies
                                    <span>3</span>
                                </a>
                            </li>

                            <li>
                                <a href="marchands-7.html?q=medical_et_paramedical">Medical et paramedical
                                    <span>2</span>
                                </a>
                            </li>

                            <li>
                                <a href="marchands-8.html?q=patisserie">Patisserie
                                    <span>1</span>
                                </a>
                            </li>

                            <li>
                                <a href="marchands-9.html?q=restaurant">Restaurant
                                    <span>5</span>
                                </a>
                            </li>

                            <li>
                                <a href="marchands-10.html?q=societes_de_services">Sociétés de services
                                    <span>11</span>
                                </a>
                            </li>

                            <li>
                                <a href="marchands-11.html?q=v">Vetements, Textiles et Accessoires
                                    <span>6</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- end /.filter__option -->

                    <div class="filter__option filter--dropdown">
                        <a href="#" id="drop2" class="dropdown-trigger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filtrer par
                            <span class="lnr lnr-chevron-down"></span>
                        </a>
                        <ul class="custom_dropdown dropdown-menu" aria-labelledby="drop2">
                        </ul>
                    </div>

                    <div class="filter__option filter--select">
                        <div class="select-wrap">
                            <select name="price">
                                <option value="12">12 par page</option>
                                <option value="15">30 par page</option>
                                <option value="25">60 par page</option>
                            </select>
                            <span class="lnr lnr-chevron-down"></span>
                        </div>
                    </div>

                    <div class="filter__option filter--layout">
                        <a href="#">
                            <div class="svg-icon">
                                <img class="svg" src="Public\assets\images\svg\grid.svg" alt="Grille">
                            </div>
                        </a>
                        <a href="#">
                            <div class="svg-icon">
                                <img class="svg" src="Public\assets\images\svg\list.svg" alt="Liste">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="products">

    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <div class="product product--card">
                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/identity/55179c96a66fc9b49f8fb0ec5abe1884.png" style="height: 210px" alt="Product Image">
                        <div class="prod_btn">
                            <a href="marchands\taamunice.html" class="transparent btn--sm btn--round">Mes produits</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: 150px">
                        <a href="marchands\taamunice.html" class="product_title">
                            <h4>TAAMUNICE</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 0">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#"></a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-tag"></span>Entreprise</a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small><small>Niger, Niamey</small></small></span>
                            <p>
                                <span class="lnr lnr-users"></span> 18</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart" style="margin-right: 0"></span>
                                <span>0</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product product--card">
                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/assets/images/fournisseur.png" style="height: 210px" alt="Product Image">
                        <div class="prod_btn">
                            <a href="marchands\afrikfid.html" class="transparent btn--sm btn--round">Mes produits</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: 150px">
                        <a href="marchands\afrikfid.html" class="product_title">
                            <h4>AfrikFid</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 0">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#">Sociétés de servic...</a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-tag"></span>Entreprise</a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small><small>Niger, Niamey</small></small></span>
                            <p>
                                <span class="lnr lnr-users"></span> 1 238</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart" style="margin-right: 0"></span>
                                <span>1</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product product--card">
                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/identity/2d4f2925d2c4c7b6c399ca02779db91c.png" style="height: 210px" alt="Product Image">
                        <div class="prod_btn">
                            <a href="marchands\ets_saley_et_fils.html" class="transparent btn--sm btn--round">Mes produits</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: 150px">
                        <a href="marchands\ets_saley_et_fils.html" class="product_title">
                            <h4>Ets SALEY & FILS</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 0">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#">Commerce Général</a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-tag"></span>Entreprise</a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small><small>Niger, Niamey</small></small></span>
                            <p>
                                <span class="lnr lnr-users"></span> 0</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart" style="margin-right: 0"></span>
                                <span>24</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product product--card">
                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/identity/fff959f7a0643cc32bef8e26fbb04b90.png" style="height: 210px" alt="Product Image">
                        <div class="prod_btn">
                            <a href="marchands\bangno-beibo-omar.html" class="transparent btn--sm btn--round">Mes produits</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: 150px">
                        <a href="marchands\bangno-beibo-omar.html" class="product_title">
                            <h4>Alyzé</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 0">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#">Restaurant</a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-tag"></span>Entreprise</a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small><small>Niger, Niamey</small></small></span>
                            <p>
                                <span class="lnr lnr-users"></span> 6</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart" style="margin-right: 0"></span>
                                <span>0</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product product--card">
                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/identity/3bed070c6a7af17732886958ae53ed1e.png" style="height: 210px" alt="Product Image">
                        <div class="prod_btn">
                            <a href="marchands\orca_deco.html" class="transparent btn--sm btn--round">Mes produits</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: 150px">
                        <a href="marchands\orca_deco.html" class="product_title">
                            <h4>ORCA DECO</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 0">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#">Alimentation </a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-tag"></span>Entreprise</a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small><small>Niger, Niamey</small></small></span>
                            <p>
                                <span class="lnr lnr-users"></span> 26</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart" style="margin-right: 0"></span>
                                <span>12</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product product--card">
                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/identity/7b9e6d217782eed6a4a14745a72fcbd9.png" style="height: 210px" alt="Product Image">
                        <div class="prod_btn">
                            <a href="marchands\byaddo.html" class="transparent btn--sm btn--round">Mes produits</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: 150px">
                        <a href="marchands\byaddo.html" class="product_title">
                            <h4>BYADDO</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 0">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#"></a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-tag"></span>Entreprise</a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small><small>Niger, Niamey</small></small></span>
                            <p>
                                <span class="lnr lnr-users"></span> 8</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart" style="margin-right: 0"></span>
                                <span>28</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product product--card">
                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/identity/9dcae221540edd8cbd6bf0deeb7086ed.png" style="height: 210px" alt="Product Image">
                        <div class="prod_btn">
                            <a href="marchands\miira_s_cakes.html" class="transparent btn--sm btn--round">Mes produits</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: 150px">
                        <a href="marchands\miira_s_cakes.html" class="product_title">
                            <h4>Miira's Cakes</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 0">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#">Hôtels </a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-tag"></span>Entreprise</a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small><small>Niger, Niamey</small></small></span>
                            <p>
                                <span class="lnr lnr-users"></span> 0</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart" style="margin-right: 0"></span>
                                <span>2</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product product--card">
                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/identity/3ff7ba32204e37b448cc7511c5433c7c.png" style="height: 210px" alt="Product Image">
                        <div class="prod_btn">
                            <a href="marchands\ecobank_niger.html" class="transparent btn--sm btn--round">Mes produits</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: 150px">
                        <a href="marchands\ecobank_niger.html" class="product_title">
                            <h4>Ecobank Niger</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 0">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#">Banques et Assurance...</a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-tag"></span>Entreprise</a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small><small>Niger, Niamey</small></small></span>
                            <p>
                                <span class="lnr lnr-users"></span> 57</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart" style="margin-right: 0"></span>
                                <span>0</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product product--card">
                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/identity/a83bb9272fddf172ddc07750ff52bdf6.png" style="height: 210px" alt="Product Image">
                        <div class="prod_btn">
                            <a href="marchands\2pac.html" class="transparent btn--sm btn--round">Mes produits</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: 150px">
                        <a href="marchands\2pac.html" class="product_title">
                            <h4>2PAC</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 0">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#">Informatique et Tele...</a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-tag"></span>Entreprise</a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small><small>Niger, Niamey</small></small></span>
                            <p>
                                <span class="lnr lnr-users"></span> 0</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart" style="margin-right: 0"></span>
                                <span>10</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product product--card">
                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/identity/7c548b475f299d6d9316ab1e9b6b67b1.png" style="height: 210px" alt="Product Image">
                        <div class="prod_btn">
                            <a href="marchands\baby_luxe.html" class="transparent btn--sm btn--round">Mes produits</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: 150px">
                        <a href="marchands\baby_luxe.html" class="product_title">
                            <h4>BABY LUXE</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 0">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#">Vetements, Textiles ...</a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-tag"></span>Entreprise</a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small><small>Niger, Niamey</small></small></span>
                            <p>
                                <span class="lnr lnr-users"></span> 0</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart" style="margin-right: 0"></span>
                                <span>0</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product product--card">
                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/identity/9f01baaf825f1120bcd305e8dd824d01.png" style="height: 210px" alt="Product Image">
                        <div class="prod_btn">
                            <a href="marchands\nouhou_market.html" class="transparent btn--sm btn--round">Mes produits</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: 150px">
                        <a href="marchands\nouhou_market.html" class="product_title">
                            <h4>Nouhou Market</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 0">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#">Alimentation </a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-tag"></span>Entreprise</a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small><small>Niger, Niamey</small></small></span>
                            <p>
                                <span class="lnr lnr-users"></span> 0</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart" style="margin-right: 0"></span>
                                <span>35</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product product--card">
                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/identity/bfec90778637c313efcf5a2c5ffbe0ba.png" style="height: 210px" alt="Product Image">
                        <div class="prod_btn">
                            <a href="error.html" class="transparent btn--sm btn--round">Mes produits</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: 150px">
                        <a href="error.html" class="product_title">
                            <h4>GALAXIE</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 0">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#">Patisserie</a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-tag"></span>Entreprise</a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small><small>Niger, Niamey</small></small></span>
                            <p>
                                <span class="lnr lnr-users"></span> 0</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart" style="margin-right: 0"></span>
                                <span>1</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product product--card">
                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/identity/f990b1a599ec59478cfff570d1ab5c47.png" style="height: 210px" alt="Product Image">
                        <div class="prod_btn">
                            <a href="marchands\foka.html" class="transparent btn--sm btn--round">Mes produits</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: 150px">
                        <a href="marchands\foka.html" class="product_title">
                            <h4>FOKA</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 0">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#">Medical et paramedic...</a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-tag"></span>Entreprise</a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small><small>Niger, Niamey</small></small></span>
                            <p>
                                <span class="lnr lnr-users"></span> 0</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart" style="margin-right: 0"></span>
                                <span>0</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product product--card">
                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/identity/adb224b84dfdfce6490a043541dbf6e6.png" style="height: 210px" alt="Product Image">
                        <div class="prod_btn">
                            <a href="marchands\optique_vision.html" class="transparent btn--sm btn--round">Mes produits</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: 150px">
                        <a href="marchands\optique_vision.html" class="product_title">
                            <h4>Optique vision</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 0">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#">Medical et paramedic...</a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-tag"></span>Entreprise</a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small><small>Niger, Niamey</small></small></span>
                            <p>
                                <span class="lnr lnr-users"></span> 0</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart" style="margin-right: 0"></span>
                                <span>0</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product product--card">
                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/identity/8a2bf78a1c4864ffb8b758aae0bc8980.png" style="height: 210px" alt="Product Image">
                        <div class="prod_btn">
                            <a href="marchands\ideal_optique.html" class="transparent btn--sm btn--round">Mes produits</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: 150px">
                        <a href="marchands\ideal_optique.html" class="product_title">
                            <h4>IDEAL OPTIQUE</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 0">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#"></a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-tag"></span>Entreprise</a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small><small>Niger, Niamey</small></small></span>
                            <p>
                                <span class="lnr lnr-users"></span> 0</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart" style="margin-right: 0"></span>
                                <span>0</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product product--card">
                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/identity/720287f68d6a3de60672bf1f66f3838e.png" style="height: 210px" alt="Product Image">
                        <div class="prod_btn">
                            <a href="marchands\jmg_international.html" class="transparent btn--sm btn--round">Mes produits</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: 150px">
                        <a href="marchands\jmg_international.html" class="product_title">
                            <h4>JMG INTERNATIONAL</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 0">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#"></a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-tag"></span>Entreprise</a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small><small>Niger, Niamey</small></small></span>
                            <p>
                                <span class="lnr lnr-users"></span> 0</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart" style="margin-right: 0"></span>
                                <span>0</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product product--card">
                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/identity/e6af2bc8982139fbf3037e10b6c4ff0d.png" style="height: 210px" alt="Product Image">
                        <div class="prod_btn">
                            <a href="marchands\boite_a_k_do.html" class="transparent btn--sm btn--round">Mes produits</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: 150px">
                        <a href="marchands\boite_a_k_do.html" class="product_title">
                            <h4>Boite à k'do</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 0">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#">Sociétés de servic...</a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-tag"></span>Entreprise</a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small><small>Niger, Niamey</small></small></span>
                            <p>
                                <span class="lnr lnr-users"></span> 0</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart" style="margin-right: 0"></span>
                                <span>9</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product product--card">
                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/identity/d4d1c0d52bb1f9ee3e52e4ea6221c9aa.png" style="height: 210px" alt="Product Image">
                        <div class="prod_btn">
                            <a href="marchands\shop_in_shop_ola_energy_boukoki.html" class="transparent btn--sm btn--round">Mes produits</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: 150px">
                        <a href="marchands\shop_in_shop_ola_energy_boukoki.html" class="product_title">
                            <h4>Canal Horizon (Shop in sh...</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 0">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#">Sociétés de servic...</a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-tag"></span>Entreprise</a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small><small>Niger, Niamey</small></small></span>
                            <p>
                                <span class="lnr lnr-users"></span> 0</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart" style="margin-right: 0"></span>
                                <span>0</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product product--card">
                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/identity/418d749dfaa9bcd3f64bf3408960f40b.png" style="height: 210px" alt="Product Image">
                        <div class="prod_btn">
                            <a href="marchands\shop_in_shop_ola_energy_rive_droite.html" class="transparent btn--sm btn--round">Mes produits</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: 150px">
                        <a href="marchands\shop_in_shop_ola_energy_rive_droite.html" class="product_title">
                            <h4>Canal Horizon-(shop in sh...</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 0">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#">Sociétés de servic...</a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-tag"></span>Entreprise</a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small><small>Niger, Niamey</small></small></span>
                            <p>
                                <span class="lnr lnr-users"></span> 0</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart" style="margin-right: 0"></span>
                                <span>0</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product product--card">
                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/identity/7972476772f23812a2edc5d0b48a8440.png" style="height: 210px" alt="Product Image">
                        <div class="prod_btn">
                            <a href="marchands\canal_horizon.html" class="transparent btn--sm btn--round">Mes produits</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: 150px">
                        <a href="marchands\canal_horizon.html" class="product_title">
                            <h4>Canal Horizon-Direction G...</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 0">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#">Sociétés de servic...</a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-tag"></span>Entreprise</a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small><small>Niger, Niamey</small></small></span>
                            <p>
                                <span class="lnr lnr-users"></span> 0</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart" style="margin-right: 0"></span>
                                <span>0</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product product--card">
                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/identity/4d41365e77a6ed13f8ee18b85ab0d72c.png" style="height: 210px" alt="Product Image">
                        <div class="prod_btn">
                            <a href="marchands\store_du_plateau.html" class="transparent btn--sm btn--round">Mes produits</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: 150px">
                        <a href="marchands\store_du_plateau.html" class="product_title">
                            <h4>Canal Horizon-Plateau</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 0">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#">Sociétés de servic...</a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-tag"></span>Entreprise</a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small><small>Niger, Niamey</small></small></span>
                            <p>
                                <span class="lnr lnr-users"></span> 0</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart" style="margin-right: 0"></span>
                                <span>0</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product product--card">
                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/identity/93ea09054189ee9f0ab103b5e1b4d603.png" style="height: 210px" alt="Product Image">
                        <div class="prod_btn">
                            <a href="marchands\boutique_bobiel.html" class="transparent btn--sm btn--round">Mes produits</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: 150px">
                        <a href="marchands\boutique_bobiel.html" class="product_title">
                            <h4>Canal Horizon-Shop Bobiel</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 0">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#">Sociétés de servic...</a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-tag"></span>Entreprise</a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small><small>Niger, Niamey</small></small></span>
                            <p>
                                <span class="lnr lnr-users"></span> 0</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart" style="margin-right: 0"></span>
                                <span>0</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product product--card">
                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/identity/38f97856d53b5489bd76b3d5dd834db6.png" style="height: 210px" alt="Product Image">
                        <div class="prod_btn">
                            <a href="marchands\store_du_siege.html" class="transparent btn--sm btn--round">Mes produits</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: 150px">
                        <a href="marchands\store_du_siege.html" class="product_title">
                            <h4>Canal Horizon-Siége</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 0">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#">Sociétés de servic...</a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-tag"></span>Entreprise</a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small><small>Niger, Niamey</small></small></span>
                            <p>
                                <span class="lnr lnr-users"></span> 0</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart" style="margin-right: 0"></span>
                                <span>0</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product product--card">
                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/identity/c4a5e7561d58407bd246ac3389a0d1a9.png" style="height: 210px" alt="Product Image">
                        <div class="prod_btn">
                            <a href="marchands\fruitizz_niamey.html" class="transparent btn--sm btn--round">Mes produits</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: 150px">
                        <a href="marchands\fruitizz_niamey.html" class="product_title">
                            <h4>Fruitizz Niamey</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 0">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#">Restaurant</a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-tag"></span>Entreprise</a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small><small>Niger, Niamey</small></small></span>
                            <p>
                                <span class="lnr lnr-users"></span> 0</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart" style="margin-right: 0"></span>
                                <span>10</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="pagination-area"><nav class="navigation pagination" role="navigation"><div class="nav-links"><a class="prev page-numbers" class='disabled'><span class="lnr lnr-arrow-left"></span></a><a class='page-numbers current'>1</a><a href='marchands-12.html?page=2' class='page-numbers'>2</a><a class="next page-numbers" href='marchands-12.html?page=2'><span class="lnr lnr-arrow-right"></span></a></div></nav></div>            </div>
        </div>
    </div>
</section>

<section class="call-to-action bgimage">
    <div class="bg_image_holder">
        <img src="Public\assets\images\calltobg.jpg" alt="">
    </div>
    <div class="container content_above">
        <div class="row">
            <div class="col-md-12">
                <div class="call-to-wrap">
                    <h1 class="text--white">Prêts à intégrer la communauté Brancos!</h1>
                    <h4 class="text--white">Plus de 1 419 clients et marchands font confiance à Brancos.</h4>
                    <a href="login.html" class="btn btn--lg btn--round btn--white callto-action-btn">Rejoindre maintenant</a>
                </div>
            </div>
        </div>
    </div>
</section>



</body>



