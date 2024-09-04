<?php
use Projet\Model\App;
use Projet\Model\Encrypt;
use Projet\Model\Session;

App::setTitle("Nos news");
App::addScript("assets/js/pages/news.js",true,true);
?>
<div class="ui-hero hero-sm bg-dark-gray hero-svg-layer-4">
    <div class="container">
        <h1 class="heading">
            Nos news
        </h1>
        <p class="paragraph">
            Restez informer et suivez nos dernières actualités, bons plans et services.
        </p>
    </div>
</div>
<?php $color = array("bg-lime", "bg-orange", "bg-red");
$size = array("col-lg-8", "col-lg-4");
?>
<div class="main" role="main">
    <div class="bg-light">
        <div class="container">
            <!-- UI Blog -->
            <div class="ui-blog">
                <div class="row ui-blog-grid">
                    <!-- UI Blog Grid -->
                    <?php
                    $i = 0;
                    // initialisation du compteur
                    foreach ($news as $new){
                        shuffle($color);
                        // si i=1, ça signifie la taille de la premiere colonne a deja été définie
                        if( $i == 1 ){
                            if($previousSize == "col-lg-8"){
                                $size = array("col-lg-4", "col-lg-8");
                            }else{
                                $size = array("col-lg-8", "col-lg-4");
                            }
                        }else{
                            shuffle($size);
                            $i = 0;
                        }
                        $previousSize = $size[0];
                        $i++;
                        $key = "likeNews".$new->id;
                        $isLiked = $session->read($key)?"fa-heart":"fa-heart-o";
                        echo '
                    <!-- Blog Item 1 -->
                    <div class="'.$size[0].'">
                        <div class="ui-card post-item shadow-sm '.$color[0].'" data-id="'.$new->id.'">
                            <!-- Item Image -->
                            <div class="card-image" data-bg="'.$new->image.'" data-uhd></div>
                            <!-- Item Header -->
                            <div class="card-header">
                                <h4 class="heading">'.$new->titre.'</h4>
                                <small class="post-date">'.date_format(new DateTime($new->created_at)," d/m/y à h:m").'</small>
                            </div>
                            <!-- Item Text -->
                            <div class="card-body ui-turncate-text">
                                '.$new->contenu.'
                            </div>
                            <!-- Item Footer -->
                            <div class="card-footer">
                                <div class="post-meta">
                                    <div class="row">
                                        <div class="col-6">
                                             <a class="btn btn-primary btn-sm" href="'.App::url('news/details/view?id='.Encrypt::crypter($new->id)).'" style="text-transform: none" >Détails <i class="fa fa-chevron-circle-right"></i></a>
                                        </div>
                                        <div class="col-6">
                                            <div>
                                                <span class="icon icon-speech"></span>
                                                <span class="refCommentaire'.$new->id.'">'.$commentNumber[$new->id]->Total.'</span>
                                            </div>
                                            <div>
                                                <span class="icon icon-eye"></span>
                                                <span class="refVue'.$new->id.'">'.$new->vues.'</span>
                                            </div>
                                            <div>
                                                <span class="refLiked'.$new->id.'">'. number_format($new->liked,0,"","").'</span>
                                                <button class="'.$color[0].'"" style="text-decoration: none; border: 0;padding: 0"  ><i class="  fa '. $isLiked.' liked iconlike'.$new->id.'" data-id="'.$new->id.'" data-url="'.App::url("news/likes").'"></i>&nbsp;</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        ';
                    }
                    ?>
                </div>

            </div><!-- .blog-container -->

            <div class="ui-pricing-footer mb-5">
                <p class="paragraph">
                    Pour plus d'informations et de details contactez nous
                </p>
                <div class="actions">
                    <a href="<?=App::url("contact")?>" class="btn-link btn-arrow">Contactez nous</a><br>
                </div>
            </div>
        </div><!-- .container -->

        <div class="modal fade" id="newsModal" style="width: 100% !important;">
            <input type="hidden" value="0" id="isconnect">
            <div class="modal-dialog ">
                <div class="modal-content"  style="width: 140% ; margin: 0 auto;right: 160px; !important;" >
                    <div class="modal-header" style="background-color: rgba(0, 9, 128, 0.05);">
                        <span class="close" data-dismiss="modal">&times;</span>
                        <div class="modal-title"><h4 id="newsTitle">Details de la news</h4></div>
                    </div>
                    <div class="modal-body " style="height: 450px; overflow-x: auto; background-color: rgba(0, 9, 128, 0.05); ">
                        <div  class="media p-3">
                            <div class="media-left">
                                <img src="" alt="photo" id="commentImg" class="img-rounded" style="height: 200px">
                            </div>
                            <div class="media-body text-justify" id="newsMessage"></div>
                        </div>
                        </br>
                        <h4>Commentaires <small id="nbreCommentaires"></small></h4>
                        </br>
                        <div id="mediaContainer"></div>
                    </div>
                    <div class="modal-footer" style="background-color: rgba(0, 9, 128, 0.05);">
                        <form id="commentForm" action="<?=App::url("news/comment")?>" method="POST" class="container-fluid">
                            <input type="hidden" id="idParent"  name="idParent">
                            <div class="row" >
                                <?php
                                $valNom = '';
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
                                ?>

                                <div class="col-md-2 <?=$isHidden?>">
                                    <div class="form-group" ><input type="text"  required id="commentPseudo" style="background: white;margin-top: 15px" placeholder="nom ou pseudo" class="form-control" value="<?=$valNom?>">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <textarea cols="30" rows="2" class="form-control" required placeholder="Laissez un commentaire" style="background: white; height: 80px;" id="commentField"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-dark btn-sm" style="height: 50px;margin-top: 15px" id="newsComment" >commentez</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>