$(document).ready(function () {
    $(document).on('change','#selectAll', function (e) {
        e.preventDefault();
        if($(this).is(':checked'))
            $(".selected").attr('checked',true);
        else
            $(".selected").attr('checked',false);
        setText();
    });
    $(document).on('change','.selected', function(e){
        setText();
    });
    var setText = function(){
        var selecte = selected();
        if ($('.selected').length === selecte.length){
            $('#selectAll').prop('checked',true);
        }else{
            $('#selectAll').prop('checked',false);
        }
    };
    var selected = function(){
        var $selected = [];
        $('input.selected:checkbox:checked').each(function () {
            $selected.push($(this).val());
        });
        return $selected;
    };

    $(document).on('submit', '#messageForm', function (e) {
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
                $('#submit_btn_message').prop('disabled', true).val('Chargement... ');
            },
            success: function (json) {
                if (json.statuts == 0) {
                    toastr.success(json.mes, "succès");
                    //window.location.reload();
                    $('#messageModal').modal('hide');
                }else if( json.statuts == 1){
                    toastr.error(json.mes, "Echec");
                }else{
                    toastr.success(json.mes, "Echec");
                    toastr.warning(json.error, "Avertissement");
                }
            },
            complete: function () {
                $('#submit_btn_message').prop('disabled', false).val('ENVOYER');
            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        });
    });

    $(document).on("click","#check_add_contact", function(e){
        //e.preventDefault();
        var listNum = $('.numero:checked');
        $('#numero').val("");
        for (i=0; i < listNum.length; i++){
            if(i==listNum.length-1)
                $("#numero").val( $('#numero').val()+listNum[i].value);
            else
                $("#numero").val( $('#numero').val()+listNum[i].value+",");
        }
    });

    $(document).on("click","#sendSms", function(e){
        e.preventDefault();
        $('#messageModal').modal();
    });
    $(document).on("click","#selectContact", function(e){
        e.preventDefault();
        $('#contactListModal').modal();
    });
});