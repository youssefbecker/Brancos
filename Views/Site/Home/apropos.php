<?php

use Projet\Model\App;
use Projet\Model\FileHelper;

App::setTitle("A propos");
?>
<section class="about_hero bgimage">
    <div class="bg_image_holder">
        <img src="Public\assets\images\about_hero.jpg" alt="">
    </div>

    <div class="container content_above">
        <div class="row">
            <div class="col-md-12">
                <div class="about_hero_contents">
                    <h1>Bienvenu à Brancos!</h1>
                    <p>Nous aidons les Marketeurs
                        <span>Créer des Produits</span>
                    </p>

                    <div class="about_hero_btns">
                        <a href="#" class="play_btn" data-toggle="modal" data-target="#myModal">
                        <a href="<?= App::url('login') ?>" class="btn btn--white btn--lg btn--round">Nous Rejoindre</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about_mission">
    <div class="content_block1">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12">
                    <div class="content_area">
                        <h1 class="content_area--title">A propos de
                            <span class="highlight">BRANCOS</span>
                        </h1>
                        <p>Parce que, la fidélisation est aujourd’hui fondée sur la relation avec le client. C’est de l’enrichissement de cet échange que nait une relation durable et mutuellement profitable…
                            Notre objectif est de dynamiser la fidélisation dans son ensemble, la rendre abordable et personnelle pour chacun, mais surtout d’orchestrer une communication…. </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="content_image bgimage">
            <div class="bg_image_holder">
                <img src="Public\assets\images\propos.jpeg" alt="">
            </div>
        </div>
    </div>

    <div class="content_block2">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6  offset-md-6 offset-lg-7">
                    <div class="content_area2">
                        <h1 class="content_area2--title">BRANCOS
                            <span class="highlight">Mission & Vision</span>
                        </h1>
                        <p>Notre mission est de donner la puissance marketing des grandes marques aux Commerces indépendants à travers des services marketing,…
                            Nous avons conviction que le Mobile doit être cœur de la relation enseigne-point de Vente-Consommateur pour favoriser l’interactivité avec le client,.. </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="content_image2 bgimage">
            <div class="bg_image_holder">
                <img src="Public\assets\images\mission.jpeg" alt="">
            </div>
        </div>
    </div>
</section>

<section class="timeline_area section--padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h1>MartPlace Milestone
                        <span class="highlighted"> Achievements</span>
                    </h1>
                    <p>Laborum dolo rumes fugats untras. Etharums ser quidem rerum facilis dolores nemis omnis fugats. Lid
                        est laborum dolo rumes fugats untras.</p>
                </div>
            </div>
            <!-- end /.col-md-12 -->
        </div>
        <!-- end /.row -->

        <div class="row">
            <div class="col-md-12">
                <ul class="timeline">
                    <li class="happening">
                        <div class="happening--period">
                            <p>February 2009</p>
                        </div>
                        <div class="happening--detail">
                            <h4 class="title">MartPlace was Launched</h4>
                            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra justo ut scelerisque the mattis,
                                leo quam aliquet diam congue is laoreet.</p>
                        </div>
                    </li>

                    <li class="happening">
                        <div class="happening--period">
                            <p>February 2010</p>
                        </div>
                        <div class="happening--detail">
                            <h4 class="title">Launched Premium Version</h4>
                            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra justo ut scelerisque the mattis,
                                leo quam aliquet diam congue is laoreet.</p>
                        </div>
                    </li>

                    <li class="happening">
                        <div class="happening--period">
                            <p>July 2012</p>
                        </div>
                        <div class="happening--detail">
                            <h4 class="title">3 Million Downloads Reached</h4>
                            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra justo ut scelerisque the mattis,
                                leo quam aliquet diam congue is laoreet.</p>
                        </div>
                    </li>

                    <li class="happening">
                        <div class="happening--period">
                            <p>November 2015</p>
                        </div>
                        <div class="happening--detail">
                            <h4 class="title">50,000+ Community Members</h4>
                            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra justo ut scelerisque the mattis,
                                leo quam aliquet diam congue is laoreet.</p>
                        </div>
                    </li>

                    <li class="happening">
                        <div class="happening--period">
                            <p>August 2016</p>
                        </div>
                        <div class="happening--detail">
                            <h4 class="title">Added Payoneer as a Payment Method</h4>
                            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra justo ut scelerisque the mattis,
                                leo quam aliquet diam congue is laoreet.</p>
                        </div>
                    </li>

                </ul>
                <!-- end /.timeline -->
            </div>
            <!-- end /.col-md-12 -->
        </div>
        <!-- end /.row -->
    </div>
    <!-- end /.container -->
</section>

