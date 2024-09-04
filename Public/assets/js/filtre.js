/**
 * Created by Ndjeunou on 03/08/2017.
 */
$(document).ready(function(){
    $.extend({
        getUrlVars: function(){
            var vars = [], hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            for(var i = 0; i < hashes.length; i++)
            {
                hash = hashes[i].split('=');
                vars.push(hash[0]);
                vars[hash[0]] = hash[1];
            }
            return vars;
        },
        getUrlVar: function(name){
            return $.getUrlVars()[name];
        }
    });
    function removeParam(key, sourceURL) {
        var rtn = sourceURL.split("?")[0],
            param,
            params_arr = [],
            queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
        if (queryString !== "") {
            params_arr = queryString.split("&");
            for (var i = params_arr.length - 1; i >= 0; i -= 1) {
                param = params_arr[i].split("=")[0];
                if (param === key) {
                    params_arr.splice(i, 1);
                }
            }
            rtn = rtn + "?" + params_arr.join("&");
        }
        return rtn;
    }
    function updateURL(key,val){
        var url = window.location.href;
        var reExp = new RegExp("[\?|\&]"+key + "=[0-9a-zA-Z\_\+\-\|\.\,\;]*");

        if(reExp.test(url)) {
            // update
            var reExp = new RegExp("[\?&]" + key + "=([^&#]*)");
            var delimiter = reExp.exec(url)[0].charAt(0);
            url = url.replace(reExp, delimiter + key + "=" + val);
        } else {
            // add
            var newParam = key + "=" + val;
            if(!url.indexOf('?')){url += '?';}

            if(url.indexOf('#') > -1){
                var urlparts = url.split('#');
                url = urlparts[0] +  "&" + newParam +  (urlparts[1] ?  "#" +urlparts[1] : '');
            } else {
                url += "&" + newParam;
            }
        }
        //window.history.pushState(null, document.title, url);
        window.location.assign(url);
    }
    function createUrl(key,val,url) {
        /*if ($.getUrlVar(key) != null){
            updateURL(key,val);
        }else{
            window.location.assign(url+'&'+key+'='+val);
            alert(2);
        }*/
        updateURL(key,val);
    }
    /*$(document).on('click', '.gridView', function (e) {
        var grid = $(this);
        if (!grid.hasClass('selected')){
            var url = window.location.href;
            if ($.getUrlVar("grid") != null){
                window.location.assign(removeParam('grid',url));
            }
        }
    });
    $(document).on('click', '.listView', function (e) {
        var grid = $(this);
        if (!grid.hasClass('selected')){
            var url = window.location.href;
            createUrl('grid',1, url);
        }
    });*/
    $(document).on('change', '.pageView', function (e) {
        var grid = $(this),
            val = grid.val(),
            url = window.location.href;
        createUrl('nbre',val, url);
    });
    $(document).on('change', '.triView', function (e) {
        var grid = $('.triView'),
            val = grid.val();
            //url = window.location.href;
        //createUrl('tri',val, url);
        updateURL('tri',val);
    });
    $(document).on('change', '.stockView', function (e) {
        var grid = $(this),
            val = grid.is(":checked")?1:0,
            url = window.location.href;
        if (val == 0){
            if ($.getUrlVar("stock") != null){
                window.location.assign(removeParam('stock',url));
            }
        }else{
            //createUrl('stock',val, url);
            updateURL('stock',val);
        }
    });
    $('#color').change(function() {
        var url = window.location.href;
        if ($.getUrlVar("detail") != null){
            window.location.assign(removeParam('detail',url));
        }
    });
    $('#c').change(function() {
        var url = window.location.href;
        if ($.getUrlVar("cat") != null){
            window.location.assign(removeParam('cat',url));
        }
    });
    $('.cc').change(function() {
        var grid = $(this),
            val = grid.data('id'),
            url = window.location.href;
        if(grid.is(":checked")) {
            updateURL('cat',val);
        }else{
            if ($.getUrlVar("cat") != null){
                window.location.assign(removeParam('cat',url));
            }
        }
    });
    $('.color').change(function() {
        var grid = $(this),
            val = grid.data('val'),
            url = window.location.href;
        if(grid.is(":checked")) {
            updateURL('detail',val);
        }else{
            if ($.getUrlVar("detail") != null){
                window.location.assign(removeParam('detail',url));
            }
        }
    });
    $('.slider-range-price').each(function(){
        var min             = $(this).data('min');
        var max             = $(this).data('max');
        var unit            = $(this).data('unit');
        var value_min       = $(this).data('value-min');
        var value_max       = $(this).data('value-max');
        var label_reasult   = $(this).data('label-reasult');
        var t               = $(this);
        //var url = window.location.href;
        $( this ).slider({
            range: true,
            min: min,
            max: max,
            step: 500,
            values: [ value_min, value_max ],
            slide: function( event, ui ) {
                var result = label_reasult +" "+ unit +" "+ ui.values[ 0 ] +' - '+ unit+" "+ui.values[ 1 ];
                t.closest('.block-filter-inner').find('.amount-range-price').html(result);
                if (ui.values[ 0 ]!=value_min){
                    //createUrl('prixMin',ui.values[ 0 ], url);
                    updateURL('prixMin',ui.values[ 0 ]);
                }
                if (ui.values[ 1 ]!=value_max){
                    //createUrl('prixMax',ui.values[ 1 ], url);
                    updateURL('prixMax',ui.values[ 1 ]);
                }
            }
        });
    })


});