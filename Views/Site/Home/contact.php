<?php

use Projet\Model\App;
use Projet\Model\FileHelper;
App::setTitle("Nous contacter");
App::addScript("assets/js/pages/contact.js",true,true);
?>
<section class="breadcrumb-area breadcrumb--center breadcrumb--smsbtl">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page_title">
                    <h3>Nous contacter</h3>
                    <p class="subtitle">Vous êtes au bon endroit</p>
                </div>
                <div class="breadcrumb">
                    <ul>
                        <li>
                            <a href="<?= App::url('') ?>">Accueil</a>
                        </li>
                        <li class="active">
                            <a href="<?= App::url('contat') ?>">Nous Contacter</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contact-area section--padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h1>Comment pouvons-nous
                                <span class="highlighted">vous aider?</span>
                            </h1>
                            <p>Ecrivez nous pour tout problème, abus ou suggestions par rapport au service ou à un besoin.</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="contact_tile">
                            <span class="tiles__icon lnr lnr-map-marker"></span>
                            <h4 class="tiles__title">Contacts bureaux</h4>
                            <div class="tiles__content">
                                <p>Akwa rue castelnau Douala Cameroun</p>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-lg-4 col-md-6 -->

                    <div class="col-lg-4 col-md-6">
                        <div class="contact_tile">
                            <span class="tiles__icon lnr lnr-phone"></span>
                            <h4 class="tiles__title">Numéros de téléphone</h4>
                            <div class="tiles__content">
                                <p>+237 694 408 247</p>
                                <p>+237 691 340 303</p>
                            </div>
                        </div>
                        <!-- end /.contact_tile -->
                    </div>
                    <!-- end /.col-lg-4 col-md-6 -->

                    <div class="col-lg-4 col-md-6">
                        <div class="contact_tile">
                            <span class="tiles__icon lnr lnr-inbox"></span>
                            <h4 class="tiles__title">Adresses Email</h4>
                            <div class="tiles__content">
                                <p>contact@Brancos.boutique</p>
                                <p>ousmanou@uisolution.net</p>
                            </div>
                        </div>
                        <!-- end /.contact_tile -->
                    </div>
                    <!-- end /.col-lg-4 col-md-6 -->

                    <div class="col-md-12">
                        <div class="contact_form cardify">
                            <div class="contact_form__title">
                                <h3>Laisser un Message</h3>
                            </div>

                            <div class="row">
                                <div class="col-md-8 offset-md-2">
                                    <div class="contact_form--wrapper">
                                        <form action="<?= App::url('contact/save') ?>" method="post" id="contacteForm">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input  type="text" name="name" id="name" placeholder="Votre nom:" data-constraints="@Required">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text"  id="numero" name="numero"  placeholder="Numéro de téléphone">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="email" id="email" name="email" placeholder="Email:" data-constraints="@Required @Email">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" id="sujet" name="sujet" placeholder="Sujet">
                                                    </div>
                                                </div>
                                            </div>

                                            <textarea cols="30" name="message" rows="7" id="message" placeholder="Message:" data-constraints="@Required"></textarea>

                                            <div class="sub_btn">
                                                <button type="submit" class="btn btn--round btn--default" id="submit_btn">Envoyer le message</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>