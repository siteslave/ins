$(function(){
    var items = {};

    items.modal = {
        show_new: function(){
            $('#mdl_new').modal({backdrop: 'static'}).show();
        }
    };

    items.ajax = {
        save: function(data, cb){
            var url = '/items/save',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        remove: function(code, cb){
            var url = '/items/remove',
                params = {
                    code: code
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_list: function(start, stop, cb){
            var url = '/items/get_list',
                params = {
                	start: start,
                	stop: stop
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },

        get_list_total: function(cb){
            var url = '/items/get_list_total',
                params = {};

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        search: function(query, cb){
            var url = '/items/search',
                params = {
                    query: query
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        }

    };
	items.set_list = function(data){
		if(_.size(data.rows) > 0){
            _.each(data.rows, function(v){
                $('#tbl_list tbody').append(
                    '<tr>' +
                        '<td>' + v.code + '</td>' +
                        '<td>' + v.name + '</td>' +
                        '<td>' + addCommas(v.price) + '</td>' +
                        '<td>' +
                            '<div class="btn-group">' +
                            '<a href="javascript:void(0);" class="btn" data-name="edit" ' +
                        'data-vname="' + v.name + '" data-code="' + v.code + '" data-price="'+ v.price +'"><i class="icon-edit"></i></a>' +
                            '<a href="javascript:void(0);" class="btn" data-name="remove" data-code="' + v.code + '"><i class="icon-trash"></i></a>' +
                            '</div>' +
                        '</td>' +
                    '</tr>'
                );
            });
        }else{
            $('#tbl_list tbody').append(
                '<tr><td colspan="4">ไม่พบรายการ</td></tr>'
            );
        }
	};
	items.get_list = function(){
	    $('#main_paging').fadeIn('slow');
		items.ajax.get_list_total(function(err, data){
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

	                    items.ajax.get_list(this.slice[0], this.slice[1], function(err, data){
	                    	$('#tbl_list tbody').empty();
	                        if(err){
	                            App.alert(err);
	                        }else{
	                            items.set_list(data);
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

	items.clear_form = function(){
	    $('#txt_name').val('');
	    $('#txt_price').val('');
        $('#txt_code').val('').removeAttr('disabled');
        $('#txt_isupdate').val('0');
	};

    //show new modal
    $('#btn_new').click(function(){
        items.modal.show_new();
    });

    $('#btn_save').click(function(){
        var data = {};
        data.name = $.trim($('#txt_name').val());
        data.code = $('#txt_code').val();
        data.price = $('#txt_price').val();
        data.isupdate = $('#txt_isupdate').val();

        if(!data.name){
            App.alert('กรุณาระบุชื่อ');
        }else if(!data.price){
            App.alert('กรุณาระบุราคา');
        }else{
            items.ajax.save(data, function(err){
                if(err){
                    App.alert(err);
                }else{
                    items.clear_form();
                    $('#mdl_new').modal('hide');
                    //load list
                    items.get_list();
                }
            });
        }
    });

    $('a[data-name="edit"]').live('click', function(){
        var code = $(this).attr('data-code'),
            name = $.trim($(this).attr('data-vname')),
            price = $(this).attr('data-price');

        $('#txt_code').val(code).attr('disabled', 'disabled').css('background-color', 'white');
        $('#txt_name').val(name);
        $('#txt_price').val(price);
        $('#txt_isupdate').val('1');

        items.modal.show_new();
    });

    $('#mdl_new').on('hidden', function(){
        items.clear_form();
    });

    $('a[data-name="remove"]').live('click', function(){
        var code = $(this).attr('data-code');
        var t = $(this).parent().parent().parent();

        if(confirm('คุณต้องการลบรายการนี้ใช่หรือไม่?')){
            items.ajax.remove(code, function(err){
                if(err){
                    App.alert(err);
                }else{
                    //remove row
                    App.alert('ลบรายการเสร็จเรียบร้อยแล้ว');
                    $(t).fadeOut('slow');
                }
            });
        }
    });

    //search
    $('#btn_search').click(function(){
        var query = $.trim($('#txt_query').val());
		$('#main_paging').fadeOut('slow');
        $('#tbl_list tbody').empty();

        if(query && query.length > 2){
            //do search
            items.ajax.search(query, function(err, data){
                if(err){
                    App.alert(err);
                    $('#tbl_list tbody').append(
                        '<tr><td colspan="4">ไม่พบรายการ</td></tr>'
                    );
                }else{
                    items.set_list(data);
                }
            });
        }else{
            //App.alert('กรุณาระบุคำค้นหา ต้องมากกว่า 2 ตัวอักษรขึ้นไป');
            items.get_list();
        }
    });


    $('#btn_print').on('click', function(){
        App.goto_url('/prints/charge_item');
    });

    items.get_list();
});
