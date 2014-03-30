$(function(){

    var report = {};

    report.history = {};

    report.history.ajax = {
        search: function(query, cb){
            var url = '/reports/search_history',
                params = {
                    query: query
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        }
    };

    $('#txt_query').typeahead({
        ajax: {
            url: site_url + '/services/search_product_ajax',
            timeout: 500,
            displayField: 'name',
            triggerLength: 3,
            preDispatch: function(query){
                return {
                    query: query
                }
            },

            preProcess: function(data){
                if(data.success){
                    return data.rows;
                }else{
                    return false;
                }
            }
        },
        updater: function(data){
            var d = data.split('#');
            var code = d[0],
                name = d[1];

            return code;
        }
    });

    report.history.set_list  = function(data){
        $('#tbl_list > tbody').empty();
        var i = 1;

        _.each(data.rows, function(v){
            $('#tbl_list > tbody').append(
                '<tr>' +
                    '<td>'+ i +'</td>' +
                    '<td>'+ v.date_serv +'</td>' +
                    '<td>'+ v.service_code +'</td>' +
                    '<td>'+ v.cause +'</td>' +
                    '<td>'+ v.contact_name +'</td>' +
                    '<td>'+ v.customer_name +'</td>' +
                    '<td>'+ v.technician_name +'</td>' +
                    '<td>'+ App.clear_null_value(v.service_result) +'</td>' +
                    '<td>'+ v.service_status +'</td>' +
                    '</tr>'
            );

            i++;
        });
    };

    $('#btn_search').on('click', function(){
        var query = $('#txt_query').val();

        if(!query)
        {
            App.alert('กรุณาระบุคำค้นหา');
        }
        else
        {
            report.history.ajax.search(query, function(err, data){
                if(err)
                {
                    App.alert(err);
                    $('#tbl_list > tbody').empty();
                    $('#tbl_list > tbody').append('<tr><td colspan="9">'+ err +'</td></tr>');
                }
                else
                {
                    report.history.set_list(data);
                }
            });
        }
    });

    $('#btn_export').on('click', function(){

        var query = $('#txt_query').val();

        if(!query)
        {
            App.alert('กรุณาระบุคำค้นหา');
        }
        else
        {
            App.goto_url('/prints/service_history/' + query );
        }

    });

});