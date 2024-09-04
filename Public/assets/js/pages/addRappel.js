$(document).ready(function () {
    var date = new Date();
    $('.laDate').datepicker({
        format: 'dd-mm-yyyy',
        todayBtn:  1,
        autoclose: true,
        startDate: date
    });
    $(document).on('submit', '#addContactForm', function (e) {
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
        $('#editDate').val($(this).attr('data-date'));
        $('#editEntete').val($(this).attr('data-entete'));
        $('#editContenu').val($(this).attr('data-message'))
    })

    $(document).on('click', '.deleteButton', function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var etat = $(this).data("etat");
        //alert(id);
        $.ajax({
            type: 'get',
            url: "http://brancos.log/campagnes/rappels/delete?id="+id+'&etat='+etat,
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

    $(document).on("keyup",".leContenu",function(event){
        checkTextAreaMaxLength(this,event);
    });
    function checkTextAreaMaxLength(textBox, e) {
        var maxLength = parseInt($(textBox).data("length"));
        if (!checkSpecialKeys(e)) {
            if (textBox.value.length > maxLength - 1) textBox.value = textBox.value.substring(0, maxLength);
        }
        var res = maxLength - textBox.value.length;
        var text = res>1?res+" caractères restants":res+ " caractère restant";
        /*if (res < 0){
            $('#message').css('border-color','#a94442');
        }else{
            $('#message').css('border-color','#3c763d');
        }*/
        $(".char-count").html(text);
        return true;
    }
    function checkSpecialKeys(e) {
        if (e.keyCode != 8 && e.keyCode != 46 && e.keyCode != 37 && e.keyCode != 38 && e.keyCode != 39 && e.keyCode != 40)
            return false;
        else
            return true;
    }

});