<?php
use Projet\Model\App;
$p = substr(explode('?',$_SERVER["REQUEST_URI"])[0],1);
?>
<!--<ul>-->
<!--    <li>-->
<!--        <a class="--><?//= $p=='account'?' active':''; ?><!--" href="--><?//= App::url("account") ?><!--">-->
<!--            <i class="icon-home"></i> Tableau de bord-->
<!--        </a>-->
<!--    </li>-->
<!--    <li>-->
<!--        <a class="--><?//= $p=='commandes'?' active':''; ?><!--" href="--><?//= App::url("commandes") ?><!--">-->
<!--            <i class="icon-basket"></i> Commandes-->
<!--        </a>-->
<!--    </li>-->
<!--    <li>-->
<!--        <a class="--><?//= $p=='licenses'?' active':''; ?><!--" href="--><?//= App::url("licenses") ?><!--">-->
<!--            <i class="icon-key"></i> Licenses-->
<!--        </a>-->
<!--    </li>-->
<!--    <li>-->
<!--        <a class="--><?//= $p=='groupes'||$p=='groupes/contacts'?' active':''; ?><!--" href="--><?//= App::url("groupes") ?><!--">-->
<!--            <i class="icon-folder-alt"></i> Groupes de contacts-->
<!--        </a>-->
<!--    </li>-->
<!--    <li>-->
<!--        <a class="--><?//= $p=='contacts'?' active':''; ?><!--" href="--><?//= App::url("contacts") ?><!--">-->
<!--            <i class="icon-user-follow"></i> Mes contacts-->
<!--        </a>-->
<!--    </li>-->
<!--    <li>-->
<!--        <a class="--><?//= $p=='campagnes'||$p=='campagnes/rappels'||$p=='campagnes/contacts'?' active':''; ?><!--" href="--><?//= App::url("campagnes") ?><!--">-->
<!--            <i class="icon-notebook"></i> Campagnes SMS-->
<!--        </a>-->
<!--    </li>-->
<!--    <li>-->
<!--        <a href="#messageModal" id="sendSms" data-toggle="modal">-->
<!--            <i class="icon-envelope-letter"></i> Nouveau message-->
<!--        </a>-->
<!--    </li>-->
<!--    <li>-->
<!--        <a class="--><?//= $p=='archives'?' active':''; ?><!--" href="--><?//= App::url("archives") ?><!--">-->
<!--            <i class="icon-chart"></i> Archives SMS-->
<!--        </a>-->
<!--    </li>-->
<!--    <li>-->
<!--        <a href="--><?//= App::url("logout") ?><!--">-->
<!--            <i class="fa fa-sign-out text-danger"></i> <span class="text-danger">Déconnexion</span>-->
<!--        </a>-->
<!--    </li>-->
<!--</ul>-->
