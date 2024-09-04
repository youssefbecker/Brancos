<?php
/**
 * Created by PhpStorm.
 * User: youssouf
 * Date: 8/23/2018
 * Time: 5:45 AM
 */
use Projet\Model\App;
use Projet\Model\DateParser;
use Projet\Model\FileHelper;
use Projet\Model\Paginator;
use Projet\Model\StringHelper;

App::addScript("assets/js/pages/addContact.js",true);
    App::setTitle("Mes contacts");
    App::addScript("assets/js/pages/message.js",true);
    $url = substr(explode('?',$_SERVER["REQUEST_URI"])[0],1);
    $laPage = isset($_GET['page'])?$_GET['page']:1;
    $paginator = new Paginator($url,$laPage,$nbrePages,$_GET,$_GET);
?>
<div class="ui-hero hero-sm bg-dark-gray hero-svg-layer-4">
    <div class="container">
        <h1 class="heading">
            Tableau de bord
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

<div class="main" role="main">
    <div id="ui-api-docs" class="section bg-light" style="padding: 1em 0">
        <div class="container">
            <div class="ui-card">
                <div class="card-body">
                    <div class="row">
                        <div class="docs-sidebar col-md-3">
                            <?php require 'Views/Site/Home/side_bar.php'; ?>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="heading">Mes contacts <small>(<?= thousand($nbre->Total); ?>)</small></h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="actions text-right mb-3">
                                        <a href="#modalContact2" data-toggle="modal" class="btn btn-primary text-white"><i class="fa fa-file-excel-o"></i> Import Excell</a>
                                        <a href="#modalContact" data-toggle="modal" class="btn btn-success text-white"><i class="fa fa-plus"></i> Nouveau</a>
                                    </div>
                                </div>
                            </div>
                            <table class="col-md-12 table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Numero</th>
                                    <th>Email</th>
                                    <th class="text-center">Date d'ajout</th>
                                    <th class="text-center">#</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($contacts){
                                    foreach ($contacts as $contact){
                                        echo '
                                                    <tr>
                                                        <td>'. StringHelper::isEmpty($contact->nom).'</td>
                                                        <td>'.$contact->numero.'</td>
                                                        <td>'. StringHelper::isEmpty($contact->email,1).'</td>
                                                        <td class="text-center">'. DateParser::DateShort($contact->created_at,1).'</td> 
                                                        <td class="text-center">
                                                            <a href="#modalEditContact" data-id="'.$contact->id.'" data-nom="'.$contact->nom.'" data-email="'.$contact->email.'" data-numero="'.$contact->numero.'" data-toggle="modal" class="editButton">
                                                                <i class="fa fa-edit text-primary" style="font-size: 2em"></i>
                                                            </a>
                                                            <a href="#" data-id="'.$contact->id.'" data-numero="'.$contact->numero.'" class="deleteButton">
                                                                <i class="fa fa-trash text-danger" style="font-size: 2em"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                ';
                                    }
                                }else{
                                    echo ' <tr class=" mt-5"> <td colspan="5" class="text-center text-danger pt-4">Liste de contacts vide</td></tr>';
                                }
                                ?>
                                </tbody>
                                <?php if(!empty($contacts)){ ?>
                                    <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-right">
                                            <?php $paginator->paginateTwo(); ?>
                                        </td>
                                    </tr>
                                    </tfoot>
                                <?php }?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalContact" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h1 class="modal-title">Ajouter un contact</h1>
            </div>
            <div class="modal-body p-4">
                <form action="#" data-action="<?= App::url("contact/add") ?>" method="post" id="addContactForm">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <input type="hidden" value="" name="id" id="idContact">
                            <input type="tel" class="form-control" placeholder="Numéro de téléphone *" name="numero" id="numero" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <input type="text" class="form-control" name="nom" id="nom" placeholder="Noms et prénoms">
                        </div>
                        <div class="col-md-4 form-group">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Adresse email">
                        </div>
                    </div>
                    <button class="btn btn-dark btn-block" id="submit_add_contact" type="submit">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalContact2" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h1 class="modal-title">Ajouter un fichier de contacts</h1>
            </div>
            <div class="modal-body p-4">
                <form action="#" data-action="<?= App::url("contact/excell/add") ?>" method="post" id="addContactForm2">
                    <p>
                        <ul class="pl-2">
                            <li class="text-warning">Le fichier doit avoir trois colonnes respectivement (Noms + Numéro de téléphone * + Email)</li>
                            <li class="text-warning">Sans titre ni mise en forme</li>
                            <li class="text-warning">Le fichier doit etre de type xls ou xlxs</li>
                        </ul>
                    </p>
                    <div class="form-group">
                        <label for="clientImage">Fichier de contacts (xls ou xlxs) <b>*</b></label>
                        <input type="file" class="form-control" id="clientImage" accept=".xlsx, .xls, .csv" name="client" required>
                    </div>
                    <button class="btn btn-dark btn-block dossierBtn" type="submit">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEditContact" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h1 class="modal-title">Modifier le contact</h1>
            </div>
            <div class="modal-body p-4">
                <form action="#" data-action="<?= App::url("contact/add") ?>" method="post" id="editContactForm">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <input type="hidden" value="" name="id" id="idContact">
                            <input type="tel" class="form-control" placeholder="Numéro de téléphone *" name="numero" id="editNumero" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <input type="text" class="form-control" name="nom" id="editNom" placeholder="Noms et prénoms">
                        </div>
                        <div class="col-md-4 form-group">
                            <input type="email" class="form-control" name="email" id="editEmail" placeholder="Adresse email">
                        </div>
                    </div>
                    <button class="btn btn-dark btn-block" id="submit_edit_contact" type="submit">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require 'Views/Site/Home/modal_sms.php'; ?>