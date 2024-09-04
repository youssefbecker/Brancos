<?php
/**
 * Created by PhpStorm.
 * User: Ndjeunou
 * Date: 23/01/2017
 * Time: 09:19
 */

namespace Projet\Controller\Site;


use Exception;
use Projet\Database\Commentaire;
use Projet\Database\Image;
use Projet\Database\Log;
use Projet\Database\News;
use Projet\Database\Produit;
use Projet\Database\Realisation;
use Projet\Database\Service;
use Projet\Model\App;
use Projet\Model\DateParser;
use Projet\Model\Encrypt;

class NewsController extends SiteController
{

    public function index()
    {
        $news = News::all();
        $commentNumber = array();
        foreach ($news as $new) {
            $commentNumber[$new->id] = Commentaire::countBySearchType($new->id, null, null, null, null, 1, null, 1);
        }
        $this->render('site.home.news', compact('news', 'commentNumber'));
    }

    public function realisation()
    {
        $prices = Realisation::searchType();
        $reals = Realisation::all();
        $commentNumber = array();
        foreach ($reals as $real) {
            $commentNumber[$real->id] = Commentaire::countBySearchType(null, $real->id, null, null, null, 1, null, 1);
        }
//        $clients = Temoignage::searchType();
//        $setting = Settings::find(1);
        $this->render('site.home.realisation', compact('prices', 'reals', 'commentNumber'));
    }


