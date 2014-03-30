$(function(){
    var service = {};


    service.code = null;

    service.db = {};
    service.db.charge = {};
    service.db.charge.items = TAFFY();
    service.db.items = TAFFY();

    $('#txt_service_status').val('1');
    $('a[data-id="1"]').tab('show');

    service.get_option = function()
    {
        service.status = $('#txt_service_status').val();
        service.date_serv = $('#txt_date_serv').val();
        service.code = $('#txt_service_code').val();
        service.customer_code = $('#sl_order_customers').val();
        service.technician_code = $('#sl_order_technician').val();
    };

    service.modal = {
        show_change_status: function(){
            $('#mdl_change_status').modal({backdrop: 'static'}).show();
        },hide_change_status: function(){
            $('#mdl_change_status').modal('hide');
        },
        show_result: function(){
            $('#mdl_result').modal({backdrop: 'static'}).show();
        },hide_result: function(){
            $('#mdl_result').modal('hide');
        },
        show_activities: function(){
            $('#mdl_activities').modal({backdrop: 'static'}).show();
        },hide_activities: function(){
            $('#mdl_activities').modal('hide');
        },
        show_assign_technician: function(){
            $('#mdl_assign_technician').modal({backdrop: 'static'}).show();
        },hide_assign_technician: function(){

            $('#mdl_assign_technician').modal('hide');
        },
        show_register: function(){
            $('#mdl_register').modal({backdrop: 'static'}).show();
        },
        hide_register: function(){

            $('#mdl_register').modal('hide');
        }
        ,
        show_action: function(){
            $('#mdl_action').modal({backdrop: 'static'}).show();
        },
        show_charge_items: function(){
            $('#mdl_charge_items').modal({backdrop: 'static'}).show();
        },
        hide_register: function(){

            $('#mdl_charge_items').modal('hide');
        }
    };

    service.ajax = {
        get_activities: function(service_code, cb){
            var url = '/services/get_activities',
                params = {
                    service_code: service_code
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_detail: function(service_code, cb){
            var url = '/services/get_detail',
                params = {
                    service_code: service_code
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        search_service: function(service_code, cb){
            var url = '/services/search_service',
                params = {
                    service_code: service_code
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        save_change_status: function(data, cb){
            var url = '/services/save_change_status',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        save_activities: function(data, cb){
            var url = '/services/save_activities',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        save_result: function(data, cb){
            var url = '/services/save_result',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_result: function(service_code, cb){
            var url = '/services/get_result',
                params = {
                    service_code: service_code
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_service_total: function(cb){
            var url = '/services/get_service_total',
                params = {
                    status: service.status,
                    c: service.customer_code,
                    t: service.technician_code
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_service_list: function(start, stop, cb){
            var url = '/services/get_service_list',
                params = {
                    start: start,
                    stop: stop,
                    status: service.status,
                    c: service.customer_code,
                    t: service.technician_code
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        save_assign_tech: function(data, cb){
            var url = '/services/save_assign_tech',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        save_register: function(data, cb){
            var url = '/services/save_register',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_product_detail: function(code, cb){
            var url = '/products/get_detail',
                params = {
                    code: code
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        save_charge_items: function(data, cb){
            var url = '/services/save_charge_items',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_charge_items: function(service_code, cb){
            var url = '/services/get_charge_items',
                params = {
                    service_code: service_code
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_other_device: function(service_code, cb){
            var url = '/services/get_other_device',
                params = {
                    service_code: service_code
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        }

    };

    service.set_status = function(status_id)
    {
        $('#txt_service_status').val(status_id);
    };
    service.set_service_code = function(code)
    {
        $('#txt_service_code').val(code);
    };

    service.insert_item = function(data)
    {
        var do_insert = service.db.items.insert({
            code: data.code,
            name: data.name,
            qty: data.qty
        });

        return do_insert ? true : false;
    };

    service.db.charge.save = function(data)
    {
        var do_insert = service.db.charge.items.insert({
            code: data.code,
            name: data.name,
            price: data.price,
            qty: data.qty
        });

        return do_insert ? true : false;
    };

    service.check_duplicated = function(code)
    {
        var count = service.db.items({code: code}).count();
        return count > 0 ? true : false;
    };
    service.db.charge.check_duplicated = function(code)
    {
        var count = service.db.charge.items({code: code}).count();
        return count > 0 ? true : false;
    };

    service.remove_item = function(code)
    {
        var do_remove = service.db.items({code: code}).remove();

        return do_remove ? true : false;
    };
    service.db.charge.remove = function(code)
    {
        var do_remove = service.db.charge.items({code: code}).remove();

        return do_remove ? true : false;
    };

    service.db.charge.update = function(data)
    {
        var do_update = service.db.charge.items({code: data.code})
            .update({
                qty: data.qty,
                price: data.price
            });

        return do_update ? true : false;
    };
    service.update_item = function(data)
    {
        var do_update = service.db.items({code: data.code})
            .update({
                qty: data.qty
            });

        return do_update ? true : false;
    };


    service.set_item_list = function()
    {
        $('#tbl_reg_item_list > tbody').empty();

        if(service.db.items().count() > 0)
        {
            service.db.items().each(function(r){
                //var total = r['price'] * r['qty'];

                $('#tbl_reg_item_list > tbody').append(
                    '<tr>' +
                        '<td>'+ r['code'] +'</td>' +
                        '<td>'+ r['name'] +'</td>' +
                        //'<td>'+ addCommas(r['price']) +'</td>' +
                        '<td>'+ r['qty'] +'</td>' +
                        //'<td>'+ addCommas(total) +'</td>' +
                        '<td>' +
                        '<div class="btn-group">' +
                        '<a href="#" class="btn" data-qty="'+ r['qty'] +'" ' +
                        'data-name="btn_edit_item" ' +
                        'data-code="'+ r['code'] +'"><i class="icon-edit"></i></a>' +
                        '<a href="#" class="btn" data-name="btn_remove_item" ' +
                        'data-code="'+ r['code'] +'"><i class="icon-trash"></i></a>' +
                        '</div>' +
                        '</td>' +
                        '</tr>'
                );
            });
        }
        else
        {
            $('#tbl_reg_item_list > tbody').append('<tr><td colspan="4">ไม่พบรายการ</td></tr>');
        }
    };

    service.db.charge.set_list = function()
    {
        $('#tbl_ci_item_list > tbody').empty();

        if(service.db.charge.items().count() > 0)
        {
            service.db.charge.items().each(function(r){
                var total = r['price'] * r['qty'];

                $('#tbl_ci_item_list > tbody').append(
                    '<tr>' +
                        '<td>'+ r['code'] +'</td>' +
                        '<td>'+ r['name'] +'</td>' +
                        '<td>'+ addCommas(r['price']) +'</td>' +
                        '<td>'+ r['qty'] +'</td>' +
                        '<td>'+ addCommas(total) +'</td>' +
                        '<td>' +
                        '<div class="btn-group">' +
                        '<a href="#" class="btn" data-qty="'+ r['qty'] +'" ' +
                        'data-price="'+ r['price'] +'" data-name="btn_charge_edit" ' +
                        'data-code="'+ r['code'] +'" data-vname="'+ r['name'] +'"><i class="icon-edit"></i></a>' +
                        '<a href="#" class="btn" data-name="btn_charge_remove" ' +
                        'data-code="'+ r['code'] +'"><i class="icon-trash"></i></a>' +
                        '</div>' +
                        '</td>' +
                        '</tr>'
                );
            });
        }
        else
        {
            $('#tbl_ci_item_list > tbody').append('<tr><td colspan="6">ไม่พบรายการ</td></tr>');
        }

    };

    //edit item
    $(document).on('click', 'a[data-name="btn_edit_item"]', function(e){

        var code = $(this).attr('data-code'),
            qty = $(this).attr('data-qty')

        $('#sl_reg_items').val(code);
        $('#txt_reg_item_qty').val(qty);

        e.preventDefault();
    });    //edit item

    $(document).on('click', 'a[data-name="btn_charge_edit"]', function(e){

        var code = $(this).attr('data-code'),
            qty = $(this).attr('data-qty'),
            name = $(this).attr('data-vname'),
            price = $(this).attr('data-price'),
            total = parseInt(qty) * parseFloat(price);

        $('#txt_ci_item_code').val(code);
        $('#txt_ci_item_qty').val(qty);
        $('#txt_ci_item_price').val(price);
        $('#txt_ci_item_query').val(name);
        $('#txt_ci_item_total').val(total);

        $('#tbl_ci_new').fadeIn('slow');

        e.preventDefault();
    });

    service.set_total = function()
    {
        var qty = $('#txt_ci_item_qty').val(),
            price = $('#txt_ci_item_price').val(),
            total = parseInt(qty) * parseFloat(price);

        $('#txt_ci_item_total').val(total);

    };

    $('#txt_ci_item_qty').on('change', function(){
        service.set_total();
    });
    $('#txt_ci_item_price').on('change', function(){
        service.set_total();
    });

    $(document).on('click', 'a[data-name="btn_remove_item"]', function(e){

        if(confirm('คุณต้องการลบรายการนี้ใช่หรือไม่?'))
        {
            var code = $(this).attr('data-code');
            var rs = service.remove_item(code);
            if(rs)
            {
                App.alert('ลบรายการเสร็จเรียบร้อย');
                service.set_item_list();
            }
            else
            {
                App.alert('ไม่สามารถลบรายการได้');
            }
        }

        e.preventDefault();
    });
    $(document).on('click', 'a[data-name="btn_charge_remove"]', function(e){

        if(confirm('คุณต้องการลบรายการนี้ใช่หรือไม่?'))
        {
            var code = $(this).attr('data-code');
            var rs = service.db.charge.remove(code);
            if(rs)
            {
                App.alert('ลบรายการเสร็จเรียบร้อย');
                service.db.charge.set_list();
            }
            else
            {
                App.alert('ไม่สามารถลบรายการได้');
            }
        }

        e.preventDefault();
    });

    service.status = $('#service_status').val();

    service.clear_register_form = function()
    {
        //$('#txt_reg_date').val('');
        $('#txt_reg_query').val('');
        $('#txt_reg_serial').val('');
        $('#txt_reg_product_type').val('');
        $('#txt_reg_product_brand').val('');
        $('#txt_reg_product_model').val('');
        $('#txt_reg_department').val('');
        $('#txt_reg_supplier').val('');
        $('#txt_reg_cause').val('');
        $('#txt_reg_contact').val('');
        $('#txt_reg_contact_telephone').val('');
        $('#txt_reg_product_code').val('');
        $('#txt_reg_password').val('');
        $('#txt_reg_item_qty').val('');

        App.set_first_selected($('#sl_reg_customers'));
        App.set_first_selected($('#sl_reg_priority'));
        App.set_first_selected($('#sl_reg_user'));
        App.set_first_selected($('#sl_reg_items'));

        $('#txt_reg_query').removeAttr('disabled');
        $('#txt_reg_isupdate').val('0');


        service.db.items().remove();

        $('#tbl_reg_item_list > tbody').empty();
        $('#tbl_reg_item_list > tbody').append('<tr><td colspan="4">กรุณาเลือกรายการ</td></tr>');
    };

    service.clear_change_status_form = function()
    {
        App.set_first_selected($('#sl_cs_user'));
        App.set_first_selected($('#sl_cs_status'));
        $('#txt_cs_password').val('');
    };
    service.get_product_detail = function(code){
        service.ajax.get_product_detail(code, function(err, data){
            if(err)
            {
                App.alert(err);
            }
            else
            {
                $('#txt_reg_serial').val(data.rows.product_serial);
                $('#txt_reg_product_type').val(data.rows.type_name);
                $('#txt_reg_product_brand').val(data.rows.brand_name);
                $('#txt_reg_product_model').val(data.rows.model_name);
                $('#txt_reg_department').val(data.rows.customer_name);
                $('#txt_reg_supplier').val(data.rows.supplier_name);
            }
        });
    };

    $('#txt_reg_query').typeahead({
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

            //get detail
            service.get_product_detail(code);
            $('#txt_reg_product_code').val(code);

            return name;
        }
    });

    $('#bnt_show_register').on('click', function(){
        $('a[href="#tab_service1"]').tab('show');
        service.clear_register_form();
        service.modal.show_register();
    });

    $('#btn_reg_add_item').on('click', function(){
        var data = {};

        //data.price = parseFloat($('#sl_reg_items > option:selected').data('price'));
        data.code = $('#sl_reg_items').val();
        data.qty = parseInt($('#txt_reg_item_qty').val());
        data.name = $('#sl_reg_items > option:selected').text();

        if(!data.qty || parseInt(!data.qty) <= 0)
        {
            App.alert('กรุณาใส่จำนวนอย่างน้อย 1 ');
        }
        else
        {
            //check duplicate
            var duplicated = service.check_duplicated(data.code);
            var rs = false;

            if(duplicated)
            {
                rs = service.update_item(data);
            }
            else
            {
                rs = service.insert_item(data);
            }

            if(rs)
            {
                service.set_item_list();
            }
            else
            {
                App.alert('ไม่สามารถดำเนินการได้');
            }
        }
    });

    $('#sl_reg_items').on('change', function(){
        //var price = $(this).find('option:selected').data('price');
        //$('#txt_reg_item_price').val(price);
        $('#txt_reg_item_qty').val('1');
    });

    service.set_service_list = function(err, data){
        $('#tbl_service_list > tbody').empty();

        if(err){
            $('#tbl_service_list > tbody').append('<tr><td colspan="10">ไม่พบรายการ</td></tr>');
        }else{
            if(_.size(data.rows)){
                _.each(data.rows, function(v){
                    $('#tbl_service_list > tbody').append(
                        '<tr>' +
                            '<td>' + v.service_code + '</td>' +
                            '<td>' + v.date_serv + '</td>' +
                            '<td>' + v.product_code + '</td>' +
                            '<td>' + v.type_name + '</td>' +
                            '<td>' + v.brand_name + '</td>' +
                            '<td>' + v.model_name + '</td>' +
                            '<td>' + v.customer_name + '</td>' +
                            '<td>' + v.technician_name + '</td>' +
//                            '<td>' + v.cause + '</td>' +
                            '<td>'+
                            '<a href="javascript:void(0);" data-name="btn_action" class="btn" ' +
                            'data-product_code="'+ v.product_code +'" data-code="'+ v.service_code +'" rel="tooltip" title="จัดการรายการ">' +
                            '<i class="icon-th-list"></i></a>' +
                            '</td>' +
                            '</tr>'
                    );
                });
            }else{
                $('#tbl_other_service_list > tbody').append('<tr><td colspan="7">ไม่พบรายการ</td></tr>');
            }
        }

        App.set_runtime();

    };

    service.get_service_list = function(){

        service.get_option();
        $('#main_paging').fadeIn('slow');

        service.ajax.get_service_total(function(err, data){
            if(err){
                App.alert(err);
            }else{
                $('#main_paging').paging(data.total, {
                    format: " < . (qq -) nnncnnn (- pp) . >",
                    perpage: App.record_perpage,
                    lapping: 1,
                    page: 1,
                    onSelect: function(page){
                        //console.log('page: ' + page);
                        //console.log(this.slice);      //this.slice[0] = start, this.slice[1] = stop

                        service.ajax.get_service_list(this.slice[0], this.slice[1], function(err, data){
                            service.set_service_list(err, data);
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

    $('#btn_reg_save').on('click', function(e){
       var data = {};
        data.date_serv = $('#txt_reg_date').val();
        data.product_code = $('#txt_reg_product_code').val();
        data.cause = $('#txt_reg_cause').val();
        data.customer_code = $('#sl_reg_customers').val();
        data.contact_name = $('#txt_reg_contact').val();
        data.contact_telephone = $('#txt_reg_contact_telephone').val();
        data.priority = $('#sl_reg_priority').val();
        data.items = service.db.items().get();

        data.isupdate = $('#txt_reg_isupdate').val();

        data.user_code = $('#sl_reg_user').val();
        data.password = $('#txt_reg_password').val();

        if(data.isupdate == '1')
        {
            data.service_code = $('#txt_service_code').val();
        }

        if(!data.date_serv)
        {
            App.alert('กรุณาระบุวันที่รับแจ้ง');
        }
        else if(!data.product_code)
        {
            App.alert('กรุณาเลือกรายการสินค้าที่ต้องการลงทะเบียน');
        }
        else if(!data.cause)
        {
            App.alert('กรุณาระบุอาการแจ้งซ่อม');
        }
        else if(!data.contact_name)
        {
            App.alert('กรุณาระบุชื่อผู้แจ้ง');
        }
        else if(!data.customer_code)
        {
            App.alert('กรุณาระบุลูกค้า/หน่วยงาน');
        }
        else if(!data.user_code)
        {
            App.alert('กรุณาระบุชื่อผู้ใช้งาน');
        }
        else if(!data.password)
        {
            App.alert('กรุณาระบุรหัสผ่าน');
        }
        else
        {
            //do save
            App.set_spin();

            service.ajax.save_register(data, function(err){
                if(err)
                {
                    App.alert(err);
                }
                else
                {
                    service.modal.hide_register();
                    App.alert('บันทึกข้อมูลเสร็จเรียบร้อยแล้ว');
                }
            });

            App.clear_spin();

        }

        e.preventDefault();
    });

    $('#mdl_register').on('hidden', function(){
        service.clear_register_form();
    });
    //tab service click
    $('a[data-name="tab_service"]').on('click', function(e){
        var status_id = $(this).attr('data-id');
        service.set_status(status_id);

        service.get_service_list();

        e.preventDefault();
    });

    $('button[data-id="btn_do_refresh"]').on('click', function(e){
        service.get_service_list();
        e.preventDefault();
    });

    $(document).on('click', 'a[data-name="btn_action"]', function(){
        var service_code = $(this).attr('data-code'),
            product_code = $(this).attr('data-product_code');

        service.set_service_code(service_code);
        $('#txt_product_code').val(product_code);

        service.modal.show_action();
    });

    $('a[data-name="btn_assign_technician"]').on('click', function(){
        //show assign technician
        var service_code = $('#txt_service_code').val();
        $('#txt_at_service_code').val(service_code);
        service.clear_assign_technician_form();
        service.modal.show_assign_technician();
    });

    $('a[data-name="btn_activities"]').on('click', function(e){
        service.activities.clear_form();
        //$('a[href="#tab_act_main"]').tab('show');
        service.modal.show_activities();
        //e.preventDefault();
    });

    $('a[data-name="btn_change_status"]').on('click', function(){
        //show assign technician
        var service_code = $('#txt_service_code').val();
        $('#txt_cs_service_code').val(service_code);
        service.clear_change_status_form();
        service.modal.show_change_status();
    });

    service.set_charge_item = function(data)
    {
        service.db.charge.items().remove();
        $('#tbl_ci_item_list > tbody').empty();

        _.each(data.rows, function(v){
            var items = {};
            items.code = v.item_code;
            items.qty = v.qty;
            items.price = v.price;
            items.name = v.name;

            service.db.charge.save(items);
        });
    };
    $('a[data-name="btn_charge_items"]').on('click', function(){
        //show assign technician
        var service_code = $('#txt_service_code').val();
        $('#txt_ci_service_code').val(service_code);
        App.set_first_selected($('#sl_ci_user'));
        $('#txt_ci_password').val('');

        //get charge item
        service.ajax.get_charge_items(service_code, function(err, data){
            if(!err)
            {
                service.set_charge_item(data);
                service.db.charge.set_list();
            }
            else
            {
                $('#tbl_ci_item_list > tbody').empty();
                $('#tbl_ci_item_list > tbody').append('<tr><td colspan="6">ไม่พบรายการ</td></tr>');
            }
        });

        service.modal.show_charge_items();

    });

    service.clear_assign_technician_form = function()
    {
        //$('#txt_at_service_code').val('');
        App.set_first_selected($('#sl_at_user'));
        $('#txt_at_password').val('');
    };
    //do assign technician
    $('#btn_at_save').on('click', function(){
        var data = {};
        data.service_code = $('#txt_at_service_code').val();
        data.user_code = $('#sl_at_user').val();
        data.admin_code = $('#sl_at_admin').val();
        data.password = $('#txt_at_password').val();

        if(!data.admin_code)
        {
            App.alert('กรุณาระบุชื่อ Admin');
        }
        else if(!data.service_code)
        {
            App.alert('กรุณาระบุเลขที่ใบรับซ่อม');
        }
        else if(!data.user_code)
        {
            App.alert('กรุณาระบุชื่อช่างที่ต้องการ');
        }
        else if(!data.password)
        {
            App.alert('กรุณาระบรหัสผ่าน');
        }
        else
        {
            //do save
            service.ajax.save_assign_tech(data, function(err){
                if(err)
                {
                    App.alert(err);
                }
                else
                {
                    App.alert('บันทึกข้อมูลเสร็จเรียบร้อยแล้ว');

                    service.get_service_list();

                    service.clear_assign_technician_form();
                    service.modal.hide_assign_technician();
                }
            });
        }
    });
    //change status
    $('#btn_cs_save').on('click', function(){
        var data = {};
        data.service_code = $('#txt_cs_service_code').val();
        data.user_code = $('#sl_cs_user').val();
        data.password = $('#txt_cs_password').val();
        data.status = $('#sl_cs_status').val();

        if(!data.service_code)
        {
            App.alert('กรุณาระบุเลขที่ใบรับซ่อม');
        }
        else if(!data.user_code)
        {
            App.alert('กรุณาระบุชื่อช่างที่ต้องการ');
        }
        else if(!data.password)
        {
            App.alert('กรุณาระบรหัสผ่าน');
        }
        else if(!data.status)
        {
            App.alert('กรุณาระบุสถานะซ่อม');
        }
        else
        {
            //do save
            service.ajax.save_change_status(data, function(err){
                if(err)
                {
                    App.alert(err);
                }
                else
                {
                    App.alert('บันทึกข้อมูลเสร็จเรียบร้อยแล้ว');

                    $('a[data-name="tab_service"]').each(function(){
                        if($(this).attr('data-id') == data.status){
                            $(this).tab('show');
                        }
                    });

                    $('#txt_service_status').val(data.status);

                    service.get_service_list();
                    service.clear_assign_technician_form();
                    service.modal.hide_change_status();
                }
            });
        }
    });

    $('#btn_refresh').on('click', function(){
        service.get_service_list();
    });

    $('#btn_ci_new_item').on('click', function(){
        $('#tbl_ci_new').fadeIn('slow');
        service.clear_charge_form();
    });

    //cancel save item
    $('#btn_ci_save_item_cancel').on('click', function(){
        service.clear_charge_form();
        $('#tbl_ci_new').fadeOut('slow');
    });

    $('#btn_ci_save_item').on('click', function(){

        var data = {};
        data.price = $('#txt_ci_item_price').val();
        data.qty = $('#txt_ci_item_qty').val();
        data.code = $('#txt_ci_item_code').val();
        data.name = $('#txt_ci_item_query').val();

        if(!data.qty || parseInt(!data.qty) <= 0)
        {
            App.alert('กรุณาใส่จำนวนอย่างน้อย 1 ');
        }else if(!data.price || parseInt(!data.price) <= 0)
        {
            App.alert('กรุณาใส่จำนวนอย่างน้อย 1 ');
        }
        else
        {
            //check duplicate
            var duplicated = service.db.charge.check_duplicated(data.code);
            var rs = false;

            if(duplicated)
            {
                rs = service.db.charge.update(data);
            }
            else
            {
                rs = service.db.charge.save(data);
            }

            if(rs)
            {
                service.db.charge.set_list();
                service.clear_charge_form();
                $('#tbl_ci_new').fadeOut('slow');
            }
            else
            {
                App.alert('ไม่สามารถดำเนินการได้');
            }
        }

    });

    $('#txt_ci_item_query').typeahead({
        ajax: {
            url: site_url + '/services/search_charge_item_ajax',
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
                name = d[1],
                price = d[2];

            $('#txt_ci_item_price').val(price);
            $('#txt_ci_item_qty').val(1);
            $('#txt_ci_item_code').val(code);
            $('#txt_ci_item_total').val(price);

            return name;
        }
    });

    service.clear_charge_form = function()
    {
        $('#txt_ci_item_price').val('');
        $('#txt_ci_item_qty').val('');
        $('#txt_ci_item_code').val('');
        $('#txt_ci_item_total').val('');
        $('#txt_ci_item_query').val('');
        App.set_first_selected($('#sl_ci_user'));
        $('#txt_ci_password').val('');
    };

    //save charge iten
    $('#btn_ci_save').on('click', function(){
        var data = {};
        data.items = service.db.charge.items().get();
        data.service_code = $('#txt_service_code').val();
        data.user_code = $('#sl_ci_user').val();
        data.password = $('#txt_ci_password').val();

        if(!data.service_code)
        {
            App.alert('กรุณาระบุเลขที่รับซ่อม');
        }
        else if(!data.user_code)
        {
            App.alert('กรุณาระบุชื่อผู้ใช้งาน');
        }
        else if(!data.password)
        {
            App.alert('กรุณาระบุรหัสผ่าน');
        }
        else
        {
            service.ajax.save_charge_items(data, function(err){
                if(err)
                {
                    App.alert(err);
                }
                else
                {
                    App.alert('บันทึกรายการเสร็จเรียบร้อยแล้ว');
                }
            });
        }
    });

    //====================================================================================
    //activities
    //====================================================================================
    service.activities = {};

    service.activities.set_list = function(data)
    {
        _.each(data.rows, function(v){
            $('#tbl_act_list > tbody').append(
                '<tr>' +
                    '<td>'+ to_thai_date(v.act_date) +'</td>' +
                    '<td>'+ v.act_time +'</td>' +
                    '<td>'+ v.fullname +'</td>' +
                    '<td>'+ v.result +'</td>' +
                    '</tr>'
            );
        });
    };
    service.activities.get_list = function(service_code){
        $('#tbl_act_list > tbody').empty();

        service.ajax.get_activities(service_code, function(err, data){
            if(err){
                App.alert(err);
                $('#tbl_act_list > tbody').append('<tr><td colspan="4">ไม่พบรายการ</td></tr>');
            }else{
                service.activities.set_list(data);
            }
        });
    };

    $('a[href="#tab_act_history"]').on('click', function(){
        var service_code = $('#txt_service_code').val();
        service.activities.get_list(service_code);
    });

    service.activities.clear_form = function()
    {
        $('#txt_act_result').val('');
        App.set_first_selected($('#sl_act_user'));
        $('#txt_act_password').val('');
    };

    $('#btn_act_save').on('click', function(){
        var data = {};
        data.result = $('#txt_act_result').val();
        data.user_code = $('#sl_act_user').val();
        data.password = $('#txt_act_password').val();

        data.service_code = $('#txt_service_code').val();

        if(!data.service_code)
        {
            App.alert('กรุณาระบุเลขที่ใบรับซ่อม');
        }
        else if(!data.result)
        {
            App.alert('กรุณาระบุกิจกรรมที่ทำ');
        }
        else if(!data.user_code)
        {
            App.alert('กรุณาระบุชื่อผู้ใช้งาน');
        }
        else if(!data.password)
        {
            App.alert('กรุณาระบุรหัสผ่าน');
        }
        else
        {
            //do save
            service.ajax.save_activities(data, function(err){
                if(err)
                {
                    App.alert(err);
                }
                else
                {
                    App.alert('บันทึกข้อมูลเสร็จเรียบร้อยแล้ว');
                    service.activities.clear_form();
                }
            });
        }
    });

    //==================================================================================================================
    // Result and Discharge
    //==================================================================================================================
    service.result = {};

    service.result.get_result = function()
    {
        var service_code = $('#txt_service_code').val();
        service.ajax.get_result(service_code, function(err, data){
            if(!err)
            {
                $('#txt_rs_result').val(data.rows.service_result);
                $('#txt_rs_discharge_date').val(to_thai_date(data.rows.discharge_date));
            }
        });
    };
    $('a[data-name="btn_result"]').on('click', function(){
        //get result
        service.result.clear_form();
        service.result.get_result();
        service.modal.show_result();
    });

    service.result.clear_form = function()
    {
        $('#txt_rs_result').val('');
        $('#txt_rs_discharge_date').val('');
        App.set_first_selected($('#sl_rs_user'));
        $('#txt_rs_password').val('');
    };

    $('#btn_rs_save').on('click', function(){
        var data = {};
        data.result = $('#txt_rs_result').val();
        //data.discharge_status = $('#chk_rs_discharge').attr('checked') ? '1' : '0';
        data.discharge_date = $('#txt_rs_discharge_date').val();
        data.user_code = $('#sl_rs_user').val();
        data.password = $('#txt_rs_password').val();

        data.service_code = $('#txt_service_code').val();

        if(!data.result)
        {
            App.alert('กรุณาระบุสรุปผลการให้บริการ');
        }
        else if(!data.discharge_date)
        {
            App.alert('กรุณาระบุวันที่จำหน่าย');
        }
        else if(!data.user_code)
        {
            App.alert('กรุณาระบุชื่อผู้ใช้งาน');
        }
        else if(!data.password)
        {
            App.alert('กรุณาระบุรหัสผ่าน');
        }
        else
        {
            service.ajax.save_result(data, function(err){
                if(err)
                {
                    App.alert(err);
                }
                else
                {
                    App.alert('บันทึกข้อมูลเสร็จเรียบร้อยแล้ว');
                    service.modal.hide_result();
                    service.result.clear_form();
                }
            });
        }
    });

    //==================================================================================================================
    // Edit register
    //==================================================================================================================
    service.edit = {};


    //set for edit
    service.edit.prompt = function()
    {
        $('#txt_reg_query').attr('disabled', 'disabled').css('background-color', 'white');
        $('#txt_reg_isupdate').val('1');

    };

    service.edit.get_product_detail = function(product_code)
    {
        service.ajax.get_product_detail(product_code, function(err, data){
            if(err)
            {
                App.alert(err);
            }
            else
            {
                var product_name = product_code + " : " + data.rows.type_name + " ยี่ห้อ " + data.rows.brand_name +
                    " รุ่น " + data.rows.model_name;

                $('#txt_reg_query').val(product_name);
                $('#txt_reg_product_code').val(data.rows.product_code);
                $('#txt_reg_serial').val(data.rows.product_serial);
                $('#txt_reg_product_type').val(data.rows.type_name);
                $('#txt_reg_product_brand').val(data.rows.brand_name);
                $('#txt_reg_product_model').val(data.rows.model_name);
                $('#txt_reg_department').val(data.rows.customer_name);
                $('#txt_reg_supplier').val(data.rows.supplier_name);
            }
        });
    };

    service.edit.get_detail = function(service_code)
    {
        service.ajax.get_detail(service_code, function(err, data){
            if(!err)
            {
                $('#txt_reg_date').val(to_thai_date(data.rows.date_serv));
                $('#txt_reg_cause').val(data.rows.cause);
                $('#txt_reg_contact').val(data.rows.contact_name);
                $('#txt_reg_contact_telephone').val(data.rows.contact_telephone);
                $('#sl_reg_customers').val(data.rows.customer_code);
                $('#sl_reg_priority').val(data.rows.priority);
            }
        });
    };

    service.edit.get_other_device = function(service_code)
    {
        service.db.items().remove();

        $('#tbl_reg_item_list > tbody').empty();
        $('#tbl_reg_item_list > tbody').append('<tr><td colspan="4">ไม่พบรายการ</td></tr>');

        service.ajax.get_other_device(service_code, function(err, data){
            if(!err)
            {
                _.each(data.rows, function(v){
                    var data = {};
                    data.code = v.item_code;
                    data.name = v.name;
                    data.qty = v.item_qty;

                    service.insert_item(data);
                });

                service.set_item_list();
            }
        });
    };

    $('a[data-name="btn_edit_register"]').on('click', function(){

        var product_code = $('#txt_product_code').val(),
            service_code = $('#txt_service_code').val();

        service.edit.prompt();
        service.edit.get_product_detail(product_code);
        service.edit.get_detail(service_code);
        service.edit.get_other_device(service_code);

        $('a[href="#tab_service1"]').tab('show');
        service.modal.show_register();
    });

    //Print service
    $('a[data-name="btn_print"]').on('click', function(){
        var service_code = $('#txt_service_code').val();
        App.goto_url('/prints/service/' + service_code);
    });

    $('#txt_query').typeahead({
        ajax: {
            url: site_url + '/sends/search_service_ajax',
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


    //search service
    $('#btn_do_search').on('click', function(){
        var query = $('#txt_query').val();

        if(!query)
        {
            App.alert('กรุณาระบุเลขที่รับซ่อมเพื่อค้นหา');
        }
        else
        {
            service.ajax.search_service(query, function(err, data){
                if(err)
                {
                    App.alert('ไม่พบรายการ');
                }
                else
                {
                    service.set_service_list(err, data);
                    $('#main_paging').fadeOut('slow');

                    $('a[data-name="tab_service"]').each(function(){
                        if($(this).attr('data-id') == data.rows[0].service_status){
                            $(this).tab('show');
                        }
                    });
                }
            });
        }
    });

    service.get_service_list();


});
