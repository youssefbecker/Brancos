var requiredField = "Renseigner tous les champs requis";
var loadingText = "Chargement en cours... <br> veuillez patienter un moment le traitement de votre requête...";
function showAlert($form,$type,$message,redirect) {
    removeAlert();
    var $classe = '';
    if($type===1){
        $classe = ' alert-success';
        $message += redirect==1 ? '<br>Redirection en cours, veuillez patienter SVP' : '';
        if(redirect==1)
            $form.find('*').prop('disabled',true);
    }else{
        $classe = ' alert-danger';
    }
    $form.prepend('<div class="alerterForm alert text-center alert-dismissible'+$classe+'">' +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
        '<span>'+$message+'</span></div>');
}
function number_format (number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}
function thousand(number) {
    return number_format(number,0,',',' ');
}
function removeAlert() {
    $('.alerterForm').remove();
}
function loadRegion(val,is,idSous) {
    $.ajax({
        type: 'post',
        url: 'https://www.afrikfid.boutique/localisation/loader',
        data: 'val='+val,
        datatype: 'json',
        beforeSend: function () {},
        success: function (json) {
            if (json.statuts == 0) {
                var valText = is?'Chercher par la région':'.....';
                var con = '<option value="">'+valText+'</option>';
                $('#'+idSous).html('').html(con+json.contenu);
            }
        },
        complete: function () {},
        error: function (jqXHR, textStatus, errorThrown) {
        }
    });
}
function DateRanges(debut,fin) {
    var $dp_start = $('#'+debut),
        $dp_end = $('#'+fin);
    $($dp_start).datepicker({
        format: 'dd-mm-yyyy',
        todayBtn:  1,
        autoclose: true
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $dp_end.datepicker('setStartDate', minDate);
        setTimeout(function () {
            $dp_end.focus();
        }, 300);
    });

    $($dp_end).datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    }).on('changeDate', function (selected) {
        var maxDate = new Date(selected.date.valueOf());
        $dp_start.datepicker('setEndDate', maxDate);
    });
}
DateRanges('debut','end');
function run_waitMe(effect,text){
    $('body').waitMe(
        {
            effect: effect,
            text: text,
            bg: 'rgba(255,255,255,0.9)',
            color: '#000',
            maxSize: '',
            waitTime: -1,
            source: '',
            textPos: 'vertical',
            fontSize: '',
            onClose: function() {}
        })
    ;
}
function dismiss_waitMe(){
    $('body').waitMe('hide');
}
function handle(){
    return imReady;
}
var imReady = false;
var current_effect = 'roundBounce';
function setReady(){
    imReady = true;
}
$(document).ready(function () {
    setReady();
    if($('.alertJss').text() != ''){
        alertify.success($('.alertJss').text());
    }
    if($('.alertJs').text() != ''){
        alertify.error($('.alertJs').text());
    }
    $(document).on('change', '#pays', function (e) {
        e.preventDefault();
        var val = $(this).val();
        loadRegion(val,false,'region');
    });
    $(document).on('change', '#pays', function (e) {
        e.preventDefault();
        var val = $(this).val();
        loadRegion(val,false,'ville');
    });
    $(document).on('submit', '.newForm', function (e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();
        var $btn = $(this).find('.newBtn'),
            act = $btn.html(),
            loading = $('.newBtn').data('load');
        $.ajax({
            type: 'post',
            url: url,
            data: data,
            contentType: false,
            processData: false,
            datatype: 'json',
            beforeSend: function () {
                $btn.html(loadingText).prop('disabled', true);
                run_waitMe(current_effect,loading);
            },
            success: function (json) {
                if (json.statuts == 0) {
                    if(!$btn.hasClass('noAlert')){
                        if($btn.hasClass('noRedirect')){
                            showAlert($form,1,json.mes,2);
                        }else{
                            showAlert($form,1,json.mes,1);
                        }
                    }
                    alertify.success(json.mes);
                    if($btn.hasClass('willRedirect')){
                        window.location.assign(json.direct);
                    }else{
                        if($btn.hasClass('noRedirect')){
                            $form.find('input').val('');
                        }else{
                            window.location.reload();
                        }
                    }
                } else {
                    alertify.error(json.mes);
                    if(!$btn.hasClass('noAlert')){
                        showAlert($form,2,json.mes,1);
                    }
                }
            },
            complete: function () {
                $btn.html(act).prop('disabled', false);
                dismiss_waitMe();
            },
            error: function (jqXHR, textStatus, errorThrown) {}
        });
    });

    $(document).on('click', '.removeCart1', function (e) {
        e.preventDefault();
        var btn = $(this),
            id = btn.data('id');
        if (id != '') {
            removeCart1(id,btn);
        } else {
            alertify.error("Renseigner tous les champs requis");
        }
    });
    $(document).on('click', '.delCart', function (e) {
        e.preventDefault();
        var btn = $(this),
            id = btn.data('id'),
            parent = btn.parent().parent();
        if (id != '') {
            removeCart(id,btn,parent,true);
        } else {
            alertify.error("Renseigner tous les champs requis");
        }
    });
    $(document).on('click', '.removeCart', function (e) {
        e.preventDefault();
        var btn = $(this),
            id = btn.data('id'),
            parent = btn.parent().parent().parent().parent().parent();
        if (id != '') {
            removeCart(id,btn,parent,false);
        } else {
            alertify.error("Renseigner tous les champs requis");
        }
    });
    function removeCart1(id,btn){
        $.ajax({
            type: 'post',
            url: 'https://www.afrikfid.boutique/cart/removed',
            data: 'id='+id,
            datatype: 'json',
            beforeSend: function () {
                btn.prop('disabled', true);
                run_waitMe(current_effect,loadingText);
            },
            success: function (json) {
                if (json.statuts == 0) {
                    alertify.success(json.mes);
                    $('#contenuCard').html('').html(json.contenu);
                    $('.absolute').text(json.nbre);
                    $('.totalCard').text(json.total);
                    $('.rebuildTableBody').html('').html(json.contenus);
                    if(json.total==0){
                        $('.footTotalCart').remove();
                    }else{
                        $('.totalCard').text(json.total);
                    }
                } else {
                    alertify.alert(json.mes);
                }
            },
            complete: function () {
                btn.prop('disabled', false);
                dismiss_waitMe();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                dismiss_waitMe();
            }
        });
    }
    function removeCart(id,btn,parent,bool){
        $.ajax({
            type: 'post',
            url: 'https://www.afrikfid.boutique/cart/remove',
            data: 'id='+id,
            datatype: 'json',
            beforeSend: function () {
                btn.prop('disabled', true);
                run_waitMe(current_effect,loadingText);
            },
            success: function (json) {
                if (json.statuts == 0) {
                    alertify.success(json.mes);
                    $('#contenuCard').html('').html(json.contenu);
                    $('.absolute').text(json.nbre);
                    $('.totalCard').text(json.total);
                    if(parent!=""){
                        parent.remove();
                    }
                    if(bool){
                        $('.rebuildTableBody').html('').html(json.contenus);
                    }
                    if(json.total==0){
                        $('.footTotalCart').remove();
                    }else{
                        $('.totalCard').text(json.total);
                    }
                } else {
                    alertify.alert(json.mes);
                }
            },
            complete: function () {
                btn.prop('disabled', false);
                dismiss_waitMe();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                dismiss_waitMe();
            }
        });
    }
    $(document).on('click', '.emptyCard', function (e) {
        e.preventDefault();
        var btn = $(this);
        $.ajax({
            type: 'post',
            url: 'https://www.afrikfid.boutique/cart/removeAll',
            datatype: 'json',
            beforeSend: function () {
                btn.prop('disabled', true);
                run_waitMe(current_effect,loadingText);
            },
            success: function (json) {
                if (json.statuts == 0) {
                    alertify.success(json.mes);
                    $('#contenuCard').html('').html(json.contenu);
                    $('.absolute').text(json.nbre);
                    $('.totalCard').text(json.total);
                    if($('.removeCart').length){
                        window.location.reload();
                    }
                } else {
                    alertify.alert(json.mes);
                }
            },
            complete: function () {
                btn.prop('disabled', false);
                dismiss_waitMe();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                dismiss_waitMe();
            }
        });
    });
    $(document).on('click', '.saveCard', function (e) {
        e.preventDefault();
        var btn = $(this);
        $.ajax({
            type: 'post',
            url: 'https://www.afrikfid.boutique/cart/save',
            datatype: 'json',
            beforeSend: function () {
                btn.prop('disabled', true);
                run_waitMe(current_effect,loadingText);
            },
            success: function (json) {
                if (json.statuts == 0) {
                    alertify.success(json.mes);
                    window.location.assign(json.direct);
                    //$('#contenuCard').html('').html(json.contenu);
                    //$('.absolute').text(json.nbre);
                } else {
                    alertify.alert(json.mes);
                }
            },
            complete: function () {
                btn.prop('disabled', false);
                dismiss_waitMe();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                dismiss_waitMe();
            }
        });
    });
    $(document).on('click', '.addList', function (e) {
        e.preventDefault();
        var btn = $(this),
            id = btn.data('id');
        if (id != '') {
            $.ajax({
                type: 'post',
                url: 'https://www.afrikfid.boutique/list/add',
                data: 'id='+id,
                datatype: 'json',
                beforeSend: function () {
                    btn.prop('disabled', true);
                    run_waitMe(current_effect,loadingText);
                },
                success: function (json) {
                    if (json.statuts == 0) {
                        alertify.success(json.mes);
                    } else {
                        alertify.error(json.mes);
                    }
                },
                complete: function () {
                    btn.prop('disabled', false);
                    dismiss_waitMe();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    dismiss_waitMe();
                }
            });
        } else {
            alertify.error("Renseigner tous les champs requis");
        }
    });
    $(document).on('click', '.addCart', function (e) {
        e.preventDefault();
        var btn = $(this),
            id = btn.data('id')/*,
                            spinner = btn.parent().parent().find('.spinner')*/;
        if (id != '') {
            addCart(id,btn,/*spinner,*/false,1);
        } else {
            alertify.error("Renseigner tous les champs requis");
        }
    });
    $(document).on('click', '.addCart1', function (e) {
        e.preventDefault();
        var btn = $(this),
            id = btn.data('id');
        if (id != '') {
            addCart(id,btn,/*"",*/true,1);
        } else {
            alertify.error("Renseigner tous les champs requis");
        }
    });
    $(document).on('click', '.addCart2', function (e) {
        e.preventDefault();
        var btn = $(this),
            id = btn.data('id'),
            nbre = $('#produitquantity').val();
        if (id != '') {
            addCart(id,btn,/*"",*/true,nbre);
        } else {
            alertify.error("Renseigner tous les champs requis");
        }
    });
    function addCart(id,btn,/*spinner,*/bool,nbre) {
        $.ajax({
            type: 'post',
            url: 'https://www.afrikfid.boutique/cart/add',
            data: 'id='+id+'&nbre='+nbre,
            datatype: 'json',
            beforeSend: function () {
                btn.prop('disabled', true);
                run_waitMe(current_effect,loadingText);
            },
            success: function (json) {
                if (json.statuts == 0) {
                    alertify.success(json.mes);
                    $('#contenuCard').html('').html(json.contenu);
                    $('.absolute').text(json.nbre);
                    $('.totalCard').text(json.total);
                    if(bool){
                        $('.rebuildTableBody').html('').html(json.contenus);
                    }
                } else {
                    alertify.alert(json.mes);
                }
            },
            complete: function () {
                btn.prop('disabled', false);
                dismiss_waitMe();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                dismiss_waitMe();
            }
        });
    }
    $.ajax({
        type: 'post',
        url: 'https://www.afrikfid.boutique/cart/load',
        datatype: 'json',
        beforeSend: function () {},
        success: function (json) {
            if (json.statuts == 0) {
                $('#contenuCard').html('').html(json.contenu);
                $('.absolute').text(json.nbre);
                $('.totalCard').text(json.total);
            }
        },
        complete: function () {},
        error: function (jqXHR, textStatus, errorThrown) {}
    });
    $(document).on('submit','#addEmailForm',function (e) {
        e.preventDefault();
        var email = $('#emailNews').val(),
            url = $(this).attr('action');
        if (email!=''){
            $.ajax({
                type: 'post',
                url: url,
                data: 'email='+email,
                datatype: 'json',
                beforeSend: function () {
                    $('#btnNews').prop('disabled',true);
                    run_waitMe(current_effect,loadingText);
                },
                success: function (json) {
                    if(json.statuts == 0){
                        $('#emailNews').val('');
                    }
                    alertify.alert(json.mes);
                },
                complete: function () {
                    $('#btnNews').prop('disabled',false);
                    dismiss_waitMe();
                },
                error: function(jqXHR, textStatus, errorThrown){
                    dismiss_waitMe();
                }
            });
        }else{
            alertify.error('Veuillez remplir l\'adresse email');
        }
    });
    $('.atrti-content p').css("font-weight","bold !important");
});