$(document).ready(function(){

    $(document).on('click', '.btnShowDevis', function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        //alert(id);
        $.ajax({
            type: 'get',
            url: "http://brancos.log/commandes/showDevis?id="+id,
            processData: false,
            contentType: false,
            datatype: 'json',
            success: function (json) {
                if (json.statuts == 0){
                    $('#containerDevis').html(json.mes);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        });
    });
    $(document).on('click','.details', function(e){
        e.preventDefault();
        var url = $(this).data('url'),
            id = $(this).data('id');
        if(url!='') {
            $.ajax({
                type: 'post',
                url: url,
                data: 'id=' + id,
                datatype: 'json',
                beforeSend: function () {
                    $('.loader').removeClass('hide');
                    $('#containerDetails').html('').addClass('hide');
                },
                success: function (json) {
                    $('#title').html(json.entete);
                    $('#containerDetails').html(json.content);
                },
                complete: function () {
                    $('.loader').addClass('hide');
                    $('#containerDetails').removeClass('hide');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                }
            });
        }
    });
    $(document).on('click','.deleteCommande', function(e){
        e.preventDefault();
        var url = $(this).data('url'),
            id = $(this).data('id');
        if(url!='') {
            $.ajax({
                type: 'post',
                url: url,
                data: 'id=' + id,
                datatype: 'json',
                beforeSend: function () {
                },
                success: function (json) {
                    if (json.statuts==0) {
                        toastr.success(json.mes,"Succès");
                        window.location.reload();

                    } else {
                        toastr.error(json.mes,"Error");
                        window.location.reload();
                    }
                },
                complete: function () {
                },
                error: function (jqXHR, textStatus, errorThrown) {
                }
            });
        }
    });
    $(document).on('click','.updateCommande', function(e){
        e.preventDefault();
        var url = $(this).data('url'),
            id = $(this).data('id');
        if(url!='') {
            $.ajax({
                type: 'post',
                url: url,
                data: 'id=' + id,
                datatype: 'json',
                beforeSend: function () {
                },
                success: function (json) {
                    var besoins = json.besoins;
                    for (var i=0 ; i < besoins.length; i++){
                        $("#besoin").multiselect("widget").find(":checkbox[value='"+besoins[i]+"']").attr("checked","checked");
                        //$('#besoin option[value="'+besoins[i]+'"]').attr("selected",1);
                        //$("#besoin").multiselect("refresh");
                    }
                    $('#titleCommande').html(json.titre);
                    $('#description').val(json.description);
                    $('#idCommande').val(json.idCommande);
                    $('#submit_btn').text('Modifier la commande');
                },
                complete: function () {
                },
                error: function (jqXHR, textStatus, errorThrown) {
                }
            });
        }
    });
    $(document).on('click','.charge', function (e) {
        e.preventDefault();
        var reference = $(this).data('reference'),
            id = $(this).data('id'),
            action = $(this).data('action');
        $('#idCommande').val(id);
        $('.titleCharge').text(action.toUpperCase()+" LE CAHIER DE CHARGES DE "+reference);
        $('.chargeBtn').text(action.toUpperCase());
    });
    $(document).on('submit','#chargeForm',function (e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();
        var act = $('.chargeBtn').text;
        $.ajax({
            type: 'post',
            url: url,
            data: data,
            contentType: false,
            processData: false,
            datatype: 'json',
            beforeSend: function () {
                $('.chargeBtn').text('Chargement...').prop('disabled',true);
            },
            success: function (json) {
                if (json.statuts == 0){
                    toastr.success(json.mes,'Succès!');
                    window.location.reload();
                }else{
                    toastr.error(json.mes,'Oups!');
                }
            },
            complete: function () {
                $('.chargeBtn').text(act).prop('disabled',false);
            },
            error: function(jqXHR, textStatus, errorThrown){}
        });
    });
});