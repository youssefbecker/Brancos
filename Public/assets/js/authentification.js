/**
 * Created by Ndjeunou on 03/08/2017.
 */
$(document).ready(function(){
    $(document).on('submit','#loginForms', function (e) {
        e.preventDefault();
        var $form = $(this),
            url = $(this).attr('action'),
            login = $('#logins').val(),
            password = $('#passwords').val();
        if(login != '' && password != ''){
            $.ajax({
                type: 'post',
                url: url,
                data: 'login='+login+'&password='+password,
                datatype: 'json',
                beforeSend: function () {
                    $('#logins').prop('disabled',true);
                    $('#passwords').prop('disabled',true);
                    $('.sendBtns').html('Chargement ...').prop('disabled',true);
                    run_waitMe(current_effect,loadingText);
                },
                success: function (json) {
                    if(json.statuts == 0){
                        showAlert($form,1,"Authentification réussie avec succès");
                        window.location.assign(json.direct);
                    }else{
                        showAlert($form,2,json.mes);
                        alertify.error(json.mes);
                    }
                },
                complete: function () {
                    $('#logins').prop('disabled',false);
                    $('#passwords').prop('disabled',false);
                    $('.sendBtns').html('<i class="lnr lnr-lock"></i> Se connecter').prop('disabled',false);
                    dismiss_waitMe();
                },
                error: function(jqXHR, textStatus, errorThrown){
                    dismiss_waitMe();
                }
            });
        }else{
            showAlert($form,2,'Veuillez remplir correctement tous les champs requis');
            alertify.error('Veuillez remplir correctement tous les champs requis');
        }
    });

    $('#naissance').datepicker();

    /*$('#naissance').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        endDate: '-7300d'
    });*/

    $(document).on('submit','#registerForm', function (e) {
        e.preventDefault();
        var $form = $(this),
            url = $(this).attr('action'),
            nom = $('#nom').val(),
            prenom = $('#prenom').val(),
            naissance = $('#naissance').val(),
            sexe = $('#sexe').val(),
            email = $('#email').val(),
            pays = $('#pays').val(),
            region = $('#region').val(),
            adresse = $('#adresse').val(),
            pass = $('#pass').val(),
            fax = $('#fax').val(),
            confirm = $('#confirm').val(),
            numero = $('#numero').val();
        if(nom != '' && prenom != '' && pass != '' && sexe != '' && numero != '' && pays != '' && region != ''){
            if(mode != 0){
                if (pass==confirm){
                    $.ajax({
                        type: 'post',
                        url: url,
                        data: 'nom='+nom+'&naissance='+naissance+'&pays='+pays+'&region='+region+'&email='+email+'&prenom='+prenom+'&adresse='+adresse+'&sexe='+sexe+'&fax='+fax+'&password='+pass+'&numero='+numero,
                        datatype: 'json',
                        beforeSend: function () {
                            $('.sendBtn').html('Chargement ...').prop('disabled',true);
                            run_waitMe(current_effect,loadingText);
                        },
                        success: function (json) {
                            if(json.statuts == 0){
                                showAlert($form,1,json.mes);
                                window.location.assign(json.direct);
                            }else{
                                showAlert($form,2,json.mes);
                                alertify.error(json.mes);
                            }
                        },
                        complete: function () {
                            $('.sendBtn').html('<i class="lnr lnr-user"></i> Enregistrer').prop('disabled',false);
                            dismiss_waitMe();
                        },
                        error: function(jqXHR, textStatus, errorThrown){
                            dismiss_waitMe();
                        }
                    });
                }else{
                    alertify.error('Les mots de passe doivent être identiques');
                    showAlert($form,2,'Les mots de passe doivent être identiques');
                }
            }else{
                showAlert($form,2,'Veuillez accepter les conditions générales d\'utilisation');
                alertify.error('Veuillez accepter les conditions generales d\'utilisation');
            }
        }else{
            showAlert($form,2,'Veuillez remplir correctement tous les champs requis');
            alertify.error('Veuillez remplir correctement tous les champs requis');
        }
    });

    var mode = 0;

    $(document).on('click','.divCheck', function (e) {
        var $input = $(this).find('input[name=filter_opt]');
        if($input.is(':checked'))
            mode = 1;
        else
            mode = 0;
    });

});