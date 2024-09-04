$(document).ready(function () {
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
        $('#editNom').val($(this).attr('data-nom'));
    });

    $(document).on('click', '.deleteButton', function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        //alert(id);
        $.ajax({
            type: 'get',
            url: "http://brancos.log/campagnes/delete?id="+id,
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

    /*
    ***  Ajout des groupes de contacts a une campagne
     */

    $(document).on('submit', '#addContactEvenementForm', function (e) {
        e.preventDefault();
        var listNum = $('.idEvenement:checked');
        $('#idsEvenement').val("");
        for (i=0; i < listNum.length; i++){
            if(i==listNum.length-1)
                $("#idsEvenement").val( $('#idsEvenement').val()+listNum[i].value);
            else
                $("#idsEvenement").val( $('#idsEvenement').val()+listNum[i].value+",");
        }
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
                $('#addEvenement').prop('disabled', true).val('Chargement... ');
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
                $('#addEvenement').prop('disabled', false).val('Enregistrer');
            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        });
    });

    $('.addGroupeButton').on('click', function (e) {
        $('#evenementId').val($(this).attr('data-id'));
    });

    $(document).on('change','#selectAllEvenement', function (e) {
        e.preventDefault();
        if($(this).is(':checked'))
            $(".selectedEvenement").attr('checked',true);
        else
            $(".selectedEvenement").attr('checked',false);
        setText();
    });
    $(document).on('change','.selected', function(e){
        setText();
    });
    var setText = function(){
        var selecte = selected();
        if ($('.selectedEvenement').length === selecte.length){
            $('#selectAllEvenement').prop('checked',true);
        }else{
            $('#selectAllEvenement').prop('checked',false);
        }
    };
    var selected = function(){
        var $selected = [];
        $('input.selectedEvenement:checkbox:checked').each(function () {
            $selected.push($(this).val());
        });
        return $selected;
    };


    /*
    * Fin ajout
     */
});