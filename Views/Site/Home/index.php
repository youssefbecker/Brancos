<?php

use Projet\Model\DateParser;
use Projet\Model\FileHelper;
use Projet\Model\StringHelper;
use Projet\Model\App;
use Projet\Database\Image;
App::addScript("js/email.js", true);

?>
<section class="hero-area bgimage">

    <div class="hero-content content_above">
        <div class="content-wrapper">
            <ul id="slider3">
                <li><a><img src="<?= FileHelper::url('assets/images/banner.jpg'); ?>" alt=""></a></li>
                <li><a><img src="<?= FileHelper::url('assets/images/banners.jpg'); ?>" alt=""></a></li>
                <li><a><img src="<?= FileHelper::url('assets/images/banner.jpg'); ?>" alt=""></a></li>
                <li><a><img src="<?= FileHelper::url('assets/images/banners.jpg'); ?>" alt=""></a></li>
            </ul>
        </div>
    </div>
    <div class="search-area forPhone">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="search_box">
                        <form action="" method='get'>
                            <input type="text" class="text_field" name="q" placeholder="Chercher des produits...">
                            <div class="search__select select-wrap">
                                <select name="category" class="select--field" id="blah">
                                    <option value="">Toutes catégories</option>
                                </select>
                                <span class="lnr lnr-chevron-down"></span>
                            </div>
                            <button type="submit" class="search-btn btn--lg">Chercher</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="followers-feed section--padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-title-area">
                    <div class="product__title">
                        <h2>Deals du jour</h2>
                    </div>

                    <div class="product__slider-nav follow_feed_nav rounded">
                        <span class="lnr lnr-chevron-left nav_left"></span>
                        <span class="lnr lnr-chevron-right nav_right"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="product_slider">

                    <div class="product product--card">
                        <?php
                        if (isset($articles)) {
                            $i=0;
                            foreach ($articles as $article) {
                                $i++;
                                ?>
                                <div class="product__thumbnail">
                                    <img src="<?= FileHelper::url(Image::searchType(null,null,$article->productid)[0]->path)?>" style="height:210px" alt="Product Image">
                                    <span class="forfait"><small>XOF</small><?=$article->price?><i class="fa fa-arrow-down text-warning"></i></span>
                                    <div class="prod_btn">
                                        <a href="culture-et-divertissement\divertissement\jouets\pistolet_laser.html" class="transparent btn--sm btn--round mb-2">Plus d'infos</a>
                                        <a class="transparent btn--sm btn--round addCart" data-id="51" href="#"><i class="lnr lnr-cart"></i> Ajouter au panier</a>
                                    </div>
                                </div>
                                <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px;">
                                    <a href="culture-et-divertissement\divertissement\jouets\pistolet_laser.html" class="product_title" title="Pistolet laser">
                                        <h4 class="ellipsis"><?=$article->productname?></h4>
                                    </a>
                                    <ul class="titlebtm" style="padding-bottom: 10px">
                                        <li>
                                            <p><img class="auth-img" src="" alt="author image">
                                                <a href="#" title="ORCA DECO">ORCA DECO</a>
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product-purchase">
                                    <div class="price_love">
                                        <span><small>XOF</small><?=$article->price?></span>
                                        <p><a href="#" class="addList" data-id="51"><span class="lnr lnr-heart"></span> 0</a></p>
                                    </div>
                                    <div class="md-list-content">
                                        <span class=" text-danger <?= "refLiked".$article->id?>"><?= number_format($article->liked,0,',',' '); ?></span>
                                        <button style="text-decoration: none; border: 0;background-color: #fff;padding: 0" ><i class="text-danger  fa <?= $isLiked ?> liked <?= "iconlike".$article->id?>" data-id="<?= $article->id?>"></i>&nbsp;</button>
                                        <span class="text-default fa fa-comments"></span>&nbsp;
                                        <span class="text-success  <?= "refVue".$article->id ?>"><?=$article->vues?></span>
                                        <span  class="text-success fa fa-eye"></span>
                                    </div>
                                </div>

                            <?php } }?>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="products section--padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-title-area">
                    <div class="product__title">
                        <h2>Nouveaux produits</h2>
                    </div>

                    <div class="filter__menu">
                        <p></p>
                        <div class="filter__menu_icon">
                            <a href="#" id="drop1" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="svg" src="Public\assets\images\svg\menu.svg" alt="menu icon">
                            </a>

                            <ul class="filter_dropdown dropdown-menu" aria-labelledby="drop1">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="product product--card">

                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/articles/407_7a5bfa3bbfc588ab5803f6c92c3f6925.jpg" style="height:210px" alt="Product Image">

                        <div class="prod_btn">
                            <a href="alimentation-et-commerces-generaux\commerce-general\patisserie\panier_ramadan.html" class="transparent btn--sm btn--round mb-2">Plus d'infos</a>
                            <a class="transparent btn--sm btn--round addCart" data-id="407" href="#"><i class="lnr lnr-cart"></i> Ajouter au panier</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px;">
                        <a href="alimentation-et-commerces-generaux\commerce-general\patisserie\panier_ramadan.html" class="product_title" title="Panier Ramadan">
                            <h4 class="ellipsis">Panier Ramadan</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 10px">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#" title="Boite à k'do">Boite à k'do</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small>XOF</small> 15 000</span>
                            <p><a href="#" class="addList" data-id="407"><span class="lnr lnr-heart"></span> 0</a></p>
                        </div>
                        <div class="sell" style="margin-top: 2px">
                            <p>
                                <span class="fa fa-eye" style="margin-right: 0"></span>
                                <span>90</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div><div class="col-lg-3 col-md-4">
                <div class="product product--card">

                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/articles/405_9a9be891c1b3a391bc2cde1a0da7054c.jpg" style="height:210px" alt="Product Image">

                        <div class="prod_btn">
                            <a href="bien-etre-et-paramedical\paramedical\appareils\lampadaire_en_promotion.html" class="transparent btn--sm btn--round mb-2">Plus d'infos</a>
                            <a class="transparent btn--sm btn--round addCart" data-id="405" href="#"><i class="lnr lnr-cart"></i> Ajouter au panier</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px;">
                        <a href="bien-etre-et-paramedical\paramedical\appareils\lampadaire_en_promotion.html" class="product_title" title="Lampadaire en Promotion">
                            <h4 class="ellipsis">Lampadaire en Promotion</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 10px">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#" title="Ets SALEY & FILS">Ets SALEY & FILS</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small>XOF</small> 40 000</span>
                            <p><a href="#" class="addList" data-id="405"><span class="lnr lnr-heart"></span> 0</a></p>
                        </div>
                        <div class="sell" style="margin-top: 2px">
                            <p>
                                <span class="fa fa-eye" style="margin-right: 0"></span>
                                <span>122</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div><div class="col-lg-3 col-md-4">
                <div class="product product--card">

                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/articles/404_f7e3a4777c33b8658d644b7acdc6ca4c.jpg" style="height:210px" alt="Product Image">

                        <div class="prod_btn">
                            <a href="bien-etre-et-paramedical\paramedical\appareils\regulateurs_et_ampoule_en_promotion.html" class="transparent btn--sm btn--round mb-2">Plus d'infos</a>
                            <a class="transparent btn--sm btn--round addCart" data-id="404" href="#"><i class="lnr lnr-cart"></i> Ajouter au panier</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px;">
                        <a href="bien-etre-et-paramedical\paramedical\appareils\regulateurs_et_ampoule_en_promotion.html" class="product_title" title="Regulateurs et ampoule en promotion">
                            <h4 class="ellipsis">Regulateurs et ampoule en prom...</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 10px">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#" title="Ets SALEY & FILS">Ets SALEY & FILS</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small>XOF</small> 250 000</span>
                            <p><a href="#" class="addList" data-id="404"><span class="lnr lnr-heart"></span> 0</a></p>
                        </div>
                        <div class="sell" style="margin-top: 2px">
                            <p>
                                <span class="fa fa-eye" style="margin-right: 0"></span>
                                <span>128</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div><div class="col-lg-3 col-md-4">
                <div class="product product--card">

                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/articles/403_65e59808085202aa371f2a422708f3f3.jpg" style="height:210px" alt="Product Image">

                        <div class="prod_btn">
                            <a href="bien-etre-et-paramedical\paramedical\appareils\promotion_nexus.html" class="transparent btn--sm btn--round mb-2">Plus d'infos</a>
                            <a class="transparent btn--sm btn--round addCart" data-id="403" href="#"><i class="lnr lnr-cart"></i> Ajouter au panier</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px;">
                        <a href="bien-etre-et-paramedical\paramedical\appareils\promotion_nexus.html" class="product_title" title="Promotion Nexus ">
                            <h4 class="ellipsis">Promotion Nexus </h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 10px">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#" title="Ets SALEY & FILS">Ets SALEY & FILS</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small>XOF</small> 140 000</span>
                            <p><a href="#" class="addList" data-id="403"><span class="lnr lnr-heart"></span> 0</a></p>
                        </div>
                        <div class="sell" style="margin-top: 2px">
                            <p>
                                <span class="fa fa-eye" style="margin-right: 0"></span>
                                <span>131</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div><div class="col-lg-3 col-md-4">
                <div class="product product--card">

                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/articles/402_a3c8fa13fac46fb14f17507382a63d2b.jpg" style="height:210px" alt="Product Image">

                        <div class="prod_btn">
                            <a href="bien-etre-et-paramedical\paramedical\appareils\promo_cuisiniere.html" class="transparent btn--sm btn--round mb-2">Plus d'infos</a>
                            <a class="transparent btn--sm btn--round addCart" data-id="402" href="#"><i class="lnr lnr-cart"></i> Ajouter au panier</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px;">
                        <a href="bien-etre-et-paramedical\paramedical\appareils\promo_cuisiniere.html" class="product_title" title="Promo Cuisinière ">
                            <h4 class="ellipsis">Promo Cuisinière </h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 10px">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#" title="Ets SALEY & FILS">Ets SALEY & FILS</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small>XOF</small> 150 000</span>
                            <p><a href="#" class="addList" data-id="402"><span class="lnr lnr-heart"></span> 0</a></p>
                        </div>
                        <div class="sell" style="margin-top: 2px">
                            <p>
                                <span class="fa fa-eye" style="margin-right: 0"></span>
                                <span>134</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div><div class="col-lg-3 col-md-4">
                <div class="product product--card">

                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/articles/400_6d789f4cde59c1c745cd16c9eb02da04.jpg" style="height:210px" alt="Product Image">

                        <div class="prod_btn">
                            <a href="bien-etre-et-paramedical\paramedical\appareils\promotion_cuisiniere.html" class="transparent btn--sm btn--round mb-2">Plus d'infos</a>
                            <a class="transparent btn--sm btn--round addCart" data-id="400" href="#"><i class="lnr lnr-cart"></i> Ajouter au panier</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px;">
                        <a href="bien-etre-et-paramedical\paramedical\appareils\promotion_cuisiniere.html" class="product_title" title="Promotion Cuisinière ">
                            <h4 class="ellipsis">Promotion Cuisinière </h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 10px">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#" title="Ets SALEY & FILS">Ets SALEY & FILS</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small>XOF</small> 19 000</span>
                            <p><a href="#" class="addList" data-id="400"><span class="lnr lnr-heart"></span> 1</a></p>
                        </div>
                        <div class="sell" style="margin-top: 2px">
                            <p>
                                <span class="fa fa-eye" style="margin-right: 0"></span>
                                <span>221</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div><div class="col-lg-3 col-md-4">
                <div class="product product--card">

                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/articles/396_a07b5797c4e88e9517b1e83d47dac09e.jpg" style="height:210px" alt="Product Image">

                        <div class="prod_btn">
                            <a href="vetements-textiles-et-accessoires\vetements\hommes\montre_blanc_argentee.html" class="transparent btn--sm btn--round mb-2">Plus d'infos</a>
                            <a class="transparent btn--sm btn--round addCart" data-id="396" href="#"><i class="lnr lnr-cart"></i> Ajouter au panier</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px;">
                        <a href="vetements-textiles-et-accessoires\vetements\hommes\montre_blanc_argentee.html" class="product_title" title="Montre Blanche/Argentée">
                            <h4 class="ellipsis">Montre Blanche/Argentée</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 10px">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#" title="TOUT POUR LA FEMME & L'ENFANT">TOUT POUR LA FEMME...</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small>XOF</small> 20 000</span>
                            <p><a href="#" class="addList" data-id="396"><span class="lnr lnr-heart"></span> 0</a></p>
                        </div>
                        <div class="sell" style="margin-top: 2px">
                            <p>
                                <span class="fa fa-eye" style="margin-right: 0"></span>
                                <span>93</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div><div class="col-lg-3 col-md-4">
                <div class="product product--card">

                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/articles/395_f0ff751b43818d8322b8b6dbd6bffbfd.jpg" style="height:210px" alt="Product Image">

                        <div class="prod_btn">
                            <a href="vetements-textiles-et-accessoires\vetements\hommes\montre_noir__argentee.html" class="transparent btn--sm btn--round mb-2">Plus d'infos</a>
                            <a class="transparent btn--sm btn--round addCart" data-id="395" href="#"><i class="lnr lnr-cart"></i> Ajouter au panier</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px;">
                        <a href="vetements-textiles-et-accessoires\vetements\hommes\montre_noir__argentee.html" class="product_title" title="Montre Noir /Argentée">
                            <h4 class="ellipsis">Montre Noir /Argentée</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 10px">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#" title="TOUT POUR LA FEMME & L'ENFANT">TOUT POUR LA FEMME...</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small>XOF</small> 20 000</span>
                            <p><a href="#" class="addList" data-id="395"><span class="lnr lnr-heart"></span> 0</a></p>
                        </div>
                        <div class="sell" style="margin-top: 2px">
                            <p>
                                <span class="fa fa-eye" style="margin-right: 0"></span>
                                <span>122</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div><div class="col-lg-3 col-md-4">
                <div class="product product--card">

                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/articles/394_744ca3b7d8559841bf40c91ddbb1e0a5.jpg" style="height:210px" alt="Product Image">

                        <div class="prod_btn">
                            <a href="vetements-textiles-et-accessoires\vetements\femmes\deux_piece.html" class="transparent btn--sm btn--round mb-2">Plus d'infos</a>
                            <a class="transparent btn--sm btn--round addCart" data-id="394" href="#"><i class="lnr lnr-cart"></i> Ajouter au panier</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px;">
                        <a href="vetements-textiles-et-accessoires\vetements\femmes\deux_piece.html" class="product_title" title="Deux pièce">
                            <h4 class="ellipsis">Deux pièce</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 10px">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#" title="TOUT POUR LA FEMME & L'ENFANT">TOUT POUR LA FEMME...</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small>XOF</small> 5 000</span>
                            <p><a href="#" class="addList" data-id="394"><span class="lnr lnr-heart"></span> 0</a></p>
                        </div>
                        <div class="sell" style="margin-top: 2px">
                            <p>
                                <span class="fa fa-eye" style="margin-right: 0"></span>
                                <span>97</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div><div class="col-lg-3 col-md-4">
                <div class="product product--card">

                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/articles/393_a98ec3ac2138f17b0b73041fbfa417e7.jpg" style="height:210px" alt="Product Image">

                        <div class="prod_btn">
                            <a href="vetements-textiles-et-accessoires\vetements\femmes\ensemble_bijou.html" class="transparent btn--sm btn--round mb-2">Plus d'infos</a>
                            <a class="transparent btn--sm btn--round addCart" data-id="393" href="#"><i class="lnr lnr-cart"></i> Ajouter au panier</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px;">
                        <a href="vetements-textiles-et-accessoires\vetements\femmes\ensemble_bijou.html" class="product_title" title="Ensemble Bijou">
                            <h4 class="ellipsis">Ensemble Bijou</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 10px">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#" title="TOUT POUR LA FEMME & L'ENFANT">TOUT POUR LA FEMME...</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small>XOF</small> 35 000</span>
                            <p><a href="#" class="addList" data-id="393"><span class="lnr lnr-heart"></span> 0</a></p>
                        </div>
                        <div class="sell" style="margin-top: 2px">
                            <p>
                                <span class="fa fa-eye" style="margin-right: 0"></span>
                                <span>89</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div><div class="col-lg-3 col-md-4">
                <div class="product product--card">

                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/articles/392_37db34909dc215db209cc6a36d2e9c78.jpg" style="height:210px" alt="Product Image">

                        <div class="prod_btn">
                            <a href="vetements-textiles-et-accessoires\vetements\enfants\robes_pour_enfant.html" class="transparent btn--sm btn--round mb-2">Plus d'infos</a>
                            <a class="transparent btn--sm btn--round addCart" data-id="392" href="#"><i class="lnr lnr-cart"></i> Ajouter au panier</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px;">
                        <a href="vetements-textiles-et-accessoires\vetements\enfants\robes_pour_enfant.html" class="product_title" title="Robes pour enfant">
                            <h4 class="ellipsis">Robes pour enfant</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 10px">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#" title="TOUT POUR LA FEMME & L'ENFANT">TOUT POUR LA FEMME...</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small>XOF</small> 15 000</span>
                            <p><a href="#" class="addList" data-id="392"><span class="lnr lnr-heart"></span> 0</a></p>
                        </div>
                        <div class="sell" style="margin-top: 2px">
                            <p>
                                <span class="fa fa-eye" style="margin-right: 0"></span>
                                <span>106</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div><div class="col-lg-3 col-md-4">
                <div class="product product--card">

                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/articles/391_cf6a56687de6e7f19983652ca4132d6c.jpg" style="height:210px" alt="Product Image">

                        <div class="prod_btn">
                            <a href="vetements-textiles-et-accessoires\vetements\enfants\chemise_pour_les_enfants.html" class="transparent btn--sm btn--round mb-2">Plus d'infos</a>
                            <a class="transparent btn--sm btn--round addCart" data-id="391" href="#"><i class="lnr lnr-cart"></i> Ajouter au panier</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px;">
                        <a href="vetements-textiles-et-accessoires\vetements\enfants\chemise_pour_les_enfants.html" class="product_title" title="Chemise pour Les enfants">
                            <h4 class="ellipsis">Chemise pour Les enfants</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 10px">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#" title="TOUT POUR LA FEMME & L'ENFANT">TOUT POUR LA FEMME...</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small>XOF</small> 10 000</span>
                            <p><a href="#" class="addList" data-id="391"><span class="lnr lnr-heart"></span> 0</a></p>
                        </div>
                        <div class="sell" style="margin-top: 2px">
                            <p>
                                <span class="fa fa-eye" style="margin-right: 0"></span>
                                <span>88</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div><div class="col-lg-3 col-md-4">
                <div class="product product--card">

                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/articles/378_94252dfcfa5bb078a5366ac3e3790709.jpg" style="height:210px" alt="Product Image">

                        <div class="prod_btn">
                            <a href="bien-etre-et-paramedical\paramedical\appareils\cuisiniere.html" class="transparent btn--sm btn--round mb-2">Plus d'infos</a>
                            <a class="transparent btn--sm btn--round addCart" data-id="378" href="#"><i class="lnr lnr-cart"></i> Ajouter au panier</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px;">
                        <a href="bien-etre-et-paramedical\paramedical\appareils\cuisiniere.html" class="product_title" title="Cuisinière ">
                            <h4 class="ellipsis">Cuisinière </h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 10px">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#" title="Ets SALEY & FILS">Ets SALEY & FILS</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small>XOF</small> 18 000</span>
                            <p><a href="#" class="addList" data-id="378"><span class="lnr lnr-heart"></span> 0</a></p>
                        </div>
                        <div class="sell" style="margin-top: 2px">
                            <p>
                                <span class="fa fa-eye" style="margin-right: 0"></span>
                                <span>133</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div><div class="col-lg-3 col-md-4">
                <div class="product product--card">

                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/articles/377_237209fe884c45bc0892dde5d437b7fa.jpg" style="height:210px" alt="Product Image">

                        <div class="prod_btn">
                            <a href="bien-etre-et-paramedical\paramedical\appareils\climatiseur_sharp.html" class="transparent btn--sm btn--round mb-2">Plus d'infos</a>
                            <a class="transparent btn--sm btn--round addCart" data-id="377" href="#"><i class="lnr lnr-cart"></i> Ajouter au panier</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px;">
                        <a href="bien-etre-et-paramedical\paramedical\appareils\climatiseur_sharp.html" class="product_title" title="Climatiseur Sharp">
                            <h4 class="ellipsis">Climatiseur Sharp</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 10px">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#" title="Ets SALEY & FILS">Ets SALEY & FILS</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small>XOF</small> 300 000</span>
                            <p><a href="#" class="addList" data-id="377"><span class="lnr lnr-heart"></span> 0</a></p>
                        </div>
                        <div class="sell" style="margin-top: 2px">
                            <p>
                                <span class="fa fa-eye" style="margin-right: 0"></span>
                                <span>212</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div><div class="col-lg-3 col-md-4">
                <div class="product product--card">

                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/articles/376_79f326895d1691fe75599dfbc8d673fe.jpg" style="height:210px" alt="Product Image">

                        <div class="prod_btn">
                            <a href="bien-etre-et-paramedical\paramedical\appareils\climatiseur_chico.html" class="transparent btn--sm btn--round mb-2">Plus d'infos</a>
                            <a class="transparent btn--sm btn--round addCart" data-id="376" href="#"><i class="lnr lnr-cart"></i> Ajouter au panier</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px;">
                        <a href="bien-etre-et-paramedical\paramedical\appareils\climatiseur_chico.html" class="product_title" title="Climatiseur Chico">
                            <h4 class="ellipsis">Climatiseur Chico</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 10px">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#" title="Ets SALEY & FILS">Ets SALEY & FILS</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small>XOF</small> 35 000</span>
                            <p><a href="#" class="addList" data-id="376"><span class="lnr lnr-heart"></span> 0</a></p>
                        </div>
                        <div class="sell" style="margin-top: 2px">
                            <p>
                                <span class="fa fa-eye" style="margin-right: 0"></span>
                                <span>116</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div><div class="col-lg-3 col-md-4">
                <div class="product product--card">

                    <div class="product__thumbnail">
                        <img src="https://backend.afrikfid.boutique/Public/articles/375_62a83cb75d97e61646d1b72096007ab8.jpg" style="height:210px" alt="Product Image">

                        <div class="prod_btn">
                            <a href="bien-etre-et-paramedical\paramedical\appareils\solaire_150_w.html" class="transparent btn--sm btn--round mb-2">Plus d'infos</a>
                            <a class="transparent btn--sm btn--round addCart" data-id="375" href="#"><i class="lnr lnr-cart"></i> Ajouter au panier</a>
                        </div>
                    </div>
                    <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px;">
                        <a href="bien-etre-et-paramedical\paramedical\appareils\solaire_150_w.html" class="product_title" title="Solaire 150 W">
                            <h4 class="ellipsis">Solaire 150 W</h4>
                        </a>
                        <ul class="titlebtm" style="padding-bottom: 10px">
                            <li>
                                <p><img class="auth-img" src="Public\assets\images\auth3.jpg" alt="author image">
                                    <a href="#" title="Ets SALEY & FILS">Ets SALEY & FILS</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="product-purchase">
                        <div class="price_love">
                            <span><small>XOF</small> 55 000</span>
                            <p><a href="#" class="addList" data-id="375"><span class="lnr lnr-heart"></span> 0</a></p>
                        </div>
                        <div class="sell" style="margin-top: 2px">
                            <p>
                                <span class="fa fa-eye" style="margin-right: 0"></span>
                                <span>77</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="more-product">
                    <a href="search.html" class="btn btn--lg btn--round">Voir tous les produits</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="followers-feed section--padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-title-area">
                    <div class="product__title">
                        <h2>Nos Marchands recommandés</h2>
                    </div>

                    <div class="product__slider-nav follow_feed_nav rounded">
                        <span class="lnr lnr-chevron-left nav_left"></span>
                        <span class="lnr lnr-chevron-right nav_right"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="product_slider">

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/55179c96a66fc9b49f8fb0ec5abe1884.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\taamunice.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\taamunice.html" class="product_title mb-0">
                                <h4 class="ellipsis">TAAMUNICE</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/2d4f2925d2c4c7b6c399ca02779db91c.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\ets_saley_et_fils.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\ets_saley_et_fils.html" class="product_title mb-0">
                                <h4 class="ellipsis">Ets SALEY & FILS</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/43594b401bc7c8abcc87adb435f53cb6.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\glam_et_chic.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\glam_et_chic.html" class="product_title mb-0">
                                <h4 class="ellipsis">GLAM ET CHIC</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
                                <p>
                                    <span class="lnr lnr-users"></span> 2</p>
                            </div>
                            <div class="sell">
                                <p>
                                    <span class="lnr lnr-cart" style="margin-right: 0"></span>
                                    <span>11</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/fff959f7a0643cc32bef8e26fbb04b90.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\bangno-beibo-omar.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\bangno-beibo-omar.html" class="product_title mb-0">
                                <h4 class="ellipsis">Alyzé</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/assets/images/fournisseur.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\b-nation.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\b-nation.html" class="product_title mb-0">
                                <h4 class="ellipsis">B-NATION</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
                                <p>
                                    <span class="lnr lnr-users"></span> 1</p>
                            </div>
                            <div class="sell">
                                <p>
                                    <span class="lnr lnr-cart" style="margin-right: 0"></span>
                                    <span>0</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/assets/images/fournisseur.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\aissatou.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\aissatou.html" class="product_title mb-0">
                                <h4 class="ellipsis">Aissatou</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/3bed070c6a7af17732886958ae53ed1e.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\orca_deco.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\orca_deco.html" class="product_title mb-0">
                                <h4 class="ellipsis">ORCA DECO</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/7b9e6d217782eed6a4a14745a72fcbd9.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\byaddo.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\byaddo.html" class="product_title mb-0">
                                <h4 class="ellipsis">BYADDO</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/9dcae221540edd8cbd6bf0deeb7086ed.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\miira_s_cakes.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\miira_s_cakes.html" class="product_title mb-0">
                                <h4 class="ellipsis">Miira's Cakes</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/3ff7ba32204e37b448cc7511c5433c7c.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\ecobank_niger.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\ecobank_niger.html" class="product_title mb-0">
                                <h4 class="ellipsis">Ecobank Niger</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/a83bb9272fddf172ddc07750ff52bdf6.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\2pac.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\2pac.html" class="product_title mb-0">
                                <h4 class="ellipsis">2PAC</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/assets/images/fournisseur.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\mamadou-traore-joseph.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\mamadou-traore-joseph.html" class="product_title mb-0">
                                <h4 class="ellipsis">Mamadou Traoré Joseph</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/8d26cd81b83e44f01dd22265d47ef932.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="error.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="error.html" class="product_title mb-0">
                                <h4 class="ellipsis">ETs KARMA MOBILE</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/568e2dc516a6efab90d6af29a6bfa354.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\turquoise.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\turquoise.html" class="product_title mb-0">
                                <h4 class="ellipsis">TURQUOISE</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/7c548b475f299d6d9316ab1e9b6b67b1.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\baby_luxe.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\baby_luxe.html" class="product_title mb-0">
                                <h4 class="ellipsis">BABY LUXE</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/9f01baaf825f1120bcd305e8dd824d01.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\nouhou_market.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\nouhou_market.html" class="product_title mb-0">
                                <h4 class="ellipsis">Nouhou Market</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/bfec90778637c313efcf5a2c5ffbe0ba.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="error.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="error.html" class="product_title mb-0">
                                <h4 class="ellipsis">GALAXIE</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/f990b1a599ec59478cfff570d1ab5c47.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\foka.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\foka.html" class="product_title mb-0">
                                <h4 class="ellipsis">FOKA</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/90026ec9fe4d320e37de213fee69d96d.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\la_maison_du_livre.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\la_maison_du_livre.html" class="product_title mb-0">
                                <h4 class="ellipsis">LA MAISON DU LIVRE</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/adb224b84dfdfce6490a043541dbf6e6.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\optique_vision.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\optique_vision.html" class="product_title mb-0">
                                <h4 class="ellipsis">Optique vision</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/edbf94bf54ab9e6748fab204b836c448.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\style_shop.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\style_shop.html" class="product_title mb-0">
                                <h4 class="ellipsis">STYLE SHOP</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/fb1bc51f22a1b967da8f1637d4900c8e.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\joch.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\joch.html" class="product_title mb-0">
                                <h4 class="ellipsis">JOCH</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/8a2bf78a1c4864ffb8b758aae0bc8980.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\ideal_optique.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\ideal_optique.html" class="product_title mb-0">
                                <h4 class="ellipsis">IDEAL OPTIQUE</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/12f10626c5691c9e0bfd63cdb0318e63.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="error.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="error.html" class="product_title mb-0">
                                <h4 class="ellipsis">CONDE MEDICAL KITS</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/720287f68d6a3de60672bf1f66f3838e.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\jmg_international.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\jmg_international.html" class="product_title mb-0">
                                <h4 class="ellipsis">JMG INTERNATIONAL</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/assets/images/fournisseur.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\arizona-sofa.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\arizona-sofa.html" class="product_title mb-0">
                                <h4 class="ellipsis">ARIZONA SOFA</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Littoral</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/e6af2bc8982139fbf3037e10b6c4ff0d.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\boite_a_k_do.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\boite_a_k_do.html" class="product_title mb-0">
                                <h4 class="ellipsis">Boite à k'do</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/d4d1c0d52bb1f9ee3e52e4ea6221c9aa.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\shop_in_shop_ola_energy_boukoki.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\shop_in_shop_ola_energy_boukoki.html" class="product_title mb-0">
                                <h4 class="ellipsis">Canal Horizon (Shop in shop) -  OLA ENERGY BOUKOKI</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/418d749dfaa9bcd3f64bf3408960f40b.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\shop_in_shop_ola_energy_rive_droite.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\shop_in_shop_ola_energy_rive_droite.html" class="product_title mb-0">
                                <h4 class="ellipsis">Canal Horizon-(shop in shop) OLA ENERGY RIVE DROITE</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/7972476772f23812a2edc5d0b48a8440.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\canal_horizon.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\canal_horizon.html" class="product_title mb-0">
                                <h4 class="ellipsis">Canal Horizon-Direction Generale</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/4d41365e77a6ed13f8ee18b85ab0d72c.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\store_du_plateau.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\store_du_plateau.html" class="product_title mb-0">
                                <h4 class="ellipsis">Canal Horizon-Plateau</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/93ea09054189ee9f0ab103b5e1b4d603.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\boutique_bobiel.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\boutique_bobiel.html" class="product_title mb-0">
                                <h4 class="ellipsis">Canal Horizon-Shop Bobiel</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/38f97856d53b5489bd76b3d5dd834db6.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\store_du_siege.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\store_du_siege.html" class="product_title mb-0">
                                <h4 class="ellipsis">Canal Horizon-Siége</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/2f36784b26b762710270e85083fedc10.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\blue_zone_cinema.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\blue_zone_cinema.html" class="product_title mb-0">
                                <h4 class="ellipsis">Canal Olympia Niamey</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/f6eff39af34b5e555fda3945bc8759c3.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\ccfn.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\ccfn.html" class="product_title mb-0">
                                <h4 class="ellipsis">CCFN</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/assets/images/fournisseur.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="error.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="error.html" class="product_title mb-0">
                                <h4 class="ellipsis">Comer Consulting</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/assets/images/fournisseur.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\cour_des_grand.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\cour_des_grand.html" class="product_title mb-0">
                                <h4 class="ellipsis">COUR DES GRAND</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/c4a5e7561d58407bd246ac3389a0d1a9.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\fruitizz_niamey.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\fruitizz_niamey.html" class="product_title mb-0">
                                <h4 class="ellipsis">Fruitizz Niamey</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/4f0ec64ff0a9bb7bd3fe1b18729734e0.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\galerie_chouman.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\galerie_chouman.html" class="product_title mb-0">
                                <h4 class="ellipsis">GALERIE CHOUMAN</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/assets/images/fournisseur.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\l-atelier-kouadjo.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\l-atelier-kouadjo.html" class="product_title mb-0">
                                <h4 class="ellipsis">L'atelier kouadjo</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/30f260ec901b6fb3993e4fc6e5a23d16.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="error.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="error.html" class="product_title mb-0">
                                <h4 class="ellipsis">Lilo Beauty Spa</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/93c5c10c6f142d1316ace3998ff00a78.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\lux_pressing.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\lux_pressing.html" class="product_title mb-0">
                                <h4 class="ellipsis">LUX PRESSING</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/6bf7f9931ca60777474c5c595dc7919a.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\nasco_2.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\nasco_2.html" class="product_title mb-0">
                                <h4 class="ellipsis">NASCO 2</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
                                <p>
                                    <span class="lnr lnr-users"></span> 0</p>
                            </div>
                            <div class="sell">
                                <p>
                                    <span class="lnr lnr-cart" style="margin-right: 0"></span>
                                    <span>50</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/605e785c1b9b32baad1b9e35b375381a.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\niamey_pizza.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\niamey_pizza.html" class="product_title mb-0">
                                <h4 class="ellipsis">Niamey pizza</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/assets/images/fournisseur.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\optima-esn.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\optima-esn.html" class="product_title mb-0">
                                <h4 class="ellipsis">Optima Esn</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/assets/images/fournisseur.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="error.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="error.html" class="product_title mb-0">
                                <h4 class="ellipsis">Point AirNiger</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/ef4054730da3eea33b68e361e8668900.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\safari_parc.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\safari_parc.html" class="product_title mb-0">
                                <h4 class="ellipsis">Safari Parc</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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

                    <div class="product product--card">
                        <div class="product__thumbnail">
                            <img src="https://backend.afrikfid.boutique/Public/identity/db1c030d3c839d11e3d76d6168759155.png" style="height: 200px" alt="Product Image">
                            <div class="prod_btn">
                                <a href="marchands\soleil_sucre.html" class="transparent btn--sm btn--round">Mes produits</a>
                            </div>
                        </div>

                        <div class="product-desc" style="height: auto;padding: 10px 10px 0 10px">
                            <a href="marchands\soleil_sucre.html" class="product_title mb-0">
                                <h4 class="ellipsis">SOLEIL SUCRE</h4>
                            </a>
                        </div>
                        <div class="product-purchase">
                            <div class="price_love">
                                <span><small>Niamey</small></span>
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
            </div>
        </div>
        <div class="all-testimonial">
            <a href="marchands.html" class="btn btn--lg btn--round">Voir tous nos marchands</a>
        </div>
        <!-- end /.row -->
    </div>
    <!-- start /.container -->
