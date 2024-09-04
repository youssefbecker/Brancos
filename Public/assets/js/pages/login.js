$(document).ready(function () {
    $(document).on('submit', '#loginForm', function (e) {
        e.preventDefault();
        var url = $(this).attr('action');
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
                $('#submit_login').prop('disabled', true).val('Chargement... ');
            },
            success: function (json) {
                if (json.statuts == 0) {
                    toastr.success(json.mes, "succès");
                    window.location.assign(json.direct);
                } else {
                    toastr.error(json.mes, "Echec");
                    $("#password").val("");
                }
            },
            complete: function () {
                $('#submit_login').prop('disabled', false).val('commandez');
            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        });
    });

    $(document).on('submit', '#resetForm', function (e) {
        e.preventDefault();
        var url = $(this).attr('action');
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
                $('#submit_password').prop('disabled', true).val('Chargement... ');
            },
            success: function (json) {
                if (json.statuts == 0) {
                    toastr.success(json.mes, "succès");
                    $('#titleReset').html("Code de confirmation");
                    $('#containerReset').html(json.content);
                } else {
                    toastr.error(json.mes, "Echec");
                    $("#resetForm input").val("");
                }
            },
            complete: function () {
                $('#submit_password').prop('disabled', false).val('commandez');
            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        });
    });


    $(document).on('submit', '#confirmCodeForm', function (e) {
        e.preventDefault();
        var url = $(this).attr('action');
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
                $('#submit_code').prop('disabled', true).val('Chargement... ');
            },
            success: function (json) {
                if (json.statuts == 0) {
                    toastr.success(json.mes, "succès");
                    $('#titleReset').html("Réinitialiser votre mot de passe");
                    $('#containerReset').html(json.content);
                } else {
                    toastr.error(json.mes, "Echec");
                    $("#code").val("");
                }
            },
            complete: function () {
                $('#submit_code').prop('disabled', false).val('commandez');
            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        });
    });

    $(document).on('submit', '#newPasswordForm', function (e) {
        e.preventDefault();
        var url = $(this).attr('action');
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
                $('#submit_new_password').prop('disabled', true).val('Chargement... ');
            },
            success: function (json) {
                if (json.statuts == 0) {
                    toastr.success(json.mes, "succès");
                    $('#titleReset').html("Réinitialiser votre mot de passe");
                    window.location.assign(json.url);
                } else {
                    toastr.error(json.mes, "Echec");
                    $("#code").val("");
                }
            },
            complete: function () {
                $('#submit_new_password').prop('disabled', false).val('commandez');
            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        });
    });
});