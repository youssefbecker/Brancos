$(document).ready(function () {
    $.ajax({
        type: 'post',
        url: 'http://brancos.log/solde/get',
        datatype: 'json',
        beforeSend: function () {},
        success: function (json) {
            if (json.statuts == 0){
                $('#monSolde').html(json.solde);
                $('#mesContact').html(json.contact);
                $('#mesCommande').html(json.commande);
                $('#mesLicense').html(json.license);
                $('#mesGroupe').html(json.groupe);
                $('#mesCampagne').html(json.campagne);

                if(json.licenses.length>0){
                    var datas = json.licenses;
                    for(var i = 0; i<json.licenses.length; i++){
                        var row = {};
                        row["elapsed"] = datas[i].type;
                        row["value"] = datas[i].cout;
                        day_data.push(row);
                    }
                    Morris.Line({
                        element: 'commandesChart',
                        data: day_data,
                        xkey: 'elapsed',
                        ykeys: ['value'],
                        labels: ['Montant'],
                        gridEnabled: false,
                        gridLineColor: 'transparent',
                        lineColors: ['#045d97'],
                        lineWidth: 2,
                        parseTime: false,
                        resize:true,
                        hideHover: 'auto'
                    });
                }
            }
        },
        complete: function () {},
        error: function(jqXHR, textStatus, errorThrown){}
    });
});