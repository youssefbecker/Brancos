/**
 * Created by Ndjeunou on 03/08/2017.
 */
$(document).ready(function(){

    $(document).on('submit','#contacteForm',function (e) {
        e.preventDefault();
        var name = $('#name').val(),
            email = $('#email').val(),
            numero = $('#numero').val(),
            sujet = $('#sujet').val(),
            message = $('#message').val(),
            url = $(this).attr('action');
        if (name!='' && email!='' && numero!='' && sujet!='' && message!='' && url!=''){
            $.ajax({
                type: 'post',
                url: url,
                data: 'name='+name+'&email='+email+'&sujet='+sujet+'&numero='+numero+'&message='+message,
                datatype: 'json',
                beforeSend: function () {
                    $('#submit_btn').text('Chargement... ').prop('disabled',true);
                    run_waitMe(current_effect,loadingText);
                },
                success: function (json) {
                    if (json.statuts == 0){
                        $('#name').val('');
                        $('#email').val('');
                        $('#numero').val('');
                        $('#sujet').val('');
                        $('#message').val('');
                        alertify.alert(json.mes);
                    }else{
                        alertify.alert(json.mes);
                    }
                },
                complete: function () {
                    $('#submit_btn').text('Envoyez le message').prop('disabled',false);
                    dismiss_waitMe();
                },
                error: function(jqXHR, textStatus, errorThrown){
                    dismiss_waitMe();
                }
            });
        }else{
            alertify.alert('Veuillez remplir tous les champs');
        }
    });

});