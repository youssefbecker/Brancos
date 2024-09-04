<?php
/**
 * Created by PhpStorm.
 * User: Ndjeunou
 * Date: 18/04/2017
 * Time: 13:47
 */
use Projet\Model\App;
use Projet\Model\FileHelper;

App::setTitle('404 Error');
?>

<div class="main" role="main">

    <div class="error404-wrapper">
        <div class="alert alert-secondary"></div>
        <img src="<?= FileHelper::url('assets/img/404/404.svg') ?>" alt="Universal Innnovative Solutions" />
        <h1 class="heading">Oups, Page non trouvée!</h1>
        <p class="lead mb-3">Nous sommes désolés, mais la page que vous cherchiez n'existe pas.</p>
        <a href="<?= App::url('') ?>" class="btn ui-gradient-blue">Page d'accueil</a>
    </div>

</div>
