<?php

use Projet\Model\DateParser;
use Projet\Model\FileHelper;
use Projet\Model\StringHelper;
use projet\Database\Commander;
use Projet\Model\App;
App::setTitle("Commander");
App::addScript('assets/js/pages/commander.js',true,true);
?>
<div class="ui-hero hero-sm bg-dark-gray hero-svg-layer-4">
    <div class="container">
        <h1 class="heading">
            Commander
        </h1>
        <p class="paragraph">
            Vous avez besoin d'une application web, mobile ou desktop, contactez nous et décrivez vos besoins et nous serons à votre service.
        </p>
    </div>
</div>
<div class="main" role="main">
    <div class="section contact-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="ui-card form-card shadow-xl bg-white">
                        <div class="card-header pb-0">
                            <h3 class="heading">Passez votre commande</h3>
                        </div>
                        <div class="card-body">
                            <form  action="<?= App::url('commander/new') ?>" id="commandForm" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="idCommande" id="idCommande">
                                <div class="row">
                                    <div class="row-title col-md-12"><h4>Choisir le besoin</h4></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 form-group">
                                        <label for="web">Application Web</label>
                                        <input type="checkbox" class="form-control" id="web" name="web" value="web">
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label for="mobile">Application Mobile</label>
                                        <input type="checkbox" class="form-control" id="mobile" name="mobile" value="mobile">
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label for="desktop">Application pour Desktop</label>
                                        <input type="checkbox" class="form-control" id="desktop" name="desktop" value="desktop">
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label for="domaine">Nom de domaine</label>
                                        <input type="checkbox" class="form-control" id="domaine" name="domaine" value="domaine">
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label for="site">Site Web Classique</label>
                                        <input type="checkbox" class="form-control" id="site" name="site" value="site">
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label for="hebergement">Hébergement</label>
                                        <input type="checkbox" class="form-control " id="hebergement" name="hebergement" value="hebergement">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 form-group custom-file-control">
                                        <label for="charge">Ajouter un cahier de charge <small>(PDF ou WORD)</small></label>
                                        <input name="charge" id="charge" type="file" class="form-control custom-file input">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 form-group">
                                        <textarea name="description" id="description" cols="30" rows="7" placeholder="Décrivez ce que vous voulez" class="form-control input"></textarea>
                                    </div>
                                </div>
                                <button type="submit" id="submit_btn" class="btn btn-block ui-gradient-green shadow-md">Demandez un dévis</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>