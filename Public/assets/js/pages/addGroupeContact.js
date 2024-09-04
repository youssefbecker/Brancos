$(document).ready(function () {
    $(document).on('submit', '#addContactForm', function (e) {
        e.preventDefault();
        var listNum = $('.idGroupe:checked');
        $('#ids').val("");
        for (i=0; i < listNum.length; i++){
            if(i==listNum.length-1)
                $("#ids").val( $('#ids').val()+listNum[i].value);
            else
                $("#ids").val( $('#ids').val()+listNum[i].value+",");
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

    $('.editButton').on('click', function (e) {
        $('#idContact').val($(this).attr('data-id'));
        $('#editNom').val($(this).attr('data-nom'));
        $('#editNumero').val($(this).attr('data-numero'))
    })

    $(document).on('click', '.deleteButton', function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        //alert(id);
        $.ajax({
            type: 'get',
            url: "http://brancos.log/groupes/contact/delete?id="+id,
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

    $(document).on('change','#selectAllGroupe', function (e) {
        e.preventDefault();
        if($(this).is(':checked'))
            $(".selectedGroupe").attr('checked',true);
        else
            $(".selectedGroupe").attr('checked',false);
        setText();
    });
    $(document).on('change','.selected', function(e){
        setText();
    });
    var setText = function(){
        var selecte = selected();
        if ($('.selectedGroupe').length === selecte.length){
            $('#selectAllGroupe').prop('checked',true);
        }else{
            $('#selectAllGroupe').prop('checked',false);
        }
    };
    var selected = function(){
        var $selected = [];
        $('input.selectedGroupe:checkbox:checked').each(function () {
            $selected.push($(this).val());
        });
        return $selected;
    };

});