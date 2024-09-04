<?php
use Projet\Model\App;
use Projet\Model\StringHelper;

?>
<div class="modal fade" id="messageModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h1>Envoyez un message</h1>
            </div>
            <div class="modal-body p-4">
                <form action="<?= App::url("messages/sent") ?>" method="post" id="messageForm">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="tel" class="form-control input-group-prepend"
                                   placeholder="Entrer le(s) numéro(s) et séparer par la virgule (,)" name="numero"
                                   id="numero" required style="margin-right: 5px">
                            <a type="button" class="btn btn-dark text-light" data-target="#contactListModal"
                               data-toggle="modal"><i class="fa fa-plus" style="margin-top: 15px"></i></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea name="message" class="form-control" id="message" rows="3"
                                  placeholder="Saisir votre message" required></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-block btn-dark" id="submit_btn_message">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="contactListModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h1>Sélectionner dans votre liste de contacts</h1>
            </div>
            <div class="modal-body p-4">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center"><input type="checkbox" style="height: 20px !important" class="form-control" id="selectAll"></th>
                        <th class="text-left">Nom</th>
                        <th class="text-left">Numéro</th>
                        <th class="text-left">Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($contactsMessage) {
                        foreach ($contactsMessage as $contact) {
                            echo '
                                <tr>
                                    <td class="text-center"><input type="checkbox" style="height: 20px !important" value="' . $contact->numero . '" class="form-control numero selected"></td>
                                    <td class="text-left">' . StringHelper::isEmpty($contact->nom) . '</td>
                                    <td class="text-left">' . $contact->numero . '</td>
                                    <td class="text-left">' . StringHelper::isEmpty($contact->email,1) . '</td>
                                </tr>
                                ';
                        }
                    } else {
                        echo ' <tr class=" mt-5"> <td colspan="3" class="text-center text-danger pt-4">Liste de contact vide</td></tr>';
                    }
                    ?>
                    </tbody>
                </table>
                <button class="btn btn-dark btn-block" data-dismiss="modal" aria-label="Close" id="check_add_contact">Selectionner</button>
            </div>
        </div>
    </div>
</div>