<?php
/**
 * Created by PhpStorm.
 * User: Ross
 * Date: 8/23/2018
 * Time: 5:45 AM
 */
use Projet\Model\App;
use Projet\Model\DateParser;
use Projet\Model\FileHelper;
use Projet\Model\StringHelper;

App::addScript("assets/js/pages/addContact.js",true,true);
    App::setTitle("Mon compte");
    App::addScript("assets/js/pages/message.js",true,true);
    $url = substr(explode('?',$_SERVER["REQUEST_URI"])[0],1);
    $laPage = isset($_GET['page'])?$_GET['page']:1;
   // $paginator = new \Projet\Model\Paginator($url,$laPage,$nbrePages,$_GET,$_GET);
?>
<div class="ui-hero hero-sm bg-dark-gray hero-svg-layer-4">
    <div class="container">
        <h1 class="heading">
            <?= App::salutation().ucfirst($user->nom); ?>
        </h1>
        <p class="paragraph">

        </p>
    </div>
</div>
<?php
if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success text-center alert-dismissible" id="alertSuccess"><button  class="close" data-dismiss="alert">&times;</button><span>' . $session->read('success') . '</span></div>';
    $session->delete('success');
}
?>



  



