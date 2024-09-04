$(document).ready(function () {
    $(document).on('submit', '#addContactForm', function (e) {
        e.preventDefault();
        var url = $(this).data('action');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();
        $.ajax({
            type: 'post',
            url: url,
            data: data,
            processData: false,
            contentType: false,
            datatype: 'json',
            beforeSend: function () {
                $('#submit_add_contact').prop('disabled', true).val('Chargement... ');
            },
            success: function (json) {
                if (json.statuts == 0) {
                    toastr.success(json.mes, "succès");
                    window.location.reload();
                } else {
                    toastr.error(json.mes, "Echec");
                }
            },
            complete: function () {
                $('#submit_add_contact').prop('disabled', false).val('commandez');
            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        });
    });

    $(document).on('submit', '#editContactForm', function (e) {
        e.preventDefault();
        var url = $(this).data('action');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();
        $.ajax({
            type: 'post',
            url: url,
            data: data,
            processData: false,
            contentType: false,
            datatype: 'json',
            beforeSend: function () {
                $('#submit_edit_contact').prop('disabled', true).val('Chargement... ');
            },
            success: function (json) {
                if (json.statuts == 0) {
                    toastr.success(json.mes, "succès");
                    window.location.reload();
                }else{
                    toastr.error(json.mes, "Echec");
                }
            },
            complete: function () {
                $('#submit_edit_contact').prop('disabled', false).val('Modifier');
            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        });
    });

    $('.editButton').on('click', function (e) {
        $('#idContact').val($(this).attr('data-id'));
        $('#editNom').val($(this).attr('data-nom'));
        $('#editNumero').val($(this).attr('data-numero'));
        $('#editEmail').val($(this).attr('data-email'));
    })

    $(document).on('click', '.deleteButton', function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        //alert(id);
        $.ajax({
            type: 'get',
            url: "http://brancos.log/contact/delete?id="+id,
            processData: false,
            contentType: false,
            datatype: 'json',
            success: function (json) {
                if (json.statuts == 0){
                    window.location.reload();
                }else{
                    toastr.error(json.mes, "Echec");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        });
    });

    $(document).on('submit', '#addContactForm2', function (e) {
        e.preventDefault();
        var url = $(this).data('action');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();
        var act = $('.dossierBtn').html();
        $.ajax({
            type: 'post',
            url: url,
            data: data,
            contentType: false,
            processData: false,
            datatype: 'json',
            beforeSend: function () {
                $('.dossierBtn').html('Chargement ...').prop('disabled', true);
            },
            success: function (json) {
                if (json.statuts == 0) {
                    toastr.success(json.mes, "succès");
                    window.location.reload();
                }else{
                    toastr.error(json.mes, "Echec");
                }
            },
            complete: function () {
                $('.dossierBtn').html('').html(act).prop('disabled', false);
            },
            error: function (jqXHR, textStatus, errorThrown) {}
        });
    });
});