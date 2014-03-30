var addCommas = function (str){
    var my_str = numeral(str).format('0,0.00');

    return my_str;
};

var addCommasNoDecimal = function (str){
    var my_str = numeral(str).format('0,0');

    return my_str;
};
// convert mysql date to thai date
var to_thai_date = function( d ){
    if(!d)
    {
        return '-';
    }
    else
    {
        var _d = d.split('-'),
            _y = parseInt(_d[0]) + 543,
            _m = _d[1],
            _d = _d[2],

            _date = _d + '/' + _m + '/' + _y ;

        return _date;
    }
}
var to_string_date = function(d)
{
    var _d = d.split('/');

    return _d[0] + _d[1] + _d[2];
};

var to_js_date = function( d ){
    if(!d || d == '0000-00-00')
    {
        return '';
    }
    else
    {
        var _d = d.split('-'),
            _y = _d[0],
            _m = _d[1],
            _d = _d[2],

            _date = _d + '/' + _m + '/' + _y ;

        return _date;
    }
}
var to_mysql_date = function(d){
    if(!d){
        return null;
    }else{
        var _d = d.split('/'),
            _y = _d[2],
            _m = _d[1],
            _d = _d[0],

            _date = _y + '-' + _m + '-' + _d ;

        return _date;
    }
}

var count_age = function(date){
    if(!date){
        return 0;
    }else{
        var _d = date.split('-'),
            _y = _d[0],
            _cy = new Date(),
            age = parseInt(_cy.getFullYear()) - parseInt(_y);

        return age;
    }
}

var App = {};

App.spin_icon_class = null;
App.spin_target = null;

App.set_spin = function()
{
    $('#spinner').fadeIn();
};

App.clear_spin = function()
{
    $('#spinner').fadeOut();
};

/**
 * Ajax function
 *
 * @param url       URL without index.php
 * @param params    Array of parameters
 * @param cb        Callback function
 */

App.ajax = function(url, params, cb){
    App.loading();
    try{
        $.ajax({
            url: base_url + 'index.php' + url,
            dataType: 'json',
            type: 'POST',
            data: params,

            success: function(data)
            {
                if(data.success)
                {
                    data ? cb(null, data) : cb('ไม่พบรายการ');
                }
                else
                {
                    cb(data.msg);
                }
                App.unloading();
            },

            error: function(xhr, status, errorThrown)
            {
                cb('เกิดข้อผิดพลาด: ' + xhr.status + ': ' + xhr.statusText);
                App.unloading();
            }

        });

    }catch(ex){
        cb(ex);
        App.unloading();
    }

};

App.alert = function(msg, title){
    title = 'Message';

    $("#freeow").freeow(title, msg, {
        classes: ["gray"],
        autoHide: true,
        prepend: true
    });
};

App.loading = function(){
    $.blockUI({
        css: {
        border: 'none',
        padding: '15px',
        backgroundColor: '#000',
        '-webkit-border-radius': '10px',
        '-moz-border-radius': '10px',
        opacity: 1,
        color: '#fff'
    },
    message: '<h4><img src="' + base_url + 'assets/apps/img/ajax-loader.gif"> Loading...</h4>'

    });
};

App.unloading = function(){
    $.unblockUI();
};



App.goto_url = function(url){
    location.href = base_url + 'index.php' + url;
};

App.set_first_selected = function(obj){
    //obj.removeAttr('selected').find('option:first').attr('selected', 'selected');
    obj.find('option').first().attr('selected', 'selected');
}

App.record_perpage = 20;

App.clear_null_value = function(v){
    return v == null ? '-' : v;
}

App.set_runtime = function()
{
    $('input[data-type="number"]').numeric();
    $('input[data-type="date"]').mask('99/99/9999').attr('placeholder', 'dd/mm/yyyy');
    $('input[disabled]').css('background-color', 'white');
    $('textarea[disabled]').css('background-color', 'white');

    $(':[rel="tooltip"]').tooltip();
};
$(function(){
    App.set_runtime();
});
