/**
 * Created by Ndjeunou on 03/08/2017.
 */
$(document).ready(function () {
    $(document).ready(function() {
        $('#besoin').multiselect();
    });
    $(document).on('submit','#commandForm',function (e){
        e.preventDefault();
        var url = $(this).attr('action'),
        $form = $(this),
        act = $('#submit_btn').text(),
        formdata = (window.FormData) ? new FormData($form[0]) : null,
        datas = (formdata !== null) ? formdata : $form.serialize();
        $.ajax({
            type: 'POST',
            url: url,
            data: datas,
            contentType: false,
            processData: false,
            datatype: 'json',
            beforeSend: function () {
                $('#submit_btn').prop('disabled',true).text('Chargement... ');
            },
            success: function (json) {
                if (json.statuts == 0){
                    toastr.success(json.mes,"Succès");
                    if (json.lien) {
                        window.location.assign(json.lien);
                    } else {
                        window.location.reload();
                    }
                }else{
                    //window.location.assign("http://brancos.log/login");
                    toastr.error(json.mes,"Error!!!");
                }
            },
            complete: function () {
                $('#submit_btn').prop('disabled',false).text(act);
            },
            error: function(jqXHR, textStatus, errorThrown){
            }
        });
    });

    $(document).on('change','#type',function (e) {
        var valeur= $('#type').val();
        if(valeur=="web"){
            $('#description').html('<option value="">Description de l\'application</option>\n' +
                '                                        <option value="web">Site Web</option>\n' +
                '                                        <option value="gestion">Application de Gestion</option>\n' +
                '                                        <option value="planification">Application de plannification</option>');
        }
        if(valeur=="smartphone"){
            $('#description').html('<option value="">Description de l\'application</option>\n' +
                '                                        <option value="android">Application Android</option>\n' +
                '                                        <option value="ios">Application IOS</option>\n' +
                '                                        <option value="windows">Application Windows Phone</option>');
        }
        if(valeur=="desktop"){
            $('#description').html('<option value="">Descriptype de l\'application</option>\n' +
                '                                        <option value="java">Application Java</option>\n' +
                '                                        <option value="python">Application Python</option>\n' +
                '                                        <option value="c++">Application C++</option>');
        }
    });
    $(document).on('click','.newCommand', function (e) {
        e.preventDefault();
        $('#titleCommande').html("Passer une commande");
        $('#description').val("");
        $('#idCommande').val("");
        $('#web').prop('checked','');
        $('#desktop').prop('checked','');
        $('#domaine').prop('checked','');
        $('#site').prop('checked','');
        $('#hebergement').prop('checked','');
        $('#mobile').prop('checked','');
        $('#submit_btn').text('Demander un devis');
        $('#charge').val("");
    });

});