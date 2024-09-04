<?php

use Projet\Database\Commentaire;
use Projet\Database\Image;
use Projet\Model\App;
use Projet\Model\DateParser;
use Projet\Model\Encrypt;
use Projet\Model\FileHelper;
use Projet\Model\Session;

/*
App::addScript("assets/js/oxl.carousel/coin-slider.js"); */
App::addScript("assets/js/pages/detailsRealisation.js", true, true);
App::setTitle("Détails de la réalisation $realisation->intitule");
?>
<div class="ui-hero hero-sm bg-dark-gray hero-svg-layer-4">
    <div class="container">
        <h1 class="heading">
            Détails de la réalisation <?= $realisation->intitule ?>
        </h1>
    </div>
</div>
<div class="main" role="main">

    <!-- Pricing Cards Section -->
    <div id="pricing" class="section bg-light p-0">
        <div class="container">
            <!-- Section Heading -->
            <div class="section-heading center">
                <h2 class="heading text-dark-gray"></h2>
            </div>

            <!-- The Blog Post -->
            <div class="ui-blog-post">
                <!-- Main Image -->
                <div class="post-image shadow-sm">
                    <div class="ui-hero ui-hero-slider slider-pro hero-lg ui-gradient-purple"
                         data-fade="true"
                         data-touch_swipe="false"
                         data-auto_play="true"
                         data-autoplay_delay="3500"
                         data-autoplay_on_hover="none"
                         data-show_dots="true"
                         data-show_arrows="true"  style="background: #f5f9fc">
                        <div class="sp-slides fade">
                            <!-- Slide 1 -->
                            <?php
                            foreach ($images as $image) {
                                echo '
                                    <!-- Item Image -->
                                    
                                    <div class="sp-slide">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12 sp-layer" data-show-transition="left" data-show-delay="300" data-show-duration="1000">
                                                <img src="' . $image->path . '" alt="Applify - App Landing Page HTML Template" data-uhd data-max_width="640" class="responsive-on-sm"/>
                                            </div>
                                        </div><!-- .row -->
                                    </div><!-- .container -->
                                </div><!-- .sp-slide -->
                                     <!-- Item Header -->
                               ';
                            }
                            ?>
                        </div><!-- .sp-slides -->
                    </div><!-- .ui-hero .slider-pro -->
                </div>
                <?php
                $key = "likeRealisation".$realisation->id;
                $isLiked = $session->read($key)?"fa-heart":"fa-heart-o";
                echo ' 
                    <h4 class="heading">' . $realisation->intitule . '</h4>
                    <small class="post-date">' . DateParser::DateConviviale($realisation->created_at, 1) . '</small>
                    <blockquote>
                        <p>
                             was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country.
                        </p>
                        <p class="author">Universialis</p>
                    </blockquote>
                    <div class="post-footer">
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <div>
                                    <h6 class="heading"><small>Total,Vues,Like</small></h6>
                                    <div class="btn-group">
                                        <div class="btn btn-sm ui-gradient-peach">
                                            <span class="icon icon-speech"></span>
                                            <span class="refCommentaire" id="refCommentaire">' . thousand($nbreComments->Total) . '</span>
                                        </div>
                                        <div class="btn btn-sm ui-gradient-green">
                                            <span class="text-danger refLiked" >'. number_format($realisation->liked,0,"","").'</span>
                                            <a style="text-decoration: none; border: 0;background-color: #fff;padding: 0" ><i class="text-danger  fa '. $isLiked.' liked iconlike" data-id="'.$realisation->id.'" data-url="'.App::url("realisation/likes").'"></i>&nbsp;</a>
                                        </div>
                                        <div class="btn btn-sm ui-gradient-peach">
                                            <span class="icon icon-eye"></span>
                                            <span class="refVue ">' . $realisation->vues . '</span>
                                        </div>
                                        
                                       
                                    </div>
                                </div>
                            </div><!-- Like + Share Buttons -->
                            <!-- Post Tags -->
                         
                        </div><!-- .row -->
                    </div><!-- .Post footer  -->
                         ';?>

            </div><!-- .ui-blog-post -->
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="panel ui-card post-item shadow-sm">
                        <div class="panel-title p-2">
                            <h4>Commenntaires <small><span  id="valTitleComment">(<?= thousand($nbreComments->Total) ?>)</span></small></h4>
                        </div>
                        <div class="panel-body">
                            <div id="mediaContainer">
                                <?php
                                if (isset($comments)) {
                                    foreach ($comments as $comment) {
                                        echo '<div class="media commentaire ml-2">
                                            <div class="messaging">
                                                <div class="inbox_msg">
                                                    <div class="mesgs">
                                                        <div class="msg_history">
                                                            <div class="incoming_msg">
                                                                <div class="incoming_msg_img col-lg-1"> 
                                                                    <img  src="' . FileHelper::url("assets/img/user.jpg") . '" alt="visage"  class="mr-1 mt-1 rounded-circle" style="width:40px;">
                                                                </div>
                                                                <div class="received_msg col-lg-11">
                                                                    <div class="received_withd_msg">
                                                                        <p class="inbox_msg_title"><b><u>' . $comment->nom . '</u>
                                                                        </b><i class="pull-right"><small><a href="javascript:void(0);" class="reply"  data-id="' . $comment->id . '" data-url="'.App::url("realisation/comment/isHavePermission").'"><b>Répondre</b></a><a href="javascript:void(0);" class="p-2 closeRow hidden onClose' . $comment->id . '" data-id="' . $comment->id . '"><i class="fa fa-close"></i></a></small></i></p>
                                                                         <div class="content_message">' . $comment->message . '
                                                                            <div class="row m-2 p-1 hidden rowReponse' . $comment->id . '"> 
                                                                                 <div class="col-md-9">
                                                                                      <textarea  cols="30" rows="2" class="form-control" id="message' . $comment->id . '" placeholder="Répondre au commentaire de ' . $comment->nom . '"></textarea>
                                                                                 </div>
                                                                                 <div class="col-md-2">
                                                                                        <button class="btn btn-dark replySend" data-id="' . $comment->id . '"  data-idcommentparent="' . $comment->id . '" data-nom="' . $comment->nom . '"    data-url="'.App::url("realisation/comment").'"><i class="fa fa-send"></i></button>
                                                                                 </div>
                                                                            </div>
                                                                         </div>
                                                                         <span class="time_date">' . DateParser::DateConviviale($comment->created_at, 1) . '</span>
                                                                     </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                       </div>';
                                        $commentaires = Commentaire::searchType(null, null, null, $realisation->id, null, null, null, 1, $comment->id);
                                        if ($commentaires) {
                                            foreach ($commentaires as $commentaire) {
                                                echo '<div class="media commentaire ml-5">
                                            <div class="messaging">
                                                <div class="inbox_msg">
                                                    <div class="mesgs">
                                                        <div class="msg_history">
                                                            <div class="incoming_msg">
                                                                <div class="incoming_msg_img col-lg-1"> 
                                                                    <img  src="' . FileHelper::url("assets/img/user.jpg") . '" alt="visage"  class="mr-1 mt-1 rounded-circle" style="width:40px;">
                                                                </div>
                                                                <div class="received_msg col-lg-11">
                                                                    <div class="received_withd_msg">
                                                                        <p class="inbox_msg_title"><b><u>' . $commentaire->nom . '</u>
                                                                        </b><i class="pull-right"><small><a href="javascript:void(0);" class="reply"  data-id="' . $commentaire->id . '"  data-url="'.App::url("realisation/comment/isHavePermission").'"><b>Répondre</b></a><a href="javascript:void(0);" class="p-2 closeRow hidden onClose' . $commentaire->id . '" data-id="' . $commentaire->id . '" ><i class="fa fa-close"></i></a></small></i></p>
                                                                         <div class="content_message">' . $commentaire->message . '
                                                                            <div class="row m-2 p-1 hidden rowReponse' . $commentaire->id . '"> 
                                                                                 <div class="col-md-9">
                                                                                      <textarea  cols="30" rows="2" class="form-control" id="message' . $commentaire->id . '" placeholder="Répondre au commentaire de ' . $commentaire->nom . '"></textarea>
                                                                                 </div>
                                                                                 <div class="col-md-2">
                                                                                        <button class="btn btn-dark replySend" data-id="' . $commentaire->id . '"  data-idcommentparent="' . $comment->id . '" data-nom="' . $commentaire->nom . '"   data-url="'.App::url("realisation/comment").'"><i class="fa fa-send"></i></button>
                                                                                 </div>
                                                                            </div>
                                                                         </div>
                                                                         <span class="time_date">' . DateParser::DateConviviale($commentaire->created_at, 1) . '</span>
                                                                     </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                       </div>';
                                            }
                                        }

                                    }

                                } ?>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form id="commentForm" action="<?= App::url("realisation/comment") ?>" method="POST">
                                    <input type="hidden" id="idParent" name="idParent">
                                    <input type="hidden" id="id" name="id" value="<?= Encrypt::decrypter($_GET['id'])?>">
                                    <div class="row">
                                        <?php
                                        $valNom = '';
                                        $isHidden = '';
                                        if ($auth->isLogged()) {
                                            $username = Session::getInstance()->read("dbauth")->nom;
                                            $valNom = ($username) ? $username : "";
                                            $isHidden = 'hidden';
                                        } else {
                                            $username = Session::getInstance()->read("username");
                                            $valNom = ($username) ? $username : "";
                                        }
                                        echo '';
                                        ?>

                                        <div class="col-md-2 <?= $isHidden ?>">
                                            <div class="form-group"><input type="text" required id="commentPseudo" style="background: white;margin-top: 15px" placeholder="nom ou pseudo" class="form-control" value="<?= $valNom ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <textarea cols="30" rows="2" class="form-control" required placeholder="Laissez un commentaire" style="background: white; height: 80px;" id="commentField"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-block btn-dark btn-sm" style="height: 50px;margin-top: 15px" id="realsComment">commentez</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" value="0" id="isconnect">


        </div><!-- .container -->
    </div>
</div>