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
App::addScript("assets/js/pages/detailsNews.js", true, true);
App::setTitle("Détails de la news $news->titre");
?>
<div class="ui-hero hero-sm bg-dark-gray hero-svg-layer-4">
    <div class="container">
        <h1 class="heading">
            Détails de la réalisation <?= $news->titre ?>
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

            <div class="row ui-blog-grid">
                <div class="col-lg-9">
                    <div class="ui-card post-item shadow-sm">
                        <div class="card-image" data-bg="<?= FileHelper::url($news->image)?>" data-uhd></div>
                        <?php

                        $key = "likeNews".$news->id;
                        $isLiked = $session->read($key)?"fa-heart":"fa-heart-o";
                        echo '
                                                <div class="card-header">
                                                    <h4 class="heading">' . $news->titre . '</h4>
                                                    <small class="post-date">' . DateParser::DateConviviale($news->created_at, 1) . '</small>

                                                </div>
                                            <div class="card-body ui-turncate-text">
                                                ' . $news->contenu . '
                                            </div>
                                            <!-- Item Footer -->
                                            <div class="card-footer">
                                                <div class="post-meta">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div>
                                                                <span class="icon icon-speech"></span>
                                                                <span class="refCommentaire" id="refCommentaire">' . thousand($nbreComments->Total) . '</span>
                                                            </div>
                                                            <div>
                                                                <span class="icon icon-eye"></span>
                                                                <span class="refVue">' . $news->vues . '</span>
                                                            </div>
                                                            <div>
                                                                <span class="text-danger refLiked">'. number_format($news->liked,0,"","").'</span>
                                                                <button style="text-decoration: none; border: 0;background-color: #fff;padding: 0" ><i class="text-danger  fa '. $isLiked.' liked iconlike" data-id="'.$news->id.'" data-url="'.App::url("news/likes").'"></i>&nbsp;</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';

                        ?>
                    </div>
                </div>
                <div class="col-lg-3"></div>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="panel ui-card post-item shadow-sm">
                        <div class="panel-title pt-4 pr-5 pl-5 pb-2">
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
                                                                        <p class="inbox_msg_title pb-1"><b><u>' . $comment->nom . '</u>
                                                                        </b><i class="pull-right"><small><a href="javascript:void(0);" class="reply"  data-id="' . $comment->id . '" data-url="'.App::url("realisation/comment/isHavePermission").'"><b>Répondre</b></a><a href="javascript:void(0);" class="p-2 closeRow hidden onClose' . $comment->id . '" data-id="' . $comment->id . '"><i class="fa fa-close"></i></a></small></i></p>
                                                                         <div class="content_message">' . $comment->message . '
                                                                            <div class="row mt-2 mb-2 mr-0 ml-0 hidden rowReponse' . $comment->id . '"> 
                                                                                 <div class="input-group mb-3">
                                                                                    <input type="text" class="form-control" id="message' . $comment->id . '" placeholder="Répondre au commentaire de ' . $comment->nom . '">
                                                                                    <div class="input-group-append">
                                                                                        <button class="btn btn-primary replySend" data-id="' . $comment->id . '"  data-idcommentparent="' . $comment->id . '" data-nom="' . $comment->nom . '"   data-url="'.App::url("news/comment").'"><i class="fa fa-send"></i></button>
                                                                                    </div>
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
                                        $commentaires = Commentaire::searchType(null, null, $news->id,null, null, null, null, 1, $comment->id);
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
                                                                        <p class="inbox_msg_title pb-1"><b><u>' . $commentaire->nom . '</u>
                                                                        </b><i class="pull-right"><small><a href="javascript:void(0);" class="reply"  data-id="' . $commentaire->id . '"  data-url="'.App::url("realisation/comment/isHavePermission").'"><b>Répondre</b></a><a href="javascript:void(0);" class="p-2 closeRow hidden onClose' . $commentaire->id . '" data-id="' . $commentaire->id . '" ><i class="fa fa-close"></i></a></small></i></p>
                                                                         <div class="content_message">' . $commentaire->message . '
                                                                            <div class="row mt-2 mb-2 mr-0 ml-0 hidden rowReponse' . $commentaire->id . '">
                                                                                 <div class="input-group mb-3">
                                                                                    <input type="text" class="form-control" id="message' . $commentaire->id . '" placeholder="Répondre au commentaire de ' . $commentaire->nom . '">
                                                                                    <div class="input-group-append">
                                                                                        <button class="btn btn-primary replySend" data-id="' . $commentaire->id . '"  data-idcommentparent="' . $comment->id . '" data-nom="' . $commentaire->nom . '"   data-url="'.App::url("news/comment").'"><i class="fa fa-send"></i></button>
                                                                                    </div>
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
                                <form id="commentForm" style="margin: 40px 50px 20px 30px;" action="<?= App::url("news/comment") ?>" method="POST">
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
                                    </div>
                                    <div class="input-group mb-3">
                                        <textarea rows="1" class="form-control" required placeholder="Laissez un commentaire" style="background: white; height: 80px;" id="commentField"></textarea>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">Envoyer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3"></div>
            </div>
            <input type="hidden" value="0" id="isconnect">


        </div><!-- .container -->
    </div>
</div>