$(document).ready(function () {
    $(document).on('submit','#placingOrderForm', function (e) {
        e.preventDefault();
        var email = $('#email').val(),
            url = $(this).attr('action');
        if ( email != ''){
            $.ajax({
                type: 'post',
                url: url,
                data: 'email='+email,
                datatype: 'json',
                beforeSend: function () {
                   $('#submit').prop('disabled',true).val('Chargement... ');
                },
                success: function (json) {
                    if (json.statuts == 0){
                        $('#email').val('');
                        toastr.success(json.mes, "Succès");
                    }else{
                        toastr.error(json.mes, "Echec");
                    }
                },
                complete: function () {
                    $('#submit').prop('disabled',false).val('souscrire');
                },
                error: function(jqXHR, textStatus, errorThrown){
                }
            });
        }else{
            toastr.error('Veuillez remplir tous les champs',"error");
        }
    });

    $(document).on('submit','#mc-form', function (e) {
        e.preventDefault();
        var email = $('#mc-email').val(),
            url = $(this).attr('action');
        if ( email != ''){
            $.ajax({
                type: 'post',
                url: url,
                data: 'email='+email,
                datatype: 'json',
                beforeSend: function () {
                    $('#mc-email button').prop('disabled',true).val('Chargement... ');
                },
                success: function (json) {
                    if (json.statuts == 0){
                        $('#mc-email').val('');
                        toastr.success(json.mes, "Succès");
                    }else{
                        toastr.error(json.mes, "Echec");
                    }
                },
                complete: function () {
                    $('#mc-email button').prop('disabled',false).val('souscrire');
                },
                error: function(jqXHR, textStatus, errorThrown){
                }
            });
        }else{
            toastr.error('Veuillez remplir tous les champs',"error");
        }
    });
});