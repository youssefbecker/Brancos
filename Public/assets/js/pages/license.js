$(document).ready(function(){

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

});