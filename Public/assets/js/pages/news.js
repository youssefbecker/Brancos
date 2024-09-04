$(function () {
    var nbreComments = 0;
    $('div[data-target="#newsModal"]').on('click',function () {
        $('#newsComment').attr('data-id', $(this).attr('data-id'));
        var id = $('#newsComment').attr('data-id');
        var elt = $("#newsMessage");
        isConnect();
        //verifier si un fichier a deja chargé une fois
        if(true){
            $.ajax({
                url: "news/detail?id=" + id,
                type: "get",
                datatype: "json",
                processData: false,
                contentType: false,
                beforeSend: function () {
                    //load
                },
                complete: function () {
                    //end load
                },
                success: function (json) {
                    if (json.statuts == 0) {
                        nbreComments = json.commentNumber;
                        elt.html(json.mes.contenu);
                        $('#newsTitle').text(json.mes.titre);
                        $('#commentImg').attr("src", json.mes.image);
                        $("#nbreCommentaires").text("("+nbreComments+")");
                        $("#mediaContainer").html(" ");
                        $(".refCommentaire"+id).html(nbreComments);
                        for (var i = 0; i < json.comment.length; i++) {
                            $("#mediaContainer").prepend(buildComment(json.comment[i],json.sousComment[json.comment[i].id]));
                        }
                        $(".refVue"+id).html(json.nbreVue);
                    } else {
                        elt.html(json.mes);
                        toastr.error(json.mes, "Désolé");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){}
            });
        }
    });

    $('#commentForm').on('submit',function (e) {
        e.preventDefault();
        var id = $('#newsComment').attr('data-id'),
            nom = $('#commentPseudo').val(),
            idParent = $('#idParent').val(),
            message = $('#commentField').val(),
            d = new Date(),
            created_at = d.getDate()+"-"+(d.getUTCMonth() + 1)+"-"+d.getFullYear()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds(),
            row = {nom:nom,message:message,created_at:created_at};
        $("#mediaContainer").prepend(buildComment(row));
        $.post($(this).attr('action'),{"comment" : $('#commentField').val(),"idParent" : idParent,"id" : id, "nom" : $('#commentPseudo').val()},function (data) {
            if(data.statuts == 0){
                toastr.success(data.mes, "Succès");
                nbreComments += 1;
                $('#commentField').val('');
                $("#nbreCommentaires").text("("+nbreComments+")");
                $(".refCommentaire"+id).html(nbreComments);
            }else{
                toastr.error(json.mes, "Désolé");
            }
        });
    });

    $(document).on('click','.replySend',function (e) {
        e.preventDefault();
        var id = $('#newsComment').attr('data-id'),
            idParent = $(this).data('id'),
            idCommentParent = $(this).data('idcommentparent'),
            nom =  $(this).data('nom'),
            message = $("#message"+idParent).val(),
            content = '';
        if (message !='') {

            $.post('news/comment',{"comment" : message,"id" : id,"idParent" : idParent, "nom" : nom},function (data) {
                if(data.statuts == 0){
                    content= "<div class='media commentaire ml-5 p-2'>" +
                        constructComment(data.lastId,data.nom,data.comment,data.date)+
                        "                    </div>";
                    $("#commentParent"+idCommentParent).prepend(content);
                    toastr.success(data.mes, "Succès");
                    nbreComments += 1;
                    $('#message'+id).val('');
                    $("#nbreCommentaires").text("("+nbreComments+")");
                    $(".refCommentaire"+id).html(nbreComments);
                    $(".rowReponse"+idParent).addClass("hidden");
                    $(".onClose"+idParent).addClass("hidden");
                    $("#message"+idParent).val('');
                }else{
                    toastr.error(data.mes, "Désolé");
                }
            });

        } else {
            toastr.error("Renseignez le commentaire", "Error");
        }
    });
    $(document).on('click','.liked',function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: "news/likes",
            type: "post",
            data: "id="+id,
            datatype: "json",
            beforeSend: function () {
            },
            complete: function () {
                //end load
            },
            success: function (json) {
                if (json.statuts == 0) {
                    toastr.success(json.mes, "Success");
                    $(".refLiked"+id).html(json.nbreLiked);
                    $(".iconlike"+id).removeClass("fa-heart-o").addClass("fa-heart");
                    /*$(".ref"+id).removeClass("fa fa-thumbs-up");*/
                }else{
                    toastr.error(json.mes, "Oups !");
                }
            },
            error: function(jqXHR, textStatus, errorThrown){}
        });
    });
    $(document).on("click",".reply", function(e){
        e.preventDefault();
        var isConnect = $('#isconnect').val();
        if (isConnect=='1'){
            var id = $(this).data('id');
            $(".rowReponse"+id).removeClass("hidden");
            $(".onClose"+id).removeClass("hidden");

        }else {
            toastr.error("Vous devez vous connecter pour pouvoir chater!!", "Désolé");
        }
    });
    $(document).on("click",".closeRow", function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $(".rowReponse"+id).addClass("hidden");
        $(".onClose"+id).addClass("hidden");
        $("#message"+id).val('');
    });

    function buildComment(comment,sousComment){
        valComment =   "        <div class='media commentaire ml-2'>" +
            constructComment(comment.id,comment.nom,comment.message,comment.created_at,comment.id,1)+
            "           </div>" +
            "                   <div class='media'  id='commentParent"+comment.id+"'>" +
            "                    ";
        if (sousComment){
            for (var i = 0 ; i< sousComment.length; i++){
                valComment +=   "       <div class='media commentaire ml-5'>" +
                    constructComment(sousComment[i].id,sousComment[i].nom,sousComment[i].message,sousComment[i].created_at,comment.id,2)+
                    "                    </div>";

            }
            valComment += " </div>";
        }

        return valComment;
    }
    function constructComment(id,nom,message,created_at,idParent,type){
        var isParent = type==1?idParent:id;
        return '<div class="messaging">' +
            '    <div class="inbox_msg">' +
            '        <div class="mesgs">' +
            '          <div class="msg_history">' +
            '            <div class="incoming_msg">' +
            '                <div class="incoming_msg_img col-lg-1"> ' +
            '                    <img  src="http://brancos.log/Public/assets/img/user.jpg" alt="visage"  class="mr-1 mt-1 rounded-circle" style="width:40px;"> ' +
            '                </div>' +
            '                <div class="received_msg col-lg-11">' +
            '                    <div class="received_withd_msg">' +
            '                        <p class="inbox_msg_title"><b><u>'+nom+'</u></b><i class="pull-right"><small><a href="javascript:void(0);" class="reply"  data-id="'+isParent+'"><b>Répondre</b></a><a href="javascript:void(0);" class="p-2 closeRow hidden onClose'+id+'" data-id="'+id+'"><i class="fa fa-close"></i></a></small></i></p>'+
            '                        <div class="content_message">'+
            '                          '+message+
            '                    <div class="row m-2 p-1 hidden rowReponse'+id+'"> ' +
            '                        <div class="col-md-9">' +
            '                            <textarea  cols="30" rows="2" class="form-control" id="message'+id+'" placeholder="Répondre au commentaire de '+nom+'"></textarea>' +
            '                        </div>' +
            '                        <div class="col-md-2">' +
            '                         <button class="btn btn-dark replySend" data-id="'+id+'"  data-idcommentparent="'+idParent+'" data-nom="'+nom+'"><i class="fa fa-send"></i></button>' +
            '                        </div>' +
            '                     </div>' +'</div>' +
            '                     <span class="time_date">'+created_at+'</span></div>' +
            '                    </div>' +
            '                </div>' +
            '            </div>' +
            '        </div>' +
            '    </div>' +
            '</div>';
        // '      <p class="text-center top_spac"> Design by <a target="_blank" href="#">Sunil Rajput</a></p>\n' +
    }
    function isConnect(){
        $.ajax({
            url: "realisation/comment/isHavePermission",
            type: "post",
            data: "",
            datatype: "json",
            beforeSend: function () {
            },
            complete: function () {
                //end load
            },
            success: function (json) {
                if(json.statuts == 0){
                    $('#isconnect').val("1");
                }else{
                    $('#isconnect').val("0");
                }
            },
            error: function(jqXHR, textStatus, errorThrown){}
        });
    }
});
