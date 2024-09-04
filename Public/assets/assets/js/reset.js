$(document).ready(function () {
    $(document).on('submit','#resetForms', function (e) {
        e.preventDefault();
        var url = $(this).attr('action'),
            email = $('#email').val();
        if(email!=''){
            $.ajax({
                type: 'post',
                url: url,
                data: 'email='+email,
                datatype: 'json',
                beforeSend: function () {
                    $('.errors').addClass('hide');
                    $('.sendBtns').text("Chargement en cours...").prop('disabled',true);
                    run_waitMe(current_effect,loadingText);
                },
                success: function (json) {
                    if(json.statuts == 0){
                        $('#email').val('');
                        $('.errors').removeClass('alert-danger').addClass('alert-success').text(json.mes);
                    }else{
                        alertify.set('notifier','position', 'top-right');
                        alertify.notify(json.mes,'error',5);
                        $('.errors').text(json.mes);
                    }
                },
                complete: function () {
                    $('.sendBtns').text("Réinitialiser").prop('disabled',false);
                    $('.errors').removeClass('hide');
                    dismiss_waitMe();
                },
                error: function(jqXHR, textStatus, errorThrown){
                    dismiss_waitMe();
                }
            });
        }else{
            alertify.set('notifier','position', 'top-right');
            alertify.notify("Renseigner l'adresse mail",'error',5);
            $('.errors').removeClass('hide').text("Renseigner l'adresse mail");
        }
    });
});