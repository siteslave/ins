$(function(){
    var clients = {};

    clients.ajax = {
        get_activities: function(sv, cb){
            var url = '/clients/get_activities',
                params = {
                    sv: sv
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_item: function(sv, cb){
            var url = '/clients/get_item',
                params = {
                    sv: sv
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },

    };

    clients.clear_act_form = function(){
        $('#txt_act_detail').val('');
    };

    clients.get_activities = function(){

        var sv = $('#service_code').val();

        $('#tbl_act_list > tbody').empty();

        clients.ajax.get_activities(sv, function(err, data){
            if(err){
                App.alert(err);
                $('#tbl_act_list > tbody').append(
                    '<tr><td colspan="4">ไม่พบรายการ</td></tr>'
                );
            }else{
                if(_.size(data.rows)){
                    _.each(data.rows, function(v){
                        $('#tbl_act_list > tbody').append(
                            '<tr>' +
                                '<td>' + toThaiDate(v.act_date) + '</td>' +
                                '<td>' + v.act_time + '</td>' +
                                '<td>' + v.fullname + '</td>' +
                                '<td>' + v.detail + '</td>' +
                                '</tr>'
                        );
                    });
                }else{
                    $('#tbl_act_list > tbody').append(
                        '<tr><td colspan="4">ไม่พบรายการ</td></tr>'
                    );
                }
            }
        });
    };


    $('a[href="#tab2"]').click(function(){
        clients.get_activities();
    });


    clients.get_item = function(){
        var sv = $('#txt_service_code').val();

        $('#tbl_item_list > tbody').empty();

        clients.ajax.get_item(sv, function(err, data){
            if(err){
                App.alert(err);
                $('#tbl_item_list > tbody').append(
                    '<tr><td colspan="4">ไม่พบรายการ</td></tr>'
                );
            }else{
                if(_.size(data.rows)){
                var sum_price = 0;
                    _.each(data.rows, function(v){
                        var total = v.qty * v.price;

                        $('#tbl_item_list > tbody').append(
                            '<tr>' +
                                '<td>' + v.name + '</td>' +
                                '<td>' + addCommas(v.price) + '</td>' +
                                '<td>' + v.qty + '</td>' +
                                '<td>' + addCommas(total) + '</td>' +
                                '</tr>'
                        );
                        
                        sum_price += total;
                    });
                    
                    $('#sv_total').html(addCommas(sum_price));
                    
                }else{
                    $('#tbl_item_list > tbody').append(
                        '<tr><td colspan="4">ไม่พบรายการ</td></tr>'
                    );
                }
            }
        })
    };

    $('a[href="#tab3"]').click(function(){
        clients.get_item();
    });

});
