/**
 * Created by Ndjeunou on 03/08/2017.
 */
$(document).ready(function(){

    $(document).on('submit','#registerForm', function (e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();
        var pass = $('#pass').val(),
            confirm = $('#confirm').val();
        if (pass==confirm){
            $.ajax({
                type: 'post',
                url: url,
                data: data,
                contentType: false,
                processData: false,
                datatype: 'json',
                beforeSend: function () {
                    $('.sendBtn').html('Chargement ...').prop('disabled',true);
                    run_waitMe(current_effect,loadingText);
                },
                success: function (json) {
                    if(json.statuts == 0){
                        showAlert($form,1,json.mes);
                        window.location.reload();
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
    });

});