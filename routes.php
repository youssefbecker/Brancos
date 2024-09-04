<?php
/**
 * Created by PhpStorm.
 * User: Ndjeunou
 * Date: 29/10/2016
 * Time: 12:39
 */
return
    [
        ""=>'\Projet\Controller\Site\HomeController#index',
        "get_current_date"=>'\Projet\Controller\Site\HomeController#get_date',
        "error"=>'\Projet\Controller\Site\HomeController#error',
        "contact"=>'\Projet\Controller\Site\AboutController#contact',
        "produits"=>'\Projet\Controller\Site\HomeController#produits',
        "services"=>'\Projet\Controller\Site\NewsController#services',
        "realisations"=>'\Projet\Controller\Site\NewsController#references',
        "realisations/detail2"=>'\Projet\Controller\Site\NewsController#detail2',
        "realisation"=>'\Projet\Controller\Site\NewsController#realisation',
        "realisation/details"=>'\Projet\Controller\Site\NewsController#details',
        "realisation/details/view"=>'\Projet\Controller\Site\NewsController#detailsRealisation',
        "news/details/view"=>'\Projet\Controller\Site\NewsController#detailsNews',
        "realisation/comment"=>'\Projet\Controller\Site\NewsController#comments',
        "realisation/comment/isHavePermission"=>'\Projet\Controller\Site\NewsController#isHavePermission',
        "realisation/likes"=>'\Projet\Controller\Site\NewsController#likes',
        "news"=>'\Projet\Controller\Site\NewsController#index',
        "news/detail"=>'\Projet\Controller\Site\NewsController#detail',
        "news/comment"=>'\Projet\Controller\Site\NewsController#comment',
        "news/likes"=>'\Projet\Controller\Site\NewsController#like',
        "about"=>'\Projet\Controller\Site\AboutController#index',
        "about/subscribe"=>'\Projet\Controller\Site\AboutController#subscribe',
        "about/contact/save"=>'\Projet\Controller\Site\AboutController#save',
        "devis/new"=>'\Projet\Controller\Site\AboutController#newDevis',
        "about/team"=>'\Projet\Controller\Site\AboutController#team',
        "about/story"=>'\Projet\Controller\Site\AboutController#story',
        "references"=>'\Projet\Controller\Site\NewsController#references',
        "about/clients"=>'\Projet\Controller\Site\AboutController#contact',
        "price"=>'\Projet\Controller\Site\HomeController#price',
        "contact/save"=>'\Projet\Controller\Site\AboutController#save',

        "subscribe"=>'\Projet\Controller\Site\AboutController#subscribe',
        "email"=>'\Projet\Controller\Site\AboutController#email',

        "boutique"=>'\Projet\Controller\Site\AboutController#boutique',
        "sms_api/commande"=>'\Projet\Controller\Membre\AccountController#commandeSms',
"login"=>'\Projet\Controller\Page\AuthController#login',
        "logout"=>'\Projet\Controller\Page\HomeController#logout',
        "login/log"=>'\Projet\Controller\Site\HomeController#log',
        "login/reset"=>'\Projet\Controller\Site\HomeController#resetPassword',
        "login/confirmCode"=>'\Projet\Controller\Site\HomeController#confirmCode',
        "login/newPassword"=>'\Projet\Controller\Site\HomeController#newPassword',
        "login/register"=>'\Projet\Controller\Site\HomeController#register',

        "groupes"=>'\Projet\Controller\Membre\GroupeController#index',
        "groupes/add"=>'\Projet\Controller\Membre\GroupeController#add',
        "groupes/delete"=>'\Projet\Controller\Membre\GroupeController#delete',
        "groupes/contacts"=>'\Projet\Controller\Membre\GroupeController#contacts',
        "groupes/contact/add"=>'\Projet\Controller\Membre\GroupeController#addContact',
        "groupes/contact/delete"=>'\Projet\Controller\Membre\GroupeController#deleteContact',

        "campagnes"=>'\Projet\Controller\Membre\EvenementController#evenement',
        "campagnes/add"=>'\Projet\Controller\Membre\EvenementController#addEvenement',
        "campagnes/rappels"=>'\Projet\Controller\Membre\EvenementController#rappels',
        "campagnes/rappels/add"=>'\Projet\Controller\Membre\EvenementController#addRappel',
        "campagnes/rappels/delete"=>'\Projet\Controller\Membre\EvenementController#deleteRappel',
        "campagnes/contacts"=>'\Projet\Controller\Membre\EvenementController#contacts',
        "campagnes/contact/add"=>'\Projet\Controller\Membre\EvenementController#addContact',
        "campagnes/groupe/add"=>'\Projet\Controller\Membre\EvenementController#addGroupe',
        "campagnes/contact/delete"=>'\Projet\Controller\Membre\EvenementController#deleteContact',

        "account"=>'\Projet\Controller\Membre\AccountController#account',
        "messages"=>'\Projet\Controller\Membre\AccountController#message',
        "archives"=>'\Projet\Controller\Membre\AccountController#history',
        "messages/sent"=>'\Projet\Controller\Membre\ApiController#sendSMS',
        "goToAuth"=>'\Projet\Controller\Membre\AccountController#goToAuth',

        "contacts"=>'\Projet\Controller\Membre\ContactController#contact',
        "contact/excell/add"=>'\Projet\Controller\Membre\ContactController#excell',
        "contact/add"=>'\Projet\Controller\Membre\ContactController#addContact',
        "contact/delete"=>'\Projet\Controller\Membre\ContactController#deleteContact',

        "licenses"=>'\Projet\Controller\Membre\LicenseController#index',
        "licenses/detail"=>'\Projet\Controller\Membre\LicenseController#detail',

        "commandes"=>'\Projet\Controller\Membre\CommandeController#commandes',
        "commandes/showDevis"=>'\Projet\Controller\Membre\CommandeController#showDevis',
        "commander"=>'\Projet\Controller\Membre\CommandeController#commander',
        "commander/new"=>'\Projet\Controller\Membre\CommandeController#saveCommande',
        "commande/save"=>'\Projet\Controller\Membre\CommandeController#command',
        "commandes/details"=>'\Projet\Controller\Membre\CommandeController#detailsCommande',
        "commandes/update"=>'\Projet\Controller\Membre\CommandeController#updateCommande',
        "commandes/delete"=>'\Projet\Controller\Membre\CommandeController#deleteCommande',
        "commandes/uploadCharges"=>'\Projet\Controller\Membre\CommandeController#uploadCharges',

        "solde/get"=>'\Projet\Controller\Membre\ApiController#getSolde',
        "sms/send"=>'\Projet\Controller\Membre\ApiController#sendSMS',
        "sms/historique"=>'\Projet\Controller\Membre\ApiController#historique',

        "api/sms/send"=>'\Projet\Controller\Page\HomeController#send',
    ];