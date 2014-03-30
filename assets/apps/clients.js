$(function(){
    var client = {};

    client.modal = {
        show_change_password: function(){
            $('#mdl_change_password').modal({backdrop: 'static'}).show();
        }
        ,hide_change_password: function(){
            $('#mdl_change_password').modal('hide');
        },
        show_request: function(){
            $('#mdl_new_request').modal({backdrop: 'static'}).show();
        }
        ,hide_request: function(){
            $('#mdl_new_request').modal('hide');
        }
    };

    client.ajax = {
        search_service_history: function(service_code, cb){
            var url = '/clients/search_service_history',
                params = {
                    service_code: service_code
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        change_password: function(new_pass, old_pass, cb){
            var url = '/clients/change_password',
                params = {
                    new_pass: new_pass,
                    old_pass: old_pass
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        save_request: function(items, cb){
            var url = '/clients/save_request',
                params = {
                    data: items
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_request_list: function(start, stop, cb){
            var url = '/clients/get_request_list',
                params = {
                    start: start,
                    stop: stop
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },

        get_request_total: function(cb){
            var url = '/clients/get_request_total',
                params = {};

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },

        cancel_request: function(id, cb){
            var url = '/clients/cancel_request',
                params = {
                    id: id
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },

        search_request: function(query, cb){
            var url = '/clients/search_request',
                params = {
                    query: query
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        }
    };

    client.set_list = function(err, data){
        $('#tbl_list > tbody').empty();
        if(err){
            $('#tbl_list > tbody').append('<tr><td colspan="9">ไม่พบรายการ</td></tr>');
        }else{
            if(_.size(data.rows)){
                _.each(data.rows, function(v){
                    $('#tbl_list > tbody').append(
                        '<tr>' +
                            '<td>' + v.date_serv + '</td>' +
                            '<td>' + v.service_code + '</td>' +
                            '<td>' + App.clear_null_value(v.product_code) + '</td>' +
                            '<td>' + v.type_name + '</td>' +
                            '<td>' + v.brand_name + '</td>' +
                            '<td>' + v.model_name + '</td>' +
/*                            '<td>' + App.clear_null_value(v.cause) + '</td>' +
                            '<td>' + App.clear_null_value(v.service_result) + '</td>' +*/
                            '<td>' + App.clear_null_value(v.discharge_date) + '</td>' +
                            '<td>' + v.service_status + '</td>' +
                            '<td>' +
                            '<a href="javascript:void(0);" class="btn" data-name="btn_get_info" data-sv="'+ v.service_code +'"><i class="icon-edit"></i></a>' +
                            '</td>' +
                            '</tr>'
                    );
                });
            }else{
                $('#tbl_list > tbody').append('<tr><td colspan="9">ไม่พบรายการ</td></tr>');
            }
        }

    };

    //do search product
    $('#btn_search').click(function(){
        var service_code = $('#txt_query').val();
        if(!service_code || $.trim(service_code).length <= 2){
            App.alert('กรุณาระบุคำที่ต้องการค้นหา มากกว่า 2 ตัวอักษรขึ้นไป');
        }else{

            client.ajax.search_service_history(service_code, function(err, data){
                client.set_list(err, data);
            });
        }
    });

	//get service code info
	$('a[data-name="btn_get_info"]').live('click', function(){
	    var service_code = $(this).attr('data-sv');
	    
	    App.goto_url('/clients/info/' + service_code);
	});

    $('#txt_query').typeahead({
        ajax: {
            url: site_url + '/clients/search_service_ajax',
            timeout: 500,
            displayField: 'service_code',
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
            return data;
        }
    });

//chage pass
    $('a[data-name="chk-pass"]').click(function(){
        client.modal.show_change_password();
    });
    
    $('#btn_do_change_password').click(function(){
        var new_pass = $('#txt_new_password').val();
        var old_pass = $('#txt_old_password').val();

        if(!new_pass){
            App.alert('กรุณาระบุรหัสผ่านใหม่');
        }else if(!old_pass)
        {
            App.alert('กรุณาระบุรหัสผ่านเดิม');
        }
        else {
            //do change password
            client.ajax.change_password(new_pass, old_pass, function(err){
                if(err){
                    App.alert(err);
                }else{
                    App.alert('เปลี่ยนรหัสผ่านเสร็จเรียบร้อยแล้ว');
                    client.modal.hide_change_password();
                }
            });
        }
    });

    $('#btn_new_request').on('click', function(){
        client.clear_request_form();
        client.modal.show_request();
    });

    client.clear_request_form = function()
    {
        $('#txt_new_customer').val('');
        $('#txt_new_contact').val('');
        $('#txt_new_telephone').val('');
        App.set_first_selected($('#sl_new_type'));
        $('#txt_new_detail').val('');
    };

    $('#btn_save_request').on('click', function(e){
       var items = {};
        items.customer = $('#txt_new_customer').val();
        items.contact = $('#txt_new_contact').val();
        items.telephone = $('#txt_new_telephone').val();
        items.type = $('#sl_new_type').val();
        items.detail = $('#txt_new_detail').val();

        if(!items.customer)
        {
            App.alert('กรุณาระบุข้อมูลลูกค้า');
        }
        else if(!items.contact)
        {
            App.alert('กรุณาระบุชื่อสำหรับติดต่อ');
        }
        else if(!items.telephone)
        {
            App.alert('กรุณาระบุหมายเลขโทรศัพท์');
        }
        else if(!items.detail)
        {
            App.alert('กรุณาระบุรายละเอียดในการแจ้ง');
        }
        else
        {
            client.ajax.save_request(items, function(err){
                if(err)
                {
                    App.alert(err);
                }
                else
                {
                    App.alert('บันทึกรายการเสร็จเรียบร้อยแล้ว');
                    client.modal.hide_request();
                    client.get_request_list();
                }
            });
        }

        e.preventDefault();
    });

    client.set_request_list = function(data){
        if(_.size(data.rows) > 0){
            _.each(data.rows, function(v){
                var status = v.status_code == '-1' ? '<span class="label label-danger">ยกเลิก</span>' :
                    v.status_code == '1' ? '<span class="label label-success">ยืนยัน</span>' :
                        '<span class="label">รอตรวจสอบ</span>';
                var disb = v.status_code == '1' ? 'disabled="disabled"' : '';

                $('#tbl_request_list tbody').append(
                    '<tr>' +
                        '<td>' + status + '</td>' +
                        '<td>' + v.code + '</td>' +
                        '<td>' + to_thai_date(v.req_date) + '</td>' +
//                        '<td>' + v.customer + '</td>' +
                        '<td>' + v.contact + '</td>' +
                        '<td>' + v.telephone + '</td>' +
                        '<td>' + v.detail + '</td>' +
                        '<td>' +
                        '<div class="btn-group">' +
                        '<a href="javascript:void(0);" class="btn" data-name="btn_cancel" ' +
                        ' data-id="' + v.id + '" data-status="' + v.status_code +'" '+ disb +' title="ยกเลิกรายการ"><i class="icon-trash"></i></a>' +
                        '</div>' +
                        '</td>' +
                        '</tr>'
                );
            });
        }else{
            $('#tbl_request_list tbody').append(
                '<tr><td colspan="7">ไม่พบรายการ</td></tr>'
            );
        }
    };
    client.get_request_list = function(){
        $('#main_paging').fadeIn('slow');
        client.ajax.get_request_total(function(err, data){
            if(err){
                App.alert(err);
            }else{
                $('#main_paging').paging(data.total, {
                    format: " < . (qq -) nnncnnn (- pp) . >",
                    perpage: App.record_perpage,
                    lapping: 1,
                    page: 1,
                    onSelect: function(page){
                        client.ajax.get_request_list(this.slice[0], this.slice[1], function(err, data){
                            $('#tbl_request_list tbody').empty();
                            if(err){
                                App.alert(err);
                                $('#tbl_request_list tbody').append(
                                    '<tr><td colspan="7">ไม่พบรายการ</td></tr>'
                                );
                            }else{
                                client.set_request_list(data);
                            }
                        });

                    },
                    onFormat: function(type){
                        switch (type) {

                            case 'block':

                                if (!this.active)
                                    return '<li class="disabled"><a href="">' + this.value + '</a></li>';
                                else if (this.value != this.page)
                                    return '<li><a href="#' + this.value + '">' + this.value + '</a></li>';
                                return '<li class="active"><a href="#">' + this.value + '</a></li>';

                            case 'right':
                            case 'left':

                                if (!this.active) {
                                    return "";
                                }
                                return '<li><a href="#' + this.value + '">' + this.value + '</a></li>';

                            case 'next':

                                if (this.active) {
                                    return '<li><a href="#' + this.value + '">&raquo;</a></li>';
                                }
                                return '<li class="disabled"><a href="">&raquo;</a></li>';

                            case 'prev':

                                if (this.active) {
                                    return '<li><a href="#' + this.value + '">&laquo;</a></li>';
                                }
                                return '<li class="disabled"><a href="">&laquo;</a></li>';

                            case 'first':

                                if (this.active) {
                                    return '<li><a href="#' + this.value + '">&lt;</a></li>';
                                }
                                return '<li class="disabled"><a href="">&lt;</a></li>';

                            case 'last':

                                if (this.active) {
                                    return '<li><a href="#' + this.value + '">&gt;</a></li>';
                                }
                                return '<li class="disabled"><a href="">&gt;</a></li>';

                            case 'fill':
                                if (this.active) {
                                    return '<li class="disabled"><a href="#">...</a></li>';
                                }
                        }
                        return ""; // return nothing for missing branches
                    }
                });
            }
        });
    };

    $('a[href="#tab2"]').on('click', function(){
        client.get_request_list();
    });

    $(document).on('click', 'a[data-name="btn_cancel"]', function(e){
        if($(this).data('status') == '1' || $(this).data('status') == '-1')
        {
            App.alert('รายการนี้ไม่สามารถยกเลิกได้เนื่องจากได้รับการยืนยัน/ยกเลิกแล้ว กรุณาติดต่อเจ้าหน้าที่');
        }
        else
        {
            if(confirm('คุณต้องการยกเลิกรายการใช่หรือไม่'))
            {
                var id = $(this).data('id');
                client.ajax.cancel_request(id, function(err){
                    if(err)
                    {
                        App.alert(err);
                    }
                    else
                    {
                        App.alert('ยกเลิกรายการเสร็จเรียบร้อยแล้ว');
                        client.get_request_list();
                    }
                });
            }
        }

    });

    $('#btn_request_search').on('click', function(e){

        var query = $('#txt_request_query').val();
        if(!query)
        {
            //App.alert('กรุณาระบุรหัสร้องขอ (Request number)');
            client.get_request_list();
        }
        else
        {
            $('#tbl_request_list tbody').empty();
            client.ajax.search_request(query, function(err, data){
               if(err)
               {
                   $('#tbl_request_list tbody').append(
                       '<tr><td colspan="7">ไม่พบรายการ</td></tr>'
                   );
               }
               else
               {
                   $('#main_paing').fadeOut('slow');
                    client.set_request_list(data);
               }
            });
        }

        e.preventDefault();
    });
});