</section>

<section class="counter-up-area bgimage">
    <div class="bg_image_holder">
        <img src="Public\assets\images\countbg.jpg" alt="">
    </div>
    <div class="container content_above">
        <div class="col-md-12">
            <div class="counter-up">
                <div class="counter mcolor2">
                    <span class="lnr lnr-briefcase"></span>
                    <span class="count">2</span>
                    <p>Coupons</p>
                </div>
                <div class="counter mcolor3">
                    <span class="lnr lnr-cloud-download"></span>
                    <span class="count">261</span>
                    <p>Produits</p>
                </div>
                <div class="counter mcolor1">
                    <span class="lnr lnr-smile"></span>
                    <span class="count">1,355</span>
                    <p>Clients</p>
                </div>
                <div class="counter mcolor4">
                    <span class="lnr lnr-users"></span>
                    <span class="count">56</span>
                    <p>Marchands</p>
                </div>
            </div>
        </div>
        <!-- end /.col-md-12 -->
    </div>
    <!-- end /.container -->
</section>


<section class="proposal-area">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 no-padding">
                <div class="proposal proposal--left bgimage" style="padding: 20px 10%;">
                    <div class="bg_image_holder">
                        <img src="Public\assets\images\bbg.png" alt="prop image">
                    </div>
                    <div class="content_above">
                        <div class="proposal__icon ">
                            <img src="Public\assets\images\buy.png" alt="Buy icon">
                        </div>
                        <div class="proposal__content" style="padding: 20px 0 15px;">
                            <h1 class="text--white" style="padding-bottom: 10px;">Vendez vos produits</h1>
                            <p class="text--white" style="margin-bottom: 5px">Positionner vos produits et rentabiliser grâce à notre communauté; booster vos ventes et créer de la proximité avec vos clients via nos programmes de fidélisation.</p>
                        </div>
                        <a href="marchand\register.html" class="btn--round btn btn--lg btn--white">Devenir Marchand</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 no-padding">
                <div class="proposal proposal--right" style="padding: 20px 10%;">
                    <div class="bg_image_holder">
                        <img src="error.html" alt="this is magic">
                    </div>
                    <div class="content_above">
                        <div class="proposal__icon">
                            <img src="Public\assets\images\sell.png" alt="Sell icon">
                        </div>
                        <div class="proposal__content" style="padding: 20px 0 15px;">
                            <h1 class="text--white" style="padding-bottom: 10px;">Carte de fidélité</h1>
                            <p class="text--white" style="margin-bottom: 5px">Bénéficiez des réductions sur vos achats chez nos marchands et partenaires, gagnez des coupons de réductions et plein d'autres lots grâce à notre Carte de fidélité.</p>
                        </div>
                        <a href="login.html" class="btn--round btn btn--lg btn--white">Commander ma carte</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="special-feature-area">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="special-feature feature--1">
                    <img src="Public\assets\images\spf1.png" alt="Special Feature image">
                    <h3 class="special__feature-title">Réduction sur les achats
                        <span class="highlight">jusqu'à 15%</span>
                    </h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="special-feature feature--2">
                    <img src="Public\assets\images\spf2.png" alt="Special Feature image">
                    <h3 class="special__feature-title">Accéssible sur plusieurs
                        <span class="highlight">supports</span>
                    </h3>
                </div>
            </div>
        </div>
    </div>
</section>


