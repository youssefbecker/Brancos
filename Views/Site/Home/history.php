<?php
/**
 * Created by PhpStorm.
 * User: Ross
 * Date: 8/23/2018
 * Time: 5:45 AM
 */
use Projet\Model\App;
use Projet\Model\FileHelper;
use Projet\Model\StringHelper;

App::setTitle("Historique des SMS");
App::addScript("assets/js/pages/message.js",true);
App::addStyle("https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css",true);
App::addScript("https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js",true);

?>
<div class="ui-hero hero-sm bg-dark-gray hero-svg-layer-4">
    <div class="container">
        <h1 class="heading">
            Historique des SMS
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
                        <div class="docs-content col-md-12">
                            <h4 class="heading mb-4">Historique du service SMS BULK</h4>
                            <table class="table table-striped table-hover table-bordered" id="myTable">
                                <thead>
                                <tr>
                                    <th class="text-center" style="width: 15%">Date envoi</th>
                                    <th class="text-center">Entête</th>
                                    <th class="text-center">Numéro</th>
                                    <th>Message</th>
                                    <th class="text-center">Statut</th>
                                </tr>
                                </thead>
                                <tbody id="histoMessage">
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <img src="<?= FileHelper::url('assets/img/load.gif') ?>" style="height: 20px">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<?php
$script =

    "
        $.ajax({
            type: 'post',
            url: 'http://brancos.log/sms/historique',
            datatype: 'json',
            beforeSend: function () {},
            success: function (json) {
                $('#histoMessage').html(json.contenu);
                $('#myTable').dataTable( {
                    \"lengthMenu\": [ 10, 50, 100, 200, 500 ],
                    \"pageLength\": 50,
                    \"language\": {
                        \"sProcessing\":     \"Traitement en cours...\",
                        \"sSearch\":         \"Rechercher&nbsp;:\",
                        \"sLengthMenu\":     \"Afficher _MENU_ &eacute;l&eacute;ments\",
                        \"sInfo\":           \"Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments\",
                        \"sInfoEmpty\":      \"Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment\",
                        \"sInfoFiltered\":   \"(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)\",
                        \"sInfoPostFix\":    \"\",
                        \"sLoadingRecords\": \"Chargement en cours...\",
                        \"sZeroRecords\":    \"Aucun &eacute;l&eacute;ment &agrave; afficher\",
                        \"sEmptyTable\":     \"Aucune donn&eacute;e disponible dans le tableau\",
                        \"oPaginate\": {
                            \"sFirst\":      \"Premier\",
                            \"sPrevious\":   \"Pr&eacute;c&eacute;dent\",
                            \"sNext\":       \"Suivant\",
                            \"sLast\":       \"Dernier\"
                        },
                        \"oAria\": {
                            \"sSortAscending\":  \": activer pour trier la colonne par ordre croissant\",
                            \"sSortDescending\": \": activer pour trier la colonne par ordre d&eacute;croissant\"
                        },
                        \"select\": {
                                \"rows\": {
                                    _: \"%d lignes séléctionnées\",
                                    0: \"Aucune ligne séléctionnée\",
                                    1: \"1 ligne séléctionnée\"
                                } 
                        }
                    }
                } );
            },
            complete: function () {},
            error: function(jqXHR, textStatus, errorThrown){}
        });
    ";

App::addScript($script);