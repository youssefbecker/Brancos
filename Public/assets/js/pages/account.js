$(document).on("click",".editPass", function(e){
    e.preventDefault();
    $('#modalModifierPass').modal();
});
$(document).on("click","#sendSms", function(e){
    e.preventDefault();
    $('#messageModal').modal();
});

$(document).ready(function () {
    $(document).on('submit','#modifierPass',function (e) {
        e.preventDefault();
        var pass = $('#passCourant').val(),
            newPass = $('#newPass').val(),
            newPassC = $('#newPassC').val(),
            url = $(this).attr('action');
        if (pass!='' && newPass!='' && newPassC!='' ){
            if (newPass === newPassC){
                $.ajax({
                    type: 'post',
                    url: url,
                    data: 'pass='+pass+'&newPass='+newPass+'&newPassC='+newPassC,
                    datatype: 'json',
                    beforeSend: function () {
                        $('#submit_btn').prop('disabled',true).val('Chargement... ');
                    },
                    success: function (json) {
                        if (json.statuts == 0){
                            toastr.success(json.mes,"Succès");
                            window.location.reload();
                            $('#passCourant').val('');
                            $('#newPass').val('');
                            $('#newPassC').val('');
                        }else{
                            toastr.error(json.mes,"Erreur");
                        }
                    },
                    complete: function () {
                        $('#submit_btn').prop('disabled',false).text('Modifier le mot de passe');
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                    }
                }); 
            }else{
                toastr.error('Le mot de passe et la confirmation doivent être identiques',"Erreur");   
            }
            
        }else{
            toastr.error('Veuillez remplir tous les champs',"Erreur");
        }
    });
});

$(document).on("click",".editAccount", function(e){
    e.preventDefault();
    var nom = $(this).data('nom'),
        email = $(this).data('email'),
        numero = $(this).data('numero');
    $('#nomCli').val(nom);
    $('#mailCli').val(email);
    $('#numCli').val(numero);
    $('#modalModifierCompte').modal();
});

$(document).on('submit','#modifierCompteForm',function (e) {
    e.preventDefault();
    var nom = $('#nomCli').val(),
        email = $('#mailCli').val(),
        numero = $('#numCli').val(),
        url = $(this).attr('action');
    if (nom !='' && email !='' && numero !='' ){
            $.ajax({
                type: 'post',
                url: url,
                data: 'nom='+nom+'&email='+email+'&numero='+numero,
                datatype: 'json',
                beforeSend: function () {
                    $('#btnCli').prop('disabled',true).val('Chargement... ');
                },
                success: function (json) {
                    if (json.statuts == 0){
                        toastr.success(json.mes,"Succès");
                        $('#nomCli').val('');
                        $('#mailCli').val('');
                        $('#numCli').val('');
                        window.location.reload();
                    }else{
                        toastr.error(json.mes,"Erreur");
                    }
                },
                complete: function () {
                    $('#btnCli').prop('disabled',false).text('Modifier');
                },
                error: function(jqXHR, textStatus, errorThrown){
                }
            }); 
    }else{
        toastr.error('Veuillez remplir tous les champs',"Erreur");
    }
});