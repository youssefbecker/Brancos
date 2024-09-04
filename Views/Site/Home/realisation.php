<?php

use Projet\Database\Commentaire;
use Projet\Database\Image;
use Projet\Model\App;
use Projet\Model\Encrypt;
use Projet\Model\FileHelper;
use Projet\Model\Session;
/*
App::addScript("assets/js/oxl.carousel/coin-slider.js"); */
App::addScript("assets/js/pages/realisation.js",true,true);
App::setTitle("Nos Réalisations");
?>
<div class="ui-hero hero-sm bg-dark-gray hero-svg-layer-4">
    <div class="container">
        <h1 class="heading">
            Nos Réalisations
        </h1>
        <p class="paragraph">
            Nous avons déjà developpés de nombreuses applications et travaillés avec de nombreux partenaires.
        </p>
    </div>
</div>
<div class="main" role="main">

    <!-- Pricing Cards Section -->
    <div id="pricing" class="section bg-light p-0">
        <div class="container">
            <!-- Section Heading -->
            <div class="section-heading center">
                <h2 class="heading text-dark-gray"></h2>
            </div><!-- .section-heading -->

            <div class="row">
                <?php
                if (isset($prices)) {
                    $i=0;
                    foreach ($prices as $price) {
                        $i++;
                        if ($i==2){
                            $text='active';
                            $color=' ui-gradient-peach';
                        }else{
                            $text='';
                            $color=' bg-dark-gray';
                        }
                        $key = "likeRealisation".$price->id;
                        $isLiked = $session->read($key)?"fa-heart":"fa-heart-o";
                        ?>
                        <div class="card animate col-md-3">
                            <img class="card-img-top" style="height: 200px;border: 1px solid #EEE;" src="<?= FileHelper::url(Image::searchType(null,null,$price->id)[0]->path)?>"  alt="Card image cap">
                            <div class="card-body text-center">
                                <h6 class="card-title"><?=$price->intitule?></h6>
                                <div class="md-list-content">
                                    <span class=" text-danger <?= "refLiked".$price->id?>"><?= number_format($price->liked,0,',',' '); ?></span>
                                    <button style="text-decoration: none; border: 0;background-color: #fff;padding: 0" ><i class="text-danger  fa <?= $isLiked ?> liked <?= "iconlike".$price->id?>" data-id="<?= $price->id?>"></i>&nbsp;</button>
                                    <span class="text-default <?= "refCommentaire".$price->id ?> "><?=$commentNumber[$price->id]->Total?></span>
                                    <span class="text-default fa fa-comments"></span>&nbsp;
                                    <span class="text-success  <?= "refVue".$price->id ?>"><?=$price->vues?></span>
                                    <span  class="text-success fa fa-eye"></span>
                                </div>
                                <div class="card-link mt-3">
                                     <a class="btn btn-primary btn-sm" href="<?= App::url('realisation/details/view?id='.Encrypt::crypter($price->id))?>" style="text-transform: none" >Détails <i class="fa fa-chevron-circle-right"></i></a>
                                </div>
                            </div>
                        </div>

                    <?php } }?>
            </div>

            <!-- Pricing Footer -->

            <div class="ui-pricing-footer mb-5">
                <p class="paragraph">
                    Pour plus d'informations et de details contactez nous
                </p>
                <div class="actions">
                    <a href="<?=App::url("contact")?>" class="btn-link btn-arrow">Contactez nous</a><br>
                </div>
            </div><!-- .ui-pricing-footer -->

        </div><!-- .container -->
    </div>
</div>
<!--<div class="modal fade" id="realsModal" style="width: 100% !important;" >
    <input type="hidden" value="0" id="isconnect">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 140% ; margin: 0 auto;right: 160px; !important;" >
            <div class="modal-header" style="background-color: rgba(0, 9, 128, 0.05);">
                <span class="close" data-dismiss="modal">&times;</span>
                <div class="modal-title"><h4 id="realsTitle">Details de la realisation</h4></div>
            </div>
            <div class="modal-body " style="height: 450px; overflow-x: auto; background-color: rgba(0, 9, 128, 0.05); ">
                <div  class="media p-3">
                   <div class="media-left" id="commentImg" >

                   </div>
                   <div class="media-body  text-justify" id="realsMessage">
                       <a class="btn btn-primary btn-sm" style="color: white; background-color: black;">voir le site<i class="fa fa-chevron-circle-right"></i></a>
                   </div>
                </div>
                </br>
                    <h4>Commentaires <small id="nbreCommentaires"></small></h4>
                </br>
                   <div id="mediaContainer"></div>
            </div>
            <div class="modal-footer" style="background-color: rgba(0, 9, 128, 0.05);">
                <form id="commentForm" action="<?/*=App::url("realisation/comment")*/?>" method="POST" class="container-fluid">
                   <input type="hidden" id="idParent"  name="idParent">
                    <div class="row" >
                                <?php
/*                                $valNom = '';
                                $isHidden = '';
                                if ($auth->isLogged()){
                                    $username = Session::getInstance()->read("dbauth")->nom;
                                    $valNom = ($username) ?$username:"";
                                        $isHidden = 'hidden';
                                }
                                else{
                                    $username = Session::getInstance()->read("username");
                                    $valNom = ($username) ?$username:"";
                                }
                                     echo '';
                                */?>

                        <div class="col-md-2 <?/*=$isHidden*/?>">
                            <div class="form-group" ><input type="text"  required id="commentPseudo" style="background: white;margin-top: 15px" placeholder="nom ou pseudo" class="form-control" value="<?/*=$valNom*/?>">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <textarea cols="30" rows="2" class="form-control" required placeholder="Laissez un commentaire" style="background: white; height: 80px;" id="commentField"></textarea>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-dark btn-sm" style="height: 50px;margin-top: 15px" id="realsComment" >commentez</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>-->
    <!--
<div class="modal fade" id="modalReplyCommentaire">
    <div class="modal-dialog">
        <button class="modal-close close" type="button"></button>
        <form action="<?= App::url('realisation/comment/reply'); ?>" id="formCommentaire" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h3 class="heading_b margin-bottom titleForm">Title</h3>
            </div>
            <input type="hidden" id="idParent"  name="idParent">
            <input type="hidden" id="id"  name="id">
            <div class="col-md-8">
                <div class="form-group">
                    <textarea cols="30" rows="2" class="form-control" required placeholder="Répondre à un commentaire" style="background: white; height: 80px;" id="commentField"></textarea>
                </div>
            </div>
            <div class="uk-modal-footer">
                <button type="submit" class="sendBtn uk-float-right md-btn md-btn-flat md-btn-flat-primary">Répondre</button>
            </div>
        </form>
    </div>
</div> -->