    public function services()
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];
            $service = Service::find($id);
            if ($service) {
                $images = Image::searchType(null, null, null, null, $id);
                $this->render('site.news.services', compact('service', 'images'));
            } else {
                App::error();
            }
        } else {
            App::error();
        }
    }

    public function references()
    {
        $realisations = Realisation::all();
        $this->render('site.home.references', compact('realisations'));
    }


    public function likes()
    {
        header("content-type:application/json");
        $return = [];
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $id = $_POST['id'];
            $reference = Realisation::find($id);
            if ($reference) {
                $key = "likeRealisation" . $reference->id;
                $nbreLiked = $reference->liked;
                if (!$this->session->read($key)) {
                    Realisation::setLiked($reference->liked + 1, $id);
                    $nbreLiked += 1;
                    $this->session->write($key, $id);
                    $return = array("statuts" => 0, "mes" => "Merci pour ce like", "nbreLiked" => $nbreLiked);
                } else {
                    $return = array("statuts" => 1, "mes" => "Vous aimez déjà cette réalisation");
                }
            } else {
                $return = array("statuts" => 1, "mes" => "Une erreur est survenue, réessayez svp");
            }
        } else {
            $return = array("statuts" => 0, "mes" => "Une erreur est survenue, réessayez svp");
        }
        echo json_encode($return);
    }
    //Pour liked une news
    public function like()
    {
        header("content-type:application/json");
        $return = [];
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $id = $_POST['id'];
            $reference = News::find($id);
            if ($reference) {
                $key = "likeNews" . $reference->id;
                $nbreLiked = $reference->liked;
                if (!$this->session->read($key)) {
                    News::setLiked($reference->liked + 1, $id);
                    $nbreLiked += 1;
                    $this->session->write($key, $id);
                    $return = array("statuts" => 0, "mes" => "Merci pour ce like", "nbreLiked" => $nbreLiked);
                } else {
                    $return = array("statuts" => 1, "mes" => "Vous aimez déjà cette réalisation");
                }
            } else {
                $return = array("statuts" => 1, "mes" => "Une erreur est survenue, réessayez svp");
            }
        } else {
            $return = array("statuts" => 0, "mes" => "Une erreur est survenue, réessayez svp");
        }
        echo json_encode($return);
    }

    public function detail2()
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];
            $reference = Realisation::find($id);
            if ($reference) {
                Realisation::setVues($reference->vues + 1, $id);
                $vues = $reference->vues > 1 ? $reference->vues . ' vues' : $reference->vues . ' vue';
                $images = Image::searchType(null, null, $id);
                $this->render('site.news.detail2', compact('reference', 'vues', 'images'));
            } else {
                App::error();
            }
        } else {
            App::error();
        }
    }

    public function detailsRealisation()
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = Encrypt::decrypter($_GET['id']);
            $realisation = Realisation::find($id);
            if ($realisation) {
                $comments = Commentaire::searchType(null, null, null, $realisation->id, null, null, null, 1, null, 1);
                $nbreComments = Commentaire::countBySearchType(null, $realisation->id, null, null, null, 1, null, 1);
                Realisation::setVues($realisation->vues + 1, $id);
                $realisation = Realisation::find($id);
                $images = Image::searchType(null, null, $realisation->id);

                $this->render('site.home.detailsRealisation', compact('realisation', 'images', 'comments', 'nbreComments'));
            } else {
                App::error();
            }
        } else {
            App::error();
        }
    }

    public function detailsNews()
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = Encrypt::decrypter($_GET['id']);
            $news = News::find($id);
            if ($news) {
                $comments = Commentaire::searchType(null, null, $news->id, null, null, null, null, 1, null, 1);
                $nbreComments = Commentaire::countBySearchType($news->id, null, null, null, null, 1, null, 1);
                News::setVues($news->vues + 1, $id);
                $news = News::find($id);
                $this->render('site.home.detailsNews', compact('news', 'comments', 'nbreComments'));
            } else {
                App::error();
            }
        } else {
            App::error();
        }
    }


    //détails de la news
    public function detail()
    {
        header("content-type:application/json");
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];
            $new = News::find($id);
            $sousComment = array();
            if ($new) {
                News::setVues($new->vues + 1, $id);
                $nbreVue = $new->vues + 1;
                $comments = Commentaire::searchType(null, null, $new->id, null, null, null, null, 1, null, 1);
                $commentNumber = Commentaire::countBySearchType($new->id, null, null, null, null, 1, null, 1);
                foreach ($comments as $comment) {
                    $sousComment[$comment->id] = Commentaire::searchType(null, null, $new->id, null, null, null, null, 1, $comment->id);
                }
                $nbreComment = (int)$commentNumber->Total;
                //$news = News::alls($id);
                $return = array("statuts" => 0, "mes" => $new, "comment" => $comments, "commentNumber" => $nbreComment, "nbreVue" => $nbreVue, "sousComment" => $sousComment);
            } else {
                $return = array("statuts" => 0, "mes" => "Cette news est indisponible");
            }
        } else {
            $return = array("statuts" => 0, "mes" => "Une erreur est survenue");
        }
        echo json_encode($return);
    }

    //détails de la réalisation
    public function details()
    {
        header("content-type:application/json");
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $id = $_POST['id'];
            $reals = Realisation::find($id);
            $sousComment = array();
            if ($reals) {
                Realisation::setVues($reals->vues + 1, $id);
                $nbreVue = $reals->vues + 1;
                $comments = Commentaire::searchType(null, 5, null, $id, null, null, null, 1, null, 1);
                $images = Image::searchType(null, 5, $reals->id);
                $commentNumber = Commentaire::countBySearchType(null, $reals->id, null, null, null, 1, null, 1);
                foreach ($comments as $comment) {
                    $sousComment[$comment->id] = Commentaire::searchType(null, null, null, $id, null, null, null, 1, $comment->id);
                }
                $nbreComment = (int)$commentNumber->Total;
                $return = array("statuts" => 0, "mes" => $reals, "comment" => $comments, "images" => $images, "commentNumber" => $nbreComment, "nbreVue" => $nbreVue, "sousComment" => $sousComment);
            } else {
                $return = array("statuts" => 0, "mes" => "Cette realisation est indisponible");
            }
        } else {
            $return = array("statuts" => 0, "mes" => "Une erreur est survenue");
        }
        echo json_encode($return);
    }

    //Commenter la news
    public function comment()
    {
        header("content-type:application/json");
        $return = [];
        if (isset($_POST['id']) && is_numeric($_POST['id']) && isset($_POST['idParent']) && isset($_POST['nom']) && isset($_POST['comment'])
            && !empty($_POST['comment'])) {
            $id = $_POST['id'];
            $idParent = $_POST['idParent'];
            $nom = $_POST['nom'];
            $comment = strip_tags($_POST['comment']);
            $news = News::find($id);
            if ($news) {
                $bool = true;
                $message = "";
                if (!empty($idParent) && App::getDBAuth()->isLogged()) {
                    $errorMessage = "Le commentaire auquel vous voulez répondre n'existe pas";
                    $commentaire = Commentaire::find($idParent);
                    if ($commentaire) {
                        if ($commentaire->idNews == $id) {
                            $newIdParent = $commentaire->idParent ? $commentaire->idParent : $idParent;
                            if ($nom != $this->session->read('dbauth')->nom && $nom != $this->session->read('username')) {
                                $message = '<b style="color: #414c5a;">' . trim($commentaire->nom) . '</b>,&nbsp;';
                            }
                            $nom = App::getDBAuth()->isLogged() ? $this->session->read('dbauth')->nom : $this->session->read('username');
                        } else {
                            $bool = $errorMessage;
                        }
                    } else {
                        $bool = $errorMessage;
                    }
                }
                if (is_bool($bool)) {
                    $pdo = App::getDb()->getPDO();
                    try {
                        $pdo->beginTransaction();
                        Commentaire::saveNews($news->id, $message . $comment, $nom);
                        $lastId = Commentaire::lastId();
                        if (!empty($newIdParent)) {
                            Commentaire::setIdParent($newIdParent, $lastId);
                        }
                        $com = Commentaire::find($lastId);
                        $date = DateParser::getRelativeDate($com->created_at);
                        $this->session->write('success', "Votre commentaire a été ajouté");
                        $pdo->commit();
                        $return = array("statuts" => 0, "mes" => "Votre commentaire a été ajouté", "comment" => $message . $comment, "nom" => $nom, "lastId" => $lastId, "date" => $date);
                    } catch (Exception $e) {
                        $pdo->rollBack();
                        $return = array("statuts" => 1, "mes" => "une erreur est survenue" . $e->getMessage());
                    }
                } else {
                    $return = array("statuts" => 1, "mes" => $bool);
                }
            } else {
                $return = array("statuts" => 1, "mes" => "une erreur est survenue");
            }
        } else {
            $return = array("statuts" => 1, "mes" => "Veillez renseigner tous les champs!");
        }
        echo json_encode($return);
    }

    /* public function comments(){
         header("content-type:application/json");
         if(isset($_POST['id']) && is_numeric($_POST['id']) && isset($_POST['comment'])
             && !empty($_POST['comment']) && isset($_POST['nom']) && !empty($_POST['nom'])){
             $id = $_POST['id'];
             $comment = strip_tags($_POST['comment']);
             $nom = strip_tags($_POST['nom']);
             $reals = Realisation::find($id);
             if( $reals){
                 $getNbreComment = Commentaire::countBySearchType(null,$reals->id);
                 $nbreCommentaires = $getNbreComment->Total;
                 try{
                     Commentaire::saveRealisation($id , $comment, $nom );
                     $nbreCommentaires += 1;
                     Session::getInstance()->write("username",$_POST['nom']);
                     $return = array("statuts"=>0, "mes"=>Session::getInstance()->read("username").", votre commentaire a été ajouté",'nbreCommentaires'=>$nbreCommentaires);
                 }catch (\Exception $e){
                     $return = array("statuts"=>1,"mes"=>"une erreur est survenue".$e->getMessage());
                 }
             }else{
                 $return = array("statuts"=>1, "mes"=>"une erreur est survenue");
             }
         }else{
             $return = array("statuts"=>1, "mes"=>"renseignez tous les champs");
         }
         echo json_encode($return);
     }*/
    public function isHavePermission()
    {
        header("content-type:application/json");
        $return = [];
        if (App::getDBAuth()->isLogged()) {
            $return = array("statuts" => 0, "mes" => "C'est bon");
        } else {
            $return = array("statuts" => 1, "mes" => "Vous devez vous connecter pour pouvoir chater!!");
        }
        echo json_encode($return);
    }

    //Commenter la réalisation
    public function comments()
    {
        header("content-type:application/json");
        $return = [];
        if (isset($_POST['id']) && is_numeric($_POST['id']) && isset($_POST['idParent']) && isset($_POST['nom']) && isset($_POST['comment'])
            && !empty($_POST['comment'])) {
            $id = $_POST['id'];
            $idParent = $_POST['idParent'];
            $nom = $_POST['nom'];
            $comment = strip_tags($_POST['comment']);
            $realisation = Realisation::find($id);
            if ($realisation) {
                $bool = true;
                $message = "";
                if (!empty($idParent) && App::getDBAuth()->isLogged()) {
                    $errorMessage = "Le commentaire auquel vous voulez répondre n'existe pas";
                    $commentaire = Commentaire::find($idParent);
                    if ($commentaire) {
                        if ($commentaire->idRealisation == $id) {
                            $newIdParent = $commentaire->idParent ? $commentaire->idParent : $idParent;
                            if ($nom != $this->session->read('dbauth')->nom && $nom != $this->session->read('username')) {
                                $message = '<b style="color: #080808;">' . $commentaire->nom . '</b>,&nbsp;';
                            }
                            $nom = App::getDBAuth()->isLogged() ? $this->session->read('dbauth')->nom : $this->session->read('username');
                        } else {
                            $bool = $errorMessage;
                        }
                    } else {
                        $bool = $errorMessage;
                    }
                }
                if (is_bool($bool)) {
                    $pdo = App::getDb()->getPDO();
                    try {
                        $pdo->beginTransaction();
                        Commentaire::saveRealisation($realisation->id, $message . $comment, $nom);
                        $lastId = Commentaire::lastId();
                        if (!empty($newIdParent)) {
                            Commentaire::setIdParent($newIdParent, $lastId);
                        }
                        $com = Commentaire::find($lastId);
                        $date = DateParser::getRelativeDate($com->created_at);
                        $nbreComment = Commentaire::countBySearchType(null, $realisation->id, null, null, null, 1, null, 1);

                        $this->session->write('success', "Votre commentaire a été ajouté");
                        $pdo->commit();
                        $return = array("statuts" => 0, "mes" => "Votre commentaire a été ajouté", "comment" => $message . $comment, "nom" => $nom, "nbreComment" => $nbreComment->Total, "lastId" => $lastId, "date" => $date);
                    } catch (Exception $e) {
                        $pdo->rollBack();
                        $return = array("statuts" => 1, "mes" => "une erreur est survenue" . $e->getMessage());
                    }
                } else {
                    $return = array("statuts" => 1, "mes" => $bool);
                }
            } else {
                $return = array("statuts" => 1, "mes" => "une erreur est survenue");
            }
        } else {
            $return = array("statuts" => 1, "mes" => "Veillez renseigner tous les champs!");
        }
        echo json_encode($return);
    }

    public function produits()
    {
        $produits = Produit::all();
        $this->render('site.home.produits', compact('produits'));
    }

}