<section class="counter-up-area counter-up--area2">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Aujourd'hui nous sommes ici</h2>
            </div>
        </div>
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
                    <span class="count">1,363</span>
                    <p>Clients</p>
                </div>
                <div class="counter mcolor4">
                    <span class="lnr lnr-users"></span>
                    <span class="count">56</span>
                    <p>Marchands</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="team_area section--padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h1>L'équipe de
                        <span class="highlighted">Brancos</span>
                    </h1>
                    <p>Une équipe de jeunes qualifiés, devoués et appliqués travaillant en étroite collaboration pour produirre un travail de qualité répondant à votre besoin.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="single_team_member">
                    <figure>
                        <img src="Public\assets\images\team1.jpg" alt="Team Member">
                        <figcaption>
                            <div class="name_desig">
                                <h4>Douglus Khundu</h4>
                                <p>Software Engineer</p>
                            </div>
                            <!-- end /.name_desig -->

                            <div class="social">
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
                                            <span class="fa fa-dribbble"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end /.social -->
                        </figcaption>
                        <!-- end /.figcaption -->
                    </figure>
                    <!-- end /.figure -->
                </div>
                <!-- end /.single_team_member -->
            </div>

            <div class="col-lg-3 col-md-4">
                <div class="single_team_member">
                    <figure>
                        <img src="Public\assets\images\team2.jpg" alt="Team Member">
                        <figcaption>
                            <div class="name_desig">
                                <h4>Robert Jellybean</h4>
                                <p>Application Developer</p>
                            </div>
                            <!-- end /.name_desig -->

                            <div class="social">
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
                                            <span class="fa fa-dribbble"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end /.social -->
                        </figcaption>
                        <!-- end /.figcaption -->
                    </figure>
                    <!-- end /.figure -->
                </div>
                <!-- end /.single_team_member -->
            </div>

            <div class="col-lg-3 col-md-4">
                <div class="single_team_member">
                    <figure>
                        <img src="Public\assets\images\team3.jpg" alt="Team Member">
                        <figcaption>
                            <div class="name_desig">
                                <h4>Tomat Notfrut</h4>
                                <p>Js Developer</p>
                            </div>
                            <!-- end /.name_desig -->

                            <div class="social">
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
                                            <span class="fa fa-dribbble"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end /.social -->
                        </figcaption>
                        <!-- end /.figcaption -->
                    </figure>
                    <!-- end /.figure -->
                </div>
                <!-- end /.single_team_member -->
            </div>

            <div class="col-lg-3 col-md-4">
                <div class="single_team_member">
                    <figure>
                        <img src="Public\assets\images\team4.jpg" alt="Team Member">
                        <figcaption>
                            <div class="name_desig">
                                <h4>Naro Sundor</h4>
                                <p>CTO</p>
                            </div>
                            <!-- end /.name_desig -->

                            <div class="social">
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
                                            <span class="fa fa-dribbble"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end /.social -->
                        </figcaption>
                        <!-- end /.figcaption -->
                    </figure>
                    <!-- end /.figure -->
                </div>
                <!-- end /.single_team_member -->
            </div>

        </div>
    </div>
    =</section>

<section class="partner-area section--padding partner--area2 bgimage">
    <div class="bg_image_holder">
        <img src="error.html" alt="">
    </div>
    <!-- start container -->
    <div class="container">
        <!-- start row -->
        <div class="row">
            <!-- start col-md-12 -->
            <div class="col-md-12">
                <div class="section-title">
                    <h1>Nous sommes
                        <span class="highlighted">Assistés</span>
                    </h1>
                    <p>Partenaires avec qui nous collaborons au quotidien et qui nous font confiance.</p>
                </div>
            </div>
        </div>
        =
        <div class="row">
            <div class="col-md-12">
                <div class="partners">
                    <div class="partner">
                        <img src="Public\assets\images\cl1.png" alt="partner image">
                    </div>
                    <div class="partner">
                        <img src="Public\assets\images\cl2.png" alt="partner image">
                    </div>
                    <div class="partner">
                        <img src="Public\assets\images\cl3.png" alt="partner image">
                    </div>
                    <div class="partner">
                        <img src="Public\assets\images\cl4.png" alt="partner image">
                    </div>
                    <div class="partner">
                        <img src="Public\assets\images\cl2.png" alt="partner image">
                    </div>
                </div>
            </div>
        </div>
        <!-- end /.row -->
    </div>
    <!-- end /.container -->
</section>

<section class="testimonial-area testimonial--2 section--padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h1>Témoignages de nos
                        <span class="highlighted">Clients</span>
                    </h1>
                    <p>Avis et retours de nos clients</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="testimonial-slider">
                    <div class="col-md-12 text-center text-danger"><i class="lnr lnr-warning fa-2x"></i> Aucune témoignage disponible....</div>                </div>
            </div>
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
                    <a href="<?= App::url('login') ?>" class="btn btn--lg btn--round btn--white callto-action-btn">Rejoindre maintenant</a>
                </div>
            </div>
        </div>
    </div>
</section>





