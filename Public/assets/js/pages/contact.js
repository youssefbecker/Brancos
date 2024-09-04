/**
 * Created by Ndjeunou on 03/08/2017.
 */
$(document).ready(function () {
    $(document).on('submit','#contactForm',function (e) {
        e.preventDefault();
        var name = $('#name').val(),
            email = $('#email').val(),
            numero = $('#numero').val(),
            sujet = $('#sujet').val(),
            message = $('#message').val(),
            url = $('#url').val();
        if (name!='' && email!='' && numero!='' && sujet!='' && message!='' && url!=''){
            $.ajax({
                type: 'post',
                url: url,
                data: 'name='+name+'&email='+email+'&sujet='+sujet+'&numero='+numero+'&message='+message,
                datatype: 'json',
                beforeSend: function () {
                    $('#submit_btn').prop('disabled',true).val('Chargement... ');
                },
                success: function (json) {
                    if (json.statuts == 0){
                        toastr.success(json.mes,"Succès");
                        $('#name').val('');
                        $('#email').val('');
                        $('#numero').val('');
                        $('#sujet').val('');
                        $('#message').val('');
                    }else{
                        toastr.error(json.mes,"Erreur");
                    }
                },
                complete: function () {
                    $('#submit_btn').prop('disabled',true).val('Envoyez le message');
                },
                error: function(jqXHR, textStatus, errorThrown){
                }
            });
        }else{
            toastr.error('Veuillez remplir tous les champs',"Erreur");
        }
    });
    $(document).on('change','#deploiement',function (e) {
        var valeur=$('#deploiement').val();
        if(valeur=="web"){
            $('#descriptif').html('<option value="">Descriptif de l\'application</option>\n' +
                '                                        <option value="web">Site Web</option>\n' +
                '                                        <option value="smart">Application de Gestion</option>\n' +
                '                                        <option value="deskt">Application de plannification</option>');
        }
        if(valeur=="smart"){
            $('#descriptif').html('<option value="">Descriptif de l\'application</option>\n' +
                '                                        <option value="web">Application Android</option>\n' +
                '                                        <option value="smart">Application IOS</option>\n' +
                '                                        <option value="smart">Application Windows Phone</option>');
        }
        if(valeur=="deskt"){
            $('#descriptif').html('<option value="">Descriptif de l\'application</option>\n' +
                '                                        <option value="web">Application Java</option>\n' +
                '                                        <option value="smart">Application Python</option>\n' +
                '                                        <option value="smart">Application C++</option>');
        }
        alert(valeur);
    });

});